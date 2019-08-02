
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
	<h1>Master </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Promo </span>
					<a href="<?php echo base_url('setting/promo/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/promo/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Detail Promo</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Promo</label>
										<input readonly="true" type="text" value="p324" class="form-control" placeholder="Kode Transaksi" name="kode_promo" id="kode_promo" />
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Promo</label>
										<input readonly="true" type="text" class="form-control" placeholder="Nama Promo" value="Promo Natal" name="nama_promo" id="nama_promo"/>
									</div>
								</div>

								<div class="col-md-6">
									<label>Tanggal Awal Promo</label>
									<input readonly="true" type="text" class="form-control" name="tgl_awal" id="tgl_awal" value="08 Desember 2017" />
								</div>


								<div class="col-md-6">
									<label>Tanggal Akhir Promo</label>
									<input readonly="true" type="text" class="form-control" name="tgl_akhir" id="tgl_akhir" value="25 Desember 2017" />
								</div>
								<div class="col-md-6">

									<label>Status</label>
									<select disabled="" class="form-control" name="status" id="status">

										<option value="">--Pilih Status--</option>
										<option selected value="1" >Aktif</option>
										<option  value="0" >Nonaktif</option>
									</select> 
								</div>
							</div>

						</div> 
						<br>
						<br>
						<br>

						<div id="bottom" hidden="">
							<div class="sukses" ></div>
							<div class="box-body">

							</div>

							<div id="list_transaksi_pembelian">
								<div class="box-body">
									<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.5em;">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode</th>
												<th>Nama</th>
												<th>Diskon</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
										<tfoot>

										</tfoot>
									</table>
								</div>
							</div>



						</div>
						<div class="box-footer clearfix">

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>