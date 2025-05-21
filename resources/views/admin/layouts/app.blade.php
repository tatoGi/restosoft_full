<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    
@include('admin.layouts.head')

    <body>
        
        <!-- Begin page -->
        <div id="wrapper">

            @include('admin.layouts.header')

            @include('admin.layouts.sidebar')

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        @yield('content')      
                        
                    </div> 
                    <!-- container -->

                </div> <!-- content -->


            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->


        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        @include('admin.layouts.scripts')
    </body>
</html>