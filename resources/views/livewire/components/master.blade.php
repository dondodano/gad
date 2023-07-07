<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-template="vertical-menu-template">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

        <title>{{ isset($title) ? $title : 'GAD' }}</title>

        <meta name="description" content="Gender and Development" />
        <meta name="csrf-token" content="{{ csrf_token() }}"/>

        <link rel="icon" type="image/x-icon" href="{{ getFileShortLocation(sessionGet('webicon')) }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/css/rtl/core.css')  }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
        <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link href="{{ asset('assets/vendor/libs/select2/select2.css') }}" rel="stylesheet" />

        <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
        <script src="{{ asset('/assets/vendor/js/template-customizer.js') }}"></script>
        <script src="{{ asset('/assets/js/config.js') }}"></script>

        @vite(['resources/css/app.css','resources/js/app.js'])
        @livewireStyles

        @stack('head')

        <style>
            .dash-icon{font-size: 2.75rem;}
            .dash-count{font-size: 2.5rem;}
            .filepond--credits{visibility: hidden;}
            .filepond--drop-label{min-height: 180px !important;}
        </style>
    </head>
    <body>

        <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">

                @include('includes.menu')

                <!-- Layout container -->
                <div class="layout-page">

                    @livewire('components.navbar')

                    <div class="content-wrapper">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            @include('includes.breadcrumb')

                            @yield('contents')

                        </div>

                        @include('includes.footer')
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->

        <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
        <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
        <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
        <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
        <script src="{{ asset('/assets/js/main.js') }}"></script>

        @livewireScripts

        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script>
            var pusher = new Pusher('b9a98d5d52ec6269f87b', {
                cluster: 'ap1'
            });
            var channel = pusher.subscribe('notification-channel');
            channel.bind('notification-event', function(data) {
                if(data)
                {
                    // if(data.message == 'NewNotification')
                    // {
                    //     Livewire.emit('NewNotification')
                    // }

                    // if(data.message == 'UserOnlineStatus')
                    // {
                    //     Livewire.emit('UserOnlineStatus')
                    // }
                }
            });

            window.addEventListener('reloadComponent', event => {
                setTimeout(() => {
                    location.reload();
                }, 2000);
            })
        </script>
        @stack('body')

    </body>
</html>
