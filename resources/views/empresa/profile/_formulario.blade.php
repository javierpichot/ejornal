<div class="col-md-4">
    <div class="file-loading">
        <input id="logo" name="logo" type="file">
    </div>
</div>

<div class="col-md-8">
    <div class="row">
        <div class="col-md-6 col-sm-12 {{ $errors->has('nombre') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('nombre', "Nombre empresa") }}
                {{ Form::text('nombre',  isset($empresa) ? $empresa->nombre : null, ['class' => 'form-control box-size', 'placeholder' => "Carrefour", 'required' => 'required']) }}
                @if ($errors->has('nombre'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 col-sm-12 {{ $errors->has('cuit') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('cuit', "Cuit") }}
                {{ Form::text('cuit',  isset($empresa) ? $empresa->cuit : null, ['class' => 'form-control box-size', 'placeholder' => "12864535", 'required' => 'required']) }}
                @if ($errors->has('cuit'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cuit') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 col-sm-12 {{ $errors->has('direccion') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('direccion', "Direccion") }}
                {{ Form::textarea('direccion',  isset($empresa) ? $empresa->direccion : null, ['class' => 'form-control box-size', 'placeholder' => "Camino cintura 7700", 'required' => 'required']) }}
                @if ($errors->has('direccion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('direccion') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="col-md-6 col-sm-12 {{ $errors->has('nombre_categoria') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('categoria', "Categoria") }}
                <br>
                {{ Form::text('nombre_categoria', isset($empresa) ? implode(",", $empresa->categoria()->pluck('nombre')->toArray()) : null, ['class' => 'form-control categorias', 'placeholder' => "Sin convenio, A1", 'required' => 'required']) }}
                @if ($errors->has('nombre_categoria'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre_categoria') }}</strong>
                    </span>
                @endif
            </div>
        </div>



        <div class="col-md-6 col-sm-12 {{ $errors->has('nombre_sector') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('sector', "Sector") }}
                {{ Form::text('nombre_sector', isset($empresa) ? implode(",", $empresa->sector()->pluck('nombre')->toArray()) : null, ['class' => 'form-control box-size sectors', 'placeholder' => "Producción, Administración", 'required' => 'required']) }}
                @if ($errors->has('nombre_sector'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre_sector') }}</strong>
                    </span>
                @endif
            </div>
        </div>


        <div class="col-md-6 col-sm-12 {{ $errors->has('nombre_turno') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('turnos', "Turno") }}
                <br>
                {{ Form::text('nombre_turno', isset($empresa) ? implode(",", $empresa->turno()->pluck('nombre')->toArray()) : null, ['class' => 'form-control box-size turnos', 'placeholder' => "Mañana, Tarde, Noche", 'required' => 'required']) }}
                @if ($errors->has('nombre_turno'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre_turno') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 col-sm-12 {{ $errors->has('nombre_tarea') ? ' has-error' : '' }}">
            <div class="form-group">
                {{ Form::label('tareas', "Tareas") }}
                {{ Form::text('nombre_tarea', isset($empresa) ? implode(",", $empresa->tarea()->pluck('nombre')->toArray()) : null, ['class' => 'form-control box-size tareas', 'placeholder' => "Supervisor, Maquinista, Operador", 'required' => 'required']) }}
                @if ($errors->has('nombre_tarea'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre_tarea') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-4 {{ $errors->has('caducidad') ? ' has-error' : '' }}">
                <div class="form-group" id="caducidad">
                        {{ Form::label('caducidad', "Caducidad") }}
                        <div class="input-group date">
                            <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                            {{ Form::text('caducidad',  isset($empresa) ? $empresa->caducidad : null, ['class' => 'form-control box-size', 'placeholder' => "Caducidad de la empresa", 'required' => 'required']) }}
                        </div>
                        <label id="orden_date-error" class="error" for="orden_date"></label>
                        @if ($errors->has('caducidad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('caducidad') }}</strong>
                            </span>
                        @endif
                    </div>
        </div>
    </div>
</div>
