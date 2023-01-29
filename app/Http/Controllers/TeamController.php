<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddMemberToTeamRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->teamService->fetchUserTeams();
        return $this->response($data,Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        $data = $this->teamService->storeTeam($request->all());
        return $this->response($data,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show($teamId)
    {
        $team = $this->teamService->fetchTeam($teamId);
        return $this->response($team,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function addMember(AddMemberToTeamRequest $request,$team_id)
    {
        $data = $this->teamService->addMemberToTeam($request->all(),$team_id);
        return $this->response($data,Response::HTTP_CREATED);
    }
    public function removeMember($team_id,$member_id)
    {
        $data = $this->teamService->removeMemberFromTeam($team_id,$member_id);
        return $this->response([],Response::HTTP_NO_CONTENT);
    }

}
