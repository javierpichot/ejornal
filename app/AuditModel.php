<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Models\Audit;

class AuditModel extends Audit
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
