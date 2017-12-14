<br/>
<div class="admin-box">

	<form action="<?php $this->uri->uri_string() ?>" method="get" accept-charset="utf-8" id="frmcari">
	 
    	<table>
    		 
			<tr> 
				<td>Tahun Ajaran</td>
                <td></td>
            </tr>
            <tr>
               	<td>
                	<input id='ta' type='text' style="width:300px" name='nim' value="<?php echo set_value('ta', isset($ta) ? $ta : ''); ?>" />
               	</td> 
                
				<td valign="top">
                	 
               	</td> 
            </tr>
            <tr> 
				<td>Prodi</td>
                <td></td>
            </tr>
            <tr>
               	<td>
                	<select name="kode_prodi" id="kode_prodi" class="chosen-select-deselect">
						<option value=""></option>
						<?php if (isset($masterprogramstudis) && is_array($masterprogramstudis) && count($masterprogramstudis)):?>
						<?php foreach($masterprogramstudis as $record):?>
							 <option value="<?php echo $record->kode_prodi?>" <?php if(isset($mastermahasiswa['kode_prodi']))  echo  ($record->kode_prodi==$mastermahasiswa['kode_prodi']) ? "selected" : ""; ?>><?php echo $record->nama_prodi; ?></option>
						 <?php endforeach;?>
						<?php endif;?>
					</select>

               	</td> 
                
				<td valign="top">
                	 <input type="submit" name="Act" class="btn btn-primary" value="Cari "  />
               	</td> 
            </tr>
            
            
        </table>
    <?php echo form_close(); ?>
	<br>
 	<div id="divcontent">
 		
 	</div>
</div>
<script type="text/javascript">  
$(document).ready(function() {	 
	showdata("");	 
});
function showdata(ta){
	 var prodi 	= $("#kode_prodi").val();
	  
		$('#divcontent').html("<center>Load data...</center>");
		var post_data = "ta="+ta+"&kode_prodi="+prodi;
	$.ajax({
			url: "<?php echo base_url() ?>index.php/admin/reports/epsbed/getreport",
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
	 
	var varta 	= $("#ta").val();
	showdata(varta);
		return false;
	});
</script> 