<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class AgenteRiesgoTarea extends Model
{
    protected $fillable = ['tarea_id', 'agenteriesgo_id'];

    /**
     * @var bool
     */
    public $timestamps = false;
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
    public function agenteriesgo() : BelongsTo
    {
        return $this->belongsTo(AgenteRiesgo::class);
    }
}
