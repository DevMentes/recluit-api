<?php

namespace Recluit\Applications\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table = "users";
    public $incrementing = false;

    public function applications()
    {
        return $this->hasMany(EloquentApplication::class, "created_by", "id");
    }
}