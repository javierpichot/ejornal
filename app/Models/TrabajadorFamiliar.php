<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class TrabajadorFamiliar
 * @package App\Models
 */
class TrabajadorFamiliar extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['trabajador_id', 'nombre_familiar', 'celular_familiar', 'carga_familiar'];

    /**
     * @var string
     */
    protected $primaryKey = 'trabajador_id';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajador()  : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
