<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */	
    
    protected $fillable = [
        'name', 'guard_name'
    ];
}
