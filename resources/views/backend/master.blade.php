<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>E-commerce</title>
    @include('backend.include.style')
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      @include('backend.include.navber')
    @include("backend.include.sidebar")
      <!--begin::App Main-->
      <main class="app-main">
       @yield('content')
      </main>
      <!--end::App Main-->
    @include('backend.include.footer')
    </div>
    <!--end::App Wrapper-->
   @include('backend.include.script')
   @stack('script')
  </body>
  <!--end::Body-->
</html>
