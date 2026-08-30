<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Bug;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guests are redirected to the login page from root.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test that the login page loads successfully.
     */
    public function test_login_page_renders(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('BugStream');
        $response->assertSee('Email or Username');
    }

    /**
     * Test login with valid credentials.
     */
    public function test_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@company.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@company.com',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login with valid username (name) instead of email.
     */
    public function test_login_with_valid_username(): void
    {
        $user = User::factory()->create([
            'name' => 'adminuser',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'adminuser',
            'password' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test login with invalid credentials.
     */
    public function test_login_fails_with_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'admin@company.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@company.com',
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Test dashboard is accessible to authenticated users.
     */
    public function test_dashboard_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee('Recent Activity');
    }

    /**
     * Test logout works.
     */
    public function test_logout_redirects_to_login(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    /**
     * Test bugs page is accessible to authenticated users.
     */
    public function test_bugs_page_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();

        \App\Models\Bug::create([
            'id' => 92,
            'title' => 'Payment gateway timeout on checkout',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'Marcus Reed',
            'description' => 'Test steps',
        ]);

        $response = $this->actingAs($user)->get('/bugs');

        $response->assertStatus(200);
        $response->assertSee('BUG-4001');
        $response->assertSee('Marcus Reed');
    }

    /**
     * Test bug creation page requires authentication.
     */
    public function test_bugs_create_page_requires_auth(): void
    {
        $response = $this->get('/bugs/create');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test bug creation page loads for authenticated users.
     */
    public function test_bugs_create_page_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/bugs/create');

        $response->assertStatus(200);
        $response->assertSee('Report New Bug');
    }

    /**
     * Test validation rules are enforced when reporting a bug.
     */
    public function test_store_bug_validates_required_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/bugs', [
            'title' => '',
            'description' => '',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'description']);
    }

    /**
     * Test successfully storing a reported bug.
     */
    public function test_store_bug_creates_record_successfully(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/bugs', [
            'title' => 'New Test Bug Title',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'Alex Mercer',
            'description' => 'Test steps to reproduce.',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/bugs');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bugs', [
            'title' => 'New Test Bug Title',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'Alex Mercer',
        ]);
    }

    /**
     * Test bug detail page requires authentication.
     */
    public function test_bug_detail_page_requires_auth(): void
    {
        $bug = Bug::create([
            'title' => 'Sample Bug Title',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'Alex Mercer',
            'description' => 'Test description',
        ]);

        $response = $this->get('/bugs/' . $bug->id);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test bug detail page loads successfully for authenticated users.
     */
    public function test_bug_detail_page_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();
        $bug = Bug::create([
            'title' => 'Dynamic Testing Title',
            'priority' => 'p2',
            'status' => 'in_progress',
            'developer' => 'Sarah Jenkins',
            'description' => 'Test steps details reproducer.',
        ]);

        $response = $this->actingAs($user)->get('/bugs/' . $bug->id);

        $response->assertStatus(200);
        $response->assertSee('Dynamic Testing Title');
        $response->assertSee('Sarah Jenkins');
        $response->assertSee('Test steps details reproducer.');
    }

    /**
     * Test bug detail page returns 404 for non-existent bug.
     */
    public function test_bug_detail_page_returns_404_for_non_existent_bug(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/bugs/999');

        $response->assertStatus(404);
    }

    /**
     * Test reports page requires authentication.
     */
    public function test_reports_page_requires_auth(): void
    {
        $response = $this->get('/reports');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test reports page accessible to authenticated users.
     */
    public function test_reports_page_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/reports');

        $response->assertStatus(200);
        $response->assertSee('Analytics Summary');
        $response->assertSee('Export to PDF');
    }

    /**
     * Test settings page requires authentication.
     */
    public function test_settings_page_requires_auth(): void
    {
        $response = $this->get('/settings');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test settings page loads for authenticated users.
     */
    public function test_settings_page_accessible_to_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/settings');

        $response->assertStatus(200);
        $response->assertSee('Profile Information');
        $response->assertSee('Update Password');
        $response->assertSee($user->email);
    }

    /**
     * Test updating profile name and email saves successfully.
     */
    public function test_profile_update_saves_data_successfully(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
        ]);

        $response = $this->actingAs($user)->patch('/settings/profile', [
            'name' => 'New Awesome Name',
            'email' => 'new@example.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/settings');
        $response->assertSessionHas('status', 'profile-updated');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Awesome Name',
            'email' => 'new@example.com',
        ]);
    }

    /**
     * Test password updates validate current password and crypt new password successfully.
     */
    public function test_password_update_validates_current_password_and_saves_successfully(): void
    {
        $user = User::factory()->create([
            'password' => bcrypt('correct-password'),
        ]);

        // Attempt with wrong current password first
        $response = $this->actingAs($user)->put('/settings/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('current_password');

        // Attempt with correct current password
        $response = $this->actingAs($user)->put('/settings/password', [
            'current_password' => 'correct-password',
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/settings');
        $response->assertSessionHas('status', 'password-updated');

        $this->assertTrue(Hash::check('new-password-123', $user->fresh()->password));
    }

    /**
     * Test role-based routing restrictions for developers.
     */
    public function test_developer_is_restricted_from_dashboard_and_reports(): void
    {
        $developer = User::factory()->create(['role' => 'developer']);

        // Check dashboard redirect
        $response = $this->actingAs($developer)->get('/');
        $response->assertRedirect('/bugs');

        // Check reports redirect
        $response = $this->actingAs($developer)->get('/reports');
        $response->assertRedirect('/bugs');
    }

    /**
     * Test developer scoping in bugs list.
     */
    public function test_developer_only_sees_assigned_bugs(): void
    {
        $developer = User::factory()->create([
            'name' => 'anakin',
            'role' => 'developer',
        ]);

        $assignedBug = Bug::create([
            'title' => 'Assigned Bug',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'anakin',
            'description' => 'This is assigned to anakin',
        ]);

        $unassignedBug = Bug::create([
            'title' => 'Unassigned Bug',
            'priority' => 'p2',
            'status' => 'open',
            'developer' => 'obiwan',
            'description' => 'This is assigned to obiwan',
        ]);

        $response = $this->actingAs($developer)->get('/bugs');
        $response->assertSee('Assigned Bug');
        $response->assertDontSee('Unassigned Bug');
    }

    /**
     * Test support_dev scoping in bugs list.
     */
    public function test_support_dev_only_sees_reported_bugs(): void
    {
        $supportDev = User::factory()->create(['role' => 'support_dev']);
        $otherUser = User::factory()->create();

        $reportedBug = Bug::create([
            'title' => 'Reported Bug',
            'priority' => 'p1',
            'status' => 'open',
            'description' => 'Reported by supportDev',
            'reporter_id' => $supportDev->id,
        ]);

        $otherBug = Bug::create([
            'title' => 'Other Bug',
            'priority' => 'p2',
            'status' => 'open',
            'description' => 'Reported by otherUser',
            'reporter_id' => $otherUser->id,
        ]);

        $response = $this->actingAs($supportDev)->get('/bugs');
        $response->assertSee('Reported Bug');
        $response->assertDontSee('Other Bug');
    }

    /**
     * Test developer status update restrictions.
     */
    public function test_developer_status_update_restrictions(): void
    {
        $developer = User::factory()->create([
            'name' => 'anakin',
            'role' => 'developer',
        ]);

        $bug = Bug::create([
            'title' => 'Test Bug',
            'priority' => 'p1',
            'status' => 'open',
            'developer' => 'anakin',
            'description' => 'Test',
        ]);

        // Developer starts progress
        $response = $this->actingAs($developer)->post("/bugs/{$bug->id}/status", [
            '_method' => 'PATCH',
            'status' => 'in_progress',
        ]);
        $response->assertRedirect("/bugs/{$bug->id}");
        $this->assertEquals('in_progress', $bug->fresh()->status);

        // Developer tries to close (which is restricted)
        $response = $this->actingAs($developer)->post("/bugs/{$bug->id}/status", [
            '_method' => 'PATCH',
            'status' => 'closed',
        ]);
        $response->assertSessionHasErrors('status');
        $this->assertEquals('in_progress', $bug->fresh()->status);
    }

    /**
     * Test that user management CRUD page is accessible only to super_admin.
     */
    public function test_user_management_restricted_to_super_admin(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);
        $developer = User::factory()->create(['role' => 'developer']);

        // Super Admin access
        $response = $this->actingAs($superAdmin)->get('/users');
        $response->assertStatus(200);
        $response->assertSee('User Management');

        // Developer access (restricted)
        $response = $this->actingAs($developer)->get('/users');
        $response->assertStatus(403);
    }

    /**
     * Test user creation works for super_admin.
     */
    public function test_user_creation_by_super_admin(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);

        $response = $this->actingAs($superAdmin)->post('/users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'secret123',
            'role' => 'support_dev',
        ]);

        $response->assertRedirect('/users');
        $this->assertDatabaseHas('users', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'role' => 'support_dev',
        ]);
    }

    /**
     * Test user deletion restricted for self deletion.
     */
    public function test_user_self_deletion_prevented(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);

        $response = $this->actingAs($superAdmin)->delete("/users/{$superAdmin->id}");
        $response->assertSessionHasErrors('error');
        $this->assertDatabaseHas('users', ['id' => $superAdmin->id]);
    }
}
