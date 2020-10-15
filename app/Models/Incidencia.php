<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Incidencia
 * @package App\Models
 */
class Incidencia extends Model  implements Auditable
{
    use SoftDeletes,  \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['trabajador_id', 'fecha', 'tipo', 'descripcion', 'articulo', 'empresa_id', 'user_id', 'consulta_id', 'lugar', 'sector', 'tarea', 'maquinaria_herramientas', 'proteccion', 'tipo_lesion_id', 'forma_accidente_id', 'ubicacion_lesion_id', 'testigos', 'causas', 'fotos_lesion', 'fotos_accidente', 'examen_medico', 'perimetria_medica', 'declaracion_escrita', 'numero_art', 'derivacion', 'declaracion_supervision', 'declaracion_testigos', 'fotos_escenario', 'acciones_inmediatas', 'acciones_correctivas', 'tipo_incidencia_id'];

    /**
     * @var array
     */
    protected $auditEvents = [
        'created',
        'updated',
        'deleted',
        'restored',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_incidencia() : BelongsTo
    {
        return $this->belongsTo(TipoIncidencia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ubicacion_lesion() : BelongsTo
    {
        return $this->belongsTo(UbicacionLesion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forma_accidente() : BelongsTo
    {
        return $this->belongsTo(FormaAccidente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_lesion() : BelongsTo
    {
        return $this->belongsTo(TipoLesion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajador() : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consulta() : BelongsTo
    {
        return $this->belongsTo(Consulta::class);
    }

}
