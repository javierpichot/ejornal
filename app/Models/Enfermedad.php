<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Enfermedad
 * @package App\Models
 */
class Enfermedad extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'tipo'];
}
