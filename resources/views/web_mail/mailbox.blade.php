@extends('adminlte::layouts.app')
@section('titulo', 'Gestion de prestaciones de '. $empresa->nombre)


@section('menu-empresa')
    @include('empresa.partials.menu_empresa', ['empresa' => $empresa])
@endsection

@section('main-content')
    <div class="row">
        @include('web_mail.panel_mail', ['aFolders' => $aFolders])

              <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Buzón de entrada</h3>

              <div class="box-tools pull-right">
                <!--<div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Buscar email">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>-->
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">

                <div class="pull-right">
                {{ $messages->links()}}
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @forelse ($messages as $key => $oMessage)

                      <tr>
                          <td>
                              <div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                              </div>
                          </td>
                          <td class="mailbox-name">
                              <a href="{{ route('empresa.mail.show', ['id' =>  $empresa->id, 'nombre' => $empresa->nombre, 'folder' => $folder, 'message_id' => $oMessage->getUid()])}}">{{ $oMessage->getSubject() }}</a></td>
                          <td class="mailbox-subject">

                          </td>
                          <td class="mailbox-attachment">{{ $oMessage->getFrom()[0]->mail }}</td>
                          <td>
                              @if($oMessage->getAttachments()->count() > 0)
                                  <i class="fa fa-paperclip"></i>
                              @endif
                          </td>


                      </tr>
                  @empty
                      <div class="alert alert-warning alert-dismissible"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button> <h4><i class="icon fa fa-info"></i> Alerta!</h4>
                          No tienes mensajes aun
                      </div>
                  @endforelse



                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <div class="pull-right">
                    {{ $messages->links()}}
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>



    </div>
@endsection
