<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    @if (auth()->user()->role_id == 1)
        <a class="navbar-brand ps-3" href="/dashboard/admin">CV. Cahaya Bintang</a>
    @elseif (auth()->user()->role_id == 2)
        <a class="navbar-brand ps-3" href="/dashboard/bendahara">CV. Cahaya Bintang</a>
    @else
        <a class="navbar-brand ps-3" href="/dashboard/karyawan">CV. Cahaya Bintang</a>
    @endif

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

    {{--  Navbar Search --}}
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 opacity-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" disabled/>
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                

                @if (auth()->user()->role_id == 3)
                    <li><a class="dropdown-item" href="/dashboard/karyawan/profile">My Profile</a></li>
                    <li><a class="dropdown-item" href="/dashboard/karyawan/change-password">Ganti Password</a></li>
                @else
                    <li><a class="dropdown-item" href="/profile">My Profile</a></li>
                    <li><a class="dropdown-item" href="/profile/ganti-password">Ganti Password</a></li>
                @endif
                <li><hr class="dropdown-divider" /></li>
                    
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">Sign out</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>