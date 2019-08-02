
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Layanan Periksa</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Layanan Periksa </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Layanan Periksa </span>
					<a href="<?php echo base_url('setting/layanan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/layanan'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<label><h3><b>Detail Periksa</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Periksa</label>

										<input readonly="true" type="text"  class="form-control" placeholder="Kode Transaksi" name="kode_pembelian" id="kode_pembelian" />
									</div>


									<div class="form-group">
										<label>Nama periksa</label>

										<input readonly="true" type="text" class="form-control" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" />
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Harga Periksa</label>
										<input type="text"  readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_pembelian"/>
									</div>

									<div class="form-group">
										<label>Status</label>
										<select class="form-control" disabled="" >
											<option>Aktif</option>
										</select>
									</div>
								</div> 
							</div>
						</div> 
						<div class="box-body">
						</div>
						<br>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
</div>
</div>