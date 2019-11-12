
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="view/dist/img/scv_icon.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p class="profile_name"></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
        </div>
      </div>

      <!-- Dependiendo el perfil del usuario el menu debera cambiar -->
      <?php if ( $_SESSION['perfil'] == 'Solicitante' ): ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Perfil: Solicitante </li>
          <?php foreach ($_SESSION['modulos'] as $key => $v): ?>
            <?php if ( strpos($v->n_short, 'add') !== false ): ?>
              <?php if ( strpos($v->n_short, 'add') >= 0 ): ?>
                <li id="<?=$v->n_short?>" class="" onclick="apply_active('<?=$v->n_short?>');">
                  <a href="index.php?menu=<?=$v->n_short?>">
                    <i class="fa fa-pencil"></i>
                    <span><?=$v->n_long?></span>
                  </a>
                </li>
              <?php endif ?>
            <?php endif ?>
            <?php if ( strpos($v->n_short, 'list') !== false ): ?>
              <li id="<?=$v->n_short?>" class="" onclick="apply_active('<?=$v->n_short?>');">
                <a href="index.php?menu=<?=$v->n_short?>">
                  <i class="fa fa-list"></i>
                  <span><?=$v->n_long?></span>
                </a>
              </li>
            <?php endif ?>

          <?php endforeach ?>
        </ul>
      <?php elseif ( $_SESSION['perfil'] == 'Habilitado' ): ?>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Perfil: Habilitado vehicular </li>
          <li class="treeview " style="height: auto;" id="tree_add">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>Alta</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="add_car"><a href="index.php?menu=add_car"><i class="fa fa-car"></i> Vehículo</a></li>
              <li id="add_taller"><a href="index.php?menu=add_taller"><i class="fa fa-building-o"></i> Taller</a></li>
              <li id="add_chofer"><a href="index.php?menu=add_chofer"><i class="fa fa-users"></i> Conductores</a></li>
            </ul>
          </li>
          <li class="treeview " style="height: auto;" id="tree_list">
            <a href="#">
              <i class="fa fa-list"></i> <span>Listados</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="list_car"><a href="index.php?menu=list_car"><i class="fa fa-car"></i> Vehículo</a></li>
              <li id="list_taller"><a href="index.php?menu=list_taller"><i class="fa fa-building-o"></i> Taller</a></li>
              <li id="list_sol"><a href="index.php?menu=list_sol"><i class="fa fa-book"></i> Solicitudes</a></li>
            </ul>
          </li>
          <li>
            <a href="index.php?menu=eventos">
              <i class="fa fa-calendar"></i> <span> Eventos programados </span>
            </a>
          </li> 
          <!-- <li>
                    <a href="pages/widgets.html">
                      <i class="fa fa-trash"></i> <span>Bajas</span>
                    </a>
                  </li> -->        
        </ul>
      <?php endif ?>
    </section>
  </aside>

