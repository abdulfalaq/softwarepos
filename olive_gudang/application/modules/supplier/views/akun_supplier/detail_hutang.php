

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="#">Detail Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_supplier=$this->uri->segment(4);
	$this->db->where('clouoid1_olive_gudang.transaksi_hutang.kode_supplier',$kode_supplier);
	$this->db->from('clouoid1_olive_gudang.transaksi_hutang');
	$this->db->join('clouoid1_olive_gudang.transaksi_pembelian', 'clouoid1_olive_gudang.transaksi_hutang.kode_transaksi = clouoid1_olive_gudang.transaksi_pembelian.kode_pembelian', 'left');
	$this->db->join('clouoid1_olive_master.master_supplier', 'clouoid1_olive_gudang.transaksi_hutang.kode_supplier = clouoid1_olive_master.master_supplier.kode_supplier', 'left');
	$get_hutang = $this->db->get()->row();
	?>	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px;margin-left: 620px"><?php echo $get_hutang->nama_supplier?></span>
				</div>
				
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="container" style="margin-left: 10px">
									<div class="row">
										<div class="" role="tabpanel" data-example-id="togglable-tabs">
											<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist" >
												<li role="presentation" class="" id="menu_setting" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/detail/'.$get_hutang->kode_supplier); ?>">Personal Data</a>
												</li>
												<li role="presentation" class="active" id="menu_pengajuan" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/hutang/'.$get_hutang->kode_supplier); ?>" >Hutang</a>
												</li>
												<li role="presentation" class="" id="menu_validasi" style="margin-bottom: 20px;">
													<a href="<?php echo base_url('supplier/akun_supplier/record/'); ?>">Record Transaksi</a>
												</li>
											</ul>
										</div>
									</div>
								</div><br>
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Transaksi</label>
										<input readonly="true" type="text" value="<?php echo $get_hutang->kode_transaksi?>" class="form-control" placeholder="Kode Transaksi" name="kode_pembelian" id="kode_pembelian" />
									</div>

									<div class="form-group">
										<label class="gedhi">Tanggal Transaksi</label>
										<input readonly="true" type="text" value="<?php echo @TanggalIndo($get_hutang->tanggal_transaksi)?>" class="form-control" placeholder="" name="kode_pembelian" id="kode_pembelian" />
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>Nota Referensi</label>
										<input readonly="true" type="text" value="<?php echo $get_hutang->nomor_nota?>" class="form-control" placeholder="" name="kode_pembelian" id="kode_pembelian" />
									</div>
									<div class="form-group">
										<label>Supplier</label>
										<input readonly="true" type="text" value="<?php echo $get_hutang->nama_supplier?>" class="form-control" placeholder="" name="kode_pembelian" id="kode_pembelian" />
									</div>
								</div>
								<div class="col-md-6">
									<label>Pembayaran</label>
									<div class="form-group">
										<select disabled="true" class="form-control" name="proses_pembayaran" id="proses_pembayaran">
											<option  value="cash">Cash</option>
											<option selected='true'  value="credit">Credit</option>
											<option  value="konsinyasi">Konsinyasi</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="sukses" ></div>
					<div id="list_transaksi_pembelian">
						<div class="box-body">
							<table id="tabel_daftar" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Jenis Bahan</th>
										<th>Nama bahan</th>
										<th>QTY</th>
										<th>Harga Satuan</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody id="tabel_temp_data_transaksi">
									<?php
									if(@$get_hutang->kode_transaksi){
										$this->db->select('nama');
										$this->db->select('nama_bahan_baku');
										$this->db->select('nama_perlengkapan');
										$this->db->select('nama_produk');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.id');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.jumlah');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.expired_date');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.harga_satuan');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.jenis_diskon');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.diskon_item');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.subtotal');
										$this->db->select('clouoid1_olive_gudang.opsi_transaksi_pembelian.kategori_bahan');

										$this->db->where('kode_pembelian',@$get_hutang->kode_transaksi);
										$this->db->from('clouoid1_olive_gudang.opsi_transaksi_pembelian');
										$this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
										$this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_produk.kode_produk', 'left');
										$this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_bahan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
										$this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_gudang.opsi_transaksi_pembelian.kode_satuan = clouoid1_olive_master.master_satuan.kode', 'left');
										$pembelian = $this->db->get();
										$list_pembelian = $pembelian->result();
										$nomor = 1;  $total = 0;

										foreach($list_pembelian as $daftar){ 

											?> 
											<tr>
												<td><?php echo $nomor; ?></td>
												<td><?php echo @$daftar->kategori_bahan; ?></td>
												<td>
													<?php 
													if(@$daftar->kategori_bahan=='bahan baku'){
														echo @$daftar->nama_bahan_baku;
													}elseif (@$daftar->kategori_bahan=='produk') {
														echo @$daftar->nama_produk;
													}elseif (@$daftar->kategori_bahan=='perlengkapan') {
														echo @$daftar->nama_perlengkapan;
													}elseif (@$daftar->kategori_bahan=='kartu member') {
														echo 'kartu member';
													}
													?>  
												</td>
												<td><?php echo @$daftar->jumlah.' '.@$daftar->nama; ?></td>
												<td><?php echo format_rupiah(@$daftar->harga_satuan); ?></td>
												<td><?php echo format_rupiah(@$daftar->subtotal); ?></td>
											</tr>
											<?php 
											@$total = $total + @$daftar->subtotal;
											$nomor++; 
										} 
									}
									?>
									
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Total</td>
										<td><?php echo format_rupiah(@$total);?></td>
									</tr>
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Diskon (%)</td>
										<td id="tb_diskon"><?php echo (@$get_hutang->diskon_persen);?></td>

									</tr>
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Diskon (Rp)</td>
										<td id="tb_diskon_rupiah"><?php echo format_rupiah(@$get_hutang->diskon_rupiah);?></td>
									</tr>
									<tr>
										<td colspan="4"></td>
										<td style="font-weight:bold;">Grand Total</td>
										<td id="tb_grand_total"><?php echo format_rupiah(@$get_hutang->grand_total);?></td>

									</tr>
								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-2">
							<div class="input-group">
								<label>Sisa Hutang </label><br>
								<a><div style="text-decoration: none;background-color: #cb5a5e;color: white" class="btn red btn-lg"><i class="fa fa-tags"></i> <?php echo format_rupiah(@$get_hutang->sisa);?></div></a>
							</div>
						</div>
					</div>
					<div class="box-body">
						<label><h3><b>Detail Pembayaran Hutang</b></h3></label>
						<table id="tabel_daftar" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Angsuran</th>
									<th>Tanggal Angsuran</th>
								</tr>
							</thead>
							<tbody id="tabel_temp_data_mutasi">
								<?php
								$this->db->where('kode_transaksi', $get_hutang->kode_transaksi);
								$get_opsi_hutang=$this->db->get('opsi_hutang')->result();
								$no=1;
								foreach ($get_opsi_hutang as $val) {
									?>
									<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo $val->kode_transaksi;?></td>
									<td><?php echo @format_rupiah($val->angsuran);?></td>
									<td><?php echo @TanggalIndo($val->tanggal_angsuran);?></td>
								</tr>
									<?php
								}
								?>
								
							</tbody>
							<tfoot>

							</tfoot>
						</table>
						<br>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

