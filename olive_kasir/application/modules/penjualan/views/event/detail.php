
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Event</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Event </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Event </span>
					<a href="<?php echo base_url('penjualan/event/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Event</a>
					<a href="<?php echo base_url('penjualan/event/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Event</a>
				</div>
				<?php
				$kode_event=$this->uri->segment(4);
				$this->db->where('kode_event', $kode_event);
				$get_event=$this->db->get('transaksi_penjualan_event');
				$hasil_event=$get_event->row();

				?>
				<div class="panel-body">
					<div class="col-md-12">
						<form id="data_form" onsubmit="return false;">
							<div class="row">
								<div class="col-md-6">
									<label for="">Nama Event</label>
									<input type="text" readonly="" id="nama_event" name="nama_event" value="<?php echo @$hasil_event->nama_event;?>" class="form-control">
									<input type="hidden" name="kode_event" id="kode_event" value="<?php echo @$hasil_event->kode_event;?>">
								</div>
								<div class="col-md-6">
									<label for="">Tanggal Event</label>
									<input type="date" readonly="" id="tanggal_event" name="tanggal_event" value="<?php echo @$hasil_event->tanggal;?>" class="form-control">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Produk</th>
												<th>QTY</th>
												<th>QTY Terjual</th>
												<th>Produk Rusak</th>
												<th>Sisa</th>
												<th>Exp Date</th>
												<th>Harga</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$kode_event=$this->uri->segment(4);
											$this->db->where('kan_suol.opsi_transaksi_penjualan_event.kode_event', $kode_event);
											$this->db->from('kan_suol.opsi_transaksi_penjualan_event');
											$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan_event.kode_produk = kan_master.master_produk.kode_produk', 'left');
											$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode', 'left');
											$this->db->join('kan_master.master_harga_barang', 'kan_master.master_produk.kode_produk = kan_master.master_harga_barang.kode_barang', 'left');
											$get_temp=$this->db->get('');
											$hasil_temp=$get_temp->result();
											$no=1;
											foreach ($hasil_temp as $temp) {
												?>
												<tr>
													<td><?php echo $no++;?></td>
													<td><?php echo @$temp->nama_produk;?>
														<input type="hidden" id="kode_produk" value="<?php echo @$temp->kode_produk;?>">
														<input type="hidden" id="nama_satuan" value="<?php echo @$temp->nama;?>">
													</td>
													<td><?php echo @$temp->jumlah.' '.@$temp->nama;?></td>
													<td><?php echo @$temp->jumlah_terjual.' '.@$temp->nama;?></td>
													<td><?php echo @$temp->jumlah_rusak.' '.@$temp->nama;?></td>
													<td><?php echo @$temp->sisa.' '.@$temp->nama;?></td>
													<td><?php echo @TanggalIndo($temp->tanggal_expired);?></td>
													<td><?php echo @format_rupiah($temp->harga_satuan);?></td>
												</tr>
												<?php
											}
											?>

										</tbody>
									</table>
								</div>
							</div><br>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

