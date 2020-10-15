@extends('adminlte::layouts.app')
@section('titulo', 'Vista de Empresa')

@section('main-content')
	 <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('admin.empresa.index') }}">Listado de Empresas</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $empresa->nombre }}</li>
        </ol>
    </nav>
	<div class="row">
		<div class="col-md-3">
			@include('backend.empresa.partials.panel')
		</div>

		  <div class="col-md-9">
			  <div class="card">
			  	@include('backend.empresa.partials.nav_menu_empresa')
			  </div>
		  </div>
	</div>
@endsection
