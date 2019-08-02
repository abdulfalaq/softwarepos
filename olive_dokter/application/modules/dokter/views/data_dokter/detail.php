
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Merchant</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Merchant </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Merchant </span>
					<a href="<?php echo base_url('setting/mercant/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/mercant'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Detail merchant</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode merchant</label>
										<input readonly="true" type="text"  class="form-control" placeholder="Kode Transaksi" name="kode_merchant" id="kode_merchant" />
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama merchant</label>
										<input readonly="true" type="text" class="form-control" placeholder="Nama merchant"  name="nama_merchant" id="nama_merchant"/>
									</div>
								</div>

								<div class="col-md-6">
									<label>Tanggal Awal merchant</label>
									<input readonly="true" type="text" class="form-control" name="tgl_awal" id="tgl_awal" />
								</div>
								<div class="col-md-6">
									<label>Tanggal Akhir merchant</label>
									<input readonly="true" type="text" class="form-control" name="tgl_akhir" id="tgl_akhir"  />
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
						<div id="bottom">
							<div class="sukses" ></div>
							<div class="box-body">
							</div>

							<div id="list_transaksi_pembelian">
								<div class="box-body">
									<table id="datatable" class="table table-bordered table-striped" style="font-size:1.0em;">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode</th>
												<th>Nama</th>
												<th>Diskon</th>
											</tr>
										</thead>
										<tbody>

											<tr>
												<td>1</td>
												<td>PR004</td>
												<td>potong kuku</td>
												<td>30</td>
											</tr>
											<tr>
												<td>2</td>
												<td>PR004</td>
												<td>Pembersih Wajah</td>
												<td>10000</td>
											</tr>
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