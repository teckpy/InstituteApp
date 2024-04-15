<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('Admin/dist/img/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">
            @if (auth()->check())
                {{ auth()->user()->name }}
            @endif
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">PROFILE</li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Examination
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: @if (Request::segment(1) == 'Result' || Request::segment(2) == 'paid-exam') block @else none @endif;">
                        <li class="nav-item ">
                            <a href="{{route('paidExam')}}" class="nav-link @if (Request::segment(2) == 'paid-exam') active @endif;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paid Exam</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('result') }}" class="nav-link @if (Request::segment(1) == 'Result') active @endif;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Result</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <br><br>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
