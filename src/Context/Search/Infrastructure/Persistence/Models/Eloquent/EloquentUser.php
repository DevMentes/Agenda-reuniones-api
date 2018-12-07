<?php

namespace Babilonia\Context\Search\Infrastructure\Persistence\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    public $table = 'users';

    public $incrementing = false;

    public $timestamps = false;
}