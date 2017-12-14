<?php
$this->load->library('convert');
$convert = new convert();
$validation_errors = validation_errors();
$has_recordjawabans	= isset($komen_record) && is_array($komen_record) && count($komen_record);
if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($forum))
{
	$forum = (array) $forum;
}
$id = isset($forum['id']) ? $forum['id'] : '';

?>
<div class="admin-box">
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset> 
			<div class="control-group <?php echo form_error('subject') ? 'error' : ''; ?>">
				<?php echo form_label('Judul', 'subject', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo isset($forum['judul']) ? $forum['judul'] : ''; ?> 
					<input id='id_forum' type='hidden' name='id_forum' maxlength="255" value="<?php echo set_value('id_forum', isset($id) ? $id : ''); ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('pertanyaan') ? 'error' : ''; ?>">
				<?php echo form_label('Isi', 'forum_pertanyaan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo $forum['isi']; ?> 
					<?php //echo isset($forum['isi']) ? str_replace('../', base_url(), $forum['isi']) : ''; ?> 
				</div>
			</div>
 
			<div class="control-group <?php echo form_error('date_created') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal', 'forum_date_created', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php 
					echo $convert->fmtDate($forum['tanggal'],"dd month yyyy");
					?>
					  
				</div>
			</div> 
			<div class='controls'>
				<fieldset> 
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
			
			<br>
			<?php echo form_textarea( array( 'name' => 'pesan', 'id' => 'pesan', 'rows' => '5',  'style' => 'width:700px', 'cols' => '80', 'value' => '' ) ); ?>
			<span class='help-inline'><?php echo form_error('pesan'); ?></span>
		 
			</fieldset> 
			</div>
			 
			<div class="form-actions">
				<input type="submit" name="reply" class="btn btn-primary" value="Balas"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/frm/forum', "Cancel", 'class="btn btn-warning"'); ?>
				
			 
			</div>
			
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
 
	$(document).ready(function() {	
		$('#pesan').wysiwyg();
		
		$(".delete").live("click", function(){
		 	var post_data = "id="+$(this).attr("kode");
			 conf = confirm("Anda yakin?"); 
				if (!conf)
                    return false;
			$.ajax({
				url: "<?php echo base_url() ?>index.php/admin/frm/forum/deletevia_ajax",
				type:"POST",
				data: post_data,
				dataType: "html",
				timeout:180000,
				success: function (result) {
					$(this).parent("div").hide();
			},
			error : function(error) {
				alert(error);
			} 
			});        
			return false;
		}); 
	}); 
</script> 