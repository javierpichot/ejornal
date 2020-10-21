<?php $__env->startPush('styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fullcalendar/fullcalendar.css')); ?>">
<?php $__env->stopPush(); ?>





<?php $__env->startSection('main-content'); ?>


	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page">Gerencia de Jornal</li>
	</ol>
</nav>
 <div class="row">
   <div class="col-xs-12">
     <div class="box box-primary">

    

    <!-- Main content -->

              <div class="box-header with-border">
                  <h4 class="box-title">Gerencia de Jornal</h4>
                  <div class="pull-right">
                      <a href="#" class="btn btn-default" title="Add event" data-post-client_id="" data-act="ajax-modal" data-title="Agregar evento" data-action-url="<?php echo e(route('events_jornal.modal_form')); ?>"><i class="fa fa-plus-circle"></i> Añadir evento</a>
                      <a href="#" class="hide" id="add_event_hidden" title="Añadir evento" data-post-client_id="" data-act="ajax-modal" data-title="Agregar evento" data-action-url="<?php echo e(route('events_jornal.modal_form')); ?>"></a>
                      <a href="#" class="hide" id="show_event_hidden" data-post-client_id="" data-post-cycle="0" data-post-editable="1" title="Detalles de evento" data-act="ajax-modal" data-title="Detalles de evento" data-action-url="<?php echo e(route('events_jornal.view')); ?>" data-post-id=""></a>
                      <a href="#" class="hide" data-post-id="" id="show_leave_hidden" data-act="ajax-modal" data-title="Detalles de evento" data-action-url="<?php echo e(route('events_jornal.show')); ?>"></a>

                  </div>
              </div>
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
                <div id="event-calendar"></div>
            </div>
            <!-- /.box-body -->
          <!-- /. box -->

      <!-- /.row -->
    <!-- /.content -->
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script'); ?>


    <script type="text/javascript">
        $(document).ready(function () {

            $("#event-calendar").fullCalendar({
                lang: "es",
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: "/events_jornal/calendar_events",
                dayClick: function (date, jsEvent, view) {
                    $("#add_event_hidden").attr("data-post-start_date", date.format("YYYY-MM-DD"));
                    var startTime = date.format("HH:mm:ss");
                    if (startTime === "00:00:00") {
                        startTime = "";
                    }
                    $("#add_event_hidden").attr("data-post-start_time", startTime);
                    var endDate = date.add(1, 'hours');

                    $("#add_event_hidden").attr("data-post-end_date", endDate.format("YYYY-MM-DD"));
                    var endTime = "";
                    if (startTime != "") {
                        endTime = endDate.format("HH:mm:ss");
                    }
                    $("#add_event_hidden").attr("data-post-end_time", endTime);
                    $("#add_event_hidden").trigger("click");


                },
                eventClick: function (calEvent, jsEvent, view) {
                    $("#show_event_hidden").attr("data-post-id", calEvent.encrypted_event_id);
                    $("#show_event_hidden").attr("data-post-cycle", calEvent.cycle);
                    $("#show_leave_hidden").attr("data-post-id", calEvent.encrypted_event_id);

                    if (calEvent.event_type === "event") {
                        $("#show_event_hidden").trigger("click");
                    } else {
                        $("#show_leave_hidden").trigger("click");
                    }

                    $('#start_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        locale: 'es-us'
                    });

                    $('#end_date').datetimepicker({
                        format: 'YYYY-MM-DD',
                        locale: 'es-us'
                    });

                    $('#start_time').datetimepicker({
                        format: 'YYYY-MM-DD',
                        locale: 'es-us'
                    });

                    $('#end_time').datetimepicker({
                        format: 'YYYY-MM-DD',
                        locale: 'es-us'
                    });
                },
                eventRender: function (event, element) {
                    if (event.icon) {
                        element.find(".fc-title").prepend("<i class='fa " + event.icon + "'></i> ");
                    }
                },
                firstDay: ''

            });

            var client = "<?php echo auth()->user()->id; ?>";
            if (client) {
                setTimeout(function () {
                    $('#event-calendar').fullCalendar('today');
                });
            }


            //autoload the event popover
            var encrypted_event_id = "";

            if (encrypted_event_id) {
                $("#show_event_hidden").attr("data-post-id", encrypted_event_id);
                $("#show_event_hidden").trigger("click");
            }

            $(document).on('submit', 'form#frm', function (event) {
                event.preventDefault();
                var form = $(this);
                var data = new FormData($(this)[0]);
                var url = form.attr("action");
                $.ajax({
                    type: form.attr('method'),
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        toastr.success(data.text, 'Operacion exitosa', {timeOut: 5000, icon: 'success'})
                        $('.is-invalid').removeClass('is-invalid');
                        $('#ajaxModal').modal('hide');
                        setTimeout(function() {
                            window.location.reload(data.redirect_url);
                        }, 3000);
                    },
                    error: function(jqXhr, json, errorThrown){
                        var errors = jqXhr.responseJSON;
                        var errorsHtml = '';

                        for (control in errors['errors']) {
                            var inputField = $('[name=' + control + ']');
                            var parentDiv = inputField.closest('.form-group');
                            // apply has-error class
                            parentDiv.addClass('has-error');
                            $('input[name=' + control + ']').addClass('is-invalid');
                            console.log(errors['errors'][control][0]);
                            $('span#' + control).html(errors['errors'][control][0]);
                        }
                    }
                });
                return false;
            });


        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('adminlte::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>