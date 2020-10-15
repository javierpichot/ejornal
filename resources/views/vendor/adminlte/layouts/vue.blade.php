<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'Laravel') }} - @yield('titulo')</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">

        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script src="{{ asset('js/dev.js') }}?{{ rand() }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
        <script>
            window.empresa = @isset($empresa) @json($empresa) @endisset;
            window.user_id = @json(auth()->user()->id);
        </script>
        
    </head>
    

@stack('styles')
<style>
    .swal2-confirm {
        margin-left: 10px;
    }
    .swal2-cancel {
        margin-right: 10px;
    }
</style>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">


  @include('adminlte::layouts.partials.mainheader')

  @include('adminlte::layouts.partials.sidebar')

  <div class="content-wrapper">
      <section class="content">
          @yield('main-content')
          <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Plazo vencido</h5>
                      </div>
                      <div class="modal-body">
                          La empresa ya no cuenta con un plan para su uso en nuestra web
                      </div>
                  </div>
              </div>
          </div>
      </section>
  </div>
</div>
<script src="{{ asset('js/sweetalert2.all.js') }}" ></script>

@stack('script-message')

@stack('script')
</body>
</html>
