<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PrestacionFarmaciaDroga
 * @package App\Models
 */
class PrestacionFarmaciaDroga extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'via_prestacion', 'prestacion_droga_tipo_id', 'cantidad', 'fecha_caducidad', 'empresa_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestacion_droga_tipo()  : BelongsTo
    {
        return $this->belongsTo(PrestacionDrogaTipo::class);
    }

    public function consulta_prestacion_farmacia_droga()  : BelongsToMany
    {
        return $this->belongsToMany(Consulta::class, 'consulta_prestacion_farmacia_droga', 'consulta_id', 'prestacion_farmacia_droga_id');
    }
}
