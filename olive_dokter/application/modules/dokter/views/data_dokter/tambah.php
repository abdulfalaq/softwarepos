<style>
.panel-default {
	border-color: #ddd;
	box-shadow: 0px 6px 20px #a8a7a7;
	border: none;
	border-radius: 0px !important;
}

.panel-heading {
	padding: 10px 20px;
	border-bottom: 1px solid transparent;
	background-color: #21857a !important;
	color:white !important;
	font-family: segoe ui;
	font-weight: 300;
	border-radius: 0px !important;
}
textarea.form-control {
	height: auto;
	max-width: 270px;
	max-height: 100px;
}
</style>


<a href="<?php echo base_url('dokter'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('dokter'); ?>">Dokter</a></li>
		<li><a href="#">Tambah</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<div class="clearfix"></div>
	<?php 
	$kode = $this->uri->segment(4);
	$this->db->from('clouoid1_olive_cs.transaksi_registrasi');
	$this->db->join('clouoid1_olive_master.master_member','clouoid1_olive_master.master_member.kode_member = clouoid1_olive_cs.transaksi_registrasi.kode_member','left');
	$this->db->join('clouoid1_olive_master.master_karyawan','clouoid1_olive_master.master_karyawan.kode_karyawan = clouoid1_olive_cs.transaksi_registrasi.kode_dokter','left');
	$this->db->join('clouoid1_olive_master.master_layanan','clouoid1_olive_master.master_layanan.kode_layanan = clouoid1_olive_cs.transaksi_registrasi.kode_layanan','left');
	$this->db->where('clouoid1_olive_cs.transaksi_registrasi.kode_transaksi',$kode);
	$get_data = $this->db->get()->row();
	?>

	<div class="row">
		<div class="col-sm-12">
			<div id="box_load">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="col-md-12 row">
								<div class="panel panel-default" >
									<div class="panel-heading text-right">
										<span class="pull-left" style="font-size: 24px">Proses Layanan</span>
										<br><br>
									</div>
									<div class="portlet-body">
										<div class="panel-body" style="height: 280px;">
											<form id="data_form" action="" method="post">
												<div class="sukses" ></div>
												<div class="row">
													<input readonly="true" type="hidden" value="<?php echo $get_data->kode_transaksi ?>" class="form-control" placeholder="Kode Transaksi" name="kode_transaksi" id="kode_transaksi" />
													<input readonly="true" type="hidden" value="<?php echo $get_data->kode_karyawan ?>" class="form-control" placeholder="Kode Dokter" name="kode_dokter" id="kode_dokter" />
													<input readonly="true" type="hidden" value="<?php echo $get_data->nama_karyawan ?>" class="form-control" placeholder="Kode Transaksi" name="nama_dokter" id="nama_dokter" />
													<input readonly="true" type="hidden" value="<?php echo $get_data->kode_member ?>" class="form-control" placeholder="Kode Transaksi" name="kode_member" id="kode_member" />
													<div class=" form-group col-md-6">
														<div class="form-group">
															<label class="gedhi">Nama Member</label>
															<input type="text" class="form-control" placeholder="Nama Member" value="<?php echo $get_data->nama_member ?>" name="nama_member" id="nama_member" readonly/>
														</div>
													</div>
													<div class=" form-group col-md-6">
														<div class="form-group">
															<label class="gedhi">Nama Layanan</label>
															<input type="text" class="form-control" placeholder="Nama Layanan" value="<?php echo $get_data->nama_layanan ?>"  name="nama_layanan" id="nama_layanan" readonly/>
															<input type="hidden" class="form-control" placeholder="Nama Layanan" value="<?php echo $get_data->kode_layanan ?>" name="kode_layanan" id="kode_layanan" readonly/>
														</div>
													</div>
													<div class=" form-group col-md-6">
														<div class="form-group">
															<label class="gedhi">Anamnesa</label>
															<textarea class="form-control" placeholder="Anamnesa"  name="anamnesa" id="anamnesa"></textarea>
														</div>
													</div>
													<div class=" form-group col-md-6">
														<div class="form-group">
															<label class="gedhi">Diagnosa</label>
															<textarea class="form-control" placeholder="Diagnosa"  name="diagnosa" id="diagnosa"></textarea>
														</div>
													</div>
												</div>
											</form> 
										</div>
									</div>
								</div>
							</div>
							<?php if ($get_data->kode_layanan == '02') { ?>
							<div class="col-md-12 row">
								<div class="panel panel-default">
									<div class="panel-heading text-right">
										<span class="pull-left" style="font-size: 24px">Treatment</span>
										<br><br>
									</div>
									<div class="portlet-body">
										<div class="panel-body">
											<form id="data_form" action="" method="post">
												<div class="sukses" ></div>
												<div class="sukses" ></div>
												<div class="box-body">
													<div class="row">
														<div class="col-md-12">
															<div style=" float: left; padding: 14px 0; background: #dadad9; margin-bottom: 15px;width: 100%;">
																<div class="col-md-5" id="dropdown_produk">
																	<label>Treatment</label>
																	<select id="kode_perawatan" class="form-control select2" >
																		<option value="">Pilih Treatment</option>
																		<?php
																		$this->db->from('clouoid1_olive_master.master_perawatan');
																		$get_treastment = $this->db->get()->result();
																		foreach ($get_treastment as $value) { ?>
																		<option value="<?php echo $value->kode_perawatan ?>"><?php echo $value->nama_perawatan ?></option>
																		<?php }
																		?>
																	</select>
																</div>
																<div class="col-md-5">
																	<label>QTY</label>
																	<input type="number" class="form-control" placeholder="Jumlah" name="qty_perawatan" id="qty_perawatan"/ onkeyup="cek_qty()" onclick="cek_qty()">
																	<input type="hidden" name="id_item_produk" id="id_item_produk" />
																</div>
																<div class="col-md-2" style="padding-top:25px;">
																	<a onclick="add_item('treatment')" id="add_treatment"  class="btn btn-no-radius btn-primary">Add</a>
																	<a onclick="update_item('treatment')" id="update_treatment"  class="btn btn-no-radius btn-warning">Update</a>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div id="list_transaksi_pembelian">
													<div class="box-body">
														<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Treatment</th>
																	<th>Qty</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody id="temp_treatment">

															</tbody>
															<tfoot>

															</tfoot>
														</table>
													</div>
												</div>
												<br>
											</form> 
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="col-md-12 row">
								<div class="panel panel-default" >
									<div class="panel-heading text-right">
										<span class="pull-left" style="font-size: 24px">Produk</span>
										<br><br>
									</div>
									<div class="portlet-body" >
										<div class="panel-body" style="min-height: 280px;">
											<form id="data_form" action="" method="post">
												<div class="sukses" ></div>
												<div class="sukses" ></div>
												<div class="box-body">
													<div class="row">
														<div class="col-md-12">
															<div style=" float: left; padding: 14px 0; background: #dadad9; margin-bottom: 15px;width: 100%;">
																<div class="col-md-5" id="dropdown_produk">
																	<label>Produk</label>
																	<select id="kode_produk" name="kode_produk" class="form-control select2" >
																		<option value="">Pilih Produk</option>
																		<?php
																		$this->db->from('clouoid1_olive_master.master_produk');
																		$this->db->join('clouoid1_olive_master.master_kategori_produk','clouoid1_olive_master.master_kategori_produk.kode_kategori_produk = master_produk.kode_kategori_produk','left');
																		$get_produk = $this->db->get()->result();
																		foreach ($get_produk as $value) { ?>
																		<option value="<?php echo $value->kode_produk ?>"><?php echo $value->nama_produk ?></option>
																		<?php }
																		?>
																	</select>
																</div>
																<div class="col-md-5">
																	<label>QTY</label>
																	<input type="text" class="form-control" placeholder="Jumlah" name="qty_produk" id="qty_produk" onkeyup="cek_qty_produk()" onclick="cek_qty_produk()" />
																	<input type="hidden" name="id_item_produk" id="id_item_produk" />
																</div>
																<div class="col-md-2" style="padding-top:25px;">
																	<a onclick="add_item('produk')" id="add_produk"  class="btn btn-no-radius btn-primary">Add</a>
																	<a onclick="update_item('produk')" id="update_produk"  class="btn btn-no-radius btn-warning">Update</a>
																</div>
															</div>
														</div>
													</div>
												</div>

												<div id="list_transaksi_pembelian">
													<div class="box-body">
														<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
															<thead>
																<tr>
																	<th>No</th>
																	<th>Produk</th>
																	<th>Qty</th>
																	<th>Action</th>
																</tr>
															</thead>
															<tbody id="temp_produk">

															</tbody>
															<tfoot>

															</tfoot>
														</table>
													</div>
												</div>
											</form> 
										</div>
									</div>

								</div>
							</div>

						</div>						
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading text-right">
									<span class="pull-left" style="font-size: 24px">Data Rekam Medis</span>
									<br><br>
								</div>
								<div class="portlet-body">
									<div class="panel-body">
										<div class="box-body">                 
											<form id="data_form" action="" method="post">
												<div class="box-body">
													<div style="overflow-y:scroll;height:250px">
														<table id="tabel" class="table table-bordered table-striped" style="font-size:1.0em;">
															<thead>
																<tr>
																	<th>Tanggal Transaksi</th>
																	<th>Treatment / Produk</th>
																	<th>Qty</th>
																</tr>
															</thead>
															<tbody>
																<?php
																$this->db->from('clouoid1_olive_kasir.data_record_anggota');
																$this->db->where('clouoid1_olive_kasir.data_record_anggota.kode_member',$get_data->kode_member);
																$this->db->join('clouoid1_olive_master.master_perawatan','clouoid1_olive_master.master_perawatan.kode_perawatan = clouoid1_olive_kasir.data_record_anggota.kode_item','left');
																$this->db->join('clouoid1_olive_master.master_produk','clouoid1_olive_master.master_produk.kode_produk = clouoid1_olive_kasir.data_record_anggota.kode_item','left');
																$this->db->order_by('clouoid1_olive_kasir.data_record_anggota.id','DESC');
																$get_medik = $this->db->get()->result();
																foreach ($get_medik as  $value) { ?>
																<tr>
																	<td><?php echo tanggalIndo($value->tanggal_transaksi) ?></td>
																	<td><?php echo @$value->nama_perawatan; echo @$value->nama_produk ?></td>
																	<td><?php echo $value->qty ?></td>
																</tr>
																<?php }
																?>
															</tbody>
														</table>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading text-right">
									<span class="pull-left" style="font-size: 24px">Data Konsul</span>
									<br><br>
								</div>
								<div class="portlet-body">
									<div class="panel-body">
										<div class="box-body">                 
											<form id="data_form" action="" method="post">
												<div class="box-body">
													<div style="overflow-y:scroll;height:250px">
														<table id="tabel" class="table table-bordered table-striped" style="font-size:1.0em;">
															<thead>
																<tr>
																	<th>Tanggal Konsul</th>
																	<th>Nama Dokter</th>
																	<th>Anamnesa</th>
																	<th>Diagnosa</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<?php
																	$this->db->from('clouoid1_olive_kasir.data_rekam_medik');
																	$this->db->join('clouoid1_olive_master.master_karyawan','clouoid1_olive_master.master_karyawan.kode_karyawan = clouoid1_olive_kasir.data_rekam_medik.kode_dokter','left');
																	$this->db->where('clouoid1_olive_kasir.data_rekam_medik.kode_member',$get_data->kode_member);
																	$this->db->order_by('clouoid1_olive_kasir.data_rekam_medik.id','DESC');
																	$get_medik = $this->db->get()->result();
																	foreach ($get_medik as  $value) { ?>
																	<tr>
																		<td><?php echo @tanggalIndo(@$value->tanggal_transaksi) ?></td>
																		<td><?php echo @$value->nama_karyawan ?></td>
																		<td><?php echo $value->anamnesa ?></td>
																		<td><?php echo $value->diagnosa ?></td>
																	</tr>
																	<?php }
																	?>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header" style="background-color:grey">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
																<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
															</div>
															<div class="modal-body">
																<span style="font-weight:bold; font-size:14pt">Apakah anda yakin dengan Data tersebut ?</span>
																<input id="id-delete" type="hidden">
															</div>
															<div class="modal-footer" style="background-color:#eee">
																<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
																<a onclick="simpan_all_data()" class="btn green">Ya</a>
															</div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<a class="btn btn-info btn-block btn-no-radius btn-lg pull-right" style="box-shadow:0px 2px 15px grey" onclick="$('#modal-confirm').modal('show')"><i class="fa fa-send"></i> Simpan</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="id_update">


<div id="modal-confirm-alert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Alert</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt" id="span_alert"></span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Oke</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">KOnfirmasi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus Data tersebut ?</span>
				<input id="id_delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<a onclick="delete_opsi()" id="simpan_besar1" class="btn red">Yakin</a>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm-ubah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Ubah</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan mengubah Data Paket <span id="bayare"></span> ?</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button id="simpan_ubah" class="btn red">Ya</button>
			</div>
		</div>
	</div>
</div>



<div id="modal_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content" >
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
				<label><b><i class="fa fa-gears"></i>Setting</b></label>
			</div>

			<form id="form_setting" >
				<div class="modal-body">
					<div class="box-body">
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label>Note</label>
									<input type="text" name="keterangan"  class="form-control" />
								</div>

							</div>
						</div>
					</div>
					<div class="modal-footer" style="background-color:#eee">
						<button class="btn red" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<button type="submit" class="btn btn-success">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="modal-supplier" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background-color:grey">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
				</div>
				<div class="modal-body">
					<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menyimpan data tersebut ?</span>
					<input id="kode_supplier" type="hidden">
				</div>
				<div class="modal-footer" style="background-color:#eee">
					<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
					<button onclick="save_supplier()" class="btn green">Ya</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$("#update_produk").hide();
$("#update_treatment").hide();


document.querySelector('#qty_produk').addEventListener("keypress", function (evt) {
  
    if(evt.which == 8){return}
      if (evt.which < 48 || evt.which > 57)
      {
        evt.preventDefault();
      }
    });
document.querySelector('#qty_produk').addEventListener("keypress", function (evt) {
    if(evt.which == 8){return}
      if (evt.which < 48 || evt.which > 57)
      {
        evt.preventDefault();
      }
    });

function setting() {
	$('#modal_setting').modal('show');
}
function bayar(){
	var uang = $("#nilai_dibayar").text();
	var proses_pembayaran = $("#jenis_pembayaran").val();
	var jatuh_tempo = $("#jatuh_tempo").val();
	if(proses_pembayaran=='kredit' && jatuh_tempo==''){
		$("#modal-confirm-tanggal").modal('show');
	}else{
		$("#bayare").text(uang);
		$("#modal-confirm-bayar").modal('show');
	}

}
function cek_qty(){
	var qty_perawatan = parseInt($("#qty_perawatan").val());
	
	if(qty_perawatan <=0){
		alert("QTY Salah !");
		$("#qty_perawatan").val('');
	}

}
function cek_qty_produk(){
	var qty_produk = parseInt($("#qty_produk").val());
	
	if(qty_produk <=0){
		alert("QTY Salah !");
		$("#qty_produk").val('');
	}

}

function simpan(){
	$("#modal-confirm-simpan").modal('show');
};

function edit_Data(){
	$("#modal-confirm-ubah").modal('show');

};

function add_item(key){
	if (key == 'produk') {
		link_url  = "<?php echo base_url() . 'dokter/data_dokter/simpan_produk_opsi' ?>";
		kode_item = $("#kode_produk").val();
		qty 	  = $("#qty_produk").val();
	}else{
		link_url  = "<?php echo base_url() . 'dokter/data_dokter/simpan_perawatan_opsi' ?>";
		kode_item = $("#kode_perawatan").val();
		qty 	  = $("#qty_perawatan").val();
	}
	kode_transaksi = $("#kode_transaksi").val();

	if (kode_item == '' || qty == '') {
		alert('Mohon Melengkapi Data');
	}else{
		$.ajax( {  
			type :"post",  
			url : link_url,  
			cache :false,  
			data :{kode_transaksi:kode_transaksi,kode_item:kode_item,qty:qty},
			dataType: 'Json', 
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();   
					if (key == 'produk') {
						load_produk_opsi();
						$("#kode_produk").val('').trigger('change');
						$("#qty_produk").val('');
					}else{
						load_perawatan_opsi();
						$("#kode_perawatan").val('').trigger('change');
						$("#qty_perawatan").val('');
					}
				}else if(data.response == 'ada'){
					alert('Data Sudah Ada.');
					$(".tunggu").hide();
					if (key == 'produk') {
						load_produk_opsi();
						$("#kode_produk").val('').trigger('change');
						$("#qty_produk").val('');
					}else{
						load_perawatan_opsi();
						$("#kode_perawatan").val('').trigger('change');
						$("#qty_perawatan").val('');
					}
				}else{
					alert('Kesalahan Menyimpan Data.');
					$(".tunggu").hide();
					if (key == 'produk') {
						load_produk_opsi();
						$("#kode_produk").val('').trigger('change');
						$("#qty_produk").val('');
					}else{
						load_perawatan_opsi();
						$("#kode_perawatan").val('').trigger('change');
						$("#qty_perawatan").val('');
					}
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
}      
return false; 

}

function load_produk_opsi() {
	kode_transaksi = $("#kode_transaksi").val();
	$('#temp_produk').load("<?php echo base_url('dokter/data_dokter/get_table_temp_produk'); ?>/"+kode_transaksi);

}

function load_perawatan_opsi() {
	kode_transaksi = $("#kode_transaksi").val();
	$('#temp_treatment').load("<?php echo base_url('dokter/data_dokter/get_table_temp_perawatan'); ?>/"+kode_transaksi);
}

function simpan_all_data() { 

	kode_transaksi 	= $("#kode_transaksi").val();
	kode_dokter 	= $("#kode_dokter").val();
	kode_member 	= $("#kode_member").val();
	kode_layanan 	= $("#kode_layanan").val();
	anamnesa 		= $("#anamnesa").val();
	diagnosa 		= $("#diagnosa").val();
	$.ajax( {  
		type :"post",  
		url : "<?php echo base_url() . 'dokter/data_dokter/simpan_all_data' ?>",  
		cache :false,  
		data :{kode_transaksi:kode_transaksi,kode_dokter:kode_dokter,kode_member:kode_member,kode_layanan:kode_layanan,anamnesa:anamnesa,diagnosa:diagnosa},
		dataType: 'Json',
		beforeSend:function(){
			$(".tunggu").show();   
		},
		success : function(data) { 
			if (data.response == 'sukses') {
				$(".tunggu").hide();   
				$(".alert_berhasil").show();   
				setInterval(function(){ window.location = "<?php echo base_url('dokter');?>"; }, 500);

			}else{
				alert('Gagal Menyimpan data');
				$(".tunggu").hide();   
			}
		},  
		error : function() {
			alert("Data gagal dimasukkan.");  
		}  
	});
	return false;              
}

function actEdit(key,category){
	$.ajax( {  
		type :"post",  
		url : "<?php echo base_url() . 'dokter/data_dokter/get_data_opsi' ?>",  
		cache :false,  
		data :{id:key},
		dataType: 'Json',
		success : function(data) { 
			if (category == 'produk') {
				$("#kode_produk").val(data.kode_item).trigger('change');
				$("#qty_produk").val(data.qty);
				$("#id_update").val(data.id);
				$("#add_produk").hide();
				$("#update_produk").show();
			}else{
				$("#kode_perawatan").val(data.kode_item).trigger('change');
				$("#qty_perawatan").val(data.qty);
				$("#id_update").val(data.id);
				$("#qty_perawatan").val(data.qty);
				$("#add_treatment").hide();
				$("#update_treatment").show();		

			}
		}
	});
}

function actDel(key,category){
	$.ajax( {  
		type :"post",  
		url : "<?php echo base_url() . 'dokter/data_dokter/hapus_opsi_temp' ?>",  
		cache :false,  
		data :{id:key},
		beforeSend: function(data){
			$(".tunggu").show();   
		},
		success : function(data) { 
			$(".tunggu").hide();   
			if (category == 'produk') {
				load_produk_opsi();
			}else{
				load_perawatan_opsi();
			}
		}
	});
}

function update_item(key){
	if (key == 'produk') {
		link_url  = "<?php echo base_url() . 'dokter/data_dokter/update_item_produk' ?>";
		kode_item = $("#kode_produk").val();
		qty 	  = $("#qty_produk").val();
	}else{
		link_url  = "<?php echo base_url() . 'dokter/data_dokter/update_item_perawatan' ?>";
		kode_item = $("#kode_perawatan").val();
		qty 	  = $("#qty_perawatan").val();
	}

	kode_transaksi = $("#kode_transaksi").val();
	id_update 	   = $("#id_update").val();

	if (kode_item == '' || qty == '') {
		alert('Mohon Melengkapi Data');
	}else{
		$.ajax( {  
			type :"post",  
			url : link_url,  
			cache :false,  
			data :{kode_transaksi:kode_transaksi,kode_item:kode_item,qty:qty,id:id_update},
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();   
					if (key == 'produk') {
						load_produk_opsi();
						$("#kode_produk").val('').trigger('change');
						$("#qty_produk").val('');
						$("#id_update").val('');
						$("#add_produk").show();
						$("#update_produk").hide();	
					}else{
						load_perawatan_opsi();
						$("#kode_perawatan").val('').trigger('change');
						$("#qty_perawatan").val('');
						$("#id_update").val('');
						$("#add_treatment").show();
						$("#update_treatment").hide();	
					}
				}else{
					alert('Kesalahan Menyimpan Data.');
					$(".tunggu").hide();
					if (key == 'produk') {
						load_produk_opsi();
						$("#kode_produk").val('').trigger('change');
						$("#qty_produk").val('');
						$("#id_update").val('');
						$("#add_produk").show();
						$("#update_produk").hide();	
					}else{
						load_perawatan_opsi();
						$("#kode_perawatan").val('').trigger('change');
						$("#qty_perawatan").val('');
						$("#id_update").val('');
						$("#add_treatment").show();
						$("#update_treatment").hide();	
					}
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
}      
return false; 

}
</script>

