<?php
$this->load->library('convert');
$convert = new convert();
$num_columns	= 11;
$can_delete	= $this->auth->has_permission('Informasi_dan_Berita.Site.Delete');
$can_edit		= $this->auth->has_permission('Informasi_dan_Berita.Site.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<div class="admin-box">
<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8">
	 <table>
        	<tr>
				<td>
                	Kategori Berita
                </td>
                <td>Judul
                </td>
                   
            </tr>
            <tr>
            	<td>
                	<select name="kat" id="kat" class="chosen-select-deselect">
						<option value="">-- Pilih kategori --</option>
						<?php if (isset($kategoris) && is_array($kategoris) && count($kategoris)):?>
						<?php foreach($kategoris as $kategori_record):?>
							<option value="<?php echo $kategori_record->id?>" <?php if(isset($kat))  echo  ($kategori_record->id==$kat) ? "selected" : ""; ?>><?php echo $kategori_record->category; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                </td>
                <td>
                	<input id='ta' type='text' name='title' maxlength="255" value="<?php echo isset($title)? $title : "";?>" />
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
					<th>Headline</th>
					<th>Kategori</th>
					<th>Content</th> 
					<th>Foto</th> 
					<th>Auth Komen</th>
					<th>Jml Dilihat</th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">
						<?php echo lang('bf_with_selected'); ?>
						<input type="submit" name="delete" id="delete-me" class="btn btn-danger" value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('informasi_dan_berita_delete_confirm'))); ?>')" />
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
					<td class="column-check"><input type="checkbox" name="checked[]" value="<?php echo $record->id_berita; ?>" /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/site/informasi_dan_berita/edit/' . $record->id_berita, '<span class="icon-pencil"></span>' .  $record->judul); ?></td>
				<?php else : ?>
					<td><?php e($record->judul); ?></td>
				<?php endif; ?>
					<td><?php e($convert->countwordscustom($record->headline)) ?></td>
					<td><?php e($record->category) ?></td>
					<td><?php e($convert->countwordscustom($record->content)) ?></td>
					 
					<td>
					<?php if(isset($record) && isset($record->foto) && $record->foto!='no image' && !empty($record->foto)) :
                            $attachmentfile = $record->foto;
                            
							echo "<a href='".base_url().$this->settings_lib->item('site.urlimages').$attachmentfile."' class='fancy'/>";
							echo "<img alt=".$attachmentfile." title=".$attachmentfile." src='".base_url().$this->settings_lib->item('site.urlimages').$attachmentfile."' width='50px'>";
							
                        endif;
						echo "</a>";
                    ?>
					</td> 
					<td><?php e($record->auth_komen) ?></td>
					<td><?php e($record->jml_dilihat) ?></td>
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