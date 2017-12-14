<?php
	$site_open = $this->settings_lib->item('auth.allow_register');
?>

<div style="z-index=1000;background:#ff9900;">
&nbsp; <br>
</div>

<div class="container">
<div class="hero__content">	
<a href="<?php echo site_url();?>">		
			<h1 class="hero__logo"><img src="<?php echo img_path(); ?>logo300.jpeg" alt="UMJ"></h1>
			<div class="hero__intro"> 
			<strong>Sistem Informasi Akademik <br>
			Fakultas Ekonomi dan Bisnis <br>
			Universitas Muhammadiyah Jakarta</strong> <br> </a>
</div>
</div>
<div>




<ul class="cb-slideshow">
            <li><span></span></li>
			<li><span></span></li>
			<li><span></span></li>
			<li><span></span></li>
			<li><span></span></li>
</ul>
</div>
		
	



<div id="login" style="float:right;" class=".hero__content">
	<h2>Sign in</h2>

	<?php echo Template::message(); ?>

	<?php
		if (validation_errors()) :
	?>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-error fade in">
			  <a data-dismiss="alert" class="close">&times;</a>
				<?php echo validation_errors(); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>

		<div class="control-group <?php echo iif( form_error('login') , 'error') ;?>">
			<div class="controls">
				<input style="width: 95%" type="text" name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="<?php echo $this->settings_lib->item('auth.login_type') == 'both' ? lang('bf_username') .'/'. lang('bf_email') : ucwords($this->settings_lib->item('auth.login_type')) ?>" />
			</div>
		</div>

		<div class="control-group <?php echo iif( form_error('password') , 'error') ;?>">
			<div class="controls">
				<input style="width: 95%" type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" />
			</div>
		</div>

		<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
			<div class="control-group">
				<div class="controls">
					<label class="checkbox" for="remember_me">
						<input type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3" />
						<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
					</label>
				</div>
			</div>
		<?php endif; ?>

		<div class="control-group">
			<div class="controls">
				<input class="btn btn-large btn-primary" type="submit" name="log-me-in" id="submit" value="<?php e(lang('us_let_me_in')); ?>" tabindex="5" />
			</div>
		</div>
	<?php echo form_close(); ?>

	<?php // show for Email Activation (1) only
		if ($this->settings_lib->item('auth.user_activation_method') == 1) : ?>
	<!-- Activation Block -->
			
	<?php endif; ?>

	<p style="text-align: center">
		<?php if ( $site_open ) : ?>
			<?php echo anchor(REGISTER_URL, lang('us_sign_up')); ?>
		<?php endif; ?>
		<p style="text-align: left" class="well">
			  Default Username dan Password adalah NIM
			</p>
		<br/><?php echo anchor('/forgot_password', lang('us_forgot_your_password')); ?>
		<?php  
		if ($this->auth->is_logged_in()) :?>
			  
			 <li <?php echo check_method('profile'); ?>><a href="<?php echo site_url('/admin/settings/users/edit'); ?>"> <?php e(lang('bf_user_settings')); ?> </a></li>
			 <li><a href="<?php echo site_url('/logout') ?>"><?php e( lang('bf_action_logout')); ?></a></li>
			 <li><a href="<?php echo site_url(SITE_AREA) ?>"><span>Login area</span></a> </li>
		 <?php endif; ?>
	</p>
		
</div>

</div>

