@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('projects.store') }}">
    @csrf
    <h1>Create A Project</h1>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title"
            placeholder="title">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" placeholder="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('projects.index') }}">Cancel</a>
</form>
@endsection
