<style type="text/css">
.bg-yellow {
	border-color: #c49f47 !important;
	background-image: none !important;
	background-color: #c49f47 !important;
	color: #FFFFFF !important;
}
.bg-red {
	border-color: #cb5a5e !important;
	background-image: none !important;
	background-color: #cb5a5e !important;
	color: #FFFFFF !important;
}
.bg-blue {
	border-color: #3598dc !important;
	background-image: none !important;
	background-color: #3598dc !important;
	color: #FFFFFF !important;
}
.bg-purple {
	border-color: #8e5fa2 !important;
	background-image: none !important;
	background-color: #8e5fa2 !important;
	color: #FFFFFF !important;
}
.purple.btn {
	color: #FFFFFF;
	background-color: #8e5fa2;
}
.bg-red {
	border-color: #cb5a5e !important;
	background-image: none !important;
	background-color: #cb5a5e !important;
	color: #FFFFFF !important;
}
.bg-green {
	border-color: #26a69a !important;
	background-image: none !important;
	background-color: #26a69a !important;
	color: #FFFFFF !important;
}
.yellow.btn {
	color: #FFFFFF;
	background-color: #c49f47;
}
.blue.btn {
	color: #FFFFFF;
	background-color: #3598dc;
}
.red.btn {
	color: #FFFFFF;
	background-color: #cb5a5e;
}
.yellow.btn {
	color: #FFFFFF;
	background-color: #c49f47;
}
body{
	background-color: #e4feff;
}

.form_shadow{
	background-color: white;
	padding: 20px;
	box-shadow: 0px 2px 8px grey;
}

td, th, tr{
	border:solid 1px #217377 !important;
}

.table-bordered{
	border:solid 1px #217377 !important;
}
.btn-shadow{
	box-shadow: 0px 2px 5px #c9c9c9;
}
.box-pannel{
	padding: 5px !important;
	padding-left: 15px !important;
	padding-right: 10px !important;
	box-shadow: 0px 2px 6px grey;
}
.ps {
	width: 20%;
	float: left;
}
.sf {
	margin: 10px;
}
.table-bordered{
	border:solid 1px #217377 !important;
}
</style>

<?php 
$kode = $this->uri->segment(4);

$this->db->from('clouoid1_olive_cs.transaksi_reservasi reservasi');
$this->db->join('clouoid1_olive_master.master_member member','member.kode_member = reservasi.kode_member','left');
$this->db->where('reservasi.kode_reservasi',$kode);
$get_reservasi = $this->db->get()->row();
?>

<a href="<?php echo base_url('registrasi_pelayanan'); ?>"><button class="button-back"></button></a>

<div class="clearfix"></div>
<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-12">			
			<div class="col-md-7">
				<div class="form_shadow" style="margin-top: 10px;padding: 0px">
					<form id="form_ambil_paket">
						<div class="panel panel-default">
							<div class="panel-heading text-left" style="background-color: #2f898e;color: white;">
								<h4>AMBIL PAKET</h4>
							</div>
							<div class="panel-body">
								<div class="row">
									<form>
										<div class="row sf">
											<div class="col-md-5">
												<label>Kode Reservasi</label>
												<input type="text" class="form-control" value="<?php echo $get_reservasi->kode_reservasi ?>" readonly="" name="kode_reservasi" id="kode_reservasi">
											</div>
											<div class="col-md-7">
												<label>Tanggal Transaksi</label>
												<input type="text" class="form-control" value="<?php echo tanggalIndo($get_reservasi->tanggal_transaksi) ?>" readonly="" id="nama_customer">
											</div>
										</div>
										<div class="row sf">
											<div class="col-md-12">
												<label>Customer</label>
												<input type="text" class="form-control" readonly=""  value="<?php echo $get_reservasi->nama_member ?>" id="nama_customer">
												<input type="hidden" class="form-control" readonly=""  value="<?php echo $get_reservasi->kode_member ?>" name="kode_member">
											</div>
										</div><br>
										<div class="row sf">
											<div class="col-md-12">
												<table style="white-space: nowrap;" id="data" class="table table-bordered  table-hover">
													<thead>
														<tr>
															<th style="background-color:#229fcd; color:white" class="text-left" width="50px">No.</th>
															<th style="background-color:#229fcd; color:white" class="text-left" >Item</th>
															<th style="background-color:#229fcd; color:white" class="text-left" >QTY</th>
															<th style="background-color:#229fcd; color:white" class="text-left" width="150px">QTY Terambil</th>
															<th style="background-color:#229fcd; color:white" class="text-left" width="150px">QTY Diambil</th>
															<th style="background-color:#229fcd; color:white" class="text-left" >QTY Sisa</th>
														</tr>
													</thead>
													<tbody>
														<?php 
														$no = 0;
														$this->db->from('clouoid1_olive_cs.opsi_transaksi_reservasi opsi');
														$this->db->select('paket.nama_paket');
														$this->db->select('perawatan.nama_perawatan');
														$this->db->select('opsi.qty_item,opsi.qty_sisa,opsi.qty_diambil,opsi.id,opsi.status');
														$this->db->join('clouoid1_olive_master.master_paket paket','paket.kode_paket = opsi.kode_item','left');
														$this->db->join('clouoid1_olive_master.master_perawatan perawatan','perawatan.kode_perawatan = opsi.kode_item','left');
														$this->db->where('opsi.kode_reservasi',$kode);
														$this->db->where('opsi.status','proses');
														$get_opsi = $this->db->get()->result();
														foreach ($get_opsi as $value) { $no++; ?>
														<tr>
															<td><?php echo $no; ?></td>
															<td><?php echo $value->nama_paket; echo $value->nama_perawatan ?></td>
															<td>
																<input type="text"  readonly value="<?php echo $value->qty_item ?>"  class="form-control" id="qty_item_<?php echo $value->id ?>">
															</td>
															<td>
																<input type="text"  required readonly value="<?php echo $value->qty_diambil ?>" class="form-control" id="qty_terambil_<?php echo $value->id ?>">
															</td>
															<td>
																<input type="text"  required onkeyup="qty_terambil('<?php echo $value->id ?>')" class="form-control" name="qty_diambil_<?php echo $value->id ?>" id="qty_diambil_<?php echo $value->id ?>">
															</td>
															<td>
																<input type="text"  readonly value="<?php echo $value->qty_sisa ?>" class="form-control" name="qty_sisa_<?php echo $value->id ?>" id="qty_sisa_<?php echo $value->id ?>">
																<input type="hidden"  readonly value="<?php echo $value->qty_sisa ?>" class="form-control" id="qty_sisa_default_<?php echo $value->id ?>">
																<input type="hidden"  readonly value="<?php echo $value->status ?>" class="form-control" name="status_<?php echo $value->id ?>" id="status_<?php echo $value->id ?>">
															</td>
														</tr>
														<?php }
														?>


													</tbody>
												</table>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<button type="submit" class="btn btn-success btn-no-radius btn-shadow btn-lg pull-right" style="margin-right: 20px">Simpan</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
			<div  class="col-md-5" id="tabel3">
				<div class="row" style="margin-bottom: 8px">
					<div class="ps text-center">
						<a href="<?php echo base_url().'registrasi_pelayanan'; ?>">
							<img src="<?php echo base_url(''); ?>assets/images/icon/I3.png" style="width: 55px;max-height: 55px;margin-bottom:7px">
							<label style="font-size: 10px">REGISTER PELAYANAN</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/tambah_customer'; ?>">
							<img  src="<?php echo base_url(); ?>assets/images/icon/I2.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">TAMBAH CUSTOMER</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/akun_customer'; ?>">
							<img src="<?php echo base_url(); ?>assets/images/icon/I1.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">AKUN CUSTOMER</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/order_paket'; ?>">
							<img src="<?php echo base_url(); ?>assets/images/icon/I4.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">ORDER PAKET</label>
						</a>
					</div>
					<div class="ps text-center">	
						<a href="<?php echo base_url().'registrasi_pelayanan/layanan_paket'; ?>">
							<img src="<?php echo base_url(); ?>assets/images/icon/list transaksi.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
							<label style="font-size: 10px">DATA PAKET</label>
						</a>
					</div><hr>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading text-left" style="background-color: #2f898e;color: white;">
						<h4>DATA PAKET</h4>
					</div>
					<div class="panel-body">
						<div class="row">
							<div style="padding: 15px;margin-top: 0px">
								<table class="table table-striped table-bordered" id="datatable" style="font-size: 12px;padding: 0 !important">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Transaksi</th>
											<th>Nama Customer</th>
											<th>Tanggal Order</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=0;
										$this->db->from('clouoid1_olive_cs.transaksi_reservasi');
										$this->db->join('clouoid1_olive_master.master_member','master_member.kode_member = clouoid1_olive_cs.transaksi_reservasi.kode_member', 'left');
										$this->db->where('clouoid1_olive_cs.transaksi_reservasi.status','menunggu');
										$get_gudang = $this->db->get()->result();
										foreach ($get_gudang as $value) { $no++;?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $value->kode_reservasi ?></td>
											<td><?php echo $value->nama_member ?></td>
											<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
											<td>
												<a class="btn btn-no-radius btn-info" href="<?php echo base_url('registrasi_pelayanan/ambil_paket/detail/'.$value->kode_reservasi) ?>" ><i class="fa fa-check"></i></a>
											</td>
										</tr>
										<?php }
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$("#form_ambil_paket").submit( function() {  
		$.ajax({
			type: 'POST',
			url: "<?php echo base_url('registrasi_pelayanan/ambil_paket/simpan_ambil_data') ?>",
			data: $(this).serialize(),
			dataType: 'Json',
			beforeSend: function(){
				$('.tunggu').show();
			},
			success: function(data){
				$('.tunggu').hide();
				if (data.response == 'sukses') {
					$('.alert_berhasil').show();
					setTimeout(function(){ window.location = "<?php echo base_url('registrasi_pelayanan/order_paket') ?>" }, 1500);
				}else{
					alert('Sorry, Gagal Menyimpan data. Terjadi Kesalahan Pada Data.');
				}
			}
		});
		return false;
	});

	function qty_terambil(id){
		qty_item 		= $('#qty_item_'+id).val();
		qty_diambil 	= $('#qty_diambil_'+id).val();
		qty_sisa 		= $('#qty_sisa_'+id).val();
		qty_sisa_default= $('#qty_sisa_default_'+id).val();

		if (parseInt(qty_diambil) > parseInt(qty_sisa)) {
			alert('QTY Yang Diambil Melebihi QTY Sisa');
			$('#qty_diambil_'+id).val('');
		}

	// if (parseInt(qty_diambil) > parseInt(qty_item)) {
	// 	alert('QTY Yang Diambil Melebihi QTY Item');
	// 	$('#qty_diambil_'+id).val('');
	// }else if(parseInt(qty_diambil) < 0){
	// 	alert('QTY Yang Diambil Kurang Dari Nol');
	// 	$('#qty_diambil_'+id).val('');
	// }else if(isNaN(qty_diambil)){
	// 	$('#qty_sisa_'+id).val(qty_sisa_default);
	// }else if(qty_diambil == ''){
	// 	$('#qty_sisa_'+id).val(qty_sisa_default);
	// }else{
	// 	total_sisa = parseInt(qty_item) - parseInt(qty_diambil);
	// 	$('#qty_sisa_'+id).val(total_sisa);
	// 	if (parseInt(total_sisa) == 0) {
	// 		$('#status_'+id).val('selesai');
	// 	}else{
	// 		$('#status_'+id).val('proses');
	// 	}
	// }
}
</script>