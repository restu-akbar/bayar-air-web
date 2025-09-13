<!--start sidebar-->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="logo-icon">
            <img src="{{ asset('assets/images/logo-bayar-air.png') }}" class="logo-img" alt="Logo">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">Bayar Air</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-icons-outlined">close</span>
        </div>
    </div>
    <div class="sidebar-nav overflow-y-auto">
        <!--navigation-->
        <ul class="metismenu" id="sidenav">
            <!--Module section-->
            <li>
                <a href="{{ route('dashboard') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">home</i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <!--Section-->
            <li class="menu-label">Modul</li>
            <li>
                <a href="{{ route('laporan.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">bar_chart</i>
                    </div>
                    <div class="menu-title">Laporan</div>
                </a>
            </li>
            <!--Master-->
            <li class="menu-label">Master</li>
            <li>
                <a href="{{ route('pelanggan.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">person</i></div>
                    <div class="menu-title">Pelanggan</div>
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">person_add</i></div>
                    <div class="menu-title">User</div>
                </a>
            </li>
            <li>
                <a href="{{ route('setting.index') }}">
                    <div class="parent-icon"><i class="material-icons-outlined">settings</i></div>
                    <div class="menu-title">Settings</div>
                </a>
            </li>
            {{-- <li class="menu-label">template</li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="material-icons-outlined">face_5</i>
                    </div>
                    <div class="menu-title">Menu Levels</div>
                </a>
                <ul>
                    <li><a class="has-arrow" href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Level
                            One</a>
                        <ul>
                            <li><a class="has-arrow" href="javascript:;"><i
                                        class="material-icons-outlined">arrow_right</i>Level
                                    Two</a>
                                <ul>
                                    <li><a href="javascript:;"><i class="material-icons-outlined">arrow_right</i>Level
                                            Three</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascrpt:;">
                    <div class="parent-icon"><i class="material-icons-outlined">description</i>
                    </div>
                    <div class="menu-title">Documentation</div>
                </a>
            </li>
            <li>
                <a href="javascrpt:;">
                    <div class="parent-icon"><i class="material-icons-outlined">support</i>
                    </div>
                    <div class="menu-title">Support</div>
                </a>
            </li>
        </ul>
        <!--end navigation--> --}}
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="parent-icon"><i class="material-icons-outlined">logout</i></div>
                    <div class="menu-title">Logout</div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

    </div>
</aside>
<!--end sidebar-->
