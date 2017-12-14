 
<div class="admin-box">

	<form action="<?php echo base_url()."admin/krs/cetakdata/perkelas" ?>" method="get" accept-charset="utf-8">
	 
    	<table>
    		<tr>
                <td>Tahun Kademik</td>
                <td>:</td>
                <td>
                	 <select name="tahun" id="tahun" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihantahuns) && is_array($pilihantahuns) && count($pilihantahuns)):?>
					  <?php foreach($pilihantahuns as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($tahun))  echo  ($record->value==$tahun) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
                </td> 
            </tr>
            	
    		<tr>
                <td>Fakultas</td>
                <td>:</td>
                <td>
                	<select name="filfakultas" id="filfakultas" class="chosen-select-deselect" style="width:300px;">
						<option value=""></option>
						<?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
						<?php foreach($masterfakultass as $record):?>
							<option value="<?php echo $record->kode_fakultas;?>" <?php if(isset($fakultas))  echo  ($record->kode_fakultas==$fakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
							<?php endforeach;?>
						<?php endif;?>
					</select>
                </td> 
            </tr>
            	
            <tr>
            	<td>Program Studi</td>
                <td>:</td>
                <td>
                	<select name="filljurusan" id="filljurusan" class="chosen-select-deselect">
						<?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
						<?php foreach($masterprogramstudis as $record):?>
							 <option value="<?php echo $record->kode_prodi?>" <?php if(isset($filljurusan))  echo  ($record->kode_prodi==$filljurusan) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
						 <?php endforeach;?>
						<?php endif;?>
					</select>
               	</td> 
                <td>
                 
            </tr>
            <tr>
                <td>Matakuliah</td>
				<td>:</td> 		
                <td>
                	<input id='kode_mk' type='text' name='kode_mk' value="<?php echo set_value('kode_mk', isset($kode_mk) ? $kode_mk : ''); ?>" />
                </td> 
			  </tr>
			<tr>
               	<td>&nbsp;</td>
               	<td>&nbsp;</td>
				<td>
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
        </table>
    <?php echo form_close(); ?>
	<br>
	<table class="table table-striped" style="width:500px">
			<thead>
				<tr>
					<th>Mata Kuliah</th>
					<th>Kelas</th>
					<th>Jumlah Mahasiswa</th>
					 
				</tr>
			</thead>
			 
			<tfoot> 
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
			</tfoot>
			 
			<tbody>
				<?php
				if (isset($records) && is_array($records) && count($records)) :
					foreach ($records as $record) :
				?>
				<tr>
					<td><a href="<?php echo base_url().'admin/krs/cetakdata/printdaftarhadir/?kode_mk='.$record->kode_mk; ?>&tahun=<?php echo $record->tahun_akademik; ?>&filfakultas=<?php echo $fakultas; ?>&filljurusan=<?php echo $filljurusan; ?>"><?php echo $record->kode_mk; ?></a></td>
					<td><a href="<?php echo base_url().'admin/krs/cetakdata/printdaftarhadir/?kode_mk='.$record->kode_mk; ?>&tahun=<?php echo $record->tahun_akademik; ?>&filfakultas=<?php echo $fakultas; ?>&filljurusan=<?php echo $filljurusan; ?>"><?php echo $record->kelas; ?></a></td>	  
					<td><?php e($record->jml_mahasiswa) ?></td> 
					  
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan="3">Tidak ada Data yang sesuai dengan pilihan anda</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
</div>
</div>
<script type="text/javascript">	  
	$("#tahun").change(function(){
		var tahun_akademik = $("#tahun").val();
		$("#kode_mk").empty().append("<option>loading...</option>"); //show loading...
		var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik);
		//alert(json_url);
		$.getJSON(json_url,function(data){
			$("#kode_mk").empty(); 
			if(data==""){
				$("#kode_mk").append("<option value=\"\">Pilih Matakuliah </option>");
			}
			else{
				$("#kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
				for(i=0; i<data.id.length; i++){
					$("#kode_mk").append("<option value=\"" + data.id[i]  + "\">" + data.nama_mata_kuliah[i] +"</option>");
				}
			} 
		}); 
		return false;
	});
	
	$("#kode_mk").change(function(){
		var tahun_akademik = $("#tahun").val();
		var valkode_mk = $("#kode_mk").val();
		
		$("#kelas").empty().append("<option>loading...</option>"); //show loading...
		var json_url = "<?php echo base_url(); ?>index.php/admin/settings/jadwal/getkelas?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&valmk=" + encodeURIComponent(valkode_mk);
		//alert(json_url);
		$.getJSON(json_url,function(data){
			$("#kelas").empty(); 
			if(data==""){
				$("#kelas").append("<option value=\"\">Pilih Kelas </option>");
			}
			else{
				$("#kelas").append("<option value=\"\">-- Pilih Kelas --</option>");
				for(i=0; i<data.id.length; i++){
					$("#kelas").append("<option value=\"" + data.id[i]  + "\">" + data.id[i] +"</option>");
				}
			} 
		}); 
		return false;
	});
	 
</script>