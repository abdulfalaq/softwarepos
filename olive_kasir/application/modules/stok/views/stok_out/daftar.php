
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Stok Out</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Stok Out</h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Stok Out</span>
					<a href="<?php echo base_url('stok/stok_out/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Stok Out</a>
					<a href="<?php echo base_url('stok/stok_out/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Stok Out</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal Stok Out</th>
									<th>Kode Stok Out</th>
									<th>Petugas</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>    
								<?php 
								$get_unit=$this->db->get('setting');
								$hasil_unit=$get_unit->row();

								$this->db->where('kan_suol.transaksi_stok_out.kode_unit_jabung',$hasil_unit->kode_unit);
								$this->db->from('kan_suol.transaksi_stok_out');
								$this->db->join('kan_master.master_user', 'kan_suol.transaksi_stok_out.kode_petugas = kan_master.master_user.kode_user','left');
								$hasil_stok_out = $this->db->get()->result();

								$no = 0;
								foreach ($hasil_stok_out as $stok_out) { $no++; ?>
								<tr>
									<th><?php echo $no ?></th>
									<th><?php echo @TanggalIndo($stok_out->tanggal_input); ?></th>
									<th><?php echo @$stok_out->kode_stok_out ?></th>
									<th><?php echo @$stok_out->nama_user ?></th>
									<td>
										<a href="<?php echo base_url('stok/stok_out/detail/'.@$stok_out->kode_stok_out);?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
									</td>
								</tr>
								<?php } ?>
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