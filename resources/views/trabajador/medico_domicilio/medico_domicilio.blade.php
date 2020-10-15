<!DOCTYPE html>
<html lang="else" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} - @yield('titulo')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/jquery-loading/dist/jquery.loading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hummingbird-treeview-1.3.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- DataTables agregado -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/summernote/dist/summernote.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
  </head>
  <body class="skin-blue layout-top-nav">
    <div id="app" v-cloak>
        <div class="wrapper">

          <!-- Main Header -->
          <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('/home') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">        <img src="http://nossle.ejornal.online/logo.png" width="40px" height="40px">
        </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">eJornal</span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">

            </nav>
        </header>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{ $trabajador->nombre }} {{ $trabajador->apellido }}</h3>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="{{ ($trabajador->photo!="") ? asset('storage/empresas/'. $trabajador->empresa_id . '/trabajadores/' . $trabajador->id . '/perfil/'. $trabajador->photo ) : asset('img/trabajador/avatar.png' ) }}" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <h3 class="text-center">Direccion: {{ $prestacion->descripcion }}</h3>
                <h3 class="text-center">Telefono: {{ $trabajador->telefono or 'No posee'}} Celular: {{ $trabajador->celular or 'No posee'}}</h3>
              </div>

              <div class="row">
                <h4 class="text-center">Documento: {{ $trabajador->documento }} Legajo: {{ $trabajador->numero_legajo or 'No posee'}}</h4>
                <h4 class="text-center">Observaciones: {{ $prestacion->observaciones }}</h4>
              </div>

{{ Form::model($prestacion, ['route' => ['medico.domicilio.store', $prestacion->id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm', 'enctype' => 'multipart/form-data'])
}}
<input type="hidden" name="prestacion_id" value="{{ $prestacion->id }}">
<input type="hidden" name="trabajador_id" value="{{ $trabajador->id }}">
              <div class="row">

                  <div class="col-md-12 mb-3">
                      {{ Form::label('reporte', "Informe") }}
                      {{ Form::textarea('reporte', null, ['class' => 'form-control box-size', 'placeholder' => "Informe medico a domicilio"]) }}
                      @if ($errors->has('reporte'))
                          <span class="help-block">
                              <strong>{{ $errors->first('reporte') }}</strong>
                          </span>
                      @else
                          <span class="help-block" id="observacion"></span>
                      @endif
                  </div>




              </div>


              <div class="row">

                  <div class="col-md-12 mb-3">
                      {{ Form::label('feedback', "Feedback") }}
                      {{ Form::text('feedback', null, ['class' => 'form-control box-size', 'placeholder' => "Feedback"]) }}
                      @if ($errors->has('feedback'))
                          <span class="help-block">
                              <strong>{{ $errors->first('feedback') }}</strong>
                          </span>
                      @else
                          <span class="help-block" id="feedback"></span>
                      @endif
                  </div>




              </div>

              <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="file-loading">
                        <input id="reporte_url" name="reporte_url[]" type="file" multiple>
                    </div>
                </div>

                <br>


              </div>

              <div class="row">
                <div class="col-md-12" style="margin-top:50px">
                  <button type="submit" class="btn btn-primary pull-right">Guardar informe</button>
                </div>
              </div>

              {!! Form::close() !!}
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        @include('adminlte::layouts.partials.controlsidebar')

        @include('adminlte::layouts.partials.footer')



      </div><!-- ./wrapper -->
      </div>

      @section('scripts')
          @include('adminlte::layouts.partials.scripts')
      @show
      @include('adminlte::layouts.message')
      @stack('script-message')
      @stack('script')
      <script type="text/javascript">
          $('#reporte_url').fileinput({
                  previewTemplates: 'file-preview-pdf',
                  initialPreviewFileType: 'pdf',
                  theme: 'fa',
                  language: 'es',
                  uploadUrl: '#',
                  allowedFileExtensions:  ['jpg', 'png', 'gif','jpeg'],
                  browseClass: "btn btn-primary btn-block",
                  showCaption: false,
                  showRemove: false,
                  showUpload: false,

          });
      </script>

      </body>
      </html>
