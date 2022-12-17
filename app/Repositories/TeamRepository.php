<?php


namespace App\Repositories;


use App\Models\Team;

class TeamRepository
{
    protected $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function store($data)
    {

    }

    public function edit($data,$id)
    {

    }

    public function findById($id)
    {

    }

    public function fetchUsersTeam()
    {
        //fetch team where i am a member
    }
    public function delete($id)
    {

    }
}
