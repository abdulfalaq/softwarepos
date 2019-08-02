
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('produksi'); ?>">Produksi</a></li>
		<li><a href="#">Validasi Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Validasi Produksi </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Validasi Produksi </span>

					<a href="<?php echo base_url('produksi/validasi_produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Validasi Produksi</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 70px;">No</th>
									<th>Tanggal Produksi</th>
									<th>Kode Produksi</th>
									<th style="width: 150px;">Action</th>
								</tr>
							</thead>
							<tbody id="data_opsi_perintah">
								<?php
								$get_setting = $this->db->get('setting');
								$hasil_setting = $get_setting->row();

								$this->db->order_by('id','DESC');
								$this->db->where('kode_unit_jabung', $hasil_setting->kode_unit);
								$this->db->where('status', 'proses');
								$get_produksi=$this->db->get('transaksi_produksi');
								$hasil_produksi=$get_produksi->result();
								$no=1;
								foreach ($hasil_produksi as $produksi) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo tanggalIndo(@$produksi->tanggal_produksi);?></td>
										<td><?php echo @$produksi->kode_produksi;?></td>
										<td><a href="<?php echo base_url('produksi/validasi_produksi/validasi')."/".$produksi->kode_produksi; ?>" class="btn btn-info"><i class="fa fa-check"></i> Validasi</a></td>
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