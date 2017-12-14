<?php

$validation_errors = validation_errors();

?>
<br>
<div class="alert alert-block alert-success fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Perhatian :</h4>
	Fitur ini untuk menghitung KHS setiap mahasiswa berdasarkan parameter-parameter yang telah disediakan,<br>
	Silahkan tentukan parameter pencarian dan klik "Hitung KHS" untuk memproses perhitungan KHS mahasiswa berdasarkan parameter pencarian..
	untuk melihat hasil dari perhitungan silahkan masuk ke menu list
</div>
<?php

if (isset($khs))
{
	$khs = (array) $khs;
}
$id = isset($khs['id']) ? $khs['id'] : '';

?>
<div class="admin-box">
	<form action="<?php $this->uri->uri_string() ?>" method="get" id="frmmahasiswa" accept-charset="utf-8">
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
							<option value="<?php echo $record->kode_fakultas;?>" <?php if(isset($filfakultas))  echo  ($record->kode_fakultas==$filfakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
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
						<option value=""></option>
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
            <td>Status</td>
                <td>:</td>
                <td>
                	<select name="status" id="status" class="chosen-select-deselect">
						<option value="">Silahkan Pilih</option>
						 	 <option value="1" <?php if(isset($status))  echo  ($status == "1") ? "selected" : ""; ?>>Pagi</option>
						 	<option value="2" <?php if(isset($status))  echo  ($status == "2") ? "selected" : ""; ?>>Sore</option>
						 
					</select>
               	</td> 
                <td>
                 
            </tr>
         <tr>
	 		<td>Angkatan</td>
	 		<td>:</td>
	 		<td>
	            <input id='angkatan' type='text' name='angkatan' value="<?php echo set_value('mhs', isset($angkatan) ? $angkatan : ''); ?>" />
	        </td> 
	 	</tr>
	 	 <tr>
	 		<td>NIM Mahasiswa</td>
	 		<td>:</td>
	 		<td>
	            <input id='mhs' type='text' name='mhs' value="<?php echo set_value('mhs', isset($mhs) ? $mhs : ''); ?>" />
	        </td> 
	 	</tr>

            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td valign="top">
                	 <input type="submit" name="Act" class="btn btn-primary" value="Hitung KHS"  />
               	</td> 
            </tr>
            
        </table>
    <?php echo form_close(); ?>
    
    <div id="divmahasiswa">
				 
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
 	 $("#filfakultas").change(function(){
		var valfakultas 	= $("#filfakultas").val();
		$("#filljurusan").empty().append("<option>loading...</option>");
		var json_url = "<?php echo base_url(); ?>admin/master/masterprogramstudi/getbyfakultas?fak=" + encodeURIComponent(valfakultas);
		$.getJSON(json_url,function(data){
			$("#filljurusan").empty(); 
			if(data==""){
				$("#filljurusan").append("<option value=\"\">-- Pilih --</option>");
			}
			else{
				$("#filljurusan").append("<option value=\"\">-- Pilih --</option>");
				for(i=0; i<data.id.length; i++){
					$("#filljurusan").append("<option value=\"" + data.id[i]  + "\">" + data.nama_prodi[i] +"</option>");
				}
			}
			
		});
		return false;
	});
	 $("#frmmahasiswa").submit( function() {
		$('#divmahasiswa').html("<center>Hitung KHS...</center>");
		//alert("<?php echo base_url(); ?>admin/nilai/khs/hitungkhs");
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/nilai/khs/hitungkhs",
			data: $(this).serialize(),
			success: function(data) {
				$('#divmahasiswa').html(data);
				$('#divmahasiswa').fadeIn(1000);
			}
		})
		return false;
	});
	  
});
 
</script>