<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Documentacion
 * @package App\Models
 */
class Documentacion extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */

    protected $fillable = [
        'url',
        'fecha',
        'fecha_entrega',
        'fecha_incorporacion',
        'fecha_documento',
        'observacion',
        'diagnostico',
        'institucion',
        'medico',
        'notifico',
        'matricula_nacional',
        'matricula_provincial',
        'trabajador_id',
        'user_id',
        'ausentismo_id',
        'consulta_id',
        'comunicacion_id',
        'documentacion_tipo_id',
        'fecha_baja',
        'empresa_id',
        'reposo'
    ];
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
     * @var array
     */
    protected $auditInclude = [
        'url',
        'fecha',
        'fecha_entrega',
        'fecha_incorporacion',
        'fecha_documento',
        'observacion',
        'diagnostico',
        'institucion',
        'medico',
        'notifico',
        'matricula_nacional',
        'matricula_provincial',
        'trabajador_id',
        'user_id',
        'ausentismo_id',
        'consulta_id',
        'comunicacion_id',
        'documentacion_tipo_id',
        'fecha_baja',
        'empresa_id',
        'reposo'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajador() : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    /**
     * @return BelongsTo
     */
    public function turno() : BelongsTo
    {
        return $this->belongsTo(Turno::class);
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
    public function ausentismo() : BelongsTo
    {
        return $this->belongsTo(Ausentismo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function consulta() : BelongsTo
    {
        return $this->belongsTo(Consulta::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comunicacion() : BelongsTo
    {
        return $this->belongsTo(Comunicacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentacion_tipo() : BelongsTo
    {
        return $this->belongsTo(DocumentacionTipo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
}
