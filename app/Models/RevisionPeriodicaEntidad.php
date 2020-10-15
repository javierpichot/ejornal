<?php

namespace App\Models;

use App\User;

use Caffeinated\Shinobi\Models\Role;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class RevisionPeriodicaEntidad
 * @package App\Models
 */
class RevisionPeriodicaEntidad extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['empresa_id', 'nombre', 'foto', 'frecuencia', 'role_id', 'descripcion', 'observaciones', 'user_id', 'estado', 'tipo_tarea_id'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function revision_periodica() : HasMany
    {
        return $this->hasMany(RevisionPeriodica::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_tarea() : BelongsTo
    {
        return $this->belongsTo(TipoTarea::class);
    }
}
