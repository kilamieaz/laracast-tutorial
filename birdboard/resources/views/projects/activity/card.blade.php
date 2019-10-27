<div class="card mt-3">
    <ul class="text-xs list-reset">
        @foreach ($project->activity as $activity)
        <li class="{{ $loop->last ? '' : 'mb-1'}} text-default">
            @include("projects.activity.{$activity->description}")
            {{ $activity->created_at->diffForHumans(null, true) }}
        </li>
        @endforeach
    </ul>
</div>
