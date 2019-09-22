<?php

namespace Recluit\Postulation\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentPostulant extends Model
{
    protected $table = "postulants";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'surname',
        'email',
        'resume',
        'postulation_id'
    ];

    public function postulation()
    {
        $related = EloquentPostulation::class;
        $foreignKey = "id";
        $localKey = "postulation_id";

        return $this->hasOne($related, $foreignKey, $localKey);
    }
}