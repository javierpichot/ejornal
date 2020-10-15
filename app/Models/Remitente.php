<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Remitente
 * @package App\Models
 */
class Remitente extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = ['nombre'];
}
