<style>
 
@media print {
    body {
		font-weight:normal;
      font-style:normal;
      font-variant:normal;
	
		font-size : 9pt;
    }
	.break { page-break-before: always; }
	@font-face {
		font-family: "Times New Roman", Times, serif;
		/*
		src: url('../font/DOTMATRI.eot');
		src: url('../font/DOTMATRI.eot?#iefix') format('embedded-opentype'),
			 url('../font/DOTMATRI.woff') format('woff'),
			 url('../font/DOTMATRI.ttf') format('truetype'),
			 url('../font/DOTMATRI.svg#proxima_nova_rgregular') format('svg');
			 */
		font-weight: normal;
		font-style: normal;

	}
	 
   table {
	 border-collapse: collapse;
   }
	/* use this class to attach this font to any element i.e. <p class="fontsforweb_fontid_507">Text with this font applied</p> */
	.fontsforweb_fontid_507 {
		font-family: 'DOTMATRI' !important;
	}
	.btnprint{
		display: none;
	}
}
</style>
<br/>
<?php
	$this->load->library('convert');
	$convert = new convert();
  // Change the css classes to suit your needs
if( isset($datamahasiswa) ) {
//    $datamahasiswa = (array)$datamahasiswa;
}
$id = isset($datakrs['id']) ? $datakrs['id'] : '';
?>
 <div style="margin-left:10px;margin-top:30px;"> 
    <table border="0" style="font-size:10px;font-weight:bold;" width="100%">
    	<tr> <td width="270px" align="center"> UNIVERSITAS MUHAMMADIYAH JAKARTA </td></tr>
        <tr><td align="center"> FAKULTAS EKONOMI DAN BISNIS</td></tr>
        <tr><td align="center"> Jl. K. H. Ahmad Dahlan Cirendeu Ciputat Jakarta Selatan	 </td></tr>
        <tr><td align="center"> <br>
        DAFTAR HADIR MAHASISWA</td></tr>		
    </table>
    <br> 
    <table border="0" width="100%">
    	<tr>
            <td align="left" width="100px" > Program Studi</td>
            <td align="left" width="10px">:</td>
            <td align="left" width="250px"><?php echo isset($nama_jurusan)?$nama_jurusan:"" ?></td>
            <td>&nbsp;</td>
            <td  width="100px">Kelas</td>
            <td align="left" width="10px">:</td>
            <td><?php echo isset($kelas)?$kelas:"" ?></td>
        </tr>
        <tr>
            <td align="left"> Mata Kuliah  </td>
            <td align="left">:</td>
            <td><?php echo isset($nama_mk)?$nama_mk:"" ?></td>
            <td>&nbsp;</td>
            <td width="100px">Jumlah Peserta</td>
            <td align="left" width="10px">:</td>
            <td>
             <?php if (isset($records) && is_array($records) && count($records)) : 
             	$no = 1;
				  echo count($records);
				  else :
					  echo "0";
			   endif;
			   ?>
             </td>
        </tr>
        
       <tr>
        	 
            <td align="left">Dosen</td>
            <td align="left">:</td>
            <td><?php echo isset($dosen)?$dosen:"" ?></td>
            <td>&nbsp;</td>
            <td width="100px">Waktu</td>
            <td align="left" width="10px">:</td>
            <td><?php echo isset($waktu)?$waktu:"" ?></td>
        </tr>
		<tr>
        	 
            <td align="left">Semester </td>
            <td align="left">:</td>
            <td ><?php echo $sms%2==1 ? "Ganjil":"Genap";?> <?php echo $this->settings_lib->item('site.tahunajaran'); ?></td>
        </tr>
		
    </table>
	   <br>
    <table border="1" width="100%">
	<tr>
		 <th style="padding:5px;" width="40px">No</th>
		 <th style="padding:5px;" width="100px">NIM</th>
		 <th style="padding:5px;" width="200px">Nama</th>
		 <?php for($i=0;$i<$jml;$i++){ ?>
		 	<td style="padding:5px;" width="100px" >Ke: <br>Tgl:</td>
		 <?php } ?>
		  
    </tr>
    
    	 <?php 
    	 		$semester = 0;
    	 		$hal = 1;
				if (isset($records) && is_array($records) && count($records)) : 
					 
					$no = 1;
					
					 foreach ($records as $record) :
					
				?> 
				<?php 
				if($hal > 25) { 
				?>
				</table>
				  <table border="1" width="100%" class="break">
					 <tr>
						  <th style="padding:5px;" width="40px">No</th>
						  <th style="padding:5px;" width="100px">NIM</th>
						  <th style="padding:5px;" width="200px">Nama</th>
						  <?php for($i=0;$i<$jml;$i++){ ?>
							 <td style="padding:5px;" width="100px" >Ke: <br>Tgl:</td>
						  <?php } ?>
		  
					 </tr>
					
				 <?php 
				 $hal = 1;
				 } ?>
				 
				  <tr>
					<td valign="middle" align="center" style="padding:5px;"> <?php echo $no; ?>. </td>
					<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->mahasiswa) ? $record->mahasiswa : ''; ?></td>
			 		<td valign="middle" align="left" style="padding:5px;"> <?php echo isset( $record->nama_mahasiswa) ? $record->nama_mahasiswa : ''; ?></td>
					<?php for($i=0;$i<$jml;$i++){ ?>
						<td valign="middle" style="padding:5px;"> </td>
					 <?php } ?>
				  </tr>
				  
				
        		<?php 
        		$hal++;
        		$no++;
					endforeach; 
				endif;
				?>
		<?php //if (isset($records) && is_array($records) && count($records)) : 
				?>
				 <tr>
					 
			 		<td valign="middle" align="left" colspan="3" style="padding:5px;">Paraf Dosen</td>
					<?php for($i=0;$i<$jml;$i++){ ?>
						<td valign="middle" style="padding:5px;"> </td>
					 <?php } ?>
				  </tr>
				<?php
				   
		 // endif;
		  ?>	 
	</table>
	<br><br><br>
	 <table border="0" width="100%">
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="left" colspan="4">Catatan</td>
            <td align="left" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Jakarta, .........,...........,............</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="left" colspan="4">Mohon Dosen Membubuhkan paraf Setiap kali perkuliahan selesai</td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">Tanda tangan Dosen</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
       <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br></td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"><br><br><br></td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4"></td>
            <td align="center" colspan="2">&nbsp;</td>
            <td align="center" colspan="4">( ................................... )</td>
			<td align="center" colspan="2">&nbsp;</td>
        </tr>
        
    </table>
	   <br>
   <center>
	   <a class="btn btn-large btnprint" target="_blank" href="<?php echo base_url().'admin/krs/cetakdata/printdaftarhadir/print?tahun='.$tahun.'&filfakultas='.$fakultas.'&filljurusan='.$jurusan.'&kode_mk='.$kode_mk.'&kelas='.$kelas.'&jml='.$jml.'&Act=Cari+&mod=print'; ?>">
		Cetak Data
		</a>
	</center>
</div> 
