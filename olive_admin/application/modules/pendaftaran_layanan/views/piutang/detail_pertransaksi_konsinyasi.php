<?php
$kode_member=$this->uri->segment(4);
$kode_transaksi=$this->uri->segment(5);
?>	
<a href="<?php echo base_url('/penjualan/piutang/detail/'.$kode_member); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
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
					<span class="pull-left" style="font-size: 24px">Angsuran Piutang Konsinyasi</span>
					<a href="<?php echo base_url('penjualan/piutang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Umum</a>
					<a href="<?php echo base_url('penjualan/piutang/daftar_konsinyasi'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Konsinyasi</a>
				</div>
				<?php
				$this->db->where('kan_suol.transaksi_penjualan.kode_penjualan', $kode_transaksi);
				$this->db->where('kan_suol.transaksi_penjualan.kode_member', $kode_member);
				$this->db->from('kan_suol.transaksi_penjualan');
				$this->db->join('kan_master.master_member', 'kan_suol.transaksi_penjualan.kode_member = kan_master.master_member.kode_member','left');
				$this->db->join('kan_kasir.transaksi_piutang', 'kan_suol.transaksi_penjualan.kode_penjualan = kan_kasir.transaksi_piutang.kode_piutang','left');
				$get_penjualan=$this->db->get();
				$hasil_penjualan=$get_penjualan->row();
				?>
				<div class="panel-body">
					<form id="data_form" onsubmit="return false;">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<h5>Kode transaksi</h5>
									<input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" readonly value="<?php echo @$hasil_penjualan->kode_penjualan;?>">
									<input type="hidden" name="kode_unit_jabung" id="kode_unit_jabung" value="<?php echo @$hasil_penjualan->kode_unit_jabung;?>">
									<input type="hidden" name="kode_member" id="kode_member" value="<?php echo @$hasil_penjualan->kode_member;?>">
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
						<div class="col-md-12">
							<table class="table table-bordered" style="margin-top: 40px;">
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
									$this->db->where('kan_suol.transaksi_member_konsinyasi.kode_transaksi', $kode_transaksi);
									$this->db->from('kan_suol.transaksi_member_konsinyasi');
									$this->db->join('kan_master.master_produk', 'kan_suol.transaksi_member_konsinyasi.kode_produk = kan_master.master_produk.kode_produk', 'left');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode', 'left');
									$this->db->join('kan_master.master_harga_barang', 'kan_master.master_produk.kode_produk = kan_master.master_harga_barang.kode_barang', 'left');
									$get_temp=$this->db->get('');
									$hasil_temp=$get_temp->result();
									$no=1;
									foreach ($hasil_temp as $temp) {
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$temp->nama_produk;?></td>
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
						<br>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Confirmasi</h4>
			</div>
			<div class="modal-body">
				<h3>Apakah anda yakin ingin menyimpan data tersebut ?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-no-radius btn-md" data-dismiss="modal">Cancel</button>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="simpan_transaksi()" >Yakin</a>
			</div>
		</div>
	</div>
</div>
