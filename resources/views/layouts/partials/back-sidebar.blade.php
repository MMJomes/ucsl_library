<div class="side-mini-panel">
    <ul class="mini-nav">
        <div class="togglediv"><a href="javascript:void(0)" id="togglebtn"><i class="ti-menu"></i></a></div>
        <!-- .Dashboard -->
        <li>
            <a href="javascript:void(0)"><i class="ti-layout-grid2"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">Dashboard</h3>
                <div class="searchable-menu">
                    <form role="search" class="menu-search">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </div>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('backend.dashboard.index') }}"> {{ __('message.home') }}</a></li>

                    <li><a href="{{ route('backend.category.index') }}"> {{ __('message.category') }}</a></li>
                    <li><a href="{{ route('backend.author.index') }}"> {{ __('message.author') }}</a></li>
                    <li><a href="{{ route('backend.book.index') }}"> {{ __('message.books') }}</a></li>
                    {{-- <li><a href="{{ route('backend.mainbusiness.index') }}"> Main Business </a></li>
                    <li><a href="{{ route('backend.sidebusiness.index') }}"> Side Business </a></li>
                  --}}
        </li>
    </ul>
    <!-- Left navbar-header end -->
</div>
</li>
<!-- /.Dashboard -->
<!-- .User Management -->
<li>
    <a href="javascript:void(0)"><i class="icon-settings"></i></a>
    <div class="sidebarmenu">
        <!-- Left navbar-header -->
        <h3 class="menu-title">User Management</h3>
        <div class="searchable-menu">
            <form role="search" class="menu-search">
                <input type="text" placeholder="Search..." class="form-control">
                <a href=""><i class="fa fa-search"></i></a>
            </form>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('backend.roles.index') }}">Roles </a></li>
            <li><a href="{{ route('backend.admins.index') }}">Admins</a></li>
            <li><a href="{{ route('backend.settings.index') }}">{{ __('message.setting') }}</a></li>
            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><span
                        class="hide-menu">{{ __('message.changelanguage') }}</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li>
                        @foreach (Config::get('languages') as $lang => $language)
                            <a class="dropdown-item py-2 px-2"
                                href="@if ($lang == App::getLocale()) javascript:; @else {{ route('lang.switch', $lang) }} @endif">
                                <img src="{{ asset($language['flag']) }}" alt="language" width="20">
                                <span class="ml-1">{{ $language['name'] }}</span>
                                @if ($lang == App::getLocale())
                                    <span class="float-right my-auto">
                                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Left navbar-header end -->
    </div>
</li>
<li>
    <a href="javascript:void(0)"><i class="fa fa-users"></i></a>
    <div class="sidebarmenu">
        <!-- Left navbar-header -->
        <h3 class="menu-title">Stduents Managemet</h3>
        <div class="searchable-menu">
            <form role="search" class="menu-search">
                <input type="text" placeholder="Search..." class="form-control">
                <a href=""><i class="fa fa-search"></i></a>
            </form>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('stduent.stdclass.index') }}"> {{ 'Classes' }}</a></li>

            <li><a href="{{ route('stduent.stduents.index') }}"> Stduent Lists</a></li>
            <li><a href="{{ route('stduent.bookRent.index') }}"> Stduent Rent Book Lists</a></li>
            <li><a href="{{ route('stduent.preRequestBooks.index') }}"> PreRequest Book Lists</a></li>
</li>
</ul>
<!-- Left navbar-header end -->
</div>
</li>
<li>
    <a href="javascript:void(0)"><i class="icons-Worker"></i></a>
    <div class="sidebarmenu">
        <!-- Left navbar-header -->
        <h3 class="menu-title">Staff Managemet</h3>
        <div class="searchable-menu">
            <form role="search" class="menu-search">
                <input type="text" placeholder="Search..." class="form-control">
                <a href=""><i class="fa fa-search"></i></a>
            </form>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('staff.stfClass.index') }}"> {{ 'Department' }}</a></li>
            <li><a href="{{ route('staff.staffs.index') }}"> Staff Lists</a></li>
            <li><a href="{{ route('staff.rentbyStaff.index') }}"> Staff Rent Book Lists</a></li>
            <li><a href="{{ route('staff.requestbyStaffs.index') }}"> Staff PreRequest Book Lists</a></li>

            {{-- <li><a href="{{ route('staff.staff.index') }}"> Staff Lists</a></li>
                    <li><a href="{{ route('stduent.bookRent.index') }}"> Stduent Rent Book Lists</a></li>
                    <li><a href="{{ route('stduent.preRequestBooks.index') }}"> PreRequest Book Lists</a></li> --}}
</li>
</ul>
<!-- Left navbar-header end -->
</div>
</li>
<!-- /.User Management -->
</ul>
</div>
