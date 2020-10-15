<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Support\Facades\Auth;


/**
 * Class ImpersonateController
 * @package App\Http\Controllers\Backend
 */
class ImpersonateController extends Controller
 {
    /**
     * ImpersonateController constructor.
     */
    public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function impersonate($id)
     {
         $user = User::findOrFail($id);
         auth()->user()->impersonate($user);

         return redirect('/home');
     }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function stopImpersonate()
     {
         auth()->user()->leaveImpersonation();

         return redirect('/home');
     }
 }
