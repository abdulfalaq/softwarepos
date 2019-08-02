
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
					<span class="pull-left" style="font-size: 24px">Detail Perawatan </span>
					<a href="<?php echo base_url('setting/perawatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/perawatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<label><h3><b>Detail Perawatan</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Perawatan</label>

										<input readonly="true" type="text" value="TRT_231017121148_1" class="form-control" placeholder="Kode Transaksi" name="kode_pembelian" id="kode_pembelian" />
									</div>


									<div class="form-group">
										<label>Nama Perawatan</label>

										<input readonly="true" type="text" value="segar" class="form-control" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" />
									</div>


								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Harga Perawatan</label>
										<input type="text" value="Rp 10.000,00" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_pembelian"/>
									</div>

									<div class="form-group">
										<label>Status</label>
										<select class="form-control" disabled="" >
											<option>Aktif</option>
										</select>
									</div>
								</div> 

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Insentif Terapis</label>
										<input type="text" value="Rp 4.500,00" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_pembelian" id="tanggal_pembelian"/>
									</div>
								</div> 

							</div>
						</div> 

						<div id="list_transaksi_pembelian">
							<div class="box-body">
								<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th>Nama</th>
											<th>Jumlah</th>
											<th>HPP</th>
										</tr>
									</thead>
									<tbody id="tabel_temp_data_transaksi">

										<tr>
											<td>1</td>
											<td>BB0001</td>
											<td>Scrup Pemutih</td>
											<td>1</td>
											<td>Rp 9.000,00</td>
										</tr>
										<tr>
											<td>2</td>
											<td>P0001</td>
											<td>Handuk</td>
											<td>1</td>
											<td>Rp 15.000,00</td>
										</tr>

									</tbody>
									<tfoot>

									</tfoot>
								</table>
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