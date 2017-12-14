<?php
	Assets::add_js( array( 'bootstrap.min.js', 'jwerty.js'), 'external', true);
?>
<?php echo theme_view('partials/_header'); ?>
 		 
				 	<div>
					<ul class="breadcrumb">
                    	
						<li><i class="icon-th"></i>
                        	<a href="#">Home</a> <span class="divider">/</span></li>
						<li>
                        <?php if (isset($toolbar_title)) : ?>
								<?php echo $toolbar_title ?>
                            <?php endif; ?>
                            </li>
                           
						</div>
					</ul>
				</div>
				<div class="row-fluid">

					<div class="box span12">
						 
						<div class="box-content" id="box-content">
							<?php echo Template::message(); ?>
        					<?php echo isset($content) ? $content : Template::content(); ?>
						</div>
					</div><!--/span-->
				
				</div><!--/row-->
				
			</div>
			<!-- end: content -->
        
 
<?php echo theme_view('partials/_footer'); ?>

