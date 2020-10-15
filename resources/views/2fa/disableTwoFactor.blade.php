@extends('adminlte::layouts.app')

@section('main-content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">2FA Secret Key</div>

                <div class="panel-body">
                    2FA ha sido remivido
                    <br /><br />
                    <a href="{{ url('/home') }}">Ir al inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
