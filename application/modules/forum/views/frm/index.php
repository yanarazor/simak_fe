<?php
$this->load->library('convert');
$convert = new convert();
$num_columns	= 6;
$can_delete	= $this->auth->has_permission('Forum.Frm.Delete');
$can_edit		= $this->auth->has_permission('Forum.Frm.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
	 <br>
                <div class="row-fluid">
					<div class="box span6">
				 
                        <div class="panel panel-success widget-support-tickets" id="dashboard-support-tickets">
                            <div class="panel-heading">
                                <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>Komen Terbanyak</span>
                                <div class="panel-heading-controls">
                                    <div class="panel-heading-text"><a href="#"></a></div>
                                </div>
                            </div> <!-- / .panel-heading -->
                            <div class="widget-comments panel-body tab-pane no-padding fade active in" id="dashboard-recent-comments">
                                 <!-- Panel padding, without vertical padding -->
                                  
								<?php
                                   if(isset($komenterbanyaks) && is_array($komenterbanyaks) && count($komenterbanyaks)):
                                        foreach ($komenterbanyaks as $record) :
                                    ?>
                                       <div class="comment">
                                            <img src="<?php echo base_url();?>assets/images/cw.png" alt="" class="comment-avatar">
                                            <div class="comment-body">
                                                <div class="comment-by">
                                                    <?php e($record->user) ?> 
                                                </div>
                                                <div class="comment-text">
                                                   <?php if ($record->usr_id==$current_user_id) : ?>
														<?php echo anchor(SITE_AREA . '/frm/forum/view/' . $record->id, $record->judul); ?>
                                                    <?php else : ?>
                                                        <?php e($record->judul); ?>
                                                    <?php endif; ?><br>
                                                    <span class="label label-success">  
														<?php echo anchor(SITE_AREA . '/frm/forum/view/' . $record->id, $record->jmlkomen." Komen"); ?> 
                                                    </span>
                                                </div>
                                                <div class="comment-actions">
                                                    <a href="#"><i class="fa fa-pencil"></i>Edit</a>
                                                    <a href="#"><i class="fa fa-times"></i>Remove</a>
                                                    <span class="pull-right"> 
                                                    	<?php e($record->tanggal) ?>
                                                    </span>
                                                </div>
                                            </div> <!-- / .comment-body -->
                                        </div> <!-- / .comment -->
                                     
                                    <?php
                                        endforeach;
                                    endif; ?>  
								 	<div class='controls'>
										 <fieldset> 
										 <?php
										 $has_recordjawabans	= isset($komen_record) && is_array($komen_record) && count($komen_record);
										 ?>
										 <legend>Comment <?php if ($has_recordjawabans) : echo "(".count($komen_record).")"; endif; ?></legend>
				 
									 <?php
										 if ($has_recordjawabans) :
				 
											 foreach ($komen_record as $record) :
										 ?>
										 <div class="alert alert-success notification">
											 <a class="close delete" kode="<?php echo $record->id; ?>" href="#">×</a>
											 <div><?php e($record->user) ?> [<?php echo $convert->fmtDate($record->tanggal,"dd month yyyy");?>]<br/>
											 <?php echo $record->isi; ?> 
					
											 </div>
										 </div>
				 
										 <?php
											 endforeach;
										 else:
											 echo "Tidak ada comment";
										 endif;
									 ?>
			
									  
									 </fieldset> 
									 </div>
           
                            </div> <!-- / .panel-body -->
                        </div> <!-- / .panel -->
			 
					</div>
					<!-- end: most sales products -->
					
					<div class="box span6">
					<div class="panel panel-warning" id="dashboard-recent">
                        <div class="panel-heading">
                        	
                            <span class="panel-title">
                            	<i class="icon-list"></i>Thread Terpopuler
                            </span>
                            <span class="pull-right">
                            	<?php if ($this->auth->has_permission('Forum.Frm.Create')) : ?> 
									<a href="<?php echo site_url(SITE_AREA .'/frm/forum/create') ?>">Tambah</a>
                                <?php endif; ?>
                            </span>
                        </div> <!-- / .panel-heading -->
					<div class="tab-content">

						<!-- Comments widget -->

						<!-- Without padding -->
						<div class="widget-comments panel-body tab-pane no-padding fade active in" id="dashboard-recent-comments">
                        
							<!-- Panel padding, without vertical padding -->
							 	 <?php
                                   if(isset($forumpopulers) && is_array($forumpopulers) && count($forumpopulers)):
                                        foreach ($forumpopulers as $record) :
                                    ?>
                                       <div class="comment">
                                            <img src="<?php echo base_url();?>assets/images/cw.png" alt="" class="comment-avatar">
                                            <div class="comment-body">
                                                <div class="comment-by">
                                                    <?php e($record->user) ?> 
                                                </div>
                                                <div class="comment-text">
                                                   <?php if ($record->usr_id==$current_user_id) : ?>
														<?php echo anchor(SITE_AREA . '/frm/forum/view/' . $record->id, $record->judul); ?>
                                                    <?php else : ?>
                                                        <?php e($record->judul); ?>
                                                    <?php endif; ?><br>
                                                    <span class="label label-success">  
														<?php echo anchor(SITE_AREA . '/frm/forum/view/' . $record->id, $record->jmlkomen." Komen"); ?> 
                                                    </span>
                                                </div>
                                                <div class="comment-actions">
                                                    <a href="#"><i class="fa fa-pencil"></i>Edit</a>
                                                    <a href="#"><i class="fa fa-times"></i>Remove</a>
                                                    <span class="pull-right"> 
                                                    	<?php e($record->tanggal) ?>
                                                    </span>
                                                </div>
                                            </div> <!-- / .comment-body -->
                                        </div> <!-- / .comment -->
                                     
                                    <?php
                                        endforeach;
                                    endif; ?>  
							</div> <!-- / .widget-comments -->
					</div>
					<!-- end: top grossing products -->
					
					 
					<!-- end: most viewed products -->
				</div>
				<!-- end: stats -->
  </div>
</div>

<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 <table>
        	<tr>
				 
            	<td>
                	Judul
                </td>
                <td>:
                </td>
                <td>
                	<input id='keyword' type='text' name='keyword' maxlength="20" value="<?php echo set_value('keyword', isset($keyword) ? $keyword : ''); ?>" />
				</td> 
            	 
                <td valign="top">
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
            
        </table>
    <?php echo form_close(); ?>
   <div class="alert alert-block alert-warning fade in ">
      <a class="close" data-dismiss="alert">&times;</a>
       Jumlah :  <?php echo isset($total) ? $total : ''; ?>
    </div>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class="table table-striped">
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class="column-check"><input class="check-all" type="checkbox" /></th>
					<?php endif;?>
					
					<th>Judul</th>
					<th>Isi</th>
					<th>User</th>
					<th>Tanggal</th>
                    <th>#</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('forum_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
						<?php if ($current_user->id == $record->usr_id or $current_user->role_id == "1") : ?>
							<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->id; ?>" /></td>
						<?php else: ?>
							<td class="column-check"><input type="checkbox" name="checkedq[]" disabled value="<?php echo $record->id; ?>" /></td>
						
						<?php endif;?>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<?php if ($current_user->id == $record->usr_id or $current_user->role_id == "1") : ?>
						<td><?php echo anchor(SITE_AREA . '/frm/forum/edit/' . $record->id, '<span class="icon-pencil"></span>' .  $record->judul); ?></td>
					<?php else: ?>
						<td><?php e($record->judul); ?></td>
					<?php endif; ?>
				<?php else : ?>
					<td><?php e($record->judul); ?></td>
				<?php endif; ?>
					<td><?php e($convert->countwordscustom($record->isi,200)) ?></td>
					<td><?php e($record->user) ?></td>
					<td><?php e($record->tanggal) ?></td>
                    <td>
					<div class="dropdown">
						<a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
							Manage <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url()."index.php/admin/frm/forum/view/".$record->id; ?>" kode="<?php e($record->id); ?>">View</a></li>
							 
						</ul>
					</div>
					</td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">No records found that match your selection.</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php echo form_close(); ?>
	<?php echo $this->pagination->create_links(); ?>
</div>
