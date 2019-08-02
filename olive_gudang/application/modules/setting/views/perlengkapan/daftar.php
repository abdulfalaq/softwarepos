<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('master_perlengkapan')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Perlengkapan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perlengkapan </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Perlengkapan </span>
					<a href="<?php echo base_url('setting/perlengkapan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perlengkapan</a>
					<a href="<?php echo base_url('setting/perlengkapan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Perlengkapan</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<div id="cari_transaksi">
							<div id="cari_transaksi">
								<table id="datatable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="50px;">No</th>
											<th>Kode Perlengkapan</th>
											<th>Nama Perlengkapan</th>
											<th>Kode Rak</th>
											<th>Stok Minimal</th>
											<th>Status</th>
											<th width="133px;">Action</th>
										</tr>
									</thead>
									<tbody>    
										<?php 
										$no = 0;
										foreach ($get_gudang as $value) { 
											$no++; ?>
											<tr>
												<th><?= $no ?></th>
												<th><?= $value->kode_perlengkapan ?></th>
												<th><?= $value->nama_perlengkapan ?></th>
												<th><?= $value->kode_rak ?></th>
												<th><?= $value->stok_minimal ?></th>
												<th><?php if($value->status == 1){
													echo ('Aktif');
												}else {
													echo ('Tidak Aktif');
												}
												?></th>
												<th align="center">
													<div class="btn-group">
														<a href="<?php echo base_url('setting/perlengkapan/detail/'.$value->kode_perlengkapan); ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i></a>
														<a href="<?php echo base_url('setting/perlengkapan/edit/'.$value->kode_perlengkapan ); ?>" key="4" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i></a>
														<a onclick="actDelete('<?php echo $value->kode_perlengkapan ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-remove"></i></a>
													</div>
												</th>
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
			</div> <!-- //row -->
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
						<input type="hidden" id="kode_perlengkapan">
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
				$('#kode_perlengkapan').val(key);
			}
			function hapus_data() {
				var kode_perlengkapan=$('#kode_perlengkapan').val();
				$.ajax({
					url: '<?php echo base_url('setting/perlengkapan/hapus_gudang'); ?>',
					type: 'post',
					data:{kode_perlengkapan:kode_perlengkapan},
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