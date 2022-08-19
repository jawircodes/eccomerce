<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('backend/favicon.ico') }}" type="image/x-icon"> <!-- Favicon-->
        <title>@yield('title') - {{ config('app.name') }}</title>
        <meta name="description" content="@yield('meta_description', config('app.name'))">
        <meta name="author" content="@yield('meta_author', config('app.name'))">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jvectormap/jquery-jvectormap-2.0.3.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/morrisjs/morris.min.css') }}" />

        @if (Request::segment(2) === 'banners' && Request::segment(3) === 'create' )
        
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css') }}"/>
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/summernote/dist/summernote.css') }}"/>
       
        
        
        @endif
        @if (Request::segment(2) === 'banners')
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/sweetalert/sweetalert.css') }}"/>
        <link rel="stylesheet" href="{{ asset('backend/assets/vendor/toastr/toastr.min.css') }}"/>
        @endif

        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/assets/css/color_skins.css') }}">

       

        @stack('after-styles')

        @if (trim($__env->yieldContent('page-styles')))
            @yield('page-styles')
        @endif

    </head>
    
    <?php 
        $setting = !empty($_GET['theme']) ? $_GET['theme'] : '';
        $theme = "theme-cyan";
        $menu = "";
        if ($setting == 'p') {
            $theme = "theme-purple";
        } else if ($setting == 'b') {
            $theme = "theme-blue";
        } else if ($setting == 'g') {
            $theme = "theme-green";
        } else if ($setting == 'o') {
            $theme = "theme-orange";
        } else if ($setting == 'bl') {
            $theme = "theme-blush";
        } else {
             $theme = "theme-cyan";
        }

    ?>

    <body class="<?= $theme ?>">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img src="{{url('/')}}/backend/assets/img/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
                <p>Please wait...</p>        
            </div>
        </div>

        <div id="wrapper">

            @include('backend.layouts.navbar')
            @include('backend.layouts.sidebar')

            <div id="main-content">
                <div class="container-fluid">
                    <div class="block-header">
                        <div class="row">
                            <div class="col-lg-5 col-md-8 col-sm-12">                        
                                <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> @yield('title')</h2>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>
                                    @if (trim($__env->yieldContent('parentPageTitle')))
                                       <li class="breadcrumb-item">@yield('parentPageTitle')</li>
                                    @endif
                                    @if (trim($__env->yieldContent('title')))
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    @endif
                                </ul>
                            </div>            
                            
                        </div>
                    </div>
                    
                    @yield('content')

                </div>
            </div>

        </div>

        <!-- Scripts -->
        @stack('before-scripts')

        <script src="{{ asset('backend/assets/bundles/libscripts.bundle.js') }}"></script>    
        <script src="{{ asset('backend/assets/bundles/vendorscripts.bundle.js') }}"></script>
        
        <script src="{{ asset('backend/assets/bundles/morrisscripts.bundle.js') }}"></script><!-- Morris Plugin Js -->
        <script src="{{ asset('backend/assets/bundles/jvectormap.bundle.js') }}"></script> <!-- JVectorMap Plugin Js -->
        <script src="{{ asset('backend/assets/bundles/knob.bundle.js') }}"></script>
        

        <script src="{{ asset('backend/assets/bundles/mainscripts.bundle.js') }}"></script>
        @if (Request::segment(2) === 'banners' && Request::segment(3) === 'create' )

        <script src="{{ asset('backend/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/parsleyjs/js/parsley.min.js') }}"></script>
        <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
        <script src="{{ asset('backend/assets/vendor/summernote/dist/summernote.js') }}"></script>
        
        
        @endif
        @if (Request::segment(2) === 'banners')
        <script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
        <script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>
        <script src="{{ asset('backend/assets/vendor/toastr/toastr.js') }}"></script>
        
        @endif

        @stack('after-scripts')

        @if (trim($__env->yieldContent('page-script')))
            
                @yield('page-script')
            
		@endif
    </body>
</html>
