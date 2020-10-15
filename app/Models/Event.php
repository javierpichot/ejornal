<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
     protected $fillable = ['title','description','start_date', 'end_date', 'start_time', 'end_time', 'user_id', 'location', 'labels', 'share_with', 'color', 'recurring', 'repeat_every', 'repeat_type', 'no_of_cycles', 'last_start_date', 'recurring_dates', 'confirmed_by', 'rejected_by', 'empresa_id', 'trabajador_id'];

     public $timestamps = false;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function trabajador() : BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function empresa() : BelongsTo
    {
        return $this->belongsTo(Empresa::class);
    }
}
