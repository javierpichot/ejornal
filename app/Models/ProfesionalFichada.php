<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class ProfesionalFichada
 * @package App\Models
 */
class ProfesionalFichada extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['profesional_id','empresa_id','fechahora_entrada','fechahora_salida','IP_entrada','IP_salida','navegador_entrada','navegador_salida', 'localizacion_entrada','localizacion_salida'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profesional()  : BelongsTo
    {
        return $this->belongsTo(Profesional::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()  : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }

}
