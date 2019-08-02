

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/daftar'); ?>">Akun Supplier</a></li>
		<li><a href="<?php echo base_url('supplier/akun_supplier/detail'); ?>">Detail Supplier</a></li>
		<li><a href="#">Personal Data</a></li>
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
					<span class="pull-left" style="font-size: 24px">Detail Supplier</span>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>Kode Supplier</label>
									<input type="hidden" name="id" value="1" />
									<input readonly type="text" class="form-control"  value="SP0001"   name="kode_supplier" id="kode_supplier" />
								</div>
								<div class="form-group  col-xs-6">
									<label>Nama Supplier</label>
									<input type="text" readonly class="form-control" value="CV Yola"  name="nama_supplier" id="nama_supplier" />
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>No Telp Supplier</label>
									<input type="text" readonly class="form-control" value="023523"  name="telp_supplier" id="telp_supplier" />
								</div>
								<div class="form-group  col-xs-6">
									<label>Nama Pic</label>
									<input type="text" readonly class="form-control" value="Yolla"  name="nama_pic" id="nama_pic" />
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>No Telp Pic</label>
									<input type="hidden" name="id" value="1" />
									<input type="text" readonly class="form-control" value="0012321421"  name="telp_pic" id="telp_pic" />
								</div>
								<div class="form-group  col-xs-6">
									<label class="gedhi">Status</label>
									<select class="form-control select2" name="status_supplier" readonly disabled="" id="status_supplier" >
										<option selected="" value="">--Pilih Status--</option>
										<option selected value="1" >Aktif</option>
										<option  value="0" >Nonaktif</option>
									</select> 
								</div> 
							</div>
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