<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message_type',
        'content',
        'member_id',
        'member_name',
        'team_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
