@if(Session::has('alert'))
	@push('script-message')
		<script type="text/javascript">
			$(function() {
				toastr.success("{{Session::get('alert')}}", 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
			});
		</script>
	@endpush
@endif
