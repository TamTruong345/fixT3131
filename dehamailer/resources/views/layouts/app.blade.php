<html>
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Title -->
    <title>DEHA MAILER</title>
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/themify-icons/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/animate.css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/waves/waves.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/jscrollpane/jquery.jscrollpane.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/chosen.min.css') }}" type="text/css">

    <!-- Neptune CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-1.12.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/select2.min.js') }}"></script>



</head>
<body class="fixed-sidebar fixed-header content-appear skin-default">
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="site-overlay"></div>
        <div class="site-sidebar">
            <div class="custom-scroll custom-scroll-light">
                <ul class="sidebar-menu">
                    <!-- <li class="menu-title">Main</li> -->
                    <li class="active">
                        <a href="/customer" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="ti-user"></i></span>
                            <span class="s-text">Customer</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/project" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="ti-agenda"></i></span>
                            <span class="s-text">Projects</span>
                        </a>
                    </li>
                    <li>
                        <a href="/template" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="ti-file"></i></span>
                            <span class="s-text">Templates</span>
                        </a>
                    </li>
                    <li>
                        <a href="/setting" class="waves-effect  waves-light">
                            <span class="s-icon"><i class="ti-settings"></i></span>
                            <span class="s-text">Setting</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Header -->
        <div class="site-header">
            <nav class="navbar navbar-light">
                <div class="navbar-left">
                    <a class="navbar-brand" href="/">
                        <div class="logo"></div>
                    </a>
                    <div class="toggle-button dark sidebar-toggle-first pull-xs-left hidden-md-up">
                        <span class="hamburger"></span>
                    </div>
                    <div class="toggle-button dark pull-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
                        <span class="more"></span>
                    </div>
                </div>
                <div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
                    <div class="toggle-button light sidebar-toggle-second pull-xs-left hidden-sm-down">
                        <span class="hamburger"></span>
                    </div>
                    <ul class="nav navbar-nav pull-md-right">
                        <li class="nav-item dropdown hidden-sm-down">
                            <a href="#" data-toggle="dropdown" aria-expanded="false">
                                <i class="ti-user m-r-0-5"></i>Han Van Thang
                                <span class="s-caret"><i class="fa fa-angle-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated fadeInUp">
                                <a class="dropdown-item" href="#"><i class="ti-lock m-r-0-5"></i> Change password</a>
                                <a class="dropdown-item" href="#"><i class="ti-power-off m-r-0-5"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="site-content">
            <div class="content-area p-y-1">
                @yield('content')
            </div>
            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-xs-center">
                        <div class="col-sm-4 text-sm-left m-b-0-5 m-sm-b-0">
                            2017 © DEHAMAILER
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @section('sidebar')
        This is the master sidebar.
    @show
    <!-- Vendor JS -->
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/detectmobilebrowser/detectmobilebrowser.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jscrollpane/jquery.jscrollpane.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jscrollpane/jquery.mousewheel.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jscrollpane/mwheelIntent.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/waves/waves.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-fullscreen-plugin/jquery.fullscreen-min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/project-ui.js') }}"></script>
    <script>
        $('.daterange').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $(document).ready(function() {
            $('.chosen-select-no-results').chosen();
        });
    </script>

    <!-- Neptune JS -->

    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

</body>
</html>