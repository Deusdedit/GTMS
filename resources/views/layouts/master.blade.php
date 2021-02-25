<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    @include('includes.header')
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('includes.sidebar')
  </aside>

  <div class="content-wrapper">
    
    <section class="content">
      
         @yield('content')

      </section>
  </div>

  <footer class="main-footer">
    @include('includes.footer')
  </footer>
@include('includes.footer_scripts')
@yield('pagescripts')
</div>
    </body>
</html>