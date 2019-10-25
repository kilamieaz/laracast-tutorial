<?php

namespace Tests\Feature;

use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_invite_a_user()
    {
        // given i have a project
        $project = ProjectFactory::create();
        // and the owner of the project invites another user
        $project->invite($newUser = factory(User::class)->create());
        $this->assertCount(1, $project->members);
        // then, that new user will have permission to add tasks
        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'foo task']);
        $this->assertDatabaseHas('tasks', $task);
    }
}
