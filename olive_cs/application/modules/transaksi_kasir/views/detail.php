
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Transaksi Kasir</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Transaksi Kasir </span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<form id="data_form">  
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-md-5">
									<label>Kode Kasir</label>
									<input readonly="true"  id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" />

								</div>
								<div class="form-group  col-md-5">
									<label>Tanggal</label>
									<input readonly="true"  type="text" class="form-control" />

								</div>
								<div class="form-group  col-md-5">
									<label>Check In</label>
									<input readonly="true" type="text" class="form-control" />

								</div>
								<div class="form-group  col-md-5">
									<label>Check Out</label>
									<input readonly="true"  type="text" class="form-control" />

								</div>
								<div class="form-group  col-md-5">
									<label>Petugas</label>
									<input readonly="true"  type="text" class="form-control" />
								</div>
							</div>

							<div class="row">   
								<div class="form-group  col-md-5">
									<label>Jumlah Transaksi Tunai</label>
									<input readonly="true" type="text" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Jumlah Transaksi Credit</label>
									<input readonly="true" type="text" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Jumlah Transaksi Debit</label>
									<input readonly="true"  type="text" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Total Nominal</label>
									<input readonly="true"  type="text" class="form-control" />
									<input readonly="true"  type="hidden" name="nominal_penjualan" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Saldo Awal</label>
									<input readonly="true"  type="text" class="form-control" />

								</div>

								<div class="form-group  col-md-5">
									<label>Saldo Laporan Kasir</label>
									<input readonly="true"  type="text" class="form-control" />
								</div>

								<div class="form-group  col-md-5">
									<label>Saldo Sebenarnya</label>
									<input readonly="true"  type="text" class="form-control" />

								</div>
								<div class="form-group col-md-5">
									<label>Selisih</label>
									<input readonly="true" type="text"  class="form-control" name="selisih" id="dp" />
								</div>
								<div class="form-group ombo" style="margin-left: 18px;">
									<input type="hidden"  class="form-control" name="petugas" />
									<input type="hidden"  class="form-control" name="check_out" />
									<input type="hidden"  class="form-control" name="status" />
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary">Validasi</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

</script>
