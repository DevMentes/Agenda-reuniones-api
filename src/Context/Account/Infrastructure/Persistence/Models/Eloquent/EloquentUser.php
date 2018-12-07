<?php

namespace Babilonia\Context\Account\Infrastructure\Persistence\Models\Eloquent;

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
}