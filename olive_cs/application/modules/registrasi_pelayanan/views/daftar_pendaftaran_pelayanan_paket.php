
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Master</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Daftar Pendaftaran Pelayanan Paket</span>
						<br><br>
					</div>

					<div class="panel-body">                   
						<div class="box-body">            
							<div class="sukses" ></div>
							<br>
							<div id="cari_transaksi">
								<table class="table table-striped table-hover table-bordered" id="tabel_daftar">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal transaksi</th>
											<th>Kode Transaksi</th>
											<th>Nama Customer</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="scroll_data">
										<tr>
											<td>1</td>
											<td>02 November 2017</td>
											<td>RES_021117132921_1</td>
											<td>Arda</td>

											<td align="center">
												<a href="<?php echo base_url('registrasi_pelayanan/detail'); ?>" style="padding:3.5px;"  data-toggle="tooltip" title="Proses" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"> </i></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<input type="hidden" class="form-control rowcount" value="0">
							<input type="hidden" class="form-control pagenum " value="0">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>