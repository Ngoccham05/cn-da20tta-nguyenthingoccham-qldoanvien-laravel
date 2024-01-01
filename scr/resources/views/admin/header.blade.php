@php
$currentPath = Request::path();
@endphp
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Đoàn Khoa KT&CN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="/images/logo-doan.png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>

<body> 
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ $currentPath == 'admin/home' ? 'active' : '' }}">
                        <a href="/admin/home"><i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <li class="{{ $currentPath == 'admin/bieumau' ? 'active' : '' }}"><a href="/admin/bieumau"><i class="menu-icon fa fa-file-text"></i>Biểu mẫu </a></li>

                    <li class="{{ (($currentPath == 'admin/hoatdong') || str_contains($currentPath, 'thamgia')) ? 'active' : '' }}">
                        <a href="/admin/hoatdong"><i class="menu-icon fa fa-calendar"></i>Hoạt động </a>
                    </li>

                    <li class="{{ $currentPath == 'admin/chidoan' ? 'active' : '' }}">
                        <a href="/admin/chidoan"><i class="menu-icon fa fa-th"></i>Chi đoàn </a>
                    </li>
                    
                    <li class="menu-title">Quản lý đoàn viên</li>
                    <li class="{{ $currentPath == 'admin/doanvien' ? 'active' : '' }}"><a href="/admin/doanvien"><i class="menu-icon fa fa-users"></i>Danh sách đoàn viên</a></li>
                    <li class="{{ $currentPath == 'admin/taikhoan' ? 'active' : '' }}"><a href="/admin/taikhoan"><i class="menu-icon fa fa-id-badge"></i>Tài khoản</a></li>
                    
                    <li class="menu-title">Đánh giá, xếp loại</li>
                    <li class="{{ $currentPath == 'admin/tieuchi' ? 'active' : '' }}"><a href="/admin/tieuchi"><i class="menu-icon fa fa-list"></i>Tiêu chí đánh giá</a></li>
                    <li class="{{ $currentPath == 'admin/dotdg' ? 'active' : '' }}"><a href="/admin/dotdg"><i class="menu-icon fa fa-calendar-o"></i>Kỳ đánh giá</a></li>
                    <li class="{{ $currentPath == 'admin/danhgiacd' ? 'active' : '' }}"><a href="/admin/danhgiacd"><i class="menu-icon fa fa-th"></i>Xếp loại chi đoàn</a></li>
                    <li class="{{ $currentPath == 'admin/danhgiadv' ? 'active' : '' }}"><a href="/admin/danhgiadv"><i class="menu-icon fa fa-users"></i>Xếp loại đoàn viên</a></li>

                    <li class="menu-title">Quản lý danh mục</li>
                    <li class="{{ $currentPath == 'admin/chuyennganh' ? 'active' : '' }}"><a href="/admin/chuyennganh"><i class="menu-icon fa fa-th-large"></i>Ngành</a></li>
                    <li class="{{ $currentPath == 'admin/chucvu' ? 'active' : '' }}"><a href="/admin/chucvu"><i class="menu-icon fa fa-sitemap"></i>Chức vụ</a></li>
                    <li class="{{ $currentPath == 'admin/loaidv' ? 'active' : '' }}"><a href="/admin/loaidv"><i class="menu-icon fa fa-bar-chart"></i>Loại đoàn viên</a></li>
                    <li class="{{ $currentPath == 'admin/loaicd' ? 'active' : '' }}"><a href="/admin/loaicd"><i class="menu-icon fa fa-bar-chart"></i>Loại chi đoàn</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>  
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img src="/images/logo-doan.png" alt="Logo" width="35px"><span class="align-middle ml-2" style="font-size:18px">Đoàn Khoa KT&CN</span></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::guard('admin')) {{ Auth::guard('admin')->user()->username_admin}} @endif
                            <i class="fa fa-caret-down ml-2"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="/logout"><i class="fa fa-power-off"></i>Đăng xuất</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content" style="min-height:640px">
