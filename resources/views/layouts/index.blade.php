<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atribut One Gym</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <link href="{{ asset('/css/datatables.min.css') }}" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    <!-- Sweet Alert -->
    <link href="{{ asset('/css/sweet-alert.css') }}" rel="stylesheet">
</head>
<body id="page-top">

    <div id="wrapper">

        <!-- sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- sidebar brand -->
            <a href="" class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-dumbbell"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Atribut One Gym</div>
            </a>

            <!-- divider -->
            <hr class="sidebar-divider my-0">

            @if(Auth::guard('owner')->check())
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('owner.index') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            @elseif(Auth::guard('admin')->check())
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
            @endif

            <!-- divider -->
            <hr class="sidebar-divider my-0">

            <div class="sidebar-heading">
                Menu
            </div>

            @if(Auth::guard('owner')->check())
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('owner.dataadmin.index') }}" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        <span>Data Admin</span>
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('owner.kategorikunjunganharian.index') }}" class="nav-link">
                        <i class="fas fa-book-open"></i>
                        <span>Kategori Kunjungan Harian</span>
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('owner.paketpendaftaranmembership.index') }}" class="nav-link">
                        <i class="fas fa-archive"></i>
                        <span>Paket Pendaftaran</span>
                    </a>
                </li>
            @endif

            @if(Auth::guard('admin')->check())
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('admin.datamember.index')}}" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        <span>Data Member</span>
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('admin.kunjunganmember.index')}}" class="nav-link">
                        <i class="far fa-address-card"></i>
                        <span>Kunjungan Member</span>
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('admin.kunjunganharian.index') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <span>Kunjungan Harian</span>
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('admin.pendaftaranmembership.index') }}" class="nav-link">
                        <i class="fas fa-user-plus"></i>
                        <span>Pendaftaran Membership</span>
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a href="{{ route('admin.laporan.index', 'tab=harian') }}" class="nav-link">
                        <i class="far fa-clipboard"></i>
                        <span>Laporan Transaksi</span>
                    </a>
                </li>
            @endif

            <!-- divider -->
            <hr class="sidebar-divider d-none d-md-inline">

            <!-- sidebar toggler - sidebar -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- end sidebar -->

        <!-- content wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- main content -->
            <div id="content">

                <!-- top bar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- sidebar toggle - top bar -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- topbar navbar -->
                    <div class="navbar-nav ml-auto">

                        <!-- divider topbar -->
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- nav item - user information -->
                        <li class="nav-item dropdown no-arrow">
                            <a href="" role="button" class="nav-link dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    @if(Auth::guard('owner')->check())
                                        {{ Auth::user()->nama }}
                                    @elseif(Auth::guard('admin')->check())
                                        {{ Auth::user()->nama }}
                                    @endif
                                </span>
                                <i class="fas fa-user-tie"></i>
                            </a>

                            <!-- dropdown - user information -->
                            <div aria-labelledby="userDropdown" class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a href="" class="dropdown-item">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <!-- dropdown divider -->
                                <div class="dropdown-divider"></div>
                                @if(Auth::guard('owner')->check())
                                    <a href="{{ route('owner.postlogout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                    <form action="{{ route('owner.postlogout') }}" id="logout-form" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                @elseif(Auth::guard('admin')->check())
                                    <a href="{{ route('admin.postlogout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                    <form action="{{ route('admin.postlogout') }}" id="logout-form" method="post" style="display: none;">
                                        @csrf
                                    </form>
                                @endif
                            </div>
                        </li>

                    </div>

                </nav>
                <!-- end - top bar -->

                <!-- begin page content -->
                <div class="container-fluid">

                    @yield('content')

                </div>

            </div>
            <!-- end - main content -->

            <!-- footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Atribut One Gym 2020 - 2021</span>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <form id="form_hapus" role="form" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <button style="display:none" type="submit" id="form_submit"></button>
      </form>

     <!-- Sweet Alert -->
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        //delete
      $(document).ready(function()
      {
        $(document).on('click','#hapus',function(e){
         var url = window.location.origin+window.location.pathname;
         var Id = $(this).attr('data-id');
         var nama = $(this).attr('data-nama');
         var formAction = url + "/" + Id;
         $('#form_hapus').attr('action', formAction);
         swal({
          title: "Hapus!",
          html:true,
          text: "Anda yakin akan menghapus <strong style='color:red'>"+nama+"</strong>?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Ya",
          cancelButtonText: "Tidak",
        },
        function(){
          $("#form_submit").trigger("click");
        });
       });
      });
      </script>

    <!-- Bootstrap core JavaScript-->

    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('sbadmin2/vendor/chart.js/Chart.min.js') }}"></script>

     <!-- Datatables -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

    @yield('js-inline')
</body>
</html>
