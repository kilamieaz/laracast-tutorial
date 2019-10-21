<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_user()
    {
        $user = $this->signIn();
        $project = ProjectFactory::ownedBy($user)->create();
        $this->assertEquals($user->id, $project->activity->first()->user->id);
    }

    /** @test */
    public function it_has_a_username()
    {
        $projectDifferentOwner = ProjectFactory::create();
        $project = ProjectFactory::ownedBy($this->signIn())->create();
        $this->assertEquals('You', $project->activity->first()->username());
        $this->assertEquals($projectDifferentOwner->activity->first()->user->name , $projectDifferentOwner->activity->first()->username());
    }
}
