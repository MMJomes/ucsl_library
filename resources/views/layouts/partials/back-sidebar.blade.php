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

                    {{-- <li><a href="{{ route('backend.memberLists.index') }}"> Member Lists</a></li> --}}
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
            <a href="javascript:void(0)"><i class="fa fa-users"></i></a>
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
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false"><span class="hide-menu">{{ __('message.setting') }}</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{ route('backend.settings.index') }}">{{ __('message.setting') }}</a></li>
                            <li><a href="{{ route('backend.settings.index') }}">{{ __('message.township') }}</a></li>
                        </ul>
                    </li>
                    {{-- <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false"></i><span
                                class="hide-menu">{{ __('message.changelanguage') }}</span></a>
                        <ul aria-expanded="true" class="collapse">
                            <li>
                                <div class="dropdown">
                                    @php
                                        $langData = Config::get('languages')[App::getLocale()];
                                    @endphp
                                    <button class="btn btn-light dropdown-toggle px-1 mx-1" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img src="{{ asset($langData['flag']) }}" alt="language" width="20"
                                            class="my-auto">
                                        <span class="ml-1">{{ $langData['name'] }}</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach (Config::get('languages') as $lang => $language)
                                            <a class="dropdown-item py-2 px-2"
                                                href="@if ($lang == App::getLocale()) javascript:; @else {{ route('lang.switch', $lang) }} @endif">
                                                <img src="{{ asset($language['flag']) }}" alt="language"
                                                    width="20">
                                                <span class="ml-1">{{ $language['name'] }}</span>
                                                @if ($lang == App::getLocale())
                                                    <span class="float-right my-auto">
                                                        <i class="fa fa-check text-success" aria-hidden="true"></i>
                                                    </span>
                                                @endif
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li> --}}
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false"><span class="hide-menu">{{ __('message.changelanguage') }}</span></a>
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
            <a href="javascript:void(0)"><i class="ti-layout-grid2"></i></a>
            <div class="sidebarmenu">
                <!-- Left navbar-header -->
                <h3 class="menu-title">Student</h3>
                <div class="searchable-menu">
                    <form role="search" class="menu-search">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </div>
                <ul class="sidebar-menu">
                    <li><a href="{{ route('student.stdclass.index') }}"> {{ ('Classes') }}</a></li>

                    {{-- <li><a href="{{ route('backend.memberLists.index') }}"> Member Lists</a></li> --}}
                    {{-- <li><a href="{{ route('backend.category.index') }}"> {{ __('message.category') }}</a></li>
                    <li><a href="{{ route('backend.author.index') }}"> {{ __('message.author') }}</a></li>
                    <li><a href="{{ route('backend.book.index') }}"> {{ __('message.books') }}</a></li> --}}
                    {{-- <li><a href="{{ route('backend.mainbusiness.index') }}"> Main Business </a></li>
                    <li><a href="{{ route('backend.sidebusiness.index') }}"> Side Business </a></li>
                  --}}
                </li>
                </ul>
                <!-- Left navbar-header end -->
            </div>
        </li>
        <!-- /.User Management -->
    </ul>
</div>
