<?php namespace App\Traits;

use App\Exceptions\DeniedEmpresaException;
use App\Exceptions\PermissionDeniedException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
/**
 *
 */
trait CheckEmpresaTrait
{
    public function checkEmpresa($id)
    {
        if (auth()->check()) {
            if (!auth()->user()->isEmpresa($id) && !auth()->user()->isRole('super-admin')) {
                if (request()->ajax()) {
                    return response('Usted no está autorizado para realizar acciones en esta empresa.!', 403);
                }

                abort(403, 'Usted no está autorizado para realizar acciones en esta empresa.');
            }

        }
    }
}
