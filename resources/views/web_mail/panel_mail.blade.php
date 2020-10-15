<div class="col-md-3">
          <a href="{{ route('empresa.mails.create', ['empresa_id' => $empresa->id, 'nombre' => $empresa->nombre]) }}" class="btn btn-primary btn-block margin-bottom">Redactar</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Carpetas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                @forelse ($aFolders as $key => $aFolder)
                                       <li><a href="{{ route('empresa.mails.index', ['id' => $empresa->id, 'nombre' => $empresa->nombre, 'folder' => $aFolder->fullName]) }}">

                                           @if ($aFolder->fullName == 'Sent')
                                               <i class="fa fa-file-text-o"></i>
                                               @elseif ($aFolder->fullName == 'Drafts')
                                                   <i class="fa fa-trash-o"></i>
                                               @elseif ($aFolder->fullName == 'Trash')
                                                   <i class="fa fa-envelope-o"></i>
                                               @elseif ($aFolder->fullName == 'Junk')
                                                   <i class="fa fa-filter"></i>
                                               @elseif ($aFolder->fullName == 'INBOX')
                                                   <i class="fa fa-inbox"></i>
                                           @endif

                                            {{ $aFolder->fullName }}
                                         <span class="label label-primary pull-right"> {{ $aFolder->getMessages()->count() }}</span></a></li>
                @empty

                @endforelse
              
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
      </div> <!--col-md-3-->
