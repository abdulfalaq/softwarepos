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
	box-shadow: 0px 2px 5px #8c8c8c;
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
</style>
<div class="clearfix"></div>
<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-12">			
			<div class="col-md-8 form_shadow">
				<div class="row" style="margin-right: 10px">
					<div class="col-md-10">
						<div class="col-md-4" style="padding-left: 0px ;padding-right:5px;margin-bottom: 0px">
							<label style="font-size: 12px;margin-bottom: 0px">Kode Transaksi</label>
							<input type="text" readonly value="<?php echo 'PKT_'.date('ymdhis') ?>" id="kode_reservasi" class="form-control" name="">
						</div>
						<div class="col-md-8" style="padding-right: 0px; padding-left:5px;margin-bottom: 0px">
							<label style="font-size: 12px;margin-bottom: 0px">Jenis Reverensi</label>
							<select class="form-control select2" id="jenis_reservasi" required="">
								<option value="">--Pilih--</option>
								<option value="Paket">Paket</option>
								<option value="Treatment">Treatment</option>
							</select> 
						</div>
						<span class="jenis_member">
							<label style="font-size: 12px;margin-bottom: 0px;margin-top:5px">Pilih Customer</label>
							<select  class="form-control select2" id="kode_member">
								<option value="">--Pilih Customer--</option>
								<?php
								$member = $this->db->get_where('olive_master.master_member',array('status_member' => '1'));
								$member = $member->result();
								?>
								<?php foreach($member as $daftar){ ?>
								<option value="<?php echo $daftar->kode_member ?>"><?php echo $daftar->nama_member ?></option>
								<?php } ?>
							</select>
						</span>
					</div>
					<div class="col-md-2" style="padding: 0">
						<a onclick="simpan_member()" id="simpan_member" class="btn btn-md btn-danger btn-no-radius btn-shadow" style="width: 100%;margin-top: 17px;margin-bottom:  0px">LOCK</a>
						<a onclick="delete_member()" id="update_member"  class="btn btn-md btn-warning btn-no-radius btn-shadow" style="width: 100%;margin-top: 17px;margin-bottom: 0px; display: none;">Cancel</a>
						<a onclick="Profil()">
							<div id="profil" class="btn btn-md btn-primary btn-no-radius btn-shadow" style="width: 100%;margin-top: 20px;margin-bottom:  0px">PROFIL</div>
						</a>
						<a onclick="RekamMedis()">
							<div id="profil" class="btn btn-md btn-primary btn-no-radius btn-shadow" style="width: 100%;margin-top: 20px;margin-bottom:  0px">REKAM MEDIS</div>
						</a>
					</div>
				</div>
			</form><hr><hr>
			<div id="tabel1">
				<table id="" class="table table-striped table-bordered table-advance table-hover">
					<tbody>
						<tr>
							<input type="text" name="id_penjualan" id="id_penjualan" value="" hidden/>
							<input type="hidden" name="id_temp" id="id_temp" value="" hidden/>
							<td width="28%" style="background-color:#229fcd;">
								<div class="select_paket" >
									<label  style="font-size: 12px;margin-bottom: 0px">Paket</label>
									<select id="kode_paket" disabled class="form-control select2">
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
									<select id="kode_treatment" class="form-control select2" style="width:100%">
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
							<td width="28%" style="background-color:#229fcd;">
								<label style="font-size: 12px;margin-bottom: 0px">Harga</label>
								<input readonly="true" type="text" id="harga" class="form-control" placeholder="Harga">
							</td>
							<td width="17%" style="background-color:#229fcd;">
								<label style="font-size: 12px;margin-bottom: 0px">Jenis Diskon</label>
								<select hidden id="jenis_diskon" disabled class="form-control">
									<option value="persen" selected="true">Persen</option>
									<option value="rupiah">Rupiah</option>
								</select>
							</td>
							<td width="20%" style="background-color:#229fcd;">
								<label style="font-size: 12px;margin-bottom: 0px">Diskon</label>
								<div class="input-icon right" id="form_diskon_item">
									<input type="text" onkeyup="diskonpersen_cek(this)" disabled id="diskon_persen" class="form-control" placeholder="Persen (%)">
								</div>
								<div class="input-icon right" id="form_diskon_rupiah" style="display: none;">
									<input type="text" onkeyup="diskonrupiah_cek(this)" disabled id="diskon_rupiah" class="form-control" placeholder="Rupiah (Rp)">
								</div>
							</td>
							<td width="7%" style="background-color:#229fcd;padding-top:23px" >
								<a onclick="add_item()" id="add" class="btn btn-primary">Add</a>
								<a onclick="update_item()" id="update" style="display: none;" class="btn btn-warning pull-left">Update</a>
							</td>
						</tr>
					</form>
				</tbody>
			</table>
		</div>
		<div class="tabel2">
			<table style="white-space: nowrap;" id="data" class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th style="background-color:#229fcd; color:white" class="text-center" width="50px">No.</th>
						<th style="background-color:#229fcd; color:white" class="text-center">Treatment</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="200px">Harga</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="100px">Diskon</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="200px">Subtotal</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="150px">Action</th>
					</tr>
				</thead>
				<tbody id="tabel_temp_data_transaksi">
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>
		<div class="row" style="margin-top: 30px">
			<div class="col-md-6">
				<label>DISKON TRANSAKSI</label>
				<select class="form-control" id="jenis_diskon_transaksi">
					<option selected="true" value="">-- Pilih Jenis Diskon --</option>
					<option value="persen">Persen</option>
					<option value="rupiah">Rupiah</option>
				</select>
			</div>
			<div class="col-md-6" >
				<input type="text" autocomplete="off" placeholder="Persen (%)" class="form-control input-lg tagsinput" id="diskon_persen_transaksi" style="margin-top: 25px" />
				<input type="text" autocomplete="off" placeholder="Rupiah (Rp.)" class="form-control input-lg tagsinput" id="diskon_rupiah_transaksi" style="margin-top: 25px; display: none" />
			</div>
		</div>
	</div>
	<div  class="col-md-4" id="tabel3">
		<div class="row" style="margin-bottom: 8px">
			<div class="col-md-4 text-center">
				<img src="<?php echo base_url(); ?>assets/images/logo_kasir/icon paket.png" style="width: 60px;margin-top:-5px;">
			</div>
			<div class="col-md-8 text-center">
				<div class="btn btn-lg btn-no-radius btn-shadow" style="width: 100%; margin: 5px; margin-left: 0 ;background-color: #217377;color: white">ORDER PAKET</div>
			</div>
		</div>
		<div class="bg-yellow box-pannel" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
			<span style="font-size:22px;	" class="pull-right" id="total_transaksi">Rp 0,00</span>

			<p style="font-size: 18px;">Total Pesanan</p>
		</div>
		<div class="bg-red box-pannel" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
			<span style="font-size:22px; " class="pull-right" id="diskon_transaksi">Rp 0,00</span>
			<i style="font-size:56px; margin-top:5px"></i>
			<p style="font-size: 18px;">Discount</p>
		</div>
		<div class="bg-blue box-pannel" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
			<span style="font-size:22px; " class="pull-right" id="grand_total">Rp 0</span>
			<i style="font-size:56px; margin-top:5px"></i>
			<p style="font-size: 18px;">Grand Total</p>
		</div>
		<div style="height:60px;">
			<div style="height: 40px;" class="form-group">
				<div class="input-group">
					<span class="input-group-addon box-pannel">Kategori Diskon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span id="golongan">
						<select class="form-control box-pannel" id="kategori_diskon">
							<option selected="true" value="">-- Pilih Kategori Diskon --</option>
							<option value="member">Member</option>
							<option value="promo">Promo</option>
							<option value="merchant">Merchant</option>
						</select>
					</span>
				</div>
			</div>
		</div>
		<div style="height:60px; display: none;" class="transaksi_promo">
			<div style="height: 40px; margin-top: -20px;" class="form-group">
				<div class="input-group">
					<span class="input-group-addon box-pannel">Promo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span id="golongan">
						<select class="form-control box-pannel data_kasir" id="kode_promo">
							<option selected="true" value="">-- Pilih Promo --</option>
							<?php
							$this->db->select('kode_promo, nama_promo');
							$this->db->where('status', '1');
							$this->db->where('tanggal_awal <=',date('Y-m-d'));
							$this->db->where('tanggal_akhir >=',date('Y-m-d'));
							$this->db->from('olive_master.master_promo');
							$get_promo=$this->db->get()->result();
							foreach ($get_promo as $promo) {
								?>
								<option  value="<?php echo @$promo->kode_promo;?>"><?php echo @$promo->nama_promo;?></option>
								<?php
							}
							?>
						</select>
					</span>
				</div>
			</div>
		</div>
		<div style="height:60px;margin-top: -20px; display: none;" class="transaksi_merchant">
			<div style="height: 40px;" class="form-group">
				<div class="input-group">
					<span class="input-group-addon box-pannel">Merchant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span id="golongan">
						<select class="form-control box-pannel data_kasir" id="kode_merchant">
							<option selected="true" value="">-- Pilih Merchant --</option>
							<?php
							$this->db->select('kode_merchant, nama_merchant');
							$this->db->where('status', '1');
							$this->db->where('tanggal_awal <=',date('Y-m-d'));
							$this->db->where('tanggal_akhir >=',date('Y-m-d'));
							$this->db->from('olive_master.master_merchant');
							$get_merchant=$this->db->get()->result();
							foreach ($get_merchant as $merchant) {
								?>
								<option  value="<?php echo @$merchant->kode_merchant;?>"><?php echo @$merchant->nama_merchant;?></option>
								<?php
							}
							?>
						</select>
					</span>
				</div>
			</div>
		</div>
		<div style="height:60px; margin-top: -20px;">
			<div style="height: 40px;" class="form-group">
				<div class="input-group">
					<span class="input-group-addon box-pannel">Jenis Transaksi &nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span id="golongan">
						<select class="form-control box-pannel" id="jenis_transaksi">
							<option selected="true" value="tunai">Tunai</option>
							<option value="debit" id="debit">Debit Card</option>
							<option value="kredit" id="kredit">Credit Card</option>
						</select>
					</span>
				</div>
			</div>
		</div>
		<div style="height:60px; margin-top: -20px; display: none;" class="transaksi_card">
			<div style="height: 40px;" class="form-group">
				<div class="input-group">
					<span class="input-group-addon box-pannel">BANK &nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span id="golongan">
						<select class="form-control box-pannel data_kasir" id="nama_bank" name="nama_bank">
							<option value="">-Pilih-</option>
							<option value="BCA" >BCA</option>
							<option value="BNI">BNI</option>
							<option value="BRI">BRI</option>
							<option value="Mandiri">Mandiri</option>
							<option value="Niaga">Niaga</option>
							<option value="BII">BII</option>
							<option value="Lain-lain">Lain-lain</option>
						</select>
					</span>
				</div>
			</div>
		</div>
		<div style="height:60px; margin-top: -20px; display: none;" class="transaksi_card">
			<div style="height: 40px;" class="form-group">
				<div class="input-group">
					<span class="input-group-addon box-pannel">Nomor Card &nbsp;&nbsp;&nbsp;&nbsp;</span>
					<span id="golongan">
						<input type="number" class="form-control box-pannel data_kasir" name="nomor_rekening" id="nomor_rekening">
					</span> 
				</div>
			</div>
		</div>
		<div style="height:60px; margin-top: -20px;">
			<div class="form-group">
				<div class="input-group ">
					<span class="input-group-addon box-pannel" id='bayar_text' style="font-size: x-large;font-weight: bolder;"><strong>Dibayar </strong> &nbsp;&nbsp;&nbsp;</span>
					<span id="dibayar">
						<input type="" id="total_transaksi_form" />
						<input type="" id="grand_total_form" />
						<input type="" id="kembalian_form" />
						<input style="font-size: 30px; height: 38px" onkeyup="kembalian()" step="any" lang="de" type="text" autocomplete="off" class="form-control box-pannel input-lg tagsinput" name="bayar" id="bayar" />
					</span>
				</div>
			</div>
		</div>
		<div class="bg-purple box-pannel" style="height:40px; padding: 0px 10px 0px 10px; margin-top:-5px">
			<span style="font-size:22px; " class="pull-right" id="kembalian">Rp 0</span>
			<i style="font-size:56px; margin-top:5px"></i>
			<p style="font-size: 18px;" id="kemablian_text">Kembalian</p>
		</div>
		<div class="btn btn-success btn-lg  btn-no-radius btn-shadow" style="width: 100%; margin: 5px; margin-left: 0 ">BAYAR</div>
		<div class="btn btn-danger btn-lg  btn-no-radius btn-shadow" style="width: 100%; margin: 5px; margin-left: 0 ">CANCEL</div>
		<br>
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
					<div class="btn-shadow" style="font-size: 18px;width: 300px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: #ff01cc">PROFIL CUSTOMER</div><br>
				</center>
				<div class="col-md-2">
					<label style="font-size: 10px">Kode Customer</label>
					<input type="text" name="kode_customer" id="kode_customer"  class="form-control">
				</div>
				<div class="col-md-8">
					<label style="font-size: 10px">Nama Customer</label>
					<input type="text" name="nama_customer" id="nama_customer"  class="form-control">
				</div>
				<div class="col-md-2">
					<label style="font-size: 10px">Poin</label>
					<input type="text" name="poin" id="poin"  class="form-control">
				</div>
				<div class="row" style="margin: 10px">
					<div class="col-md-6" style="background-color: white;margin:10px auto;margin-right: 3%;width: 47%;padding: 5px">
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">No. KTP</label>
							<input type="text" name="poin" id="poin"  class="form-control" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Tempat Lahir</label>
							<input type="text" name="poin" id="poin"  class="form-control" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Tanggal Lahir</label>
							<input type="date" name="poin" id="poin"  class="form-control" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Jenis Kelamin</label>
							<select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
								<option value="">-- Pilih Jenis Kelamin --</option>
								<option value="">Laki-Laki</option>
								<option value="">Perempuan</option>
							</select>
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Alamat Customer</label>
							<input type="text" name="poin" id="poin"  class="form-control" style="padding: 0px">
						</div>
					</div>
					<div class="col-md-6" style="background-color: white;margin:10px auto;margin-left:3% ;width: 47%;padding: 5px">
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">NO. Telp</label>
							<input type="text" name="poin" id="poin"  class="form-control" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Pekerjaan</label>
							<input type="text" name="poin" id="poin"  class="form-control" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Status Perkawinan</label>
							<select class="form-control" id="status_perkawinan" name="status_perkawinan">
								<option value="">-- Pilih --</option>
								<option value="">Laki-Laki</option>
								<option value="">Perempuan</option>
							</select>
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Kategori Customer</label>
							<select class="form-control" id="kategori_customer" name="kategori_customer">
								<option value="">-- Pilih --</option>
								<option value="">Laki-Laki</option>
								<option value="">Perempuan</option>
							</select>
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: black">Status Customer</label>
							<select class="form-control" id="status_customer" name="status_customer">
								<option value="">-- Pilih --</option>
								<option value="">Laki-Laki</option>
								<option value="">Perempuan</option>
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
		var jenis_reservasi = $("#jenis_reservasi").val();
		if (kode_member == '') {
			alert('Nama Customer Harus Diisi.');
		}else if(jenis_reservasi == '') {
			alert('Pilih Reservasi !');
		}else{
			save_member();
		};
	}

	function save_member(){
		$('#kode_member').attr('disabled', true);
		$('#jenis_reservasi').attr('disabled', true);

		$("#kode_paket").attr('disabled', false);
		$("#jenis_diskon").attr('disabled', false);
		$("#diskon_persen").attr('disabled', false);
		$("#diskon_rupiah").attr('disabled', false);

		var jenis_reservasi = $("#jenis_reservasi").val();
		if(jenis_reservasi=='Paket'){
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
		$('#jenis_reservasi').attr('disabled', true);

		$("#kode_paket").attr('disabled', false);
		$("#jenis_diskon").attr('disabled', false);
		$("#diskon_persen").attr('disabled', false);
		$("#diskon_rupiah").attr('disabled', false);

		$(".select_paket").show();
		$(".select_treatment").hide();

		var kode_reservasi 	= $('#kode_reservasi').val();
		var kode_member 	= $('#kode_member').val();
		var url 			= "<?php echo base_url().'kasir/order_paket/hapus_temp'; ?>";
		$.ajax({
			type: "POST",
			url: url,
			data: {kode_reservasi : kode_reservasi, kode_member : kode_member},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg) {
				load_temp();
			}
		});
		return false;
	}


	$("#jenis_diskon").change(function(){
		if($("#jenis_diskon").val()=='rupiah'){
			$("#form_diskon_rupiah").show();
			$("#form_diskon_item").hide();
			$("#diskon_item").val('0');

		} else {
			$("#form_diskon_rupiah").hide();
			$("#form_diskon_item").show();
			$("#diskon_rupiah").val('0');
		}
	});

	$("#kode_treatment").change(function(){
		var url = "<?php echo base_url().'kasir/order_paket/get_harga'; ?>";
		var kode_treatment = $("#kode_treatment").val();
		$.ajax( {
			type:"POST", 
			url : url,  
			dataType: 'json',
			data :{kode_treatment:kode_treatment},
			success : function(data) {
				$("#harga").val(data.harga_jual);
			},  
			error : function(data) {  
				alert(data);  
			}  
		});
	});

	$("#kode_paket").change(function(){
		var url 		= "<?php echo base_url().'kasir/order_paket/get_harga_paket'; ?>";
		var kode_paket 	= $("#kode_paket").val();
		$.ajax( {
			type:"POST", 
			url : url,  
			dataType: 'json',
			data :{kode_paket:kode_paket},
			success : function(data) {
				$("#harga").val(data.harga_jual);
			},  
			error : function(data) {  
				alert(data);  
			}  
		});
	});

	$("#jenis_transaksi").change(function(){
		var jenis = $("#jenis_transaksi").val();
		grand_total=$("#total_no").val();
		if(jenis=="debit" || jenis=="kredit"){
			$(".debit").fadeIn(500);
			$(".jatuh_tempo").fadeOut(500);
			$("#bayar_text").text('Dibayar');
			$("#bayar").val(grand_total);
		}else{
			$("#bayar_text").text('Dibayar');
			$(".debit").fadeOut(500);
			$(".jatuh_tempo").fadeOut(500);
			$("#bayar").val(0);
		}
	});

	function diskonpersen_cek(obj){
		var dis_persen = parseFloat($(obj).val());

		if (dis_persen < 0 || dis_persen > 100 ) {
			alert('Diskon Salah !');
			$(obj).val('');
		}
	}

	function diskonrupiah_cek(obj){
		var dis_rupiah = parseInt($(obj).val());
		var subtotal   = parseInt($("#harga").val());
		if (dis_rupiah < 0 ) {
			alert('diskon harus melebihi 0 !');
			$('#diskon_rupiah').val('');
		}else if(parseInt(dis_rupiah) > parseInt(subtotal)) {
			alert('diskon Melebihi harga !');
			$(obj).val('');
		}
	}

	function diskonrupiah_trans_cek(obj){
		var dis_rupiah = parseInt($(obj).val());
		var total   = parseInt($("#total_transaksi").val());
		if (dis_rupiah < 0 ) {
			alert('diskon harus melebihi 0 !');
			$('#diskon_rupiah').val('');
		}else if(parseInt(dis_rupiah) > parseInt(total)) {
			alert('diskon Melebihi total transaksi !');
			$(obj).val('');
		}
	}

	function add_item(){
		var kode_reservasi  = $('#kode_reservasi').val();
		var kode_member     = $('#kode_member').val();
		var jenis_reservasi = $('#jenis_reservasi').val();
		var kode_paket      = $('#kode_paket').val();
		var kode_treatment  = $('#kode_treatment').val();
		var jenis_diskon    = $('#jenis_diskon').val();
		var diskon_persen   = $('#diskon_persen').val();
		var diskon_rupiah   = $('#diskon_rupiah').val();
		var subtotal        = $('#harga').val();

		var url = "<?php echo base_url().'kasir/order_paket/add_item_temp/'?> ";

		if(kode_member == ''){
			alert('Pilih Member terlebih dahulu!');
		}
		else{
			if (diskon_persen < 0) {
				alert('Diskon salah !');
			} else if (diskon_persen > 100) {
				alert('Diskon salah !');
			} else if (parseInt(diskon_rupiah) < 0) {
				alert('Diskon salah !');
			}else if (parseInt(diskon_rupiah) > parseInt(subtotal)) {
				alert('Diskon melebihi subtotal !');
			}else{

				$.ajax({
					type: "POST",
					url: url,
					data: {
						kode_reservasi : kode_reservasi,
						kode_member : kode_member,
						jenis_reservasi : jenis_reservasi,
						kode_paket : kode_paket,
						kode_treatment : kode_treatment,
						jenis_diskon : jenis_diskon,
						diskon_persen : diskon_persen,
						diskon_rupiah : diskon_rupiah,
						subtotal : subtotal
					},
					dataType: 'json',
					success: function(data)
					{
						if(data.proses=='berhasil'){
							$("#tabel_temp_data_transaksi").load("<?php echo base_url().'kasir/order_paket/load_tabel_temp/'; ?>"+kode_reservasi);
							$('.sukses').html('');     
							$('#kode_paket').val('').trigger('change');
							$('#kode_treatment').val('').trigger('change');
							$('#diskon_persen').val('');
							$('#diskon_rupiah').val('');
							$('#harga').val('');

							$('#total_transaksi_form').val(data.total_transaksi);
							
							// get_grand_total();
						} else{
							alert(jenis_reservasi+' Sudah ditambahkan!');
						}
					}
				});
			}
		}
	}
	function actDelete(id) {
		var url = '<?php echo base_url().'kasir/order_paket/hapus_temp'; ?>';
		var kode_reservasi  = $('#kode_reservasi').val();
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			data: {
				id:id, kode_reservasi:kode_reservasi
			},
			success: function(msg) {
				$('#total_transaksi_form').val(msg.total_transaksi);
				$("#tabel_temp_data_transaksi").load("<?php echo base_url().'kasir/order_paket/load_tabel_temp/'; ?>"+kode_reservasi);
			}
		});
		return false;
	}






	$("#kategori_diskon").change(function(){
		var kategori_diskon = $("#kategori_diskon").val();
		if(kategori_diskon=="promo"){
			$(".form_promo").fadeIn(500);
			$(".form_merchant").fadeOut(500);
		}else if(kategori_diskon=="merchant"){
			$(".form_merchant").fadeIn(500);
			$(".form_promo").fadeOut(500);
		}else{
			$(".form_promo").fadeOut(500);
			$(".form_merchant").fadeOut(500);
		}
	});
	$("#jenis_diskon_transaksi").change(function(){
		if($("#jenis_diskon_all").val()=='rupiah'){
			$("#form_diskon_rupiah_all").show();
			$("#form_diskon_item_all").hide();
			$("#persen").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		} else {
			$("#form_diskon_rupiah_all").hide();
			$("#form_diskon_item_all").show();
			$("#rupiah").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		}
	});

	function actEdit(id) {

		var id = id;
		var kode_reservasi = $('#kode_reservasi').val();
		var jenis_reservasi = $('#jenis_reservasi').val();
		var url = "<?php echo base_url().'kasir/order_paket/get_temp_reservasi'; ?>";
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: {id:id},
			success: function(reservasi){
				$("#add").hide();
				$("#update").show();
				if(jenis_reservasi=='Paket'){
					$("#kode_paket").val(reservasi.kode_paket);
					$("#kode_paket_lama").val(reservasi.kode_paket);
					$("#harga").val(reservasi.harga_paket);
					$("#id_temp").val(reservasi.id);
					if(reservasi.jenis_diskon=="persen"){
						$("#diskon_item").val(reservasi.diskon_persen);
					}else{
						$("#diskon_rupiah").val(reservasi.diskon_rupiah);
					}
				}else{
					$("#kode_treatment").val(reservasi.kode_item);
					$("#harga").val(reservasi.harga);
					$("#id_temp").val(reservasi.id);
					if(reservasi.jenis_diskon=="persen"){
						$("#diskon_item").val(reservasi.diskon_persen);
					}else{
						$("#diskon_rupiah").val(reservasi.diskon_rupiah);
					}
				}

				$("#tabel_temp_data_transaksi").load("<?php echo base_url().'kasir/order_paket/get_reservasi/'; ?>"+kode_reservasi+'/'+jenis_reservasi);

			}
		});
	}



	function update_item(){
		var kode_reservasi 	= $('#kode_reservasi').val();
		var kode_member 	= $('#kode_member').val();
		var kode_paket 		= $('#kode_paket').val();
		var kode_paket_lama = $('#kode_paket_lama').val();
		var jenis_reservasi = $('#jenis_reservasi').val();
		var kode_treatment 	= $('#kode_treatment').val();
		var id_temp 		= $('#id_temp').val();
		var jenis_diskon    = $('#jenis_diskon').val();
		var diskon_persen   = $('#diskon_item').val();
		var diskon_rupiah   = $('#diskon_rupiah').val();
		var subtotal        = $('#harga').val();
		var url = "<?php echo base_url().'kasir/order_paket/update_item/'?> ";

		$.ajax({
			type: "POST",
			url: url,
			data: { 
				kode_reservasi:kode_reservasi,
				kode_member:kode_member,
				kode_paket:kode_paket,
				kode_paket_lama:kode_paket_lama,
				jenis_reservasi:jenis_reservasi,
				kode_treatment:kode_treatment,
				id_temp:id_temp,
				jenis_diskon:jenis_diskon,
				diskon_persen:diskon_persen,
				diskon_rupiah:diskon_rupiah,
				subtotal:subtotal
			},
			success: function(data)
			{
				$("#tabel_temp_data_transaksi").load("<?php echo base_url().'kasir/order_paket/get_reservasi/'; ?>"+kode_reservasi+'/'+jenis_reservasi);
				$("#kode_paket").val('');
				$("#kode_paket_lama").val('');
				$('#kode_treatment').val('');
				$('#diskon_item').val('');
				$('#diskon_rupiah').val('');
				$('#harga').val('');
				$('#id_temp').val('');
				$("#add").show();
				$("#update").hide();
				totalan();
				grand_total();
			}
		});
	}

	function totalan() {
		var kode_reservasi = $("#kode_reservasi").val();
		var jenis_reservasi = $("#jenis_reservasi").val();
		var url = "<?php echo base_url().'kasir/order_paket/get_total_temp'; ?>";
		$.ajax({
			type: 'POST',
			url: url,
			dataType:'json',
			data: {kode_reservasi:kode_reservasi,jenis_reservasi:jenis_reservasi},
			success: function(kasir){
				$("#total_pesanan").text(kasir.total);
				$("#grand_total").text(kasir.total);
				$("#total2").val(kasir.total2);
			}
		});
	}
	function grand_total(){
		var url = "<?php echo base_url().'kasir/order_paket/grand_total'; ?>";
		var rupiah = $("#rupiah_diskon").val();
		var kode_reservasi = $("#kode_reservasi").val();
		var jenis_reservasi = $("#jenis_reservasi").val();
		$.ajax({
			type: 'POST',
			url: url,
			dataType:'json',
			data: {rupiah:rupiah,kode_reservasi:kode_reservasi,jenis_reservasi:jenis_reservasi},
			success: function(rupiah){
				$("#grand_total").text(rupiah.total_grand);
				$("#total_no").val(rupiah.total_no);
			}
		});
	}
	function diskon_persen(){
		var diskon_persen = $("#persen").val();
		if (parseInt(diskon_persen) < 0 || parseInt(diskon_persen) > 100) {
			alert('diskon salah !');
			$("#persen").val('0');
			$("#rupiah").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		}else {
			var jumlah = $("#total2").val();
			var rupiah = Math.round((diskon_persen/100 )* jumlah);
			$("#rupiah_diskon").val(rupiah);
			diskon_all();
			grand_total();
		}

	}
	function diskon_rupiah(){
		var jumlah = $("#total2").val();
		var no_meja = $("#kode_meja").val();
		var diskon_rupiah = $("#rupiah").val();
		if (parseInt(diskon_rupiah) > parseInt(jumlah) || parseInt(diskon_rupiah) < 0) {
			alert('Diskon Salah !');
			$("#persen").val('0');
			$("#rupiah").val('0');
			$("#rupiah_diskon").val('0');
			diskon_all();
			grand_total();
		}else{
			$("#rupiah_diskon").val(diskon_rupiah);
			diskon_all();
			grand_total();
		}
	}
	function diskon_all(){
		var url = "<?php echo base_url().'kasir/kasir/diskon_all'; ?>";
		var rupiah = $("#rupiah_diskon").val();
		$.ajax({
			type: 'POST',
			url: url,
			data: {rupiah:rupiah},
			success: function(rupiah){
				$("#diskon_all").text(rupiah);
			}
		});
	}
	function kembalian(){
		var url = "<?php echo base_url().'kasir/kasir/kembalian'; ?>";
		var dibayar = $("#bayar").val();
		var total = $("#total_no").val();
		var jenis_transaksi = $("#jenis_transaksi").val();
		if (dibayar < 0) {
			alert('Pembayaran kurang dari 0 !');
			$("#bayar").val('');
			kembalian();
		}else if (dibayar == 0 || dibayar == '') {
			$("#kembalian").text('Rp 0');
			$("#rupiah_bayar").text('Rp 0');
		}else{
			$.ajax({
				type: 'POST',
				url: url,
				dataType:'json',
				data: {total:total,dibayar:dibayar},
				success: function(rupiah){
					if (jenis_transaksi == 'kredit') {
						$("#kemablian_text").text('Hutang');
						$("#kembalian").text(rupiah.hutang1);
						$("#kembalian2").val(rupiah.hutang2);
						$("#rupiah_bayar").text(rupiah.dibayar);
					}else{
						$("#kemablian_text").text('Kembalian');
						$("#kembalian").text(rupiah.kembalian1);
						$("#kembalian2").val(rupiah.kembalian2);
						$("#rupiah_bayar").text(rupiah.dibayar);
					}
				}
			});
		}

	}
	function confirm_bayar(){
		var uang = $("#nilai_dibayar").text();
		var uang_muka = $("#uang_muka").val();
		var grand_total = $("#grand_total").val();
		var proses_pembayaran = $("#jenis_pembayaran").val();
		var jatuh_tempo = $("#jatuh_tempo").val();
		if(proses_pembayaran=='kredit' && jatuh_tempo==''){
			$("#modal-confirm-tanggal").modal('show');
		}else if(( parseInt(uang_muka) < 0 || parseInt(grand_total) <= parseInt(uang_muka) || uang_muka=='') && proses_pembayaran=='kredit'){
			$("#modal-confirm-uangmuka").modal('show');
		}else if((parseInt(grand_total) > parseInt(uang_muka) || uang_muka=='') && proses_pembayaran=='cash'){
			$("#modal-confirm-dibayar").modal('show');
		}else{
			simpan_transaksi();
		}

	}

	function simpan_transaksi() {
		var simpan_transaksi 	= "<?php echo base_url().'kasir/order_paket/simpan_transaksi'?>";
		var kode_reservasi 		= $('#kode_reservasi').val() ;
		var total_pesanan 		= $("#total2").val();
		var persen 				= $("#persen").val();
		var rupiah 				= $("#rupiah").val();
		var grand_total 		= $("#total_no").val();
		var jenis_transaksi 	= $("#jenis_transaksi").val();
		var kembalian 			= $("#kembalian2").val();
		var bayar 				= $("#bayar").val();
		var kode_member 		= $("#kode_member").val();
		var kode_penjualan_baru = $("#kode_penjualan_baru").val();
		var nama_bank 			= $("#nama_bank").val();
		var nomor_debit 		= $("#nomor_debit").val();
		var kategori_diskon 	= $("#kategori_diskon").val();
		var kode_promo 			= $("#kode_promo").val();
		var kode_merchant 		= $("#kode_merchant").val();
		var kode_reservasi 		= $('#kode_reservasi').val();
		var kode_dokter 		= $('#kode_dokter').val();
		var kode_item 			= $('#kode_item').val();
		var tanggal_reservasi 	= $('#tanggal_reservasi').val();
		var kode_member 		= $('#kode_member').val();
		var kode_layanan 		= $('#kode_layanan').val();
		var jenis_reservasi 	= $('#jenis_reservasi').val();

		if(bayar==""){
			alert('Pembayaran masih kosong');
			$('#modal-confirm-bayar').modal('hide');
		}else if(jenis_transaksi == 'tunai' && parseInt(bayar) < parseInt(grand_total)){
			alert('Pembayaran Kurang !'); 
			$('#modal-confirm-bayar').modal('hide');
			$("#bayar").val('');
			kembalian();
		}else if(jenis_transaksi == 'debit' && nama_bank == ''){
			$('#modal-confirm-bayar').modal('hide');
			alert('Nama Bank harus Di isi!');
			$("#bayar").val('');
			kembalian();
		}else if(jenis_transaksi == 'debit' && (parseInt(bayar) < parseInt(grand_total) || parseInt(bayar) > parseInt(grand_total))){
			$('#modal-confirm-bayar').modal('hide');
			alert('Maaf Pembayaran Via Debit, Harus Sesuai Total pembayaran!');
			$("#bayar").val('');
			kembalian();
		}else{
			if(kode_member=="" && jenis_transaksi=="kredit"){
				alert('Pembayaran kredit hanya digunakan untuk member');
				$('#modal-confirm-bayar').modal('hide');
			}else if(jenis_transaksi=="kredit" && parseInt(bayar) >= parseInt(grand_total)){
				alert('Pembayaran kredit tidak boleh melebihi atau sama dengan total pembayaran !');
				$("#bayar").val('');
				kembalian();
				$('#modal-confirm-bayar').modal('hide');
			}else if(jenis_transaksi=="kredit" && parseInt(bayar) < 0){
				alert('Pembayaran kredit tidak boleh kurang dari 0 !');
				$('#modal-confirm-bayar').modal('hide');
				$("#bayar").val('');
				kembalian();
			}else{
				if (parseInt(persen) == '' && parseInt(rupiah) != '') {
					var persen = Math.round(rupiah/total_pesanan*100);
				}else if(parseInt(rupiah) == '' && parseInt(persen) != ''){
					var rupiah = Math.round((persen/100 )*total_pesanan);
				}

				$.ajax({
					type: "POST",
					url: simpan_transaksi,
					data: {
						kode_reservasi:kode_reservasi,
						kode_member:kode_member,
						kode_layanan:kode_layanan,
						nomor_debit:nomor_debit,nama_bank:nama_bank,bayar:bayar,kembalian:kembalian,
						total_pesanan:total_pesanan,persen:persen,rupiah:rupiah,grand_total:grand_total,jenis_transaksi:jenis_transaksi,
						kode_member:kode_member,kategori_diskon:kategori_diskon,kode_promo:kode_promo,kode_merchant:kode_merchant,jenis_reservasi:jenis_reservasi
					},
					beforeSend:function(){
						$(".tunggu").show();  
					},
					success: function(msg)
					{
						$(".tunggu").hide();
						var link = "<?php echo base_url('kasir/order_paket/print_invoice'); ?>";

						$.ajax({
							type: "POST",
							url: link,
							data:{kode_reservasi:kode_reservasi},
							success: function(msg)
							{
							}
						});  
						setTimeout(function(){$('.sukses').html(msg);
							window.location = "<?php echo base_url().'kasir/list_transaksi_hari_ini'?>";
						},1500);      
					}
				});
			}
		}
		return false;
	}

</script>

