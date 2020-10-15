<!-- Profile Image -->
<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img class="profile-user-img img-fluid img-circle" src="{{ asset('img/empresa/'. $empresa->logo )}}" alt="{{ $empresa->nombre }}">
    </div>

    <h3 class="profile-username text-center">{{ $empresa->nombre }}</h3>

    <p class="text-muted text-center">La suscripción actual contratada es {{ $empresa->planesEmpresa->nombre or ''}}</p>

    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Fecha caducidad</b> <a class="float-right">{{ $empresa->caducidad }}</a>
      </li>
      <li class="list-group-item">
        <b>Usted tiene privilengios de</b> <a class="float-right">e</a>
      </li>
    </ul>

  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
