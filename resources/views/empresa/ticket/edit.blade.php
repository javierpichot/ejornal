@if(isset($ticket))
    {{ Form::model($ticket, ['route' => ['empresa.ticket-empresa.update', $ticket->id, $ticket->empresa_id], 'role' => 'form', 'method' => 'PATCH', 'id' => 'frm'])
    }}
@else
    {!! Form::open(['id'=>'frm']) !!}
@endif

<div class="modal-header">
    <h5 class="modal-title">{{isset($ticket)?'Editar':'Crear nuevo'}} ticket</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12 col-sm-12">
                @foreach ($roles as $key => $role)
                    <div class="custom-control custom-checkbox">
                        {{ Form::checkbox('roles[]', $role->id, null, ['class' => "custom-control-input", 'id' => "customCheck".$role->id ]) }}
  <label class="custom-control-label" for="customCheck{{ $role->id }}">{{ $role->name }}</label>
</div>
                @endforeach
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-sm-12 {{ $errors->has('motivo') ? ' has-error' : '' }}">
        	<div class="form-group">
        		{{ Form::label('motivo', "Motivo") }}
        		{{ Form::text('motivo',  isset($ticket) ? $ticket->motivo : null, ['class' => 'form-control box-size', 'placeholder' => "Hipertensión arterial", 'required' => 'required']) }}
        		@if ($errors->has('motivo'))
        			<span class="help-block">
        				<strong>{{ $errors->first('motivo') }}</strong>
        			</span>
        		@endif
        	</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 {{ $errors->has('observacion') ? ' has-error' : '' }}">
        	<div class="form-group">
        		{{ Form::label('observacion', "Observacion") }}
        		{{ Form::textarea('observacion',  isset($ticket) ?$ticket->observacion : null, ['class' => 'form-control box-size', 'placeholder' => "Hipertensión arterial", 'required' => 'required']) }}
        		@if ($errors->has('observacion'))
        			<span class="help-block">
        				<strong>{{ $errors->first('observacion') }}</strong>
        			</span>
        		@endif
        	</div>
        </div>
    </div>
</div>


<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    {!! Form::submit("Guardar ticket",["class"=>"btn btn-primary"])!!}
</div>
