<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('master_produk')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Produk </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Produk</span>
					<a href="<?php echo base_url('setting/produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/produk'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<div id="cari_transaksi">
							<div id="cari_transaksi">
								<table id="datatable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="50px;">No</th>
											<th>Kode Bahan</th>
											<th>Nama Bahan</th>
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
												<th><?= $value->kode_produk ?></th>
												<th><?= $value->nama_produk ?></th>
												<th><?= $value->stok_minimal ?></th>
												<th><?php if($value->status == 1){
													echo ('Aktif');
												}else {
													echo ('Tidak Aktif');
												}
												?></th>
												<th align="center">
													<div class="btn-group">
														<a href="<?php echo base_url('setting/produk/detail/'.$value->kode_produk); ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i></a>
														<a href="<?php echo base_url('setting/produk/edit/'.$value->kode_produk ); ?>" key="4" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i></a>
														<a onclick="actDelete('<?php echo $value->kode_produk ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-remove"></i></a>
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
					<input type="hidden" id="kode_produk">
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
			$('#kode_produk').val(key);
		}
		function hapus_data() {
			var kode_produk=$('#kode_produk').val();
			$.ajax({
				url: '<?php echo base_url('setting/produk/hapus_gudang'); ?>',
				type: 'post',
				data:{kode_produk:kode_produk},
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