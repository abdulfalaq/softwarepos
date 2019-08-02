
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Opname</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Opname </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Jadwal Opname </span>
					<br><br>
				</div>
				<?php
				$kode_opname=$this->uri->segment(4);
				$this->db->where('kode_opname', @$kode_opname);
				$get_opname=$this->db->get('transaksi_opname');
				$hasil_opname=$get_opname->row();
				?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<label>Tanggal</label>
								<input type="date" name="tanggal" id="tanggal" value="<?php echo @$hasil_opname->tanggal_opname;?>" readonly="" class="form-control">
							</div>
							
						</div>
					</div>
					<hr>
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 70px;">No</th>
									<th>Kode Bahan</th>
									<th>Nama Bahan</th>
								</tr>
							</thead>

							<tbody id="data_opsi_temp">
								<?php
								$jenis_bahan=@$hasil_opname->jenis_bahan;
								$this->db->where('kan_suol.opsi_transaksi_opname.kode_opname', @$kode_opname);
								$this->db->from('kan_suol.opsi_transaksi_opname');
								if($jenis_bahan=='BB'){
									$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_bahan_baku.kode_bahan_baku', 'left');
								}elseif ($jenis_bahan=='BDP') {
									$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_barang_dalam_proses.kode_barang', 'left');
								}elseif ($jenis_bahan=='Produk') {
									$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_produk.kode_produk', 'left');
								}
								$get_temp=$this->db->get();
								$hasil_temp=$get_temp->result();
								$no=1;
								foreach ($hasil_temp as $temp) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<?php
										if($jenis_bahan=='BB'){
											?>
											<td><?php echo @$temp->kode_bahan;?></td>
											<td><?php echo @$temp->nama_bahan_baku;?></td>
											<?php
										}elseif ($jenis_bahan=='BDP') {
											?>
											<td><?php echo @$temp->kode_bahan;?></td>
											<td><?php echo @$temp->nama_barang;?></td>
											<?php
										}elseif ($jenis_bahan=='Produk') {
											?>
											<td><?php echo @$temp->kode_bahan;?></td>
											<td><?php echo @$temp->nama_produk;?></td>
											<?php
										}
										?>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
					
				</div>
			</div>
		</div>
	</div>

	<!-- //row -->
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