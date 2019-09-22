<?php

namespace Recluit\Applications\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentApplicant extends Model
{
    protected $table = "applicants";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'surname',
        'email',
        'resume',
        'application_id'
    ];

    public function application()
    {
        $related = EloquentApplication::class;
        $foreignKey = "id";
        $localKey = "application_id";

        return $this->belongsTo($related, $foreignKey, $localKey)->first();
    }
}