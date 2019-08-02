<style>
.padding_min {
	padding: 2px !important;
}

.box-tag {
	background-color: grey;
	color:white;
	font-family: segoe ui;
}
</style>
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Pesanan Penjualan</a></li>
		<li></li>
	</ol>
</div>
<?php
$get_setting=$this->db->get('setting');
$hasil_setting=$get_setting->row();
$kode_unit_jabung=@$hasil_setting->kode_unit;
?>
<div class="clearfix"></div>

<div class="container">
	<h1>Pesanan Penjualan </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Pesanan Penjualan </span>
					<a href="<?php echo base_url('penjualan/pesanan_penjualan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Pesanan Penjualan</a>
					<a href="<?php echo base_url('penjualan/pesanan_penjualan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pesanan Penjualan</a>
				</div>
				<?php
				$kode_pesanan=$this->uri->segment(4);
				$this->db->where('kan_suol.transaksi_penjualan_pesanan.kode_pesanan', $kode_pesanan);
				$this->db->order_by('kan_suol.transaksi_penjualan_pesanan.id','DESC');
				$this->db->from('kan_suol.transaksi_penjualan_pesanan');
				$this->db->join('kan_master.master_member', 'kan_suol.transaksi_penjualan_pesanan.kode_member = kan_master.master_member.kode_member');
				$this->db->join('kan_master.master_user', 'kan_suol.transaksi_penjualan_pesanan.kode_petugas = kan_master.master_user.kode_user');

				$get_transaksi=$this->db->get();
				$hasil_transaksi=$get_transaksi->row();

				$status_jadwal = $this->uri->segment(5);
				?>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<?php  if ($status_jadwal == 'belum') { ?>
								<div id="form_pengiriman">
									<div class="row">
										<div class="col-md-5">
											<input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman">
										</div>
										<div class="col-md-5">
											<select id="pengirim" class="form-control" name="pengirim">
												<option value="">-- Pilih Pengirim</option>
												<option value="kan_jabung">Kan Jabung</option>
												<option value="koordinator">Koordinator</option>
											</select>

										</div>
										<input type="hidden" id="kode_pesanan" value="<?= $hasil_transaksi->kode_pesanan ?>">
										<div class="col-md-2">
											<a onclick="simpan_pengiriman()" class="btn btn-info btn-block btn-md btn-no-radius"><i class="fa fa-send"></i> Simpan</a>
										</div>
									</div>
								</div><br><br>
								<?php }else{ ?>
								<div id="data_pesanan">
									<div class="row">
										<div class="col-md-6">
											<h5>Kode Pesanan Penjualan</h5>
											<input type="text" id="kode_pesanan" value="<?php echo @$hasil_transaksi->kode_pesanan;?>" name="kode_pesanan" class="form-control" readonly>
											<input type="hidden" id="kode_unit_jabung" name="kode_unit_jabung" class="form-control" value="<?php echo @$kode_unit;?>">

										</div>
										<div class="col-md-6">
											<h5>Tanggal Transaksi</h5>
											<input type="date" class="form-control" id="tgl_tr" name="tgl_tr" value="<?php echo @$hasil_transaksi->tanggal;?>" readonly>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<h5>Petugas</h5>
											<input type="text" id="nama_user" value="<?php echo @$hasil_transaksi->nama_user;?>" name="nama_user" class="form-control" readonly>
										</div>
										<div class="col-md-6">
											<h5>Nama Member</h5>
											<input type="text" class="form-control" id="nama_member" name="nama_member" value="<?php echo @$hasil_transaksi->nama_pic;?> - <?php echo @$hasil_transaksi->nama_perusahaan;?>" readonly>
										</div>
									</div>
								</div>
								<?php } ?>
								
								
								<div class="row" style="background-color:white;padding: 10px;">
									<div class="col-md-12 padding_min">
										<table id="" class="table table-striped table-bordered">
											<thead>
												<tr style="background-color: #d3d3d3;">
													<th>No.</th>
													<th>Nama Produk</th>
													<th>QTY</th>
													<th>Harga</th>
													<th>Diskon</th>
													<th>Subtotal</th>
													<th>Expired Date</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$kode_pesanan=$this->uri->segment(4);
												$this->db->where('kan_suol.opsi_transaksi_penjualan_pesanan.kode_pesanan', $kode_pesanan);
												$this->db->from('kan_suol.opsi_transaksi_penjualan_pesanan');
												$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_pesanan.kode_produk = kan_master.master_produk.kode_produk', 'left');
												$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode', 'left');
												$get_temp=$this->db->get('');
												$hasil_temp=$get_temp->result();
												$no=1;
												foreach ($hasil_temp as $temp) {
													?>
													<tr>
														<td><?php echo $no++;?></td>
														<td><?php echo @$temp->nama_produk;?></td>
														<td><?php echo @$temp->jumlah.' '.@$temp->nama;?></td>
														<td class="text-right"><?php echo @format_rupiah($temp->harga_satuan);?></td>
														<td class="text-center">
															<?php 
															if(@$temp->jenis_diskon=='persen'){
																echo @$temp->diskon_persen.'%';
															}else{
																echo @format_rupiah($temp->diskon_rupiah);
															}
															?>
														</td>
														<td class="text-right"><?php echo @format_rupiah($temp->subtotal);?></td>
														<td><?php echo @TanggalIndo($temp->tanggal_expired);?></td>
													</tr>
													<?php
												}
												?>
												<tr>
													<th colspan="4"></th>
													<th>Total</th>
													<th class="text-right"><?php echo format_rupiah($hasil_transaksi->total_nominal) ?></th>

												</tr>
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
	</div>
</div>

<script>
function simpan_pengiriman () {
	kode_pesanan 		= $('#kode_pesanan').val();
	tanggal_pengiriman 	= $('#tanggal_pengiriman').val();
	pengirim 			= $('#pengirim').val();
	if (kode_pesanan != '' && tanggal_pengiriman != '' && tanggal_pengiriman != '') {
		$.ajax({
			url: '<?php echo base_url('penjualan/pesanan_penjualan/penjadwalan_pengiriman'); ?>',
			type: 'post',
			data:{tanggal_pengiriman:tanggal_pengiriman,pengirim:pengirim,kode_pesanan:kode_pesanan},
			dataType:'Json',
			beforeSend: function(repsonse){
				$('.tunggu').show();
			},
			success: function(response){
				$('.tunggu').hide();

				if (response.status == 'berhasil') {
					$('.alert_berhasil').show();
					setTimeout(function(){window.location = '<?php echo base_url('penjualan/pesanan_penjualan/daftar'); ?>';},1500); 
					
				}
			}
		});
	}else{
		alert('Mohon melengkapi data.');
	}

	return false();
}
</script>