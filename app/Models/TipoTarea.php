<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 18/01/19
 * Time: 04:44 AM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TipoTarea extends Model
{
    protected $table = "tipo_tareas";

    protected $fillable = ['nombre'];
}