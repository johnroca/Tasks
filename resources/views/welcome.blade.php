@extends('layout')

@section('content')
    <div class="links">
        <p><a href="{{ route('tasks.create') }}">Add New Task</a></p>
        <p><a href="{{ route('tasks')  }}">View Tasks</a></p>
    </div>
@endsection