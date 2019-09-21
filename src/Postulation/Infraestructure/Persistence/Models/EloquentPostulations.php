<?php

namespace Recluit\Postulation\Infraestructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentPostulations extends Model
{
    protected $table = "postulations";
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'created_by'
    ];

    public function createdBy()
    {
        return $this->hasOne(EloquentUser::class, "id", "created_by");
    }
}