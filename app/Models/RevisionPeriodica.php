<?php

namespace App\Models;

use App\User;
use App\Models\RevisionPeriodicaEntidad;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class RevisionPeriodica
 * @package App\Models
 */
class RevisionPeriodica extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['informe','fotos','nuevo_control','user_id','revision_periodica_entidad_id','revision_periodica_tipo_id','observaciones'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revision_periodica_entidad()  : BelongsTo
    {
        return $this->belongsTo(RevisionPeriodicaEntidad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function revision_periodica_tipo()  : BelongsTo
    {
        return $this->belongsTo(RevisionPeriodicaTipo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
