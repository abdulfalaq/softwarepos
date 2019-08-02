
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Rak</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Rak </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Rak </span>
					<a href="<?php echo base_url('setting/rak/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/rak/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="http://192.168.100.17/elladerma_gudang/admin/master/simpan_rak" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Rak</b></label>
									<input type="hidden" name="id" value="1" />
									<input readonly="true" type="text" class="form-control"  name="kode_rak" />
								</div>

								<div class="form-group col-xs-5">
									<label class="gedhi"><b>Nama Rak</b></label>
									<input readonly="true" type="text" class="form-control" name="nama_rak" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Status</label>

									<select disabled="" class="form-control select2" name="status" id="status">
										<option selected="true" value="">--Pilih Status--</option>
										<option value="1" selected="true" >Aktif</option>
										<option value="0"  >Tidak Aktif</option>
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