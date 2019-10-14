@extends('layouts.app')
@section('content')
<div class="flex items-center mb-3">
<a href="{{ route('projects.create') }}">New Project</a>
</div>
<ul>
    @forelse($projects as $item)
    <li><a href="{{ $item->path() }}">{{$item->title}}</a></li>
    @empty
    <li>No Projects yet.</li>
    @endforelse
</ul>
@endsection
