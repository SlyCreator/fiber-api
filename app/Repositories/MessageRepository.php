<?php


namespace App\Repositories;


use App\Models\Member;
use App\Models\Message;
use App\Models\Team;

class MessageRepository
{
    protected $message,$team;

    public function __construct(Message $message,Team $team)
    {
        $this->message = $message;
        $this->team = $team;
    }

    public function store($data,$team_id)
    {
        $team = Team::find($team_id);
        abort_if(!$team,404,'Team not found');

        $member = $team->members()->whereEmail(auth()->user()->email)
                    ->first();
        $data['member_id']=$member->id;
        $data['member_name'] = $member->name;
        return $team->messages()->create($data);
    }

    public function fetchTeamsMessages($team_id)
    {
        $team = Team::find($team_id);
        abort_if(!$team,404,'Team not found');
        $request = \Request::all();
        $value= ((isset($request['limit']))?$request['limit']:10);
        return Message::where('team_id',$team_id)->paginate($value);
    }

}
