<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/images/download.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <router-link to="/home" class="d-block">Admin</router-link>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview">
              <router-link  to="/home" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  Dashboard
                  {{-- <i class="right fa fa-angle-left"></i> --}}
                </p>
              </router-link>
              {{-- <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../../index.html" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Dashboard v1</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../index2.html" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Dashboard v2</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../index3.html" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Dashboard v3</p>
                  </a>
                </li>
              </ul> --}}
            </li>

          <li class="nav-item has-treeview">
              <router-link  to="/categoryList" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  Category
                  {{-- <i class="right fa fa-angle-left"></i> --}}
                </p>
              </router-link>
              {{-- <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../../index.html" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Dashboard v1</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../index2.html" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Dashboard v2</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../index3.html" class="nav-link">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>Dashboard v3</p>
                  </a>
                </li>
              </ul> --}}
            </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
