<script src="<?php echo base_url(); ?>themes/admin/js/sweetalert.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>themes/admin/css/sweetalert.css">
<?php
	$this->load->library('convert');
	$convert = new convert();
	$kuesioner = $this->settings_lib->item('kuesioner');
	
?>
<div class="row">
	
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Status</span>
              	<h5>	NIM : <?php echo $nim; ?> </h5>
              	<h5>	Semester : <?php echo $sms; ?>  </h5>					 
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pembimbing Akademik</span>
              <span class="info-box-number"><small><?php echo isset($nama_dosen_promotor) ? $nama_dosen_promotor : ""; ?></small></span>
              
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-4 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SKS Ditempuh</span>
               <span class="info-box-number"><?php e($jmlsks); ?><small> SKS</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Nilai</span>
              <span class="info-box-number"><small>IPS : <?php echo $ipsemesterini;?> </small></span>
              <span class="info-box-number"><small>IPK : <a href="<?php echo base_url().'admin/nilai/transkip/viewmhs'; ?>" class="show-modal">
												<?php echo (Double)$ips; ?>
											</a>
											</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
<div class="row">
	<div class="col-md-12">
   	<div class="box box-danger">
	   <div class="box-header with-border">
		 <h3 class="box-title">Mata Kuliah Semester ini</h3>

		 <div class="box-tools pull-right">
		   <select name="tahun" id="chkta" class="chosen-select-deselect" style="width:200px">
				<option value=""></option>
				<?php for($i=1;$sms >= $i; $i++):?>
					<option <?php if($i==$sms) echo "selected"; ?> value="<?php echo $i?>">Semester : <?php echo $i; ?></option>
				 <?php endfor;?>
			 
			</select>
		   <a href="<?php echo base_url().'admin/krs/datakrs/lihatmatakuliahyangdiambil/simple'; ?>" tooltip="Semua Matakuliah" class='fancy show-modal'>
		   <span class="label label-danger">Lihat Semua</span>
		   </a>
		   <a href="<?php echo base_url().'admin/krs/datakrs/input'; ?>">
		   <span class="label label-warning"><i class="fa fa-plus"></i> Isi KRS</span>
		   </a>
		   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
		   </button>
		   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
		   </button>
		 </div>
	   </div>
	   <!-- /.box-header -->
	   <div class="box-body">
		<div id="khscontent">
		</div>
	   </div>
	   <!-- /.box-body -->
	   <!-- /.box-footer -->
   </div>
   </div>
</div>
<script type="text/javascript">  
$(document).ready(function() {	 
	loadkhs(""); 
});
<?php
if($kuesioner == "1"){
?>
swal({
	   title: "<small>Perhatian</small>",
	   text: "Untuk melihat nilai, Mohon untuk mengisi kuesioner \"Evaluasi Pembelajaran Terhadap Dosen\", Pada kolom <span style=\"color:#F8BB86\">Kuesioner</span> di matakuliah yang anda ambil",
	   html: true
	 },function() {
            //location.href = "https://p2mm-lipi.typeform.com/to/P04ZI7";

        });
<?php } ?>


function loadkhs(sms){
 		$('#khscontent').attr('style', 'background-color: #ecf2f9 !important;height:100px');
		$('#khscontent').html("<center><br><br><br>Load data...</center>");
		var post_data = "sms="+sms;
		 
	$.ajax({
			url: "<?php echo base_url() ?>admin/krs/datakrs/viewkhs/"+sms,
			type:"POST",
			data: post_data,
			dataType: "html",
			timeout:180000,
			success: function (result) {
			
			$('#khscontent').html(result);
			$('#khscontent').attr('style', 'background-color: transparent !important;height:auto');
			 
		},
		error : function(error) {
			alert(error);
		} 
	});        
} 
	$( "#chkta" ).change(function() {
		 
		loadkhs($(this).val());
		return false;
	});  
 
</script> 
<link href="<?php echo base_url(); ?>assets/css/chosen/chosen.css" rel="stylesheet" type="text/css" />
<script language='JavaScript' type='text/javascript' src='<?php echo base_url(); ?>assets/js/chosen/chosen.jquery.js'></script>
<script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    
    $(".fancy").fancybox({
			'overlayShow'	: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic', 
			'onClosed'           : function(){},
			'autoSize' : false,
			'minheight':'500',
			'type':'iframe',
			'width':'400',
			'height':'600'
			 
		}); 
  </script>
