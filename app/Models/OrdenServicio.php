<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class OrdenServicio
 * @package App\Models
 */
class OrdenServicio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['prestacion_pedido_id', 'orden_servicio', 'orden_servicio_url'];
}
