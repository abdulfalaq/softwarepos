<?php 
$this->db_olive_master->order_by('id','DESC');
$get_kategori = $this->db_olive_master->get('master_rak')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Rak</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1> Rak </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Rak </span>
					<a href="<?php echo base_url('setting/rak/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/rak/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<div id="cari_transaksi">
							<br>
							<table  class="table table-striped table-hover table-bordered" id="datatable">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Rak</th>
										<th>Nama Rak</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="body_bahan">
									<?php 
									$no = 0;
									foreach ($get_kategori as $value) { 
										$no++; ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $value->kode_rak ?></td>
											<td><?= $value->nama_rak ?></td>
											<td><?php if($value->status == 1){
												echo ('Aktif');
											}else {
												echo ('Tidak Aktif');
											}
											?>
											<td align="center">
												<div class="btn-group">
													<a href="<?php echo base_url('setting/rak/detail/'.$value->id) ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i></a>
													<a href="<?php echo base_url('setting/rak/edit/'.$value->id) ?>" key="8" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i></a>
													<a onclick="actDelete('<?= $value->id ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-remove"></i></a>
												</div>
											</td>
										</tr>
										<?php } ?>
										
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
					<input type="hidden" id="id">
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
			$('#id').val(key);
		}
		function hapus_data() {
			var id=$('#id').val();
			$.ajax({
				url: '<?php echo base_url('setting/rak/hapus'); ?>',
				type: 'post',
				data:{id:id},
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