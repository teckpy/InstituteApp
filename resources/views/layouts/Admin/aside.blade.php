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
                        <i class="nav-icon fa fa-globe"></i>
                        <p>
                            WEBSITE
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: @if (Request::segment(1) == 'menu' ||
                                Request::segment(1) == 'image' ||
                                Request::segment(1) == 'classes' ||
                                Request::segment(1) == 'contact' ||
                                Request::segment(1) == 'annauncement' ||
                                Request::segment(1) == 'newsletter' ||
                                Request::segment(1) == 'testimonial' ||
                                Request::segment(1) == 'pages' ||
                                Request::segment(1) == 'galleries' ||
                                Request::segment(1) == 'faq' ||
                                Request::segment(1) == 'link') block @else none @endif;">
                        <li class="nav-item ">
                            <a href="{{ route('annauncement') }}"
                                class="nav-link @if (Request::segment(1) == 'annauncement') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Annauncement</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('newsletter') }}"
                                class="nav-link @if (Request::segment(1) == 'newsletter') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Newsletter</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('testimonial') }}"
                                class="nav-link @if (Request::segment(1) == 'testimonial') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Testimonial</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('pages') }}"
                                class="nav-link @if (Request::segment(1) == 'pages') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Pages</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('galleries') }}"
                                class="nav-link @if (Request::segment(1) == 'galleries') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Galleries</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('menu') }}"
                                class="nav-link @if (Request::segment(1) == 'menu') active @endif;">
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
                        <li class="nav-item">
                            <a href="{{ route('classes.index') }}"
                                class="nav-link @if (Request::segment(1) == 'classes') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Classes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contact') }}"
                                class="nav-link @if (Request::segment(1) == 'contact') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Contact</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('link') }}"
                                class="nav-link @if (Request::segment(1) == 'link') active @endif">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Social Link</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('faq') }}"
                                class="nav-link @if (Request::segment(1) == 'faq') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>FAQ</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-globe"></i>
                        <p>
                            BLOG
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview"
                        style="display: @if (Request::segment(1) == 'blog' ||
                                Request::segment(1) == 'post' ||
                                Request::segment(1) == 'category' ||
                                Request::segment(1) == 'tag') block @else none @endif;">
                        <li class="nav-item ">
                            <a href="{{ route('blog') }}"
                                class="nav-link @if (Request::segment(1) == 'blog') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Post</p>
                            </a>
                            <a href="{{ route('categoryIndex') }}"
                                class="nav-link @if (Request::segment(1) == 'category') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Category</p>
                            </a>
                            <a href="{{ route('tagIndex') }}"
                                class="nav-link @if (Request::segment(1) == 'tag') active @endif;">
                                <i class="fa fa-chevron-right nav-icon"></i>
                                <p>Tag</p>
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
