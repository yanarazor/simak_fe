<?php
	Assets::add_css( array(
		'font-awesome.min.css',
		'ionicons.min.css',
	));

	if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
		Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
	}
	$mainmenu = $this->uri->segment(2);
	$menu = $this->uri->segment(3);
	$submenu = $this->uri->segment(4);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title') ?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex" />
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/css/bootstrap.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/dist/css/AdminLTE.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/adminlte/dist/css/skins/_all-skins.min.css">
   	<script src="<?php echo base_url(); ?>themes/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
   	<?php echo Assets::css(null, true); ?> 
</head> 

<body class="skin-blue sidebar-mini <?php echo (isset($collapse) and $collapse) ? "sidebar-collapse" : ""; ?>">
 
<div id="wrapper">

<header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url();?>assets/images/logo.png" height="25"/></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      	<img src="<?php echo base_url();?>assets/images/logo.png" height="25"/> 
      		<?php
				echo $this->settings_lib->item('site.title');
			?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $this->settings_lib->item('site.urlphotomahasiswa'); ?><?php echo isset($current_user->foto) ? $current_user->foto : "noimage.jpg" ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo $this->settings_lib->item('site.urlphotomahasiswa'); ?><?php echo isset($current_user->foto) ? $current_user->foto : "noimage.jpg" ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?>
                  <small>Role : <?php echo isset($current_user->role_name) ? $current_user->role_name : "" ?></small>
                </p>
              </li>
              <!-- Menu Body -->
               
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url(SITE_AREA .'/settings/users/edit') ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo isset($totalmsg) ? $totalmsg : 0; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda punya <?php echo isset($totalmsg) ? $totalmsg : 0; ?> pesan</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                <?php
                if(isset($messages) && is_array($messages) && count($messages)):
				   $i=1;
				   foreach ($messages as $message) : 
				?>
                  <li><!-- start message -->
                    <a href="<?php echo base_url(); ?>admin/nilai/nilai_mahasiswa/lihatmateri/<?php echo $message->id_materi; ?>">
                      <div class="pull-left">
                      	<img src="<?php echo $this->settings_lib->item('site.urlphotomahasiswa'); ?><?php echo "noimage.jpg" ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php
                        echo $message->dari_nama;
                        ?>
                        <small><i class="fa fa-clock-o"></i> 
                        <?php
                        echo $message->tanggal;
                        ?></small>
                      </h4>
                      <p><?php
                        echo $message->pesan;
                        ?></p>
                    </a>
                  </li>
          		<?php
          		endforeach;
          		endif;
          		?>
                </ul>
              </li>
            </ul>
          </li>
          
          <!-- Control Sidebar Toggle Button -->
           
        </ul>
      </div>
    </nav>
  </header>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $this->settings_lib->item('site.urlphotomahasiswa'); ?><?php echo isset($current_user->foto) ? $current_user->foto : "noimage.jpg" ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?></p>
          <a href="<?php echo base_url();?>admin/settings/users/uploadfoto" class="show-modal" tooltip="Upload Foto"><i class="fa fa-image text-success"></i> Ubah Foto</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php if ($this->auth->has_permission('Dashboard_kprd.Reports.View')) : ?>
        	<li class="treeview <?php echo $menu == 'dashboard' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/dashboard_kprd">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Dashboard</span>    
          		</a>
          </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Dashboard.Reports.View')) : ?>
        	<li class="treeview <?php echo $menu == 'dashboard' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/dashboard">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Dashboard</span>    
          		</a>
          </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Datakrs.Krs.View')) : ?>
        	<li class="treeview <?php echo $menu == 'datakrs' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/krs/datakrs">
	            	<i class="fa fa-list"></i>
    	        	<span>KRS</span>    
          		</a>
          </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Konfirmasi_pembayaran.Pembayaran.View')) : ?>
        	<li class="treeview <?php echo $menu == 'konfirmasi_pembayaran' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/pembayaran/konfirmasi_pembayaran">
	            	<i class="fa fa-money"></i>
    	        	<span>Konfirmasi Pembayaran</span>    
          		</a>
          </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Dashboar_dsn.Reports.View')) : ?>
        	<li class="treeview <?php echo $menu == 'dashboard' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/dashboar_dsn">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Dashboard</span>    
          		</a>
          </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Dokumen.Master.View')) : ?>
        	<li class="treeview <?php echo $menu == 'dashboard' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/master/dokumen">
	            	<i class="fa fa-list"></i>
    	        	<span>Dokumen</span>    
          		</a>
          </li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

