<?php namespace App\ViewComposers;

use Illuminate\Contracts\View\View;
use Webklex\IMAP\Client;

class ImapComposer
{

    public function compose(View $view)
    {
        if (isset($view->empresa)) {
            $rol = auth()->user()->getRoleSlug();
            $cuenta = $rol.strtolower($view->empresa->nombre)."@ejornal.com.ar";
            $pass = $rol.strtolower($view->empresa->nombre);

            $oClient = new Client([
                'host'          => 'ejornal.com.ar',
                'port'          => 993,
                'encryption'    => 'ssl',
                'validate_cert' => false,
                'username'      => $cuenta,
                'password'      => $pass,
                'protocol'      => 'imap'
            ]);
            //Connect to the IMAP Server
            $oClient->connect();
            $oFolder = $oClient->getFolder('INBOX');
            $oStatus = $oFolder->query()->leaveUnread()->unseen()->get();
            $view->with(['oStatus' => $oStatus]);
        }
       
    }
}

