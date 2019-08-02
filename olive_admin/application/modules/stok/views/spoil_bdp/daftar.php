
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Spoil</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Spoil Barang Dalam Proses</h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Spoil </span>
					<a href="<?php echo base_url('stok/spoil_bdp/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Spoil</a>
					<a href="<?php echo base_url('stok/spoil_bdp/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Spoil</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal Spoil</th>
									<th>Kode Spoil</th>
									<th>Petugas</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>    
								<?php 
								$this->db->where('kan_suol.transaksi_spoil.jenis_bahan','BDP');
								$this->db->from('kan_suol.transaksi_spoil');
								$this->db->join('kan_master.master_user', 'kan_suol.transaksi_spoil.kode_petugas = kan_master.master_user.kode_user','left');
								$hasil_spoil = $this->db->get()->result();

								$no = 0;
								foreach ($hasil_spoil as $spoil) { 
									$no++; ?>
									<tr>
										<th><?php echo $no ?></th>
										<th><?php echo @TanggalIndo($spoil->tanggal_spoil); ?></th>
										<th><?php echo @$spoil->kode_spoil ?></th>
										<th><?php echo @$spoil->nama_user ?></th>
										<td>
											<a href="<?php echo base_url('stok/spoil_bdp/detail/'.@$spoil->kode_spoil);?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
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