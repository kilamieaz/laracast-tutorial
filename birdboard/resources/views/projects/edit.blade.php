@extends ('layouts.app')

@section('content')
<div class="lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow">
    <h1 class="text-2xl font-normal mb-10 text-center">Edit Your Project</h1>
    <form method="POST" action="{{ route('projects.update', $project->id) }}">
        @method('PATCH')
        @include('projects._form', ['buttonText' => 'update project'])
    </form>
</div>
@endsection
