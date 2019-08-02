

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/detail'); ?>">Detail Supplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/hutang'); ?>">Daftar Hutang</a></li>
		<li><a href="#">Detail Hutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Detail Hutang</span>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<label><h3><b>Detail Transaksi Pembelian</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Transaksi</label>
										<input readonly="true" type="text" value="PEM_021117115444_1" class="form-control" placeholder="Kode Transaksi" name="kode_pembelian" id="kode_pembelian" />
									</div>

									<div class="form-group">
										<label class="gedhi">Tanggal Transaksi</label>
										<input type="text" value="02 November 2017" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_pembelian"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Nota Referensi</label>
										<input readonly="true" type="text" value="555" class="form-control" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" />
									</div>
									<div class="form-group">
										<label>Supplier</label>
										<select disabled="true" class="form-control select2" name="kode_supplier" id="kode_supplier">
											<option selected="true" value="">--Pilih Supplier--</option>
											<option selected='true' value="SP0001">CV Yola</option>
											<option  value="SP0002">CV sejahtera</option>
											<option  value="SP0003">CV Alami</option>
											<option  value="SP0004">pak men</option>
										</select> 
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
										<tr>
											<td>1</td>
											<td>produk</td>
											<td>acne lotion</td>
											<td>10</td>
											<td>Rp 20.000,00</td>
											<td>Rp 200.000,00</td>
										</tr>
										<tr>
											<td colspan="4"></td>
											<td style="font-weight:bold;">Total</td>
											<td>Rp 200.000,00</td>
										</tr>
										<tr>
											<td colspan="4"></td>
											<td style="font-weight:bold;">Diskon (%)</td>
											<td id="tb_diskon"></td></td>
										</tr>
										<tr>
											<td colspan="4"></td>
											<td style="font-weight:bold;">Diskon (Rp)</td>
											<td id="tb_diskon_rupiah">Rp 0,00</td>
										</tr>
										<tr>
											<td colspan="4"></td>
											<td style="font-weight:bold;">Grand Total</td>
											<td id="tb_grand_total">Rp 200.000,00</td>
										</tr>
									</tbody>
									<tfoot>

									</tfoot>
								</table>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-2">
									<div class="input-group">
										<a href="<?php echo base_url('supplier/akun_supplier/hutang'); ?>"><div style="text-decoration: none;background-color: #cb5a5e;color:white" class="btn red btn-lg"><i class="fa fa-tags"></i> LUNAS</div></a>
									</div>
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
									<tr>
										<td>1</td>
										<td>PEM_021117115444_1</td>
										<td>Rp 100.000,00</td>
										<td>09 Desember 2017</td>
									</tr>
									<tr>
										<td>2</td>
										<td>PEM_021117115444_1</td>
										<td>Rp 10.000,00</td>
										<td>09 Desember 2017</td>
									</tr>
									<tr>
										<td>3</td>
										<td>PEM_021117115444_1</td>
										<td>Rp 10.000,00</td>
										<td>09 Desember 2017</td>
									</tr>
									<tr>
										<td>4</td>
										<td>PEM_021117115444_1</td>
										<td>Rp 15.000,00</td>
										<td>09 Desember 2017</td>
									</tr>
									<tr>
										<td>5</td>
										<td>PEM_021117115444_1</td>
										<td>Rp 65.000,00</td>
										<td>09 Desember 2017</td>
									</tr>
								</tbody>
								<tfoot>

								</tfoot>
							</table>
							<br>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
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
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>