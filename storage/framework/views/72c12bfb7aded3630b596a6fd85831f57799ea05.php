
<script src="<?php echo e(asset('js/plugins.js')); ?>" ></script>
<!-- DataTables -->
<script src="<?php echo e(asset('bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>" ></script>
<script src="<?php echo e(asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>" ></script>
<script src="<?php echo e(asset('plugins/bootstrap-confirmation/bootstrap-confirmation.js')); ?>" ></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js
" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" ></script>

<!--Momment-->
<script src="<?php echo e(asset('bower_components/moment/min/moment.min.js')); ?>" ></script>
<script src="<?php echo e(asset('bower_components/moment/min/locales.min.js')); ?>" ></script>
<!--DateTimePicker-->
<script src="<?php echo e(asset('bower_components/bootstrap-datetimepicker.min.js')); ?>" ></script>
<script src="<?php echo e(asset('bower_components/bootstrap-tagsinput/bootstrap-tagsinput.js')); ?>" ></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js" ></script>
<!--FileInput-->
<script src="<?php echo e(asset('bower_components/fileinput/fileinput.min.js')); ?>" ></script>
<script src="<?php echo e(asset('bower_components/fileinput/locales/fr.js')); ?>" ></script>
<script src="<?php echo e(asset('bower_components/fileinput/locales/es.js')); ?>" ></script>

<script src="<?php echo e(asset('plugins/dropzone/dropzone.min.js')); ?>"></script>

<!--Tag input-->
<script src="<?php echo e(asset('bower_components/bootstrap-tagsinput/bootstrap-tagsinput.js')); ?>" ></script>
<!--Mask-->
<script src="<?php echo e(asset('js/jquery.mask.min.js')); ?>" ></script>
<!--Select2-->
<script src="<?php echo e(asset('bower_components/select2/dist/js/select2.full.min.js')); ?>" ></script>
<!--Toastr-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
<!-- Validate -->
<script src="<?php echo e(asset('bower_components/validate/jquery.validate.min.js')); ?>" ></script>
<script src="<?php echo e(asset('bower_components/validate/localization/messages_es.min.js')); ?>" ></script>

<!--Summernote-->
<script src="<?php echo e(asset('plugins/summernote/dist/summernote.js')); ?>" ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.all.js" ></script>


<script src="<?php echo e(asset('plugins/fullcalendar/fullcalendar.min.js')); ?>" ></script>
<script src="<?php echo e(asset('plugins/fullcalendar/lang-all.js')); ?>" ></script>
<script src="<?php echo e(asset('plugins/bootstrap-confirmation/bootstrap-confirmation.js')); ?>" ></script>

<!--Notificaciones-->
<script src="<?php echo e(asset('js/notification_handler.js')); ?>" ></script>

<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>" ></script>
<script src="<?php echo e(asset('dist/js/demo.js')); ?>" ></script>
<script src="<?php echo e(asset('js/app.js')); ?>" ></script>

<script type="text/javascript">
    
    $.AdminLTESidebarTweak = {};

    $.AdminLTESidebarTweak.options = {
        EnableRemember: true,
        NoTransitionAfterReload: true
        //Removes the transition after page reload.
    };


    $(function () {
        "use strict";
        $(document).ajaxStart(function(){
            $(':button[type="submit"]').prop('disabled', true);
            $(':button[type="button"]').prop('disabled', true);
        });
        $(document).ajaxStop(function(){
            $(':button[type="submit"]').prop('disabled', false);
            $(':button[type="button"]').prop('disabled', false);
        });


        $("body").on("collapsed.pushMenu", function() {
            if($.AdminLTESidebarTweak.options.EnableRemember) {
                localStorage.setItem("toggleState", "closed");
            }
        });

        $("body").on("expanded.pushMenu", function() {
            if($.AdminLTESidebarTweak.options.EnableRemember) {
                localStorage.setItem("toggleState", "opened");
            }
        });

        if ($.AdminLTESidebarTweak.options.EnableRemember) {
            var toggleState = localStorage.getItem("toggleState");
            if (toggleState == 'closed'){
                if ($.AdminLTESidebarTweak.options.NoTransitionAfterReload) {
                    $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function() {
                        $(this).removeClass('hold-transition');
                    });
                } else {
                    $("body").addClass('sidebar-collapse');
                }
            }
        }
    });
</script>
