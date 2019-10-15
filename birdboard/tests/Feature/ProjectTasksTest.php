<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
    public function guests_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = factory('App\Project')->create();
        $this->post($project->path() . '/tasks', ['body' => 'test task'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'test task']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        // $this->withoutExceptionHandling();
        $this->signIn();
        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );
        $this->post($project->path() . '/tasks', ['body' => 'test task']);
        $this->get($project->path())->assertSee('test task');
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();
        $project = auth()->user()->projects()->create(
            factory('App\Project')->raw()
        );
        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors(['body']);
    }
}
