<?php


namespace App\Repositories;


use App\Models\Member;
use App\Models\Task;
use App\Models\Team;

class TaskRepository
{
    protected $task,$team;

    public function __construct(Task $task,Team $team)
    {
        $this->task = $task;
        $this->team = $team;
    }

    public function findByTeamId($team_id)
    {
        $team = Team::find($team_id);
        abort_if(!$team,404,'Team not found');
        $tasks = $team->tasks;
        return $tasks;
    }

    public function findById($team_id,$task_id)
    {
        $team = Team::find($team_id);
        abort_if(!$team,404,'Team not found');
        $task = Task::whereId($task_id)->where('team_id',$team_id)->first();
        abort_if(!$task,404,'Task not found');
        return $task;
    }
    public function store($data,$team_id)
    {
        $team = Team::find($team_id);
        $data['user_id']=auth()->id();
        abort_if(!$team,404,'Team not found');
        return $team->tasks()->create($data);
    }

    public function update($data,$team_id, $task_id)
    {
        $task = $this->findById($team_id,$task_id);
        $task->update($data);
        return $task->refresh();
    }

    public function delete($team_id,$task_id)
    {
        $task = $this->findById($team_id,$task_id);
        return $task->delete();
    }
}
