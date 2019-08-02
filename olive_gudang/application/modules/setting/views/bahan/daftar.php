<?php 

$this->db_olive->select('master_bahan_baku.kode_bahan_baku');
$this->db_olive->select('master_bahan_baku.nama_bahan_baku');
$this->db_olive->select('master_satuan.alias');
$this->db_olive->select('master_rak.nama_rak');
$this->db_olive->select('master_bahan_baku.status');
$this->db_olive->select('master_bahan_baku.id');

$this->db_olive->from('master_bahan_baku');
$this->db_olive->join('master_satuan', 'master_bahan_baku.kode_satuan_stok = master_satuan.kode', 'left');
$this->db_olive->join('master_rak', 'master_bahan_baku.kode_rak = master_rak.kode_rak', 'left');
$this->db_olive->order_by('id','DESC');
$get_gudang=$this->db_olive->get()->result();

?>
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Bahan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Bahan </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Bahan </span>
					<a href="<?php echo base_url('setting/bahan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/bahan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<div id="cari_transaksi">
							<div id="cari_transaksi">
								<div class="box-body">            
									<div class="sukses" ></div>
									<table  class="table table-striped table-hover table-bordered" id="datatable">
										<thead>
											<tr width="100%">
												<th>No</th>
												<th>Kode Bahan</th>
												<th>Nama Bahan</th>
												<th>Satuan</th>
												<th>Nama Rak</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id="body_bahan">
											<?php
											$no = 0;
											foreach ($get_gudang as $value) { ?>
												<?php 
												$no++; ?>
												<tr>
													<td><?= $no ?></td>
													<td><?= $value->kode_bahan_baku ?></td>
													<td><?= $value->nama_bahan_baku ?></td>
													<td><?= $value->alias ?></td>
													<td><?= $value->nama_rak ?></td>
													<td>
														<?php if($value->status == 1){
															echo ('Aktif');
														}else {
															echo ('Tidak Aktif');
														}
														?>

													</td>
													<td>
														<div class="btn-group">
															<a href="<?php echo base_url('setting/bahan/detail/'.$value->id)?>" id="edit" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle btn-success"><i class="fa fa-eye"></i></a>
															<a href="<?php echo base_url('setting/bahan/edit/'.$value->id)?>" id="edit" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle btn-warning"><i class="fa fa-pencil"></i></a>
															<a id="hapus" onclick="actDelete('<?= $value->id ?>')" data-toggle="tooltip" title="Delete" class="btn btn-icon-only btn-circle btn-danger"><i class="fa fa-remove"></i></a>
														</div>
													</td>
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
					<input type="hidden" id="id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->



	<script type="text/javascript">
		function actDelete(key) {
			$('#modal-hapus').modal('show');
			$('#id').val(key);
		}
		function hapus_data() {
			var id=$('#id').val();
			$.ajax({
				url: '<?php echo base_url('setting/bahan/hapus'); ?>',
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