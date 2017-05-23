<?php
namespace App\Repositories;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Models\Task;
/**
 * Class TaskRepository
 */
class TaskRepository implements TaskRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = app(Task::class);
    }

    /**
     * @param array $fields
     */
    public function all()
    {
        return $this->model->orderBy('due_date', 'ASC')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @param $data
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param Task $task
     * @param $data
     */
    public function update(Task $task, $data)
    {
        return $task->update($data);
    }
}