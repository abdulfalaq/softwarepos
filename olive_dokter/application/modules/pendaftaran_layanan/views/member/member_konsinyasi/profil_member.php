
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Profil Member</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Profil Member</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span  style="font-size: 24px">Data Member</span>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-striped" id="datatable">
									<thead>
										<tr>
											<th>NO</th>
											<th>Kode Member</th>
											<th>Nama Member</th>
											<th>Alamat</th>
											<th>Telepon</th>
											<th>Keterangan</th>
											<th>Status</th>
											<th>Kategori Member</th>
											<th>Action</th>
										</tr>
									</thead>
									<?php 
									$this->db_master->where('kategori_member','Member Konsinyasi');
									$this->db_master->order_by('id','DESC');
									$get_member = $this->db_master->get('master_member')->result();
									?>
									<tbody>
										<?php 
										$no = 0;
										foreach ($get_member as $value) { $no++; ?>
										<tr>
											<th><?php echo $no ?></th>
											<th><?php echo $value->kode_member ?></th>
											<th><?php echo $value->nama_pic ?> - <?php echo $value->nama_perusahaan ?></th>
											<th><?php echo $value->alamat_perusahaan ?></th>
											<th><?php echo $value->telp_pic ?></th>
											<th><?php echo $value->keterangan ?></th>
											<th><?php echo cek_status($value->keterangan) ?></th>
											<th><?php echo $value->kategori_member ?></th>
											<td>
												<a href="<?= base_url('penjualan/member_konsinyasi/get_detail_akun/'.$value->kode_member) ?>" class="btn btn-info btn-no-radius"><i class="fa fa-search"></i> Detail Akun</a>
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
function hapus(key) {
	$('#modal-hapus').modal('show');
}
</script>