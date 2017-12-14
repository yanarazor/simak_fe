<?php

$validation_errors = validation_errors();
$show_extended_settings = ! empty($extended_settings);

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;
?>
<div class="admin-box">

	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#main-settings" data-toggle="tab"><?php echo lang('set_tab_settings') ?></a>
				</li>
				<li>
					<a href="#security" data-toggle="tab"><?php echo lang('set_tab_security') ?></a>
				</li>
			<?php if (has_permission('Site.Developer.View')) : ?>
				<li>
					<a href="#developer" data-toggle="tab"><?php echo lang('set_tab_developer') ?></a>
				</li>
			<?php endif;
				if ($show_extended_settings) :
			?>
				<li>
					<a href="#extended" data-toggle="tab"><?php echo lang('set_tab_extended') ?></a>
				</li>
			<?php endif; ?>
			</ul>
			<div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">
				<!-- Start of Main Settings Tab Pane -->
				<div class="tab-pane active" id="main-settings">
					<fieldset>
						<legend><?php echo lang('bf_site_information') ?></legend>

						<div class="control-group">
							<label class="control-label" for="title"><?php echo lang('bf_site_name') ?></label>
							<div class="controls">
								<input type="text" name="title" id="title" class="span6" value="<?php echo set_value('site.title', isset($settings['site.title']) ? $settings['site.title'] : '') ?>" />
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="system_email"><?php echo lang('bf_site_email') ?></label>
							<div class="controls">
								<input type="text" name="system_email" id="system_email" class="span4" value="<?php echo set_value('site.system_email', isset($settings['site.system_email']) ? $settings['site.system_email'] : '') ?>" />
								<p class="help-inline"><?php echo lang('bf_site_email_help') ?></p>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="status"><?php echo lang('bf_site_status') ?></label>
							<div class="controls">
								<select name="status" id="status">
									<option value="1" <?php echo isset($settings) && $settings['site.status'] == 1 ? 'selected="selected"' : set_select('site.status', '1') ?>><?php echo lang('bf_online') ?></option>
									<option value="0" <?php echo isset($settings) && $settings['site.status'] == 0 ? 'selected="selected"' : set_select('site.status', '1') ?>><?php echo lang('bf_offline') ?></option>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="list_limit"><?php echo lang('bf_top_number') ?></label>
							<div class="controls">
								<input type="text" name="list_limit" id="list_limit" value="<?php echo set_value('list_limit', isset($settings['site.list_limit']) ? $settings['site.list_limit'] : '')  ?>" class="span1" />
								<p class="help-inline"><?php echo lang('bf_top_number_help') ?></p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="list_limit">Default Semester</label>
							<div class="controls">
								<input type="text" name="tahun" id="tahun" value="<?php echo set_value('tahun', isset($settings['site.tahun']) ? $settings['site.tahun'] : '')  ?>" class="span3" />
								<p class="help-inline">ex: 20141, Angka 1 (Terakhir) menandakan bahwa tahun ganjil, tambahkan angka 2 untuk menandakan bahwa tahun genap</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="list_limit">Tahun Ajaran</label>
							<div class="controls">
								<input type="text" name="tahunajaran" id="tahunajaran" value="<?php echo set_value('tahun', isset($settings['site.tahunajaran']) ? $settings['site.tahunajaran'] : '')  ?>" class="span3" />
								<p class="help-inline">ex: 2014/2015</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="list_limit">Boleh Update KRS</label>
							<div class="controls">
								<select name="updatekrs" id="updatekrs" class="chosen-select-deselect" style="width:250px">
									<option value="1" <?php echo $settings['site.updatekrs'] == "1" ? "selected":"" ?> >Tidak</option>
									<option value="2" <?php echo $settings['site.updatekrs'] == "2" ? "selected":"" ?>  >Iya</option>
								</select>
								<p class="help-inline">ex: 2014/2015</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="list_limit">Kuesioner Aktif</label>
							<div class="controls">
								<select name="kuesioner" id="kuesioner" class="chosen-select-deselect" style="width:250px">
									<option value="1" <?php echo $settings['kuesioner'] == "1" ? "selected":"" ?> >Ya</option>
									<option value="0" <?php echo $settings['kuesioner'] == "0" ? "selected":"" ?>  >Tidak</option>
								</select>
							</div>
						</div>
						
						<div class="control-group">
							<label class="control-label" for="languages"><?php echo lang('bf_language') ?></label>
							<div class="controls">
								<select name="languages[]" id="languages" multiple="multiple">
						<?php
							if (is_array($languages) && count($languages)) :
								foreach ($languages as $language) :
									$selected = in_array($language, $selected_languages) ? TRUE : FALSE;
						?>
									<option value="<?php e($language); ?>" <?php echo set_select('languages', $language, $selected); ?>><?php e(ucfirst($language)); ?></option>
						<?php
								endforeach;
							endif;
						?>
								</select>
								<p class="help-inline"><?php echo lang('bf_language_help') ?></p>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Perguruan Tinggi</legend>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Kode Perguruan Tinggi</label>
							<div class="controls">
								<input type="text" name="kode_pt" id="kode_pt" value="<?php echo set_value('kode_pt', isset($settings['kode_pt']) ? $settings['kode_pt'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Nama Perguruan Tinggi</label>
							<div class="controls">
								<input type="text" name="nama_pt" id="nama_pt" value="<?php echo set_value('nama_pt', isset($settings['nama_pt']) ? $settings['nama_pt'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">No SK Dikti</label>
							<div class="controls">
								<input type="text" name="sk_dikti" id="sk_dikti" value="<?php echo set_value('sk_dikti', isset($settings['sk_dikti']) ? $settings['sk_dikti'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Tanggal SK Dikti</label>
							<div class="controls">
								<input type="text" name="tgl_sk_dikti" id="tgl_sk_dikti" value="<?php echo set_value('tgl_sk_dikti', isset($settings['tgl_sk_dikti']) ? $settings['tgl_sk_dikti'] : '') ?>" class="span3" />
								<p class="help-inline">yyyy-mm-dd</p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Tanggal Akhir SK Dikti</label>
							<div class="controls">
								<input type="text" name="tgl_akhir_sk_dikti" id="tgl_akhir_sk_dikti" value="<?php echo set_value('tgl_akhir_sk_dikti', isset($settings['tgl_akhir_sk_dikti']) ? $settings['tgl_akhir_sk_dikti'] : '') ?>" class="span3" />
								<p class="help-inline">yyyy-mm-dd</p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Alamat 1</label>
							<div class="controls">
								<input type="text" name="alamat_pt1" id="alamat_pt1" value="<?php echo set_value('alamat_pt1', isset($settings['alamat_pt1']) ? $settings['alamat_pt1'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Alamat 2</label>
							<div class="controls">
								<input type="text" name="alamat_pt2" id="alamat_pt2" value="<?php echo set_value('alamat_pt2', isset($settings['alamat_pt2']) ? $settings['alamat_pt2'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Kota</label>
							<div class="controls">
								<input type="text" name="kota_pt" id="kota_pt" value="<?php echo set_value('kota_pt', isset($settings['kota_pt']) ? $settings['kota_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Kode Pos</label>
							<div class="controls">
								<input type="text" name="kode_pos_pt" id="kode_pos_pt" value="<?php echo set_value('kode_pos_pt', isset($settings['kode_pos_pt']) ? $settings['kode_pos_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Telphone</label>
							<div class="controls">
								<input type="text" name="tlp_pt" id="tlp_pt" value="<?php echo set_value('tlp_pt', isset($settings['tlp_pt']) ? $settings['tlp_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Fax</label>
							<div class="controls">
								<input type="text" name="fax_pt" id="fax_pt" value="<?php echo set_value('fax_pt', isset($settings['fax_pt']) ? $settings['fax_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Tgl Akta</label>
							<div class="controls">
								<input type="text" name="tgl_akta_pt" id="tgl_akta_pt" value="<?php echo set_value('tgl_akta_pt', isset($settings['tgl_akta_pt']) ? $settings['tgl_akta_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">No Akta</label>
							<div class="controls">
								<input type="text" name="no_akta_pt" id="no_akta_pt" value="<?php echo set_value('no_akta_pt', isset($settings['no_akta_pt']) ? $settings['no_akta_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Website</label>
							<div class="controls">
								<input type="text" name="website_pt" id="website_pt" value="<?php echo set_value('website_pt', isset($settings['website_pt']) ? $settings['website_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Tanggal Pendirian</label>
							<div class="controls">
								<input type="text" name="tanggal_pendirian_pt" id="tanggal_pendirian_pt" value="<?php echo set_value('tanggal_pendirian_pt', isset($settings['tanggal_pendirian_pt']) ? $settings['tanggal_pendirian_pt'] : '') ?>" class="span3" />
								<p class="help-inline"></p>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Badan Hukum</legend>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Kode Badan Hukum</label>
							<div class="controls">
								<input type="text" name="kode_bh" id="kode_bh" value="<?php echo set_value('kode_bh', isset($settings['kode_bh']) ? $settings['kode_bh'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Nama Badan Hukum</label>
							<div class="controls">
								<input type="text" name="nama_bh" id="nama_bh" value="<?php echo set_value('nama_bh', isset($settings['nama_bh']) ? $settings['nama_bh'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						 
					</fieldset>
					<fieldset>
						<legend>Penandatangan</legend>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Jabatan Rektor</label>
							<div class="controls">
								<input type="text" name="jabatanrektor" id="jabatanrektor" value="<?php echo set_value('jabatanrektor', isset($settings['jabatanrektor']) ? $settings['jabatanrektor'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Rektor</label>
							<div class="controls">
								<input type="text" name="rektor" id="rektor" value="<?php echo set_value('rektor', isset($settings['rektor']) ? $settings['rektor'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Jabatan Dekan</label>
							<div class="controls">
								<input type="text" name="jabatansementara" id="jabatansementara" value="<?php echo set_value('jabatansementara', isset($settings['jabatan.transkip.sementara']) ? $settings['jabatan.transkip.sementara'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
						<div class="control-group" id="pr">
							<label class="control-label" for="password_min_length">Dekan</label>
							<div class="controls">
								<input type="text" name="dekanfeb" id="dekanfeb" value="<?php echo set_value('dekanfeb', isset($settings['dekanfeb']) ? $settings['dekanfeb'] : '') ?>" class="span6" />
								<p class="help-inline"></p>
							</div>
						</div>
					</fieldset>
				</div>
				<!-- Start of Security Settings Tab Pane -->
				<div class="tab-pane" id="security">
					<fieldset>
						<legend><?php echo lang('bf_security') ?></legend>

						<div class="control-group">
							<div class="controls">
								<label for="allow_register">
									<input type="checkbox" name="allow_register" id="allow_register" value="1" <?php echo $settings['auth.allow_register'] == 1 ? 'checked="checked"' : set_checkbox('auth.allow_register', 1); ?> />
									<span><?php echo lang('bf_allow_register') ?></span>
								</label>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="user_activation_method"><?php echo lang('bf_activate_method') ?></label>
							<div class="controls">
								<select name="user_activation_method" id="user_activation_method">
									<option value="0" <?php echo $settings['auth.user_activation_method'] == 0 ? 'selected="selected"' : ''; ?>><?php echo lang('bf_activate_none') ?></option>
									<option value="1" <?php echo $settings['auth.user_activation_method'] == 1 ? 'selected="selected"' : ''; ?>><?php echo lang('bf_activate_email') ?></option>
									<option value="2" <?php echo $settings['auth.user_activation_method'] == 2 ? 'selected="selected"' : ''; ?>><?php echo lang('bf_activate_admin') ?></option>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="login_type"><?php echo lang('bf_login_type') ?></label>
							<div class="controls">
								<select name="login_type" id="login_type">
									<option value="email" <?php echo $settings['auth.login_type'] == 'email' ? 'selected="selected"' : ''; ?>><?php echo lang('bf_login_type_email') ?></option>
									<option value="username" <?php echo $settings['auth.login_type'] == 'username' ? 'selected="selected"' : ''; ?>><?php echo lang('bf_login_type_username') ?></option>
									<option value="both" <?php echo $settings['auth.login_type'] == 'both' ? 'selected="selected"' : ''; ?>><?php echo lang('bf_login_type_both') ?></option>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" id="use_usernames_label"><?php echo lang('bf_use_usernames') ?></label>
							<div class="controls" aria-labelledby="use_usernames_label" role="group">
								<label class="radio" for="use_username">
									<input type="radio" id="use_username" name="use_usernames" value="1" <?php echo $settings['auth.use_usernames'] == 1 ? 'checked="checked"' : set_radio('auth.use_usernames', 1); ?> />
									<span><?php echo lang('bf_username') ?></span>
								</label>
								<label class="radio" for="use_email">
									<input type="radio" id="use_email" name="use_usernames" value="0" <?php echo $settings['auth.use_usernames'] == 0 ? 'checked="checked"' : set_radio('auth.use_usernames', 0); ?> />
									<span><?php echo lang('bf_email') ?></span>
								</label>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo lang('bf_display_name'); ?></label>
							<div class="controls">
								<label class="checkbox" for="allow_name_change">
									<input type="checkbox" name="allow_name_change" id="allow_name_change" <?php echo isset($settings['auth.allow_name_change']) && $settings['auth.allow_name_change'] == 1 ? 'checked="checked"' : set_checkbox('auth.allow_remember', 1); ?> >
									<?php echo lang('set_allow_name_change_note'); ?>
								</label>

								<div id="name-change-settings" style="<?php if (!$settings['auth.allow_name_change']) echo 'display: none'; ?>">
									<input type="text" name="name_change_frequency" style="width: 2em;" value="<?php echo $settings['auth.name_change_frequency'] ?>">
									<?php echo lang('set_name_change_frequency') ?>

									<input type="text" name="name_change_limit" style="width: 2em;" value="<?php echo $settings['auth.name_change_limit'] ?>">
									<?php echo lang('set_days') ?>
								</div>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<label class="checkbox" for="allow_remember">
									<input type="checkbox" name="allow_remember" id="allow_remember" value="1" <?php echo $settings['auth.allow_remember'] == 1 ? 'checked="checked"' : set_checkbox('auth.allow_remember', 1); ?> />
									<span><?php echo lang('bf_allow_remember') ?></span>
								</label>
							</div>
						</div>

						<div class="control-group" id="remember-length" style="<?php if (!$settings['auth.allow_remember']) echo 'display: none'; ?>">
							<label class="control-label" for="remember_length"><?php echo lang('bf_remember_time') ?></label>
							<div class="controls">
								<select name="remember_length" id="remember_length">
									<option value="604800"  <?php echo $settings['auth.remember_length'] == '604800' ?  'selected="selected"' : '' ?>>1 <?php echo lang('bf_week') ?></option>
									<option value="1209600" <?php echo $settings['auth.remember_length'] == '1209600' ? 'selected="selected"' : '' ?>>2 <?php echo lang('bf_weeks') ?></option>
									<option value="1814400" <?php echo $settings['auth.remember_length']== '1814400' ? 'selected="selected"' : '' ?>>3 <?php echo lang('bf_weeks') ?></option>
									<option value="2592000" <?php echo $settings['auth.remember_length'] == '2592000' ? 'selected="selected"' : '' ?>>30 <?php echo lang('bf_days') ?></option>
								</select>
							</div>
						</div>

						<div class="control-group" id="password-strength">
							<label class="control-label" for="password_min_length"><?php echo lang('bf_password_strength') ?></label>
							<div class="controls">
								<input type="text" name="password_min_length" id="password_min_length" value="<?php echo set_value('password_min_length', isset($settings['auth.password_min_length']) ? $settings['auth.password_min_length'] : '') ?>" class="span1" />
								<p class="help-inline"><?php echo lang('bf_password_length_help') ?></p>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label"><?php echo lang('set_option_password'); ?></label>
							<div class="controls">
								<label class="checkbox" for="password_force_numbers">
									<input type="checkbox" name="password_force_numbers" id="password_force_numbers" value="1" <?php echo set_checkbox('password_force_numbers', 1, isset($settings['auth.password_force_numbers']) && $settings['auth.password_force_numbers'] == 1 ? TRUE : FALSE); ?> />
									<?php echo lang('bf_password_force_numbers') ?>
								</label>
								<label class="checkbox" for="password_force_symbols">
									<input type="checkbox" name="password_force_symbols" id="password_force_symbols" value="1" <?php echo set_checkbox('password_force_symbols', 1, isset($settings['auth.password_force_symbols']) && $settings['auth.password_force_symbols'] == 1 ? TRUE : FALSE); ?> />
									<?php echo lang('bf_password_force_symbols') ?>
								</label>
								<label class="checkbox" for="password_force_mixed_case">
									<input type="checkbox" name="password_force_mixed_case" id="password_force_mixed_case" value="1" <?php echo set_checkbox('password_force_mixed_case', 1, isset($settings['auth.password_force_mixed_case']) && $settings['auth.password_force_mixed_case'] == 1 ? TRUE : FALSE); ?> />
									<?php echo lang('bf_password_force_mixed_case') ?>
								</label>
								<label class="checkbox" for="password_show_labels">
									<input type="checkbox" name="password_show_labels" id="password_show_labels" value="1" <?php echo set_checkbox('password_show_labels', 1, isset($settings['auth.password_show_labels']) && $settings['auth.password_show_labels'] == 1 ? TRUE : FALSE); ?> />
									<?php echo lang('bf_password_show_labels') ?>
								</label>
							</div>
						</div>

						<div class="control-group">
							<label for="password_iterations" class="control-label"><?php echo lang('set_password_iterations') ?></label>
							<div class="controls">
								<select name="password_iterations" style="width: auto">
									<option <?php echo set_select('password_iterations', 2, $settings['password_iterations'] == 2) ?>>2</option>
									<option <?php echo set_select('password_iterations', 4, $settings['password_iterations'] == 4) ?>>4</option>
									<option <?php echo set_select('password_iterations', 8, $settings['password_iterations'] == 8) ?>>8</option>
									<option <?php echo set_select('password_iterations', 16, $settings['password_iterations'] == 16) ?>>16</option>
									<option <?php echo set_select('password_iterations', 31, $settings['password_iterations'] == 31) ?>>31</option>
								</select>
								<span class="help-inline"><?php echo lang('bf_password_iterations_note'); ?></span>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="force_pass_reset"><?php echo lang('set_force_reset') ?></label>
							<div class="controls">
								<a href="<?php echo site_url(SITE_AREA .'/settings/users/force_password_reset_all'); ?>" class="btn btn-danger" onclick="return confirm('<?php echo lang('set_password_reset_confirm') ?>');">
									<?php echo lang('set_reset'); ?>
								</a>
								<span class="help-inline"><?php echo lang('set_reset_note'); ?></span>
							</div>
						</div>
					</fieldset>
				</div>
			<?php if (has_permission('Site.Developer.View')) : ?>
				<!-- Start of Developer Settings Tab Pane -->
				<div class="tab-pane" id="developer">
					<fieldset>
						<legend><?php echo lang('set_option_developer'); ?></legend>

						<div class="control-group">
							<div class="controls">
								<label class="checkbox" for="show_profiler">
									<input type="checkbox" name="show_profiler" id="show_profiler" value="1" <?php echo  $settings['site.show_profiler'] == 1 ? 'checked="checked"' : set_checkbox('auth.use_extended_profile', 1); ?> />
									<span><?php echo lang('bf_show_profiler') ?></span>
								</label>
								<label class="checkbox" for="show_front_profiler">
									<input type="checkbox" name="show_front_profiler" id="show_front_profiler" value="1" <?php echo  $settings['site.show_front_profiler'] == 1 ? 'checked="checked"' : set_checkbox('site.show_front_profiler', 1); ?> />
									<span><?php echo lang('bf_show_front_profiler') ?></span>
								</label>
								<label class="checkbox" for="do_check">
									<input type="checkbox" name="do_check" id="do_check" value="1" <?php echo $settings['updates.do_check'] == 1 ? 'checked="checked"' : set_checkbox('updates.do_check', 1); ?> />
									<span><?php echo lang('bf_do_check') ?></span>
									<p class="help-block"><?php echo lang('bf_do_check_edge') ?></p>
								</label>
								<label class="checkbox" for="bleeding_edge">
									<input type="checkbox" name="bleeding_edge" id="bleeding_edge" value="1" <?php echo $settings['updates.bleeding_edge'] == 1 ? 'checked="checked"' : set_checkbox('updates.bleeding_edge', 1); ?> />
									<span><?php echo lang('bf_update_show_edge') ?></span>
									<p class="help-block"><?php echo lang('bf_update_info_edge') ?></p>
								</label>
							</div>
						</div>

					</fieldset>
				</div>
				<!-- End of Developer Tab Options Pane -->
			<?php endif;
				if ($show_extended_settings) :
			?>
				<!-- Start of Extended Settings Tab Pane -->
				<div class='tab-pane' id='extended'>
					<fieldset>
						<legend><?php echo lang('set_option_extended'); ?></legend>
				<?php
					foreach ($extended_settings as $field)
					{
						if ( empty($field['permission'])
							|| $field['permission'] === FALSE
							|| ( ! empty($field['permission']) && has_permission($field['permission']))
							)
						{
							$form_error_class = form_error($field['name']) ? ' error' : '';
							$field_control = '';

							if ($field['form_detail']['type'] == 'dropdown')
							{
								echo form_dropdown($field['form_detail']['settings'], $field['form_detail']['options'], set_value($field['name'], isset($settings['ext.' . $field['name']]) ? $settings['ext.' . $field['name']] : ''), $field['label']);
							}
							elseif ($field['form_detail']['type'] == 'checkbox')
							{
								$field_control = form_checkbox($field['form_detail']['settings'], $field['form_detail']['value'], isset($settings['ext.' . $field['name']]) && $field['form_detail']['value'] == $settings['ext.' . $field['name']] ? TRUE : FALSE);
							}
							elseif ($field['form_detail']['type'] == 'state_select')
							{
								if ( ! is_callable('state_select'))
								{
									$this->load->config('address');
									$this->load->helper('address');
								}
								$field_control = state_select(isset($settings['ext.' . $field['name']]) ? $settings['ext.' . $field['name']] : 'CA', 'CA', 'US', $field['name'], 'span6 chzn-select');
							}
							elseif ($field['form_detail']['type'] == 'country_select')
							{
								if ( ! is_callable('country_select'))
								{
									$this->load->config('address');
									$this->load->helper('address');
								}
								$field_control = country_select(set_value($field['name'], isset($settings['ext.' . $field['name']]) ? $settings['ext.' . $field['name']] : 'US'), 'US', $field['name'], 'span6 chzn-select');
							}
							else
							{
								$form_method = 'form_' . $field['form_detail']['type'];
								if (is_callable($form_method))
								{
									echo $form_method($field['form_detail']['settings'], set_value($field['name'], isset($settings['ext.' . $field['name']]) ? $settings['ext.' . $field['name']] : ''), $field['label']);
								}
							}

							if ( ! empty($field_control)) :
						?>
								<div class="control-group<?php echo $form_error_class; ?>">
									<label class="control-label" for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?></label>
									<div class="controls">
										<?php echo $field_control; ?>
									</div>
								</div>
						<?php
							endif;
						}
					}
				?>
				</fieldset>
				
				</div>
			<?php endif; ?>
			</div>
		</div>

		<div class="form-actions">
			<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('bf_action_save') . ' ' . lang('bf_context_settings'); ?>" />
		</div>

	<?php echo form_close(); ?>
</div><!-- /admin-box -->