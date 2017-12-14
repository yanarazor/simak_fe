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

if (isset($informasi_dan_berita))
{
	$informasi_dan_berita = (array) $informasi_dan_berita;
}
$id = isset($informasi_dan_berita['id_berita']) ? $informasi_dan_berita['id_berita'] : '';

?>
<div class="admin-box">
	 
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('judul') ? 'error' : ''; ?>">
				<?php echo form_label('Judul'. lang('bf_form_label_required'), 'informasi_dan_berita_judul', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='informasi_dan_berita_judul' type='text' name='informasi_dan_berita_judul' maxlength="100"  style="width:550px"  value="<?php echo set_value('informasi_dan_berita_judul', isset($informasi_dan_berita['judul']) ? $informasi_dan_berita['judul'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('judul'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('id_category') ? 'error' : ''; ?>">
				<?php echo form_label('Kategori', 'informasi_dan_berita_id_category', array('class' => 'control-label') ); ?>
				<div class='controls'>
                	<select name="informasi_dan_berita_id_category" id="informasi_dan_berita_id_category" class="chosen-select-deselect">
						<option value="">-- Pilih kategori --</option>
						<?php if (isset($kategoris) && is_array($kategoris) && count($kategoris)):?>
						<?php foreach($kategoris as $kategori_record):?>
							<option value="<?php echo $kategori_record->id?>" <?php if(isset($informasi_dan_berita['id_category']))  echo  ($kategori_record->id==$informasi_dan_berita['id_category']) ? "selected" : ""; ?>><?php echo $kategori_record->category; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
					<span class='help-inline'><?php echo form_error('id_category'); ?></span>
				</div>
			</div>
			<div class="control-group <?php echo form_error('headline') ? 'error' : ''; ?>">
				<?php echo form_label('Headline'. lang('bf_form_label_required'), 'informasi_dan_berita_headline', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='informasi_dan_berita_headline' type='text' name='informasi_dan_berita_headline' maxlength="255" style="width:550px" value="<?php echo set_value('informasi_dan_berita_headline', isset($informasi_dan_berita['headline']) ? $informasi_dan_berita['headline'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('headline'); ?></span>
				</div>
			</div>  
			<div class="control-group <?php echo form_error('content') ? 'error' : ''; ?>">
				<?php echo form_label('Content', 'informasi_dan_berita_content', array('class' => 'control-label') ); ?>
				<div class='controls'>
                	<?php echo form_textarea( array( 'name' => 'informasi_dan_berita_content', 'id' => 'informasi_dan_berita_content', 'rows' => '20', 'cols' => '100', 'value' => isset($informasi_dan_berita['content']) ? $informasi_dan_berita['content'] : '') )?>
            		<span class='help-inline'><?php echo form_error('content'); ?></span>
				</div>
			<!--
			<div class="control-group <?php echo form_error('tgl_create') ? 'error' : ''; ?>">
				<?php echo form_label('Tgl Create', 'informasi_dan_berita_tgl_create', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='informasi_dan_berita_tgl_create' type='text' name='informasi_dan_berita_tgl_create'  value="<?php echo set_value('informasi_dan_berita_tgl_create', isset($informasi_dan_berita['tgl_create']) ? $informasi_dan_berita['tgl_create'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('tgl_create'); ?></span>
				</div>
			</div>
 			-->
             <div class="control-group <?php echo form_error('informasi_dan_berita_foto') ? 'error' : ''; ?>">
            <?php echo form_label('Gambar', 'informasi_dan_berita_foto', array('class' => "control-label") ); ?>
            <div class='controls'>
            <input type="file" class="span6" name="file_upload" id="file_upload" /> 
                    <span class="help-block">Max File size: 4Mb</span>
                  <span class="help-inline"><?php echo form_error('informasi_dan_berita_image'); ?></span>
                  <br/>
                  <?php if(!empty($informasi_dan_berita['foto'])) :
                            $attachmentfile = $informasi_dan_berita['foto'];
							echo "<a href='".base_url().$this->settings_lib->item('site.urlimages').$attachmentfile."' class='fancy'/>"; 
							switch ($filetype) {
								 default:
      								echo "<img alt=".$attachmentfile." title=".$attachmentfile." src='".base_url().$this->settings_lib->item('site.urlimages').$attachmentfile."' width='100px'>";
							}
                        endif;
						echo "</a>";
                    ?>
         <span class="help-inline"><?php echo form_error('informasi_dan_berita_image'); ?></span>
        
        </div>
 
			<div class="control-group <?php echo form_error('auth_komen') ? 'error' : ''; ?>">
				<?php echo form_label('Auth Komen', '', array('class' => 'control-label', 'id' => 'informasi_dan_berita_auth_komen_label') ); ?>
				<div class='controls' aria-labelled-by='informasi_dan_berita_auth_komen_label'>
					<label class='radio' for='informasi_dan_berita_auth_komen_option1'>
						<input id='informasi_dan_berita_auth_komen_option1' name='informasi_dan_berita_auth_komen' type='radio' class='' value='1' <?php echo set_radio('informasi_dan_berita_auth_komen', '1', TRUE); ?> />
						Ya
					</label>
					<label class='radio' for='informasi_dan_berita_auth_komen_option2'>
						<input id='informasi_dan_berita_auth_komen_option2' name='informasi_dan_berita_auth_komen' type='radio' class='' value='0' <?php echo set_radio('informasi_dan_berita_auth_komen', '0'); ?> />
						Tidak
					</label>
					<span class='help-inline'><?php echo form_error('auth_komen'); ?></span>
				</div>
			</div>
 			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('informasi_dan_berita_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/site/informasi_dan_berita', lang('informasi_dan_berita_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Informasi_dan_Berita.Site.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('informasi_dan_berita_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('informasi_dan_berita_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>
<script language='JavaScript' type='text/javascript' src='<?php echo base_url();?>assets/js/tiny_mce/tiny_mce.js'></script>
<script type="text/javascript">
function ajaxfilemanager(field_name, url, type, win) {
   var ajaxfilemanagerurl = "<?php echo base_url();?>assets/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
   switch (type) {
    case "image":
     break;
    case "media":
     break;
    case "flash": 
     break;
    case "file":
     break;
    default:
     return false;
   }
            tinyMCE.activeEditor.windowManager.open({
                url: "<?php echo base_url();?>assets/js/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                width: 782,
                height: 440,
                inline : "yes",
                close_previous : "no"
            },{
                window : win,
                input : field_name
            });
            
              
  }
      
tinyMCE.init({
// General options
mode : "textareas",
theme : "advanced",
 // General options
  elements : "ajaxfilemanager",
  file_browser_callback : 'ajaxfilemanager',
  theme : "advanced",
  plugins : "safari,pagebreak,style,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount",

// Theme options
theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview",
theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,|,forecolor,backcolor",
theme_advanced_toolbar_location : "top",
theme_advanced_toolbar_align : "left",
theme_advanced_statusbar_location : "bottom",
theme_advanced_resizing : true,

// Example content CSS (should be your site CSS)
content_css : "css/content.css",

// Drop lists for link/image/media/template dialogs
template_external_list_url : "lists/template_list.js",
external_link_list_url : "lists/link_list.js",
external_image_list_url : "lists/image_list.js",
media_external_list_url : "lists/media_list.js",

// Style formats
style_formats : [
{title : 'Bold text', inline : 'b'},
{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
{title : 'Example 1', inline : 'span', classes : 'example1'},
{title : 'Example 2', inline : 'span', classes : 'example2'},
{title : 'Table styles'},
{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
],

// Replace values for the template plugin
template_replace_values : {
username : "Some User",
staffid : "991234"
}
});

</script>
