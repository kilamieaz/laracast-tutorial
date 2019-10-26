<?php

namespace Tests\Setup;

use App\Project;
use App\Task;
use App\User;

class ProjectFactory
{
    protected $tasksCount = 0;
    protected $user;

    public function ownedBy($user)
    {
        $this->user = $user;
        //we want use api
        return $this;
    }

    public function withTasks($count)
    {
        $this->tasksCount = $count;
        //we want use api
        return $this;
    }

    public function create()
    {
        $project = factory(Project::class)->create([
            'owner_id' => $this->user->id ?? factory(User::class)
        ]);

        factory(Task::class, $this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
