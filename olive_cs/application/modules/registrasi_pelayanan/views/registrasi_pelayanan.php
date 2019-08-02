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

td{
	font-size: 13px;
}
.table-bordered{
	border:solid 1px #217377 !important;
}
.btn-shadow{
	box-shadow: 0px 2px 5px #7f7171;
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

.box-tosca{
	box-shadow: 0px 2px 8px #1a3f42;
}

.ps {
	width: 20%;
	float: left;
}

</style>

<a href="<?php echo base_url(''); ?>"><button class="button-back"></button></a>


<div class="clearfix"></div>

<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-12">			
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-4" style="padding: 8px">
						<div class="btn btn-lg  btn-no-radius btn-shadow" onclick="show_table('03')" style="width: 100%; margin: 5px; margin-left: 0 ;background-color: #f73232;color: white">DATA LAYANAN <br> PERIKSA</div>
					</div>
					<div class="col-md-4" style="padding: 8px">
						<div class="btn btn-lg  btn-no-radius btn-shadow" onclick="show_table('02')" style="width: 100%; margin: 5px; margin-left: 0 ;background-color: #f73232;color: white">DATA LAYANAN <br> KONSUL</div>
					</div>
					<div class="col-md-4" style="padding: 8px">
						<div class="btn btn-lg  btn-no-radius btn-shadow" onclick="show_table('01')" style="width: 100%; margin: 5px; margin-left: 0 ;background-color: #f73232;color: white">DATA LAYANAN <br> TREATMENT</div>
					</div>
				</div>
				<div class="col-md-12 form_shadow" style="margin-top: 20px;padding: 0px" id="load_table_universal">
					<div class="panel panel-default">
						<div class="panel-heading text-left" style="background-color: #2f898e;color: white">
							<h4>DATA LAYANAN TREATMENT</h4>
						</div>
						<div class="panel-body">
							<div class="row" style="width: 100%">
								<div class="col-md-5" id="">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Awal</span>
										<input type="text" class="form-control tgl" id="tgl_awal">
									</div>
								</div>
								<div class="col-md-5" id="">
									<div class="input-group">
										<span class="input-group-addon">Tanggal Akhir</span>
										<input type="text" class="form-control tgl" id="tgl_akhir">
									</div>
								</div>                        
								<div class="col-md-2 pull-left">
									<a onclick="cari_stok_day()" style="width: 90px" type="button" class="btn btn-warning btn-no-radius pull-right" id="cari"><i class="fa fa-search"></i> Cari</a>
								</div>
							</div>
							<br><br>
							<div id="load_table">
								<table class="table table-hovered table-bordered" id="datatable">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Transaksi</th>
											<th>Tanggal Transaksi</th>
											<th>Nama Customer</th>
											<th>Nama Layanan</th>
											<th style="width: 20%" >Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 0;
										$this->db->select('tr.kode_transaksi,tr.kode_transaksi,tr.tanggal_transaksi,ml.nama_layanan, mm.nama_member');
										$this->db->from('olive_cs.transaksi_registrasi tr');
										$this->db->join('olive_master.master_member mm','mm.kode_member = tr.kode_member', 'left');
										$this->db->join('olive_master.master_layanan ml','ml.kode_layanan = tr.kode_layanan', 'left');
										$this->db->where('tr.kode_layanan','01');
										$this->db->where('tr.tanggal_transaksi',date('Y-m-d'));
										$data_periksa = $this->db->get()->result();
										foreach ($data_periksa as $value) { $no++; ?>
										<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $value->kode_transaksi ?></td>
											<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
											<td><?php echo $value->nama_member ?></td>
											<td><?php echo $value->nama_layanan ?></td>
											<td>
												<div class="btn-group">
													<a href="<?php echo base_url ('registrasi_pelayanan/registrasi_pelayanan/detail/'.$value->kode_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-success btn-circle green"><i class="fa fa-search"></i> </a>
													<a onclick="reprint('<?php echo $value->kode_transaksi ?>')" data-toggle="tooltip" title="Detail" class="btn btn-warning btn-circle green"><i class="fa fa-print"></i> </a>
												</div>
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
				<div class="row">
					<div class="col-md-5">
						<input type="hidden" id="kode_transaksi" value="<?php echo 'LYN_'.date('ymdhis') ?>">
						<select  class="form-control select2" id="kode_member" name="kode_member" onchange="get_member_name()">
							<option value="">--- Pilih Customer</option>
							<?php 
							$this->db->where('status_member',1);
							$get_member = $this->db->get('olive_master.master_member')->result();
							foreach ($get_member as $value) { ?>
							<option value="<?php echo $value->kode_member ?>"><?php echo $value->kode_member ?> - <?php echo $value->nama_member ?></option>
							<?php }
							?>
						</select>
					</div>
					<div class="col-md-5" style="padding-left: 0">
						<select  class="form-control" id="jenis_layanan" name="jenis_layanan">
							<option value="">Pilih Layanan</option>
							<?php 
							$this->db->where('status',1);
							$get_layanan = $this->db->get('olive_master.master_layanan')->result();
							foreach ($get_layanan as $value) { ?>
							<option value="<?php echo $value->kode_layanan ?>"><?php echo $value->nama_layanan ?></option>
							<?php }
							?>
						</select>
					</div>
					<div class="col-md-2" style="padding: 0">
						<a id="lock" onclick="get_forms()" class="btn btn-md btn-danger btn-no-radius btn-shadow" style="width: 100%;padding: 5px">PROSES</a>
						<a id="cancel" onclick="location.reload()" class="btn btn-md btn-warning btn-no-radius btn-shadow" style="width: 100%;padding: 5px">Cancel</a>
					</div>
				</div><hr style="margin: 0">
				<div class="row">
					<div class="col-md-5" style="padding-right: 0px;margin-top: 10px">
						<div id="nama" class="btn btn-md btn-success btn-no-radius btn-shadow" style="width: 100%">NAMA</div>
					</div>
					<div class="col-md-3" style="padding-right: 0px ;margin-top: 10px">
						<a>
							<div id="profil" class="btn btn-md btn-info btn-no-radius btn-shadow" disabled style="width: 100%">PROFIL</div>
						</a>
					</div>
					<div class="col-md-4" style="padding-right: 0px ;margin-top: 10px">
						<a>
							<div id="rekam" class="btn btn-md btn-info btn-no-radius btn-shadow" disabled style="width: 100%">REKAM MEDIS</div>
						</a>
					</div>
				</div>
				<div class="row" style="padding-left:15px;">
					<div style="background-color:#2f898e;margin-top: 10px;padding:10px;" class="col-md-12 row_form">
						<div class="perawatan col-md-9 col-xs-9">
							<select name="" class="form-control select2" id="layanan_perawatan" style="width:100%">
								<option value="">-- Pilih Perawatan</option>
								<?php 
								$this->db->where('status','1');
								$get_perawatan = $this->db->get('olive_master.master_perawatan')->result();
								foreach ($get_perawatan as $value) { ?>
								<option value="<?php echo $value->kode_perawatan ?>"><?php echo $value->nama_perawatan ?></option>
								<?php }
								?>
							</select>
						</div>
						<div class="periksa konsultasi col-md-4 col-xs-4">
							<select name="" class="form-control select2" id="dokter" style="width:100%">
								<option value="">-- Pilih Dokter</option>
								<?php 
								$this->db->from('olive_master.master_karyawan');
								$this->db->join('olive_master.master_jabatan','olive_master.master_jabatan.kode_jabatan = olive_master.master_karyawan.kode_jabatan', 'left');
								$this->db->where('olive_master.master_jabatan.nama_jabatan','Dokter');
								$get_dokter = $this->db->get()->result();
								foreach ($get_dokter as $value) { ?>
								<option value="<?php echo $value->kode_karyawan ?>"><?php echo $value->nama_karyawan ?></option>
								<?php }
								?>
							</select>
						</div>
						<div class="periksa col-md-5 col-xs-5">
							<select name="" class="form-control select2" id="layanan_periksa" style="width:100%">
								<option value="">-- Pilih Layanan</option>
								<?php 
								$this->db->where('status','1');
								$get_layanan = $this->db->get('olive_master.master_layanan_periksa')->result();
								foreach ($get_layanan as $value) { ?>
								<option value="<?php echo $value->kode_periksa ?>"><?php echo $value->nama_periksa ?></option>
								<?php }
								?>
							</select>
						</div>
						<div class="col-md-3 col-xs-3">
							<a onclick="add_perawatan()" id="add" class="btn btn-no-radius btn-info"><i class="fa fa-plus"></i> Add</a>							
							<a onclick="simpan_produk()" id="simpan_langsung" class="btn btn-no-radius btn-info"><i class="fa fa-check"></i> Simpan</a>							
						</div>
					</div>
				</div>
				<div class="row">
					<br>
					<div class="col-md-12" style="padding-right:0px" id="load_table_produk_temp">

					</div>
				</div>
				<br>
				<div class="row">
					<br>
					<div class="col-md-12" style="padding-right:0px">						
						<a onclick="simpan_produk()"  class="simpan btn btn-success btn-lg  btn-no-radius btn-shadow data_kasir" style="width: 100%; margin: 5px; margin-left: 0 ">SIMPAN</a>
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>
</div>
<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius:0px">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus data tersebut ?</span>
				<input id="id_delete" type="hidden">
			</div>
			<input type="hidden" id="del_id">
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green btn-no-radius" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="del_data()" class="btn red  btn-no-radius">Ya</button>
			</div>

		</div> 
	</div> 
</div> 

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
							<select class="form-control box-tosca" id="status_customer" name="status_customer">
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


<script>
	$(document).ready(function(){
		$('.tgl').Zebra_DatePicker({});
		$('.perawatan').hide();
		$('.periksa').hide();
		$('.konsultasi').hide();
		$('.row_form').hide();
		$('.simpan').hide();
		$('.cancel').hide();
		$('#cancel').hide();
		$('#simpan_langsung').hide();
		$('#add').hide();

	});
	$('.select2').select2();
	function cari_stok_day(){
		tgl_awal  = $('#tgl_awal').val();
		tgl_akhir = $('#tgl_akhir').val();
		layanan = ('01');
		if (tgl_awal != '' && tgl_akhir != '') {
			$.ajax({
				url: '<?php echo base_url('registrasi_pelayanan/registrasi_pelayanan/load_data_cari'); ?>',
				type: 'post',
				data:{tgl_akhir:tgl_akhir,tgl_awal:tgl_awal,layanan:layanan},
				success: function(hasil){
					$('#load_table').html(hasil);
				}
			});
		}else{
			alert('Harap Mengisi Form.');
		}


	}
	function reprint(key) {
		$.ajax({
			url: '<?php echo base_url('registrasi_pelayanan/registrasi_pelayanan/reprint'); ?>',
			type: 'post',
			data:{kode_transaksi:key},
			dataType:'json',
			success: function(hasil){ 
				if(hasil.respon=='gagal'){
					alert('Gagal !');
				}
			}
		});
	}
	function get_forms() {

		member = $('#kode_member').val();
		layanan = $('#jenis_layanan').val();
		jenis_layanan = $('#jenis_layanan').val();

		if (member != '' && jenis_layanan != '') {
			$('#kode_member').attr('disabled',true);
			$('#jenis_layanan').attr('disabled',true);
			if (jenis_layanan == '01') {
				$('.row_form').show();
				$('.perawatan').show();
				$('.periksa').hide();
				$('.konsultasi').hide();
				$('.perawatan').attr('class','col-md-9');
				$('#add').show();
				$('#simpan_langsung').hide();
			}else if(jenis_layanan == '03'){
				$('.row_form').show();
				$('.perawatan').hide();
				$('.periksa').show();
				$('.konsultasi').show();
				$('.konsultasi').attr('class','col-md-4');
				$('.periksa').attr('class','col-md-5');
				$('#add').hide();
				$('#simpan_langsung').show();
			}else if(jenis_layanan == '02'){
				$('.row_form').show();
				$('.perawatan').hide();
				$('.periksa').hide();
				$('.konsultasi').show();
				$('.konsultasi').attr('class','col-md-9');
				$('#add').hide();
				$('#simpan_langsung').show();
			}else{
				$('.row_form').hide();
				$('.perawatan').hide();
				$('.periksa').hide();
				$('.konsultasi').hide();
				$('#add').hide();
				$('#simpan_langsung').hide();
			}
			$('#lock').hide();
			$('#cancel').show();
		}else{
			alert('Mohon melengkapi Form');
		}


	}	

	function simpan_produk(){
		jenis_layanan 		= $('#jenis_layanan').val();
		kode_transaksi 		= $('#kode_transaksi').val();
		dokter 				= $('#dokter').val();
		layanan_periksa 	= $('#layanan_periksa').val();
		layanan_perawatan 	= $('#layanan_perawatan').val();
		kode_member 		= $('#kode_member').val();

		if (jenis_layanan == '02') {

			if (dokter != '') {
				$.ajax({
					url: "<?php echo base_url('registrasi_pelayanan/simpan_konsultasi'); ?>",
					type: 'post',
					data:{kode_layanan:jenis_layanan,kode_dokter:dokter,kode_member:kode_member,kode_transaksi:kode_transaksi},
					beforeSend:function(){
						$(".tunggu").show();
					},
					success: function(hasil){
						$(".tunggu").hide();
						$(".alert_berhasil").show();
						setTimeout(function(){ $(".alert_berhasil").hide();location.reload() }, 2000);
					}
				});

				return false;
			}else{
				alert('Mohon Melengkapi Form');
			}

		}else if(jenis_layanan == '03'){
			if (dokter != '' && layanan_periksa != '') {
				$.ajax({
					url: "<?php echo base_url('registrasi_pelayanan/simpan_periksa'); ?>",
					type: 'post',
					data:{kode_layanan:jenis_layanan,kode_dokter:dokter,kode_member:kode_member,kode_transaksi:kode_transaksi,kode_periksa:layanan_periksa},
					beforeSend:function(){
						$(".tunggu").show();
					},
					success: function(hasil){
						$(".tunggu").hide();
						$(".alert_berhasil").show();
						setTimeout(function(){ $(".alert_berhasil").hide();location.reload() }, 2000);
					}
				});

				return false;
			}else{
				alert('Mohon Melengkapi Form');
			}
		}else if(jenis_layanan == '01'){

			jumlah_temp = $('#julah_temp').val();
			if (parseInt(jumlah_temp) <= 0) {
				alert('Data Masih Kosong');
			}else{
				$.ajax({
					url: "<?php echo base_url('registrasi_pelayanan/simpan_treatment'); ?>",
					type: 'post',
					data:{kode_layanan:jenis_layanan,kode_member:kode_member,kode_transaksi:kode_transaksi},
					beforeSend:function(){
						$(".tunggu").show();
					},
					success: function(hasil){
						$(".tunggu").hide();
						$(".alert_berhasil").show();
						setTimeout(function(){ $(".alert_berhasil").hide();location.reload() }, 2000);		
					}
				});
			}
			return false;
		}
	}

	function add_perawatan(){
		layanan_perawatan 	= $('#layanan_perawatan').val();
		kode_transaksi 		= $('#kode_transaksi').val();

		if (layanan_perawatan != '') {
			$.ajax({
				url: "<?php echo base_url('registrasi_pelayanan/add_perawatan_temp'); ?>",
				type: 'post',
				data:{kode_item:layanan_perawatan,kode_transaksi:kode_transaksi},
				dataType:'Json',
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){
					if (hasil.response == 'sukses') {
						$('#layanan_perawatan').val('').trigger('change');
						$(".tunggu").hide();
						$(".simpan").show();
						load_table_produk_temp();
					}else if(hasil.response == 'ada'){
						alert('Data Sudah Ada');
						$(".tunggu").hide();
						load_table_produk_temp();
					}else{
						alert('Kesalahan Menyimpan Data');
						$(".tunggu").hide();
						load_table_produk_temp();
					}

				}
			});

			return false;
		}
	}

	function load_table_produk_temp(){
		var kode_transaksi = $('#kode_transaksi').val();
		$('#load_table_produk_temp').load('<?php echo base_url() ?>registrasi_pelayanan/get_table_produk_temp/'+kode_transaksi);
	}

	function load_all_data_pelayanan(){
		var kode_transaksi = $('#kode_transaksi').val();
		$('#load_table_produk_temp').load('<?php echo base_url() ?>registrasi_pelayanan/get_table_all/'+kode_transaksi);
	}


	function show_table(key){
		$('#load_table_universal').load('<?php echo base_url() ?>registrasi_pelayanan/get_table_all/'+key);
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
			}
		});
	}

	function rekam_medis() {
		$('#modal-RekamMedis').modal('show');
		var kode_member=$('#kode_member').val();
		$('#data_rekam_medis').load("<?php echo base_url('registrasi_pelayanan/akun_customer/table_record_transaksi'); ?>/"+kode_member);
	}

	function profile_cek() {
		$('#modal-Profil').modal('show');
	}
</script>