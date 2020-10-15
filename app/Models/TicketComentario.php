<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class TicketComentario
 * @package App\Models
 */
class TicketComentario extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    /**
     * @var array
     */
    protected $fillable = ['ticket_id', 'user_id', 'comentarios'];

    /**
     * @return BelongsTo
     */
    public function user()  : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
