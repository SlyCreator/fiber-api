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
        return $this->teamRepository->findById();
    }

    public function storeTeam($data)
    {
        return $this->teamRepository->store($data);
    }

    public function fetchTeam($id)
    {
        return $this->teamRepository->findById($id);
    }

}
