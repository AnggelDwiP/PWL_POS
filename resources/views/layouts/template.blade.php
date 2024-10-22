<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PWL_POS</title>

  <meta name="csrf-token" content="{{csrf_token() }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  @stack('css')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

  <style>
    :root {
      --blue: #024CAA;
      --primary: #024CAA;
    }
    
    /* Navbar (Header) tetap putih */
    .main-header.navbar {
      background-color: white;
      border-bottom: 1px solid #dee2e6;
    }
    .main-header.navbar .nav-link {
      color: #024CAA;
    }
    
    /* Sidebar styling */
    .main-sidebar {
      background-color: #024CAA;
    }
    
    /* Sidebar brand section */
    .brand-link {
      background-color: #091057;
      border-bottom: 1px solid #EEEEEE;
    }
    .brand-link .brand-text {
      color: white !important;
    }
    
    /* Sidebar menu items */
    .nav-sidebar .nav-item p {
      color: white !important;
    }
    .nav-sidebar .nav-item i {
      color: white !important;
    }
    .nav-sidebar .nav-header {
      color: rgba(255,255,255,0.7) !important;
      text-transform: uppercase;
    }
    
    /* Hover effect pada menu */
    .nav-sidebar .nav-link:hover {
      background-color: rgba(255,255,255,0.1);
    }
    
    /* Active menu state */
    .nav-sidebar .nav-link.active {
      background-color: rgba(255,255,255,0.2) !important;
    }
    .nav-sidebar .nav-link.active p,
    .nav-sidebar .nav-link.active i {
      color: white !important;
    }
    
    /* Search box dalam sidebar */
    .sidebar .form-control-sidebar {
      background-color: rgba(255,255,255,0.2);
      border: 1px solid rgba(255,255,255,0.1);
      color: white;
    }
    .sidebar .form-control-sidebar::placeholder {
      color: rgba(255,255,255,0.6);
    }
    .sidebar .btn-sidebar {
      background-color: rgba(255,255,255,0.2);
      border: 1px solid rgba(255,255,255,0.1);
      color: white;
    }
    
    /* Scrollbar styling untuk sidebar */
    .sidebar::-webkit-scrollbar {
      width: 5px;
    }
    .sidebar::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.1);
    }
    .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,0.2);
    }
    
    /* Other components */
    .btn-primary {
      background-color: #024CAA;
      border-color: #024CAA;
    }
    .btn-primary:hover {
      background-color: #023d88;
      border-color: #023d88;
    }
    
    .page-item.active .page-link {
      background-color: #024CAA;
      border-color: #024CAA;
    }
    
    .card-primary.card-outline {
      border-top: 3px solid #024CAA;
    }
    
    a {
      color: #024CAA;
    }
    a:hover {
      color: #023d88;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url ('/')}}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PWL - Starter Code</span>
    </a>

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.breadcrumb')
    <!-- Main content -->
    <section class="content">

    @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('layouts.footer')
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset ('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- jQuery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('dist/js/adminlte.min.js') }}"></script>
<script>
  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
</script>
@stack('js')
<!-- SweetAlert2 Script -->
<script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari aplikasi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak, tetap di sini!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('logout') }}"; // URL logout
            }
        });
    }
</script>
</body>
</html>
