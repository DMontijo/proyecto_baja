<style>
  .sidebar-dark-primary {
    background: #511229 !important;
  }

  .nav-sidebar>.nav-item>.nav-link.active {
    background: #bf9b55 !important;
  }

  .nav-treeview>.nav-item>.nav-link.active,
  [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus,
  [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
    background: #bf9b55 !important;
    color: #fff;
  }

  [class*=sidebar-dark] .brand-link {
    border-bottom: 1px solid #ffffff !important;
  }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url() ?>/admin/dashboard" class="brand-link">
    <img src="<?= base_url() ?>/assets/img/FGEBC.png" alt="FGEBC Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-bold">JUSTICIA</span>
  </a>

  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= base_url() ?>/justicia/dashboard" class="nav-link <?php if ($menu === 'dashboard') echo 'active' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Principal
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url() ?>/justicia/dashboard/atencion" class="nav-link <?php if ($menu === 'videodenuncia') echo 'active' ?>">
            <i class="nav-icon fa fa-video"></i>
            <p>
              Videollamadas
            </p>
          </a>
        </li>
        <li class="nav-item <?php if ($menu === 'usuarios') echo 'menu-open' ?>">
          <a href="#" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>
              Usuarios <i class="fas fa-angle-down right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link <?php if ($menu === 'registrar_usuario') echo 'active' ?>">
                <i class="far fa-user nav-icon"></i>
                <p>Registrar usuario</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link <?php if ($menu === 'listar_usuario') echo 'active' ?>">
                <i class="fas fa-list-ul nav-icon"></i>
                <p>Listar usuario</p>
              </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link <?php if ($menu === 'perfil_usuario') echo 'active' ?>">
                <i class="far fa-address-card nav-icon"></i>
                <p>Perfiles</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</aside>