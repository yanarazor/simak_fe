<div class="tab-pane <?php echo isset($lampiran_instruktur['id']) ? "":"active"; ?>" id="main-data">
		  <div class="divdata">
			  <div class="alert alert-block alert-warning fade in ">
				<a class="close" data-dismiss="alert">&times;</a>
				 1. Silahkan Pilih File Data Transkip Nilai (FORMAT EXCELL DENGAN URUTAN<br>
				 2. Tunggu Sampai Muncul Peringatan(warning) "Upload Selesai" <br>
			  </div>
			  <form method="post" action="#" enctype="multipart/form-data" name="frminput" id="frminput">
				  <input type="file" name="file_upload" id="file_upload" /> 
			  </form>
						 
		  </div>
	  </div>

<script type="text/javascript">	
$(document).ready(function() { 

 	var iddesa ='1';
	 $('#file_upload').uploadify({
		
                'buttonImage' : null,
                'swf'      : '<?php echo base_url(); ?>assets/js/uploadify/uploadify.swf',
                'uploader' : '<?php echo base_url(); ?>index.php/admin/krs_front/transkip/import_data?session_id=1&user_id=1&provinsi=1',
                'auto'      : true,
                'multi'     : true,
                'fileSizeLimit' : '400MB',
		        'fileTypeExts'	: '*.txt;*.csv;*.dll;*.xlsx;*.xls;',	 
				'scriptData' : {'user_id' : '1'},
        		'onUploadError' : function(file, errorCode, errorMsg, errorString,response) {
        			alert('The file ' + file.name + ' ini could not be uploaded: ' + errorString );
                },
                'onUploadSuccess' : function(file, msg, response) {
					//alert($("#id_desac").val());
					alert(msg);
                    json = jQuery.parseJSON(msg);
				},
    			'method'   : 'POST',
                'uploadLimit' : 10
                // Your options here
            }); 
		 
});
</script>