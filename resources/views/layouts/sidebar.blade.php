<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                {{-- <div class="sb-sidenav-menu-heading">Core</div> --}}

                <div class="ms-3 mt-1 fs-6 fw-bold {{ Request::is('dashboard/admin') || Request::is('dashboard/bendahara') || Request::is('dashboard/karyawan') ? 'text-light' : '' }}">DASHBOARD</div>

                {{-- Jika bukan Admin maka linknya berbeda --}}
                @if (auth()->user()->role_id == 1)
                    <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard/admin">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                @elseif (auth()->user()->role_id == 2)
                    <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="/dashboard/bendahara">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                @else
                    <a class="nav-link {{ Request::is('dashboard/karyawan') ? 'active' : '' }}" href="/dashboard/karyawan">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-tachometer-alt"></i></div>
                        Dashboard Karyawan
                    </a>
                @endif

                {{-- TRANSAKSI --}}
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                    <div class="ms-3 mt-2 fs-6 fw-bold {{ Request::is('data*') ? 'text-light' : '' }}">TRANSAKSI</div>
                    <a class="nav-link {{ Request::is('data/pemasukan*') ? 'active' : '' }}" href="/data/pemasukan">
                        <div class="sb-nav-link-icon text-success"><i class="fa-fw fas fa-arrow-up"></i></div>
                        Pemasukan
                    </a>
                    <a class="nav-link {{ Request::is('data/pengeluaran*') ? 'active' : '' }}" href="/data/pengeluaran">
                        <div class="sb-nav-link-icon text-danger"><i class="fa-fw fas fa-arrow-down"></i></div>
                        Pengeluaran
                    </a>
                @endif
                {{-- END OF TRANSAKSI --}}


                {{-- MENU SIDEBAR INI TAMPIL UNTUK ROLE ADMIN & BENDAHARA --}}
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                    {{-- MASTER DATA --}}
                    @if (Request::is('users*') || Request::is('hutang*') || Request::is('gaji*') || Request::is('karyawan*'))
                        <div class="ms-3 mt-2 fs-6 fw-bold text-light">MASTER DATA</div>
                    @else
                        <div class="ms-3 mt-2 fs-6 fw-bold">MASTER DATA</div>
                    @endif

                    {{-- Menu ini hanya muncul jika rolenya super admin --}}
                    @if (auth()->user()->role_id == 1)
                        <a class="nav-link {{ Request::is('users*') ? 'active' : '' }}" href="/users">
                            <div class="sb-nav-link-icon"><i class="fa-fw fas fa-user"></i></div>
                            User Management
                        </a>
                    @endif

                    <a class="nav-link {{ Request::is('hutang*') ? 'active' : '' }}" href="/hutang">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-credit-card"></i></div>
                        Hutang
                    </a>

                    

                    @if (auth()->user()->role_id == 1)
                        <a class="nav-link {{ Request::is('karyawan*') ? 'active' : '' }}" href="/karyawan">
                            <div class="sb-nav-link-icon"><i class="fa-fw fas fa-users"></i></div>
                            Karyawan
                        </a>
                    @endif


                    <a class="nav-link {{ Request::is('gaji*') ? 'active' : '' }}" href="/gaji-karyawan">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-sack-dollar"></i></div>
                        Penggajian
                    </a>
                    {{-- END OF MASTER DATA --}}


                    {{-- REPORT --}}
                    <div class="ms-3 mt-2 fs-6 fw-bold {{ Request::is('cetak-laporan*') ? 'text-light' : '' }}">REPORT</div>

                    <a class="nav-link {{ Request::is('cetak-laporan*') ? 'active' : '' }}" href="/cetak-laporan">
                        <div class="sb-nav-link-icon"><i class="fa fa-file"></i></div>
                        Laporan
                    </a>
                    {{-- END OF REPORT --}}
                @endif

                @if (auth()->user()->role_id == 3)
                    {{-- MENU KARYAWAN --}}
                    <div class="ms-3 mt-3 fs-6 fw-bold {{ Request::is('dashboard/karyawan/profile*') || Request::is('dashboard/karyawan/gaji*') || Request::is('dashboard/karyawan/hutang*') || Request::is('dashboard/karyawan/ganti-password*')  ? 'text-light' : '' }}">MENU</div>

                    <a class="nav-link {{ Request::is('dashboard/karyawan/profile*') ? 'active' : '' }}" href="/dashboard/karyawan/profile">
                        <div class="sb-nav-link-icon"><i class="fa-fw fa fa-user"></i></div>
                        My Profile
                    </a>
                    <a class="nav-link {{ Request::is('dashboard/karyawan/gaji') ? 'active' : '' }}" href="/dashboard/karyawan/gaji">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-sack-dollar"></i></div>
                        Gaji Saya
                    </a>
                    <a class="nav-link {{ Request::is('dashboard/karyawan/hutang*') ? 'active' : '' }}" href="/dashboard/karyawan/hutang">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-credit-card"></i></div>
                        Pinjam Hutang
                    </a>
                    <a class="nav-link {{ Request::is('dashboard/karyawan/change-password*') ? 'active' : '' }}" href="/dashboard/karyawan/change-password">
                        <div class="sb-nav-link-icon"><i class="fa-fw fas fa-lock"></i></div>
                        Ganti Password
                    </a>
                @endif
                
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->employee->nama }} - {{ auth()->user()->role->role_name }}
        </div>
    </nav>
</div>