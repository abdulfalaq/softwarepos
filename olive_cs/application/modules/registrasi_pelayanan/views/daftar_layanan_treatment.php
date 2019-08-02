
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Master</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Tambah Registrasi Pelayanan</span>
						<a href="<?php echo @base_url('registrasi_pelayanan/anggota_pendaftaran'); ?>" class="btn btn-info" style="float:right;margin-top:5px;margin-bottom:5px">Tambah Customer</a>
						<a href="<?php echo @base_url('registrasi_pelayanan/daftar_pendaftaran_pelayanan_paket'); ?>" class="btn btn-warning" style="float:right;margin-top:5px;margin-bottom:5px;margin-right:5px">List Pendaftaran Layanan Paket</a><br><br>
					</div>

					<div class="panel-body">                   
						<div class="sukses" ></div>
						<div class="box-body"> 
							<div class="row"> 
								<div class="col-md-4">
									<div class="form-group">
										<label class="gedhi"><b>Nama Customer</b></label>
										<select  required class="form-control stok select2" name="member" id="member">
											<option selected="true" value="">--Pilih Customer--</option>
											<option  value="20171010001|Arda">20171010001-Arda</option>
											<option  value="20171011002|jihan ali reza">20171011002-jihan ali reza</option>
											<option  value="20171017003|Lia Rosinta">20171017003-Lia Rosinta</option>
											<option  value="20171017004|Novia Chandra">20171017004-Novia Chandra</option>
											<option  value="20171017005|Irma Oktaviani">20171017005-Irma Oktaviani</option>
											<option  value="20171209001|Ihsan">20171209001-Ihsan</option>
											<option  value="20171209002|Sinta">20171209002-Sinta</option>
											<option  value="20171209003|Ratna">20171209003-Ratna</option>
										</select> 
									</div> 
								</div>

								<div class="col-md-3">
									<div class="form-group">

										<label class="gedhi"><b>Layanan</b></label>
										<select required class="form-control stok select2" id="layanan" name="layanan">

											<option value="">--Pilih Layanan--</option>
											<option value="01" >Treatment</option>
											<option value="02" >Konsul</option>
											<option value="03" >Periksa</option>
										</select> 
									</div>
								</div>

								<div class="col-md-1">
									<div class="form-group">
										<button id="simpan_registrasi_layanan" class="btn btn-primary" style="margin-top:25px">Proses</button>
										<button id="ubah_registrasi_layanan" class="btn btn-danger" style="margin-top:25px">Delete</button>
									</div>
								</div>

								<div class="col-md-4">
									<div class="portlet box blue">
										<div class="portlet-title">
											<div class="caption">
												Data Rekam Medik
											</div>
											<div class="tools">
												<a href="javascript:;" class="collapse">
												</a>
												<a href="javascript:;" class="reload">
												</a>

											</div>
										</div>
										<div class="portlet-body">
											<div class="box-body">                 
												<form id="data_form" action="" method="post">
													<div class="box-body">
														<div style="overflow-y:scroll;height:250px">
															<center><h4 id="nama_customer"></h4></center>
															<table id="tabel" class="table table-bordered table-striped">
																<thead>
																	<tr>
																		<th>Tanggal Transaksi</th>
																		<th>Treatment / Produk</th>
																		<th>Qty</th>
																	</tr>
																</thead>
																<tbody id="data_rekam_medik">
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

							<div id="form_treatment">
								<hr style="width:100%;border-color:#26a69a">
								<div class="row">
									<div class="form-group  col-xs-5" >
										<label class="gedhi"><b>Kode Registrasi</b></label>
										<input type="text" class="form-control" name="kode_registrasi" id="kode_registrasi" readonly value="LYN_100218094340_1">
										<input type="hidden" name="kode_transaksi" id="kode_transaksi" value="LYN_100218094340_1">
									</div>
								</div>

								<div class="row" style="background-color:grey;margin:0px;margin-bottom:10px">
									<input type="hidden" id="id_treatment" value="" name="">
									<div class="col-md-5">
										<label>Perawatan</label>
										<select  required class="form-control stok select2"  name="perawatan" id="perawatan" style="width: 100%">
											<option value="">--Pilih Perawatan--</option>
											<option value="TRT_101017102550_1|Body Massage|150000">TRT_101017102550_1 - Body Massage</option>
											<option value="TRT_101017153319_1|potong kuku|50000">TRT_101017153319_1 - potong kuku</option>
											<option value="TRT_101017154024_1|Acne Treatment|80000">TRT_101017154024_1 - Acne Treatment</option>
											<option value="TRT_231017121148_1|segar|10000">TRT_231017121148_1 - segar</option>
										</select>
									</div> 

									<div class="col-md-5" hidden>
										<label>Terapis</label>
										<select  required class="form-control stok select2"  name="terapis" id="terapis">
											<option value="">--Pilih Terapis--</option>
										</select> 
									</div>

									<div class=" col-md-2" style="padding:25px;">
										<button id="simpan_treatment" class="btn btn-primary">Add</button>
										<button id="ubah_treatment" class="btn btn-primary">Ubah</button>
									</div>
								</div>

								<div id="list_treatment">
									<div class="box-body">
										<table id="tabel_daftar" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Perawatan</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="tabel_treatment_temp">

											</tbody>
											<tfoot>

											</tfoot>
										</table>
									</div>
								</div>
								<div class="box-footer clearfix">
									<a onclick="simpan_besar_treatment()" class="btn btn-success pull-right">Simpan</a>
								</div>
							</div>
							<div id="form_konsul_periksa" hidden>
								<hr style="width:100%;border-color:#26a69a">
								<div class="row" id="form_konsul">
									<div class="form-group  col-md-5" >
										<label class="gedhi"><b>Kode Registrasi</b></label>
										<input type="text" class="form-control" name="kode_registrasi" id="kode_registrasi" readonly value="LYN_100218094340_1">
									</div>
									<div class="col-md-5 form-group">
										<label>Dokter</label>
										<select  required class="form-control stok select2"  name="dokter" id="dokter">
											<option value="">--Pilih Dokter--</option>
											<option value="K_0002|Dea Resita">K_0002 - Dea Resita</option>
										</select>
									</div> 
								</div>
								<div class="row" id="form_periksa" hidden="">
									<input type="hidden" id="id_konsul" value="" name="">
									<div class="form-group  col-md-4" >
										<label class="gedhi"><b>Kode Registrasi</b></label>
										<input type="text" class="form-control" name="registrasi" id="registrasi" readonly value="LYN_100218094340_1">
									</div>
									<div class="col-md-4 form-group">
										<label>Dokter</label>
										<select  required class="form-control stok select2"  name="dokter_periksa" id="dokter_periksa">
											<option value="">--Pilih Dokter--</option>
											<option value="K_0002|Dea Resita">K_0002 - Dea Resita</option>
										</select>
									</div> 
									<div class="col-md-4 form-group">
										<label>Periksa</label>
										<select id="periksa" name="periksa" class="form-control">
											<option>-PILIH PERIKSA-</option>
											<option value="PS001|persae">persae</option>
											<option value="PS002|Umum">Umum</option>
										</select>
									</div>
								</div>
								<br>
								<div class="box-footer clearfix">
									<a id="simpan_besar_konsul" class="btn btn-success pull-right">Simpan</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo @base_url('registrasi_pelayanan'); ?>" class="btn btn-success" >Data Layanan Periksa</a>
	<a href="<?php echo @base_url('registrasi_pelayanan/daftar_layanan_konsul'); ?>" class="btn btn-success" >Data Layanan Konsul</a>
	<a href="<?php echo @base_url('registrasi_pelayanan/daftar_layanan_treatment'); ?>" class="btn btn-success" >Data Layanan Treatment</a>
	<br>
	<br>
	<br>
	<div class="row">      
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Layanan Periksa</span>
					<div class="tools"><br><br>
						<a href="javascript:;" class="collapse">
						</a>
						<a href="javascript:;" class="reload">
						</a>

					</div>
				</div>

				<div class="panel-body">
					<div class="double bg-green pull-right" style="cursor:default">
						<div  style="padding-right:10px; padding-top:0px; font-size:48px; font-family:arial; font-weight:bold">
						</div>
					</div>
					<br>
					<div class="box-body">            

						<div class="sukses" ></div>
						<div class="row">
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
								<button style="width: 190px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
						<br>
						<div id="cari_transaksi">
							<table class="table table-striped table-hover table-bordered" id="daftar_pembelian" >
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal Transaksi</th>
										<th>Kode Transaksi</th>
										<th>Nama Customer</th>
										<th>Nama Layanan</th>
										<th>Dokter</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="scroll_data">

								</tbody>
							</table>
						</div>
						<input type="hidden" class="form-control rowcount" value="0">
						<input type="hidden" class="form-control pagenum " value="0">
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div>
</div>

<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus data tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delData()" class="btn red">Ya</button>
			</div>
		</div>
	</div>
</div> 

<div id="modal-alert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Alert !</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt" id="span_alert"></span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>
			</div>
		</div>
	</div>
</div>

<style type="text/css" media="screen">
.btn-back
{
	position: fixed;
	bottom: 10px;
	left: 10px;
	z-index: 999999999999999;
	vertical-align: middle;
	cursor:pointer
}
</style>
<img class="btn-back" src="http://192.168.100.17/elladerma_cs/component/img/back_icon.png" style="width: 70px;height: 70px;">
<script src="http://192.168.100.17/elladerma_cs/component/lib/jquery.min.js"></script>
<script src="http://192.168.100.17/elladerma_cs/component/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="http://192.168.100.17/elladerma_cs/component/lib/css/default.css"/>
<script>
	$('.tgl').Zebra_DatePicker({});

	$('#cari').click(function(){
		var tgl_awal =$("#tgl_awal").val();
		var tgl_akhir =$("#tgl_akhir").val();
		var kode_unit =$("#kode_unit").val();
		var layanan ='Periksa';
		if (tgl_awal=='' || tgl_akhir==''){ 
			alert('Masukkan Tanggal Awal & Tanggal Akhir..!')
		}
		else{
			$.ajax( {  
				type :"post",  
				url : "http://192.168.100.17/elladerma_cs/data_layanan/cari",  
				cache :false,
				beforeSend:function(){
					$(".tunggu").show();  
				},  
				data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir,kode_unit:kode_unit,layanan:layanan},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success : function(data) {
					$(".tunggu").hide();  
					$("#daftar_pembelian").html(data);
				},  
				error : function(data) {  
         // alert("das");  
     }  
 });
		}

		$('#tgl_awal').val('');
		$('#tgl_akhir').val('');

	});


	$("#member").change(function(){
		kode_member = $("#member").val();
		var data = kode_member.split("|");  
		var nama_customer = data[1];
		$.ajax({
			type: 'POST',
			url: "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/get_rekam_medik",
			data: {kode_member:kode_member},
			success: function(data){
				$("#data_rekam_medik").html(data);
				$("#nama_customer").html(nama_customer);
			},
			error : function(data) {  
				alert('Sorry');
			}  
		});
	});

	$('#ubah_registrasi_layanan').hide();
	$('.btn-back').click(function(){
		$(".tunggu").show();
		window.location = "http://192.168.100.17/elladerma_cs/admin/menu";
	});

	$('#ubah_registrasi_layanan').click(function(){

		var kode_registrasi = $('#kode_registrasi').val();
		$.ajax({
			type: 'POST',
			url: 'http://192.168.100.17/elladerma_cs/registrasi_pelayanan/hapus_all_temp/',
			data: {kode_registrasi:kode_registrasi},
			beforeSend:function(){
			},
			success: function(data){

				document.getElementById('layanan').disabled = false;
				document.getElementById('member').disabled = false;

				$('#ubah_registrasi_layanan').hide();
				$('#simpan_registrasi_layanan').show();

				$('#form_treatment').hide();
				$('#form_konsul_periksa').hide();
				$('#form_konsul').hide();
				$('#form_periksa').hide();

				var kode_registrasi = $('#kode_registrasi').val();
				$("#tabel_treatment_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/treatment_temp/"+kode_registrasi);

				var kode_registrasi = $('#kode_registrasi').val();
				$("#tabel_konsul_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/konsul_temp/"+kode_registrasi);
			}
		});

	});

	$('#add_simpan_konsul').click(function(){

		var dokter = $('#dokter').val();
		var keluhan = $('#keluhan').val();
		var layanan = $('#layanan').val();
		var kode_merchant = $('#merchant').val();
		var kode_member = $('#member').val();
		var kode_registrasi = $('#kode_registrasi').val();
		var kode_promo = $('#promo').val();
		$.ajax({
			type: 'POST',
			url: 'http://192.168.100.17/elladerma_cs/registrasi_pelayanan/simpan_konsul_temp/',
			data: {kode_dokter:dokter,kode_periksa:keluhan,kode_layanan:layanan,kode_member:kode_member,kode_transaksi:kode_registrasi,kode_promo:kode_promo},
			beforeSend:function(){
			},
			success: function(data){
				$('#dokter').select2('val','');
				$('#keluhan').val('');
				var kode_registrasi = $('#kode_registrasi').val();	
				$("#tabel_konsul_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/konsul_temp/"+kode_registrasi);

			}
		});

	});

	$(document).ready(function(){
		$(".select2").select2();
	});

	$("#form_treatment").hide();
	$("#ubah_treatment").hide();
	$("#form_konsul").hide();
	$("#ubah_konsul").hide();

	$("#simpan_registrasi_layanan").click(function(){

		var layanan = $('#layanan').val();
		var member = $('#member').val();

		if(layanan == '' || member == '' )
		{
			$('#modal-alert').modal('show');
			$('#span_alert').text("Masukan Form dengan Lengkap");
		}
		else
		{ 
			document.getElementById('layanan').disabled = true;
			document.getElementById('member').disabled = true;

			if(layanan == "01")
			{
				$('#form_treatment').show();
			}else if(layanan == "02" )
			{
				$('#form_konsul_periksa').show();
				$('#form_konsul').show();
				$('#form_periksa').hide();
			}else if (layanan == "03") {
				$('#form_konsul_periksa').show();
				$('#form_konsul').hide();
				$('#form_periksa').show();
			}

			$('#ubah_registrasi_layanan').show();
			$('#simpan_registrasi_layanan').hide();
		}
	});

	function simpan_besar_treatment(id) {
		var member = $('#member').val();
		var layanan = $('#layanan').val();
		var kode_registrasi = $('#kode_transaksi').val();
		var promo = $('#promo').val();
		var merchant = $('#merchant').val();
		var url = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/simpan_besar_treatment/";
		$.ajax({
			type: 'POST',
			url: url,
			data: {kode_member:member,kode_layanan:layanan,kode_transaksi:kode_registrasi},
			success: function(data){
				var link = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/print_invoice";
				$.ajax({
					type: "POST",
					url: link,
					data:{
						kode_registrasi:kode_registrasi
					},
					success: function(msg)
					{
					}
				});

				window.location.reload();
			}
		});
	}

	$("#simpan_treatment").click(function(){
		var perawatan = $('#perawatan').val();
		var member = $('#member').val();
		var terapis = $('#terapis').val();
		var promo = $('#promo').val();
		var kode_registrasi = $('#kode_registrasi').val();
		var kode_layanan = $('#layanan').val();
		if(perawatan != '' ){
			$.ajax({
				type: "POST",
				url: "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/simpan_treatment_temp",
				data: {
					kode_item:perawatan,kode_transaksi:kode_registrasi,kode_member:member,kode_promo:promo,kode_layanan:kode_layanan
				},

				success: function(msg)
				{ 
					$('#perawatan').select2("val","");
					$('#terapis').select2("val","");
					$('#id_treatment').val('');

					var kode_registrasi = $('#kode_registrasi').val();
					$("#tabel_treatment_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/treatment_temp/"+kode_registrasi);
				}
			});
		}else{alert('Masukan Data Lengkap')};
	});

	$("#ubah_treatment").click(function(){
		var id = $('#id_treatment').val();
		var perawatan = $('#perawatan').val();
		var terapis = $('#terapis').val();
		var promo = $('#promo').val();
		var member = $('#member').val();

		var url = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/ubah_treatment_temp/";
		$.ajax({
			type: "POST",
			url: url,
			data: {id:id,kode_item:perawatan,kode_promo:promo,kode_member:member},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg)
			{  
				$(".tunggu").hide();
				$('#simpan_treatment').show();
				$('#ubah_treatment').hide();  

				$('#perawatan').select2('val','');
				$('#terapis').select2('val','');
				$('#id_treatment').val('');

				var kode_registrasi = $('#kode_registrasi').val();
				$("#tabel_treatment_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/treatment_temp/"+kode_registrasi);
			}
		});
		return false;
	});

	$("#simpan_besar_konsul").click(function(){
		var member = $('#member').val();
		var kode_registrasi = $('#kode_registrasi').val();
		var layanan = $('#layanan').val();
		if(layanan == 03){
			var dokter = $('#dokter_periksa').val();
		}else{	
			var dokter = $('#dokter').val();
		}
		var periksa = $('#periksa').val();

		$.ajax({
			type: "POST",
			url: "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/simpan_besar_konsul/",
			data: {
				kode_transaksi:kode_registrasi,kode_member:member,kode_layanan:layanan,kode_dokter:dokter,kode_periksa:periksa
			},

			success: function(msg)
			{ 
       //window.location.reload();
       //window.open("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/print_treatment/"+kode_registrasi);
       var link = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/print_invoice";

       $.ajax({
       	type: "POST",
       	url: link,
       	data:{
       		kode_registrasi:kode_registrasi
       	},
       	success: function(msg)
       	{
       	}
       });

       window.location.reload();

   }
});
		return false;
	});


	$("#simpan_konsul").click(function(){
		var keluhan = $('#keluhan').val();
		var member = $('#member').val();
		var dokter = $('#dokter').val();
		var promo = $('#promo').val();
		var kode_registrasi = $('#kode_registrasi').val();

		$.ajax({
			type: "POST",
			url: "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/simpan_konsul_temp",
			data: {
				kode_dokter:dokter,keluhan:keluhan,kode_transaksi:kode_registrasi,kode_member:member,kode_promo:promo
			},

			success: function(msg)
			{ 
				$('#keluhan').select2("val","");
				$('#dokter').select2("val","");
				$('#id_treatment').val('');

				var kode_registrasi = $('#kode_registrasi').val();
				$("#tabel_konsul_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/konsul_temp/"+kode_registrasi);
			}
		});
	});

	$("#ubah_konsul").click(function(){
		var id = $('#id_konsul').val();
		var keluhan = $('#keluhan').val();
		var dokter = $('#dokter').val();

		var url = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/ubah_konsul_temp/";
		$.ajax({
			type: "POST",
			url: url,
			data: {id:id,keluhan:keluhan,kode_dokter:dokter},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg)
			{  
				$(".tunggu").hide();
				$('#add_simpan_konsul').show();
				$('#ubah_konsul').hide();  

				$('#dokter').select2("val",'');
				$('#keluhan').select2("val",'');
				$('#id_konsul').val('');

				var kode_registrasi = $('#kode_registrasi').val();
				$("#tabel_konsul_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/konsul_temp/"+kode_registrasi);
			}
		});
		return false;
	});

	function actEdit(id) {
		var id = id;
		var layanan = $('#layanan').val();
		if(layanan == '01')
		{ 
			var url = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/cari_treatment_temp/";
		}
		else if(layanan == '02' || layanan == '03')
		{
			var url = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/cari_konsul_temp/";
		}
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: {id:id},
			success: function(data){


				if(layanan == '01')
				{
					$('#perawatan').select2("val",data.kode_item+'|'+data.nama_item+'|'+data.harga);
					$('#terapis').select2("val",data.kode_terapis+'|'+data.nama_terapis);
					$('#id_treatment').val(data.id);

					$('#simpan_treatment').hide();
					$('#ubah_treatment').show();
				}
				else if(layanan == '02' || layanan == '03')
				{
					$('#dokter').select2('val',data.kode_dokter+'|'+data.nama_dokter);
					$('#keluhan').val(data.kode_periksa+'|'+data.nama_periksa);
					$('#id_konsul').val(data.id);

					$('#add_simpan_konsul').hide();
					$('#ubah_konsul').show();
				}
			}
		});
	}



	function actDelete(id) {

		var url = 'http://192.168.100.17/elladerma_cs/registrasi_pelayanan/hapus_pelayanan_temp';

		$.ajax({
			type: "POST",
			url: url,
			data: {
				id:id
			},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg) {
				$(".tunggu").hide();
				$('#modal-delete').modal('hide');
				var kode_registrasi = $('#kode_registrasi').val();
				var layanan = $('#layanan').val();

				if(layanan == '01')
				{
					$("#tabel_treatment_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/treatment_temp/"+kode_registrasi);
				}
				else if(layanan == '02' || layanan =='03')
				{
					$("#tabel_konsul_temp").load("http://192.168.100.17/elladerma_cs/registrasi_pelayanan/konsul_temp/"+kode_registrasi);
				}
			}
		});
		return false;
	}

	function actPrint(kode_registrasi){
		var url = "http://192.168.100.17/elladerma_cs/registrasi_pelayanan/print_invoice";
		var kode_registrasi = kode_registrasi;
		$.ajax({
			type:"post",
			url:url,
			data:{kode_registrasi:kode_registrasi},
			success:function(data){

			}
		})
	}

</script>