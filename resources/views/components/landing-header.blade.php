<!--start header-->
<header class="top-header" id="Parent_Scroll_Div">
    <nav class="navbar navbar-expand-xl align-items-center gap-3 container px-4 px-lg-0">
        <div class="logo-header d-none d-xl-flex align-items-center gap-2">
            <div class="logo-icon">
                <img src="{{ asset('assets/images/logo-bayar-air.png') }}" class="logo-img" width="45" alt="">
            </div>
            <div class="logo-name">
                <h5 class="mb-0">Bayar Air</h5>
            </div>
        </div>
        <div class="btn-toggle d-xl-none" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
            <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
        </div>

        <div class="offcanvas offcanvas-start w-260" tabindex="-1" id="offcanvasNavbar">
            <div class="offcanvas-header border-bottom h-70">
                <div class="d-flex align-items-center gap-2">
                    <div class="">
                        <img src="{{ asset('assets/images/logo-bayar-air.png') }}" class="logo-icon" width="45"
                            alt="logo icon">
                    </div>
                    <div class="">
                        <h4 class="logo-text">Bayar Air</h4>
                    </div>
                </div>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="offcanvas-body p-0 primary-menu">
                <ul class="navbar-nav align-items-center mx-auto w-max gap-0 gap-xl-1">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">
                            <div class="parent-icon"><i class="material-icons-outlined">home</i>
                            </div>
                            <div class="menu-title">Home</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#About">
                            <div class="parent-icon"><i class="material-icons-outlined">info</i>
                            </div>
                            <div class="menu-title">About</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Services">
                            <div class="parent-icon"><i class="material-icons-outlined">work_outline</i>
                            </div>
                            <div class="menu-title">Services</div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Team">
                            <div class="parent-icon"><i class="material-icons-outlined">people_alt</i>
                            </div>
                            <div class="menu-title">Team</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="">
            <a class="btn btn-grd btn-grd-primary raised d-flex align-items-center rounded-5 gap-2 px-4" href="{{ route('login') }}">
                <i class="material-icons-outlined">account_circle</i>Login
            </a>
        </div>
    </nav>
</header>
<!--end top header-->
