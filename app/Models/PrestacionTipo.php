<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class PrestacionTipo
 * @package App\Models
 */
class PrestacionTipo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $tipos = [
        'e' => 'Empresa',
        't' => 'Trabajador'
    ];

    public function getTipos()
    {
        return $this->tipos;
    }

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'tipo'];
}
