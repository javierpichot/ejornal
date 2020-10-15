@extends('layouts.app')
@section('titulo', 'Vista de Rol')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('role.index') }}">Listado de Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vista de Rol</li>
        </ol>
    </nav>

	<div class="card card-primary card-outline">
       <div class="card-header">
            <h3 class="card-title">Informaci&oacute;n General</h3>
        </div>
        <!-- /.card-header -->    
        <div class="card-body">
            <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input name="name" class="form-control" type="text" placeholder="Nombre del Rol" value="{{ $role->exists ? $role->name : '' }}" readonly="true" />
                        </div>                    
                    </div>
            </div>
        </div>
    </div>
    <br/>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    Permisologia
                </h3>
            </div>
            <!-- /.card-header -->    
            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                            <div id="tree">
                                <ul id="treeData" style="display: none;">
                                    @foreach($recurso AS $r)
                                        @if($r->recurso_padre_id == 0)
                                            <li id="id3" class="folder">{{ $r->action }}
                                              <?php $content = DB::table('recurso')->where("recurso_padre_id", $r->id)->where("view", "!=", "show")->where("view", "!=", "store")->where("view", "!=", "edit")->where("view", "!=", "destroy")->get(); ?>
                                              <ul>
                                                  <li id="index {{ $r->action }}">
                                                        index
                                                  @foreach($content AS $c)
                                                     <input type="hidden" name="action[]" value="{{ $r->action }} {{ $c->view}}"/>
                                                     <li id="{{ $c->view}} {{ $r->action }}">
                                                        {{ $c->view }}
                                                  @endforeach
                                                    <li id="read {{ $r->action }}">
                                                        read
                                              </ul>
                                        @endif 
                                    @endforeach                             
                                </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    <br/>
        <div class="row">
        	<div class="col-md-12">
        		<div class="float-right">
	        	    <a href="{{ route('role.index') }}" class="btn btn-default">
	        	    	Cancelar
	        	    </a>
	        	</div>
        	</div>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $(function(){
            $("#tree").dynatree({
                checkbox: true
            });

            $("#btnDeselectAll").click(function(){
                $("#tree").dynatree("getRoot").visit(function(node){
                    node.select(false);
                });
                return false;
            });

            $("#btnSelectAll").click(function(){
                $("#tree").dynatree("getRoot").visit(function(node){
                    node.select(true);
                });
                return false;
            });

            $("#btnCollapseAll").click(function(){
                $("#tree").dynatree("getRoot").visit(function(node){
                    node.expand(false);
                });
                return false;
            });

            $("#btnExpandAll").click(function(){
                $("#tree").dynatree("getRoot").visit(function(node){
                    node.expand(true);
                });
                return false;
            });


        });
    </script>
@endsection