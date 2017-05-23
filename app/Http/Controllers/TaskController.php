<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use App\Http\Requests\TaskCompletionRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Mockery\Exception;

class TaskController extends Controller
{
    private  $taskRepository;

    /**
     * TaskController constructor.
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tasks = $this->taskRepository->all();
        return view('tasks.list', compact('tasks'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('tasks.create');
    }

    /**
     * @param CreateTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(CreateTaskRequest $request)
    {
        $task = $this->taskRepository->create([
            'name'      => $request->get('task'),
            'due_date'  => $request->get('due_date'),
        ]);

        return redirect()->route('tasks')->with('success', true);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        try {
            $task = $this->taskRepository->find($id);

            if (!$task) {
              throw new Exception("Task Not Found");
            }

            return view('tasks.edit', compact('task'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * @param UpdateTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTaskRequest $request)
    {
        try {
            $id = $request->get('task_id');

            $task = $this->taskRepository->find($id);

            if (!$task) {
                throw new Exception("Task Not Found");
            }

            $this->taskRepository->update($task, [
                'name'      => $request->get('task'),
                'due_date'  => $request->get('due_date')
            ]);



            return redirect()->route('tasks')->with('success_update', true);

        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * @param TaskCompletionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function completion(TaskCompletionRequest $request)
    {
        try {

            if (!$request->ajax()) {
                throw new Exception('Method Not Allowed');
            }

            $id = $request->get('task_id');

            $task = $this->taskRepository->find($id);

            if (!$task) {
                throw new Exception("Task Not Found");
            }

            $isUpdate = $this->taskRepository->update($task, [
                'status'  => ($request->get('status') == 'true')
            ]);

            return response()->json([
                'success' => $isUpdate
            ]);

        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * @param DeleteTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteTaskRequest $request)
    {
        try {

            if (!$request->ajax()) {
                throw new Exception('Method Not Allowed');
            }

            $id = $request->get('task_id');

            $task = $this->taskRepository->find($id);

            if (!$task) {
                throw new Exception("Task Not Found");
            }

            $isDeleted = $task->delete();

            return response()->json([
                'success' => $isDeleted
            ]);

        } catch (\Exception $e) {
            abort(404);
        }
    }
}
