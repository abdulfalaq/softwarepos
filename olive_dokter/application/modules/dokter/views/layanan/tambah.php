
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
	<h1>Layanan Periksa</h1>

	<?php $this->load->view('menu_setting'); ?>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Layanan Periksa </span>
					<a href="<?php echo base_url('setting/layanan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/layanan'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
					<div class="box-body">
						<div class="notif_nota" ></div>
						<label><h3><b>Layanan Periksa</b></h3></label>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Kode Periksa</label>
									
									<input type="text" value="" class="form-control" placeholder="Kode " name="kode_periksa" id="kode_periksa" />
								</div>

								<div class="form-group">
									<label class="gedhi"><b>Harga Periksa</label>
										<div class="input-group">
											<span class="input-group-addon rp_harga">Rp 0,00</span>
											<input type="number" class="form-control input-group" onkeyup="get_nominal_harga()" name="harga_periksa" id="harga_periksa" value="" />
										</div>
									</div>


								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Periksa</label>
										<input type="text" class="form-control" placeholder="Nama Periksa" value="" name="nama_periksa" id="nama_periksa"/>
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


								<div class="col-md-12" align="right">
									<div class="form-group">
										<br> <br>  
										<div onclick="simpan_all()"   class="btn btn-primary" style="margin-right:5px">Simpan</div>
									</div>
								</div>
							</div>
						</div> 

						<div class="box-footer clearfix">

						</div>
					</form>


				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>
