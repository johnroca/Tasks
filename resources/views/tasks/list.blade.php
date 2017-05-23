@extends('layout')
@section('content')
    <p>View All Tasks</p>

    @if(\Session::has('success'))
        <div class="alert alert-success">
            New Task Created
        </div>
    @endif
    @if(\Session::has('success_update'))
        <div class="alert alert-success">
            Task Updated
        </div>
    @endif

    <table class="table">

        <thead>
            <tr>
                <td>Task Name</td>
                <td>Due Date</td>
                <td>Completed</td>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <?php $date = date_create($task->due_date); ?>
                <tr data-task-id="{{ $task->id }}">
                    <td><a class="task_name @if($task->status) completed @endif" href="{{ route('tasks.edit', [ 'id' => $task->id ]) }}">{{ $task->name }}</a> </td>
                    <td> <span class="due_date @if($task->status) completed @endif">{{ date_format($date, 'm-d-Y') }}</span> </td>
                    <td>
                        <input type="checkbox" name="completed" @if($task->status) checked="checked" @endif>
                    </td>
                </tr>
             @endforeach
        </tbody>
        {{ csrf_field() }}
    </table>
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            /**
             * Ajax Call To Update Completion
             */
            $('input[type="checkbox"]').on('change', function() {

                var $checkbox = $(this);

                $.ajax({
                    url: "{{ route('tasks.completion') }}",
                    data : {
                        task_id : $checkbox.closest('tr').attr('data-task-id'),
                        status  : $checkbox.is(':checked'),
                        _token  : $('input[name="_token"]').val()
                    },
                    method : "POST",
                    success : function(resp) {
                        if (resp.success) {

                            if  ($checkbox.is(':checked')) {
                                $checkbox.closest('tr').find('a.task_name').addClass('completed');
                                $checkbox.closest('tr').find('span.due_date').addClass('completed');
                            } else {
                                $checkbox.closest('tr').find('a.task_name').removeClass('completed');
                                $checkbox.closest('tr').find('span.due_date').removeClass('completed');
                            }
                        }
                    }
                });
            });
        });
    </script>
@endsection