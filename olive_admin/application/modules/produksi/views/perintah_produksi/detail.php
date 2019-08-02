
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('produksi'); ?>">Produksi</a></li>
		<li><a href="#">Perintah Produksi</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perintah Produksi</h1>

	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Perintah Produksi </span>
					<a href="<?php echo base_url('produksi/perintah_produksi/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perintah Produksi</a>
					<a href="<?php echo base_url('produksi/perintah_produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Kebutuhan Bahan Baku</a>
				</div>
				<div class="panel-body">
					<?php
					$kode_produksi = $this->uri->segment(4);
					$this->db->where('kode_produksi', $kode_produksi);
					$get_produksi = $this->db->get('transaksi_produksi');
					$hasil_produksi = $get_produksi->row();
					?>
					<div class="row">
						<div class="col-md-2 text-right">
							<label>Kode Perintah Produksi</label>
						</div>
						<div class="col-md-6">
							<input type="text" readonly="" id="kode_produksi" value="<?php echo $hasil_produksi->kode_produksi;?>" class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-2 text-right">
							<label>Tanggal Perintah Produksi</label>
						</div>
						<div class="col-md-6">
							<input type="text" readonly="" id="tanggal_perintah_produksi" value="<?php echo tanggalIndo(@$hasil_produksi->tanggal_perintah_produksi);?>" class="form-control">
						</div>
					</div>
					<hr><br>
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 70px;">No</th>
									<th>Produk</th>
									<th>QTY</th>
									<th style="width: 150px;">Komposisi</th>
								</tr>
							</thead>

							<tbody id="data_temp">
								<?php
								$kode_produksi = $this->uri->segment(4);

								$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi', $kode_produksi);
								$this->db->from('kan_suol.opsi_transaksi_produksi');
								$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_barang_dalam_proses.kode_barang', 'left');
								$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_produksi.kode_bahan = kan_master.master_produk.kode_produk', 'left');
								$this->db->join('kan_master.master_satuan', 'kan_suol.opsi_transaksi_produksi.kode_satuan = kan_master.master_satuan.kode', 'left');
								$get_opsi = $this->db->get()->result();

								$no=1;
								foreach ($get_opsi as $opsi) {
									?>
									<tr>
										<td>
											<?php echo $no++;?>
										</td>
										<td id="nama_bahan">
											<?php 
											if($opsi->kategori_bahan == 'Produk'){
												echo $opsi->nama_produk;
											} else{
												echo $opsi->nama_barang;
											}
											?>
										</td>
										<td><?php echo @$opsi->jumlah.' '.$opsi->alias;?></td>
										<td>
											<?php 
											if (@$opsi->kategori_bahan == 'BDP') {
												$this->db->from('kan_suol.opsi_transaksi_produksi');
												$this->db->join('kan_master.opsi_master_barang_dalam_proses', ' kan_master.opsi_master_barang_dalam_proses.kode_barang = kan_suol.opsi_transaksi_produksi.kode_bahan');
												$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi',$kode_produksi);
												$get_opsi_komposisi = $this->db->get()->result();
												foreach ($get_opsi_komposisi as $value) {
													
													if ($value->jenis_bahan == 'BB') {
														$this->db->from('kan_suol.opsi_transaksi_produksi');
														$this->db->select('kan_master.opsi_master_barang_dalam_proses.qty');
														$this->db->select('kan_master.opsi_master_barang_dalam_proses.konversi');
														$this->db->select('kan_suol.opsi_transaksi_produksi.jumlah');
														$this->db->select('kan_master.master_bahan_baku.nama_bahan_baku');
														$this->db->select('kan_master.master_satuan.alias');
														$this->db->join('kan_master.opsi_master_barang_dalam_proses', ' kan_master.opsi_master_barang_dalam_proses.kode_barang = kan_suol.opsi_transaksi_produksi.kode_bahan');	
														$this->db->join('kan_master.master_bahan_baku', ' kan_master.master_bahan_baku.kode_bahan_baku = kan_master.opsi_master_barang_dalam_proses.kode_bahan','left');
														$this->db->join('kan_master.master_satuan', ' kan_master.master_satuan.kode = kan_master.master_bahan_baku.kode_satuan_stok','left');
														$this->db->where('kan_suol.opsi_transaksi_produksi.kode_bahan',$value->kode_barang);
														$this->db->where('kan_master.opsi_master_barang_dalam_proses.jenis_bahan','BB');
														$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi',$kode_produksi);
														$get_bahan = $this->db->get()->row();
														$jumlah = ($get_bahan->qty / $get_bahan->konversi) * $get_bahan->jumlah;

														echo $get_bahan->nama_bahan_baku.' '.$jumlah.' '.$get_bahan->alias.'<br>';
													}else{
														$this->db->from('kan_suol.opsi_transaksi_produksi');
														$this->db->join('kan_master.opsi_master_barang_dalam_proses', ' kan_master.opsi_master_barang_dalam_proses.kode_barang = kan_suol.opsi_transaksi_produksi.kode_bahan');	
														$this->db->join('kan_master.master_barang_dalam_proses', ' kan_master.master_barang_dalam_proses.kode_barang = kan_master.opsi_master_barang_dalam_proses.kode_bahan','left');
														$this->db->join('kan_master.master_satuan', ' kan_master.master_satuan.kode = kan_master.master_barang_dalam_proses.kode_satuan_stok','left');
														$this->db->where('kan_master.opsi_master_barang_dalam_proses.jenis_bahan','BDP');
														$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi',$kode_produksi);
														$get_bahan = $this->db->get()->row();
														$jumlah = ($get_bahan->qty / $get_bahan->konversi) * $get_bahan->jumlah;


														echo $get_bahan->nama_barang.' '.$jumlah.' '.$get_bahan->alias.'<br>';
													}
													

												}
											}else{
												
												$this->db->from('kan_suol.opsi_transaksi_produksi');
												$this->db->join('kan_master.opsi_master_produk', ' kan_master.opsi_master_produk.kode_produk = kan_suol.opsi_transaksi_produksi.kode_bahan');
												$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi',$kode_produksi);
												$get_opsi_komposisi = $this->db->get()->result();
												foreach ($get_opsi_komposisi as $value) {
													
													if ($value->jenis_bahan == 'BB') {
														$this->db->from('kan_suol.opsi_transaksi_produksi');
														$this->db->select('kan_master.opsi_master_produk.qty');
														$this->db->select('kan_suol.opsi_transaksi_produksi.jumlah');
														$this->db->select('kan_master.master_bahan_baku.nama_bahan_baku');
														$this->db->select('kan_master.master_satuan.alias');
														$this->db->join('kan_master.opsi_master_produk', ' kan_master.opsi_master_produk.kode_produk = kan_suol.opsi_transaksi_produksi.kode_bahan');	
														$this->db->join('kan_master.master_bahan_baku', ' kan_master.master_bahan_baku.kode_bahan_baku = kan_master.opsi_master_produk.kode_bahan','left');
														$this->db->join('kan_master.master_satuan', ' kan_master.master_satuan.kode = kan_master.master_bahan_baku.kode_satuan_stok','left');
														$this->db->where('kan_suol.opsi_transaksi_produksi.kode_bahan',$value->kode_produk);
														$this->db->where('kan_master.opsi_master_produk.jenis_bahan','BB');
														$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi',$kode_produksi);
														$get_bahan = $this->db->get()->row();
														$jumlah = $get_bahan->qty * $get_bahan->jumlah;

														echo $get_bahan->nama_bahan_baku.' '.$jumlah.' '.$get_bahan->alias.'<br>';
													}else{
														$this->db->from('kan_suol.opsi_transaksi_produksi');
														$this->db->join('kan_master.opsi_master_produk', ' kan_master.opsi_master_produk.kode_produk = kan_suol.opsi_transaksi_produksi.kode_bahan');	
														$this->db->join('kan_master.master_barang_dalam_proses', ' kan_master.master_barang_dalam_proses.kode_barang = kan_master.opsi_master_produk.kode_bahan','left');
														$this->db->join('kan_master.master_satuan', ' kan_master.master_satuan.kode = kan_master.master_barang_dalam_proses.kode_satuan_stok','left');
														$this->db->where('kan_master.opsi_master_produk.jenis_bahan','BDP');
														$this->db->where('kan_suol.opsi_transaksi_produksi.kode_produksi',$kode_produksi);
														$get_bahan = $this->db->get()->row();
														$jumlah = $get_bahan->qty  * $get_bahan->jumlah;


														echo $get_bahan->nama_barang.' '.$jumlah.' '.$get_bahan->alias.'<br>';
													}
													

												}
											}
											?>
										</td>
									</tr>
									<?php } 
									?>
								</tbody>
							</table>
							<input type="hidden" id="jumlah_temp">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
