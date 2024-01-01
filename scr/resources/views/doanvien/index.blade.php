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

    <style>
        .content{
          padding: 0 15px;
        }
        .image-container {
            position: relative;
            display: inline-block;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); 
            z-index: 1;
        }
        .image-text {
            text-align:center;
            font-size: 3.3vw;
            letter-spacing: 7px;
            line-height: 1.7;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            z-index: 2;
            width: 100%
        }
    </style>
</head>

<body> 
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!--Đoàn viên-->
                    <li class="{{ $currentPath == 'ktcn' ? 'active' : '' }}"><a href="/ktcn"><i class="menu-icon fa fa-home"></i>Trang chủ </a></li>

                    <!-- <li class=""><a href="#"><i class="menu-icon fa fa-sitemap"></i>BCH Đoàn Khoa</a></li> -->

                    <li class="{{ $currentPath == 'ktcn/bieumau' ? 'active' : '' }}"><a href="/ktcn/bieumau"><i class="menu-icon fa fa-file-text"></i>Biểu mẫu </a></li>

                    <li class="{{ $currentPath == 'ktcn/hoatdong' || str_contains($currentPath, 'ktcn/thamgia') ? 'active' : '' }}">
                        <a href="/ktcn/hoatdong"><i class="menu-icon fa fa-calendar"></i>Hoạt động </a>
                    </li>
                    
                    <li class="menu-title">Đánh giá, xếp loại</li>
                    <li class="{{ $currentPath == 'ktcn/dvdanhgia' ? 'active' : '' }}"><a href="/ktcn/dvdanhgia"><i class="menu-icon fa fa-check"></i>Đoàn viên tự đánh giá</a></li>
                    <li class="{{ $currentPath == 'ktcn/ketquadv' ? 'active' : '' }}"><a href="/ktcn/ketquadv"><i class="menu-icon fa fa-bar-chart"></i>Kết quả ĐG đoàn viên</a></li>
                    <li class="{{ $currentPath == 'ktcn/ketquacd' ? 'active' : '' }}"><a href="/ktcn/ketquacd"><i class="menu-icon fa fa-bar-chart"></i>Kết quả ĐG chi đoàn</a></li>

                    @if (Auth::guard('doanvien')->check() && Auth::guard('doanvien')->user()->role == 2)
                    <!--Ban chấp hành chi đoàn-->
                    <li class="menu-title">Quản lý chi đoàn</li><!--đoàn viên trong chi đoàn của mình-->
                    <li class="{{ $currentPath == 'ktcn/doanvien' ? 'active' : '' }}"><a href="/ktcn/doanvien"><i class="menu-icon fa fa-users"></i>Danh sách đoàn viên</a></li>                    
                    <li class="{{ $currentPath == 'ktcn/danhgiadv' ? 'active' : '' }}"><a href="/ktcn/danhgiadv"><i class="menu-icon fa fa-check-square-o"></i>Đánh giá đoàn viên</a></li>
                    <li class="{{ $currentPath == 'ktcn/cddanhgia' ? 'active' : '' }}"><a href="/ktcn/cddanhgia"><i class="menu-icon fa fa-check"></i>Chi đoàn đánh giá</a></li>
                    @endif

                    @if (Auth::guard('doanvien')->check() && Auth::guard('doanvien')->user()->role == 1)
                    <!--Ban chấp hành đoàn khoa-->
                    <li class="menu-title">Quản lý đoàn khoa</li>
                    <li class="{{ $currentPath == 'ktcn/chidoan' ? 'active' : '' }}"><a href="/ktcn/chidoan"><i class="menu-icon fa fa-th"></i>Danh sách chi đoàn</a></li>
                    <li class="{{ $currentPath == 'ktcn/doanvien' ? 'active' : '' }}"><a href="/ktcn/doanvien"><i class="menu-icon fa fa-users"></i>Danh sách đoàn viên</a></li>
                    <li class="{{ $currentPath == 'ktcn/dotdg' ? 'active' : '' }}"><a href="/ktcn/dotdg"><i class="menu-icon fa fa-calendar-o"></i>Kỳ đánh giá</a></li>
                    <li class="{{ $currentPath == 'ktcn/tieuchi' ? 'active' : '' }}"><a href="/ktcn/tieuchi"><i class="menu-icon fa fa-list"></i>Tiêu chí đánh giá</a></li>                    
                    <li class="{{ $currentPath == 'ktcn/danhgiacd' ? 'active' : '' }}"><a href="/ktcn/danhgiacd"><i class="menu-icon fa fa-check-square"></i>Đánh giá chi đoàn</a></li>
                    <li class="{{ $currentPath == 'ktcn/danhgiadv' ? 'active' : '' }}"><a href="/ktcn/danhgiadv"><i class="menu-icon fa fa-check-square-o"></i>Đánh giá đoàn viên</a></li>
                    @endif
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
                            @if (Auth::guard('doanvien')->check())
                                @if (Auth::guard('doanvien')->user()->role == 1)
                                    BCH Đoàn khoa | 
                                @elseif(Auth::guard('doanvien')->user()->role == 2)
                                    BCH Chi đoàn |
                                @else
                                    Đoàn viên |
                                @endif
                                {{ Auth::guard('doanvien')->user()->username }}
                            @endif
                            <i class="fa fa-caret-down ml-2"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="/ktcn/ttcanhan"><i class="fa fa-user"></i>Cá nhân</a>
                            <a class="nav-link" href="/logout"><i class="fa fa-power-off"></i>Đăng xuất</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
          <div class="row image-container">
              <img id="banner" src="/images/doankhoa-ktcn.jpg" alt="Banner" class="w-100" height="640px"/>
              <div class="overlay"></div>
              <label id="lbbanner" class="image-text">
                  ĐOÀN KHOA <br/>KỸ THUẬT VÀ CÔNG NGHỆ <br/>XIN CHÀO!
              </label>
          </div>
        </div>
      <div class="clearfix"></div>
    </div>


    <script src="/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/assets/js/init/datatables-init.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>
    <script src="/assets/js/init/chartjs-init.js"></script>
    <!--Flot Chart-->
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
</body>
</html>