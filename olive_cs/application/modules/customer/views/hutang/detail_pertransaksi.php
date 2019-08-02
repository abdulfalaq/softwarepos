<?php
$kode_supplier=$this->uri->segment(4);
$kode_transaksi=paramDecrypt($this->uri->segment(5));
?>	
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Hutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Hutang </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Hutang </span>
					<a href="<?php echo base_url('pembelian/hutang/detail/'.@$kode_supplier); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Hutang</a>
				</div>				
				<?php
				$this->db->where('kan_suol.transaksi_pembelian.kode_po', $kode_transaksi);
				$this->db->where('kan_suol.transaksi_pembelian.kode_supplier', $kode_supplier);
				$this->db->from('kan_suol.transaksi_pembelian');
				$this->db->join('kan_master.master_supplier', 'kan_suol.transaksi_pembelian.kode_supplier = kan_master.master_supplier.kode_supplier');
				$this->db->join('kan_kasir.transaksi_hutang', 'kan_suol.transaksi_pembelian.kode_po = kan_kasir.transaksi_hutang.kode_hutang');
				$get_pembelian=$this->db->get();
				$hasil_pembelian=$get_pembelian->row();
				?>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<h5>Kode transaksi</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->kode_po;?>">
							</div>
							<div class="col-md-6">
								<h5>Nomor Nota</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->nomor_nota;?>">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<h5>Tanggal Transaksi</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->tanggal_pembelian;?>">
							</div>
							<div class="col-md-6">
								<h5>Supplier</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->nama_supplier;?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5>Pembayaran</h5>
								<input type="text" class="form-control" readonly value="<?php echo @$hasil_pembelian->proses_pembayaran;?>">
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
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$this->db->where('kan_suol.opsi_transaksi_pembelian.kode_pembelian', $kode_transaksi);
								$this->db->where('kan_suol.opsi_transaksi_pembelian.kode_supplier', $kode_supplier);
								$this->db->from('kan_suol.opsi_transaksi_pembelian');
								$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_pembelian.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku');
								$this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode');

								$get_opsi=$this->db->get();
								$hasil_opsi=$get_opsi->result();
								$no=1;
								foreach ($hasil_opsi as $opsi) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo $opsi->nama_bahan_baku;?></td>
										<td><?php echo $opsi->qty;?> <?php echo $opsi->nama;?></td>
										<td><?php echo @format_rupiah($opsi->harga_satuan);?></td>
										<td class="text-right"><?php echo @format_rupiah($opsi->qty * $opsi->harga_satuan);?></td>
									</tr>
									<?php
								}
								?>
								<tr>
									<th colspan="3"></th>
									<th>Total</th>
									<th class="text-right"><?php echo @format_rupiah($hasil_pembelian->nominal_total);?></th>
									<input type="hidden" name="subtotal" id="subtotal" value="<?php echo @$hasil_pembelian->nominal_total;?>" readonly>     
								</tr>
								<tr>
									<th colspan="3"></th>
									<th>Diskon (%)</th>
									<th class="text-right" id="diskon_persen_col_text"><?php echo @$hasil_pembelian->persentase_diskon;?> %</th>
									<input type="hidden" name="diskon_persen_col" id="diskon_persen_col">  
								</tr>
								<tr>
									<th colspan="3"></th>
									<th>Diskon (Rp)</th>
									<th class="text-right" id="diskon_rupiah_col_text"><?php echo @format_rupiah($hasil_pembelian->nominal_diskon);?></th>
									<input type="hidden" name="diskon_rupiah_col" id="diskon_rupiah_col">    
								</tr>
								<tr>
									<th colspan="3"></th>
									<th>Grand Total</th>
									<th class="text-right" id="grand_total_text"><?php echo @format_rupiah($hasil_pembelian->nominal_grand_total);?></th>
									<input type="hidden" name="grand_total" id="grand_total" value="">    
								</tr>
							</tbody>
						</table>
						<hr>
					</div>	<br>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<h5>Jenis Diskon</h5>
								<select name="jenis_diskon" class="form-control"  onchange="jenis_diskon_change()" disabled id="jenis_diskon">
									<option value="">Persen</option>
									<option <?php if (@$hasil_pembelian->jenis_diskon == 'persen') { echo "selected";} ?> value="persen">Persen</option>
									<option <?php if (@$hasil_pembelian->jenis_diskon == 'rupiah') { echo "selected";} ?>  value="rupiah">Rupiah</option>
								</select>
							</div>
							<div class="col-md-3 ppn">
								<h5>PPN</h5>
								<select name="jenis_ppn" class="form-control" disabled="" onchange="jenis_ppn_change()" id="jenis_ppn">
									<option value="">Jenis PPN</option>
									<option value="non_ppn">Non PPN</option>
									<option value="ppn">PPN</option>
								</select>
							</div>
							<div class="col-md-3">
								<h5>Pembayaran</h5>
								<select name="pembayaran" class="form-control" disabled="" onchange="jenis_pembayaran_change()" id="jenis_pembayaran">
									<option value="">Jenis Pembayaran</option>
									<option value="cash">Cash</option>
									<option value="kredit">Kredit</option>
								</select>
							</div>
							<div class="col-md-3 kredit" >
								<h5>Jenis Kredit</h5>
								<select name="jenis_kredit" class="form-control" disabled="" onchange="jenis_kredit_change()" id="jenis_kredit">
									<option value="">Jenis Kredit</option>
									<option value="dp">DP</option>
									<option value="non_dp">Non DP</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div id="persen">
									<h5>Diskon (%)</h5>
									<input type="text" class="form-control" disabled="" onkeyup="diskon_persen()" id="input_persen" name="input_persen" placeholder="Diskon %" value="0">
								</div>
								<div id="rupiah" style="display: none">
									<h5>Diskon (Rp)</h5>
									<input type="text" class="form-control" disabled="" onkeyup="diskon_rupiah()" id="input_rupiah" name="input_rupiah" placeholder="Diskon Rp" value="0">
								</div>
								<input type="hidden" id="persen_jadi">
							</div>
							<div class="col-md-3 ppn" id="bayar_ppn" >
								<h5>Bayar PPN</h5>
								<input type="text" class="form-control" id="bayar_ppn_input" name="bayar_ppn" value="" onkeyup="nominal_ppn()" placeholder="PPN (%)" readonly="">
								<div id="nominal_ppn"></div>
							</div>
							<div class="col-md-3 div-ppn">
								<h5>Bayar DP</h5>
								<input type="text" class="form-control" disabled="" id="bayar_dp" name="bayar_dp" placeholder="Bayar" value="3000">
							</div>
							<div class="col-md-3 kredit" id="jatuh_tempo_box" >
								<h5>Jatuh Tempo</h5>
								<input type="date" class="form-control" disabled="" id="jatuh_tempo" name="jatuh_tempo" value="">
							</div>
						</div>
					</div>
					<div class="col-md-12" style="margin-top: 40px">
						<h4>Detail Pembayaran Hutang</h4>
						<table id="tabel_daftar" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Angsuran</th>
									<th>Tanggal Angsuran</th>
									<th>Jenis Pembayaran</th>
								</tr>
							</thead>
							<tbody id="tabel_temp_data_mutasi">
								<?php
								$this->db->where('kan_kasir.opsi_transaksi_hutang.kode_hutang', $kode_transaksi);
								$this->db->from('kan_kasir.opsi_transaksi_hutang');
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
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="pull-right">
								<h5><b>Sisa Hutang</b></h5>
								<div class="btn btn-success btn-no-radius btn-lg">
									<i class="fa fa-tag"></i> <?php echo @format_rupiah($hasil_pembelian->sisa);?>
									<input type="hidden" name="sisa_hutang" id="sisa_hutang" value="<?php echo @$hasil_pembelian->sisa;?>">    
								</div>
							</div>
						</div>
					</div><br>
				</div>
			</div>
		</div>
	</div>
</div>
