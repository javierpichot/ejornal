<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Profesional
 * @package App\Models
 */
class Profesional extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['nombre','apellido','email','celular','nombre_familiar','user_id','celular_familiar','direccion','localidad_id','observacion_direccion','numero_obra_social','obra_social_id','observacion_supervision','observacion_facturacion','photo','user_id','profesional_tipo_id','foto_titulo','documento','foto_documento','poliza','foto_matricula','foto_seguro','numero_matricula' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profesional_tipo()  : BelongsTo
    {
        return $this->belongsTo(ProfesionalTipo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users() : BelongsTo
    {
        return $this->belongsTo(User::class);
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

    public function profesiona_fichada() : HasMany
    {
        return $this->hasMany(ProfesionalFichada::class);
    }

}
