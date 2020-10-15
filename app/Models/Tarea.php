<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Tarea
 * @package App\Models
 */
class Tarea extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'empresa_id'];

    /**
     * @return BelongsToMany
     */
    public function agente_riesgo_tarea() : BelongsToMany
    {
        return $this->belongsToMany(AgenteRiesgo::class);
    }
}
