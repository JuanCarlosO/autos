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
          
          <?php if ( $_SESSION['perfil'] == 2 ): ?>
            <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle"onclick="load_solicitudesNvas();" >
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger campanita">0</span>
            </a>
            
          </li>
            
          <?php endif ?>
          
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

                <p class="profile_name"></p>
                <p>
                  <small><?php 
                  switch ($_SESSION['perfil']) {
                    case '1':
                      echo "SOLICITANTE";
                      break;
                    case '2':
                      echo "SOPORTE TÉCNICO";
                      break;
                    case '3':
                      echo "TECNOLOGÍAS DE LA INFORMACIÓN";
                      break;
                    case '4':
                      echo "BIENES";
                      break;
                    case '5':
                      echo "";
                      break;
                  }
                  ?></small>
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
          <!-- Control Sidebar Toggle Button -->
          <?php if ( $_SESSION['perfil'] == 2 ): ?>
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          <?php endif ?>
        </ul>
      </div>
    </nav>
  </header>