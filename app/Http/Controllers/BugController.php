<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Illuminate\Http\Request;

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

        if ($request->filled('developer')) {
            $query->where('developer', $request->developer);
        }

        $bugs = $query->orderBy('created_at', 'desc')->get();

        return view('bugs', compact('bugs'));
    }

    /**
     * Show the form for creating a new bug.
     */
    public function create()
    {
        return view('bugs-create');
    }

    /**
     * Store a newly created bug in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'priority' => ['required', 'string', 'in:p1,p2,p3'],
            'status' => ['required', 'string', 'in:open,in_progress,resolved'],
            'developer' => ['nullable', 'string'],
            'description' => ['required', 'string'],
        ]);

        $validated['reporter_id'] = $request->user()->id;
        Bug::create($validated);

        return redirect()->route('bugs')->with('success', 'Bug reported successfully.');
    }

    /**
     * Display the specified bug.
     */
    public function show(Bug $bug)
    {
        return view('bugs-show', compact('bug'));
    }

    /**
     * Update the status of a bug.
     */
    public function updateStatus(Request $request, Bug $bug)
    {
        $user = $request->user();
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:open,in_progress,fixed,retest,closed'],
            'developer' => ['nullable', 'string'],
        ]);

        if ($user->role === 'developer') {
            if (!in_array($validated['status'], ['open', 'in_progress', 'fixed'])) {
                return redirect()->back()->withErrors(['status' => 'Developer is not allowed to set this status.']);
            }
            unset($validated['developer']);
        }

        $bug->update($validated);

        return redirect()->route('bugs.show', $bug)->with('success', 'Bug updated successfully.');
    }
}
