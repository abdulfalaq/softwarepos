<?php 
$tanggal = $this->uri->segment(4);
$this->db->where('tanggal_transaksi',$tanggal);
$this->db->where('status', 'selesai');
$this->db->order_by('kode_transaksi','desc');
$this->db->group_by('kode_transaksi');
$this->db->from('clouoid1_olive_kasir.transaksi_layanan');
$this->db->join('clouoid1_olive_master.master_member', 'clouoid1_olive_kasir.transaksi_layanan.kode_member = clouoid1_olive_master.master_member.kode_member', 'left');
$get_transaksi = $this->db->get()->result();
$total_nominal=0;
$total_nominal_tunai=0;
$total_nominal_debit=0;
$total_nominal_kredit=0;
foreach ($get_transaksi as $value) { 
	$total_nominal +=$value->grand_total;
	if($value->jenis_transaksi=='tunai'){
		$total_nominal_tunai +=$value->grand_total;
	}elseif ($value->jenis_transaksi=='debit') {
		$total_nominal_debit +=$value->grand_total;
	}elseif ($value->jenis_transaksi=='kredit') {
		$total_nominal_kredit +=$value->grand_total;
	}
}
?>
<!-- back button -->
<a href="<?php echo base_url('daftar_transaksi'); ?>"><button class="button-back"></button></a>
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
						<!--<div class="row">
							<div class="col-md-2 pull-right">
								<button style="margin-left: 5px" type="button" id="cetak_penjualan" class="btn btn-info pull-right"><i class="fa fa-print"></i> Print</button><br><br>
							</div>
						</div>-->
						<br>
						<div id="cari_layanan">
							<div>
								<table style="width: 100%">
									<tr>
										<th>Total Transaksi Layanan</th>
										<th> : <?php echo count($get_transaksi);?></th>
										<th>Total Nominal Debit </th>
										<th> : <?php echo format_rupiah($total_nominal_debit);?></th>
									</tr>
									<tr>
										<th>Total Nominal Layanan</th>
										<th> : <?php echo format_rupiah($total_nominal);?></th>
										<th>Total Nominal Kredit  </th>
										<th> : <?php echo format_rupiah($total_nominal_kredit);?></th>
									</tr>
									<tr>
										<th>Total Nominal Tunai</th>
										<th> : <?php echo format_rupiah($total_nominal_tunai);?></th>
									</tr>
								</table>
								<br>
								<table id="tabel_daftar" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Transaksi</th>
											<th>Tanggal Transaksi</th>
											<th>Nama Member</th>
											<th>Jenis Diskon</th>
											<th>Diskon Persen</th>
											<th>Grand Total</th>
											<th>Jenis Transaksi</th>
											<th class="act">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 0;
										foreach ($get_transaksi as $value) { 
											$no++; ?>
											<tr>
												<td><?php echo $no ?></td>
												<td><?php echo $value->kode_transaksi ?></td>
												<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
												<td><?php echo $value->nama_member ?></td>
												<td><?php echo $value->jenis_diskon?></td>
												<td><?php  
												if($value->jenis_diskon == 'persen'){
													echo $value->diskon_persen.'%';
												}else{
													echo format_rupiah($value->diskon_rupiah);
												} ?></td>
												<td align="right"><?php echo format_rupiah($value->grand_total)?></td>
												<td><?php echo $value->jenis_transaksi?></td>
												<td align="center" class="act">
													<div class="btn-group">
														<a href="<?php echo base_url('daftar_transaksi/info/'.$value->kode_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle btn-primary"><i class="fa fa-eye"></i> Detail</a>
														<a href="<?php echo base_url('daftar_transaksi/batal_transaksi/'.$value->kode_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle btn-danger"><i class="fa fa-ban"></i> Batal</a>
														<a onclick="print_invoice('<?php echo $value->kode_transaksi ?>')" class="btn btn-info">
															<i class="fa fa-print"> </i> Print</a>
														</div>
													</td>
												</tr>
												<?php }
												?>
											</tbody>          
											<tfoot>
												<tr>
													<th>No</th>
													<th>Kode Transaksi</th>
													<th>Tanggal Transaksi</th>
													<th>Nama Member</th>
													<th>Jenis Diskon</th>
													<th>Diskon Persen</th>
													<th>Grand Total</th>
													<th>Jenis Transaksi</th>
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
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function print_invoice(key){
			var kode_transaksi=key;
			$.ajax({
				url: '<?php echo base_url('kasir/print_invoice'); ?>',
				type: 'post',
				data:{kode_transaksi:kode_transaksi},
				success: function(hasil){

				}
			});
		}
	</script>