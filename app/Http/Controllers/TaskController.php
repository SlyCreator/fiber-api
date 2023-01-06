<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($team_id)
    {
        $result = $this->taskService->fetchTeamTasks($team_id);
        return $this->response($result,Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request,$team_id)
    {
        $result = $this->taskService->storeTask($request->all(),$team_id);
        return $this->response($result,Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($team_id,$task_id)
    {
        $result = $this->taskService->fetchTask($team_id,$task_id);
        return $this->response($result,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request,$team_id, $task_id)
    {
        $result = $this->taskService->updateTask($request->all(),$team_id, $task_id);
        return $this->response($result,Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($team_id,$task_id)
    {
        $result = $this->taskService->deleteTask($team_id,$task_id);
        return $this->response($result,Response::HTTP_NO_CONTENT);
    }
}
