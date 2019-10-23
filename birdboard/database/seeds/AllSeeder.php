<?php

use App\Project;
use App\Task;
use App\User;
use Illuminate\Database\Seeder;

class AllSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //data user admin
        $userAdmin = new User();
        $userAdmin->name = 'Admin';
        $userAdmin->email = 'im.admin@gmail.com';
        $userAdmin->email_verified_at = now();
        $userAdmin->password = bcrypt('password');
        $userAdmin->remember_token = Str::random(10);
        $userAdmin->save();

        factory(User::class, 5)->create()->each(function ($userMember) {
            //data project
            factory(Project::class)->create([
                'owner_id' => $userMember->id
            ])->each(function ($project) {
                //data taks
                $project->tasks()->save(factory(Task::class)->create([
                    'project_id' => $project->id,
                ]));
            });
        });
    }
}
