 
<ul class="nav nav-pills">
	
	 
	<?php if ($this->auth->has_permission('Forum.Frm.Create')) : ?>
	 <div class="pull-right col-xs-12 col-sm-auto">
		<a href="<?php echo site_url(SITE_AREA .'/frm/forum/create') ?>" class="btn btn-primary btn-labeled" style="width: 100%;">
		  <span class="btn-label icon fa fa-plus">
		  </span><?php echo lang('forum_new'); ?></a>
	  </div>
      <?php endif; ?>
	  <div class="pull-right col-xs-12 col-sm-auto">
		<a href="<?php echo site_url(SITE_AREA .'/frm/forum') ?>" class="btn btn-primary btn-labeled" style="width: 100%;">
		  <span class="btn-label icon fa fa-list">
		  </span><?php echo lang('forum_list'); ?></a>
	  </div>
	
</ul>
 