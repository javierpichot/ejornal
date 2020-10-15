<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Calendario
 * @package App\Models
 */
class Calendario extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['fecha_feriado', 'tipo', 'nombre'];
}
