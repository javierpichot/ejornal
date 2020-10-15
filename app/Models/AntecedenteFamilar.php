<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AntecedenteFamilar
 * @package App\Models
 */
class AntecedenteFamilar extends Model implements Auditable
{
    use  \OwenIt\Auditing\Auditable;
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
