
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
					<span class="pull-left" style="font-size: 24px">Daftar Transaksi Layanan</span>
					<br><br>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<form id="pencarian_form" method="post" style="margin-left: 18px;" class="form-horizontal" target="_blank">

							<div class="row">
								<div class="col-sm-3 col-md-2 filter_bulan">
									<select class="form-control" id="bulan">
										<option value="">-- Pilih Bulan --</option>
										<option value="01">Januari</option>
										<option value="02">Februari</option>
										<option value="03">Maret</option>
										<option value="04">April</option>
										<option value="05">Mei</option>
										<option value="06">Juni</option>
										<option value="07">Juli</option>
										<option value="08" >Agustus</option>
										<option value="09">September</option>
										<option value="10">Oktober</option>
										<option value="11">Nopember</option>
										<option value="12">Desember</option>
									</select>
								</div>
								<div class="col-sm-3 col-md-2 filter_bulan">
									<select class="form-control" id="tahun">
										<option value="">-- Pilih Tahun --</option>
										<option value="2008">2008</option>
									</select>
								</div>
								<div class=" col-md-1">
									<div class="input-group">
										<button type="button" class="btn btn-success btn_cari" onclick="cari_transaksi()"><i class="fa fa-search"></i> Cari</button>
									</div>
								</div>
							</div>
						</form>

						<div id="cari_layanan"><br><br>
							<div>
								<label><h4><strong>Total Transaksi Layanan : 2</strong></h4></label><br />
								<span><label><h4><strong>Total Nominal Layanan :Rp 640.000,00</strong></h4></label></span>
							</div>

							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Nominal</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>  
									<tr>
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
										<th>Nominal</th>
										<th>Action</th>
									</tr>
								</tfoot>  
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">

</script>