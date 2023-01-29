<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'team_id',
        'user_id',
        'assignee_id',
        'state'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
