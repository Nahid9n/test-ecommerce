    <!doctype html>
    <html lang="en" dir="ltr">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>


    <head>
        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

        @include('admin.includes.meta')
    <!-- TITLE -->
        <title>{{ $setting->company_name ?? 'N/A'}} | @yield('title')</title>
        @include('admin.includes.style')
    </head>
    <body class="ltr app sidebar-mini">
    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
        @include('admin.includes.header')
        <!-- /app-Header -->

            <!--APP-SIDEBAR-->
        @include('admin.includes.sidebar-menu')
        <!--/APP-SIDEBAR-->

            <!--app-content open-->
            <div class="app-content main-content mt-0">
                <div class="side-app">

                    <!-- CONTAINER -->
                    <div class="main-container container-fluid">

                        @yield('body')

                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>

        <!-- FOOTER -->
        <footer class="footer">
            <div class="container">
                <div class="row align-items-center flex-row-reverse">
                    <div class="col-md-12 col-sm-12 text-center">
                        Copyright © 2024 All rights reserved
                    </div>
                </div>
            </div>
        </footer>
        <!-- FOOTER CLOSED -->

    </div>
    <!-- page -->

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

    @include('admin.includes.script')

    </body>
    </html>

