<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable;


/**
 * Class Empresa
 * @package App\Models
 */
class Empresa extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * @var string
     */
    protected static $logName = 'empresa';

    /**
     * @var array
     */
    protected $auditableTypes = ['created', 'updated', 'saved', 'deleted'];

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'cuit', 'direccion', 'logo', 'caducidad', 'planes_empresa_id', 'descripcion'];

    /**
     * @var array
     */
    protected $auditInclude = ['nombre', 'cuit', 'direccion', 'logo', 'caducidad', 'descripcion'];

    /**
     * @return string
     */
    public function getLogNameToUse()
    {
        return 'custom_log';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function farmacia() : HasMany
    {
        return  $this->hasMany(PrestacionFarmaciaDroga::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documentacion_empresa() : HasMany
    {
        return $this->hasMany(DocumentacionEmpresa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoria() : HasMany
    {
        return $this->hasMany(Categoria::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sector() : HasMany
    {
        return $this->hasMany(Sector::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function turno() : HasMany
    {
        return $this->hasMany(Turno::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tarea() : HasMany
    {
        return $this->hasMany(Tarea::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function planesEmpresa() : BelongsTo
    {
        return $this->belongsTo(PlanesEmpresa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sucursal() : HasMany
    {
        return $this->hasMany(Sucursal::class);
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
    public function trabajador() : HasMany
    {
        return $this->hasMany(Trabajador::class);
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
    public function documentacion() : HasMany
    {
        return $this->hasMany(Documentacion::class);
    }

    /**
     * @return HasMany
     */
    public function prestacion_pedido() : HasMany
    {
        return $this->hasMany(PrestacionPedido::class);
    }

    /**
     * @return HasMany
     */
    public function revision_periodica_entidad() : HasMany
    {
        return $this->hasMany(RevisionPeriodicaEntidad::class);
    }

    /**
     * @return BelongsToMany
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(config('auth.model') ?: config('auth.providers.users.model'))->withTimestamps();
    }



}
