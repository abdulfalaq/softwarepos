

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/detail'); ?>">Detail Supplier</a></li>
		<li><a href="#">Daftar Hutang</a></li>
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
					<span class="pull-left" style="font-size: 24px">Daftar Hutang</span>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="col-md-5" id="">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Awal</span>
										<input type="text" class="form-control tgl"  id="tgl_awal">
									</div>
								</div>
								<div class="col-md-5" id="">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Akhir</span>
										<input type="text" class="form-control tgl" id="tgl_akhir">
									</div>
								</div>                        
								<div class="col-md-2 pull-left">
									<button style="width: 147px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div><br>
							<div id="cari_transaksi">
								<table id="tabel_daftar" class="table table-bordered table-striped">
									<tr>
										<th>No</th>
										<th>Kode Transaksi</th>
										<th>Tanggal Transaksi</th>
										<th>Supplier</th>
										<th>Nominal Hutang</th>
										<th>Sisa Hutang</th>
										<th>Jatuh Tempo</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr class="">
										<td>1</td>
										<td>PEM_021117115444_1</td>
										<td>02 November 2017</td>
										<td>CV Yola</td>
										<td>Rp 200.000,00</td>
										<td>Rp 0,00</td>
										<td>-</td>
										<td><span class="label label-success">Lunas</span></td>
										<td>
											<div class="btn-group">
												<a href="<?php echo base_url('supplier/akun_supplier/detail2'); ?>" style="background-color: #26a69a;color:white" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
											</div>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Kode Transaksi</th>
										<th>Tanggal Transaksi</th>
										<th>Supplier</th>
										<th>Nominal Hutang</th>
										<th>Sisa Hutang</th>
										<th>Jatuh Tempo</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</form>
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