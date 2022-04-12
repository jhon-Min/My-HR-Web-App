<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <i class="bx bx-layer nav_logo-icon text-dark fs-3"></i>
                <span class="nav_logo-name">My HR</span>
            </a>
            <div class="nav_list">
                <x-menu-item link="{{ route('home') }}" icon="fa-solid fa-house">Dashboard</x-menu-item>

                <x-menu-item link="{{ route('employee.index') }}" icon="fa-solid fa-users">Employees</x-menu-item>

                <x-menu-item link="{{ route('department.index') }}" icon="fa-solid fa-building-user">Departments
                </x-menu-item>

                <a href="#" class="nav_link">
                    <i class="fa-solid fa-book-open"></i>
                    <span class="nav_name">Attendance</span>
                </a>

                <a href="#" class="nav_link">
                    <i class="fa-solid fa-users-gear"></i>
                    <span class="nav_name">Role</span>
                </a>
            </div>
        </div>
        <a href="{{ route('logout') }}" class="nav_link" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-right-from-bracket text-danger"></i>
            <span class="text-danger">SignOut</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>
