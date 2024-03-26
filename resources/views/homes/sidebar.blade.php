<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-profile">
        @php
            $staff_id  = session('staff_id');

            $staff = App\Models\StaffModel::where('staff_id', $staff_id)->first();
            $imageFileName = $staff->images; // Lấy tên tệp ảnh từ cột images
            $imagePath = public_path('resources/images/Faces/' . $imageFileName); // Tạo đường dẫn tuyệt đối đến tệp ảnh

        @endphp

        @if($staff)
            <div class="user-image">
                <img src="{{ asset('resources/images/Faces/' . $staff->images) }}">

            </div>
            <div class="user-name"> StaffID:
                {{ $staff->staff_id }}

            </div>
            <div class="user-name">
                {{ $staff->email }}
            </div>
            <div class="user-designation">
                {{ $staff->staffname }}
            </div>
            <div class="user-designation">
                @if($staff->faculty_id)
                    Faculty ID: {{ $staff->faculty_id }}
                @else
                    Faculty ID: 0
                @endif
                @if($staff->faculty)
                    ({{ $staff->faculty->faculty_name }})
                @endif
            </div>
        @endif

    </div>

    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/dashboard')}}">
                <i class="icon-box menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(auth()->check() &&  auth()->user()->role_id == 1)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="icon-disc menu-icon"></i>
                    <span class="menu-title">Users Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('Users.list-user') }}">Users Management</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('students.list-student')}}">Students Management</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('staffs.list-staff')}}">Staffs Management</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('contributions.list-contribution')}}">Contribution Management</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('roles.list-role')}}">Roles Management</a></li>
                    </ul>
                </div>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <i class="icon-file menu-icon"></i>
                <span class="menu-title">Form elements</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <i class="icon-pie-graph menu-icon"></i>
                <span class="menu-title">Charts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <i class="icon-command menu-icon"></i>
                <span class="menu-title">Tables</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/icons/feather-icons.html">
                <i class="icon-help menu-icon"></i>
                <span class="menu-title">Icons</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{URL::to('/logout')}}">
                <i class="icon-book menu-icon"></i>
                <span class="menu-title">Logout</span>
            </a>
        </li>
    </ul>
</nav>
