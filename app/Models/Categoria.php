<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 * @package App\Models
 */
class Categoria extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'empresa_id'];
    /**
     * @var array
     */
    protected static $logAttributes = ['nombre', 'empresa_id'];
}
