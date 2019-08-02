
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Data Koperasi</li>
	</ol>
</div>

<div class="clearfix"></div>
<div class="container">
	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Transaksi Layanan </span>
					<br><br>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<table id="tabel_daftar" class="table table-bordered table-striped">

							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Kode Layanan</th>
									<th>Nama Customer</th>
									<th>Status</th>
									<th>Petugas</th>
									<th >Total</th>
									<th class="act">Action</th>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<div class="btn-group">
												<a href="<?php echo base_url('daftar_transaksi/detail')?>" id="edit" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle btn-success"><i class="fa fa-eye"></i></a>
											</div>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Jam</th>
										<th>Kode layanan</th>
										<th>Nama Customer</th>
										<th>Status</th>
										<th>Petugas</th>
										<th>Total</th>
										<th class="act">Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

	</script>