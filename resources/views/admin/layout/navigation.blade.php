<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">

        <div id="navigation">

            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="{{ url('admin/dashboard') }}"><i class="dripicons-home"></i> Dashboard</a>
                </li>
                <li class="has-submenu">
                    <a href="#">
                        <i class="dripicons-archive"></i> Master
                        <i class="mdi mdi-chevron-down mdi-drop"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ url('admin/master/role') }}">Role</a></li>
                    </ul>
                </li>



            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->