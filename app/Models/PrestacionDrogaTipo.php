<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PrestacionDrogaTipo
 * @package App\Models
 */
class PrestacionDrogaTipo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombre'];
}
