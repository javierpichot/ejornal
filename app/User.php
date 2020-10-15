<?php

namespace App;

use App\Models\Empresa;
use App\Models\Event;
use App\Models\Profesional;
use App\Models\ProfesionalFichada;

use App\Models\TicketsJornal;
use App\Traits\Messagable;
use Caffeinated\Shinobi\Traits\ShinobiTrait;

use Carbon\Carbon;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Lab404\Impersonate\Models\Impersonate;


class User extends Authenticatable
{
    use Notifiable, ShinobiTrait, Impersonate, Messagable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'telefono', 'is_empresa', 'nombre', 'apellido', 'photo', 'password_email', 'email_imap'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password'
    ];

    protected $appends = [
        'ficho_entrada'
    ];
    /**
     * [empresas description]
     * @return [type] [description]
     */
    public function empresas()
    {
        return $this->belongsToMany(Empresa::class)->withTimestamps();
    }
    /**
     * [isEmpresa description]
     * @param  [type]  $id [description]
     * @return boolean     [description]
     */
    public function isEmpresa($id)
    {
        foreach ($this->empresas as $empresa) {
            if ($empresa->id == $id) {
                return true;
            }
        }

        return false;
    }
    /**
     * [empresaVencimiento description]
     * @return [type] [description]
     */
    public function empresaVencimiento()
    {
        $fecha_actual = Carbon::now()->format('Y-m-d');
        foreach ($this->empresas as $empresa) {

            if ($empresa->caducidad <= $fecha_actual) {
                return false;
            }
            return true;
        }
    }
    /**
     * [profesional description]
     * @return [type] [description]
     */
    public function profesional()
    {
       return $this->hasOne(Profesional::class);
    }
    /**
     * [getRole description]
     * @return [type] [description]
     */
    public function getRole()
    {
        if (!is_null($this->roles)) {
            return $this->roles->pluck('id')->first();
        }
    }
    /**
     * [getRoleName description]
     * @return [type] [description]
     */
    public function getRoleName()
    {
        if (!is_null($this->roles)) {
            return $this->roles->pluck('name')->first();
        }
    }
    /**
     * [getRoleSlug description]
     * @return [type] [description]
     */
    public function getRoleSlug()
    {
        if (!is_null($this->roles)) {
            return $this->roles->pluck('slug')->first();
        }
    }
    public function getFichoEntradaAttribute()
    {
        if (isset(auth()->user()->profesional)) {
            $ficho = ProfesionalFichada::where('profesional_id', auth()->user()->profesional['id'])->whereDay('fechahora_entrada', Carbon::now()->day)->first();
            if (isset($ficho)) {
                if ($ficho->fechahora_entrada != null && $ficho->fechahora_salida == null) {
                    return true;
                }

                if ($ficho->fechahora_entrada == null && $ficho->fechahora_salida == null) {
                    return false;
                }
            }

            if (empty($ficho)) {
                return false;
            }
        }

    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }

    public function ticket_jornal()
    {
        return $this->hasMany(TicketsJornal::class);
    }




}
