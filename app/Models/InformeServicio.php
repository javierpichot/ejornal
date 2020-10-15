<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class InformeServicio
 * @package App\Models
 */
class InformeServicio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['prestacion_pedido_id', 'informe_servicio', 'informe_servicio_url', 'feedback'];

    /**
     * @return BelongsTo
     */
    public function prestacion_pedido() : BelongsTo
    {
        return $this->belongsTo(PrestacionPedido::class);
    }
}
