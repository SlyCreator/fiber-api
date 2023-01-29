<?php


namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function fetchTeamTasks($team_id)
    {
        return $this->taskRepository->findByTeamId($team_id);
    }
    public function fetchTask($team_id,$task_id)
    {
        return $this->taskRepository->findById($team_id,$task_id);
    }
    public function storeTask($data,$team_id)
    {
        return $this->taskRepository->store($data,$team_id);
    }

    public function updateTask($data,$team_id, $task_id)
    {
        return $this->taskRepository->update($data,$team_id, $task_id);
    }

    public function deleteTask($team_id,$task_id)
    {
        return $this->taskRepository->delete($team_id,$task_id);
    }
}
