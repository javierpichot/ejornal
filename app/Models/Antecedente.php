<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Antecedente
 * @package App\Models
 */
class Antecedente extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['trabajador_id', 'enfermedad_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enfermedad() : BelongsTo
    {
        return $this->belongsTo(Enfermedad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trabajador() : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
