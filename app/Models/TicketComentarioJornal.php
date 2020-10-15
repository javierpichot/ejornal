<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 17/01/19
 * Time: 07:41 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TicketComentarioJornal
 * @package App\Models
 */
class TicketComentarioJornal extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['tickets_jornal_id', 'user_id', 'comentarios'];

    /**
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}