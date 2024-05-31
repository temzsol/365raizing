
<!doctype html>
<html lang="en">
<head>
        
        <meta charset="utf-8" />
        <title>Dashboard | RR Web Development</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Raizing Group" name="description" />
        <meta content="Raizing Group" name="Deepak" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('/')}}/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{url('/')}}/admin/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{url('/')}}/admin/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{url('/')}}/admin/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <x-admin.topbar/>
        <!-- END layout-wrapper -->

        {{-- left side bar --}}
        <x-admin.leftsidebar/>

        <!-- Right Sidebar -->
        <x-admin.rightsidebar/>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <x-admin.footer/>

        @stack('footer-section-code')
    </body>



</html>