<?php 
$kode_transaksi=$this->uri->segment(3);
$this->db->where('kode_transaksi',$kode_transaksi);
$get_transaksi = $this->db->get('transaksi_layanan')->row();
?>
<!-- back button -->
<a href="<?php echo base_url('daftar_transaksi/daftar_transaksi/detail/'.$get_transaksi->tanggal_transaksi); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('daftar_transaksi'); ?>"> Data Transaksi</a></li>
		<li>Daftar Trasaksi</li>
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
						<form id="data_form" action="" method="post">
							<div class="box-body">
								<div class="row">
									<div class="col-md-4">
										<div class="box-body">
											<div class="callout callout-info">
												<span style="font-weight:bold; font-size:1em;"><i class="fa fa-barcode"></i>&nbsp;&nbsp;&nbsp; Kode Layanan &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</span>
												<span><?php echo $get_transaksi->kode_transaksi;?></span>
											</div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="box-body">
											<div class="callout callout-info">
												<span style="font-weight:bold;font-size:1em;"><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp; Tanggal Transaksi &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</span>
												<span><?php echo $get_transaksi->tanggal_transaksi;?></span>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="callout callout-info">
												<span style="font-weight:bold;font-size:1em;"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp; Kode Member &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;</span>
												<span><?php echo $get_transaksi->kode_member;?></span>
											</div>
										</div>
									</div>
									<br><br><br>
									<div class="col-md-4">
										<div class="box-body">
											<div class="callout callout-info">
												<span style="font-weight:bold;font-size:1em;"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;&nbsp; Jenis Diskon &nbsp; : &nbsp;&nbsp;</span>
												<span><?php echo $get_transaksi->jenis_diskon;?></span>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="callout callout-info">
												<span style="font-weight:bold;font-size:1em;"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp; Diskon Persen &nbsp; : &nbsp;&nbsp;</span>
												<span><?php echo $get_transaksi->diskon_persen;?></span>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="box-body">
											<div class="callout callout-info">
												<span style="font-weight:bold;font-size:1em;"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp; Status &nbsp; : &nbsp;&nbsp;</span>
												<span><?php echo $get_transaksi->status;?></span>
											</div>
										</div>
									</div>

								</div>
							</div> 
							<br><br>
							<?php 
							$kode_transaksi=$this->uri->segment(3);
							$this->db->where('kode_transaksi',$kode_transaksi);
							$get_total = $this->db->get('opsi_transaksi_layanan')->result();
							?>
							<div id="list_transaksi_pembelian">
								<div class="box-body">
									<div class="row">

									</div>
									<table style="font-size: 1em;" id="tabel_daftar" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Tindakan / Obat</th>
												<th>QTY</th>
												<th>Diskon</th>
												<th>Harga</th>
												<th>Subtotal</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$no = 0;
											foreach ($get_total as $value) { 
												$no++; ?>
												<tr>
													<td><?= $no ?></td>
													<td><?= $value->kode_item ?></td>
													<td><?= $value->qty ?></td>
													<td>
														Rp 0,00
													</td>
													<td align="right"><?=format_rupiah($value->harga) ?></td>
													<td align="right"><?=format_rupiah($value->subtotal) ?></td>
												</tr>
												
												<?php }
												?>
												<tr>
													<td colspan="3"></td>
													<td style="font-weight:bold;">Total</td>
													<td></td>
													<td align="right"><?= format_rupiah($get_transaksi->total_layanan) ?></td>
												</tr>
												<tr>
													<td colspan="3"></td>
													<td style="font-weight:bold;">Diskon (%)</td>
													<td id="tb_diskon"></td></td>
													<td align="right"><?= $get_transaksi->diskon_persen ?> %</td>
												</tr>

												<tr>
													<td colspan="3"></td>
													<td style="font-weight:bold;">Diskon (Rp)</td>
													<td id="tb_diskon_rupiah"></td>
													<td align="right"><?= format_rupiah($get_transaksi->diskon_rupiah) ?></td>
												</tr>

												<tr>
													<td colspan="3"></td>
													<td style="font-weight:bold;">Grand Total</td>
													<td id="tb_grand_total"></td>
													<td align="right"><?= format_rupiah($get_transaksi->grand_total) ?></td>
												</tr>
											</tbody>
											<tfoot>

											</tfoot>
										</table>
									</div>
								</div>
								<br>
								<div class="box-footer">
								</div>
							</form>


						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="clearfix">
		</div>
