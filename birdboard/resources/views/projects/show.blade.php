@extends('layouts.app')
@section('content')
<header class="flex items-center mb-3 py-4">
    <div class="flex justify-between item-center w-full">
        <p class="text-default text-sm font-normal">
            <a href="{{ route('projects.index') }}" class="text-default text-sm font-normal no-underline">My
                Projects</a> / {{ $project->title }}
        </p>
        <div class="flex items-center">
            @foreach ($project->members as $member)
            <img src="{{ gravatar_url($member->email) }}" alt="{{ $member->name }}'s avatar"
                class="rounded-full w-8 mr-2">
            @endforeach
            <img src="{{ gravatar_url($project->owner->email) }}" alt="{{ $project->owner->name }}'s avatar"
                class="rounded-full w-8 mr-2">

            <a href="{{ route('projects.edit', $project->id) }}" class="button ml-4">Edit Project</a>
        </div>
    </div>
</header>
<main>
    <div class="flex -mx-3">
        <div class="w-3/4 px-3">
            <div class="mb-8">
                <h2 class="text-lg text-default font-normal mb-3">Tasks</h2>
                {{-- tasks --}}
                @foreach ($project->tasks as $task)
                <div class="card mb-3">
                    <form action="{{ route('tasks.update', [$project->id,$task->id]) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="flex">
                            <input type="text" value="{{ $task->body }}"
                                class="bg-card text-default w-full {{ !$task->completed ?: 'text-default' }}" name="body">
                            <input type="checkbox" name="completed" onchange="this.form.submit()"
                                {{ !$task->completed ?: 'checked' }}>
                        </div>
                    </form>
                </div>
                @endforeach
                <div class="card mb-3">
                    <form action="{{ route('tasks.store', $project->id) }}" method="post">
                        @csrf
                        <input type="text" placeholder="Add a new task" class="bg-card text-default w-full" name="body">
                    </form>
                </div>
            </div>
            <div>
                <h2 class="text-lg text-default font-normal mb-3">General Notes</h2>
                <form action="{{ $project->path() }}" method="post">
                    @csrf
                    @method('PATCH')
                    <textarea class="card w-full" style="min-height: 200px" name="notes"
                        placeholder="Anything special that you want to make a note of?">{{ $project->notes }}</textarea>
                    <button type="submit" class="button">Save</button>
                </form>
                @include('errors')
            </div>
        </div>
        <div class="w-1/4 px-3">
            @include('projects.card')
            @include('projects.activity.card')
            @can('manage', $project)
                @include('projects.invite')
            @endcan
        </div>
    </div>
</main>
@endsection
