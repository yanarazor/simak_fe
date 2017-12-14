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
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title') ?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex" />
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/bootstrap.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/dist/css/AdminLTE.min.css">
   	<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/dist/css/skins/_all-skins.min.css">
   	<?php echo Assets::css(null, true); ?> 
</head> 

<body class="skin-blue sidebar-mini">
 
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
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?>
                  <small>Member since Nov. 2012</small>
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

    </nav>
  </header>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/images/noimage.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
        <?php if ($this->auth->has_permission('Dashboard.Reports.View')) : ?>
        	<li class="treeview <?php echo $mainmenu == 'masters' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/dashboard">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Dashboard</span>    
          		</a>
          </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Dashboard.Reports.Viewadm')) : ?>
        	<li class="treeview <?php echo $mainmenu == 'masters' ? 'active' : '' ?>">
        		<a href="<?php echo base_url();?>admin/reports/dashboard/adm">
	            	<i class="fa fa-dashboard"></i>
    	        	<span>Dashboard</span>    
          		</a>
          </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Site.Masters.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'masters' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>MASTER DATA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	<?php if ($this->auth->has_permission('data_ptp.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/data_ptp"><i class="fa fa-circle-o"></i>Data PTP</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('jenjang.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/jenjang"><i class="fa fa-circle-o"></i>Jenjang Fungsional</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('kepangkatan.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/kepangkatan"><i class="fa fa-circle-o"></i>Kepangkatan</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('unsur_pendidikan.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/unsur_pendidikan"><i class="fa fa-circle-o"></i>Unsur Pendidikan</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('unsur_ptp.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/unsur_ptp"><i class="fa fa-circle-o"></i>Unsur PTP</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('unsur_pp.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/unsur_pp"><i class="fa fa-circle-o"></i>Unsur Pengembangan</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('unsur_pt.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/unsur_pt"><i class="fa fa-circle-o"></i>Unsur Penunjang</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('instansi.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/instansi"><i class="fa fa-circle-o"></i>Instansi</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('penugasan_ptp.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/penugasan_ptp"><i class="fa fa-circle-o"></i>Penugasan PTP</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('data_pejabat.Masters.View')) : ?>
            	<li><a href="<?php echo base_url();?>admin/masters/data_pejabat"><i class="fa fa-circle-o"></i>Data Pejabat</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('kode_administratif.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/kode_administratif"><i class="fa fa-circle-o"></i>Kode Administratif</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('kode_penilaian.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/kode_penilaian"><i class="fa fa-circle-o"></i>Kode Penilaian</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('status_pengajuan.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/status_pengajuan"><i class="fa fa-circle-o"></i>Status Pengajuan</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('eselontiga.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/eselontiga"><i class="fa fa-circle-o"></i>Eselon 3</a></li>
             <?php endif; ?>
            <?php if ($this->auth->has_permission('eselonempat.Masters.View')) : ?>
            <li><a href="<?php echo base_url();?>admin/masters/eselonempat"><i class="fa fa-circle-o"></i>Eselon 4</a></li>
            <?php endif; ?>
          </ul>
        </li>
         <?php endif; ?>
    	<?php if ($this->auth->has_permission('Site.Spmk.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'spmk' ? 'active' : 'active' ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>PENGAJUAN AK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
          <ul class="treeview-menu">
           <?php if ($this->auth->has_permission('SPMK_Pendidikan.Spmk.Create')) : ?>
          	<li class="<?php echo $mainmenu == 'spmk' ? 'active' : '' ?>">
              <a href="<?php echo base_url();?>admin/settings/emailer"><i class="fa fa-circle-o"></i>SPMK
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
              	<?php if ($this->auth->has_permission('SPMK_Pendidikan.Spmk.View')) : ?>
            	<li><a href="<?php echo base_url();?>admin/spmk/spmk_pendidikan"><i class="fa fa-circle-o"></i> SPMK Pendidikan</a></li>
				<?php endif; ?>
				<?php if ($this->auth->has_permission('SPMK_PTP.Spmk.View')) : ?>
					<li><a href="<?php echo base_url();?>admin/spmk/spmk_ptp"><i class="fa fa-circle-o"></i> SPMK PTP</a></li>
				<?php endif; ?>
				<?php if ($this->auth->has_permission('spmk_pp.Spmk.View')) : ?>
					<li><a href="<?php echo base_url();?>admin/spmk/spmk_pp"><i class="fa fa-circle-o"></i> SPMK Pengembangan</a></li>
				<?php endif; ?>
				<?php if ($this->auth->has_permission('spmk_pt.Spmk.View')) : ?>
					<li><a href="<?php echo base_url();?>admin/spmk/spmk_pt"><i class="fa fa-circle-o"></i> SPMK Penunjang Tugas</a></li>
				<?php endif; ?> 
              </ul>
            </li>
            <?php endif; ?> 
            <?php if ($this->auth->has_permission('Pengajuan.Spmk.Submit')) : ?>
            	<li><a href="<?php echo base_url() ?>admin/spmk/pengajuan/submit/"><i class="fa fa-circle-o"></i> DUPAK</a></li>
            <?php endif; ?> 
            <?php if ($this->auth->has_permission('Pengajuan.Spmk.Submit')) : ?>
            <li><a href="<?php echo base_url();?>admin/spmk/pengajuan"><i class="fa fa-circle-o"></i> Histori Pengajuan</a></li>
           <?php endif; ?>
           <?php if ($this->auth->has_permission('Pengajuan.Spmk.VerifikasiAtasa')) : ?>
            <li><a href="<?php echo base_url();?>admin/spmk/pengajuan/viewatasan"><i class="fa fa-circle-o"></i> Daftar Pengajuan</a></li>
           <?php endif; ?>
           <?php if ($this->auth->has_permission('Pengajuan.Spmk.Vfkabag')) : ?>
            <li><a href="<?php echo base_url();?>admin/spmk/pengajuan/viewkabag"><i class="fa fa-circle-o"></i> Daftar Pengajuan</a></li>
           <?php endif; ?>
        	<?php if ($this->auth->has_permission('Pengajuan.Spmk.Vfpengendali')) : ?>
            	<li><a href="<?php echo base_url();?>admin/spmk/pengajuan/viewpengendali"><i class="fa fa-circle-o"></i> Daftar Pengajuan</a></li>
           <?php endif; ?> 
           <?php if ($this->auth->has_permission('Pengajuan.Spmk.Viewadm')) : ?>
            <li><a href="<?php echo base_url();?>admin/spmk/pengajuan/viewadm"><i class="fa fa-circle-o"></i> Daftar Pengajuan</a></li>
           <?php endif; ?>
           <?php if ($this->auth->has_permission('Pengajuan.Spmk.Verifikasi')) : ?>
            <li><a href="<?php echo base_url();?>admin/spmk/pengajuan/viewfv"><i class="fa fa-circle-o"></i> Verifikasi Pengajuan</a></li>
           <?php endif; ?>
           <?php if ($this->auth->has_permission('Mpengajuan.Masters.View')) : ?>
            	<li><a href="<?php echo base_url();?>admin/masters/mpengajuan/pengajuan"><i class="fa fa-circle-o"></i>Jumlah Pengajuan</a></li>
            <?php endif; ?>
          </ul>
        </li>
        <?php endif; ?>
        <?php if ($this->auth->has_permission('Mpengajuan.Masters.Create') and $this->auth->has_permission('Site.Masters.View')) : ?>
        <li  class="treeview <?php echo $menu == 'pengajuan' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-table"></i> <span>PERIODE PENILAIAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	 <?php if ($this->auth->has_permission('Mpengajuan.Masters.View')) : ?>
            	<li><a href="<?php echo base_url();?>admin/masters/mpengajuan"><i class="fa fa-circle-o"></i> Buka Pengajuan</a></li>
            <?php endif; ?>
          	
          </ul>
        </li>
    <?php endif; ?>
    <?php if ($this->auth->has_permission('Pak.Spmk.View')) : ?>
    <li class="treeview <?php echo $mainmenu == 'spmk' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-edit"></i> <span>HASIL PENILAIAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
           <?php if ($this->auth->has_permission('Pak.Spmk.Vw')) : ?>
            	<li><a href="<?php echo base_url();?>admin/spmk/pak/vw"><i class="fa fa-circle-o"></i>HAPAK</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('Pak.Spmk.Vw')) : ?>
            	<li><a href="<?php echo base_url();?>admin/spmk/pak/vw"><i class="fa fa-circle-o"></i>PAK</a></li>
            <?php endif; ?>
            <?php if ($this->auth->has_permission('Pak.Spmk.Adm')) : ?>
            	<li><a href="<?php echo base_url();?>admin/spmk/pak"><i class="fa fa-circle-o"></i>PAK PTP</a></li>
            <?php endif; ?>
          </ul>
        </li>
     <?php endif; ?>
    <?php if ($this->auth->has_permission('Site.Penilaian.View')) : ?>
        <li  class="treeview <?php echo $menu == 'pengajuan' ? 'active' : '' ?>">
          <a href="<?php echo base_url();?>admin/spmk/pengajuan/viewpenilai">
            <i class="fa fa-edit"></i> <span>PENILAIAN</span>
            <span class="pull-right-container">
            	
              <small class="label pull-right bg-red classnew">-</small>
              &nbsp;
            </span>
            
          </a>
          <!--
          <ul class="treeview-menu">
          	<?php if ($this->auth->has_permission('Pengajuan.Spmk.ViewPenilaian')) : ?>
            	<li><a href="<?php echo base_url();?>admin/spmk/pengajuan/viewpenilai"><i class="fa fa-circle-o"></i> Pengajuan</a></li>
        	<?php endif; ?>
          </ul>
          -->
        </li>
    <?php endif; ?>
	 <?php if ($this->auth->has_permission('Site.Developer.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'developer' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>DEVELOPER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>admin/developer/sysinfo"><i class="fa fa-circle-o"></i> Informasi Sistem</a></li>
            <li><a href="<?php echo base_url();?>admin/developer/builder"><i class="fa fa-circle-o"></i> Module Builder</a></li>
             <li>
              <a href="<?php echo base_url();?>admin/settings/emailer"><i class="fa fa-circle-o"></i> Database Tools
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
              	<li><a href="<?php echo base_url();?>admin/developer/database"><i class="fa fa-circle-o"></i> Maintenance</a></li>
              	<li><a href="<?php echo base_url();?>admin/developer/database/backups"><i class="fa fa-circle-o"></i> Backups</a></li>
              	<li><a href="<?php echo base_url();?>admin/developer/migrations"><i class="fa fa-circle-o"></i> Migrations</a></li>
              </ul>
            </li>
          </ul>
        </li>
    <?php endif; ?>
    <?php if ($this->auth->has_permission('Site.Settings.View')) : ?>
        <li class="treeview <?php echo $mainmenu == 'settings' ? 'active' : '' ?>">
          <a href="#">
            <i class="fa fa-share"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          	<li><a href="<?php echo base_url();?>admin/settings/settings"><i class="fa fa-circle-o"></i> Setting</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/roles"><i class="fa fa-circle-o"></i> Role</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/users"><i class="fa fa-circle-o"></i> User</a></li>
            <li><a href="<?php echo base_url();?>admin/settings/permissions"><i class="fa fa-circle-o"></i> Permissions</a></li>
            <li>
              <a href="<?php echo base_url();?>admin/settings/emailer"><i class="fa fa-circle-o"></i> Email
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
              	<li><a href="<?php echo base_url();?>admin/settings/emailer"><i class="fa fa-circle-o"></i> Setting</a></li>
                <li><a href="<?php echo base_url();?>admin/settings/emailer/template"><i class="fa fa-circle-o"></i> Template</a></li>
				<li><a href="<?php echo base_url();?>admin/settings/emailer/queue"><i class="fa fa-circle-o"></i> Antrian</a></li>
              </ul>
            </li>
          </ul>
        </li>
    <?php endif; ?>
    <?php if($this->auth->role_id() == "7"){ ?>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Penilaian Baru</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Selesai</span></a></li>
    <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

