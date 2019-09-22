<?php

namespace Recluit\Applications\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentApplication extends Model
{
    protected $table = "applications";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'created_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo(EloquentUser::class, "created_by", "id")->first();
    }

    public function applicants()
    {
        $related = EloquentApplicant::class;
        $foreignKey = "application_id";
        $localKey = "id";

        return $this->hasMany($related, $foreignKey, $localKey);
    }
}