<style>
.padding_min {
	padding: 2px !important;
}

.box-tag {
	background-color: grey;
	color:white;
	font-family: segoe ui;
}
</style>
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">POS</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>POS </h1>

	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah POS </span>
					<a href="<?php echo base_url('penjualan/pos/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah POS</a>
					<a href="<?php echo base_url('penjualan/pos/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data POS</a>
				</div>
				<div class="panel-body">					
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-primary btn-no-radius pull-right" onclick="$('#modal-kode-tr').modal('show')"><i class="fa fa-plus"></i> Pesanan</button>
							</div>
						</div><br>
						<?php
						$get_setting=$this->db->get('setting');
						$hasil_setting=$get_setting->row();
						$kode_unit_jabung=@$hasil_setting->kode_unit;
						?>
						<input type="hidden" name="kode_penjualan" id="kode_penjualan" value="<?php echo 'PEN_'.date('ymdHis')?>">
						<input type="hidden" name="kode_pesanan" id="kode_pesanan">
						<div class="row">
							<div class="col-md-8">
								<div class="row" style="background-color:white;padding: 10px;">
									<div class="col-md-4 padding_min">
										<select name="kategori_penjualan" id="kategori_penjualan" class="form-control" onchange="change_kategori_penjualan()">
											<option value="non_member">Non Member</option>
											<option value="member">Member</option>
										</select>
									</div>
									<div class="col-md-6 padding_min" id="pilih_member">
										<select name="kode_member" id="kode_member" class="form-control select2" onchange="change_member()">
											<option value="">- Pilih Member</option>
											<?php
											$this->db_master->where('kode_unit_jabung', $kode_unit_jabung);
											$get_member=$this->db_master->get('master_member');
											$hasil_member=$get_member->result();
											foreach ($hasil_member as $member) {
												?>
												<option value="<?php echo @$member->kode_member;?>"><?php echo @$member->nama_pic.' - '.@$member->nama_perusahaan;?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-md-1 padding_min">
										<button id="btn-lock" class="btn btn-warning btn-no-radius btn-md" onclick="lock_member()">LOCK</button>
										<button id="btn-cancel" class="btn btn-danger btn-no-radius btn-md" onclick="unlock_member()">CANCEL</button>
									</div>
								</div>
								<div id="sukses"></div>
								<div class="row" style="background-color:white;padding: 10px;">
									<div class="col-md-3 padding_min">
										<input type="hidden" id="id_opsi">
										<select name="kode_produk" id="kode_produk" onchange="change_produk()" class="form-control input_transaksi select2">
											<option value="">-- Pilih Produk</option>
											<?php
											$this->db_master->where('kode_unit_jabung', $kode_unit_jabung);
											$get_produk=$this->db_master->get('master_produk');
											$hasil_produk=$get_produk->result();
											foreach ($hasil_produk as $produk) {
												?>
												<option value="<?php echo @$produk->kode_produk;?>"><?php echo @$produk->nama_produk;?></option>
												<?php
											}
											?>
										</select>
										<input type="hidden" name="kode_satuan" id="kode_satuan">
									</div>
									<div class="col-md-1 padding_min">
										<input type="number" id="qty" class="form-control input_transaksi" placeholder="QTY" onkeyup="cek_qty()">
									</div>
									<div class="col-md-2 padding_min">
										<input type="text" id="harga" class="form-control input_transaksi" readonly placeholder="Harga">
									</div>
									<div class="col-md-2 padding_min">
										<select name="diskon_peritem" id="diskon_peritem" onchange="change_diskon_item()" class="form-control input_transaksi">
											<option value="persen">% Persen </option>
											<option value="rupiah">Rp Rupiah </option>
										</select>
									</div>
									<div class="col-md-2 padding_min">
										<input type="number" id="diskon_persen_item" class="form-control input_transaksi" onkeyup="cek_persen()" placeholder="Persen">
										<input style="display: none" id="diskon_rupiah_item" onkeyup="cek_rupiah()" type="number" class="form-control input_transaksi" placeholder="Rupiah">
									</div>
									<div class="col-md-2 padding_min" id="exppire_date_member" >
										<input type="date" name="tanggal_expired" id="tanggal_expired" class="form-control input_transaksi" placeholder="ED">
									</div>
									<div class="col-md-2 padding_min pull-right">
										<button onclick="add_item()" class="btn btn-info btn-no-radius btn-md pull-right input_transaksi btn-add"><i class="fa fa-plus"></i> Add</button>
										<button onclick="update_item()" class="btn btn-info btn-no-radius btn-md pull-right input_transaksi btn-update"><i class="fa fa-save"></i> Update</button>
									</div>
								</div>
								<div class="row" style="background-color:white;padding: 10px;">
									<div class="col-md-12 padding_min">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>No.</th>
													<th>Nama Produk</th>
													<th>QTY</th>
													<th>Harga</th>
													<th>Subtotal</th>
													<th>Diskon</th>
													<th>Expired Date</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="opsi_temp">
												
											</tbody>
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group">
											<span class="input-group-addon"  id="basic-addon1">Jenis Diskon (All)</span>
											<select name="" id="jenis_all_diskon" onchange="change_all_diskon()" class="form-control input_transaksi">
												<option value="persen">Persen (%)</option>
												<option value="rupiah">Rupiah (Rp)</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="input-group" id="all_persen">
											<input type="number" id="all_diskon_persen" onkeyup="cek_diskon_input()" class="form-control input_transaksi">
											<span class="input-group-addon" id="basic-addon1">%</span>
										</div>
										<div class="input-group" id="all_rupiah" style="display: none">
											<span class="input-group-addon" id="all_rupiah_input" id="basic-addon1">Rp.</span>
											<input type="number" id="all_diskon_rupiah" onkeyup="cek_diskon_input()" class="form-control input_transaksi">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="box-tag" style="background-color: #c49f47;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="text_total_pesanan"> Rp. 0,0</span>
											
											<p style="font-size: 18px;">Total Pesanan</p>
										</div>
										<input type="hidden" name="total_pesanan" id="total_pesanan" value="">
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="box-tag" style="background-color: #cb5a5e;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="text_nominal_diskon">Rp. 0,0</span>
											
											<p style="font-size: 18px;">Discount</p>
										</div>
										<input type="hidden" name="nominal_diskon" id="nominal_diskon">
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="box-tag" style="background-color: #3598dc;height:40px; padding: 0px 10px 0px 10px; margin-bottom:5px">
											<span style="font-size:22px; " class="pull-right" id="text_grantotal">Rp. 0,0</span>
											
											<p style="font-size: 18px;">Grand Total</p>
										</div>
										<input type="hidden" name="grandtotal" id="grandtotal">
									</div>
								</div>

								<div class="row" style="margin-top: 10px">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">Jenis Transaksi &nbsp</span>
											<select name="jenis_transaksi" id="jenis_transaksi" onchange="change_jenis_transaksi()" class="form-control input_transaksi">
												<option value="tunai">Tunai</option>
												<option value="kredit">Kredit</option>
												<option value="konsinyasi">Konsinyasi</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 10px" id="input_jatuh_tempo">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">&nbsp&nbspJatuh Tempo&nbsp&nbsp&nbsp&nbsp</span>
											<input type="date" id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" class="form-control input_transaksi">
										</div>
									</div>
								</div>
								<div class="row" style="margin-top: 10px">
									<div class="col-md-12">
										<div class="input-group">
											<span class="input-group-addon" id="basic-addon1">&nbsp&nbspOnkos Kirim &nbsp&nbsp&nbsp&nbsp</span>
											<input type="number" id="ongkir" name="ongkir" onkeyup="cek_ongkir()" class="form-control input_transaksi">
										</div>
									</div>
								</div>
								<div class="row"><br>
									<div class="col-md-12">
										<button onclick="confrim_bayar()" class="btn btn-info btn-no-radius btn-block btn-lg input_transaksi">BAYAR</button>
									</div>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="modal-kode-tr" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Transaksi Penjualan</h4>
			</div>
			<div class="modal-body">
				<h5>Kode Pesanan</h5>
				<select name="select_pesanan" class="form-control select2 " id="select_pesanan" style="width: 100%;">
					<option value="">-- Pilih Kode Pesanan</option>
					<?php
					$this->db->where('kan_suol.transaksi_penjualan_pesanan.status','sudah_dijadwalkan' );
					$this->db->where('kan_suol.transaksi_penjualan_pesanan.proses_kasir','proses' );
					$this->db->from('kan_suol.transaksi_penjualan_pesanan');
					$this->db->join('kan_master.master_member', 'kan_master.master_member.kode_member = kan_suol.transaksi_penjualan_pesanan.kode_member'); 
					$get_tr =$this->db->get()->result();
					foreach ($get_tr as $value) { ?>
					<option value="<?php echo $value->kode_pesanan ?>"><?php echo $value->kode_pesanan ?> - <?php echo $value->nama_pic ?></option>
					<?php }
					?>
				</select>
			</div>
			<div class="modal-footer">
				<a data-dismiss="modal" class="btn btn-danger btn-no-radius btn-md" >Cancel</a>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="cari_transaksi_pesanan()" >Cari</a>
			</div>
		</div>
	</div>
</div>
<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="id_temp">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger" onclick="hapus_temp()"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Confirmasi</h4>
			</div>
			<div class="modal-body">
				<h3>Apakah anda yakin ingin menyimpan data tersebut ?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-no-radius btn-md" data-dismiss="modal">Cancel</button>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="simpan_transaksi()" >Yakin</a>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
	$('#kode_member').attr('disabled',true);
	$('.input_transaksi').attr('disabled',true);
	$('#btn-cancel').hide();
	$('.btn-update').hide();
	$('.select2').select2();
	$('#input_jatuh_tempo').hide();


});
function cari_transaksi_pesanan(){

	kode_pesanan = $('#select_pesanan').val();
	kode_penjualan = $('#kode_penjualan').val();

	$.ajax({
		url: '<?php echo base_url('penjualan/pos/cari_transaksi_pesanan'); ?>',
		type: 'post',
		data:{kode_pesanan:kode_pesanan,kode_penjualan:kode_penjualan},
		beforeSend:function(){
			$(".tunggu").show();
			$('#modal-kode-tr').modal('hide');
		},
		dataType:'json',
		success: function(response){
			$(".tunggu").hide();
			load_temp();
			if(response.kode_pesanan){
				$('#kategori_penjualan').val('member');
				$('#kode_pesanan').val(response.kode_pesanan);
				$('#kode_member').val(response.kode_member).trigger('change');
				lock_member();
				change_member();
			}

		}
	});
}
function lock_member(){

	kategori_penjualan = $('#kategori_penjualan').val();
	kode_member = $('#kode_member').val();
	if(kategori_penjualan == 'member' && kode_member ==''){
		alert('Pilih Member !');
	}else{
		$('.input_transaksi').attr('disabled',false);
		$('#btn-lock').hide();
		$('#btn-cancel').show();
		$('#kode_member').attr('disabled',true);
		$('#kategori_penjualan').attr('disabled',true);
	}
}
function unlock_member(){

	$('.input_transaksi').attr('disabled',true);
	$('#btn-lock').show();
	$('#btn-cancel').hide();
	$('#kode_member').attr('disabled',false);
	$('#kategori_penjualan').attr('disabled',false);
	kode_penjualan = $('#kode_penjualan').val();

	$.ajax({
		url: '<?php echo base_url('penjualan/pos/delete_all_temp'); ?>',
		type: 'post',
		data:{kode_penjualan:kode_penjualan},
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(response){
			window.location.reload();
		}
	});

}

function change_all_diskon(){
	jenis_all_diskon 	= $('#jenis_all_diskon').val();

	if (jenis_all_diskon == 'persen') {
		$('#all_persen').show();
		$('#all_rupiah').hide();
	}else{
		$('#all_persen').hide();
		$('#all_rupiah').show();
	}
	$('#all_diskon_persen').val('');
	$('#all_diskon_rupiah').val('');
	$('#nominal_diskon').val(0);
	get_total_penjualan();
}

function change_diskon_item(){
	diskon_peritem = $('#diskon_peritem').val();

	if (diskon_peritem == 'persen') {
		$('#diskon_persen_item').show();
		$('#diskon_rupiah_item').hide();
		$('#diskon_rupiah_item').val('');
		$('#diskon_persen_item').val('');
	}else {
		$('#diskon_persen_item').hide();
		$('#diskon_rupiah_item').show();
		$('#diskon_rupiah_item').val('');
		$('#diskon_persen_item').val('');
	}
}

function change_kategori_penjualan(){
	kategori_penjualan = $('#kategori_penjualan').val();
	if(kategori_penjualan == 'member'){
		$('#kode_member').attr('disabled',false);
	}else{
		$('#kode_member').val('').trigger('change');
		$('#kode_member').attr('disabled',true);
	}
}

function change_member(){
	kode_member = $('#kode_member').val();
	$.ajax({
		url: '<?php echo base_url('penjualan/pos/get_data_member'); ?>',
		type: 'post',
		data:{kode_member:kode_member},
		dataType:'Json',
		success: function(response){
			$('#ongkir').val(response.ongkir);
			$('#ongkir').attr('readonly',true);
			if(response.kategori_member=='Member Konsinyasi'){
				$("#jenis_transaksi option[value=kredit]").hide();
			}else{
				$("#jenis_transaksi option[value=kredit]").show();
			}
			cek_ongkir();
		}
	});
}
function cek_persen(){
	diskon = $('#diskon_persen_item').val();
	if (parseInt(diskon) < 0 || parseInt(diskon) > 100) {
		alert('Pengisian Diskon Salah.');
		$('#diskon_persen_item').val('');
	}
}
function cek_rupiah(){
	diskon = $('#diskon_rupiah_item').val();
	if (parseInt(diskon) < 0 ) {
		alert('Pengisian Diskon Salah.');
		$('#diskon_rupiah_item').val('');
	}
}

function cek_diskon_input(){
	jenis_all_diskon 	= $('#jenis_all_diskon').val();
	diskon_persen = $('#all_diskon_persen').val();
	diskon_rupiah = $('#all_diskon_rupiah').val();
	total_pesanan = $('#total_pesanan').val();
	if (jenis_all_diskon == 'persen' && (parseInt(diskon_persen) < 0 || parseInt(diskon_persen) > 100)) {
		alert('Pengisian Diskon Salah.');
		$('#all_diskon_persen').val('');
	}else if(jenis_all_diskon == 'rupiah' && (parseInt(diskon_rupiah) < 0 || parseInt(diskon_rupiah) > parseInt(total_pesanan))){
		alert('Pengisian Diskon Salah.');
		$('#all_diskon_rupiah').val('');
	}else{

		if(jenis_all_diskon == 'persen'){
			diskon_rp=(total_pesanan * diskon_persen) /100;
			$('#nominal_diskon').val(diskon_rp);
			$('#text_nominal_diskon').html(toRp(diskon_rp));
		}else{
			$('#nominal_diskon').val(diskon_rupiah);
			$('#text_nominal_diskon').html(toRp(diskon_rupiah));
		}

	}
	get_total_penjualan();
}
function cek_qty(){
	qty = $('#qty').val();
	if (parseInt(qty) < 0 ) {
		alert('Pengisian QTY Salah.');
		$('#qty').val('');
	}
}
function cek_ongkir(){
	ongkir = $('#ongkir').val();
	if (parseInt(ongkir) < 0 ) {
		alert('Pengisian Ongkos Kirim Salah.');
		$('#ongkir').val('');
	}
	get_total_penjualan();

}
function change_produk(){
	kode_produk = $('#kode_produk').val();
	kode_member = $('#kode_member').val();
	$.ajax({
		url: '<?php echo base_url('penjualan/pos/get_data_produk'); ?>',
		type: 'post',
		data:{kode_produk:kode_produk,kode_member:kode_member},
		dataType:'Json',
		success: function(response){
			$('#harga').val(response.harga);
			$('#kode_satuan').val(response.kode_satuan);
		}
	});
}
function load_temp(){
	kode_penjualan = $('#kode_penjualan').val();
	$('#opsi_temp').load("<?php echo base_url('penjualan/pos/tabel_temp').'/';?>"+kode_penjualan);
	get_total_penjualan();
}
function add_item(){
	kode_penjualan = $('#kode_penjualan').val();
	kode_produk = $('#kode_produk').val();
	qty = $('#qty').val();
	kode_satuan = $('#kode_satuan').val();
	harga = $('#harga').val();
	diskon_peritem = $('#diskon_peritem').val();
	diskon_persen_item = $('#diskon_persen_item').val();
	diskon_rupiah_item = $('#diskon_rupiah_item').val();
	tanggal_expired = $('#tanggal_expired').val();
	if(kode_produk=='' || qty=='' || kode_satuan=='' || harga=='' || diskon_peritem=='' || tanggal_expired==''){
		alert('Silahkan Lengkapi From !');
	}else if(parseInt(qty) < 0){
		alert('QTY Salah !');
	}
	else{
		$.ajax({
			url: '<?php echo base_url('penjualan/pos/add_item'); ?>',
			type: 'post',
			data:{
				kode_penjualan:kode_penjualan,
				kode_produk:kode_produk,
				qty:qty,
				kode_satuan:kode_satuan,
				harga:harga,
				diskon_peritem:diskon_peritem,
				diskon_persen_item:diskon_persen_item,
				diskon_rupiah_item:diskon_rupiah_item,
				tanggal_expired:tanggal_expired
			},
			dataType:'Json',
			success: function(msg){
				if(msg.respon=='gagal'){
					$('#sukses').html("<div class='alert alert-danger'>Stok Tidak Mencukupi</div>");
					setTimeout(function(){$('#sukses').html('');},1500);  
				}else if(msg.respon=='produk_tersedia'){
					$('#sukses').html("<div class='alert alert-warning'>Produk Telah Tersedia</div>");
					setTimeout(function(){$('#sukses').html('');},1500);  
				}else{
					$('#kode_produk').val('').trigger('change');
					$('#qty').val('');
					$('#kode_satuan').val('');
					$('#harga').val('');
					$('#diskon_persen_item').val('');
					$('#diskon_rupiah_item').val('');
					$('#tanggal_expired').val('');
					load_temp();
				}
			}
		});
}

}
function actEdit(id){
	$.ajax({
		url: '<?php echo base_url('penjualan/pos/get_data_temp'); ?>',
		type: 'post',
		data:{id:id},
		dataType:'json',
		success: function(response){
			$('#kode_produk').val(response.kode_produk).trigger('change');
			$('#qty').val(response.jumlah);
			$('#kode_satuan').val(response.kode_satuan);
			$('#harga').val(response.harga_satuan);
			$('#diskon_persen_item').val(response.diskon_persen);
			$('#diskon_rupiah_item').val(response.diskon_rupiah);
			$('#tanggal_expired').val(response.tanggal_expired);
			$('#diskon_peritem').val(response.jenis_diskon);
			$('#id_opsi').val(response.id_temp);
			$('.btn-add').hide();
			$('.btn-update').show();
		}
	});
}
function update_item(){
	kode_penjualan = $('#kode_penjualan').val();
	id_opsi = $('#id_opsi').val();
	kode_produk = $('#kode_produk').val();
	qty = $('#qty').val();
	kode_satuan = $('#kode_satuan').val();
	harga = $('#harga').val();
	diskon_peritem = $('#diskon_peritem').val();
	diskon_persen_item = $('#diskon_persen_item').val();
	diskon_rupiah_item = $('#diskon_rupiah_item').val();
	tanggal_expired = $('#tanggal_expired').val();
	if(kode_produk=='' || qty=='' || kode_satuan=='' || harga=='' || diskon_peritem=='' || tanggal_expired==''){
		alert('Silahkan Lengkapi From !');
	}else if(parseInt(qty) < 0){
		alert('QTY Salah !');
	}
	else{
		$.ajax({
			url: '<?php echo base_url('penjualan/pos/update_item'); ?>',
			type: 'post',
			data:{
				kode_penjualan:kode_penjualan,
				id_opsi:id_opsi,
				kode_produk:kode_produk,
				qty:qty,
				kode_satuan:kode_satuan,
				harga:harga,
				diskon_peritem:diskon_peritem,
				diskon_persen_item:diskon_persen_item,
				diskon_rupiah_item:diskon_rupiah_item,
				tanggal_expired:tanggal_expired
			},
			dataType:'Json',
			success: function(msg){
				if(msg.respon=='gagal'){
					$('#sukses').html("<div class='alert alert-danger'>Stok Tidak Mencukupi</div>");
					setTimeout(function(){$('#sukses').html('');},1500);  
				}else if(msg.respon=='produk_tersedia'){
					$('#sukses').html("<div class='alert alert-warning'>Produk Telah Tersedia</div>");
					setTimeout(function(){$('#sukses').html('');},1500);  
				}else{
					$('#kode_produk').val('').trigger('change');
					$('#id_opsi').val('');
					$('#qty').val('');
					$('#kode_satuan').val('');
					$('#harga').val('');
					$('#diskon_persen_item').val('');
					$('#diskon_rupiah_item').val('');
					$('#tanggal_expired').val('');
					$('.btn-add').show();
					$('.btn-update').hide();
					load_temp();
				}
			}
		});
}

}
function actDelete(id){
	$('#modal-hapus').modal('show');
	$('#id_temp').val(id);
}

function hapus_temp(){
	var id=$('#id_temp').val();
	$.ajax({
		url: '<?php echo base_url('penjualan/pos/delete_temp'); ?>',
		type: 'post',
		data:{id:id},

		success: function(response){
			$('#modal-hapus').modal('hide');
			load_temp();

		}
	});
}
function get_total_penjualan(){
	var kode_penjualan=$('#kode_penjualan').val();
	var nominal_diskon=$('#nominal_diskon').val();
	var ongkir=$('#ongkir').val();
	$.ajax({
		url: '<?php echo base_url('penjualan/pos/get_total_penjualan'); ?>',
		type: 'post',
		data:{kode_penjualan:kode_penjualan,nominal_diskon:nominal_diskon,ongkir:ongkir},
		dataType:'json',
		success: function(hasil){
			$('#total_pesanan').val(hasil.subtotal);
			$('#grandtotal').val(hasil.grandtotal);
			$('#text_total_pesanan').html(toRp(hasil.subtotal));
			$('#text_grantotal').html(toRp(hasil.grandtotal));
			cek_dibayar();
		}
	});

}
function change_jenis_transaksi(){
	jenis_transaksi 	= $('#jenis_transaksi').val();

	if (jenis_transaksi == 'kredit' || jenis_transaksi=='konsinyasi') {
		$('#label_kembalian').html('Hutang');
		$('#input_jatuh_tempo').show();
	}else{
		$('#label_kembalian').html('Kembalian');
		$('#input_jatuh_tempo').hide();
	}
	$('#tanggal_jatuh_tempo').val('');
	$('#dibayar').val('');
	$('#kembalian').val('');
	$('#hutang').val('');
	$('#text_kembalian').html(toRp(0));

	cek_dibayar();
}
function cek_dibayar(){
	jenis_transaksi 	= $('#jenis_transaksi').val();
	dibayar 			= $('#dibayar').val();
	grandtotal 			= $('#grandtotal').val();
	if(parseInt(dibayar) < 0 || (jenis_transaksi == 'kredit' && parseInt(grandtotal) <= parseInt(dibayar))){
		alert('Nominal Pembayaran Salah !');
		$('#dibayar').val('');
	}else{
		if (jenis_transaksi == 'kredit' ) {
			$('#hutang').val(grandtotal-dibayar);
			$('#text_kembalian').html(toRp(grandtotal-dibayar));
		}else if(jenis_transaksi == 'tunai' && parseInt(grandtotal) < parseInt(dibayar)){
			$('#text_kembalian').html(toRp(dibayar-grandtotal));
			$('#kembalian').val(dibayar-grandtotal);
		}
		else if(jenis_transaksi == 'konsinyasi' && parseInt(grandtotal) < parseInt(dibayar)){
			$('#text_kembalian').html(toRp(dibayar-grandtotal));
			$('#kembalian').val(dibayar-grandtotal);
		}

	}

}
function confrim_bayar(){
	jenis_transaksi 	= $('#jenis_transaksi').val();
	dibayar 			= $('#dibayar').val();
	total_pesanan 		= $('#total_pesanan').val();
	grandtotal 			= $('#grandtotal').val();
	tanggal_jatuh_tempo = $('#tanggal_jatuh_tempo').val();
	if(parseInt(total_pesanan) <=0 ||  total_pesanan==''){
		alert('Produk Penjualan Kosong !');
	}else if(jenis_transaksi == 'kredit' &&  tanggal_jatuh_tempo==''){
		alert('Tanggal Jatuh Tempo Kosong !');
	}else{
		$('#modal-confirm').modal('show');
	}
}
function simpan_transaksi(){
	kode_penjualan = $('#kode_penjualan').val();
	kode_pesanan = $('#kode_pesanan').val();
	kategori_penjualan = $('#kategori_penjualan').val();
	kode_member = $('#kode_member').val();
	jenis_all_diskon = $('#jenis_all_diskon').val();
	all_diskon_rupiah = $('#all_diskon_rupiah').val();
	all_diskon_persen = $('#all_diskon_persen').val();
	total_pesanan = $('#total_pesanan').val();
	nominal_diskon = $('#nominal_diskon').val();
	grandtotal = $('#grandtotal').val();
	jenis_transaksi = $('#jenis_transaksi').val();
	ongkir = $('#ongkir').val();
	hutang = $('#hutang').val();
	tanggal_jatuh_tempo = $('#tanggal_jatuh_tempo').val();

	$.ajax({
		url: '<?php echo base_url('penjualan/pos/simpan_transaksi'); ?>',
		type: 'post',
		data:{
			kode_penjualan:kode_penjualan,
			kode_pesanan:kode_pesanan,
			kategori_penjualan:kategori_penjualan,
			kode_member:kode_member,
			jenis_all_diskon:jenis_all_diskon,
			all_diskon_rupiah:all_diskon_rupiah,
			all_diskon_persen:all_diskon_persen,
			total_pesanan:total_pesanan,
			nominal_diskon:nominal_diskon,
			grandtotal:grandtotal,
			jenis_transaksi:jenis_transaksi,
			ongkir:ongkir,
			hutang:hutang,
			tanggal_jatuh_tempo:tanggal_jatuh_tempo
		},
		dataType:'json',
		beforeSend:function(){
			$(".tunggu").show();
			$("#modal-confirm").modal('hide');
		},
		success: function(msg){
			$(".tunggu").hide();
			if(msg.respon=='stok_kurang'){
				$('#sukses').html("<div class='alert alert-warning'> Stok Produk "+ msg.produk_kurang+" Tidak Mencukupi</div>");
				setTimeout(function(){$('#sukses').html('');},1500);  
			}else{
				$(".alert_berhasil").show();

				setTimeout(function(){
					window.location="<?php echo base_url('penjualan/pos/tambah');?>";
				},1500);
			}
		}
	});

}
function toRp(angka){
	if(angka=='' || parseInt(angka) < 0 || angka==null){
		return 'Rp. 0';
	}else{
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

}
</script>