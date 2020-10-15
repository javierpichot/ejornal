<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Proveedor
 * @package App\Models
 */
class Proveedor extends Model implements Auditable
{
    use Notifiable, \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'prestacion_tipo_id', 'email', 'telefono'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestacion_tipo()  : BelongsTo
    {
        return $this->belongsTo(PrestacionTipo::class);
    }
}
