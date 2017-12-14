<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($konfirmasipembayaran))
{
	$konfirmasipembayaran = (array) $konfirmasipembayaran;
}
$id = isset($konfirmasipembayaran['id']) ? $konfirmasipembayaran['id'] : '';

?>
<div class="admin-box">
	 
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>
	<!--
			<div class="control-group <?php echo form_error('konfirmasipembayaran_nim') ? 'error' : ''; ?>">
				<?php echo form_label('Nim Mahasiswa'. lang('bf_form_label_required'), 'konfirmasipembayaran_nim', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konfirmasipembayaran_nim' type='text' name='konfirmasipembayaran_nim' maxlength="20" value="<?php echo set_value('konfirmasipembayaran_nim', isset($konfirmasipembayaran['nim']) ? $konfirmasipembayaran['nim'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('konfirmasipembayaran_nim'); ?></span>
				</div>
			</div>
-->
			<div class="control-group <?php echo form_error('pembayaran') ? 'error' : ''; ?>">
				<?php echo form_label('Untuk Pembayaran', 'konfirmasipembayaran_pembayaran', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konfirmasipembayaran_pembayaran' type='text' name='konfirmasipembayaran_pembayaran' maxlength="30" value="<?php echo set_value('konfirmasipembayaran_pembayaran', isset($konfirmasipembayaran['pembayaran']) ? $konfirmasipembayaran['pembayaran'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('pembayaran'); ?></span>
				</div>
			</div>
 
			<div class="control-group <?php echo form_error('semester') ? 'error' : ''; ?>">
				  <?php echo form_label('Semester'. lang('bf_form_label_required'), 'semester', array('class' => 'control-label') ); ?>
				  <div class='controls'>
				  <select name="konfirmasipembayaran_semester" id="konfirmasipembayaran_semester" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihansemesters) && is_array($pilihansemesters) && count($pilihansemesters)):?>
					  <?php foreach($pilihansemesters as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($konfirmasipembayaran['semester']))  echo  ($record->value==$konfirmasipembayaran['semester']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
   
					  <span class='help-inline'><?php echo form_error('masterdosen_kode_jenjang_studi_option1'); ?></span>
				  </div>
			  </div>  

			<div class="control-group <?php echo form_error('konfirmasipembayaran_jumlah') ? 'error' : ''; ?>">
				<?php echo form_label('Jumlah Bayar'. lang('bf_form_label_required'), 'konfirmasipembayaran_jumlah', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konfirmasipembayaran_jumlah' type='text' class="autonumber" name='konfirmasipembayaran_jumlah' maxlength="20" value="<?php echo set_value('konfirmasipembayaran_jumlah', isset($konfirmasipembayaran['jumlah']) ? $konfirmasipembayaran['jumlah'] : ''); ?>" data-a-sep="." data-a-dec=","/>
					<span class='help-inline'><?php echo form_error('konfirmasipembayaran_jumlah'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('tanggal') ? 'error' : ''; ?>">
				<?php echo form_label('Tanggal Bayar', 'konfirmasipembayaran_tanggal', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konfirmasipembayaran_tanggal' type='text' name='konfirmasipembayaran_tanggal'  value="<?php echo set_value('konfirmasipembayaran_tanggal', isset($konfirmasipembayaran['tanggal']) ? $konfirmasipembayaran['tanggal'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tanggal'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('bank') ? 'error' : ''; ?>">
				<?php echo form_label('Bank', 'konfirmasipembayaran_bank', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='konfirmasipembayaran_bank' type='text' name='konfirmasipembayaran_bank' maxlength="20" value="<?php echo set_value('konfirmasipembayaran_bank', isset($konfirmasipembayaran['bank']) ? $konfirmasipembayaran['bank'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('bank'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('file') ? 'error' : ''; ?>">
				<?php echo form_label('Bukti Pembayaran', 'konfirmasipembayaran_file', array('class' => 'control-label') ); ?>
				<div class='controls'>
					
						 
					<input type="file" class="span6" name="file_upload" id="file_upload" /> 
					<?php 
							$fotothum = "";
							$fotoasli = "";
							if(isset($konfirmasipembayaran['file'])) :
								$foto = unserialize($konfirmasipembayaran['file']);
								$fotothum = base_url()."assets/images/attach.gif";
								$fotoasli = $this->settings_lib->item('site.urluploaded').$foto['file_name'];
							else:
								$foto = base_url().$this->settings_lib->item('site.urluploaded')."no_image.jpg";
							endif;
						?>
						 
							<a href="<?php echo $fotoasli; ?>" target="_blank">
								<img alt="" src="<?php echo $fotothum; ?>">
							</a>
					<span class='help-inline'><?php echo form_error('file'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('keterangan') ? 'error' : ''; ?>">
				<?php echo form_label('Keterangan', 'konfirmasipembayaran_keterangan', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'konfirmasipembayaran_keterangan', 'id' => 'konfirmasipembayaran_keterangan','style'=>'width:550px', 'rows' => '5', 'cols' => '80', 'value' => set_value('konfirmasipembayaran_keterangan', isset($konfirmasipembayaran['keterangan']) ? $konfirmasipembayaran['keterangan'] : '') ) ); ?>
					<span class='help-inline'><?php echo form_error('keterangan'); ?></span>
				</div>
			</div>
			
			 

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('konfirmasi_pembayaran_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/pembayaran/konfirmasi_pembayaran', lang('konfirmasi_pembayaran_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('konfirmasi_pembayaran.Pembayaran.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('konfirmasi_pembayaran_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('konfirmasi_pembayaran_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
 
	$(document).ready(function() {	  
	 
		$('#konfirmasipembayaran_keterangan').wysiwyg();	
		$('.autonumber').autoNumeric('init', {mDec: '0'});
		
	}); 
</script>