<?php $__env->startSection('htmlheader_title'); ?>
	<?php echo e(trans('adminlte_lang::message.home')); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('main-content'); ?>
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<div align="middle" >
		                <!-- header logo: style can be found in header.less -->
		            <div class="alert alert-warning" align="justify" style=" font-size:20px;">
		                   <div align="middle">   <h4><i class="icon fa fa-warning"></i>¡Atención!</h4></div> <br>Recibe nuestra bienvenida <?php echo e($user->nombre); ?><br><br>

	   
Jornal informa que toda la actividad queda electrónicamente registrada pudiendo ser verificada para detectar accesos y/o tratamientos no justificados. Toda la actividad registrada será directamente imputada al usuario identificado.</br></br>
     	<small>             
                <li>Conocer y observar la Política de Protección de Datos y Seguridad de la Información, así como el conjunto de normas y medidas de seguridad contenidas en la normativa de Seguridad de la Información (usuarios internos) y/o aquellas establecidas en el marco de la colaboración/prestación de servicios (usuarios externos).</li>
    <li> Las credenciales de acceso a los Sistemas de Información son de uso personal e intransferible.
      Toda la información residente en los sistemas de información es propiedad de Jornal y tiene el carácter de confidencial. El acceso y tratamiento de la misma debe estar debidamente justificado y relacionado con las funciones propias del puesto de trabajo del usuario y/o el marco de colaboración/prestación del servicio. </li>    <li> Preservar la confidencialidad de la Información a la se que tiene acceso por las funciones que desempeña, no divulgándola ni comunicándola a terceros no autorizados. Esta obligación se mantendrá con carácter indefinido aún habiendo finalizado la relación laboral con Jornal y/o la colaboración/prestación de servicios.</li>
    <li> Tratar la información exclusivamente conforme a la finalidad para la que fue recogida.
    Con carácter general, el uso de los recursos informáticos, incluido el acceso a Internet, se limitará a temas relacionados con la actividad de Jornal y las funciones inherentes al puesto de trabajo, salvo lo establecido en el Plan de Igualdad a tal efecto.
   </li><li> Alertar o comunicar, a través de los canales establecidos, cualquier incidente de seguridad que se produzca.</li></br>
        
</small>
        
En caso de vulneración de estas obligaciones, además de generar las responsabilidades que procedieran en el orden civil y/o penal, dará lugar a la exigencia de las responsabilidades e imposición de las medidas correspondientes que prevean, tanto la normativa laboral vigente. 	         <br>
		                </div>
		            <div align="middle">

                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="notifico_documentacion"> Comprendo los derechos de privacidad y me responsabilizo de las acciones que se hagan desde mi perfil de usuario.
                      </label>
                    </div>
                  </div>
 </div></br><!-- /.col -->
		   <div id="ocultar_legales" name="ocultar_legales" align="middle">

		              <div class="row">



		                <?php $__currentLoopData = $empresas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $empresa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                    <div class="col-sm-4">
		                      <div class="card">
		        <a href="<?php echo e(route('empresa.show', ['id' => $empresa->id, 'name' => $empresa->nombre] )); ?>">                   <img data-src="<?php echo e(asset('img/avatar5.png')); ?>" class="card-img-top img" src="<?php echo e(asset('storage/empresas/'. $empresa->id . '/perfil/'. $empresa->logo)); ?>" alt="<?php echo e($empresa->nombre); ?>">
		                         </a> <div class="card-body">
		                            <h5 class="card-title"><?php echo e($empresa->nombre); ?></h5>
		                            <p class="card-text"><?php echo e($empresa->direccion); ?></p>

		                          </div>
		                      </div>
		                    </div>
		                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		              </div>
		  </div>

		          </div>

			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <style media="screen">
    .card img.card-img-top {
        width:220px;
        height:220px;
        margin:0 auto;
        border-radius:50%;
        overflow:hidden;
    }
    </style>
      <script>
         $(document).ready(function(){
               $('#ocultar_legales').hide();
          $('#notifico_documentacion').click(function() {
        if (this.checked) {
            $("#ocultar_legales").show();
        } else {
            $("#ocultar_legales").hide();
        }
    });

});</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>