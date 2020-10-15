<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'recurso';

    protected $fillable = [
        'action', 'view', 'url', 'recurso_padre_id', 'visible', 'estatus'
    ];
}
