
<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('master_gudang')->result();
?>

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Gudang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Gudang</span>
					<a href="<?php echo base_url('master/gudang/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Gudang</a>
					<a href="<?php echo base_url('master/gudang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Gudang</a>
				</div>
				<div class="panel-body">
					<div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="50px">No</th>
									<th>Kode Gudang</th>
									<th>Nama Gudang</th>
									<th>Status</th>
									<th width="190px">Action</th>
								</tr>
							</thead>
							<tbody>    
								<?php 
								$no = 0;
								foreach ($get_gudang as $value) { 
									$no++; ?>
									<tr>
										<th><?= $no ?></th>
										<th><?= $value->kode_gudang ?></th>
										<th><?= $value->nama_gudang ?></th>
										<th><?php if($value->status == 1){
											echo ('Aktif');
										}else {
											echo ('Tidak Aktif');
										}
										?></th>
										<td><?php echo get_detail_edit_delete($value->kode_gudang);?></td>
									</tr>
									<?php }
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</div>  
	<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Alert</h4>
				</div>
				<div class="modal-body text-center">
					<h2>Anda yakin akan menghapus data ini?</h2>
					<input type="hidden" id="kode_gudang">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function actDelete(key) {
			$('#modal-hapus').modal('show');
			$('#kode_gudang').val(key);
		}
		function hapus_data() {
			var kode_gudang=$('#kode_gudang').val();
			$.ajax({
				url: '<?php echo base_url('master/gudang/hapus_gudang'); ?>',
				type: 'post',
				data:{kode_gudang:kode_gudang},
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){
					$(".tunggu").hide();
					$('#modal-hapus').modal('hide');
					window.location.reload();
				}
			});
		}
	</script>

	<script src="http://192.168.100.17/amway/component/bootstrap/js/bootstrap.min.js"></script>
	<script src="http://192.168.100.17/amway/component/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="http://192.168.100.17/amway/component/plugins/fastclick/fastclick.min.js"></script>
	<script src="http://192.168.100.17/amway/component/dist/js/app.min.js"></script>
	<script src="http://192.168.100.17/amway/component/dist/js/demo.js"></script>
	<script src="http://192.168.100.17/amway/component/plugins/jquery.matchHeight-min.js"></script>
	<!-- DataTables -->
	<script src="http://192.168.100.17/amway/component/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="http://192.168.100.17/amway/component/plugins/datatables/dataTables.bootstrap.min.js"></script>


	<script src="http://192.168.100.17/amway/component/plugins/select2/select2.full.min.js"></script>


	<script>
		$(function () {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});
		});

		$('.select2').select2();
	</script>

