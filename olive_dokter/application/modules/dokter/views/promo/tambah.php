
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Promo</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Promo </span>
					<a href="<?php echo base_url('setting/promo/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/promo/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>

							<label><h3><b>Tambah Promo</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Promo</label>
										<input  type="text" value="" class="form-control" placeholder="Kode " name="kode_promo" id="kode_promo" />
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Promo</label>
										<input type="text" class="form-control" placeholder="Nama Promo" value="" name="nama_promo" id="nama_promo"/>
									</div>

								</div>

								<div class="col-md-6">
									<label>Tanggal Awal Promo</label>
									<input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="" />
								</div>


								<div class="col-md-6">
									<label>Tanggal Akhir Promo</label>
									<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="" />
								</div>

								<div class="col-md-6">

									<label>Status</label>
									<select class="form-control" name="status" id="status">

										<option value="">--Pilih Status--</option>
										<option  value="1" >Aktif</option>
										<option  value="0" >Nonaktif</option>
									</select> 
								</div>

							</div>
							<div class="col-md-12" style="padding:10px; text-align: right;">
								<a onclick="simpan_all()"  class="btn btn-success pull-right">Simpan</a>
							</div>
						</div> 
						<br>

						<div class="box-footer clearfix">

						</div>
					</form>

				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>

