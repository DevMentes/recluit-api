<?php

namespace Recluit\Security\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table = "users";

    public $timestamps = false;
    protected $fillable = [
        'email',
        'password'
    ];
}