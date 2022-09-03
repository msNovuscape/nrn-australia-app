<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NRN | Australia</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{--    {{ Html::favicon(\App\Models\Setting::where('slug','favicon')->first()->value) }}--}}
    {!! Html::style('admin/plugins/fontawesome-free/css/all.min.css') !!}
    <!-- Ionicons -->
        {!! Html::style('admin/css/ionicons/2.0.1/css/ionicons.min.css') !!}
    {!! Html::style('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') !!}
    {!! Html::style('admin/dist/css/adminlte.min.css') !!}
    {!! Html::style('admin/plugins/summernote/summernote-bs4.min.css') !!}
    {!! Html::style('admin/flatpickr/dist/flatpickr.min.css') !!}
    {!! Html::style('admin/css/custom-admin.css') !!}
    {{--css for loader--}}
    {!! Html::style('admin/css/css-loader.css') !!}

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
{!! Html::script('admin/plugins/jquery/jquery.min.js') !!}
{!! Html::script('admin/plugins/jquery-ui/jquery-ui.min.js') !!}
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
{!! Html::script('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') !!}
<!-- Summernote -->
{!! Html::script('admin/plugins/summernote/summernote-bs4.min.js') !!}
{!! Html::script('admin/dist/js/adminlte.js') !!}
{!! Html::script('admin/dist/js/demo.js') !!}
{!! Html::script('admin/flatpickr/dist/flatpickr.js') !!}
<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
<script>
    $(".getDate").flatpickr({
        dateFormat: "Y-m-d"
    });

    $(".myDate").flatpickr({
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
    });
    //starting loader
    function start_loader() {
        $('#loader').addClass('is-active');
    }
    //ending loader
    function end_loader() {
        $('#loader').removeClass('is-active');
    }

    ClassicEditor
        .create( document.querySelector( '#body1' ) )
        .catch( error => {
            // console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#body2' ) )
        .catch( error => {
            // console.error( error );
        } );
    ClassicEditor
        .create( document.querySelector( '#body3' ) )
        .catch( error => {
            // console.error( error );
        } );


    function filterList() {
        debugger;

        var baseurl = window.location.origin+window.location.pathname;
        window.location = baseurl+'?'+$('#search').serialize();
    }
</script>

@yield('script')
</body>
</html>
