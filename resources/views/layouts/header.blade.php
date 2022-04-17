<header class="header bg-dark" id="header">
    <div class="header_toggle">
        <i class="bx bx-menu" id="header-toggle"></i>
    </div>

    <div class="d-flex align-items-center">
        <span class="me-2 text-light fw-bold">{{ auth()->user()->name }}</span>
        <div class="dropdown">
            <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                aria-expanded="false">
                <div class="header_img">
                    <img src="{{ auth()->user()->profile_img_path() }}" alt="" />
                </div>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                    <a class="dropdown-item {{ request()->url() == route('profile.index') ? 'active' : '' }}"
                        href="{{ route('profile.index') }}">Profile</a>
                </li>

                <li>
                    <a class="dropdown-item {{ request()->url() == route('my-attendance.scanQr') ? 'active' : '' }}"
                        href="{{ route('my-attendance.scanQr') }}">My Attendance</a>
                </li>

                <li>
                    <a class="dropdown-item {{ request()->url() == route('company-info.show', 1) ? 'active' : '' }}"
                        href="{{ route('company-info.show', 1) }}">Company Information</a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket text-danger me-1"></i>
                        <span class="">Logout</span>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</header>
