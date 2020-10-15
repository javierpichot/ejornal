<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ConsultaMotivo
 * @package App\Models
 */
class ConsultaMotivo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * @return HasMany
     */
    public function diagnostico() : HasMany
    {
        return $this->hasMany(Diagnostico::class);
    }

    public function ausentismo()
    {
        return $this->hasMany(Ausentismo::class);
    }
}
