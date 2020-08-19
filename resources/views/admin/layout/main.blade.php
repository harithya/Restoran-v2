@include('admin.layout.header');
<div class="wrapper">
    <div class="container-fluid">
        @yield('content')
    </div> <!-- end container-fluid -->
</div>
<!-- end wrapper -->
@stack('modal')
@include('admin.layout.footer')
@stack('script')