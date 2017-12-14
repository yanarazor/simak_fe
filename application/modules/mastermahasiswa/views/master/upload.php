<div class="tab-pane <?php echo isset($lampiran_instruktur['id']) ? "":"active"; ?>" id="main-data">
		  <div class="divdata">
			  <div class="alert alert-block alert-warning fade in ">
				<a class="close" data-dismiss="alert">&times;</a>
				 1. Silahkan Pilih File Data mahasiswa (KDPTIMSMHS	KDJENMSMHS	KDPSTMSMHS	NIMHSMSMHS	NMMHSMSMHS	SHIFTMSMHS	TPLHRMSMHS	TGLHRMSMHS	KDJEKMSMHS	TAHUNMSMHS	SMAWLMSMHS	BTSTUMSMHS	ASSMAMSMHS	TGMSKMSMHS	TGLLSMSMHS	STMHSMSMHS	STPIDMSMHS	SKSDIMSMHS	ASNIMMSMHS	ASPTIMSMHS	ASJENMSMHS	ASPSTMSMHS	BISTUMSMHS	PEKSBMSMHS	NMPEKMSMHS	PTPEKMSMHS	PSPEKMSMHS	NOPRMMSMHS	NOKP1MSMHS	NOKP2MSMHS	NOKP3MSMHS	NOKP4MSMHS), Misal kode prodi Akuntansi "62201"<br>
				 2. Tunggu Sampai Muncul Peringatan(warning) "Upload Selesai" <br>
			  </div>
			  <form method="post" action="#" enctype="multipart/form-data" name="frminput" id="frminput">
				  <input type="file" name="file_upload" id="file_upload" /> 
			  </form>
						 
		  </div>
	  </div>

<script type="text/javascript">	
$(document).ready(function() {
	 
	$(".mini-delete").live("click", function(){
                conf = confirm("Do you realy want to delete this image?");
                
				if (!conf)
                    return false;

                var id = $(this).attr('data-id');
                target = $(this);
				var aksi = "delimage_gallery";
				if(target.attr("aksi")!="")
					aksi = target.attr("aksi");
                var dataPost = "id="+target.attr("data-id");
				 
                $.ajax({
                    type:"post",
                    data:dataPost,
                    dataType:"html",
                    url:"index.php/admin/content/gallery/"+aksi,
                    success: function(msg){
                        json = jQuery.parseJSON(msg);
                        if (json.status == "TRUE") {
                            target.parent().parent().hide("slow");
                        }
                        else {
                            alert(json.message);
                        }
                    },
                    error: function(msg){
                        alert(msg+'Request Errors. Please try again.');
                    }
                });
            });

 	var iddesa ='1';
	 $('#file_upload').uploadify({
		
                'buttonImage' : null,
                'swf'      : '<?php echo base_url(); ?>assets/js/uploadify/uploadify.swf',
                'uploader' : '<?php echo base_url(); ?>index.php/admin/master_front/mastermahasiswa/import_data?session_id=1&user_id=1&provinsi=1',
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