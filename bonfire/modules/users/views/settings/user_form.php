<?php

$errorClass = ' error';
$controlClass = 'span6';
$fieldData = array(
    'errorClass'    => $errorClass,
    'controlClass'  => $controlClass,
);

if (isset($user) && $user->banned) :
?>
<div class="alert alert-warning fade in">
	<h4 class="alert-heading"><?php echo lang('us_banned_admin_note'); ?></h4>
</div>
<?php
endif;
if (isset($password_hints) ) :
?>
<div class="alert alert-info fade in">
    <a data-dismiss="alert" class="close">&times;</a>
    <?php echo $password_hints; ?>
</div>
<?php
endif;

echo form_open($this->uri->uri_string(), 'class="form-horizontal" autocomplete="off"');
?>
	<fieldset>
		<legend><?php echo lang('us_account_details') ?></legend>
        <?php Template::block('user_fields', 'user_fields', $fieldData); ?>
	</fieldset>
	<?php
    if (has_permission('Bonfire.Roles.Manage')
        && ( ! isset($user) || (isset($user) && has_permission('Permissions.' . $user->role_name . '.Manage')))
       ) :
    ?>
    <fieldset>
        <legend><?php echo lang('us_role'); ?></legend>
        <div class="control-group">
            <label for="role_id" class="control-label"><?php echo lang('us_role'); ?></label>
            <div class="controls">
                <select name="role_id" id="role_id" class="chzn-select <?php echo $controlClass; ?>">
                    <?php
                    if (isset($roles) && is_array($roles) && count($roles)) :
                        foreach ($roles as $role) :
                            if (has_permission('Permissions.' . ucfirst($role->role_name) . '.Manage')) :
                                // check if it should be the default
                                $default_role = false;
                                if ((isset($user) && $user->role_id == $role->role_id)
                                    || ( ! isset($user) && $role->default == 1)
                                   ) {
                                    $default_role = true;
                                }
                    ?>
                    <option value="<?php echo $role->role_id; ?>" <?php echo set_select('role_id', $role->role_id, $default_role); ?>>
                        <?php e(ucfirst($role->role_name)); ?>
                    </option>
                    <?php
                            endif;
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
        </div>
        <div class="control-group<?php echo iif(form_error('nim'), $errorClass); ?>" id="divnim">
			 <label class="control-label" for="nim">Nim</label>
			 <div class="controls">
				<input type="text" id="nim" name="nim" value="<?php echo set_value('nim', isset($user->nim) ? $user->nim : ''); ?>" />
				 <span class="help-inline"><?php echo form_error('nim'); ?></span>
				 <p class="help-block">Isi Nim jika user adalah sebagai Mahasiswa</p>
			 </div>
		 </div>
		  <div class="control-group<?php echo iif(form_error('dosen'), $errorClass); ?>" id="divdosen">
			 <label class="control-label" for="nim">Dosen</label>
			 <div class="controls">
				 <select name="dosen" id="dosen" class="chosen-select-deselect">
						 <option value="">Pilih Dosen</option>
						 <?php if (isset($dosens) && is_array($dosens) && count($dosens)):?>
						 <?php foreach($dosens as $record):?>
							  <option value="<?php echo $record->nidn?>" <?php if(isset($user->nim))  echo  ($record->nidn==$user->nim) ? "selected" : ""; ?>><?php echo $record->nama_dosen; ?></option>
						  <?php endforeach;?>
						 <?php endif;?>
					 </select>
				 <span class="help-inline"><?php echo form_error('dosen'); ?></span>
				 <p class="help-block">Isi jika user adalah sebagai Dosen</p>
			 </div>
		 </div>
		 
		 <div class="control-group<?php echo iif(form_error('kode_prodi'), $errorClass); ?>" id="divkode_prodi">
			 <label class="control-label" for="nim">Prodi</label>
			 <div class="controls">
				 <select name="kode_prodi" id="kode_prodi" class="chosen-select-deselect">
					 <option value="">Pilih Prodi</option>
					 <?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
					 <?php foreach($masterprogramstudis as $record):?>
						  <option value="<?php echo $record->kode_prodi?>" <?php if(isset($user->nim))  echo  ($record->kode_prodi==$user->nim) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
					  <?php endforeach;?>
					 <?php endif;?>
				 </select>
				 <span class="help-inline"><?php echo form_error('kode_prodi'); ?></span>
				 <p class="help-block">Isi jika user adalah sebagai Kaprodi</p>
			 </div>
		 </div>
    </fieldset>
    <?php
    endif;

    // Allow modules to render custom fields
    Events::trigger('render_user_form');
    ?>
    <!-- Start of User Meta -->
    <?php //$this->load->view('users/user_meta');?>
    <!-- End of User Meta -->
    <?php
    if (isset($user) && has_permission('Permissions.' . ucfirst($user->role_name) . '.Manage')
        && $user->id != $this->auth->user_id() && ($user->banned || $user->deleted)
       ) :
    ?>
    <fieldset>
        <legend><?php echo lang('us_account_status'); ?></legend>
        <?php
        $field = 'activate';
        if ($user->active) {
            $field = 'de' . $field;
        }
        ?>
        <div class="control-group">
            <div class="controls">
                <label for="<?php echo $field; ?>">
                    <input type="checkbox" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="1" />
                    <?php echo lang('us_' . $field . '_note') ?>
                </label>
            </div>
        </div>
        <?php if ($user->deleted) : ?>
        <div class="control-group">
            <div class="controls">
                <label for="restore">
                    <input type="checkbox" name="restore" id="restore" value="1" />
                    <?php echo lang('us_restore_note'); ?>
                </label>
            </div>
        </div>
        <?php elseif ($user->banned) : ?>
        <div class="control-group">
            <div class="controls">
                <label for="unban">
                    <input type="checkbox" name="unban" id="unban" value="1" />
                    <?php echo lang('us_unban_note'); ?>
                </label>
            </div>
        </div>
        <?php endif; ?>
    </fieldset>
    <?php endif; ?>
<?php
 if (isset($user->role_name) and $user->role_name=="7"){
 ?>
    <fieldset>
        <legend>Personal Detil</legend>
        <table border="0">
	<tr>
		<td width="60%">
			
					<fieldset>
					<?php
						if (isset($mastermahasiswa))
						{
							$mastermahasiswa = (array) $mastermahasiswa;
						}
						$id = isset($mastermahasiswa['id']) ? $mastermahasiswa['id'] : '';

					?>
					<div class="control-group <?php echo form_error('mastermahasiswa_nim_mhs') ? 'error' : ''; ?>">
						<?php echo form_label('NIM', 'mastermahasiswa_nim_mhs', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nim_mhs' type='text' name='mastermahasiswa_nim_mhs' maxlength="25" value="<?php echo set_value('mastermahasiswa_nim_mhs', isset($mastermahasiswa[0]->nim_mhs) ? $mastermahasiswa[0]->nim_mhs : ''); ?>" />
							<span class='help-inline'><?php echo form_error('mastermahasiswa_nim_mhs'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('mastermahasiswa_nama_mahasiswa') ? 'error' : ''; ?>">
						<?php echo form_label('Nama', 'mastermahasiswa_nama_mahasiswa', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_nama_mahasiswa' type='text' name='mastermahasiswa_nama_mahasiswa' maxlength="200" style="width:400px" value="<?php echo set_value('mastermahasiswa_nama_mahasiswa', isset($mastermahasiswa[0]->nama_mahasiswa) ? $mastermahasiswa[0]->nama_mahasiswa : ''); ?>" />
							<span class='help-inline'><?php echo form_error('mastermahasiswa_nama_mahasiswa'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('tempat_lahir') ? 'error' : ''; ?>">
						<?php echo form_label('Tempat Lahir', 'mastermahasiswa_tempat_lahir', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tempat_lahir' type='text' name='mastermahasiswa_tempat_lahir' maxlength="50" value="<?php echo set_value('mastermahasiswa_tempat_lahir', isset($mastermahasiswa[0]->tempat_lahir) ? $mastermahasiswa[0]->tempat_lahir : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tempat_lahir'); ?></span>
						</div>
					</div>


					<div class="control-group <?php echo form_error('tgl_lahir') ? 'error' : ''; ?>">
						<?php echo form_label('Tanggal Lahir', 'mastermahasiswa_tgl_lahir', array('class' => 'control-label') ); ?>
						<div class='controls'>
							<input id='mastermahasiswa_tgl_lahir' type='text' name='mastermahasiswa_tgl_lahir'  value="<?php echo set_value('mastermahasiswa_tgl_lahir', isset($mastermahasiswa[0]->tgl_lahir) ? $mastermahasiswa[0]->tgl_lahir : ''); ?>" />
							<span class='help-inline'><?php echo form_error('tgl_lahir'); ?></span>
						</div>
					</div>
					
						<div class="control-group <?php echo form_error('jenis_kelamin') ? 'error' : ''; ?>">
				<?php echo form_label('Jenis Kelamin', '', array('class' => 'control-label', 'id' => 'mastermahasiswa_jenis_kelamin_label') ); ?>
				<div class='controls' aria-labelled-by='mastermahasiswa_jenis_kelamin_label'>
					<label class='radios' for='masterdosen_jenis_kelamin_option1'>
						<input id='mastermahasiswa_jenis_kelamin_option1' name='mastermahasiswa_jenis_kelamin' type='radio' class='' value='L'

						<?php if(isset($mastermahasiswa[0]->jenis_kelamin)) echo ($mastermahasiswa[0]->jenis_kelamin == 'L' ) ? set_radio('mastermahasiswa_jenis_kelamin', 'L', true ) : ""; ?> />
						Laki-laki
					</label>
					<label class='radios' for='mastermahasiswa_jenis_kelamin_option2'>
						<input id='masterdosen_jenis_kelamin_option2' name='mastermahasiswa_jenis_kelamin' type='radio' class='' value='P'

						<?php if(isset($mastermahasiswa[0]->jenis_kelamin)) echo ($mastermahasiswa[0]->jenis_kelamin == 'P' ) ? set_radio('mastermahasiswa_jenis_kelamin', 'P', true ) : ""; ?> />
					Perempuan
					</label>
					<span class='help-inline'><?php echo form_error('jenis_kelamin'); ?></span>
				</div>
			</div>
					
					
					 
	</fieldset>
                
            </td>
            <td valign="top" align="center"> 
            <?php if(isset($mastermahasiswa) && isset($mastermahasiswa[0]->photo_mahasiswa) && $mastermahasiswa[0]->photo_mahasiswa!='no image' && !empty($mastermahasiswa[0]->photo_mahasiswa)) :
						$foto = $mastermahasiswa['photo_mahasiswa'];
					else:
						$foto = "noimage.jpg";
					endif;
				?>
            	 <fieldset>
            	 	<div class="control-group">
						   <div id="logo">
							   <div class="get-photo" style="z-index: 690;"> 
								   <a href="<?php echo $this->settings_lib->item('site.urlphoto').$foto; ?>">
									   <img width="160" height="160" alt="" src="<?php echo $this->settings_lib->item('site.urlphoto').$foto; ?>">
								   </a>
							   </div>
						
						   </div>
                        </div>
                     </fieldset>
                      
            </td>
        </tr>
    </table>
    </fieldset>
<?php } ?>
    <div class="form-actions">
        <input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('bf_action_save') . ' ' . lang('bf_user'); ?>" />
        <?php echo lang('bf_or'); ?>
        <?php echo anchor(SITE_AREA . '/settings/users', lang('bf_action_cancel')); ?>
    </div>
<?php echo form_close(); ?>
<link href="<?php echo base_url(); ?>assets/css/chosen/chosen.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' type='text/javascript' src='<?php echo base_url(); ?>assets/js/chosen/chosen.jquery.js'></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>