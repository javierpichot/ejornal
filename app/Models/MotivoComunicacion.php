<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MotivoComunicacion
 * @package App\Models
 */
class MotivoComunicacion extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comunicacion() : BelongsToMany
    {
        return $this->hasMany(Comunicacion::class);
    }
}
