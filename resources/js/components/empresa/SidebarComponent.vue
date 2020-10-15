<template>
    <div>
        <!-- Profile Image -->
        <div class="box box-primary" align="center">
            <div class="box-body box-profile">
                <img class="profile-user-img img-fluid img-circle" src="" width="100%">

                <h3 class="profile-username text-center">{{ empresa.name }}</h3>
                <div align="center">

                </div>
                <div align="center">
                    <p class="text-muted text-center">La suscripción actual contratada es </p>
                </div>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Fecha caducidad</b> <a class="float-right"></a>
                    </li>
                    <li class="list-group-item">
                        <b>Usted tiene privilengios de</b> <a class="float-right"></a>
                    </li>
                </ul>
        

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
</template>

<script>
export default {
    props: {
        logo: String,
        empresa: String,
        fecha_caducidad: String,
        role: String,
        suscripcion: String,
        empresa_admin: String
    }
}
</script>

