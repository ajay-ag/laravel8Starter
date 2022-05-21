<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ config('app.name', 'Laravel') }} | {{ $title }}</title>
  <!-- Font Awesome Icons -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/backend-plugins.css') }}">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  {{ $link ?? '' }}

  {{ $css ?? '' }}

</head>

<body class="hold-transition sidebar-mini text-sm">
  <div class="wrapper">
    <!-- Navbar -->
    <x-admin.layouts.nav />
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <x-admin.layouts.aside />
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <div class="content px-4">
        <div class="container-fluid">
          {{ $slot }}
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
  <div id="load-modal"></div>
  <!-- REQUIRED SCRIPTS -->

  <script src="{{ asset('admin/js/app.js') }}"></script>
  <script src="{{ asset('admin/js/backend-plugins.js') }}" ></script>
  <script src="{{ asset('admin/js/datatables.js') }}"></script>


  <!-- jQuery -->
  <script>
    const message = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success shadow mr-3',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })
    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    @if(Session::has('error'))
      toast.fire({
          type: 'error',
          title: 'Error',
          icon: 'error',
          text: "{!!  session('error')  !!}"
      });
      @php session()->forget('error') @endphp
    @endif
    @if(Session::has('success'))
        toast.fire({
            type: 'success',
            title: 'Success',
            icon: 'success',
            text: "{!!  session('success')  !!}"
        });
        @php
            session()->forget('success');
        @endphp
    @endif
  </script>
  {{ $script ?? '' }}

  {{ $javascript ?? '' }}

</body>

</html>
