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
.ps {
	width: 20%;
	float: left;
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
.box-girl{
	background-color: #ff01cc;
	box-shadow: 0px 2px 7px #cbcbcb;
	transition:all 0.4s;
}

.dataTables_filter {
	margin-right:10px;
}
</style>

<a href="<?php echo base_url('registrasi_pelayanan'); ?>"><button class="button-back"></button></a>

<div class="clearfix"></div>
<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-12">			
			<div class="col-md-7" style="padding: 0 10px">
				<div class="form_shadow" style="margin-top: 10px;padding: 0px">
					<div class="panel panel-default">
						<div class="panel-heading text-left" style="background-color: #2f898e;color: white;">
							<h4>ORDER PAKET</h4>
						</div>
						<div class="panel-body">
							<h4 style="background-color: #62b52a;color: white;padding: 15px; box-shadow: 1px 2px 5px #5c5c5c;">TAMBAH</h4><br>
							<div class="row" style="margin-right: 10px">
								<div class="col-md-10">
									<div class="col-md-4" style="padding-left: 0px ;padding-right:5px;margin-bottom: 0px">
										<label style="font-size: 12px;margin-bottom: 0px">Kode Transaksi</label>
										<input type="text" readonly value="<?php echo 'PKT_'.date('ymdhis') ?>" id="kode_transaksi" class="form-control" name="">
									</div>
									<div class="col-md-8" style="padding-right: 0px; padding-left:5px;margin-bottom: 0px">
										<label style="font-size: 12px;margin-bottom: 0px">Jenis Reverensi</label>
										<select class="form-control select2" id="jenis_transaksi" required="">
											<option value="Paket" selected>Paket</option>
											<option value="Treatment">Treatment</option>
										</select> 
									</div>
									<div class="col-md-10" style="padding-left:5px;margin-bottom: 0px">
										<label style="font-size: 12px;margin-bottom: 0px;margin-top:5px">Pilih Customer</label>
										<select  class="form-control select2" id="kode_member" onchange="get_member_name()">
											<option value="">--Pilih Customer--</option>
											<?php
											$member = $this->db->get_where('olive_master.master_member',array('status_member' => '1'));
											$member = $member->result();
											?>
											<?php foreach($member as $daftar){ ?>
											<option value="<?php echo $daftar->kode_member ?>"><?php echo $daftar->kode_member ?> - <?php echo $daftar->nama_member ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-2" style="padding: 0">
										<a onclick="Profil()">
											<div id="profil" class="btn btn-md btn-primary btn-no-radius btn-shadow" style="width: 100%;margin-top: 20px;margin-bottom:  0px">PROFIL</div>
										</a>
									</div>					
								</div>
								<div class="col-md-2" style="padding: 0">
									<a onclick="simpan_member()" id="simpan_member" class="btn btn-md btn-danger btn-no-radius btn-shadow" style="width: 100%;margin-top: 17px;margin-bottom:  0px">LOCK</a>
									<a onclick="location.reload()" id="update_member"  class="btn btn-md btn-warning btn-no-radius btn-shadow" style="width: 100%;margin-top: 17px;margin-bottom: 0px; display: none;">Cancel</a>
									<a onclick="RekamMedis()">
										<div onclick="rekam_medis()" class="btn btn-md btn-primary btn-no-radius btn-shadow" style="width: 100%;margin-top: 20px;margin-bottom:  0px">REKAM MEDIS</div>
									</a>
								</div>
							</div>
							<hr><hr>
							<div id="tabel1">
								<table id="" class="table table-striped table-bordered table-advance table-hover">
									<tbody>
										<tr>
											<input type="text" name="id_penjualan" id="id_penjualan" value="" hidden/>
											<input type="hidden" name="id_temp" id="id_temp" value="" hidden/>
											<td width="93%" style="background-color:#229fcd;">
												<div class="select_paket" >
													<label  style="font-size: 12px;margin-bottom: 0px">Paket</label>
													<input type="hidden" name="kode_paket_lama" id="kode_paket_lama">
													<select name="kode_paket" id="kode_paket" disabled class="form-control select2">
														<option value="">--Pilih Paket</option>
														<?php
														$get_paket = $this->db->get('olive_master.master_paket')->result();
														foreach ($get_paket as $paket) {
															?>
															<option value="<?php echo $paket->kode_paket; ?>"><?php echo $paket->nama_paket; ?></option>
															<?php 
														} ?>
													</select>
												</div>
												<div class="select_treatment" style="display: none;">
													<label  style="font-size: 12px;margin-bottom: 0px">Treatment</label>
													<select name="kode_treatment" id="kode_treatment" class="form-control select2" style="width:100%">
														<option value="">--Pilih Treatment</option>
														<?php
														$get_perawatan = $this->db->get('olive_master.master_perawatan')->result();
														foreach ($get_perawatan as $perawatan) {
															?>
															<option value="<?php echo $perawatan->kode_perawatan; ?>"><?php echo $perawatan->nama_perawatan; ?></option>
															<?php 
														} ?>
													</select>
												</div>
											</td>
											<td width="7%" style="background-color:#229fcd;padding-top:23px" >
												<a onclick="add_item()" id="add" class="btn btn-no-radius btn-info">Add</a>
												<a onclick="update_item()" id="update" style="display: none;" class="btn btn-warning pull-left">Update</a>
											</td>
										</tr>
									</form>
								</tbody>
							</table>

							<div class="tabel2">
								<table style="white-space: nowrap;" id="data" class="table table-bordered  table-hover">
									<thead>
										<tr>
											<th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
											<th style="background-color:#229fcd; color:white" class="text-center">Paket / Treatment</th>
											<th style="background-color:#229fcd; color:white" class="text-center" width="150px">Action</th>
										</tr>
									</thead>
									<tbody id="tabel_temp_data_transaksi">
										<tr>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
									<tfoot>
									</tfoot>
								</table>
							</div>
							<div>
								<a onclick="simpan_transaksi()" id="simpan" class="btn pull-right btn-lg btn-success btn-no-radius" style="width:20%"><i class="fa fa-check"></i> Simpan</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
						<div style="padding: 5px;margin-top: 0px">
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
									$this->db->from('olive_cs.transaksi_reservasi');
									$this->db->join('olive_master.master_member','master_member.kode_member = olive_cs.transaksi_reservasi.kode_member', 'left');
									$this->db->where('olive_cs.transaksi_reservasi.status','menunggu');
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
<input type="hidden" id="kode_member">
<div id="modal-RekamMedis" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" style="color: white;width: 85%">
		<div class="modal-content" style="border-radius:0px;background-color:#217377">
			<div class="modal-body" style="height: 640px ; padding: 30px">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center>
					<img src="<?php echo base_url(); ?>assets/images/logo_kasir/logo.png" style="width: 60px" alt="Olive">
					<h4 class="modal-title">OLIVE TREE</h4>
					<div class="btn-shadow" style="font-size: 18px;width: 300px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: #ff01cc">REKAM MEDIS CUSTOMER</div><br>
				</center>
				<div class="col-md-12">
					<div class="col-md-5">
					</div>
					<div class="col-md-5">
					</div>
					<div class="col-md-2">
					</div>
				</div>
				<div class="col-md-12" style="background-color: white;padding: 0;margin-left: 30px;width: 94%">
					<table width="100%" class="table_rekam_medis">
						<thead>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">TANGGAL TRANSAKSI</div>
							</td>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">TREATMENT / PRODUK</div>
							</td>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">QUANTITY</div>
							</td>
						</thead>
						<tbody id="data_rekam_medis" style="color: black;">

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal-Profil" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" style="color: white;width: 85%">
		<div class="modal-content" style="background-color: #2f898e;border-radius: 0px">
			<div class="modal-body" style="height: 90%; padding: 30px">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center>
					<img src="<?php echo base_url(); ?>assets/images/logo_kasir/logo.png" style="width: 60px" alt="Olive">
					<h4 class="modal-title">OLIVE TREE</h4>
					<div style="font-size: 18px;width: 300px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: #ff01cc;box-shadow:0px 5px 12px #1f5e62;">PROFIL CUSTOMER</div><br>
				</center>
				<div class="row" style="margin: 10px">
					<div class="col-md-12">
						<div class="col-md-2">
							<label style="font-size: 10px">Kode Customer</label>
							<input type="text" name="kode_customer" id="kode_customer" readonly="" class="form-control box-tosca">
						</div>
						<div class="col-md-8">
							<label style="font-size: 10px">Nama Customer</label>
							<input type="text" name="nama_customer" id="nama_customer" readonly class="form-control box-tosca">
						</div>
						<div class="col-md-2">
							<label style="font-size: 10px">Poin</label>
							<input type="text" name="poin" id="poin" readonly class="form-control box-tosca">
						</div>
					</div>
				</div>
				<div class="row" style="margin: 10px">
					<div class="col-md-6">
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">No. KTP / SIM</label>
							<input type="text" name="no_ktp" id="no_ktp" readonly class="form-control box-tosca" style="padding: 0px;padding-left:10px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Tempat Lahir</label>
							<input type="text" name="tempat_lahir" id="tempat_lahir" readonly class="form-control box-tosca" style="padding: 0px;padding-left:10px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Tanggal Lahir</label>
							<input type="date" name="tanggal_lahir" id="tanggal_lahir" readonly class="form-control box-tosca" style="padding: 0px;padding-left:10px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Jenis Kelamin</label>
							<select class="form-control box-tosca" id="jenis_kelamin" name="jenis_kelamin" disabled="">
								<option value="">-- Pilih Jenis Kelamin --</option>
								<option value="Laki-laki">Laki-Laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Alamat Customer</label>
							<input type="text" name="alamat" id="alamat" readonly class="form-control box-tosca" style="padding: 0px;padding-left:10px">
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">NO. Telp</label>
							<input type="text" name="no_telp" id="no_telp" readonly class="form-control box-tosca" style="padding: 0px;padding-left:10px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Pekerjaan</label>
							<input type="text" name="pekerjaan" id="pekerjaan" readonly class="form-control box-tosca" style="padding: 0px;padding-left:10px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Status Perkawinan</label>
							<select class="form-control box-tosca" id="status_perkawinan" name="status_perkawinan" disabled="">
								<option value="">-- Pilih --</option>
								<option value="Menikah">Menikah</option>
								<option value="Belum Menikah">Belum Menikah</option>
							</select>
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Kategori Customer</label>
							<select class="form-control box-tosca" id="kategori_customer" name="kategori_customer" disabled="">
								<option value="">-- Pilih --</option>
								<option value="Member">Member</option>
								<option value="Non Member">Non Member</option>
							</select>
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Status Customer</label>
							<select class="form-control box-tosca" disabled id="status_customer" name="status_customer">
								<option value="">-- Pilih --</option>
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".select2").select2();
	$(".debit").fadeOut(500);
	$(".jatuh_tempo").fadeOut(500);
	$(".form_promo").fadeOut(500);
	$(".form_merchant").fadeOut(500);

});

function simpan_member() {
	var kode_member = $("#kode_member").val();
	var jenis_transaksi = $("#jenis_transaksi").val();
	if (kode_member == '') {
		alert('Nama Customer Harus Diisi.');
	}else if(jenis_transaksi == '') {
		alert('Pilih transaksi !');
	}else{
		save_member();
	};
}

function Profil(){
	$('#modal-Profil').modal('show');
}

function save_member(){
	$('#kode_member').attr('disabled', true);
	$('#jenis_transaksi').attr('disabled', true);
	$("#kode_paket").attr('disabled', false);

	var jenis_transaksi = $("#jenis_transaksi").val();
	if(jenis_transaksi=='Paket'){
		$(".select_paket").show();
		$(".select_treatment").hide();
	}else{
		$(".select_paket").hide();
		$(".select_treatment").show();
	}
	$("#update_member").show();
	$("#simpan_member").hide();
}

function delete_member(){
	$('#kode_member').attr('disabled', true);
	$('#jenis_transaksi').attr('disabled', true);
	$("#kode_paket").attr('disabled', false);

	$(".select_paket").show();
	$(".select_treatment").hide();

	var kode_transaksi 	= $('#kode_transaksi').val();
	var kode_member 	= $('#kode_member').val();
	var url 			= "<?php echo base_url().'registrasi_pelayanan/order_paket/hapus_temp'; ?>";
	$.ajax({
		type: "POST",
		url: url,
		data: {kode_transaksi : kode_transaksi, kode_member : kode_member},
		beforeSend:function(){
			$(".tunggu").show();  
		},
		success: function(msg) {
			load_temp();
		}
	});
	return false;
	$("#update_member").hide();
	$("#simpan_member").show();
}

function get_member_name(){
	kode_member = $('#kode_member').val();
	$.ajax({
		url: "<?php echo base_url('registrasi_pelayanan/get_member'); ?>",
		type: 'post',
		data:{kode_member:kode_member},
		dataType:'Json',
		success: function(hasil){
			$(".tunggu").hide();
			$("#nama").text(hasil.nama_member);
			$("#profil").attr('disabled',false);
			$("#rekam").attr('disabled',false);
			$("#profil").attr('onclick','profile_cek()');
			$("#rekam").attr('onclick','rekam_medis()');

			$('.nama_member').text(hasil.nama_member);
			$('#kode_customer').val(hasil.kode_member);
			$('#nama_customer').val(hasil.nama_member);
			$('#poin').val(hasil.poin);
			$('#no_ktp').val(hasil.no_ktp);
			$('#no_telp').val(hasil.telp_member);
			$('#tempat_lahir').val(hasil.tempat_lahir);
			$('#pekerjaan').val(hasil.pekerjaan);
			$('#tanggal_lahir').val(hasil.tanggal_lahir);
			$('#status_perkawinan').val(hasil.status_perkawinan);
			$('#jenis_kelamin').val(hasil.jenis_kelamin);
			$('#kategori_customer').val(hasil.kategori_member);
			$('#alamat').val(hasil.alamat_member);
			$('#status_customer').val(hasil.status_member);
			var kode_member=$('#kode_member').val();
			$('#data_rekam_medis').load("<?php echo base_url('registrasi_pelayanan/akun_customer/table_record_transaksi'); ?>/"+kode_member);
		}
	});
}

function rekam_medis() {
	$('#modal-RekamMedis').modal('show');
}

function load_temp(){
	var kode_transaksi 	= $('#kode_transaksi').val();
	$("#tabel_temp_data_transaksi").load("<?php echo base_url().'registrasi_pelayanan/order_paket/load_tabel_temp/'; ?>"+kode_transaksi);
		// get_total_pesanan();
	}


	function add_item(){
		var kode_transaksi  = $('#kode_transaksi').val();
		var kode_member     = $('#kode_member').val();
		var jenis_transaksi = $('#jenis_transaksi').val();
		var kode_paket      = $('#kode_paket').val();
		var kode_treatment  = $('#kode_treatment').val();

		var url = "<?php echo base_url().'registrasi_pelayanan/order_paket/add_item_temp/'?> ";

		if(kode_member == ''){
			alert('Pilih Member terlebih dahulu!');
		}
		else{			
			$.ajax({
				type: "POST",
				url: url,
				data: {
					kode_transaksi 	: kode_transaksi,
					kode_member 	: kode_member,
					jenis_transaksi : jenis_transaksi,
					kode_paket 		: kode_paket,
					kode_treatment 	: kode_treatment
				},
				dataType: 'json',
				success: function(data)
				{
					if(data.proses=='berhasil'){
						$('.sukses').html('');     
						$('#kode_paket').val('').trigger('change');
						$('#kode_treatment').val('').trigger('change');
						load_temp();
					} else{
						alert(jenis_transaksi+' Sudah ditambahkan!');
					}
				}
			});
			
		}
	}

	function actDelete(id) {
		var url = '<?php echo base_url().'registrasi_pelayanan/order_paket/hapus_temp'; ?>';
		var kode_transaksi  = $('#kode_transaksi').val();
		$.ajax({
			type: "POST",
			url: url,
			data: {
				id:id, kode_transaksi:kode_transaksi
			},
			success: function(msg) {
				load_temp();
			}
		});
		return false;
	}

	function simpan_transaksi() {
		var kode_transaksi 	=$('#kode_transaksi').val();
		var kode_member 	=$('#kode_member').val();
		var jenis_transaksi =$("#jenis_transaksi").val();
		var jumlah_data 	=$("#jumlah_data").val();

		if (jumlah_data > 0) {
			$.ajax({
				url: '<?php echo base_url('registrasi_pelayanan/order_paket/simpan_transaksi'); ?>',
				type: 'post',
				data:{
					kode_transaksi:kode_transaksi,
					kode_member:kode_member,
					jenis_transaksi:jenis_transaksi
				},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success: function(msg)
				{
					$(".tunggu").hide();
					$(".alert_berhasil").show();
					setTimeout(function(){$('.sukses').html(msg);
						location.reload();
					},500);      
				}
			});

		}else{
			alert('Data Opsi Kosong.')
		}
		return false;
	}


	function batal_transaksi() {
		var kode_transaksi=$('#kode_transaksi').val();
		$.ajax({
			url: '<?php echo base_url('registrasi_pelayanan/order_paket/batal_transaksi'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi},
			beforeSend:function(){
				$('.tunggu').show();
			},
			success: function(hasil){
				window.location.reload();
			}
		});
	}

	</script>

