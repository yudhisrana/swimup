<?php $user = session()->get(); ?>
<aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/assets/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Swim Up</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar py-3">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link <?= $page == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item">
                    <a href="/master-data/kategori-umur" class="nav-link <?= $page == 'kategori-umur' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-child"></i>
                        <p>
                            Kategori Umur
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/master-data/gaya-renang" class="nav-link <?= $page == 'gaya-renang' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-swimmer"></i>
                        <p>
                            Gaya Renang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/master-data/jarak-renang" class="nav-link <?= $page == 'jarak-renang' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-random"></i>
                        <p>
                            Jarak Renang
                        </p>
                    </a>
                </li>
                <li class="nav-header">MENU</li>
                <li class="nav-item">
                    <a href="/menu/event" class="nav-link <?= $page == 'event' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Event
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/menu/registrasi-event" class="nav-link <?= $page == 'registrasi-event' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            Registrasi Event
                        </p>
                    </a>
                </li>
                <?php if ($user['role_id'] == 2) { ?>
                    <li class="nav-header">SETTING</li>
                    <li class="nav-item">
                        <a href="/setting/user" class="nav-link <?= $page == 'user' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>