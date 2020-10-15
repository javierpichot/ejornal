<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }} - @yield('titulo')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/jquery-loading/dist/jquery.loading.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hummingbird-treeview-1.3.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <!-- DataTables agregado -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('plugins/summernote/dist/summernote.css') }}">

    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.28/dist/sweetalert2.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
    <script type="text/javascript">
        AppHelper = {};
        AppHelper.baseUrl = "";
        AppHelper.assetsDirectory = "";
        AppHelper.settings = {};
        AppHelper.settings.firstDayOfWeek = "";
        AppHelper.settings.currencySymbol =  "";
        AppHelper.settings.currencyPosition  = "";
        AppHelper.settings.decimalSeparator  = "";
        AppHelper.settings.thousandSeparator  = "";
        AppHelper.settings.noOfDecimals  = "";
        AppHelper.settings.displayLength = "";
        AppHelper.settings.timeFormat= "";
        AppHelper.settings.scrollbar = "";
        AppHelper.settings.notificationSoundVolume = "";
        AppHelper.userId = "";
    </script>

    <script type="text/javascript">
        AppLanugage = {};
        AppLanugage.locale = "";

        AppLanugage.days = "";
        AppLanugage.daysShort = "";
        AppLanugage.daysMin = "";

        AppLanugage.months = "";
        AppLanugage.monthsShort = "";

        AppLanugage.today = "";
        AppLanugage.yesterday = "";
        AppLanugage.tomorrow = "";

        AppLanugage.search = "";
        AppLanugage.noRecordFound = "";
        AppLanugage.print = "";
        AppLanugage.excel = "";
        AppLanugage.printButtonTooltip = "";

        AppLanugage.fileUploadInstruction = "";
        AppLanugage.fileNameTooLong = "";

        AppLanugage.custom = "";
        AppLanugage.clear = "";

        AppLanugage.total = "";
        AppLanugage.totalOfAllPages = "";

        AppLanugage.all = "";

    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            //load notification sound
            $("<audio></audio>").attr({
                'src':'<?php "notification.mp3"; ?>',
                'id': 'notificationPlayer',
                'type':'audio/mpeg'
            }).appendTo("body");

            //load message notifications
            var messageOptions = {},
                notificationOptions = {},
                $messageIcon = $("#message-notification-icon"),
                $notificationIcon = $("#web-notification-icon");

            //check message notifications
            messageOptions.notificationUrl = "";
            messageOptions.notificationStatusUpdateUrl = "";
            messageOptions.checkNotificationAfterEvery = "";
            messageOptions.icon = "fa-envelope-o";
            messageOptions.notificationSelector = $messageIcon;
            messageOptions.isMessageNotification=true;
            checkNotifications(messageOptions);

            window.updateLastMessageCheckingStatus=function(){
                checkNotifications(messageOptions, true);
            }

            $messageIcon.click(function () {
                checkNotifications(messageOptions, true);
            });




            //check web notifications
            notificationOptions.notificationUrl = "";
            notificationOptions.notificationStatusUpdateUrl = "";
            notificationOptions.checkNotificationAfterEvery = "";
            notificationOptions.icon = "fa-bell-o";
            notificationOptions.notificationSelector = $notificationIcon;
            notificationOptions.notificationType = "web";

            checkNotifications(notificationOptions); //start checking notification after starting the message checking


            $notificationIcon.click(function () {
                notificationOptions.notificationUrl = "";
                checkNotifications(notificationOptions, true);
            });
        });
    </script>
</head>
