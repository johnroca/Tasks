@extends('layout')
@section('content')
    <p>Add New Tasks</p>

    <form class="form-horizontal"  action="{{ route('tasks.create') }}" method="POST">
        {{csrf_field()}}

        <div class="form-group">
            <label class="control-label col-sm-2" for="task">Task Name</label>
            <div class="col-sm-10 @if($errors->first('task')) has-error @endif">
                <input type="text" class="form-control" id="task" placeholder="Enter Task Name" name="task">

                @if($errors->first('task'))
                    <span class="help-block">{{ $errors->first('task') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="due_date">Due Date</label>
            <div class="col-sm-10  @if($errors->first('due_date')) has-error @endif">
                <input type="date" class="form-control" id="due_date" name="due_date" min="{{ date_create()->format('Y-m-d') }}">
                @if($errors->first('due_date'))
                    <span class="help-block">{{ $errors->first('due_date') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2"><input type="submit" value="Add Task" class="btn-large btn btn-primary"></div>
        </div>
    </form>
@endsection