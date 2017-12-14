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
	 
</div> 
</div> 
