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

if (isset($kategori_berita))
{
	$kategori_berita = (array) $kategori_berita;
}
$id = isset($kategori_berita['id']) ? $kategori_berita['id'] : '';

?>
<div class="admin-box">
 
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('category') ? 'error' : ''; ?>">
				<?php echo form_label('Kategori'. lang('bf_form_label_required'), 'kategori_berita_category', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='kategori_berita_category' type='text' name='kategori_berita_category' maxlength="50" value="<?php echo set_value('kategori_berita_category', isset($kategori_berita['category']) ? $kategori_berita['category'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('category'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('description') ? 'error' : ''; ?>">
				<?php echo form_label('Description', 'kategori_berita_description', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<?php echo form_textarea( array( 'name' => 'kategori_berita_description', 'id' => 'kategori_berita_description','style'=>'width:600px', 'rows' => '5', 'cols' => '80', 'value' => set_value('kategori_berita_description', isset($kategori_berita['description']) ? $kategori_berita['description'] : '') ) ); ?>
					
                   <span class='help-inline'><?php echo form_error('description'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('kategori_berita_action_create'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/site/kategori_berita', lang('kategori_berita_cancel'), 'class="btn btn-warning"'); ?>
				
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>