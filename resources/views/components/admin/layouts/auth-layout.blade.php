<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }} - {{ $title }} </title>
  <!-- Fonts -->
  <!-- Styles -->
  <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
  <style>
    body {
      background: #f5f5ff !important;
    }

  </style>
</head>

<body>
  <div id="apps content-wrapper">
    {{ $slot }}
  </div>
</body>

</html>
