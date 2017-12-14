	<footer class="container-fluid footer">
		<p class="pull-right">
			Executed in {elapsed_time} seconds, using {memory_usage}.			
		</p>
	</footer>
	
	<div id="debug"><!-- Stores the Profiler Results --></div>
 	<script src="<?php echo js_path();?>jquery-1.7.2.min.js"></script> 
	<script language='JavaScript' type='text/javascript' src='<?php echo js_path();?>pixel/bootstrap.min.js'></script>
    <script language='JavaScript' type='text/javascript' src='<?php echo js_path();?>pixel/pixel-admin.min.js'></script> 
    <script type="text/javascript">
		showmenu.push(function () {
			// Javascript code here
		})
		window.PixelAdmin.start(showmenu);  
	</script>
	<?php echo Assets::js(); ?>
<div id="loading-all" class="modal fade bs-modal-lg">Loadin...</div>
 <!-- Modal -->
            <!-- Modal -->
    <div data-backdrop="static" data-keyboard="false" class="modal fade bs-modal-lg" id="modal-global" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Detail</h4>
				</div>
				<div class="modal-body" id="modal-body">
				Loading content...
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
		    </div>
		</div>
	    </div>
    </div>
          </div>
        </div>
<script type="text/javascript">
$('body').on('click', '.show-modal', function(event){
	$('.perhatian').fadeOut(300, function(){});
	  event.preventDefault();
	  var currentBtn = $(this);
	  var title = currentBtn.attr("tooltip");
	  //alert(currentBtn.attr("href"));
	  $.ajax({
	  url: currentBtn.attr("href"),
	  type: 'post',
	  beforeSend: function (xhr) {
		  //$("#loading-all").show();
	  },
	  success: function (content, status, xhr) {
		  var json = null;
		  var is_json = true;
		  try {
		  	json = $.parseJSON(content);
		  } catch (err) {
		  	is_json = false;
		  }
		  if (is_json == false) {
		  	$("#modal-body").html(content);
		  	$("#myModalLabel").html(title);
		  	$("#modal-global").modal('show');
		  	$("#loading-all").hide();
		  } else {
		  	alert("Error");
		  }
	  }
	  }).fail(function (data, status) {
	  if (status == "error") {
		  alert("Error");
	  } else if (status == "timeout") {
		  alert("Error");
	  } else if (status == "parsererror") {
		  alert("Error");
	  }
	  });
});
</script>

</body>
</html>
