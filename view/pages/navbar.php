
<header class="main-header">

    <!-- Logo -->
    <a href="index.php?menu=general" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SCV</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CTRL. VEHICULAR</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
            <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" onclick="" >
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger campanita">0</span>
            </a>
          </li>
            
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="view/dist/img/scv_icon.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs profile_name"></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="view/dist/img/scv_icon.png" class="img-circle" alt="User Image">

                <p class="profile_name">NOMBRE DE USUARIO</p>
                <p>
                  <small><?=$_SESSION['perfil']?></small>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <button type="button" class="btn btn-danger btn-flat" onclick="logout();">Salir de ST</button>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

