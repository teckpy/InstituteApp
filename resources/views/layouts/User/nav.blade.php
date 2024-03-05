<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">

        </li>
        <li class="nav-item d-none d-sm-inline-block">

        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item mt-2">

            Welcome -@if (auth()->check())
                {{ auth()->user()->name }}
            @endif


        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>


                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <div class="brand-image" style="height: 40px;margin-top:0%">
                    <i class='fas fa-user-alt' style='font-size:24px'></i>
                    {{-- <img style="height: 40px;margin-top:0%" src="{{ asset('Admin/dist/img/user2-160x160.jpg') }}"
                        class="img-circle elevation-2" alt="User Image"> --}}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    @if (auth()->check())
                        {{ auth()->user()->name }}
                    @endif
                </span>
                <div class="dropdown-divider"></div>
                {{-- <a href="#" class="dropdown-item">
                  profile
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a> --}}

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="dropdown-item dropdown-footer" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                        class="nav-link"><i class='fas fa-sign-out-alt' style='font-size:15px'></i> &nbsp;Logout</a>
                </form>
            </div>
        </li>
        {{-- <li class="nav-item">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <div class="brand-image">
                        <img style="height: 40px;margin-top:0%" src="{{ asset('Admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                </div>
            </li>
        </li> --}}
    </ul>
</nav>
