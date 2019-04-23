<ul class="sidebar navbar-nav">
      <li class="nav-item <?php echo isset($open) && $open == 'dashboard' ? 'active-sidebar' : ''; ?>">
        <a class="nav-link" href="<?php echo base_url() ?>admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'category' ? 'active-sidebar' : ''; ?>">
        <a class="nav-link" href="<?php echo modules('category'); ?>">
          <i class="fas fa-fw fa-list-alt"></i>
          <span>Category</span>
        </a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'tag' ? 'active-sidebar' : ''; ?>">
        <a class="nav-link" href="<?php echo modules('tag'); ?>">
          <i class="fas fa-fw fa-tags"></i>
          <span>Tag</span>
        </a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'product' ? 'active-sidebar' : ''; ?>">
        <a class="nav-link" href="<?php echo modules('product'); ?>">
          <i class="fab fa-fw fa-product-hunt"></i>
          <span>Product</span>
        </a>
      </li>
      <li class="nav-item <?php echo isset($open) && $open == 'user' ? 'active-sidebar' : ''; ?>">
        <a class="nav-link" href="<?php echo modules('user'); ?>">
          <i class="fas fa-fw fa-user"></i>
          <span>User</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Login Screens:</h6>
          <a class="dropdown-item" href="login.html">Login</a>
          <a class="dropdown-item" href="register.html">Register</a>
          <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item active" href="blank.html">Blank Page</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
    </ul>