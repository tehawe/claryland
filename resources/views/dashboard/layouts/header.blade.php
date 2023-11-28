<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">
        <img src="http://127.0.0.1:8000/img/claryland-text.png" alt="ClaryLand" height="50" />
    </a>
    <div class="text-white pe-5 dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" ata-bs-display="static" aria-expanded="false">
            <i class="myicon bi-person-circle"></i><span>{{ Auth::user()->name }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-sm-end">
            <li><a class="dropdown-item" href="/dashboard/users/{{ Auth::user()->username }}"><i class="myicon bi-gear"></i>Setting</a></li>
            <li>
                <a class="dropdown-item" href="#">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="bg-dark border-0"><i class="myicon bi-box-arrow-right"></i>Logout</button>
                    </form>
                </a>
            </li>
        </ul>
    </div>
    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi-list"></i>
            </button>
        </li>
    </ul>
</header>
