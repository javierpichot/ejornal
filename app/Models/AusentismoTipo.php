<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AusentismoTipo
 * @package App\Models
 */
class AusentismoTipo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombre'];
    /**
     * @var array
     */
    protected static $logAttributes = ['nombre'];
    /**
     * [ausentismo description]
     * @return [type] [description]
     */
    public function ausentismo()
    {
        return $this->hasMany(Ausentismo::class);
    }
}
