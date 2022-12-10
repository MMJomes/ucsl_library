<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:void(0)">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ url('assets/images/logo.png') }}"  alt="homepage" class="dark-logo" width="40" height="50" />
                    <!-- Light Logo icon -->
                    <img src="{{ url('assets/images/logo.png') }}" alt="homepage" class="light-logo" width="40" height="50" />
                </b>
                <!--End Logo icon -->
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <li class="d-none d-md-block d-lg-block">
                    <a href="javascript:void(0)" class="p-l-15">
                        <!--This is logo text-->
                        <span style="font-size: 20px; color: white; font-family: sans-serif;font-weight: bold;">DIGITAL LIBRARY MANAGENMENT SYSTEM</span>

                    </a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                            src="{{ url(auth()->user()->image ?? '/assets/images/default-user.png') }}" alt="user"
                            class=""> <span class="hidden-md-down">{{ auth()->user()->name ?? 'User' }} &nbsp;<i
                                class="fa fa-angle-down"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <!-- text-->
                        <a href="{{ route('backend.profile') }}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>


                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a href="{{ route('logout') }}" class="dropdown-item"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i
                                class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
