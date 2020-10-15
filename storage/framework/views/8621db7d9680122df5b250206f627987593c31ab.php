<?php if(Session::has('alert')): ?>
	<?php $__env->startPush('script-message'); ?>
		<script type="text/javascript">
			$(function() {
				toastr.success("<?php echo e(Session::get('alert')); ?>", 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
			});
		</script>
	<?php $__env->stopPush(); ?>
<?php endif; ?>
