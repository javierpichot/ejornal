<?php

namespace App\Mail;

use App\Models\Empresa;
use App\Models\Proveedor;
use App\Models\Trabajador;
use App\Models\PrestacionPedido;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationMedicoDomicilio extends Mailable
{
    use Queueable, SerializesModels;

    protected $proveedor;

    protected $empresa;

    protected $trabajadors;
    protected $prestacion_pedido;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Proveedor $proveedor, Empresa $empresa, Trabajador $trabajador, PrestacionPedido $prestacion_pedido, $url)
    {
         $this->proveedor = $proveedor;
         $this->empresa = $empresa;
         $this->trabajador = $trabajador;
         $this->prestacion_pedido = $prestacion_pedido;
         $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.medico.domicilio')->with([
                        'proveedor' => $this->proveedor,
                        'empresa' => $this->empresa,
                        'trabajador' => $this->trabajador,
                        'prestacion_pedido' => $this->prestacion_pedido,
                        'url' => $this->url
                    ]);
    }
}
