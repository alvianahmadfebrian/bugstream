<?php

namespace Database\Seeders;

use App\Models\Bug;
use App\Models\User;
use App\Notifications\BugNotification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yoda = User::where('email', 'yoda@jedi.com')->first();
        $obiwan = User::where('email', 'obiwan@jedi.com')->first();
        $anakin = User::where('email', 'anakin@jedi.com')->first();

        if (! $yoda || ! $obiwan || ! $anakin) {
            return;
        }

        // Ensure sample bugs exist
        $bug1 = Bug::firstOrCreate(
            ['title' => 'Gateway Timeout saat Checkout'],
            [
                'priority' => 'p1',
                'status' => 'in_progress',
                'developer' => 'anakin',
                'description' => 'Gateway timeout 504 terjadi saat memproses pembayaran checkout dengan kartu kredit pada beban tinggi.',
                'reporter_id' => $obiwan->id,
            ]
        );

        $bug2 = Bug::firstOrCreate(
            ['title' => 'Navigasi Mobile Macet saat Resize'],
            [
                'priority' => 'p2',
                'status' => 'open',
                'developer' => 'anakin',
                'description' => 'Drawer navigasi samping tidak merespon sentuhan saat dibuka pada layar resolusi mobile di bawah 768px.',
                'reporter_id' => $obiwan->id,
            ]
        );

        $bug3 = Bug::firstOrCreate(
            ['title' => 'Memory Leak pada Report Export CSV'],
            [
                'priority' => 'p3',
                'status' => 'fixed',
                'developer' => 'anakin',
                'description' => 'Penggunaan RAM melonjak hingga 512MB saat melakukan export 10.000 data log ke format CSV.',
                'reporter_id' => $obiwan->id,
            ]
        );

        // Clear existing notifications to avoid duplicates on re-seed
        $yoda->notifications()->delete();
        $obiwan->notifications()->delete();
        $anakin->notifications()->delete();

        // 1. Notifications for Super Admin (masteryoda)
        $yoda->notify(new BugNotification(
            title: 'Bug Baru Dilaporkan (P1)',
            message: "{$obiwan->name} melaporkan bug kritis #{$bug1->id}: '{$bug1->title}'",
            type: 'bug_created',
            bugId: $bug1->id,
            icon: 'bug_report',
            badgeColor: 'error'
        ));

        $yoda->notify(new BugNotification(
            title: 'Penugasan Developer',
            message: "{$anakin->name} ditugaskan untuk menangani bug #{$bug1->id}: '{$bug1->title}'",
            type: 'assigned',
            bugId: $bug1->id,
            icon: 'person_add',
            badgeColor: 'primary'
        ));

        $yoda->notify(new BugNotification(
            title: 'Bug Telah Diperbaiki',
            message: "{$anakin->name} menandai bug #{$bug3->id} ('{$bug3->title}') sebagai 'Fixed'",
            type: 'status_updated',
            bugId: $bug3->id,
            icon: 'check_circle',
            badgeColor: 'emerald'
        ));

        // 2. Notifications for Support / QA (obiwan)
        $obiwan->notify(new BugNotification(
            title: 'Status Bug Diperbarui',
            message: "{$anakin->name} mulai mengerjakan bug #{$bug1->id} ('{$bug1->title}') yang Anda laporkan.",
            type: 'status_updated',
            bugId: $bug1->id,
            icon: 'sync',
            badgeColor: 'primary'
        ));

        $obiwan->notify(new BugNotification(
            title: 'Bug Siap Di-retest',
            message: "Bug #{$bug3->id} ('{$bug3->title}') telah diperbaiki oleh {$anakin->name}. Siap untuk retest verifikasi.",
            type: 'status_updated',
            bugId: $bug3->id,
            icon: 'check_circle',
            badgeColor: 'emerald'
        ));

        $obiwan->notify(new BugNotification(
            title: 'Laporan Bug Diterima',
            message: "Laporan bug #{$bug2->id} ('{$bug2->title}') telah terdaftar dalam sistem antrean.",
            type: 'bug_created',
            bugId: $bug2->id,
            icon: 'task_alt',
            badgeColor: 'secondary'
        ));

        // 3. Notifications for Developer (anakin)
        $anakin->notify(new BugNotification(
            title: 'Penugasan Bug Baru',
            message: "Anda telah ditugaskan untuk menangani bug #{$bug1->id}: '{$bug1->title}'",
            type: 'assigned',
            bugId: $bug1->id,
            icon: 'person_add',
            badgeColor: 'primary'
        ));

        $anakin->notify(new BugNotification(
            title: 'Alert Bug Kritis (P1)',
            message: "Bug prioritas tinggi #{$bug1->id} ('{$bug1->title}') memerlukan perhatian segera.",
            type: 'critical',
            bugId: $bug1->id,
            icon: 'warning',
            badgeColor: 'error'
        ));

        $anakin->notify(new BugNotification(
            title: 'Bug Ditugaskan',
            message: "Anda ditugaskan ke bug #{$bug2->id}: '{$bug2->title}'. Prioritas P2.",
            type: 'assigned',
            bugId: $bug2->id,
            icon: 'person_add',
            badgeColor: 'primary'
        ));
    }
}
