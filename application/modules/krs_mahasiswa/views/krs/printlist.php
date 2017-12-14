<style>
.one {border-bottom :1px dashed black;}
p.two {border-style: dotted solid dashed;}
p.three {border-style: dotted solid;}
p.four {border-style: dotted;}
.tableborder {
border :1px solid black;

}
.bottomsolid {
	border-bottom :1px solid black;
}
 H1 {
		font-size : 15pt;
		font-style: bold;
    }
    H2{
		font-size : 14pt;
		font-style: bold;
    }
@media print {
    body {
		font-weight:normal;
      	font-style:normal;
      	font-variant:normal;
	
		font-size : 9pt;
    }
     H1 {
		font-size : 15pt;
		font-style: bold;
    }
    H2{
		font-size : 14pt;
		font-style: bold;
    }
	.one {border-bottom :1px dashed black;}
	@font-face {
		font-family: "Times New Roman", Times, serif;
		font-size : 9pt;
		font-weight: normal;
		font-style: normal;

	}
	.tableborder {
		border :1px solid black;
		font-size : 8pt;
	}
	.bottomsolid {
		border-bottom :1px solid black;
	}
   table {
	 border-collapse: collapse;
	 font-size : 9pt;
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
<?php

$num_columns	= 10;
$can_delete	= $this->auth->has_permission('DataKrs.Krs.Delete');
$can_edit		= $this->auth->has_permission('DataKrs.Krs.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

?>
<br>
<div style="margin-left:10px;margin-top:10px;"> 
	   
    <h5>List KRS Mahasiswa</h5>
 
	<?php echo form_open($this->uri->uri_string()); ?>

<table border="1" style="font-size:11px;font-weight:bold;" width="100%">
			<thead>
				<tr>
					<th width="10px">No.</th>
					<th>NIM</th>
					<th>Mahasiswa</th>
					<th>Semester</th>
					<th>Jumlah SKS</th>
					 
				</tr>
			</thead>
			 
			<tfoot> 
				<tr>
					<td colspan="<?php echo $num_columns; ?>">&nbsp;</td>
				</tr>
			</tfoot>
			 
			<tbody>
				<?php
				if ($has_records) :
					$no = 1;
					foreach ($records as $record) :
				?>
				<tr>
					<td><?php echo $no; ?>.</td>
					<td><?php echo $record->mahasiswa; ?></td>
					<td><?php echo $record->nama_mahasiswa; ?></td>
					<td><?php echo $record->semester; ?></td>	  
					<td><?php e($record->jml_sks) ?></td> 
					  
				</tr>
				<?php
					$no++;
					endforeach;
				else:
				?>
				<tr>
					<td colspan="<?php echo $num_columns; ?>">Tidak ada Data yang sesuai dengan pilihan anda</td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	 
</div> 