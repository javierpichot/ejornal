<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 17/01/19
 * Time: 03:26 PM
 */

namespace App\Models;


use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketsJornal extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'motivo', 'observacion', 'status', 'accion_user_id'];
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
    public function accion_user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comentario() : HasMany
    {
        return $this->hasMany(TicketComentarioJornal::class);
    }



    /**
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class)->withPivot('role_id');
    }

    /**
     * @param string $value
     */
    public function role_ticket($roleId = null)
    {
        foreach ( $this->roles as $role) {
            if ($role->id == $roleId) {
                return true;
            }
        }

        return false;
    }


    /**
     * @param null $roleId
     * @return bool|void
     */
    public function assignRole($roleId = null)
    {
        $roles = $this->roles;

        if (!$roles->contains($roleId)) {
            return $this->roles()->attach($roleId);
        }

        return false;
    }

    /**
     * Revokes the given role from the permission.
     *
     * @param int $roleId
     *
     * @return bool
     */
    public function revokeRole($roleId = '')
    {
        return $this->roles()->detach($roleId);
    }

    /**
     * Syncs the given role(s) with the permission.
     *
     * @param array $roleIds
     *
     * @return bool
     */
    public function syncRoles(array $roleIds = [])
    {
        return $this->roles()->sync($roleIds);
    }

    /**
     * Revokes all roles from the permission.
     *
     * @return bool
     */
    public function revokeAllRoles()
    {
        return $this->roles()->detach();
    }
}