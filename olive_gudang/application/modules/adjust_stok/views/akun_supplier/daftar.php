

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="#">Akun Supplier</a></li>
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
					<span class="pull-left" style="font-size: 24px">Akun Supplier</span>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Nama Supplier</label>
									<input type="text" class="form-control" id="nama_supplier" />
								</div>
							</div>
							<div class="col-md-3">
								<a onclick="cari_produk()" style="margin-top: 25px;background-color: #1BA39C;color:white" class="btn btn-md green-seagreen"><i class="fa fa-search"></i> Cari</a>
							</div>
						</div>
						<div class="box-body">            
							<div class="sukses" ></div>
							<table class="table table-striped table-hover table-bordered" id="tabel_daftar">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>No.Telp</th>
										<th>Nama PIC</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="scroll_data">
									<tr>
										<td>1</td>
										<td>SP0001</td>
										<td>CV Yola</td>
										<td>023523</td>
										<td>Yolla</td>
										<td><span class="label label-info">AKTIF</span></td>
										<td align="center">
											<a href="http://192.168.100.17/olive_gudang/supplier/akun_supplier/detail/SP0001" class="btn btn-primary btn-lg"><i class="fa fa-eye"></i> Detail</a>
										</td>
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