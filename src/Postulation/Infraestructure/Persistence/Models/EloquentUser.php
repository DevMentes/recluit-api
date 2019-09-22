<?php

namespace Recluit\Postulation\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentUser extends Model
{
    protected $table = "users";
    public $incrementing = false;

    public function postulations()
    {
        return $this->hasMany(EloquentPostulation::class, "created_by", "id");
    }
}