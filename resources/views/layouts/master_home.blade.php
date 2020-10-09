<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="icon" href="http://mubakid.or.id/wp-content/uploads/2019/01/cropped-512-1-32x32.png" sizes="32x32" />
  <link rel="icon" href="http://mubakid.or.id/wp-content/uploads/2019/01/cropped-512-1-192x192.png" sizes="192x192" />
  <link rel="apple-touch-icon" href="http://mubakid.or.id/wp-content/uploads/2019/01/cropped-512-1-180x180.png" />
  <meta name="msapplication-TileImage" content="http://mubakid.or.id/wp-content/uploads/2019/01/cropped-512-1-270x270.png" />
  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
  <style>
    .content-wrapper{
      background: white;
    }
    .nav-link{
      color: white !important;
    }
    .nav-link:hover{
      color: rgba(255, 255, 255, 0.5) !important;
    }
  </style>
</head>
<body class="layout-top-nav">
<div class="wrapper" id="app">
  @include('layouts.header')
  <!-- Navbar -->
  @include('layouts.top-nav')
  <!-- /.navbar -->

  {{-- Content Wrapper. Contains page content --}}
  <div class="content-wrapper">
    {{-- Main content --}}
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        {{-- <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row --> --}}
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <router-view></router-view>

    <vue-progress-bar></vue-progress-bar>

    {{-- /.content --}}
  </div>
  {{-- /.content-wrapper --}}

  {{-- Main Footer --}}
  <footer class="main-footer bg-navy">
    <div class="container text-center">
    {{-- To the right --}}
    {{-- Default to the left --}}
    <strong>Copyright &copy; {{date('Y')}} <a href="http://mubakid.or.id/" class="text-white" target="_blank">PPMU Bakid</a>.</strong> All rights reserved.
    </div>
  </footer>
</div>
{{-- ./wrapper --}}

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
