
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Pendaftaran layanan</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Reservasi</span>
					<br><br>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<label><h3><b>Detail Transaksi</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Transaksi</label>



										<input readonly="true" type="text" value="RES_030218144936_8" class="form-control" placeholder="Kode Transaksi" name="kode_reservasi" id="kode_reservasi" />
									</div>

									<div class="form-group">
										<label class="gedhi">Kode Customer</label>
										<input type="text" value="20171209001" readonly="true" class="form-control"  name="kode_member" id="kode_member"/>
									</div>


								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Tanggal Transaksi</label>
										<input type="text" value="03 Februari 2018" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_transaksi" id="tanggal_transaksi"/>
									</div>

									<div class="form-group">
										<label>Nama Customer</label>
										<input readonly="true" type="text" value="Ihsan" class="form-control" placeholder="Nota Referensi" name="nama_member" id="nama_member" />
									</div>
								</div>
							</div>
						</div> 

						<div id="list_transaksi_reservasi">
							<div class="box-body">
								<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Paket</th>
											<th>Nama Paket</th>
											<th>Kode Item</th>
											<th>Nama Item</th>
											<th>Qty</th>
										</tr>
									</thead>
									<tbody id="tabel_temp_data_transaksi">

										<tr>
											<td>1</td>
											<td></td>
											<td></td>
											<td>TRT_101017154024_1</td>
											<td>Acne Treatment</td>
											<td>1</td>
										</tr>
									</tbody>
									<tfoot>

									</tfoot>
								</table>
							</div>
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

