<!DOCTYPE html>
<html dir="<?php echo e(LaravelLocalization::getCurrentLocaleDirection()); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php echo e($copyright); ?> | <?php echo $__env->yieldContent('title_page'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/bootstrap.min.css')); ?>">
        <link src="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/ionicons.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/skin-blue.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/frontend/assets/fonts/fontello-icons.css">
      <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/select2.min.css')); ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/js/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <?php if(app()->getLocale() == 'ar'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/font-awesome-rtl.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/AdminLTE-rtl.min.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/bootstrap-rtl.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/rtl.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('dashboard/js/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/js/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>">

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
    <?php else: ?>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/AdminLTE.min.css')); ?>">
    <?php endif; ?>

    <link rel="stylesheet" href="<?php echo e(asset('dashboard/css/tarek.css')); ?>">

    <style>
        .mr-2 {
            margin-right: 5px;
        }

    </style>
    
    <script src="<?php echo e(asset('dashboard/js/jquery.min.js')); ?>"></script>
    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/plugins/noty/noty.css')); ?>">
    <script src="<?php echo e(asset('dashboard/plugins/noty/noty.min.js')); ?>"></script>
    
    <link rel="stylesheet" href="<?php echo e(asset('dashboard/plugins/icheck/all.css')); ?>">
    
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>







    


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
            <a href="<?php echo e(url('/')); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><?php echo e($copyright_left_bar); ?> </b><?php echo e($copyright_right_bar); ?></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b><?php echo e($copyright); ?></b>Admin</span>
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
                             <?php echo $__env->make('layouts.dashboard._bar_notification', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>













                        
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-flag-o"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    
                                    <ul class="menu">
                                        <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode =>
                                        $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a rel="alternate" hreflang="<?php echo e($localeCode); ?>"
                                                href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
                                                <?php echo e($properties['native']); ?>

                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>



                        
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo e(asset('dashboard/img/user2-160x160.jpg')); ?>" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs"><?php echo e(auth()->user()->first_name); ?>

                                    <?php echo e(auth()->user()->last_name); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                
                                <li class="user-header">
                                    <img src="<?php echo e(asset('dashboard/img/user2-160x160.jpg')); ?>" class="img-circle"
                                        alt="User Image">
                                    <p>
                                        <?php echo e(auth()->user()->first_name); ?> <?php echo e(auth()->user()->last_name); ?>

                                        <small>Member since 2 days</small>
                                    </p>
                                </li>
                                
                                <li class="user-footer">
                                    <a href="<?php echo e(route('logout')); ?>" class="btn btn-default btn-flat"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><?php echo app('translator')->getFromJson('site.logout'); ?></a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"
                                        style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php echo $__env->make('layouts.dashboard._aside', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('partials._session', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <footer class="main-footer no-print">
            <div class="pull-right hidden-xs">
                <b>Developed by </b> <a href="<?php echo e($copyright_website); ?>" target="_blank"><?php echo e($copyright); ?></a>
            </div>
            <strong>Copyright &copy;
                <?=date("Y");?>
                <a href="<?php echo e($copyright_website); ?>" target="_blank"><?php echo e($copyright); ?></a>.</strong> All rights
            reserved.
        </footer>
    </div><!-- end of wrapper -->
    
    <script src="<?php echo e(asset('dashboard/js/bootstrap.min.js')); ?>"></script>
    <!-- Select2 -->
    <script src="<?php echo e(asset('dashboard/js/select2.full.min.js')); ?>"></script>

    
    <script src="<?php echo e(asset('dashboard/plugins/icheck/icheck.min.js')); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo e(asset('dashboard/js/datatables/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/js/datatables.net-bs//js/dataTables.bootstrap.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('dashboard/js/fastclick.js')); ?>"></script>
    
    <script src="<?php echo e(asset('dashboard/js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/plugins/ckeditor/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('dashboard/js/tarek.js')); ?>"></script>
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
                    text: "<?php echo app('translator')->getFromJson('site.confirm_delete'); ?>",
                    type: "warning",
                    killer: true,
                    buttons: [
                        Noty.button("  &nbsp;&nbsp;&nbsp;  <?php echo app('translator')->getFromJson('site.yes'); ?>",
                            ' btn btn-danger mr-2 fa fa-trash ',
                            function () {
                                that.closest('form').submit();
                            }),
                        Noty.button(" &nbsp;&nbsp;&nbsp;  <?php echo app('translator')->getFromJson('site.no'); ?>   ",
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
    <script src="<?php echo e(asset('dashboard/js/pusherNotifications.js')); ?>"></script>


    <script src="<?php echo e(asset('dashboard/js/selection/bootstrap-select.min.js')); ?>"></script>
    <script>
        $('.myselect').selectpicker();

    </script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });
    $(document).ready(function(){
        $('.js-switch').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let reviewId = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '<?php echo e(route('dashboard.review.update.status')); ?>',
                data: {'status': status, 'review_id': reviewId},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                }
            });
        });
    });
</script>

</body>

</html>
