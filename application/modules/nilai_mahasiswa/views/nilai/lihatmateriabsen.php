<!-- sweet alert -->
<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
<?php
	$this->load->library('convert');
	$convert = new convert();
  // Change the css classes to suit your needs
if( isset($recordmateri) ) {
	$recordmateri = (array)$recordmateri;
}
$id = isset($recordmateri['id']) ? $recordmateri['id'] : '';
?>

<div class="box box-info">
	  
  <div class="box-body">
	<table border="0" class="" width="100%">
    	<tr>
            <td align="left" width="100px" class="point"> Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="250px"><?php echo isset($recordjadwal[0]->nama_prodi) ? $recordjadwal[0]->nama_prodi :"" ?></td>
            <td>&nbsp;</td>
            <td  width="100px"></td>
            <td align="left" width="10px"></td>
            <td></td>
        </tr>
        <tr>
            <td align="left" class="point"> Mata Kuliah  </td>
            <td align="left">:</td>
            <td><?php echo isset($recordjadwal[0]->nama_mata_kuliah) ? $recordjadwal[0]->nama_mata_kuliah :"" ?></td>
            <td>&nbsp;</td>
            <td width="100px"></td>
            <td align="left" width="10px"></td>
            <td>
              
             </td>
        </tr>
        
       <tr>
        	 
            <td align="left" class="point">Dosen</td>
            <td align="left">:</td>
            <td><?php echo isset($recordjadwal[0]->nama_dosen) ? $recordjadwal[0]->nama_dosen :"" ?></td>
            <td>&nbsp;</td>
            <td width="100px"></td>
            <td align="left" width="10px"></td>
            <td></td>
        </tr>
		<tr>
        	 
            <td align="left" class="point">Semester </td>
            <td align="left">:</td>
            <td><?php echo isset($recordjadwal[0]->tahun_akademik) ? $recordjadwal[0]->tahun_akademik :"" ?></td>
            <td>&nbsp;</td>
            <td width="200px"></td>
            <td align="left" width="10px"></td>
             <td>
             </td>
        </tr>
        <tr>
        	 
            <td align="left" class="point">Kelas </td>
            <td align="left">:</td>
            <td><?php echo isset($recordjadwal[0]->kelas) ? $recordjadwal[0]->kelas :"" ?></td>
            <td>&nbsp;</td>
            <td width="200px"></td>
            <td align="left" width="10px"></td>
             <td>
             </td>
        </tr>
		
    </table>
<h3>Detil Materi</h3>
   <table border="0" class="" width="100%">
    	<tr>
            <td align="left" width="100px" class="point">Pertemuan ke</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="350px"><?php echo isset($recordmateri['pertemuan'])?$recordmateri['pertemuan']:"" ?></td>
             
        </tr>
        <tr>
            <td align="left" valign="top" class="point"> Deskripsi  </td>
            <td align="left" valign="top">:</td>
            <td><?php echo isset($recordmateri['desc_materi'])?$recordmateri['desc_materi']:"" ?></td>
            
        </tr>
		 <tr>
            <td align="left" class="point">Lihat File Materi  </td>
            <td align="left">:</td>
            <td>
            <?php if(isset($recordmateri['desc_materi']) and $recordmateri['desc_materi'] != ""){
            ?>
            	 <a href="<?php echo $this->settings_lib->item('site.urlmateri'); ?><?php echo isset($recordmateri['file_materi']) ? $recordmateri['file_materi'] : '';?>" target="_blank">
					  <img alt="" src="<?php echo base_url(); ?>assets/images/attach.gif">
				  </a>
            <?php
            }
            ?>
            </td>
            
        </tr>
    </table>
	<br>
	<div class="col-md-12">
              <!-- DIRECT CHAT -->
              <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Kirim Pesan Ke dosen</h3>
                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">-</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                      <i class="fa fa-comments"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <?php
					$has_records	= isset($recordpesan) && is_array($recordpesan) && count($recordpesan);
					if ($has_records) :
						foreach ($recordpesan as $record) :
					?>
						<div class="direct-chat-msg <?php echo $record->dari == $this->auth->user_id() ? "right": ""; ?>">
						  <div class="direct-chat-info clearfix">
							<span class="direct-chat-name  <?php echo $record->dari == $this->auth->user_id() ? "pull-right": ""; ?>"><?php echo $record->dari_nama; ?></span>
							<span class="direct-chat-timestamp  <?php echo $record->dari == $this->auth->user_id() ? "pull-left": ""; ?>"><?php echo $record->tanggal; ?></span>
						  </div>
						  <!-- /.direct-chat-info -->
						  <img class="direct-chat-img" src="<?php echo base_url();?>assets/images/noimage.jpg" alt="message user image"><!-- /.direct-chat-img -->
						  <div class="direct-chat-text">
							<?php echo $record->pesan; ?>
						  </div>
						  <!-- /.direct-chat-text -->
						</div>
					<?php
						endforeach;
					endif; ?>
                  </div>
                  <!--/.direct-chat-messages-->

                  <!-- Contacts are loaded here -->
                  <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user1-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Count Dracula
                                  <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                            <span class="contacts-list-msg">How have you been? I was...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user7-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Sarah Doe
                                  <small class="contacts-list-date pull-right">2/23/2015</small>
                                </span>
                            <span class="contacts-list-msg">I will be waiting for...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user3-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nadia Jolie
                                  <small class="contacts-list-date pull-right">2/20/2015</small>
                                </span>
                            <span class="contacts-list-msg">I'll call you back at...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user5-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Nora S. Vans
                                  <small class="contacts-list-date pull-right">2/10/2015</small>
                                </span>
                            <span class="contacts-list-msg">Where is your new...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user6-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  John K.
                                  <small class="contacts-list-date pull-right">1/27/2015</small>
                                </span>
                            <span class="contacts-list-msg">Can I take a look at...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                      <li>
                        <a href="#">
                          <img class="contacts-list-img" src="dist/img/user8-128x128.jpg" alt="User Image">

                          <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                  Kenneth M.
                                  <small class="contacts-list-date pull-right">1/4/2015</small>
                                </span>
                            <span class="contacts-list-msg">Never mind I found...</span>
                          </div>
                          <!-- /.contacts-list-info -->
                        </a>
                      </li>
                      <!-- End Contact Item -->
                    </ul>
                    <!-- /.contatcts-list -->
                  </div>
                  <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <form action="#" method="post" id="frmchat">
                    <div class="input-group">
                     
                     	<input type="hidden" name="nidn" id="nidn" value="<?php echo isset($recordjadwal[0]->nidn) ? $recordjadwal[0]->nidn : ""; ?>">
                    	<input type="hidden" name="id_materi" id="id_materi" value="<?php echo $id_materi; ?>">
                      <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
                          <span class="input-group-btn">
                            <button type="button" id="btnsubmit" class="btn btn-warning btn-flat">kirim</button>
                          </span>
                    </div>
                  </form>
                </div>
                <!-- /.box-footer-->
              </div>
              <!--/.direct-chat -->
            </div>
</div> 
</div> 
<script src="<?php echo base_url(); ?>themes/adminlte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
$("#btnsubmit").click(function(){
	var valmessage = $("#message").val();
	if(valmessage == ""){
		$("#message").focus();	
		swal("isi pesan anda", "Warning");
		return false;
	}
	var json_url = "<?php echo base_url() ?>admin/nilai/nilai_mahasiswa/kirimpesan";
	 $.ajax({    
		type: "POST",
		url: json_url,
		data: $("#frmchat").serialize(),
		success: function(data){ 
			swal(data, "Warning");
			location.reload(true);
		}});
	return false; 
});
</script>


