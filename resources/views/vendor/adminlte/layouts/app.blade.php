<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

@section('htmlheader')
    @include('adminlte::layouts.partials.htmlheader')
@show
<script src="{{ asset('js/dev.js') }}"></script>
<script>
    window.empresa = @isset($empresa) @json($empresa) @endisset;
    window.user_id = @json(auth()->user()->id);
</script>
@stack('styles')
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
@section('scripts')
    @include('adminlte::layouts.partials.scripts')
@show

<div class="wrapper">

  @include('adminlte::layouts.partials.mainheader')

  @include('adminlte::layouts.partials.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Main content -->
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
      </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  @include('adminlte::layouts.partials.controlsidebar')

  @include('adminlte::layouts.partials.footer')

</div><!-- ./wrapper -->


@include('adminlte::layouts.message')
@stack('script-message')

@stack('script')
@include('messenges.chat.index')
@include('vendor.adminlte.layouts.partials.modal_index')
</body>
</html>
