
<?php 
$kode_opname=$this->uri->segment(4);
$this->db->where('kode_opname',$kode_opname);
$get_gudang = $this->db->get('opsi_transaksi_opname')->result();
?>
<a href="<?php echo base_url('adjust_stok/adjust/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('adjust_stok'); ?>">Adjust Stok</a></li>
		<li><a href="<?php echo base_url('adjust_stok/adjust/daftar'); ?>">Adjust</a></li>
		<li><a href="#">Detail Adjust</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Adjust Stok</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Input Adjust</span>
				</div>
				<div class="panel-body">
					<div class="col-md-8 " id="">
						<div class="col-md-8 " id="">
							<div class="input-group">
								<span class="input-group-addon">Transaksi Tanggal</span>
								<input type="text" name="tanggal" class="form-control" value="17 Januari 2018" readonly/>
							</div>
						</div>
					</div>
					<br>
					<br>
					<br>
					<div id="cari_op"> 
						<table class="table table-striped table-hover table-bordered" id="tabel_daftarr">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Opname</th>
									<th>Jenis Bahan</th>
									<th>Stok Awal</th>
									<th>Stok Akhir</th>
									<th>Status</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody id="scroll_data">
								<?php 
								$no = 0;
								foreach ($get_gudang as $value) { 
									$no++; ?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $value->kode_opname ?></td>
										<td><?= $value->jenis_bahan ?></td>
										<td><?= $value->stok_awal ?></td>
										<td><?= $value->stok_akhir ?></td>
										<td><?= $value->status ?></td>
										<td><?= $value->keterangan ?></td>
									</tr>										
								</tr>
								<?php 
							} 
							?>
						</tbody>
					</table>
				</div>
				<br><br>
				<br><br><br><br><br><br>
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
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>