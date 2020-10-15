@extends('adminlte::layouts.app')

@section('main-content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">2FA Secret Key</div>

                <div class="panel-body">
                    Escanea el QR barcode desde tu smarphone:
                    <br />
                    <img alt="Image of QR barcode" src="{{ $image }}" />

                    <br />
                    Si el QR barcodes no funciona,
                    introduce esta serie de digitos en tu smartphone: <code>{{ $secret }}</code>
                    <br /><br />
                    <a href="{{ url('/home') }}">Ir al inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
