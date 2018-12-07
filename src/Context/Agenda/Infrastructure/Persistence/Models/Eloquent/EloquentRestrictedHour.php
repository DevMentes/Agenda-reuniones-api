<?php

namespace Babilonia\Context\Agenda\Infrastructure\Persistence\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentRestrictedHour extends Model
{
    public $table = 'restricted_hours';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'weekday',
        'start_at',
        'finish_at',
    ];

    public function users()
    {
        return $this->belongsToMany(EloquentUser::class, 'restricted_hour_user', 'restricted_hour_id', 'user_id');
    }
}