<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Turno
 * @package App\Models
 */
class Turno extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'empresa_id'];
}
