<?php namespace App\Traits;

use App\Exceptions\PermissionDeniedException;

use Caffeinated\Shinobi\Facades\Shinobi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Pluralizer;

/**
 *
 */
trait Authorizable
{
    /**
     * @var array
     */
    private $permissions = [
        'index' => 'index',
        'edit' => 'edit',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'create',
        'store' => 'create',
        'destroy' => 'delete'
    ];

    /**
     * [callAction description]
     * @param  [type] $method     [description]
     * @param  [type] $parameters [description]
     * @return [type]             [description]
     */
    public function callAction($method, $parameters)
    {
        $permission = $this->getPermission($method);

        if (!auth()->user()->isRole('super-admin')) {
            if(($permission && \Auth::user()->can($permission)) || !$permission)
                return parent::callAction($method, $parameters);

            if(Request::ajax()) {
                return response()->json([
                    'error' => str_slug($permission.'_not_allowed', '_'),
                    'message' => 'No tienes permisos para acceder a dicha accion'
                ], 403);
            }

            throw new PermissionDeniedException();
        } else {
            return parent::callAction($method, $parameters);
        }



    }

    /**
     * [getPermission description]
     * @param  [type] $method [description]
     * @return [type]         [description]
     */
    public function getPermission($method)
    {
        $routeName = explode('.', Request::route()->getName());

        if(!$this->action = array_get($this->getPermissions(), $method)) return null;
        return $this->action ? $routeName[0]  . '.' .$routeName[1]. '.'.str_replace('-', '.', $this->action) : null;
    }

    /**
     * [registerActionPermission description]
     * @param  [type] $action     [description]
     * @param  [type] $permission [description]
     * @return [type]             [description]
     */
    public function registerActionPermission($action, $permission) {
        $this->permissions[$action] = $permission;
    }

    /**
     * @return string
     */
    private function actionRoute() {
        return Pluralizer::singular($this->action . '-' . $this->routeName());
    }

    /**
     * @return mixed
     */
    private function routeName() {
        return explode('.', Request::route()->getName())[0];
    }

    /**
     * @return array
     */
    private function getPermissions()
    {
        return $this->permissions;
    }
}
