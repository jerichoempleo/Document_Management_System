<!-- Sidebar -->
<ul class="navbar-nav new-nav-bg sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="../admin/index.php">
    <div class="sidebar-brand-icon">
        <img src="img/PUPLogo.png" alt="">
    </div>
    <div class="sidebar-brand-text mx-3">DMS Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">
  <a class="nav-link" href="index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span>
  </a>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Admin Menu
</div>

<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'account-approval.php') echo 'active'; ?>">
  <a class="nav-link" href="account-approval.php">
    <i class="fa fa-user" aria-hidden="true"></i>
    <span>Account Approval</span>
  </a>
</li>

<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'manage-users.php') echo 'active'; ?>">
  <a class="nav-link" href="manage-users.php">
    <i class="fa fa-user" aria-hidden="true"></i>
    <span>Manage Users</span>
  </a>
</li>


<li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == 'manage-documents.php') echo 'active'; ?>">
  <a class="nav-link" href="manage-documents.php">
    <i class="fa fa-file" aria-hidden="true"></i>
    <span>Manage Documents</span>
  </a>
</li>


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item <?php if (in_array(basename($_SERVER['PHP_SELF']), ['sectors.php', 'offices.php', 'process.php'])) echo 'active'; ?>">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-cog" aria-hidden="true"></i>
        <span>Classification</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Select Classification</h6>
            <a class="collapse-item" href="sectors.php">Sectors</a>
            <a class="collapse-item" href="offices.php">Offices</a>
            <a class="collapse-item" href="process.php">Processes</a>
        </div>
    </div>
</li>


<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<hr class="sidebar-divider">

<li class="nav-item">
  <a class="nav-link" href="logout.php" data-toggle="modal" data-target="#logoutModal" style="font-size:13.6px;">
    <i class="fa fa-power-off" aria-hidden="true"></i>
      Logout
  </a>
</li>

<!--<li class="nav-item">
  <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
  <i class="fa fa-power-off" aria-hidden="true"></i>
    <span>Logout</span>
  </a>
</li>-->



</ul>

<!--End of sidebar-->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                    </button>
            </div>
                  <div class="modal-body">Select "Logout" below to go back to the admin login page.</div>
                  <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                      <a class="btn btn-primary" href="login.php">Logout</a>
                  </div>
      </div>
  </div>
</div>