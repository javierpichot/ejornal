<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmpresaUser extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['user_id', 'empresa_id'];
}
