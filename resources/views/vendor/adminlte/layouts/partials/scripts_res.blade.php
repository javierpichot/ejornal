<!-- REQUIRED JS SCRIPTS -->

<!-- JQuery and bootstrap are required by Laravel 5.3 in resources/assets/js/bootstrap.js-->
<!-- Laravel App -->


<script src="{{ asset('js/app.all.js') }}?{{ rand() }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/fullcalendar.js') }}"></script>
<script src="{{ asset('js/notification_handler.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<!-- DataTables agregado -->
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js
"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js
"></script>



<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/moment/min/locales.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-tagsinput/bootstrap-tagsinput.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/general_helper.js') }}?{{ rand() }}"></script>
<script>
$(".search-menu-box").on('input', function() {
    var filter = $(this).val();
    $(".sidebar-menu > li").each(function(){
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});
function setCookie(cname, cvalue, exdays) {
    if (exdays)
        exdays = 1000;

    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

</script>
<!-- Validate -->
<script src="{{ asset('bower_components/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('bower_components/validate/localization/messages_es.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-loading/dist/jquery.loading.js') }}"></script>

<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/fileinput/fileinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/fileinput/locales/fr.js') }}" type="text/javascript"></script>
<script src="{{ asset('bower_components/fileinput/locales/es.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/summernote/dist/summernote.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.all.js" type="text/javascript"></script>
<script src="{{ asset('dist/js/demo.js') }}"></script>


    <script type="text/javascript">
            (function ($) {
                if (document.head.querySelector('meta[name="csrf-token"]')) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                } else {
                    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
                }

            })(jQuery);

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
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
