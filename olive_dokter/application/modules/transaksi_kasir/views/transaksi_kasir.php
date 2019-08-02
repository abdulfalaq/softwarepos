
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
					<span class="pull-left" style="font-size: 24px">Daftar Transaksi Kasir </span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<form id="pencarian_form" method="post" style="margin-left: 18px;" class="form-horizontal" target="_blank">

						<div class="row">
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="date" class="form-control tgl" id="tgl_awal" />
								</div>
							</div>
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="date" class="form-control tgl" id="tgl_akhir" />
								</div>
							</div>

							<div class=" col-md-4">
								<div class="input-group">
									<button type="button" class="btn btn-success" onclick="cari_transaksi()"><i class="fa fa-search"></i> Cari</button>

								</div>
							</div>
						</div>
						<br>
					</form>
					<br>
					<table style="font-size: 1.0em;" id="tabel_daftar" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Transaksi</th>
								<th>Tanggal</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Petugas</th>
								<th>Saldo Awal</th>
								<th>Saldo Akhir</th>
								<th>Nominal Penjualan</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr class="">
								<td>1</td>
								<td>KAS_20180209020108</td>
								<td>09 Februari 2018</td>
								<td>14:01:08</td>
								<td></td>
								<td>astro</td>
								<td>Rp 0,00</td>
								<td>Rp 0,00</td>
								<td>Rp 0,00</td>
								<td>close</td>
								<td align="center">
									<div class="btn-group">
										<a href="<?php echo base_url('transaksi_kasir/detail'); ?>" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i> </a>
									</div>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Kode Transaksi</th>
								<th>Tanggal</th>
								<th>Check In</th>
								<th>Check Out</th>
								<th>Petugas</th>
								<th>Saldo Awal</th>
								<th>Saldo Akhir</th>
								<th>Nominal Penjualan</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

</script>
