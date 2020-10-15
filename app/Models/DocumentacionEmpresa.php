<?php
/**
 * Created by PhpStorm.
 * User: vdjke
 * Date: 9/17/2018
 * Time: 10:47 a.m.
 */

namespace App\Models;


use App\User;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use UrlSigner;
/**
 * Class DocumentacionEmpresa
 * @package App\Models
 */
class DocumentacionEmpresa extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'url','user_id', 'documentacion_empresa_tipo_id', 'empresa_id'];

    /**
     * @var array
     */
    protected $auditEvents = [
        'created',
        'updated',
        'deleted',
        'restored',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documentacion_empresa_tipo() : BelongsTo
    {
        return $this->belongsTo(DocumentacionEmpresaTipo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
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
