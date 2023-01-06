<?php


namespace App\Repositories;


use App\Models\Member;
use App\Models\Team;

class TeamRepository
{
    protected $team,$member;

    public function __construct(Team $team,Member $member)
    {
        $this->team = $team;
        $this->member = $member;
    }

    public function store($data)
    {
        $data['user_id'] = auth()->id();
        $team = $this->team->create($data);
        $member['name'] =auth()->user()->name;
        $member['email'] =auth()->user()->email;
        $member['team_id'] = $team->id;
        $team->members()->create($member);
        return $team;
    }


    public function findById($id)
    {
        $team = $this->team->find($id);
        abort_if(!$team,404,"Team not found");
        return $team;
    }

    public function fetchUsersTeam()
    {
        $teams = $this->team->where('user_id',auth()->id())->get();
        return $teams;
    }
    public function edit($data,$id)
    {

    }

    public function delete($id)
    {

    }

    public function addToTeam($data,$team_id)
    {
        $team = $this->findById($team_id);
        $result = $team->members()->create($data);
        return $result;
    }

    public function removeMember($team_id,$member_id)
    {
        $team = $this->findById($team_id);
        $result = $team->members()->delete($member_id);
        return $result;
    }
}
