<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AusentismoAccidente
 * @package App\Models
 */
class AusentismoAccidente extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['denunciante', 'nart', 'direccion', 'telefono', 'medico', 'observacion'];
}
