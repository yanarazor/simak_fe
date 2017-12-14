<div class="admin-box">
	<div class="col-md-12">
				<select name="filfakultas" id="filfakultas" class="chosen-select-deselect" style="width:300px;">
					  <option value="">Pilih Fakultas</option>
					  <?php if (isset($masterfakultass) && is_array($masterfakultass) && count($masterfakultass)):?>
					  <?php foreach($masterfakultass as $record):?>
						  <option value="<?php echo $record->kode_fakultas;?>" <?php if(isset($filfakultas))  echo  ($record->kode_fakultas==$filfakultas) ? "selected" : ""; ?>><?php echo $record->nama_fakultas; ?></option>
						  <?php endforeach;?>
					  <?php endif;?>
				  </select>
				  <select name="prodi" id="slcprodi" onchange="showstatmahasiswa()" class="chosen-select-deselect">
					 <option value="">Pilih Program Studi</option>
					 <?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
					  <?php foreach($masterprogramstudis as $record):?>
						   <option value="<?php echo $record->kode_prodi?>" <?php if(isset($filljurusan))  echo  ($record->kode_prodi==$filljurusan) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
					   <?php endforeach;?>
					  <?php endif;?>
				   </select>
		<div id="statmahasiswacontent">
		   
	   </div>
	</div>
 
</div>
</script>
<script type="text/javascript">  
$("#filfakultas").change(function(){
	 var valfakultas 	= $("#filfakultas").val();
	 var valprodi 	= $("#slcprodi").val();
	 
	 $("#slcprodi").empty().append("<option>loading...</option>");
	 var json_url = "<?php echo base_url(); ?>admin/master/masterprogramstudi/getbyfakultas?fak=" + encodeURIComponent(valfakultas);
	 $.getJSON(json_url,function(data){
		 $("#slcprodi").empty(); 
		 if(data==""){
			 $("#slcprodi").append("<option value=\"\">-- Pilih Prodi --</option>");
		 }
		 else{
			 $("#slcprodi").append("<option value=\"\">-- Pilih Prodi --</option>");
			 for(i=0; i<data.id.length; i++){
				 $("#slcprodi").append("<option value=\"" + data.id[i]  + "\">" + data.nama_prodi[i] +"</option>");
			 }
		 }
		 
	 });
	 return false;
 });
$(document).ready(function() {	 
	showstatmahasiswa(); 
});
function showstatmahasiswa(){
	var valprodi = $('#slcprodi').val();
	var valfakultas = $('#filfakultas').val();
 		//$('#statmahasiswacontent').attr('style', 'background-color: #ecf2f9 !important;height:100px');
		$('#statmahasiswacontent').html("<center><br><br><br>Load data...</center>");
		var post_data = "prodi="+valprodi+"&fakultas="+valfakultas;
		//alert("<?php echo base_url() ?>admin/krs/cetakdata/showstatistikmahasiswa/?"+post_data);
	$.ajax({
			url: "<?php echo base_url() ?>admin/krs/cetakdata/showstatistikmahasiswa/",
			type:"post",
			data: post_data,
			dataType: "html",
			timeout:180000,
			success: function (result) {
			//alert("<?php echo base_url() ?>admin/reports/dashboard_adm/showstatistikmahasiswa/?"+post_data);
			$('#statmahasiswacontent').html(result);
			$('#statmahasiswacontent').attr('style', 'background-color: transparent !important;height:auto');
			//alert(result);
		},
		error : function(error) {
			alert(error);
		} 
	});  
	  
}  
</script> 