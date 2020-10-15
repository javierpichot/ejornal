<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Trabajador
 * @package App\Models
 */
class Trabajador extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'apellido', 'fecha_nacimiento', 'documento', 'numero_afiliado', 'celular', 'telefono', 'direccion', 'localidad', 'email', 'photo', 'observacion_direccion', 'fecha_contrato', 'empresa_id', 'sucursal_id', 'obra_social_id', 'localidad_id', 'sector_id', 'numero_legajo', 'turno_id', 'tarea_id', 'import_created'];


    /**
     * @return HasMany
     */
    public function documentacion() : HasMany
    {
        return $this->hasMany(Documentacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consulta_control() : HasMany
    {
        return $this->hasMany(ConsultaControl::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sector() : BelongsTo
    {
        return $this->belongsTo(Sector::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function turno() : BelongsTo
    {
        return $this->belongsTo(Turno::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tarea() : BelongsTo
    {
        return $this->belongsTo(Tarea::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function localidad() : BelongsTo
    {
        return $this->belongsTo(Localidad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function obra_social() : BelongsTo
    {
        return $this->belongsTo(ObraSocial::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sucursal() : BelongsTo
    {
        return $this->belongsTo(Sucursal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function antecedente_medico() : HasMany
    {
        return $this->hasMany(Antecedente::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function antecedente_familiar() : HasMany
    {
        return $this->hasMany(AntecedenteFamilar::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estilo_vida() : HasMany
    {
        return $this->hasMany(EstiloVida::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function familiar() : HasOne
    {
        return $this->hasOne(TrabajadorFamiliar::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticket() : HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comunicacion() : HasMany
    {
        return $this->hasMany(Comunicacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidencia() : HasMany
    {
        return $this->hasMany(Incidencia::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ausentismo() : HasMany
    {
        return $this->hasMany(Ausentismo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consulta() : HasMany
    {
        return $this->hasMany(Consulta::class);
    }

    /**
     * @return HasMany
     */
    public function prestacion_pedido() : HasMany
    {
        return $this->hasMany(PrestacionPedido::class);
    }
}
