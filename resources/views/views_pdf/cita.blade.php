@extends('views_pdf.layout')

@section('content')
  <p class="mt-10" style="margin-top: 100px;">
            <div class="float-left"><img src="http://ejornal.online/img/logo.png" width="60px" height="60px"></div>
            <div class="float-right"> <img src="{{ isset($event->trabajador->empresa->logo) ? asset('storage/empresas/'. $event->trabajador->empresa->id . '/perfil/' . $event->trabajador->empresa->logo ) : asset('img/avatar5.png') }}" width="60px" height="60px"></div>
        </p>
    <div class="container" style="margin-top: 80px;">
        <p class="font-weight-normal">Estimada/o {{ ucfirst(trans($event->trabajador->nombre)) }}</p>

        <p class="text-justify">
            Con el fin de realizar el seguimiento de su proceso de incapacidad temporal y según el art. 210 de la Ley de Contrato de Trabajo, le citamos para que         en el día <strong>{{ $event ->start_date}} a las Y horas</strong> se presente a nuestro Servicio Medico situado en {{ ucfirst(trans($event->trabajador->empresa->direccion)) }} para la realización de una visita sucesiva<strong>
 aportando toda la documentación médica que disponga</strong>.

        </p>

        <p class="text-justify">
            En el caso de encontrarse incapacitado para acudir a la visita o en situación de alta médica le rogamos que se ponga en contacto con el Servicio Médico de {{ ucfirst(trans($event->empresa->nombre)) }}.


        </p>



        <p class="text-justify">
            Quedamos a su entera disposición para cualquier duda que tenga y aprovechamos la ocasión para saludarle muy atentamente.
        </p>

        <p class="mt-10" style="margin-top: 100px;">
            <div class="float-left">Firma {{ ucfirst(trans($event->trabajador->nombre)) }} {{ ucfirst(trans($event->trabajador->apellido)) }}</div>
            <div class="float-right">Firma {{ ucfirst(trans($event->user->nombre)) }} {{ ucfirst(trans($event->user->apellido)) }}</div>
        </p>
    </div>



@endsection