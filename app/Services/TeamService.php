<?php


namespace App\Services;


use App\Repositories\TeamRepository;

class TeamService
{
    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function fetchUserTeams()
    {
        return $this->teamRepository->fetchUsersTeam();
    }

    public function storeTeam($data)
    {
        return $this->teamRepository->store($data);
    }

    public function fetchTeam($id)
    {
        return $this->teamRepository->findById($id);
    }

    public function addMemberToTeam($attributes,$team_id)
    {
        return $this->teamRepository->addToTeam($attributes,$team_id);
    }
    public function removeMemberFromTeam($team_id,$member_id)
    {
        return $this->teamRepository->removeMember($team_id,$member_id);
    }
}
