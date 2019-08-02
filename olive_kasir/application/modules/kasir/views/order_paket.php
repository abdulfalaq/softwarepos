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
<a href="<?php echo base_url('kasir'); ?>"><button class="button-back"></button></a>
<div class="clearfix"></div>
<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-12">			
			<div class="col-md-8 form_shadow">
				<div class="row" style="margin-right: 10px">
					<?php
					@$kode_reservasi=$this->uri->segment(4);
					if(!empty($kode_reservasi)){
						$this->db->where('kode_transaksi', $kode_reservasi);
						$get_opsi=$this->db->get('olive_cs.opsi_transaksi_order_paket')->row();

						$this->db->where('kode_transaksi', $kode_reservasi);
						$get_transaksi=$this->db->get('olive_cs.transaksi_order_paket')->row();
						
					}
					?>
					<div class="col-md-10">
						<div class="col-md-4" style="padding-left: 0px ;padding-right:5px;margin-bottom: 0px">
							<label style="font-size: 12px;margin-bottom: 0px">Kode Transaksi</label>
							<input type="text" readonly value="<?php if(!empty($kode_reservasi)){ echo $kode_reservasi;}else{echo 'PKT_'.date('ymdhis');} ?>" id="kode_reservasi" class="form-control" name="">
						</div>
						<div class="col-md-8" style="padding-right: 0px; padding-left:5px;margin-bottom: 0px">
							<label style="font-size: 12px;margin-bottom: 0px">Jenis Reverensi</label>
							<select class="form-control select2" id="jenis_reservasi" required="">
								<option value="">--Pilih--</option>
								<option <?php if(@$get_opsi->jenis_item=='Paket'){echo "selected";}?> value="Paket">Paket</option>
								<option <?php if(@$get_opsi->jenis_item=='Treatment'){echo "selected";}?> value="Treatment">Treatment</option>
							</select> 
						</div>
						<span class="jenis_member">
							<label style="font-size: 12px;margin-bottom: 0px;margin-top:5px">Pilih Customer</label>
							<select  class="form-control select2" id="kode_member" onchange="get_data_member()">
								<option value="">--Pilih Customer--</option>
								<?php
								$member = $this->db->get_where('olive_master.master_member',array('status_member' => '1'));
								$member = $member->result();
								foreach($member as $daftar){ ?>
									<option <?php if(@$get_transaksi->kode_member==$daftar->kode_member){echo "selected";}?> value="<?php echo $daftar->kode_member ?>"><?php echo $daftar->kode_member ?> - <?php echo $daftar->nama_member ?></option>
									<?php } ?>
								</select>
							</span>
						</div>
						<div class="col-md-2" style="padding: 0">
							<a onclick="simpan_member()" id="simpan_member" class="btn btn-md btn-danger btn-no-radius btn-shadow" style="width: 100%;margin-top: 17px;margin-bottom:  0px">LOCK</a>
							<a onclick="delete_member()" id="update_member"  class="btn btn-md btn-warning btn-no-radius btn-shadow" style="width: 100%;margin-top: 17px;margin-bottom: 0px; display: none;">Cancel</a>
							<a onclick="profile_cek()">
								<div id="profil" class="btn btn-md btn-primary btn-no-radius btn-shadow" style="width: 100%;margin-top: 20px;margin-bottom:  0px">PROFIL</div>
							</a>
							<a onclick="rekam_medis()">
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
										<select id="kode_paket" disabled class="form-control select2 data_kasir">
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
										<select id="kode_treatment" class="form-control select2 data_kasir" style="width:100%">
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
									<input readonly="true" type="text" id="harga" class="form-control data_kasir" placeholder="Harga">
								</td>
								<td width="17%" style="background-color:#229fcd;">
									<label style="font-size: 12px;margin-bottom: 0px">Jenis Diskon</label>
									<select hidden id="jenis_diskon" disabled class="form-control data_kasir">
										<option value="persen" selected="true">Persen</option>
										<option value="rupiah">Rupiah</option>
									</select>
								</td>
								<td width="20%" style="background-color:#229fcd;">
									<label style="font-size: 12px;margin-bottom: 0px">Diskon</label>
									<div class="input-icon right" id="form_diskon_item">
										<input type="text" onkeyup="diskonpersen_cek(this)" disabled id="diskon_persen" class="form-control data_kasir" placeholder="Persen (%)">
									</div>
									<div class="input-icon right" id="form_diskon_rupiah" style="display: none;">
										<input type="text" onkeyup="diskonrupiah_cek(this)" disabled id="diskon_rupiah" class="form-control data_kasir" placeholder="Rupiah (Rp)">
									</div>
								</td>
								<td width="7%" style="background-color:#229fcd;padding-top:23px" >
									<button onclick="add_item()" id="add" class="btn btn-primary data_kasir">Add</button>
									<button onclick="update_item()" id="update" style="display: none;" class="btn btn-warning pull-left data_kasir">Update</button>
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
					<select class="form-control data_kasir" id="jenis_diskon_transaksi" onchange="change_jenis_diskon_transaksi()">
						<option value="persen">Persen</option>
						<option value="rupiah">Rupiah</option>
					</select>
				</div>
				<div class="col-md-6" >
					<input type="text" autocomplete="off" placeholder="" class="form-control input-lg tagsinput data_kasir" id="diskon_transaksi" style="margin-top: 25px" onkeyup="cek_diskon_transaki()" onclick="cek_diskon_transaki()" />
					
				</div>
			</div>
			<div class="row" style="margin-top: 30px">
				<div class="col-md-12">
					<h1 class="nominal_dibayar"></h1>
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
				<span style="font-size:22px;" class="pull-right" id="nominal_total_pesanan">Rp 0,00</span>
				<input type="hidden" name="total_pesanan" id="total_pesanan">
				<p style="font-size: 18px;">Total Pesanan</p>
			</div>
			<div class="bg-red box-pannel" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
				<span style="font-size:22px; " class="pull-right" id="nominal_diskon_all">Rp 0,00</span>
				<input type="hidden" name="diskon_all" id="diskon_all">
				<i style="font-size:56px; margin-top:5px"></i>
				<p style="font-size: 18px;">Discount</p>
			</div>
			<div class="bg-blue box-pannel" style="height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
				<span style="font-size:22px; " class="pull-right" id="nominal_grand_total">Rp 0</span>
				<input type="hidden" name="grand_total" id="grand_total">
				<i style="font-size:56px; margin-top:5px"></i>
				<p style="font-size: 18px;">Grand Total</p>
			</div>
			<div style="height:60px;">
				<div style="height: 40px;" class="form-group">
					<div class="input-group">
						<span class="input-group-addon box-pannel">Kategori Diskon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						<span id="golongan">
							<select class="form-control box-pannel data_kasir" id="kategori_diskon" name="kategori_diskon" onchange="change_kategori_diskon()">
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
							<select class="form-control box-pannel data_kasir" id="jenis_transaksi" onchange="change_jenis_transaksi()">
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
						<span id="">
							
							<input style="font-size: 30px; height: 38px" onkeyup="kembalian()" step="any" lang="de" type="text" autocomplete="off" class="form-control box-pannel input-lg tagsinput data_kasir" name="dibayar" id="dibayar" />
						</span>
					</div>
				</div>
			</div>
			<div class="bg-purple box-pannel" style="height:40px; padding: 0px 10px 0px 10px; margin-top:-5px">
				<span style="font-size:22px; " class="pull-right" id="nominal_kembalian">Rp 0</span>
				<input type="hidden" id="kembalian" name="kembalian" />
				<i style="font-size:56px; margin-top:5px"></i>
				<p style="font-size: 18px;" id="kemablian_text">Kembalian</p>
			</div>
			<div class="btn btn-success btn-lg  btn-no-radius btn-shadow data_kasir" style="width: 100%; margin: 5px; margin-left: 0 " onclick="simpan_transaksi()">BAYAR</div>
			<div class="btn btn-danger btn-lg  btn-no-radius btn-shadow data_kasir" style="width: 100%; margin: 5px; margin-left: 0 " onclick="batal_transaksi()">CANCEL</div>
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

<script type="text/javascript">
	$(document).ready(function(){
		$(".select2").select2();
		$(".debit").fadeOut(500);
		$(".jatuh_tempo").fadeOut(500);
		$(".form_promo").fadeOut(500);
		$(".form_merchant").fadeOut(500);
		$('.data_kasir').attr('disabled',true);
		<?php
		if(!empty($kode_reservasi)){
			?>
			simpan_member();
			load_temp();
			get_data_member();
			<?php
		}
		?>
	});

	function profile_cek() {
		$('#modal-Profil').modal('show');
	}
	function rekam_medis() {
		$('#modal-RekamMedis').modal('show');
		var kode_member=$('#kode_member').val();
		$('#data_rekam_medis').load('<?php echo base_url('kasir/table_rekam_medis'); ?>/'+kode_member);
	}
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
	function get_data_member() {
		var kode_member=$('#kode_member').val();
		$.ajax({
			url: '<?php echo base_url('kasir/order_paket/get_data_member'); ?>',
			type: 'post',
			data:{kode_member:kode_member},
			dataType:'json',
			success: function(hasil){
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

				if(hasil.kategori_member=='Non Member'){
					$('#join_member').attr('disabled',false);
					$('#join_member').removeClass('btn-default');
					$('#join_member').addClass('btn-warning');
				}else{
					$('#join_member').attr('disabled',true);
					$('#join_member').removeClass('btn-warning');
					$('#join_member').addClass('btn-default');
				}
			}
		});
	}
	function save_member(){
		$('#kode_member').attr('disabled', true);
		$('#jenis_reservasi').attr('disabled', true);

		$("#kode_paket").attr('disabled', false);
		$("#jenis_diskon").attr('disabled', false);
		$("#diskon_persen").attr('disabled', false);
		$("#diskon_rupiah").attr('disabled', false);
		$('.data_kasir').attr('disabled',false);
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
				window.location.reload();
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
							load_temp();
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
				load_temp();
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



	function load_temp(){
		var kode_reservasi 	= $('#kode_reservasi').val();
		$("#tabel_temp_data_transaksi").load("<?php echo base_url().'kasir/order_paket/load_tabel_temp/'; ?>"+kode_reservasi);
		get_total_pesanan();
	}


	function get_total_pesanan() {
		var kode_transaksi=$('#kode_reservasi').val();
		var diskon_transaksi=$('#diskon_transaksi').val();
		var jenis_diskon_transaksi=$('#jenis_diskon_transaksi').val();
		$.ajax({
			url: '<?php echo base_url('kasir/order_paket/get_total_pesanan'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi,jenis_diskon_transaksi:jenis_diskon_transaksi,diskon_transaksi:diskon_transaksi},
			dataType:'json',
			success: function(hasil){
				$('#total_pesanan').val(hasil.subtotal);
				$('#nominal_total_pesanan').text(hasil.nominal_subtotal);
				$('#diskon_all').val(hasil.diskon);
				$('#nominal_diskon_all').text(hasil.nominal_diskon);
				$('#grand_total').val(hasil.grand_total);
				$('#nominal_grand_total').text(hasil.nominal_grand_total);
			}
		});
	}
	function change_jenis_diskon_transaksi(){
		$('#diskon_transaksi').val('');
		get_total_pesanan();
	}
	function cek_diskon_transaki() {
		var diskon_transaksi=$('#diskon_transaksi').val();
		var jenis_diskon_transaksi=$('#jenis_diskon_transaksi').val();
		var grand_total=$('#grand_total').val();
		if(parseInt(diskon_transaksi) <=0 || diskon_transaksi=='-'){
			alert("Diskon Salah !");
			$('#diskon_transaksi').val('');
		}else if(jenis_diskon_transaksi=='persen' && parseInt(diskon_transaksi) >100){
			alert("Diskon Salah !");
			$('#diskon_transaksi').val('');
		}else if(jenis_diskon_transaksi=='rupiah' && parseInt(diskon_transaksi) > parseInt(grand_total)){
			alert("Diskon Salah !");
			$('#diskon_transaksi').val('');
		}
		get_total_pesanan();
		
	}
	function change_kategori_diskon(){
		var kategori_diskon=$('#kategori_diskon').val();
		if(kategori_diskon=='promo'){
			$('.transaksi_promo').show();
			$('.transaksi_merchant').hide();

		}else if(kategori_diskon=='merchant'){
			$('.transaksi_promo').hide();
			$('.transaksi_merchant').show();
		}else{
			$('.transaksi_promo').hide();
			$('.transaksi_merchant').hide();
		}
		$('#kode_promo').val('');
		$('#kode_merchant').val('');
	}
	function change_jenis_transaksi(){
		var jenis_transaksi=$('#jenis_transaksi').val();
		var grand_total=$('#grand_total').val();
		if(jenis_transaksi!='tunai'){
			$('.transaksi_card').show();
			$('#dibayar').val(grand_total);
			$('#dibayar').attr("readonly",true);
		}else{
			$('.transaksi_card').hide();
			$('#dibayar').val(0);
			$('#dibayar').attr("readonly",false);
		}
		$('#nama_bank').val('');
		$('#nomor_rekening').val('');
	}
	function kembalian(){
		var dibayar=$('#dibayar').val();
		var grand_total=$('#grand_total').val();
		if(parseInt(dibayar) <0 || dibayar=='-'){
			alert('Nominal Pembayaran Salah !');
		}else if(parseInt(dibayar) <= parseInt(grand_total)){
			$('.nominal_dibayar').text(toRp(parseInt(dibayar)));
			$('#kembalian').val(0);
			$('#nominal_kembalian').text(toRp(0));
		}else if(dibayar ==''){
			$('.nominal_dibayar').text(toRp(0));
			$('#kembalian').val(0);
			$('#nominal_kembalian').text(toRp(0));
		}else{
			$('#kembalian').val(parseInt(dibayar)-parseInt(grand_total));
			$('#nominal_kembalian').text(toRp(parseInt(dibayar)-parseInt(grand_total)));
			$('.nominal_dibayar').text(toRp(parseInt(dibayar)));
		}
		
	}
	function toRp(angka){
		var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
		var rev2    = '';
		for(var i = 0; i < rev.length; i++){
			rev2  += rev[i];
			if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
				rev2 += '.';
			}
		}
		return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
	}
	

	function simpan_transaksi() {
		var kode_reservasi=$('#kode_reservasi').val();
		var jenis_diskon_transaksi=$('#jenis_diskon_transaksi').val();
		var diskon_transaksi=$('#diskon_transaksi').val();
		var kode_member=$('#kode_member').val();
		var kategori_diskon=$('#kategori_diskon').val();
		var kode_promo=$('#kode_promo').val();
		var kode_merchant=$('#kode_merchant').val();
		var jenis_transaksi=$('#jenis_transaksi').val();
		var nama_bank=$('#nama_bank').val();
		var nomor_rekening=$('#nomor_rekening').val();
		var total_pesanan=$('#total_pesanan').val();
		var diskon_all=$('#diskon_all').val();
		var grand_total=$('#grand_total').val();
		var dibayar=$('#dibayar').val();
		var kembalian=$('#kembalian').val();
		if(total_pesanan==''){
			alert('Tidak Ada Pesanan !');
		}else if(kategori_diskon=='promo' && kode_promo==''){
			alert('Pilih Promo !');
		}else if(kategori_diskon=='merchant' && kode_merchant==''){
			alert('Pilih Merchant !');
		}else if(dibayar=='' || dibayar<0 || parseInt(dibayar) < parseInt(grand_total)){
			alert('Pembayaran Tidak Sesuai !');
		}else if(jenis_transaksi==''){
			alert('Pilih Jenis Transaksi !');
		}else if(jenis_transaksi!='tunai' && jenis_transaksi!='' && (nama_bank=='' || nomor_rekening=='')){
			alert('Pilih BANK dan isi Nomor Card  !');
		}else{
			$.ajax({
				url: '<?php echo base_url('kasir/order_paket/simpan_transaksi'); ?>',
				type: 'post',
				data:{
					kode_reservasi:kode_reservasi,
					jenis_diskon_transaksi:jenis_diskon_transaksi,
					diskon_transaksi:diskon_transaksi,
					kode_member:kode_member,
					kategori_diskon:kategori_diskon,
					kode_promo:kode_promo,
					kode_merchant:kode_merchant,
					jenis_transaksi:jenis_transaksi,
					nama_bank:nama_bank,
					nomor_rekening:nomor_rekening,
					total_pesanan:total_pesanan,
					diskon_all:diskon_all,
					grand_total:grand_total,
					dibayar:dibayar,
					kembalian:kembalian
				},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success: function(msg)
				{
					
					var link = "<?php echo base_url('kasir/print_invoice'); ?>";

					$.ajax({
						type: "POST",
						url: link,
						data:{kode_transaksi:kode_reservasi},
						success: function(msg)
						{
						}
					});  
					setTimeout(function(){$('.sukses').html(msg);
						$(".tunggu").hide();
						window.location="<?php echo base_url('kasir/order_paket'); ?>";
					},500);      
				}
			});
		}
		
		return false;
	}
	function batal_transaksi() {
		var kode_transaksi=$('#kode_reservasi').val();
		$.ajax({
			url: '<?php echo base_url('kasir/order_paket/batal_transaksi'); ?>',
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

