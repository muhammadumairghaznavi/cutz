<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{$copyright}} | @yield('title_page')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{--
    <!-- Bootstrap 3.3.7 -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/skin-blue.min.css') }}">
      <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('dashboard/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/js/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE-rtl.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/rtl.css') }}">

    <link rel="stylesheet" href="{{ asset('dashboard/js/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/js/datatables.net-bs/js/dataTables.bootstrap.min.js') }}">
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cairo', sans-serif !important;
        }

    </style>
    @else
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('dashboard/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/AdminLTE.min.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('dashboard/css/tarek.css') }}">

    <style>
        .mr-2 {
            margin-right: 5px;
        }

    </style>
    {{--
    <!-- jQuery 3 -->--}}
    <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/noty/noty.css') }}">
    <script src="{{ asset('dashboard/plugins/noty/noty.min.js') }}"></script>
    {{--
    <!-- iCheck -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/icheck/all.css') }}">
    {{--html in ie--}}
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>




    {{--
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> --}}


    <!-- include summernote css/js -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['mybutton', ['myVideo']] // custom button
                ],

                buttons: {
                    myVideo: function (context) {
                        var ui = $.summernote.ui;
                        var button = ui.button({
                            contents: '<i class="fa fa-video-camera"/>',
                            tooltip: 'video',
                            click: function () {
                                var div = document.createElement('div');
                                div.classList.add('embed-container');
                                var iframe = document.createElement('iframe');
                                iframe.src = prompt('Enter video url:');
                                iframe.setAttribute('frameborder', 0);
                                iframe.setAttribute('width', '100%');
                                iframe.setAttribute('allowfullscreen', true);
                                div.appendChild(iframe);
                                context.invoke('editor.insertNode', div);
                            }
                        });

                        return button.render();
                    }
                }
            });
        });

    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{url('/')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>{{$copyright_left_bar}} </b>{{$copyright_right_bar}}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>{{$copyright}}</b>Admin</span>
            </a>
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                             @include('layouts.dashboard._bar_notification')













                        {{--<!-- Tasks: style can be found in dropdown.less -->--}}
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    {{--<!-- inner menu: contains the actual data -->--}}
                                    <ul class="menu">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode =>
                                        $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>



                        {{--<!-- User Account: style can be found in dropdown.less -->--}}
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('dashboard/img/user2-160x160.jpg') }}" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs">{{ auth()->user()->first_name }}
                                    {{ auth()->user()->last_name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                {{--<!-- User image -->--}}
                                <li class="user-header">
                                    <img src="{{ asset('dashboard/img/user2-160x160.jpg') }}" class="img-circle"
                                        alt="User Image">
                                    <p>
                                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                        <small>Member since 2 days</small>
                                    </p>
                                </li>
                                {{--<!-- Menu Footer-->--}}
                                <li class="user-footer">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">@lang('site.logout')</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        @include('layouts.dashboard._aside')


        @yield('content')

        @include('partials._session')
        <footer class="main-footer no-print">
            <div class="pull-right hidden-xs">
                <b>Developed by </b> <a href="{{$copyright_website}}" target="_blank">{{$copyright}}</a>
            </div>
            <strong>Copyright &copy;
                <?=date("Y");?>
                <a href="{{$copyright_website}}" target="_blank">{{$copyright}}</a>.</strong> All rights
            reserved.
        </footer>
    </div><!-- end of wrapper -->
    {{--
<!-- Bootstrap 3.3.7 -->--}}
    <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('dashboard/js/select2.full.min.js') }}"></script>

    {{--icheck--}}
    <script src="{{ asset('dashboard/plugins/icheck/icheck.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('dashboard/js/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/datatables.net-bs//js/dataTables.bootstrap.min.js') }}"></script>
    {{--
<!-- FastClick -->--}}
    <script src="{{ asset('dashboard/js/fastclick.js') }}"></script>
    {{--
<!-- AdminLTE App -->--}}
    <script src="{{ asset('dashboard/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('dashboard/js/tarek.js') }}"></script>
    <!-- page script -->

    

    <script>
        $(function () {
            $('.select2').select2();
            $('#example1').DataTable();
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        })

    </script>
    <script>
        $(function () {
            $("#data_table").DataTable();
        });

    </script>

    <script>
        $(document).ready(function () {

            ////////////
            $('.sidebar-menu').tree();
            //icheck
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            //delete
            $('.delete').click(function (e) {
                var that = $(this)
                e.preventDefault();
                var n = new Noty({
                    text: "@lang('site.confirm_delete')",
                    type: "warning",
                    killer: true,
                    buttons: [
                        Noty.button("  &nbsp;&nbsp;&nbsp;  @lang('site.yes')",
                            ' btn btn-danger mr-2 fa fa-trash ',
                            function () {
                                that.closest('form').submit();
                            }),
                        Noty.button(" &nbsp;&nbsp;&nbsp;  @lang('site.no')   ",
                            'btn btn-primary mr-2 fa fa-close',
                            function () {
                                n.close();
                            })
                    ]
                });
                n.show();
            }); //end of delete
            // image preview
            $(".image").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $(".imageTwo").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-previewtwo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $(".image2").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview2').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $(".image3").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview3').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
            $(".image4").change(function () {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.image-preview4').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        })

    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor4');

    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('f9cf2eb9e16b16abaf33', {
            cluster: 'ap3'
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function (data) {
            alert(JSON.stringify(data));
        });

    </script>
    <script src="{{ asset('dashboard/js/pusherNotifications.js') }}"></script>


    <script src="{{ asset('dashboard/js/selection/bootstrap-select.min.js') }}"></script>
    <script>
        $('.myselect').selectpicker();

    </script>




</body>

</html>
