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

</style>
<a href="<?php echo base_url('kasir'); ?>"><button class="button-back"></button></a>
<div class="clearfix"></div>
<div class="container">
	<div class="row" style="margin-top:20px;">
		<div class="col-sm-12">			
			<div class="col-md-8 form_shadow">
				<?php
				$petugas=$this->session->userdata('astrosession');
				$kode_petugas=@$petugas->id;

				$this->db->where('kode_kasir', $kode_petugas);
				$this->db->where('tanggal',date('Y-m-d'));
				$this->db->where('status','open');
				$this->db->where('validasi','');
				$get_kasir=$this->db->get('transaksi_kasir')->row();

				$kode_transaksi=$this->uri->segment(3);
				$this->db->where('kode_transaksi', $kode_transaksi);
				$this->db->from('clouoid1_olive_kasir.transaksi_layanan');
				$this->db->join('clouoid1_olive_master.master_member', 'clouoid1_olive_kasir.transaksi_layanan.kode_member = clouoid1_olive_master.master_member.kode_member', 'left');
				$get_list=$this->db->get()->row();

				?>
				<div class="row" style="margin-right: 10px">
					<div class="col-md-2 text-center">
						<div class="box-girl">
							<img src="<?php echo base_url(); ?>assets/images/logo_kasir/girl olive.png" style="width: 80%">
						</div>
					</div>
					<div class="col-md-7">
						<input type="text" name="kode_transaksi" id="kode_transaksi" value="<?php echo $kode_transaksi;?>" hidden/>
						<input type="text" name="kode_kasir" id="kode_kasir" value="<?php echo @$get_kasir->kode_transaksi;?>" hidden/>
						<span class="jenis_member">
							<select  class="form-control select2" id="kode_member" name="kode_member" onchange="get_data_member()" disabled>
								<option value="">--- Pilih Member</option>
								<?php
								$this->db->select('kode_member, nama_member');
								$this->db->where('status_member', '1');
								$this->db->from('clouoid1_olive_master.master_member');
								$get_member=$this->db->get()->result();
								foreach ($get_member as $member) {
									?>
									<option <?php if($get_list->kode_member==@$member->kode_member){ echo "selected";}?> value="<?php echo @$member->kode_member;?>"><?php echo @$member->kode_member.' - '.@$member->nama_member;?></option>
									<?php
								}
								?>
							</select>
						</span>
						<div class="col-md-8 btn btn-md btn-no-radius btn-success btn-shadow nama_member" style="padding-left: 0px ;margin-top: 10px">
							
						</div>
						<div class="col-md-4" style="padding-right: 0px ;margin-top: 10px">
							<a onclick="rekam_medis()">
								<div id="rekam" class="btn btn-md btn-primary btn-no-radius btn-shadow" style="width: 100%">REKAM MEDIS</div>
							</a>
						</div>
					</div>
					<div class="col-md-3" style="padding: 0">
						
						<a onclick="profile_cek()">
							<div id="profil" class="btn btn-md btn-primary btn-no-radius btn-shadow" style="width: 48%;margin-top: 0px">PROFIL</div>
						</a>
						
						<button id="join_member" onclick="join_member_layanan();" class="btn btn-md btn-warning btn-no-radius btn-shadow" style="width: 100%;margin-top: 10px">JOIN MEMBER</button>
						<button id="cancel_join_member" onclick="cancel_join_member_layanan();" class="btn btn-md btn-danger btn-no-radius btn-shadow" style="width: 100%;margin-top: 10px">CANCEL JOIN</button>
					</div>
				</div>
			</form><hr><hr>
			<div class="sukses"></div>
			
			<div id="tabel1">
				<table id="" class="table table-striped table-bordered table-advance table-hover">
					<tbody>
						<tr>
							
							<input type="hidden" name="id_temp_layanan" id="id_temp_layanan" value="" hidden/>
							<td width="30%" style="background-color:#229fcd;">
								<input type="hidden" name="jenis_item" id="jenis_item">
								<select required class="form-control data_kasir select2" id="kode_menu_layanan" name="kode_menu_layanan" style="width: 100%" onchange="get_data_layanan()">
									<option value="">--Pilih Treatment--</option>
									<?php
									$this->db->select('kode_perawatan, nama_perawatan');
									$this->db->where('status', '1');
									$this->db->from('clouoid1_olive_master.master_perawatan');
									$get_perawatan=$this->db->get()->result();
									foreach ($get_perawatan as $perawatan) {
										?>
										<option  value="<?php echo @$perawatan->kode_perawatan;?>"><?php echo @$perawatan->kode_perawatan.' - '.@$perawatan->nama_perawatan;?></option>
										<?php
									}
									?>
								</select> 
							</td>
							<td width="13%" style="background-color:#229fcd;">
								<input type="number" name="qty_layanan" id="qty_layanan" class="form-control data_kasir" placeholder="Jumlah" onkeyup="cek_qty_layanan()" onclick="cek_qty_layanan()" value="1">
							</td>
							<td width="20%" style="background-color:#229fcd;">
								<div class="input-icon right" id="form_diskon_item">								
									<input type="number" name="harga_layanan" id="harga_layanan"  class="form-control data_kasir" placeholder="Harga" onkeyup="cek_harga_layanan()" onclick="cek_harga()">
								</div>
							</td>

							<td width="17%" style="background-color:#229fcd;">
								<select  name="jenis_diskon_layanan" id="jenis_diskon_layanan" class="form-control data_kasir">
									<option value="persen" selected="true">Persen</option>
									<option value="rupiah">Rupiah</option>
								</select>
							</td>
							<td width="13%" style="background-color:#229fcd;" id="terapis">
								<div class="input-icon right" id="form_diskon_item">								
									<input type="text" name="diskon_item_layanan" onkeyup="cek_diskon_layanan()" onclick="cek_diskon_layanan()" id="diskon_item_layanan"  class="form-control data_kasir" placeholder="Diskon Persen" value="0">
								</div>
								
							</td>
							<td width="30%" style="background-color:#229fcd;" >
								<select required class="form-control data_kasir select2" id="kode_terapis_layanan" name="kode_terapis_layanan" style="width: 100%" >
									<option value="">--Pilih Terapis--</option>
									<?php
									$this->db->select('kode_karyawan, nama_karyawan');
									$this->db->where('clouoid1_olive_master.master_jabatan.kode_jabatan', 'J_0001');
									$this->db->where('clouoid1_olive_master.master_karyawan.status_karyawan', '1');
									$this->db->from('clouoid1_olive_master.master_karyawan');
									$this->db->join('clouoid1_olive_master.master_jabatan', 'clouoid1_olive_master.master_karyawan.kode_jabatan = clouoid1_olive_master.master_jabatan.kode_jabatan', 'left');

									$get_terapis=$this->db->get()->result();
									foreach ($get_terapis as $terapis) {
										?>
										<option  value="<?php echo @$terapis->kode_karyawan;?>"><?php echo @$terapis->kode_karyawan.' - '.@$terapis->nama_karyawan;?></option>
										<?php
									}
									?>
								</select> 
							</td>
							<td width="7%" style="background-color:#229fcd;" >
								<div id="add_layanan" onclick="simpan_layanan()" class="btn purple data_kasir">Add</div>
								<div id="update_layanan" onclick="update_layanan()" class="btn purple data_kasir">Update</div>
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
						<th style="background-color:#229fcd; color:white" class="text-center">Nama Treatment</th>

						<th style="background-color:#229fcd; color:white" class="text-center" width="50px">Qty</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="100px">Diskon</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Subtotal</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Terapis</th>
						<th style="background-color:#229fcd; color:white" class="text-center" width="170px">Action</th>
					</tr>
				</thead>
				<tbody id="tb_pesan_temp_layanan">
					<tr>
						<td></td>
						<td></td>
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

		<div id="tabel1">
			<table id="" class="table table-striped table-bordered table-advance table-hover">
				<tbody>
					<tr>
						<input type="hidden" name="id_temp" id="id_temp" value="" hidden/>
						<td width="30%" style="background-color:#229fcd;">
							<input type="hidden" name="jenis_item" id="jenis_item">
							<select required class="form-control data_kasir select2" id="kode_menu" name="kode_menu" style="width: 100%" onchange="get_data_produk()">
								<option value="">--Pilih Produk--</option>
								<?php
								$this->db->select('kode_produk, nama_produk');
								$this->db->where('status', '1');
								$this->db->from('clouoid1_olive_master.master_produk');
								$get_produk=$this->db->get()->result();
								foreach ($get_produk as $produk) {
									?>
									<option  value="<?php echo @$produk->kode_produk;?>"><?php echo @$produk->kode_produk.' - '.@$produk->nama_produk;?></option>
									<?php
								}
								?>
							</select> 
						</td>
						<td width="13%" style="background-color:#229fcd;">
							<input type="number" name="qty" id="qty" class="form-control data_kasir" placeholder="Jumlah" onkeyup="cek_qty()" onclick="cek_qty()" value="1">
						</td>
						<td width="20%" style="background-color:#229fcd;">
							<div class="input-icon right" id="form_diskon_item">								
								<input type="number" name="harga" id="harga"  class="form-control data_kasir" placeholder="Harga" onkeyup="cek_harga()" onclick="cek_harga()">
							</div>
						</td>

						<td width="17%" style="background-color:#229fcd;">
							<select  name="jenis_diskon" id="jenis_diskon" class="form-control data_kasir">
								<option value="persen" selected="true">Persen</option>
								<option value="rupiah">Rupiah</option>
							</select>
						</td>
						<td width="13%" style="background-color:#229fcd;" id="terapis">
							<div class="input-icon right" id="form_diskon_item">								
								<input type="text" name="diskon_item" onkeyup="cek_diskon()" onclick="cek_diskon()" id="diskon_item"  class="form-control data_kasir" placeholder="Diskon Persen" value="0">
							</div>
							<input type="hidden" name="kode_edit_penjualan" id="kode_edit_penjualan" />
						</td>
						<td width="30%" style="background-color:#229fcd;" id="tr_terapis">
							<select required class="form-control data_kasir select2" id="kode_terapis" name="kode_terapis" style="width: 100%" >
								<option value="">--Pilih Terapis--</option>
								<?php
								$this->db->select('kode_karyawan, nama_karyawan');
								$this->db->where('clouoid1_olive_master.master_jabatan.kode_jabatan', 'J_0001');
								$this->db->where('clouoid1_olive_master.master_karyawan.status_karyawan', '1');
								$this->db->from('clouoid1_olive_master.master_karyawan');
								$this->db->join('clouoid1_olive_master.master_jabatan', 'clouoid1_olive_master.master_karyawan.kode_jabatan = clouoid1_olive_master.master_jabatan.kode_jabatan', 'left');

								$get_terapis=$this->db->get()->result();
								foreach ($get_terapis as $terapis) {
									?>
									<option  value="<?php echo @$terapis->kode_karyawan;?>"><?php echo @$terapis->kode_karyawan.' - '.@$terapis->nama_karyawan;?></option>
									<?php
								}
								?>
							</select> 
						</td>
						<td width="7%" style="background-color:#229fcd;" >
							<div id="add" onclick="simpan_pesanan_opsi()" class="btn purple data_kasir">Add</div>
							<div id="update" onclick="update_pesanan_opsi()" class="btn purple data_kasir">Update</div>
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
					<th style="background-color:#229fcd; color:white" class="text-center">Nama Produk</th>

					<th style="background-color:#229fcd; color:white" class="text-center" width="50px">Qty</th>
					<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Harga</th>
					<th style="background-color:#229fcd; color:white" class="text-center" width="100px">Diskon</th>
					<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Subtotal</th>
					<th style="background-color:#229fcd; color:white" class="text-center" width="125px">Terapis</th>
					<th style="background-color:#229fcd; color:white" class="text-center" width="170px">Action</th>
				</tr>
			</thead>
			<tbody id="tb_pesan_temp">
				<tr>
					<td></td>
					<td></td>
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
			<select class="form-control data_kasir" id="jenis_diskon_transaksi" name="jenis_diskon_transaksi" onchange="change_jenis_diskon_transaksi()">
				<option value="persen">Persen</option>
				<option value="rupiah">Rupiah</option>
			</select>
		</div>
		<div class="col-md-6">
			<input type="number" autocomplete="off" class="form-control input-lg tagsinput data_kasir" name="diskon_transaksi" id="diskon_transaksi" style="margin-top: 25px" onkeyup="cek_diskon_transaki()" onclick="cek_diskon_transaki()"/>
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
			<a href="<?php echo base_url().'kasir/order_paket'; ?>">
				<img src="<?php echo base_url(''); ?>assets/images/logo_kasir/icon paket.png" style="width: 60px;margin-bottom:7px">
				<label style="font-size: 10px">ORDER PAKET</label>
			</a>
		</div>
		<div class="col-md-4 text-center">	
			<a href="<?php echo base_url().'kasir/layanan_paket'; ?>">
				<img  src="<?php echo base_url(); ?>assets/images/logo_kasir/data paket.png" style="width: 55px;margin-bottom:7px;margin-top:4px">
				<label style="font-size: 10px">DATA PAKET</label>
			</a>
		</div>
		<div class="col-md-4 text-center">	
			<a onclick="list_transaksi()">
				<img src="<?php echo base_url(); ?>assets/images/logo_kasir/list transaksi.png" style="width: 55px;margin-bottom:5px;margin-top:5px">
				<label style="font-size: 10px">LIST TRANSAKSI</label>
			</a>
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
						<option value="member" >Member</option>
						<option value="promo">Promo</option>
						<option value="merchant">Merchant</option>
					</select>
				</span>
			</div>
		</div>
	</div>
	<div style="height:60px;" class="transaksi_promo">
		<div style="height: 40px; margin-top: -20px;" class="form-group">
			<div class="input-group">
				<span class="input-group-addon box-pannel">Promo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span id="golongan">
					<select class="form-control box-pannel data_kasir" id="kode_promo" name="kode_promo" >
						<option selected="true" value="">-- Pilih Promo --</option>
						<?php
						$this->db->select('kode_promo, nama_promo');
						$this->db->where('status', '1');
						$this->db->where('tanggal_awal <=',date('Y-m-d'));
						$this->db->where('tanggal_akhir >=',date('Y-m-d'));
						$this->db->from('clouoid1_olive_master.master_promo');
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
	<div style="height:60px;margin-top: -20px;" class="transaksi_merchant">
		<div style="height: 40px;" class="form-group">
			<div class="input-group">
				<span class="input-group-addon box-pannel">Merchant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span id="golongan">
					<select class="form-control box-pannel data_kasir" id="kode_merchant" name="kode_merchant" >
						<option selected="true" value="">-- Pilih Merchant --</option>
						<?php
						$this->db->select('kode_merchant, nama_merchant');
						$this->db->where('status', '1');
						$this->db->where('tanggal_awal <=',date('Y-m-d'));
						$this->db->where('tanggal_akhir >=',date('Y-m-d'));
						$this->db->from('clouoid1_olive_master.master_merchant');
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
					<select class="form-control box-pannel data_kasir" id="jenis_transaksi" name="jenis_transaksi" onchange="change_jenis_transaksi()">
						<option selected="true" value="tunai">Tunai</option>
						<option value="debit" id="debit">Debit Card</option>
						<option value="kredit" id="kredit">Credit Card</option>
					</select>
				</span>
			</div>
		</div>
	</div>
	<div style="height:60px; margin-top: -20px;" class="transaksi_card">
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
	<div style="height:60px; margin-top: -20px;" class="transaksi_card">
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
				<span >
					<input type="hidden" id="total_no" />
					<input type="hidden" id="total2" />

					<input style="font-size: 30px; height: 38px" onkeyup="kembalian()" step="any" lang="de" type="number" autocomplete="off" class="form-control box-pannel input-lg tagsinput data_kasir" name="dibayar" id="dibayar" />
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
	<div class="btn btn-success btn-lg  btn-no-radius btn-shadow data_kasir" onclick="simpan_transaksi()" style="width: 100%; margin: 5px; margin-left: 0 ">BAYAR</div>
	<a class="btn btn-danger btn-lg  btn-no-radius btn-shadow data_kasir" href="<?php echo base_url('kasir'); ?>" style="width: 100%; margin: 5px; margin-left: 0 ">CANCEL</a>
	<br>
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
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">TRATMENT / PRODUK</div>
							</td>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">QUALITY</div>
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
							<label style="font-size: 10px;color: white;margin-top:5px;">No. KTP</label>
							<input type="text" name="no_ktp" id="no_ktp" readonly class="form-control box-tosca" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Tempat Lahir</label>
							<input type="text" name="tempat_lahir" id="tempat_lahir" readonly class="form-control box-tosca" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Tanggal Lahir</label>
							<input type="date" name="tanggal_lahir" id="tanggal_lahir" readonly class="form-control box-tosca" style="padding: 0px">
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
							<input type="text" name="alamat" id="alamat" readonly class="form-control box-tosca" style="padding: 0px">
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">NO. Telp</label>
							<input type="text" name="no_telp" id="no_telp" readonly class="form-control box-tosca" style="padding: 0px">
						</div>
						<div class="col-md-12">
							<label style="font-size: 10px;color: white;margin-top:5px;">Pekerjaan</label>
							<input type="text" name="pekerjaan" id="pekerjaan" readonly class="form-control box-tosca" style="padding: 0px">
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
<div id="modal-list_transaksi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" style="color: white;width: 85%">
		<div class="modal-content" style="border-radius:0px;background-color:#217377">
			<div class="modal-body" style="height: 640px ; padding: 30px">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="btn-shadow" style="font-size: 18px;width: 300px;height: 45px;padding: 10px; margin: 5px; margin-left: 0;background-color: #ff01cc">LIST TRANSAKSI HARI INI</div><br>
				<div class="row">
					<div class="col-md-5">
						<label>Tanggal Awal</label>
						<input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
					</div>
					<div class="col-md-5">
						<label>Tanggal Akhir</label>
						<input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
					</div>
					<div class="col-md-1">
						<button class="btn btn-shadow btn-lg" onclick="cari_list_filter()" style="margin-top: 22px;background-color: #ff01cc"><i class="fa fa-search"></i></button>
					</div>
				</div>
				<br>
				<div class="col-md-12" style="padding: 0px">
					<div class="btn-shadow" style="font-size: 18px;width: 100%;height: 45px;padding: 10px; margin: 5px; margin-left: 0;background-color: yellow;color: black;">LIST TRANSAKSI HARI INI</div>
				</div>
				<div>            
					
					<table class="table table-striped table-hover table-bordered" id="tabel_daftar" style="background-color: white;color: black">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Transaksi</th>
								<th>Kode Transaksi</th>
								<th>Nama Member</th>
								<th>Nama Layanan</th>
								<th>Grand Total </th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="data_list_transaksi">
							
						</tbody>
					</table>

					<br><br>
					<input type="hidden" class="form-control rowcount" value="1">
					<input type="hidden" class="form-control pagenum " value="0">
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-Poin" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" style="color: white;width: 85%">
		<div class="modal-content" style="border-radius:0px;background-color:#217377">
			<div class="modal-body" style="height: 640px ; padding: 30px">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<center>
					<img src="<?php echo base_url(); ?>assets/images/logo_kasir/logo.png" style="width: 60px" alt="Olive">
					<h4 class="modal-title">OLIVE TREE</h4>
					<div class="btn-shadow" style="font-size: 18px;width: 300px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: #ff01cc">Transaksi Poin Member</div><br>
				</center>
				<div class="row" style="margin: 10px">
					<div class="col-md-12">
						<div class="col-md-2">
							<label style="font-size: 10px">Kode Customer</label>
							<input type="text" name="kode_customer" id="kode_customer_poin" readonly="" class="form-control box-tosca">
						</div>
						<div class="col-md-8">
							<label style="font-size: 10px">Nama Customer</label>
							<input type="text" name="nama_customer" id="nama_customer_poin" readonly class="form-control box-tosca">
						</div>
						<div class="col-md-2">
							<label style="font-size: 10px">Poin</label>
							<input type="text" name="poin" id="data_poin" readonly class="form-control box-tosca">
						</div>
					</div>
				</div>
				<div class="col-md-12" style="background-color: white;padding: 0;margin-left: 30px;width: 94%">
					<table width="100%" class="table_rekam_medis">
						<thead>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">TRATMENT / PRODUK</div>
							</td>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">QTY</div>
							</td>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">Poin</div>
							</td>
							<td style="background-color: #217377;">
								<div class="btn-shadow text-center" style="font-size: 18px;height: 35px;padding: 5px; margin: 5px; margin-left: 0;background-color: yellow;color:black">Action</div>
							</td>
						</thead>
						<tbody id="data_poin_member" style="color: black;">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function rekam_medis() {
		$('#modal-RekamMedis').modal('show');
		var kode_member=$('#kode_member').val();
		$('#data_rekam_medis').load('<?php echo base_url('kasir/table_rekam_medis'); ?>/'+kode_member);
	}
	function profile_cek() {
		$('#modal-Profil').modal('show');
	}
	function list_transaksi() {
		$('#modal-list_transaksi').modal('show');
		$('#data_list_transaksi').load('<?php echo base_url('kasir/table_list_transaksi'); ?>');
	}
	function cari_list_filter() {
		var tgl_awal=$('#tgl_awal').val();
		var tgl_akhir=$('#tgl_akhir').val();
		$.ajax({
			url: '<?php echo base_url('kasir/table_list_transaksi'); ?>',
			type: 'post',
			data:{tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
			success: function(hasil){
				$('#data_list_transaksi').html(hasil);				
			}
		});
	}

	$(document).ready(function() {
		$('.nama_member').text('Nama Member');
		$('#tr_terapis').hide();
		$('#update_layanan').hide();
		$('#update').hide();
		$('.transaksi_promo').hide();
		$('.transaksi_merchant').hide();
		$('.transaksi_card').hide();
		$('#cancel_join_member').hide();
		get_data_member();
		load_table_temp();
	});
	
	function get_data_member() {
		var kode_member=$('#kode_member').val();
		$.ajax({
			url: '<?php echo base_url('kasir/get_data_member'); ?>',
			type: 'post',
			data:{kode_member:kode_member},
			dataType:'json',
			success: function(hasil){
				$('.nama_member').text(hasil.nama_member);
				$('#kode_customer_poin').val(hasil.kode_member);
				$('#nama_customer_poin').val(hasil.nama_member);
				$('#data_poin').val(hasil.poin);
				$('#kode_customer').val(hasil.kode_member);
				$('#nama_customer').val(hasil.nama_member);
				$('#poin').val(hasil.poin);
				$('#no_ktp').val(hasil.no_ktp);
				$('#no_telp').val(hasil.no_telp);
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
	function join_member_layanan() {
		var kode_transaksi=$('#kode_transaksi').val();
		var kode_member=$('#kode_member').val();
		if(kode_member==''){
			alert("Pilih Member !");
		}else{
			$.ajax({
				url: '<?php echo base_url('kasir/simpan_kartu_member_layanan'); ?>',
				type: 'post',
				data:{kode_transaksi:kode_transaksi,kode_member:kode_member},
				dataType:'json',
				success: function(hasil){
					if(hasil.respon=='gagal'){
						$(".sukses").html('<div class="alert alert-danger" >Stok Tidak Cukup</div>');
						setTimeout(function(){$('.sukses').html('');},1500); 

					}else{
						$('#join_member').hide();
						$('#cancel_join_member').show();
						
						load_table_temp();
					}

				}
			});
		}
	}
	function cancel_join_member_layanan() {
		var kode_transaksi=$('#kode_transaksi').val();
		var kode_member=$('#kode_member').val();
		$.ajax({
			url: '<?php echo base_url('kasir/delete_kartu_member_layanan'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi,kode_member:kode_member},
			success: function(hasil){
				$('#join_member').show();
				$('#cancel_join_member').hide();
				load_table_temp();
			}
		});
	}
	function get_data_layanan() {
		var kode_menu_layanan=$('#kode_menu_layanan').val();
		$.ajax({
			url: '<?php echo base_url('kasir/get_data_layanan'); ?>',
			type: 'post',
			data:{kode_menu_layanan:kode_menu_layanan},
			dataType:'json',
			success: function(hasil){
				$('#harga_layanan').val(hasil.harga_jual);				
			}
		});
	}
	function get_data_produk() {
		var kode_menu=$('#kode_menu').val();
		$.ajax({
			url: '<?php echo base_url('kasir/get_data_produk'); ?>',
			type: 'post',
			data:{kode_menu:kode_menu},
			dataType:'json',
			success: function(hasil){
				$('#harga').val(hasil.harga_jual);
				$('#jenis_item').val(hasil.nama_kategori_produk);
				if(hasil.insentif_masker =='' || hasil.insentif_masker ==null){
					$('#tr_terapis').hide();
					$('#kode_terapis').val('').trigger("change");
				}else{
					$('#tr_terapis').show();
					$('#kode_terapis').val('').trigger("change");
				}
			}
		});
	}
	function cek_qty() {
		var qty=$('#qty').val();
		if(parseInt(qty) <=0 || qty=='-'){
			alert("QTY Salah !");
			$('#qty').val('');
		}
	}
	function cek_harga() {
		var harga=$('#harga').val();
		if(parseInt(harga) <=0 || harga=='-'){
			alert("Harga Salah !");
			$('#harga').val('');
		}
	}
	function cek_diskon() {
		var diskon_item=$('#diskon_item').val();
		
		var jenis_diskon=$('#jenis_diskon').val();
		var harga=$('#harga').val();
		var qty=$('#qty').val();
		var subtotal=parseInt(harga)*parseInt(qty);
		if(parseInt(diskon_transaksi) <=0 || diskon_item=='-'){
			alert("Diskon Salah !");
			$('#diskon_item').val('');
		}else if(jenis_diskon=='persen' && parseInt(diskon_item) >100){
			alert("Diskon Salah !");
			$('#diskon_item').val('');
		}else if(jenis_diskon=='rupiah' && parseInt(diskon_item) > parseInt(subtotal)){
			alert("Diskon Salah !");
			$('#diskon_item').val('');
		}
	}
	function cek_qty_layanan() {
		var qty_layanan=$('#qty_layanan').val();
		if(parseInt(qty_layanan) <=0 || qty_layanan=='-'){
			alert("QTY Salah !");
			$('#qty_layanan').val('');
		}
	}
	function cek_harga_layanan() {
		var harga_layanan=$('#harga_layanan').val();
		if(parseInt(harga_layanan) <=0 || harga_layanan=='-'){
			alert("Harga Salah !");
			$('#harga_layanan').val('');
		}
	}
	function cek_diskon_layanan() {
		var diskon_item_layanan=$('#diskon_item_layanan').val();
		
		var jenis_diskon_layanan=$('#jenis_diskon_layanan').val();
		var harga_layanan=$('#harga_layanan').val();
		var qty_layanan=$('#qty_layanan').val();
		var subtotal=parseInt(harga_layanan)*parseInt(qty_layanan);
		if(parseInt(diskon_transaksi) <=0 || diskon_item_layanan=='-'){
			alert("Diskon Salah !");
			$('#diskon_item_layanan').val('');
		}else if(jenis_diskon_layanan=='persen' && parseInt(diskon_item_layanan) >100){
			alert("Diskon Salah !");
			$('#diskon_item_layanan').val('');
		}else if(jenis_diskon_layanan=='rupiah' && parseInt(diskon_item_layanan) > parseInt(subtotal)){
			alert("Diskon Salah !");
			$('#diskon_item_layanan').val('');
		}
	}
	function actPoin(id) {
		$('#modal-Poin').modal('show');
		$('#data_poin_member').load('<?php echo base_url('kasir/tabel_layanan_poin'); ?>/'+id);
		
	}
	function gunakan_poin(id,obj) {
		var kode_member=$('#kode_member').val();
		var kode_transaksi=$('#kode_transaksi').val();
		$.ajax({
			url: '<?php echo base_url('kasir/gunakan_poin_member_opsi'); ?>',
			type: 'post',
			data:{id:id,kode_member:kode_member,kode_transaksi:kode_transaksi},
			dataType:'json',
			success: function(hasil){
				if(hasil.respon=='sukses'){
					load_table_temp();
					$(obj).hide();
				}else if(hasil.respon=='qty_kurang'){
					alert('QTY Penjualan Kurang !');
				}else{
					alert('Poin Tidak Mencukupi !');
				}
				
			}
		});
	}
	function load_table_temp() {
		var kode_transaksi=$('#kode_transaksi').val();
		$('#tb_pesan_temp_layanan').load('<?php echo base_url('kasir/table_opsi_layanan'); ?>/'+kode_transaksi+'/Treatment');

		$('#tb_pesan_temp').load('<?php echo base_url('kasir/table_opsi_layanan'); ?>/'+kode_transaksi+'/produk');
		get_total_pesanan();
	}

	function simpan_layanan() {
		var kode_transaksi=$('#kode_transaksi').val();
		var kode_menu=$('#kode_menu_layanan').val();
		var qty=$('#qty_layanan').val();
		var harga=$('#harga_layanan').val();
		var jenis_diskon=$('#jenis_diskon_layanan').val();
		var diskon_item=$('#diskon_item_layanan').val();
		var kode_terapis=$('#kode_terapis_layanan').val();
		$.ajax({
			url: '<?php echo base_url('kasir/simpan_layanan'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi,kode_menu:kode_menu,qty:qty,harga:harga,jenis_diskon:jenis_diskon,diskon_item:diskon_item,kode_terapis:kode_terapis},
			dataType:'json',
			success: function(hasil){
				if(hasil.respon=='gagal'){
					$(".sukses").html('<div class="alert alert-danger" >Stok Tidak Cukup</div>');
					setTimeout(function(){$('.sukses').html('');},1500); 

				}else{
					$('#kode_menu_layanan').val('').trigger('change');
					$('#qty_layanan').val(1);
					$('#harga_layanan').val('');
					$('#jenis_diskon_layanan').val('persen');
					$('#diskon_item_layanan').val('');
					$('#jenis_item_layanan').val('');
					$('#kode_terapis_layanan').val('').trigger('change');
					load_table_temp();
				}
				
			}
		});
	}
	function simpan_pesanan_opsi() {
		var kode_transaksi=$('#kode_transaksi').val();
		var kode_menu=$('#kode_menu').val();
		var qty=$('#qty').val();
		var harga=$('#harga').val();
		var jenis_diskon=$('#jenis_diskon').val();
		var diskon_item=$('#diskon_item').val();
		var kode_terapis=$('#kode_terapis').val();
		var jenis_item=$('#jenis_item').val();
		$.ajax({
			url: '<?php echo base_url('kasir/simpan_pesanan_opsi'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi,kode_menu:kode_menu,qty:qty,harga:harga,jenis_diskon:jenis_diskon,diskon_item:diskon_item,kode_terapis:kode_terapis,jenis_item:jenis_item},
			dataType:'json',
			success: function(hasil){
				if(hasil.respon=='gagal'){
					$(".sukses").html('<div class="alert alert-danger" >Stok Tidak Cukup</div>');
					setTimeout(function(){$('.sukses').html('');},1500); 

				}else{
					$('#kode_menu').val('').trigger('change');
					$('#qty').val(1);
					$('#harga').val('');
					$('#jenis_diskon').val('persen');
					$('#diskon_item').val('');
					$('#jenis_item').val('');
					$('#kode_terapis').val('').trigger('change');
					load_table_temp();
				}
				
			}
		});
	}
	function actDelete(key) {
		$.ajax({
			url: '<?php echo base_url('kasir/hapus_opsi'); ?>',
			type: 'post',
			data:{id:key},
			success: function(hasil){
				load_table_temp();
			}
		});
	}
	function actEdit(key) {
		$.ajax({
			url: '<?php echo base_url('kasir/get_data_opsi'); ?>',
			type: 'post',
			data:{id:key},
			dataType:'json',
			success: function(hasil){
				if(hasil.jenis_item=='treatment' || hasil.jenis_item=='Treatment'){
					if(hasil.ambil_paket=='Ya'){
						$('#kode_menu_layanan').attr("disabled",true);
						$('#qty_layanan').attr("disabled",true);
						$('#harga_layanan').attr("disabled",true);
						$('#jenis_diskon_layanan').attr("disabled",true);
						$('#diskon_item_layanan').attr("disabled",true);
					}else{
						$('#kode_menu_layanan').attr("disabled",false);
						$('#qty_layanan').attr("disabled",false);
						$('#harga_layanan').attr("disabled",false);
						$('#jenis_diskon_layanan').attr("disabled",false);
						$('#diskon_item_layanan').attr("disabled",false);
					}
					$('#id_temp_layanan').val(hasil.id);
					$('#kode_menu_layanan').val(hasil.kode_item).trigger('change');
					$('#qty_layanan').val(hasil.qty);
					$('#harga_layanan').val(hasil.harga);
					$('#jenis_diskon_layanan').val(hasil.jenis_diskon);
					if(hasil.jenis_diskon=='persen'){
						$('#diskon_item_layanan').val(hasil.diskon_persen);
					}else{
						$('#diskon_item_layanan').val(hasil.diskon_rupiah);
					}
					$('#jenis_item_layanan').val(hasil.jenis_item);
					$('#kode_terapis_layanan').val(hasil.kode_terapis).trigger('change');

					$('#add_layanan').hide();
					$('#update_layanan').show();
				}else{
					if(hasil.ambil_paket=='Ya'){
						$('#kode_menu').attr("disabled",true);
						$('#qty').attr("disabled",true);
						$('#harga').attr("disabled",true);
						$('#jenis_diskon').attr("disabled",true);
						$('#diskon_item').attr("disabled",true);
					}else{
						$('#kode_menu').attr("disabled",false);
						$('#qty').attr("disabled",false);
						$('#harga').attr("disabled",false);
						$('#jenis_diskon').attr("disabled",false);
						$('#diskon_item').attr("disabled",false);
					}

					$('#id_temp').val(hasil.id);
					$('#kode_menu').val(hasil.kode_item).trigger('change');
					$('#qty').val(hasil.qty);
					$('#harga').val(hasil.harga);
					$('#jenis_diskon').val(hasil.jenis_diskon);
					if(hasil.jenis_diskon=='persen'){
						$('#diskon_item').val(hasil.diskon_persen);
					}else{
						$('#diskon_item').val(hasil.diskon_rupiah);
					}
					$('#jenis_item').val(hasil.jenis_item);
					$('#kode_terapis').val(hasil.kode_terapis).trigger('change');

					$('#add').hide();
					$('#update').show();
				}
				
			}
		});
	}
	function update_pesanan_opsi() {
		var id_temp=$('#id_temp').val();
		var kode_menu=$('#kode_menu').val();
		var qty=$('#qty').val();
		var harga=$('#harga').val();
		var jenis_diskon=$('#jenis_diskon').val();
		var diskon_item=$('#diskon_item').val();
		var kode_terapis=$('#kode_terapis').val();
		var jenis_item=$('#jenis_item').val();
		$.ajax({
			url: '<?php echo base_url('kasir/update_pesanan_opsi'); ?>',
			type: 'post',
			data:{id_temp:id_temp,kode_menu:kode_menu,qty:qty,harga:harga,jenis_diskon:jenis_diskon,diskon_item:diskon_item,kode_terapis:kode_terapis,jenis_item:jenis_item},
			dataType:'json',
			success: function(hasil){
				if(hasil.respon=='gagal'){
					$(".sukses").html('<div class="alert alert-danger" >Stok Tidak Cukup</div>');
					setTimeout(function(){$('.sukses').html('');},1500); 

				}else{

					$('#kode_menu').attr("disabled",false);
					$('#qty').attr("disabled",false);
					$('#harga').attr("disabled",false);
					$('#jenis_diskon').attr("disabled",false);
					$('#diskon_item').attr("disabled",false);

					$('#kode_menu').val('').trigger('change');
					$('#qty').val(1);
					$('#harga').val('');
					$('#jenis_diskon').val('persen');
					$('#diskon_item').val('');
					$('#jenis_item').val('');
					$('#kode_terapis').val('').trigger('change');

					$('#add').show();
					$('#update').hide();

					load_table_temp();
				}
			}
		});
	}
	function update_layanan() {
		var id_temp=$('#id_temp_layanan').val();
		var kode_menu=$('#kode_menu_layanan').val();
		var qty=$('#qty_layanan').val();
		var harga=$('#harga_layanan').val();
		var jenis_diskon=$('#jenis_diskon_layanan').val();
		var diskon_item=$('#diskon_item_layanan').val();
		var kode_terapis=$('#kode_terapis_layanan').val();
		var jenis_item=$('#jenis_item_layanan').val();
		$.ajax({
			url: '<?php echo base_url('kasir/update_layanan'); ?>',
			type: 'post',
			data:{id_temp:id_temp,kode_menu:kode_menu,qty:qty,harga:harga,jenis_diskon:jenis_diskon,diskon_item:diskon_item,kode_terapis:kode_terapis,jenis_item:jenis_item},
			dataType:'json',
			success: function(hasil){
				if(hasil.respon=='gagal'){
					$(".sukses").html('<div class="alert alert-danger" >Stok Tidak Cukup</div>');
					setTimeout(function(){$('.sukses').html('');},1500); 

				}else{
					$('#kode_menu_layanan').attr("disabled",false);
					$('#qty_layanan').attr("disabled",false);
					$('#harga_layanan').attr("disabled",false);
					$('#jenis_diskon_layanan').attr("disabled",false);
					$('#diskon_item_layanan').attr("disabled",false);

					$('#kode_menu_layanan').val('').trigger('change');
					$('#qty_layanan').val(1);
					$('#harga_layanan').val('');
					$('#jenis_diskon_layanan').val('persen');
					$('#diskon_item_layanan').val('');
					$('#jenis_item_layanan').val('');
					$('#kode_terapis_layanan').val('').trigger('change');

					$('#add_layanan').show();
					$('#update_layanan').hide();

					load_table_temp();
				}
			}
		});
	}
	function get_total_pesanan() {
		var kode_transaksi=$('#kode_transaksi').val();
		var diskon_transaksi=$('#diskon_transaksi').val();
		var jenis_diskon_transaksi=$('#jenis_diskon_transaksi').val();
		$.ajax({
			url: '<?php echo base_url('kasir/get_total_pesanan_layanan'); ?>',
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
		}else{
			get_total_pesanan();
		}
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

	function batal_transaksi() {
		var kode_transaksi=$('#kode_transaksi').val();
		$.ajax({
			url: '<?php echo base_url('kasir/batal_transaksi'); ?>',
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
	function simpan_transaksi() {
		var kode_transaksi=$('#kode_transaksi').val();
		var kode_kasir=$('#kode_kasir').val();
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
		if(kategori_diskon=='promo' && kode_promo==''){
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
				url: '<?php echo base_url('kasir/simpan_transaksi_layanan'); ?>',
				type: 'post',
				data:{
					kode_transaksi:kode_transaksi,
					kode_kasir:kode_kasir,
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
					$('.tunggu').show();
				},
				success: function(hasil){
					print_invoice();
					$(".sukses").html(data);
					window.location="<?php echo base_url('kasir'); ?>";

				}
			});
		}
	}
	function print_invoice(){
		var kode_transaksi=$('#kode_transaksi').val();
		$.ajax({
			url: '<?php echo base_url('kasir/print_invoice'); ?>',
			type: 'post',
			data:{kode_transaksi:kode_transaksi},
			success: function(hasil){

			}
		});
	}
</script>
