<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manage(User $user, Project $project)
    {
        return $user->is($project->owner);
    }

    public function create(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user);
    }

    public function view(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user);
    }

    public function update(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user);
    }

    public function delete(User $user, Project $project)
    {
        return $user->is($project->owner) || $project->members->contains($user);
    }
}
