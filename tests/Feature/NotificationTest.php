<?php

namespace Tests\Feature;

use App\Models\Bug;
use App\Models\User;
use App\Notifications\BugNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_notifications(): void
    {
        $response = $this->getJson(route('notifications.index'));
        $response->assertStatus(401);
    }

    public function test_user_can_fetch_their_notifications(): void
    {
        $user = User::factory()->create(['role' => 'developer']);
        $user->notify(new BugNotification(
            title: 'Test Notif',
            message: 'Testing message',
            type: 'test'
        ));

        $response = $this->actingAs($user)->getJson(route('notifications.index'));

        $response->assertOk();
        $response->assertJsonStructure([
            'notifications',
            'unread_count',
            'total_count',
        ]);
        $this->assertEquals(1, $response->json('unread_count'));
    }

    public function test_user_can_mark_notification_as_read(): void
    {
        $user = User::factory()->create(['role' => 'developer']);
        $user->notify(new BugNotification(
            title: 'Test Read',
            message: 'Testing read message',
            type: 'test'
        ));

        $notificationId = $user->unreadNotifications->first()->id;

        $response = $this->actingAs($user)->postJson(route('notifications.read', $notificationId));

        $response->assertOk();
        $response->assertJson(['success' => true, 'unread_count' => 0]);
        $this->assertEquals(0, $user->fresh()->unreadNotifications()->count());
    }

    public function test_user_can_mark_all_notifications_as_read(): void
    {
        $user = User::factory()->create(['role' => 'developer']);
        $user->notify(new BugNotification(title: 'Notif 1', message: 'Msg 1'));
        $user->notify(new BugNotification(title: 'Notif 2', message: 'Msg 2'));

        $this->assertEquals(2, $user->unreadNotifications()->count());

        $response = $this->actingAs($user)->postJson(route('notifications.read-all'));

        $response->assertOk();
        $this->assertEquals(0, $user->fresh()->unreadNotifications()->count());
    }

    public function test_bug_creation_triggers_notifications_for_admin_and_developer(): void
    {
        $admin = User::factory()->create(['name' => 'admin_user', 'role' => 'super_admin']);
        $dev = User::factory()->create(['name' => 'dev_user', 'role' => 'developer']);
        $support = User::factory()->create(['name' => 'support_user', 'role' => 'support_dev']);

        $response = $this->actingAs($support)->post(route('bugs.store'), [
            'title' => 'Critical System Failure',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'dev_user',
            'description' => 'System crashed',
        ]);

        $response->assertRedirect(route('bugs'));

        $this->assertGreaterThan(0, $admin->fresh()->unreadNotifications()->count());
        $this->assertGreaterThan(0, $dev->fresh()->unreadNotifications()->count());
    }

    public function test_status_update_triggers_notification_for_reporter(): void
    {
        $support = User::factory()->create(['name' => 'support_user', 'role' => 'support_dev']);
        $dev = User::factory()->create(['name' => 'dev_user', 'role' => 'developer']);

        $bug = Bug::create([
            'title' => 'Test Bug for Status',
            'priority' => 'p2',
            'status' => 'open',
            'developer' => 'dev_user',
            'description' => 'Description here',
            'reporter_id' => $support->id,
        ]);

        $response = $this->actingAs($dev)->patch(route('bugs.status.update', $bug), [
            'status' => 'in_progress',
        ]);

        $response->assertRedirect(route('bugs'));

        $this->assertEquals(1, $support->fresh()->unreadNotifications()->count());
        $this->assertStringContainsString('In Progress', $support->fresh()->unreadNotifications()->first()->data['message']);
    }
}
