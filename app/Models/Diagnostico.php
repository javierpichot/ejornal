<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Diagnostico
 * @package App\Models
 */
class Diagnostico extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['diagnostico', 'guia', 'tiempos','cuidados','consulta_motivo_id','user_id'];

    /**
     * @return BelongsTo
     */
    public function consulta_motivo() : BelongsTo
    {
        return $this->belongsTo(ConsultaMotivo::class);
    }

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
