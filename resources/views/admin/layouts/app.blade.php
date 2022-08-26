<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Extratech | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
{{--    {{ Html::favicon(\App\Models\Setting::where('slug','favicon')->first()->value) }}--}}
{!! Html::style('admin/plugins/fontawesome-free/css/all.min.css') !!}
<!-- Ionicons -->
    {!! Html::style('admin/css/ionicons/2.0.1/css/ionicons.min.css') !!}
    <!-- Tempusdominus Bootstrap 4 -->
{{--    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">--}}
{!! Html::style('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') !!}

<!-- iCheck -->
{{--    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
{!! Html::style('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}

<!-- JQVMap -->
{{--    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">--}}
{!! Html::style('admin/plugins/jqvmap/jqvmap.min.css') !!}
<!-- Theme style -->
{{--    <link rel="stylesheet" href="dist/css/adminlte.min.css">--}}
{!! Html::style('admin/dist/css/adminlte.min.css') !!}
<!-- overlayScrollbars -->
{{--    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">--}}
{!! Html::style('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') !!}
<!-- Daterange picker -->
{{--    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">--}}
{!! Html::style('admin/plugins/daterangepicker/daterangepicker.css') !!}
<!-- summernote -->
    {{--    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">--}}
    {!! Html::style('admin/plugins/summernote/summernote-bs4.min.css') !!}
    {!! Html::style('admin/flatpickr/dist/flatpickr.min.css') !!}
    <script>
        Laravel = {
            'url': '{{url("")}}'
        }
    </script>
    {!! Html::style('admin/css/custom-admin.css') !!}

@yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@include('admin.layouts.menubar')
@yield('content')
@include('admin.layouts.footer')


<!-- jQuery -->
{{--<script src="plugins/jquery/jquery.min.js"></script>--}}
{!! Html::script('admin/plugins/jquery/jquery.min.js') !!}
<!-- jQuery UI 1.11.4 -->
{{--<script src="plugins/jquery-ui/jquery-ui.min.js"></script>--}}
{!! Html::script('admin/plugins/jquery-ui/jquery-ui.min.js') !!}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
{{--<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{!! Html::script('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
<!-- ChartJS -->
{{--<script src="plugins/chart.js/Chart.min.js"></script>--}}
{!! Html::script('admin/plugins/chart.js/Chart.min.js') !!}
<!-- Sparkline -->
{{--<script src="plugins/sparklines/sparkline.js"></script>--}}
{!! Html::script('admin/plugins/sparklines/sparkline.js') !!}
<!-- JQVMap -->
{{--<script src="plugins/jqvmap/jquery.vmap.min.js"></script>--}}
{!! Html::script('admin/plugins/jqvmap/jquery.vmap.min.js') !!}
{{--<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>--}}
{!! Html::script('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') !!}
<!-- jQuery Knob Chart -->
{{--<script src="plugins/jquery-knob/jquery.knob.min.js"></script>--}}
{!! Html::script('admin/plugins/jquery-knob/jquery.knob.min.js') !!}
<!-- daterangepicker -->
{{--<script src="plugins/moment/moment.min.js"></script>--}}
{!! Html::script('admin/plugins/moment/moment.min.js') !!}
{{--<script src="plugins/daterangepicker/daterangepicker.js"></script>--}}
{!! Html::script('admin/plugins/daterangepicker/daterangepicker.js') !!}
<!-- Tempusdominus Bootstrap 4 -->
{{--<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}
{!! Html::script('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') !!}
<!-- Summernote -->
{{--<script src="plugins/summernote/summernote-bs4.min.js"></script>--}}
{!! Html::script('admin/plugins/summernote/summernote-bs4.min.js') !!}
<!-- overlayScrollbars -->
{{--<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>--}}
{!! Html::script('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') !!}
<!-- AdminLTE App -->
{{--<script src="dist/js/adminlte.js"></script>--}}
{!! Html::script('admin/dist/js/adminlte.js') !!}
<!-- AdminLTE for demo purposes -->
{{--<script src="dist/js/demo.js"></script>--}}
{!! Html::script('admin/dist/js/demo.js') !!}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="dist/js/pages/dashboard.js"></script>--}}
{!! Html::script('admin/dist/js/pages/dashboard.js') !!}
{!! Html::script('admintheme/tinymce/tinymce.min.js') !!}
{!! Html::script('admin/flatpickr/dist/flatpickr.js') !!}
{!! Html::style('admin/css/custom-admin.css') !!}



<script>
    $(".getDate").flatpickr({
        dateFormat: "Y-m-d"
    });

    $(".myDate").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });


    function filterList() {
        debugger;

        var baseurl = window.location.origin+window.location.pathname;
        window.location = baseurl+'?'+$('#search').serialize();
    }

    function initTinymce() {
        tinymce.init({ selector:'.content',
            height: 500,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{url('')}}/uploadimage',
            // here we add custom filepicker only to Image dialog
            file_picker_types: 'image',
            file_browser_callback_types: 'file image media',

            // and here's our custom image picker
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                // Note: In modern browsers input[type="file"] is functional without
                // even adding it to the DOM, but that might not be the case in some older
                // or quirky browsers like IE, so you might want to add it to the DOM
                // just in case, and visually hide it. And do not forget do remove it
                // once you do not need it anymore.

                input.onchange = function() {
                    var file = this.files[0];

                    // Note: Now we need to register the blob in TinyMCEs image blob
                    // registry. In the next release this part hopefully won't be
                    // necessary, as we are looking to handle it internally.
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var blobInfo = blobCache.create(id, file);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };

                input.click();
            },
            imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
            content_css: [
                {{--                    "{{url('admin/tinymce/')}}"+'/css/codepen.min.css'--}}
            ],
            link_assume_external_targets: true,
            relative_urls : false,
        });
    }
    // initTinymce();
</script>

@yield('script')
</body>
</html>
