<?php


namespace App\Services;


use App\Repositories\MessageRepository;

class MessageService
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function saveMessage($data,$team_id)
    {
        return $this->messageRepository->store($data,$team_id);
    }

    public function fetchMessages($team_id)
    {
        return $this->messageRepository->fetchTeamsMessages($team_id);
    }
}
