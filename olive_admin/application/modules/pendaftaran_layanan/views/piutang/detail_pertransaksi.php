<?php
$kode_supplier=$this->uri->segment(4);
$kode_transaksi=$this->uri->segment(5);
?>	
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Piutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Piutang </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Piutang </span>
					<a href="<?php echo base_url('penjualan/piutang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Umum</a>
					<a href="<?php echo base_url('penjualan/piutang/daftar_konsinyasi'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Konsinyasi</a>
				</div>				
				<?php
				$kode_member=$this->uri->segment(4);
				$kode_transaksi=$this->uri->segment(5);
				$this->db->where('kan_suol.transaksi_penjualan.kode_penjualan', $kode_transaksi);
				$this->db->where('kan_suol.transaksi_penjualan.kode_member', $kode_member);
				$this->db->from('kan_suol.transaksi_penjualan');
				$this->db->join('kan_master.master_member', 'kan_suol.transaksi_penjualan.kode_member = kan_master.master_member.kode_member','left');
				$this->db->join('kan_kasir.transaksi_piutang', 'kan_suol.transaksi_penjualan.kode_penjualan = kan_kasir.transaksi_piutang.kode_piutang','left');
				$get_penjualan=$this->db->get();
				$hasil_penjualan=$get_penjualan->row();
				?>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h5>Kode transaksi</h5>
								<input type="text" class="form-control" id="kode_transaksi" readonly value="<?php echo @$hasil_penjualan->kode_penjualan;?>">
								<input type="hidden" id="kode_unit_jabung" value="<?php echo @$hasil_penjualan->kode_unit_jabung;?>">
								<input type="hidden" id="kode_member" value="<?php echo @$hasil_penjualan->kode_member;?>">
							</div>
							<div class="col-md-6">
								<h5>Member</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_penjualan->nama_pic.' - '.@$hasil_penjualan->nama_perusahaan;?>">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<h5>Tanggal Transaksi</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_penjualan->tanggal_penjualan;?>">
							</div>
							<div class="col-md-6">
								<h5>Pembayaran</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_penjualan->proses_pembayaran;?>">
							</div>
						</div>

					</div>	
					<div class="col-md-12" style="margin-top: 40px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr style="background-color: #d3d3d3;">
									<th>No</th>
									<th>Nama Produk</th>
									<th>QTY</th>
									<th>Harga Satuan</th>
									<th>Diskon</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$this->db->where('kan_suol.opsi_transaksi_penjualan.kode_penjualan', $kode_transaksi);
								$this->db->from('kan_suol.opsi_transaksi_penjualan');
								$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_penjualan.kode_produk = kan_master.master_produk.kode_produk');
								$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode');

								$get_opsi=$this->db->get();
								$hasil_opsi=$get_opsi->result();
								$no=1;
								foreach ($hasil_opsi as $opsi) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $opsi->nama_produk;?></td>
										<td><?php echo $opsi->jumlah;?> <?php echo $opsi->nama;?></td>
										<td><?php echo @format_rupiah($opsi->harga_satuan);?></td>
										<td>
											<?php 
											if(@$opsi->jenis_diskon=='persen'){
												echo @$opsi->diskon_persen.'%';
											}else{
												echo @format_rupiah($opsi->diskon_rupiah);
											}
											?>
										</td>
										<td class="text-right"><?php echo @format_rupiah($opsi->subtotal);?></td>
									</tr>
									<?php
								}
								?>
								<tr>
									<th colspan="4"></th>
									<th>Total</th>
									<th class="text-right"><?php echo @format_rupiah($hasil_penjualan->total_nominal);?></th>
									<input type="hidden" name="subtotal" id="subtotal" value="<?php echo @$hasil_penjualan->total_nominal;?>" readonly>     
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Diskon (%)</th>
									<th class="text-right" id="diskon_persen_col_text"><?php echo @$hasil_penjualan->diskon_persen;?> %</th>
									<input type="hidden" name="diskon_persen_col" id="diskon_persen_col">  
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Diskon (Rp)</th>
									<th class="text-right" id="diskon_rupiah_col_text"><?php echo @format_rupiah($hasil_penjualan->diskon_rupiah);?></th>
									<input type="hidden" name="diskon_rupiah_col" id="diskon_rupiah_col">    
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Ongkos Kirim</th>
									<th class="text-right" id="grand_total_text"><?php echo @format_rupiah($hasil_penjualan->ongkos_kirim);?></th>
									<input type="hidden" name="ongkos_kirim" id="ongkos_kirim" value="<?php echo @$hasil_penjualan->ongkos_kirim;?>">    
								</tr>
								<tr>
									<th colspan="4"></th>
									<th>Grand Total</th>
									<th class="text-right" id="grand_total_text"><?php echo @format_rupiah($hasil_penjualan->grand_total);?></th>
									<input type="hidden" name="grand_total" id="grand_total" value="<?php echo @$hasil_penjualan->grand_total;?>">    
								</tr>
							</tbody>
						</table>
					</div>	
					<div class="row">
						<div class="col-md-12">
							<div class="pull-right">
								<h5><b>Sisa Piutang</b></h5>
								<div class="btn btn-success btn-no-radius btn-lg">
									<i class="fa fa-tag"></i> <?php echo @format_rupiah($hasil_penjualan->sisa);?>
									<input type="hidden" name="sisa_piutang" id="sisa_piutang" value="<?php echo @$hasil_penjualan->sisa;?>">    
								</div>
							</div>
						</div>
					</div><br>
					<div class="col-md-12" style="margin-top: 40px">
						<h4>Detail Pembayaran Piutang</h4>
						<table id="tabel_daftar" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Angsuran</th>
									<th>Tanggal Angsuran</th>
									<th>Jenis Pembayaran</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody id="tabel_temp_data_mutasi">
								<?php
								$this->db->where('kan_kasir.opsi_transaksi_piutang.kode_piutang', $kode_transaksi);
								$this->db->from('kan_kasir.opsi_transaksi_piutang');
								$get_opsi=$this->db->get();
								$hasil_opsi=$get_opsi->result();
								$no=1;
								foreach ($hasil_opsi as $opsi) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @$opsi->kode_angsuran;?></td>
										<td><?php echo @format_rupiah($opsi->angsuran);?></td>
										<td><?php echo @TanggalIndo($opsi->tanggal_angsuran);?></td>
										<td><?php echo @$opsi->jenis_pembayaran;?></td>
										<td><?php 
										if(@$opsi->status=='proses'){
											echo "<span class='label label-warning'>Proses</span> ";
										}elseif (@$opsi->status=='selesai') {
											echo "<span class='label label-success'>Selesai</span> ";
										}
										?></td>
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
</div>
