<br/>
<div class="admin-box">

	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8" id="frmcari">
	 
    	<table>
    		 
			<tr> 
				<td>NIM</td>
                <td></td>
            </tr>
            <tr>
               	<td>
                	<input id='nim' type='text' style="width:300px" name='nim' value="<?php echo set_value('nim', isset($nim) ? $nim : ''); ?>" />
               	</td> 
                
				<td valign="top">
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
             <tr>
               	<td>
                	<input type="checkbox" id="nilaikosong" name="nilaikosong" value="1" checked> Sertakan Nilai Kosong
                </td> 
                
				<td valign="top">
                	
               	</td> 
            </tr>
        </table>
    <?php echo form_close(); ?>
	<br>
 	<div id="divcontent">
 		Silahkan Masukan NIM untuk melihat Transkip
 	</div>
</div>
<script type="text/javascript">  
$(document).ready(function() {	 
	showdata("<?php echo $nim; ?>","0");	 
});
function showdata(varnim,nilai){
	 
		$('#divcontent').html("<center>Load data...</center>");
		var post_data = "valnim="+varnim+"&nilai="+nilai;
	$.ajax({
			url: "<?php echo base_url() ?>index.php/admin/krs/transkip/caritranskip",
			type:"POST",
			data: post_data,
			dataType: "html",
			timeout:180000,
			success: function (result) {
				$('#divcontent').html(result);
		},
		error : function(error) {
			alert(error);
		} 
	});        
} 
$("#frmcari").submit( function() {
	 
	var varnim 	= $("#nim").val();
	var valnilaikosong 	=  $("#nilaikosong").attr("checked") ? 1 : 0;
	//var valnilaikosong 	= $("#nilaikosong").val();
	 
	showdata(varnim,valnilaikosong);
		return false;
	});
</script> 