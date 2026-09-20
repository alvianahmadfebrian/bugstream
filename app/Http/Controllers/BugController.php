<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\User;
use App\Notifications\BugNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BugController extends Controller
{
    /**
     * Display a listing of the bugs.
     */
    public function index(Request $request)
    {
        $query = Bug::query();
        $user = $request->user();
        if ($user->role === 'support_dev') {
            $query->where('reporter_id', $user->id);
        } elseif ($user->role === 'developer') {
            $query->where('developer', $user->name);
        }

        // Apply filtering if parameters are present
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('developer') && $user->role !== 'developer') {
            $query->where('developer', $request->developer);
        }

        $bugs = $query->orderBy('created_at', 'desc')->get();
        $developers = User::where('role', 'developer')->orderBy('name')->get();

        return view('bugs', compact('bugs', 'developers'));
    }

    /**
     * Show the form for creating a new bug.
     */
    public function create(Request $request)
    {
        if ($request->user()->role === 'developer') {
            abort(403, 'Developers are not authorized to report bugs.');
        }

        $developers = User::where('role', 'developer')->orderBy('name')->get();

        return view('bugs-create', compact('developers'));
    }

    /**
     * Store a newly created bug in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->role === 'developer') {
            abort(403, 'Developers are not authorized to report bugs.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'project' => ['nullable', 'string', 'max:255'],
            'priority' => ['required', 'string', 'in:p1,p2,p3'],
            'status' => ['required', 'string', 'in:open,in_progress,resolved'],
            'developer' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'attachment' => ['nullable', 'file', 'max:5120'],
        ]);

        $validated['reporter_id'] = $request->user()->id;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $validated['attachment'] = $file->store('attachments', 'public');
            $validated['attachment_name'] = $file->getClientOriginalName();
            $validated['attachment_size'] = $file->getSize();
        }

        $bug = Bug::create($validated);
        $projectLabel = $bug->project ? "[{$bug->project}] " : '';

        // Notify Super Admins
        $superAdmins = User::where('role', 'super_admin')->where('id', '!=', $request->user()->id)->get();
        foreach ($superAdmins as $admin) {
            $admin->notify(new BugNotification(
                title: 'Bug Baru Dilaporkan',
                message: "{$request->user()->name} melaporkan bug #{$bug->id}: {$projectLabel}'{$bug->title}' (Prioritas: ".strtoupper($bug->priority).')',
                type: 'bug_created',
                bugId: $bug->id,
                icon: 'bug_report',
                badgeColor: $bug->priority === 'p1' ? 'error' : 'primary'
            ));
        }

        // If developer is assigned, notify the assigned developer
        if (! empty($bug->developer)) {
            $assignedDev = User::where('name', $bug->developer)->first();
            if ($assignedDev && $assignedDev->id !== $request->user()->id) {
                $assignedDev->notify(new BugNotification(
                    title: 'Penugasan Bug Baru',
                    message: "Anda telah ditugaskan untuk menangani bug #{$bug->id}: '{$bug->title}'",
                    type: 'assigned',
                    bugId: $bug->id,
                    icon: 'person_add',
                    badgeColor: 'primary'
                ));
            }
        }

        // If priority is P1 (Critical), notify all other developers as urgent alert
        if ($bug->priority === 'p1') {
            $otherDevs = User::where('role', 'developer')
                ->when(! empty($bug->developer), fn ($q) => $q->where('name', '!=', $bug->developer))
                ->where('id', '!=', $request->user()->id)
                ->get();
            foreach ($otherDevs as $dev) {
                $dev->notify(new BugNotification(
                    title: 'Alert Bug Kritis (P1)',
                    message: "Bug prioritas tinggi dilaporkan: '{$bug->title}'. Memerlukan perhatian tim.",
                    type: 'critical',
                    bugId: $bug->id,
                    icon: 'warning',
                    badgeColor: 'error'
                ));
            }
        }

        return redirect()->route('bugs')->with('success', 'Bug reported successfully.');
    }

    /**
     * Display the specified bug.
     */
    public function show(Request $request, Bug $bug)
    {
        $user = $request->user();
        if ($user->role === 'developer' && $bug->developer !== $user->name) {
            abort(403, 'Unauthorized.');
        }

        $developers = User::where('role', 'developer')->orderBy('name')->get();

        return view('bugs-show', compact('bug', 'developers'));
    }

    /**
     * Update the status of a bug.
     */
    public function updateStatus(Request $request, Bug $bug)
    {
        $user = $request->user();
        if ($user->role === 'developer' && $bug->developer !== $user->name) {
            abort(403, 'Unauthorized.');
        }

        $validated = $request->validate([
            'status' => ['required', 'string', 'in:open,in_progress,fixed,retest,closed'],
            'developer' => ['nullable', 'string'],
        ]);

        if ($user->role === 'developer') {
            if (! in_array($validated['status'], ['open', 'in_progress', 'fixed'])) {
                return redirect()->back()->withErrors(['status' => 'Developer is not allowed to set this status.']);
            }
            unset($validated['developer']);
        }

        $oldStatus = $bug->status;
        $oldDeveloper = $bug->developer;

        $bug->update($validated);

        // Check if developer assignment changed
        $newDeveloper = $bug->developer;
        if ($newDeveloper && $newDeveloper !== $oldDeveloper) {
            $assignedDev = User::where('name', $newDeveloper)->first();
            if ($assignedDev && $assignedDev->id !== $user->id) {
                $assignedDev->notify(new BugNotification(
                    title: 'Bug Ditugaskan Kepada Anda',
                    message: "{$user->name} menugaskan Anda ke bug #{$bug->id}: '{$bug->title}'",
                    type: 'assigned',
                    bugId: $bug->id,
                    icon: 'person_add',
                    badgeColor: 'primary'
                ));
            }
        }

        // Check if status changed
        if ($oldStatus !== $bug->status) {
            $statusLabels = [
                'open' => 'Open',
                'in_progress' => 'In Progress',
                'fixed' => 'Fixed',
                'retest' => 'Retest',
                'closed' => 'Closed',
            ];
            $statusLabel = $statusLabels[$bug->status] ?? ucfirst($bug->status);

            // 1. Notify reporter (support_dev) if someone else updated it
            if ($bug->reporter_id && $bug->reporter_id !== $user->id) {
                $reporter = User::find($bug->reporter_id);
                if ($reporter) {
                    $reporter->notify(new BugNotification(
                        title: 'Status Bug Diperbarui',
                        message: "{$user->name} memperbarui status bug #{$bug->id} ('{$bug->title}') menjadi '{$statusLabel}'.",
                        type: 'status_updated',
                        bugId: $bug->id,
                        icon: in_array($bug->status, ['fixed', 'closed']) ? 'check_circle' : 'sync',
                        badgeColor: in_array($bug->status, ['fixed', 'closed']) ? 'emerald' : 'primary'
                    ));
                }
            }

            // 2. Notify assigned developer if someone else updated it
            if (! empty($bug->developer)) {
                $assignedDev = User::where('name', $bug->developer)->first();
                if ($assignedDev && $assignedDev->id !== $user->id && $assignedDev->id !== $bug->reporter_id) {
                    $assignedDev->notify(new BugNotification(
                        title: 'Status Bug Diperbarui',
                        message: "Status bug #{$bug->id} ('{$bug->title}') diubah menjadi '{$statusLabel}' oleh {$user->name}.",
                        type: 'status_updated',
                        bugId: $bug->id,
                        icon: 'sync',
                        badgeColor: 'primary'
                    ));
                }
            }

            // 3. Notify Super Admins (if not the one who updated)
            $superAdmins = User::where('role', 'super_admin')->where('id', '!=', $user->id)->get();
            foreach ($superAdmins as $admin) {
                $admin->notify(new BugNotification(
                    title: 'Update Aktivitas Bug',
                    message: "{$user->name} mengubah status bug #{$bug->id} ('{$bug->title}') menjadi '{$statusLabel}'.",
                    type: 'status_updated',
                    bugId: $bug->id,
                    icon: 'history',
                    badgeColor: 'secondary'
                ));
            }
        }

        return redirect()->route('bugs')->with('success', 'Bug status updated successfully.');
    }

    /**
     * Remove the specified bug from storage.
     */
    public function destroy(Request $request, Bug $bug)
    {
        $user = $request->user();
        if ($user->role !== 'super_admin' && $bug->reporter_id !== $user->id) {
            abort(403, 'Unauthorized.');
        }

        if ($bug->attachment && Storage::disk('public')->exists($bug->attachment)) {
            Storage::disk('public')->delete($bug->attachment);
        }

        $bug->delete();

        return redirect()->route('bugs')->with('success', 'Bug deleted successfully.');
    }
}
