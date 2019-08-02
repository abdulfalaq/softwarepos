
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
						<span class="pull-left" style="font-size: 24px">Buka Kasir</span>
						<br><br>
					</div>

					<div class="panel-body">                   
						<div class="sukses" ></div>
						<div class="box-body"> 
							<form id="data_form" method="post">
								<div class="box-body">            
									<div class="row">
										<div class="form-group  col-xs-5">
											<label><b>Kode Customer</label>
											<input type="hidden" id="id" name="id" value=""></input>
											<input  name="kode_member" value="20180210001" readonly="true" type="text" class="form-control input_kode_member" id="kode_member"/>
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Alamat Customer</label>
											<input  value="" type="text" class="form-control input_alamat_member" name="alamat_member" id="alamat_member" />
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Nama Customer</label>
											<input  value="" type="text" id="nama_member" class="form-control input_nama_member" name="nama_member" />
										</div>
										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>No. Telp</label>
											<input  value="" type="text" id="telp_member" class="form-control input_telp_member" name="telp_member" />
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>No. KTP</label>
											<input  value="" type="text" id="no_ktp" class="form-control input_no_ktp" name="no_ktp" />
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Pekerjaan</label>
											<select class="form-control input_pekerjaan select2" name="pekerjaan" id="pekerjaan">
												<option selected="true" value="">--Pilih Pekerjaan--</option>
												<option  value="PNS" >PNS</option>
												<option  value="Guru" >Guru</option>
												<option  value="Dosen" >Dosen</option>
												<option  value="Pelajar/Mahasiswa" >Pelajar/Mahasiswa</option>
												<option  value="BUMN" >BUMN</option>
												<option  value="Swasta" >Swasta</option>
												<option  value="Wiraswasta" >Wiraswasta</option>
												<option  value="IRT" >IRT</option>
												<option  value="Lain-lain" >Lain - Lain</option>
											</select> 
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Tempat Lahir</label>
											<input  value="" type="text" id="tempat_lahir" class="form-control input_tempat_lahir" name="tempat_lahir" />
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Status Perkawinan</label>
											<select  class="form-control stok select2 input_status_perkawinan" name="status_perkawinan" id="status_perkawinan">
												<option value="">--Pilih Status Perkawinan--</option>
												<option  value="Menikah" >Menikah</option>
												<option  value="Belum Menikah" >Belum Menikah</option>
												<option  value="Janda/Duda" >Janda/Duda</option>
											</select> 
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Tanggal Lahir</label>
											<input  value="" type="date" id="tanggal_lahir" class="form-control input_tanggal_lahir" name="tanggal_lahir" />
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Agama</label>
											<select  class="form-control stok select2 input_agama" name="agama" id="agama">
												<option value="">--Pilih Agama--</option>
												<option  value="Islam" >Islam</option>
												<option  value="Kristen" >Kristen</option>
												<option  value="Katolik" >Katolik</option>
												<option  value="Hindu" >Hindu</option>
												<option  value="Budha" >Budha</option>
												<option  value="Lain-lain" >Lain-lain</option>
											</select> 
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Jenis Kelamin</label>
											<select  class="form-control stok select2 input_jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin">
												<option value="">--Pilih Jenis Kelamin--</option>
												<option  value="Laki-laki" >Laki-laki</option>
												<option  value="Perempuan" >Perempuan</option>
											</select> 
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Kategori Customer</label>
											<select  class="form-control stok select2 input_kategori_member" name="kategori_member" id="kategori_member">
												<option value="">--Pilih Kategori Member--</option>
												<option  value="Non Member" >Non Member</option>
												<option  value="Member" >Member</option>
											</select> 
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Afiliasi</label>
											<select  class="form-control stok select2 input_status" name="afiliasi" id="afiliasi">
												<option value="">--Pilih Afiliasi--</option>
												<option value="Event" >Event</option>
												<option value="Instagram" >Instagram</option>
												<option value="Facebook" >Facebook</option>
												<option value="Twitter" >Twitter</option>
												<option value="Keluarga/Teman" >Keluarga/Teman</option>
												<option value="Lain-lain" >Lain-lain</option>
											</select> 
										</div>


										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Status</label>
											<select  class="form-control stok select2 input_status" name="status_member" id="status_member">

												<option value="">--Pilih Status--</option>
												<option  value="1" >Aktif</option>
												<option  value="0" >Nonaktif</option>
											</select> 
										</div>

									</div>
									<div class="box-footer">
										<button type="submit" id="simpan" class="btn btn-primary">Simpan</button>               
									</div>
								</div>
							</form>
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