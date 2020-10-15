<!-- Profile Image -->
<div class="box box-primary" align="center">
  <div class="box-body box-profile">
    <img class="profile-user-img img-fluid img-circle" src="{{ isset($empresa->logo) ? asset('storage/empresas/'. $empresa->id . '/perfil/' . $empresa->logo ) : '' }}" alt="{{ $empresa->nombre }}" width="100%">

    <h3 class="profile-username text-center">{{ $empresa->nombre }}</h3>
    <div align="center">

</div><div align="center">
  <p class="text-muted text-center">La suscripción actual contratada es {{ $empresa->planesEmpresa->nombre or 'ORO'}}</p>
    </div>

    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Fecha caducidad</b> <a class="float-right">{{ $empresa->caducidad }}</a>
      </li>
      <li class="list-group-item">
        <b>Usted tiene privilengios de</b> <a class="float-right">{{ $user->roles->implode('name', ',') }}</a>
      </li>
    </ul>
  </br>
</br>
</br>

</br>
{{ strtolower($user->roles->implode('slug', ',')) }}{{strtolower($empresa->nombre)}}</br>
</br>
</br>
</br>
</br>
</br>

  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
{{-- <sidebar-component logo="{{ $empresa->logo }}" role="{{ strtolower($user->roles->implode('slug', ',')) }}" fecha_caducidad="{{ $empresa->caducidad }}" empresa="{{ $empresa->nombre }}" suscripcion="{{ $empresa->planesEmpresa->nombre or 'ORO'}}" empresa_admin="{{ strtolower($user->roles->implode('slug', ',')) }}{{strtolower($empresa->nombre)}}"></sidebar-component> --}}
