<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Sucursal
 * @package App\Models
 */
class Sucursal extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'direccion', 'empresa_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
}
