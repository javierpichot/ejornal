<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PrestacionPresupuesto
 * @package App\Models
 */
class PrestacionPresupuesto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['prestacion_pedido_id', 'prestacion_id', 'prestacion_tipo_id', 'proveedor_id', 'presupuesto', 'presupuesto_url', 'observaciones',  'aprobado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestacion_pedido() : BelongsTo
    {
        return $this->belongsTo(PrestacionPedido::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestacion() : BelongsTo
    {
        return $this->belongsTo(Prestacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestacion_tipo() : BelongsTo
    {
        return $this->belongsTo(PrestacionTipo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proveedor() : BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

}
