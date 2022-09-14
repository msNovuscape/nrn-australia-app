<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NRN | Australia |Reset Password</title>

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

    <!-- slick slider link -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css"/>


    <!-- for multiselect -->
    {!! Html::style('plugins/multiple-select-1.5.2/dist/multiple-select.min.css') !!}

    <!-- for multiselect -->
    {!! Html::style('css/bootstrap-multiselect.css') !!}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script>
        Laravel = {
            'url': '{{url("")}}'
        }
    </script>
    

@yield('style')
</head>

<div class="ps-account">
            <div class="container">
                <div class="row">
           
                    <div class="col-12 col-md-6">            
                    <form action="{{url('reset-password')}}" style = "align:center" method="post">
                            @csrf
                            <div class="ps-form--review" >
                                <h2 class="ps-form__title">Reset Password</h2>
                                <div class="flash-message">
                                @include('success.success')
                               @include('errors.error')
                                        </div>
                                <div class="ps-form__group" >
                                    <label class="ps-form__label">New password *</label>
                                    <input class="form-control ps-form__input" type="password" name = 'password' required>
                                </div>
                                <div class="ps-form__group" >
                                    <label class="ps-form__label">Confirm New password *</label>
                                    <input class="form-control ps-form__input" type="password" name = 'password_confirmation' required>
                                </div>
                                <input type = "hidden" name = "token" value = "{{$token}}">
                                <input type = "hidden" name = "email" value = "{{$email}}">
                                
                                <div class="ps-form__submit">
                                    <button class="ps-btn ps-btn--lblue">Submit</button>
                                </div>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>