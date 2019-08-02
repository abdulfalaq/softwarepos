
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Paket</a></li>
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
					<span class="pull-left" style="font-size: 24px">Edit Paket </span>
					<a href="<?php echo base_url('setting/paket/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/paket/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Edit Paket</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Paket</label>
										<input readonly='true' type="text" value="PKT45345" class="form-control" placeholder="Kode " name="kode_paket" id="kode_paket" />
									</div>

								</div>

								<div class=" form-group col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Paket</label>
										<input type="text" class="form-control" placeholder="Nama paket" value="Paket A2" name="nama_paket" id="nama_paket"/>
									</div>
								</div>


								<div class="">
									<div class="form-group  col-md-6">
										<label class="gedhi"><b>Harga Jual</b></label>
										<div class="input-group">
											<span class="input-group-addon rp_harga_paket">Rp 850.000,00</span>
											<input required type="number" class="form-control input-group" onkeyup="get_nominal_harga_paket()" name="harga_paket" id="harga_paket" value="850000" />
										</div>
									</div>
								</div>

								<div class="form-group col-md-6">
									<label>Status</label>
									<select class="form-control select2" name="status" id="status" required="">
										<option selected="true" value="">Pilih Status</option>
										<option value="1" selected>Aktif</option>
										<option value="0" >Nonaktif</option>
									</select> 
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">HPP</label>
										<input type="text" class="form-control" placeholder="HPP" value="163000" name="harga_promo" id="harga_promo" onkeyup="get_harga_promo()" readonly="true"/>
									</div>
								</div>

								<div class="form-group col-md-6">
									<label>Jenis Item</label>
									<select class="form-control select2" name="pilih_jenis" id="pilih_jenis" required="">
										<option selected="true" value="">Pilih Jenis Item</option>
										<option value="treatment">Treatment</option>
										<option value="produk">Produk</option>
										<option value="campur">Mix</option>
									</select> 
								</div>

								<div class="col-md-12">
									<div class="form-group">
										<br> <br>  
										<div onclick="lock_temp()" id="lock_temp"  class="btn btn-primary" style="margin-right:5px">Simpan</div>
									</div>
								</div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

