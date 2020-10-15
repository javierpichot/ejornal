@extends('layouts.app')
@section('titulo', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">


           <body class="skin-blue" >
      <div align="middle" >
              <!-- header logo: style can be found in header.less -->
          <div class="alert alert-warning" align="justify" style=" font-size:20px;">
                 <div align="middle">   <h4><i class="icon fa fa-warning"></i>¡Atención!</h4></div> <br>
                Bienvenido {{ $user->nombre }}<br><br>
            El acceso a los Sistemas de Información de eJornal implica el respeto y cumplimiento de las siguientes obligaciones:
<small>
    Conocer y observar la Política de Protección de Datos y Seguridad de la Información, así como el conjunto de normas y medidas de seguridad contenidas en la normativa de Seguridad de la Información (usuarios internos) y/o aquellas establecidas en el marco de la colaboración/prestación de servicios (usuarios externos).
    Las credenciales de acceso a los Sistemas de Información son de uso personal e intransferible.
    Toda la información residente en los sistemas de información es propiedad de Asepeyo y tiene el carácter de confidencial. El acceso y tratamiento de la misma debe estar debidamente justificado y relacionado con las funciones propias del puesto de trabajo del usuario y/o el marco de colaboración/prestación del servicio.
    Preservar la confidencialidad de la Información a la se que tiene acceso por las funciones que desempeña, no divulgándola ni comunicándola a terceros no autorizados. Esta obligación se mantendrá con carácter indefinido aún habiendo finalizado la relación laboral con Asepeyo y/o la colaboración/prestación de servicios.
    Tratar la información exclusivamente conforme a la finalidad para la que fue recogida.
    Con carácter general, el uso de los recursos informáticos, incluido el acceso a Internet, se limitará a temas relacionados con la actividad de Asepeyo y las funciones inherentes al puesto de trabajo, salvo lo establecido en el Plan de Igualdad a tal efecto.
    Alertar o comunicar, a través de los canales establecidos, cualquier incidente de seguridad que se produzca.

Asepeyo informa que toda la actividad queda electrónicamente registrada pudiendo ser verificada para detectar accesos y/o tratamientos no justificados. Toda la actividad registrada será directamente imputada al usuario identificado.
En caso de vulneración de estas obligaciones, además de generar las responsabilidades que procedieran en el orden civil y/o penal, dará lugar a la exigencia de las responsabilidades e imposición de las medidas correspondientes que prevean, tanto la normativa laboral vigente, como el Convenio Colectivo de aplicación. 	</small> 
 
	 
  	


           <br>

              </div>
          <div align="middle">            <label for="notifico_documentacion" style="color:#2C306E;font-size:16px;" >Comprendo los derechos de privacidad y me responsabilizo de las acciones que se hagan desde mi perfil de usuario.</label>
            <input type="checkbox" id="notifico_documentacion" val="0" placeholder="Notifico adecuadamente" name="notifico_documentacion" class="form-control" />      </div></br><!-- /.col -->
 <div id="ocultar_legales" name="ocultar_legales" align="middle">

            <div class="row">



              @foreach ($empresas as $key => $empresa)
                  <div class="col-sm-4">
                    <div class="card">
      <a href="{{ route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )}}">
        <img class="card-img-top img"  data-src="{{ asset('img/avatar5.png')}}" src="{{ isset($empresa->logo) ? asset('/empresas/'. $empresa->id . '/'. $empresa->logo ) : '' }}" alt="{{ $empresa->nombre }}">
                       </a> <div class="card-body">
                          <h5 class="card-title">{{ $empresa->nombre }}</h5>
                          <p class="card-text">{{ $empresa->direccion }}</p>

                        </div>
                    </div>
                  </div>
              @endforeach
            </div>
</div>

        </div>
    </div>    </div>

@endsection

@section('script')
    <style media="screen">
    .card img.card-img-top {
        width:220px;
        height:220px;
        margin:0 auto;
        border-radius:50%;
        overflow:hidden;
    }
    </style>
      <script>
         $(document).ready(function(){
               $('#ocultar_legales').hide();
          $('#notifico_documentacion').click(function() {
        if (this.checked) {
            $("#ocultar_legales").show();
        } else {
            $("#ocultar_legales").hide();
        }
    });

});</script>
@endsection
