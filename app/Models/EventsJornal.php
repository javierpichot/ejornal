<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 17/01/19
 * Time: 02:49 PM
 */

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventsJornal extends Model
{
    protected $fillable = ['title','description','start_date', 'end_date', 'start_time', 'end_time', 'user_id', 'location', 'labels', 'share_with', 'color', 'recurring', 'repeat_every', 'repeat_type', 'no_of_cycles', 'last_start_date', 'recurring_dates', 'confirmed_by', 'rejected_by'];

    public $timestamps = false;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}