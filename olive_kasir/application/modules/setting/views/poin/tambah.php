

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('Setting'); ?>">Setting</a></li>
		<li><a href="#">Poin</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Poin</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Poin</span>
					<a href="<?php echo base_url('setting/poin/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Poin</a>
					<a href="<?php echo base_url('setting/poin/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Poin</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">

								<div class="form-group col-xs-5">
									<label class="gedhi"><b>Nominal Poin</label>
										<div class="input-group">
											<input type="hidden" name="kode_poin" id="kode_poin" value="PN_180209025104" readonly>
											<input type="text" class="form-control" value="" name="nominal_poin" id="nominal_poin" >
											<span class="input-group-addon"><div id="rupiah"></div></span>
										</div>
									</div>


									<div class="form-group col-xs-5">
										<label class="gedhi"><b>Nominal Transaksi</label>
											<div class="input-group">
												<input type="text" class="form-control" value="" name="nominal_transaksi" id="nominal_transaksi" >
												<span class="input-group-addon"><div id="rupiah_transaksi"></div></span>
											</div>
										</div>

									</div>
									
									<div class="box-footer">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</form>
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