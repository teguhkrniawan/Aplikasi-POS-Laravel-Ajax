<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="{{ asset('/adminLTE/bootstrap/css/bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/adminLTE/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/adminLTE/dist/css/skins/skin-blue.min.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('/adminLTE/plugins/datepicker/datepicker3.css') }}">
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{ asset('/adminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
</head>
<!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->

<body class="skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>H</b>M</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Hey</b>Mart</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('/images/' .Auth::user()->foto) }}" class="user-image"
                                    alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('/images/' .Auth::user()->foto) }}" class="img-circle"
                                        alt="User Image">
                                    <p>
                                        {{ Auth::user()->name }}
                                        @if (Auth::user()->level == 1)
                                        <small>Admin</small>
                                        @else
                                        <small>Kasir</small>
                                        @endif

                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('user.profil') }}"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                                            out</a>
                                        <form action="{{ route('logout') }}" id="logout-form" method="POST"
                                            style="display: none;">{{ csrf_field() }}</form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">MENU NAVIGASI</li>
                    <!-- Optionally, you can add icons to the links -->
                    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

                    @if (Auth::user()->level == 1)
                    <li><a href="{{ route('kategori.index') }}"><i class="fa fa-cube"></i> <span>Kategori</span></a>
                    </li>
                    <li><a href="{{ route('produk.index') }}"><i class="fa fa-cubes"></i> <span>Produk</span></a></li>
                    <li><a href="{{ route('member.index') }}"><i class="fa fa-credit-card"></i>
                            <span>Member</span></a></li>
                    <li><a href="{{ route('supplier.index') }}"><i class="fa fa-truck"></i> <span>Supplier</span></a>
                    </li>
                    <li><a href="{{ route('pengeluaran.index') }}"><i class="fa fa-money"></i>
                            <span>Pengeluaran</span></a></li>
                    <li><a href="{{ route('user.index')}}"><i class="fa fa-user"></i> <span>User</span></a></li>
                    <li><a href="{{ route('penjualan.index')}}"><i class="fa fa-upload"></i> <span>Penjualan</span></a>
                    </li>
                    <li><a href="{{ route('pembelian.index') }}"><i class="fa fa-download"></i>
                            <span>Pembelian</span></a></li>
                    <li><a href="{{ route('laporan.index') }}"><i class="fa fa-file-pdf-o"></i> <span>Laporan</span></a>
                    </li>
                    <li><a href="{{ route('setting.index') }}"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
                    @else
                    <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>Transaksi</span></a></li>
                    <li><a href="#"><i class="fa fa-cart-plus"></i> <span>Transaksi Baru</span></a></li>
                    @endif


                </ul><!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title')
                </h1>
                <ol class="breadcrumb">
                    @section('breadcumb')
                    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    @show
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                Laravel 5.6
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2020 <a href="#">POS Versi 1.0</a>.</strong> All rights reserved.
        </footer>

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('/adminLTE/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
        <!-- Bootstrap 3.3.4 -->
        <script src="{{ asset('/adminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src=" {{ asset('/adminLTE/dist/js/app.min.js') }}"></script>
        {{-- DataTables --}}
        <script src="{{ asset('/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/adminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
        {{-- Validator --}}
        <script src="{{ asset('js/validator.js') }}"></script>
        {{-- DatePicker --}}
        <script src="{{ asset('/adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        {{-- Char JS --}}
        <script src="{{ asset('/adminLTE/plugins/chartjs/Chart.min.js') }}"></script>
        @yield('script')
</body>

</html>