<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Record Transaksi Member</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Record Transaksi Member</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span style="font-size: 24px">Data Record Transaksi</span>
					<a href="<?php echo base_url('penjualan/member_umum/record_transaksi_member'); ?>" class=" btn btn-primary btn-no-radius pull-right"><i class="fa fa-list"></i> Data Record Transaksi</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-striped" id="datatable">
									<thead>
										<tr>
											<th>NO</th>
											<th>Kode Transaksi</th>
											<th>Kode Produk</th>
											<th>Nama Produk</th>
											<th>Jumlah</th>
											<th>Harga</th>
											<th>Diskon</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 0;
										$kode_member = $this->uri->segment(4);
										$this->db->select('*');
										$this->db->from('transaksi_penjualan');
										$this->db->join('kan_suol.opsi_transaksi_penjualan','kan_suol.opsi_transaksi_penjualan.kode_penjualan = kan_suol.transaksi_penjualan.kode_penjualan');
										$this->db->join('kan_master.master_produk','kan_suol.opsi_transaksi_penjualan.kode_produk = kan_master.master_produk.kode_produk');
										$this->db->where('kan_suol.transaksi_penjualan.kode_member', $kode_member);
										$get_record_transaksi = $this->db->get()->result();
										foreach ($get_record_transaksi as $value) { $no++;
											?>
											<tr>
												<td><?= $no ?></td>
												<td><?= $value->kode_transaksi ?></td>
												<td><?= $value->kode_produk ?></td>
												<td><?= $value->nama_produk ?></td>
												<td><?= $value->jumlah ?></td>
												<td><?= $value->harga_satuan ?></td>
												<td><?php if ($value->jenis_diskon == 'persen') {
													echo $value->diskon_persen.' %';
												}else{
													echo format_rupiah($value->diskon_rupiah);
												}?></td>
												<td><?= format_rupiah($value->subtotal) ?></td>
											</tr>
											<?php } ?>
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
