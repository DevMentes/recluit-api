<?php

namespace Recluit\Postulation\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentPostulation extends Model
{
    protected $table = "postulations";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title'
    ];

    public function createdBy()
    {
        return $this->hasOne(EloquentUser::class, "id", "created_by");
    }

    public function postulants()
    {
        $related = EloquentPostulant::class;
        $foreignKey = "organization_id";
        $localKey = "id";

        return $this->hasMany($related, $foreignKey, $localKey);
    }
}