$('#datakrs_created_date').datepicker({ dateFormat: 'yy-mm-dd'});
function setJadwal(kelas,kode,kdmk,kdjadwal) {
 
    $('#kelas_'+kdmk).text(kelas);
    $("#txtkelas_"+kdmk).val(kelas);
    $("#chkmk_"+kdmk).attr("checked",true);
  	$("#txtkdjadwal_"+kdmk).val(kdjadwal);
	hitungjmlmk();
   	hitungsks("chkmk_"+kdmk);
}
function hitungsks(thisid){
	var checkedValue = null; 
    var jmlsks = 0;
	var inputElements = document.getElementsByClassName('chkmk');
	for(var i=0; inputElements[i]; ++i){
		  if(inputElements[i].checked){
			   checkedValue = inputElements[i].value;
			   jmlsks = jmlsks + parseInt($("#mksks_"+checkedValue).val());
		  }
	}
	
	if(jmlsks > mak_sks){
		var mk = $("#"+thisid).val();
		$("#"+thisid).attr("checked", false);
		alert("Batas Pengambilan sks anda "+ mak_sks);
		hitungjmlmk();
		jmlsks = jmlsks - parseInt($("#mksks_"+mk).val());
		
	}
	 
	$('.sksdipilih').text(jmlsks);
	 
}
function hitungjmlmk(){
	  $('.mkdipilih').text($(":checkbox:checked").length);
}
