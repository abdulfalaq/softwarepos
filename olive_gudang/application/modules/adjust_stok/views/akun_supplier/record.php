

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/detail'); ?>">Detail Supplier</a></li>
		<li><a href="#">Record Transaksi Supplier</a></li>
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
					<span class="pull-left" style="font-size: 24px">Record Transaksi Supplier</span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Nama Produk</label>
								<input type="text" class="form-control" id="nama_produk" />
							</div>
						</div>
						<div class="col-md-3">
							<a onclick="cari_produk()" style="margin-top: 25px;background-color: #16847f;color:white" class="btn btn-md green-seagreen"><i class="fa fa-search"></i> Cari</a>
						</div>
					</div>
					<div class="box-body">            
						<div class="sukses" ></div>
						<table class="table table-striped table-hover table-bordered" id="tabel_daftar" >
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Kode Transaksi</th>
									<th>Supplier</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Diskon</th>
									<th>Subtotal</th>
								</tr>
							</thead>
							<tbody id="scroll_data">
								<tr>
									<td>1</td>
									<td>01 November 2017</td>
									<td>PEM_011117102348_1</td>
									<td>CV sejahtera</td>
									<td>SM001</td>
									<td>Kartu Member</td>
									<td>10</td>
									<td>Rp 10.000,00</td>
									<td>5</td>
									<td>Rp 95.000,00</td>
								</tr>
							</tbody>
						</table>
					</div>
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