<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-header">Menu</li>
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-shuttle-van"></i>
                <p>
                    Asset Perusahaan
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('driver.index') }}" class="nav-link">
                        <i class="fas fa-user-circle nav-icon"></i>
                        <p>Driver</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('helper.index') }}" class="nav-link">
                        <i class="far fa-user-circle nav-icon"></i>
                        <p>Pramugara</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('vehicle.index') }}" class="nav-link">
                        <i class="fas fa-bus nav-icon"></i>
                        <p>Unit Kendaraan</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('transaction.index') }}" class="nav-link">
                <i class="nav-icon fas fa-comments-dollar"></i>
                <p>Transaksi</p>
            </a>
        </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
