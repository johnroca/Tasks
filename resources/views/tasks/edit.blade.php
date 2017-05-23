@extends('layout')
@section('content')
    <p>Add New Tasks</p>

    <form class="form-horizontal"  action="{{ route('tasks.update') }}" method="POST">
        {{csrf_field()}}
        <input type="hidden" name="task_id" value="{{ $task->id }}"/>
        <div class="form-group">
            <label class="control-label col-sm-2" for="task">Task Name</label>
            <div class="col-sm-10 @if($errors->first('task')) has-error @endif">
                <input type="text" class="form-control" id="task" placeholder="Enter Task Name" name="task" value="{{ $task->name }}">

                @if($errors->first('task'))
                    <span class="help-block">{{ $errors->first('task') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="due_date">Due Date</label>
            <div class="col-sm-10  @if($errors->first('due_date')) has-error @endif">
                <input type="date" class="form-control" id="due_date" name="due_date" min="{{ date_create()->format('Y-m-d') }}" value="{{ $task->due_date }}">
                @if($errors->first('due_date'))
                    <span class="help-block">{{ $errors->first('due_date') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2"><input type="submit" value="Update Task" class="btn-large btn btn-primary"> <button type="button" class="delete btn-large btn btn-warning">Delete Task</button></div>
        </div>
    </form>
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {

            $('button.delete').on('click', function () {
                swal({
                        title: "Are you sure?",
                        text: "Are you sure you want to delete this task?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function () {
                        var $checkbox = $(this);

                        $.ajax({
                            url: "{{ route('tasks.delete') }}",
                            data : {
                                task_id : $('input[name="task_id"]').val(),
                                _token  : $('input[name="_token"]').val()
                            },
                            method : "POST",
                            success : function(resp) {
                                var x  = swal({
                                    title: "Deleted",
                                    text: "Task has been successfully deleted",
                                    type: "success"
                                }, function() {
                                    window.location.href = "{{ route('tasks') }}"
                                });
                            }
                        });
                    });
            });
        });
    </script>
@endsection