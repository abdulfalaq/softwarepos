
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Perawatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perawatan </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Perawatan </span>
					<a href="<?php echo base_url('setting/perawatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/perawatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Perawatan</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Perawatan</label>
										<input  type="text" value="" class="form-control" placeholder="Kode " name="kode_perawatan" id="kode_perawatan" />
									</div>

									<div class="form-group">
										<label class="gedhi"><b>Harga Jual</label>
											<div class="input-group">
												<span class="input-group-addon rp_hpp">Rp 0,00</span>
												<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="harga_perawatan" id="harga_perawatan" value="" />
											</div>
										</div>


									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="gedhi">Nama Perawatan</label>
											<input type="text" class="form-control" placeholder="Nama Perawatan" value="" name="nama_perawatan" id="nama_perawatan"/>
										</div>

										<div class="form-group">
											<label>Status</label>
											<select class="form-control select2" name="status" id="status" "">
												<option selected="true" value="">Pilih Status</option>
												<option value="1" >Aktif</option>
												<option value="0" >Nonaktif</option>
											</select> 
										</div>

									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="gedhi"><b>Insentif Terapis</label>
												<div class="input-group">
													<span class="input-group-addon rp_insentif">Rp 0,00</span>
													<input type="number" class="form-control input-group" onkeyup="get_insentif()" name="insentif_terapis" id="insentif_terapis" value="" />
												</div>
											</div>
										</div>
										<div class="col-md-6">



											<div class="form-group">
												<label class="gedhi">HPP</label>
												<input type="text" class="form-control" placeholder="HPP" value="" name="harga_promo" id="harga_promo" readonly="true"/>
											</div>

										</div>
										<div class="col-md-6">
											<div class="form-group">
												<br> <br>  
												<div onclick="lock_perawatan()" id="lock_perawatan"  class="btn btn-primary" style="margin-right:5px">Simpan</div>
											</div>
										</div>
									</div>
								</div> 


								
							</div>
						</div>
					</div> <!-- //row -->
				</div>

				