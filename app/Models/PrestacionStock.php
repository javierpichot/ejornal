<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PrestacionStock
 * @package App\Models
 */
class PrestacionStock extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['prestacion_farmacia_droga_id', 'cantidad', 'caducidad', 'empresa_id'];
}
