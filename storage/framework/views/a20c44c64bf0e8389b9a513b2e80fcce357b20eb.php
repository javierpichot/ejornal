<!-- Profile Image -->
<div class="box box-primary" align="center">
  <div class="box-body box-profile">
    <img class="profile-user-img img-fluid img-circle" src="<?php echo e(isset($empresa->logo) ? asset('storage/empresas/'. $empresa->id . '/perfil/' . $empresa->logo ) : ''); ?>" alt="<?php echo e($empresa->nombre); ?>" width="100%">

    <h3 class="profile-username text-center"><?php echo e($empresa->nombre); ?></h3>
    <div align="center">

</div><div align="center">
  <p class="text-muted text-center">La suscripción actual contratada es <?php echo e(isset($empresa->planesEmpresa->nombre) ? $empresa->planesEmpresa->nombre : 'ORO'); ?></p>
    </div>

    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Fecha caducidad</b> <a class="float-right"><?php echo e($empresa->caducidad); ?></a>
      </li>
      <li class="list-group-item">
        <b>Usted tiene privilengios de</b> <a class="float-right"><?php echo e($user->roles->implode('name', ',')); ?></a>
      </li>
    </ul>
  </br>
</br>
</br>

</br>
<?php echo e(strtolower($user->roles->implode('slug', ','))); ?><?php echo e(strtolower($empresa->nombre)); ?></br>
</br>
</br>
</br>
</br>
</br>

  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

