<?php

namespace App\Contracts\Repositories;

use App\Models\Task;

interface TaskRepositoryInterface
{
	public function all();
	public function find($id);
	public function create($data);
	public function update(Task $task, $data);
}