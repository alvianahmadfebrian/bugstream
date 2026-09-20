<?php

namespace Tests\Feature;

use App\Models\Bug;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_projects(): void
    {
        $response = $this->get(route('projects.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_qa_and_admin_can_view_projects_list(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);
        $project = Project::create([
            'name' => 'Mobile Banking',
            'description' => 'Aplikasi mobile banking perbankan',
            'created_by' => $qa->id,
        ]);

        $response = $this->actingAs($qa)->get(route('projects.index'));
        $response->assertStatus(200);
        $response->assertSee('Mobile Banking');
    }

    public function test_qa_can_create_new_project_folder(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);

        $response = $this->actingAs($qa)->post(route('projects.store'), [
            'name' => 'E-Commerce App',
            'description' => 'Toko online terintegrasi payment gateway',
        ]);

        $this->assertDatabaseHas('projects', [
            'name' => 'E-Commerce App',
            'created_by' => $qa->id,
        ]);

        $project = Project::where('name', 'E-Commerce App')->first();
        $response->assertRedirect(route('projects.show', $project));
    }

    public function test_developer_cannot_create_project_folder(): void
    {
        $dev = User::factory()->create(['role' => 'developer']);

        $response = $this->actingAs($dev)->post(route('projects.store'), [
            'name' => 'Unauthorized Project',
        ]);

        $response->assertStatus(403);
    }

    public function test_qa_can_view_project_folder_details_and_bugs(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Alex Dev']);

        $project = Project::create([
            'name' => 'Instagram Clone',
            'created_by' => $qa->id,
        ]);

        $bug = Bug::create([
            'title' => 'Story filter not loading',
            'project_id' => $project->id,
            'project' => $project->name,
            'priority' => 'p1',
            'status' => 'open',
            'developer' => $dev->name,
            'description' => 'Filter black and white crash app',
            'reporter_id' => $qa->id,
        ]);

        $response = $this->actingAs($qa)->get(route('projects.show', $project));
        $response->assertStatus(200);
        $response->assertSee('Instagram Clone');
        $response->assertSee('Story filter not loading');
    }

    public function test_qa_reporting_bug_inside_project_folder_automatically_binds_project(): void
    {
        $qa = User::factory()->create(['role' => 'support_dev']);
        $dev = User::factory()->create(['role' => 'developer', 'name' => 'Budi Dev']);

        $project = Project::create([
            'name' => 'Point of Sales System',
            'created_by' => $qa->id,
        ]);

        // Access the create bug form with project_id
        $formResponse = $this->actingAs($qa)->get(route('bugs.create', ['project_id' => $project->id]));
        $formResponse->assertStatus(200);
        $formResponse->assertSee('Point of Sales System');
        $formResponse->assertSee('Otomatis Terkunci');

        // Submit the bug with project_id (no need to specify raw project string)
        $storeResponse = $this->actingAs($qa)->post(route('bugs.store'), [
            'title' => 'Print receipt alignment issue',
            'project_id' => $project->id,
            'from_project' => 1,
            'priority' => 'p2',
            'status' => 'open',
            'developer' => 'Budi Dev',
            'description' => 'Kertas struk terpotong di bagian total harga',
        ]);

        $this->assertDatabaseHas('bugs', [
            'title' => 'Print receipt alignment issue',
            'project_id' => $project->id,
            'project' => 'Point of Sales System',
            'priority' => 'p2',
            'status' => 'open',
            'developer' => 'Budi Dev',
            'reporter_id' => $qa->id,
        ]);

        $storeResponse->assertRedirect(route('projects.show', $project));
    }

    public function test_super_admin_can_delete_project_folder(): void
    {
        $admin = User::factory()->create(['role' => 'super_admin']);
        $project = Project::create([
            'name' => 'Project to Delete',
            'created_by' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->delete(route('projects.destroy', $project));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
        $response->assertRedirect(route('projects.index'));
    }
}
