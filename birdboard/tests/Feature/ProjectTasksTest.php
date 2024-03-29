<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
//realtime facade add "Facades"
use Facades\Tests\Setup\ProjectFactory;

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
        $project = ProjectFactory::create();
        $this->post($project->path() . '/tasks', ['body' => 'test task'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'test task']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_task()
    {
        $this->signIn();
        $project = ProjectFactory::withTasks(1)->create();

        $this->patch($project->tasks()->first()->path(), ['body' => 'changed'])->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    /** @test */
    public function a_project_can_have_tasks()
    {
        // $this->signIn();
        // $project = auth()->user()->projects()->create(
        //     factory('App\Project')->raw()
        // );
        $project = ProjectFactory::ownedBy($this->signIn())->create();
        $this->post($project->path() . '/tasks', ['body' => 'test task']);
        $this->get($project->path())->assertSee('test task');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        // $project = app(ProjectFactory::class)
        // ->ownedBy($this->signIn())
        // ->withTasks(1)
        // ->create();
        $project = ProjectFactory::ownedBy($this->signIn())
        ->withTasks(1)
        ->create();

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed'
        ]);
        $this->assertDatabaseHas('tasks', [
            'body' => 'changed'
        ]);
    }

    /** @test */
    public function a_task_can_be_completed()
    {
        // $project = app(ProjectFactory::class)
        // ->ownedBy($this->signIn())
        // ->withTasks(1)
        // ->create();
        $project = ProjectFactory::ownedBy($this->signIn())
        ->withTasks(1)
        ->create();

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);
        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    /** @test */
    public function a_task_can_be_marked_as_incomplete()
    {
        $this->withoutExceptionHandling();
        // $project = app(ProjectFactory::class)
        // ->ownedBy($this->signIn())
        // ->withTasks(1)
        // ->create();
        $project = ProjectFactory::ownedBy($this->signIn())
        ->withTasks(1)
        ->create();

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->patch($project->tasks->first()->path(), [
            'body' => 'changed',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => false
        ]);
    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $project = ProjectFactory::ownedBy($this->signIn())->create();
        $task = $project->tasks()->create(
            factory('App\Task')->raw(['body' => ''])
        );
        // $task = factory('App\Task')->create(['body' => '']);
        $this->post($project->path() . '/tasks', $task->toArray())->assertSessionHasErrors(['body']);
        $this->patch($task->path(), $task->toArray())->assertSessionHasErrors(['body']);
    }
}
