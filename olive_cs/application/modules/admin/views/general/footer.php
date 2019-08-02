
</div>
<!-- //MAIN CONTENT -->

<footer>
	Cloud astro &copy; 2017
</footer>
</body>
<div id="modal-comming-soon" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Comming Soon </h4>
			</div>
			
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Ok</button>

			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'component/lib/jquery.min.js'?>"></script>
<script src="<?php echo base_url().'component/lib/zebra_datepicker.js'?>"></script>
<link rel="stylesheet" href="<?php echo base_url().'component/lib/css/default.css'?>"/>
<script src="<?php echo base_url(); ?>assets/js/jquery.matchHeight-min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/swal/sweetalert.min.js"></script>

<!--DATATABLE-->
<script src="<?php echo base_url(); ?>assets/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Responsive-2.2.0/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Responsive-2.2.0/js/responsive.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/select2/js/select2.min.js"></script>
<!--//DATATABLE-->


<script>
	$(document).ready(function() {
		$('#datatable').dataTable();
		$('#datatable-keytable').DataTable( { keys: true } );
		$('#datatable-responsive').DataTable();
		$('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
		var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
		$('.select2').select2();
	});
	TableManageButtons.init();

	
	$('.button-comming-soon').click(function () {
		$('#modal-comming-soon').modal('show');
	})
	function comming_soon(){
		$('#modal-comming-soon').modal('show');
	}
</script>


</html>
