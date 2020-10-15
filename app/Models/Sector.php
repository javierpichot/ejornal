<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sector
 * @package App\Models
 */
class Sector extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'empresa_id'];
}
