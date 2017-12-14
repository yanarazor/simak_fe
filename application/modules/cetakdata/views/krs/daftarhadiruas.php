 
<div class="admin-box">

	<form action="<?php echo base_url()."admin/krs/cetakdata/printdaftarhadiruas" ?>" method="get" accept-charset="utf-8">
	 
    	<table>
    		<tr>
                <td>Tahun Kademik</td>
                <td>:</td>
                <td>
                	 <select name="tahun" id="tahun" class="chosen-select-deselect">
					  <option value=""></option>
					  <?php if (isset($pilihantahuns) && is_array($pilihantahuns) && count($pilihantahuns)):?>
					  <?php foreach($pilihantahuns as $record):?>
						  <option value="<?php echo $record->value?>" <?php if(isset($jadwal['tahun_akademik']))  echo  ($record->value==$jadwal['tahun_akademik']) ? "selected" : ""; ?>><?php echo $record->label; ?></option>
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
                <td>Matakuliah</td>
				<td>:</td> 		
                <td>
                	<select name="kode_mk" id="kode_mk" class="chosen-select-deselect">
						 <option value=""></option>
						  
					 </select>
                </td> 
			  </tr>
			<tr>
                <td>Kelas</td>
                <td>:</td>
                <td>
                	 <select name="kelas" id="kelas" class="chosen-select-deselect">
						<option value=""></option>
					   
					</select>
                </td> 
            </tr>
            <tr>
                <td>Jumlah Kolom</td>
                <td>:</td>
                <td>
                	 <input type="text" name="jml"/>
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
	 
</div>
</div>
<script type="text/javascript">	  
	 
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
	
	$("#tahun").change(function(){
			var jadwal_prodi 	= $("#filljurusan").val();
			var tahun_akademik 	= $("#tahun").val();
			//var jadwal_semester = $("#jadwal_semester").val();
			
			$("#jadwal_kode_mk").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&jadwal_prodi=" + encodeURIComponent(jadwal_prodi);
			$.getJSON(json_url,function(data){
				$("#kode_mk").empty(); 
				if(data==""){
					$("#kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
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
	$("#filljurusan").change(function(){
		  	var jadwal_prodi 	= $("#filljurusan").val();
			var tahun_akademik 	= $("#tahun").val();
			//var jadwal_semester = $("#jadwal_semester").val();
			
			$("#jadwal_kode_mk").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&jadwal_prodi=" + encodeURIComponent(jadwal_prodi);
			$.getJSON(json_url,function(data){
				$("#kode_mk").empty(); 
				if(data==""){
					$("#kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
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
 	$("#jadwal_semester").change(function(){
		  	var jadwal_prodi 	= $("#filljurusan").val();
			var tahun_akademik 	= $("#tahun").val();
			 
			$("#kode_mk").empty().append("<option>loading...</option>");
			var json_url = "<?php echo base_url(); ?>index.php/admin/master/mastermatakuliah/getbytahun?tahun_akademik=" + encodeURIComponent(tahun_akademik)+"&jadwal_prodi=" + encodeURIComponent(jadwal_prodi);
			//alert(json_url);
			$.getJSON(json_url,function(data){
				$("#kode_mk").empty(); 
				if(data==""){
					$("#kode_mk").append("<option value=\"\">-- Pilih Matakuliah --</option>");
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
</script>