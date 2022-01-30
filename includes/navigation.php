
<?php 
   $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0 pb-0 text-center" href="#"><h3>FLY BOND </h3></a>
      <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row" >
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'dashboard') ? 'active':''; ?>" href="dashboard.php">
                  Dashboard 
                </a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'customer-list' || $activePage ==  'customer-card') ? 'active':''; ?>" href="customer-list.php"> 
                  Customers
                </a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'task-list') ? 'active':''; ?>" href="task-list.php">
                  Tasks
                </a>
              </li> -->
            </ul>
          </div>
        </nav>
