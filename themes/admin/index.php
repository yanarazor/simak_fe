 
<?php echo theme_view('partials/_header'); ?> 
 
        
        <div class="row-fluid">

                <div class="box span12">
                    
                    <div class="box-content" id="box-content">
                        <?php echo Template::message(); ?>
                          <?php echo isset($content) ? $content : Template::content(); ?>
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
            
        </div>

		    
        
	</div> <!-- / #content-wrapper -->
	<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
 
<?php echo theme_view('partials/_footer'); ?>
