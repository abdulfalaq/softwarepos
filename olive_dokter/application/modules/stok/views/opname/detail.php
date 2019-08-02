
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
					<span class="pull-left" style="font-size: 24px">Detail Opname </span>
					<br><br>
				</div>
				<?php
				$kode_opname=$this->uri->segment(4);
				$this->db->where('kode_opname', @$kode_opname);
				$get_opname=$this->db->get('transaksi_opname');
				$hasil_opname=$get_opname->row();

				$get_unit=$this->db->get('setting');
				$hasil_unit=$get_unit->row();
				?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
								<label>Kode Opname</label>
								<input type="text" name="kode_opname" id="kode_opname" class="form-control" readonly="" value="<?php echo @$hasil_opname->kode_opname;?>">
							</div>
							<div class="col-md-4">
								<label>Tanggal</label>
								<input type="date" name="tanggal" id="tanggal" class="form-control" readonly="" value="<?php echo @$hasil_opname->tanggal_opname;?>">
							</div>
							<input type="hidden" name="kode_unit" id="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
						</div>
					</div>
					<hr>
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 70px;">No</th>
									<th>Nama Produk</th>
									<th>QTY Stok</th>
									<th>QTY Fisik</th>
									<th>Selisih</th>
									<th>Status</th>
									
								</tr>
							</thead>
							<tbody id="data_opsi_temp">
								<?php
								$jenis_bahan=@$hasil_opname->jenis_bahan;
								$this->db->where('kan_suol.opsi_transaksi_opname.kode_opname', @$kode_opname);
								$this->db->from('kan_suol.opsi_transaksi_opname');
								if($jenis_bahan=='BB'){

									$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_bahan_baku.kode_bahan_baku','left');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_stok=kan_master.master_satuan.kode','left');
								}elseif($jenis_bahan=='BDP'){
									$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_barang_dalam_proses.kode_barang');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_barang_dalam_proses.kode_satuan_stok=kan_master.master_satuan.kode');
								}elseif ($jenis_bahan=='Produk') {
									$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_produk.kode_produk');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok=kan_master.master_satuan.kode');
								}
								$get_temp=$this->db->get();
								$hasil_temp=$get_temp->result();
								$no=1;
								foreach ($hasil_temp as $temp) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td>
											<?php 
											if($jenis_bahan=='BB'){
												echo @$temp->nama_bahan_baku;
											}elseif($jenis_bahan=='BDP'){
												echo @$temp->nama_barang;
											}elseif ($jenis_bahan=='Produk') {
												echo @$temp->nama_produk;
											}
											?>

										</td>
										<td><?php echo @$temp->stok_awal.' '.@$temp->nama;?></td>
										<td><?php echo @$temp->stok_akhir.' '.@$temp->nama;?></td>
										<td><?php echo @$temp->selisih.' '.@$temp->nama;?></td>
										<td><?php if(@$temp->stok_awal < @$temp->stok_akhir){ echo "Lebih";}else{echo "Kurang";}?></td>
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