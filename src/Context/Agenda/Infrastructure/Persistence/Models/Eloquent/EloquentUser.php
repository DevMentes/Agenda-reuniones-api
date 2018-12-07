<?php

namespace Babilonia\Context\Agenda\Infrastructure\Persistence\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    public $table = 'users';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'surnames',
        'email',
        'password'
    ];

    public function meetings()
    {
        return $this->belongsToMany(EloquentMeeting::class, 'meeting_user', 'user_id', 'meeting_id');
    }

    public function restrictedHours()
    {
        return $this->hasMany(EloquentRestrictedHour::class, 'user_id');
    }
}