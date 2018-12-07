<?php

namespace Babilonia\Context\Agenda\Infrastructure\Persistence\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentMeeting extends Model
{
    public $table = 'meetings';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'date',
        'start_at',
        'finish_at',
    ];

    public function users()
    {
        return $this->belongsToMany(EloquentUser::class, 'meeting_user', 'meeting_id', 'user_id');
    }
}