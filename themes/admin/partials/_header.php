<?php
	Assets::add_css( array(
		'pixel/bootstrap.min.css',
		'pixel/pixel-admin.min.css',
		'font-awesome.min.css',
		'pixel/widgets.min.css',
		//'pixel/rtl.min.css',
		'pixel/themes.min.css',
		 
		'style.css', 
	));

	if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
		Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo isset($toolbar_title) ? $toolbar_title .' : ' : ''; ?> <?php echo $this->settings_lib->item('site.title') ?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>logo.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex" />
   	<script language='JavaScript' type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.js'></script>
   	<?php echo Assets::css(null, true); ?> 
   
</head> 

<body class="theme-default main-menu-animated" style="">
<script>var showmenu = [];</script> 
<script language='JavaScript' type='text/javascript' src='<?php echo js_path();?>pixel/librari.js'></script>
<script src="<?php echo Template::theme_url('js/modernizr-2.5.3.js'); ?>"></script> 
<div id="main-wrapper">
<!-- 2. $MAIN_NAVIGATION ===========================================================================
	Main navigation
-->
	<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
		<!-- Main menu toggle -->
		<button type="button" id="main-menu-toggle">
        	<i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span>
         </button>
		
		<div class="navbar-inner">
			<!-- Main navbar header -->
			<div class="navbar-header">
				<!-- Logo -->
				 <a href="<?php echo base_url(); ?>" class="navbar-brand">
					<table border="0">
                    	<tr>
                        	<td>
                            	
                            </td>
                            <td>&nbsp;
                            
                            </td>
                            <td>
                           
                            <?php
								echo $this->settings_lib->item('site.title');
							?>
                   
                            </td>
                        </tr>
                    </table> 
					 </a>
				
				<!-- Main navbar toggle -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse"><i class="navbar-icon fa fa-bars"></i></button>
			</div> <!-- / .navbar-header -->
			<div id="main-navbar-collapse" class="collapse navbar-collapse main-navbar-collapse">
				<div>
					<ul class="nav navbar-nav">
						<li>
							<a href="<?php echo base_url(); ?>">Home</a>
						</li>
						 
					</ul> <!-- / .navbar-nav -->

					<div class="right clearfix">
						<ul class="nav navbar-nav pull-right right-navbar-nav">

<!-- 3. $NAVBAR_ICON_BUTTONS =======================================================================

							Navbar Icon Buttons

							NOTE: .nav-icon-btn triggers a dropdown menu on desktop screens only. On small screens .nav-icon-btn acts like a hyperlink.

							Classes:
							* 'nav-icon-btn-info'
							* 'nav-icon-btn-success'
							* 'nav-icon-btn-warning'
							* 'nav-icon-btn-danger' 
-->
							<li class="nav-icon-btn nav-icon-btn-danger dropdown">
                            	<!--
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="label">5</span>
									<i class="nav-icon fa fa-bullhorn"></i>
									<span class="small-screen-text">Notifications</span>
                                    
								</a>
								-->
								<!-- NOTIFICATIONS -->
								
								<!-- Javascript -->
								<script>
									init.push(function () {
										$('#main-navbar-notifications').slimScroll({ height: 250 });
									});
								</script>
								<!-- / Javascript -->
<!--
								<div class="dropdown-menu widget-notifications no-padding" style="width: 300px">
									<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
									<div class="notifications-list" id="main-navbar-notifications" style="overflow: hidden; width: auto; height: 250px;">

										<div class="notification">
											<div class="notification-title text-danger">SYSTEM</div>
											<div class="notification-description"><strong>Error 500</strong>: Syntax error in index.php at line <strong>461</strong>.</div>
											<div class="notification-ago">12h ago</div>
											<div class="notification-icon fa fa-hdd-o bg-danger"></div>
										</div>  
									</div><div class="slimScrollBar" style="background-color: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div></div>
									<a href="#" class="notifications-link">MORE NOTIFICATIONS</a>
								</div>
                                -->
                                 <!-- / .dropdown-menu -->
							</li>
							<li class="nav-icon-btn nav-icon-btn-success dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<span class="label">10</span>
									<i class="nav-icon fa fa-envelope"></i>
									<span class="small-screen-text">Income messages</span>
								</a>

								<!-- MESSAGES -->
								
								<!-- Javascript -->
								<script>
									init.push(function () {
										$('#main-navbar-messages').slimScroll({ height: 250 });
									});
								</script>
								<!-- / Javascript -->

								<div class="dropdown-menu widget-messages-alt no-padding" style="width: 300px;">
									<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
									<div class="messages-list" id="main-navbar-messages" style="overflow-y: scroll; width: auto; height: 250px;">

										
                                        	<?php 
											if(isset($daftar_pengaduans) && is_array($daftar_pengaduans) && count($daftar_pengaduans)):
											foreach ($daftar_pengaduans as $daftar_pengaduan) : ?>
												<div class="message">
                                                <img src="<?php echo base_url();?>assets/images/cw.png" alt="" class="message-avatar">
                                                    <a href="<?php echo base_url(); ?>index.php/admin/pengaduan/daftar_pengaduan/edit/<?php echo $daftar_pengaduan->id;?>" class="message-subject"><?php echo $daftar_pengaduan->text_pengaduan; ?></a>
                                                    <div class="message-description">
                                                        from <a href="#"><?php echo ucwords($daftar_pengaduan->email); ?></a>
                                                        &nbsp;&nbsp;·&nbsp;&nbsp;
                                                       <?php echo date('M j, Y g:i A', strtotime($daftar_pengaduan->DATE_CREATED)); ?>
                                                    </div>
                                               </div> <!-- / .message -->
											<?php 
											endforeach; 
											endif;?> 
										

										 
									</div><div class="slimScrollBar" style="background-color: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;"></div></div> <!-- / .messages-list -->
									<a href="<?php echo base_url();?>index.php/admin/pengaduan/daftar_pengaduan" class="messages-link">PESAN LAINNYA</a>
								</div> <!-- / .dropdown-menu -->
							</li>
<!-- /3. $END_NAVBAR_ICON_BUTTONS -->

							<li>
								<form class="navbar-form pull-left">
									<input type="text" class="form-control" placeholder="Search">
								</form>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">
									<img src="<?php echo base_url();?>assets/images/noimage.jpg">
									<span><?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#"><?php e($current_user->email) ?></a></li>
								 
									<li>
										<a href="<?php echo site_url(SITE_AREA .'/settings/users/edit') ?>"><i class="dropdown-icon fa fa-cog"></i>&nbsp;&nbsp;<?php echo lang('bf_user_settings')?></a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="<?php echo site_url('logout'); ?>"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;<?php echo lang('bf_action_logout')?></a>
									</li>
									 
								</ul>
							</li>
						</ul> <!-- / .navbar-nav -->
					</div> <!-- / .right -->
				</div>
			</div> <!-- / #main-navbar-collapse -->
		</div> <!-- / .navbar-inner -->
	</div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->


<!-- 4. $MAIN_MENU ================================================================================= -->
	<div id="main-menu" role="navigation">
		<div id="main-menu-inner">
			<div class="menu-content top animated fadeIn" id="menu-content-demo">
				 
				<div>
					<div class="text-bg">
					   <span class="text-semibold">
						   <?php echo (isset($current_user->display_name) && !empty($current_user->display_name)) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email); ?>
					    
					   </span>
					</div>
					<a href="<?php echo base_url(); ?>admin/settings/users/changepic" class="show-modal" title="Update image">							 
						<img src="<?php echo base_url();?>assets/images/noimage.jpg" alt="" class="">
					</a>
					<div class="btn-group">
						<a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-envelope"></i></a>
						<a href="<?php echo site_url(SITE_AREA .'/settings/users/edit') ?>" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
						<a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
						<a href="<?php echo site_url('logout'); ?>" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
					</div>
					<a href="#" class="close">×</a>
				</div>
			</div>
			<ul class="navigation">
            	<?php if ($this->auth->has_permission('Dashboard.Reports.View')) : ?>
					 <li <?php echo $this->uri->segment(3) == 'dashboard' ? 'class="active"' : '' ?>>
					   <a href="<?php echo base_url()?>admin/reports/dashboard">
					   <i class="menu-icon fa fa-dashboard"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Dashboard</span></a>
				   </li>
				 <?php endif; ?>
            	<?php if ($this->auth->has_permission('Dashboard_adm.Reports.View')) : ?>
					 <li <?php echo $this->uri->segment(3) == 'dashboard' ? 'class="active"' : '' ?>>
					   <a href="<?php echo base_url()?>admin/reports/dashboard_adm">
					   <i class="menu-icon fa fa-dashboard"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Dashboard</span></a>
				   </li>
				 <?php endif; ?>
				<?php if ($this->auth->has_permission('Dashboar_Dsn.Reports.View')) : ?>
					 <li <?php echo $this->uri->segment(3) == 'dashboard' ? 'class="active"' : '' ?>>
					   <a href="<?php echo base_url()?>admin/reports/dashboar_dsn">
					   <i class="menu-icon fa fa-dashboard"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Dashboard</span></a>
				   </li>
				 <?php endif; ?>
				 <?php if ($this->auth->has_permission('Dokumen.Master.View')) : ?>
					 <li <?php echo $this->uri->segment(3) == 'dashboard' ? 'class="active"' : '' ?>>
					   <a href="<?php echo base_url()?>admin/master/dokumen">
					   <i class="menu-icon fa fa-list"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Dokumen</span></a>
				   </li>
				 <?php endif; ?>
            	 <?php
			 
					$menu = $this->uri->segment(3);  
					$mainmenu = $this->uri->segment(2);  
					echo Contexts::render_menuaccordionnew('text', 'normal',$mainmenu,$menu); 
				  
				?>
				 
			</ul> <!-- / .navigation -->
			 	
				  <div class="alert alert-block alert-error fade in disclaimer">
				 
					 Sistem informasi Akademik (SIMAK) FE UMJ ini masih dalam tahap
pengembangan. oleh karena itu jika terdapat perbedaan data, maka yang
diakui adalah data manual yang terdapat di Fakultas.
					  
				  </div>

			 
		</div> <!-- / #main-menu-inner -->
	</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->

	<div id="content-wrapper">
		<ul class="breadcrumb breadcrumb-page">
			<div class="breadcrumb-label text-light-gray">You are here: </div>
			<li><a href="#">Home</a></li>
			<li class="active"><a href="#"> <?php if (isset($toolbar_title)) : ?>
					<?php echo $toolbar_title ?>
                <?php endif; ?></a></li>
            
            </li>
			<div class="pull-right">
				<!--<a href="add-new-product.php" class="btn btn-success">List</a>
				<a href="add-new-product.php" class="btn btn-success">New</a> -->
				<?php Template::block('sub_nav', ''); ?>
			 

			</div>
		</ul>
		  