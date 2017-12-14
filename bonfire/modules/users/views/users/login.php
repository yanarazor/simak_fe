<?php
	$site_open = $this->settings_lib->item('auth.allow_register');
?>

<div style="z-index=1000;background:#ff9900;">
&nbsp; <br>
</div>

	<div class="page-container">
		<center>
			<img src="<?php echo img_path(); ?>Logo.png" alt="Logo" width="125px">
		
            
            <?php echo Template::message(); ?>
			 <?php
				 if (validation_errors()) :
			 ?>
			 <div class="row-fluid">
				 <div class="span12">
					 <div class="alert alert-error fade in">
					    
						 <?php echo validation_errors(); ?>
					 </div>
				 </div>
			 </div>
			 <?php endif; ?>
		</center> 
            <?php echo form_open(LOGIN_URL, array('autocomplete' => 'off')); ?>
                <input type="text" name="login" class="username" placeholder="Username">
                <input type="password" name="password" class="password" placeholder="Password">
                <button type="submit" name="log-me-in">Sign me in</button>
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                
				 <?php if ( $site_open ) : ?>
					 <?php echo anchor(REGISTER_URL, lang('us_sign_up')); ?>
				 <?php endif; ?>
		 
					   Default Username dan Password adalah NIM
					 </p>
				 <?php  
				 if ($this->auth->is_logged_in()) :?>
			  
					  <li <?php echo check_method('profile'); ?>><a href="<?php echo site_url('/admin/settings/users/edit'); ?>"> <?php e(lang('bf_user_settings')); ?> </a></li>
					  <li><a href="<?php echo site_url('/logout') ?>"><?php e( lang('bf_action_logout')); ?></a></li>
					  <li><a href="<?php echo site_url(SITE_AREA) ?>"><span>Login area</span></a> </li>
				  <?php endif; ?>
	 
            </div>
        </div>

        <!-- Javascript -->
</div>

