<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('Admin/dist/img/logo1.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">GSSSC</span>
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
                    <a href="{{ route('dashboard') }}" class="nav-link @if (Request::segment(2) == 'Dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">EXAMINATION</li>

                <li class="nav-item">
                    <a href="#" class="nav-link @if (Request::segment(1) == 'show-students') active @endif">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            Students
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul
                        class="nav nav-treeview"style="display: @if (Request::segment(1) == 'show-students') block @else none @endif;">
                        <li class="nav-item">
                            <a href="{{ route('Students') }}"
                                class="nav-link @if (Request::segment(1) == 'show-students') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Students List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-laptop-code"></i>
                        <p>
                            Test
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: @if (Request::segment(1) == 'Test' ||
                                Request::segment(1) == 'Subject' ||
                                Request::segment(1) == 'Question' ||
                                Request::segment(1) == 'marks' ||
                                Request::segment(2) == 'review-test') block @else none @endif;">

                        <li class="nav-item">
                            <a href="{{ route('Test.index') }}"
                                class="nav-link @if (Request::segment(1) == 'Test') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Test</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Subject.index') }}"
                                class="nav-link @if (Request::segment(1) == 'Subject') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Subject</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('Question.index') }}"
                                class="nav-link @if (Request::segment(1) == 'Question') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Question</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('marks') }}"
                                class="nav-link @if (Request::segment(1) == 'marks') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Marks</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reviewTest') }}"
                                class="nav-link @if (Request::segment(2) == 'review-test') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Review</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header"> WEBSITE</li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-header"></i>
                        <p>
                            Navbar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: @if (Request::segment(1) == 'websitemenu' || Request::segment(1) == 'image') block @else none @endif;">
                        <li class="nav-item ">
                            <a href="{{ route('menu') }}"
                                class="nav-link @if (Request::segment(1) == 'websitemenu') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Logo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('image.index') }}"
                                class="nav-link @if (Request::segment(1) == 'image') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Slider</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Feature
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link @if (Request::segment(1) == 'classes') active @endif">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Classes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('classes.index') }}"
                                class="nav-link @if (Request::segment(1) == 'classes') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Classes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Teachers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="" class="nav-link @if (Request::segment(1) == 'contact') active @endif">
                        <i class="nav-icon far fa-address-book"></i>
                        <p>
                            Contact
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: @if (Request::segment(1) == 'contact') block @else none @endif;">
                        <li class="nav-item">
                            <a href="{{ route('contact') }}"
                                class="nav-link @if (Request::segment(1) == 'contact') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comment-alt"></i>
                        <p>
                            Social Links
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('link') }}" class="nav-link">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Add</p>
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
