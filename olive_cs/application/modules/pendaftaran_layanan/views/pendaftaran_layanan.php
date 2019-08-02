
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Pendaftaran layanan</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Reservasi</span>
					<br><br>
				</div>
				<div class="panel-body">
					<form id="data_form">
						<div class="col-md-3">
							<div class="form-group">
								<label>Kode Reservasi</label>
								<input readonly="true" type="text" value="RES_100218085757_1" class="form-control" placeholder="Kode Reservasi" name="kode_reservasi" id="kode_reservasi" />
								<input readonly="true" type="hidden" value="PKT_100218085757" class="form-control" placeholder="Kode Transaksi" name="kode_transaksi" id="kode_transaksi" />
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>Customer</label>
								<select class="form-control select2" name="kode_member" id="kode_member" required="">
									<option value="">--Pilih Customer--</option>
									<option value="20171010001">Arda</option>
									<option value="20171011002">jihan ali reza</option>
									<option value="20171017003">Lia Rosinta</option>
									<option value="20171017004">Novia Chandra</option>
									<option value="20171017005">Irma Oktaviani</option>
									<option value="20171209001">Ihsan</option>
									<option value="20171209002">Sinta</option>
									<option value="20171209003">Ratna</option>
								</select> 
							</div>
						</div>

						<div class="col-md-1">  
							<div class="form-group">
								<label>&nbsp;</label>
								<a onclick="simpan_member()" id="simpan_member"  class="btn btn-primary btn-block">Simpan</a>
								<a onclick="delete_member()" id="update_member"  class="btn btn-danger btn-block">Delete</a>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="sukses" ></div>

						</div>


						<br>



						<div style="width: 100%; float: left; padding-bottom: 30px; margin-top:15px;" class="form_reservasi">

							<div class="col-md-12" style="padding: 0;" data-mh="xxx">


								<div class="col-md-12">
									<div style=" float: left; padding: 14px 0; ; margin-bottom: 15px;width: 100%;">

										<div class="col-xs-6 ">
											<label>Paket</label>
											<input type="hidden" name="kode_paket_lama" id="kode_paket_lama">
											<select name="kode_paket" id="kode_paket" class="form-control">
												<option value="">--Pilih Paket</option>
												<option value="PKT0002">Paket A</option>
												<option value="PKT0003">test</option>
												<option value="PKT0004">anam2</option>
												<option value="PKT45345">Paket A2</option>
												<option value="PKT2108">Paket  B</option>
											</select>
										</div>

										<div class="col-xs-1">
											<label>&nbsp;</label>
											<a onclick="add_item()" style="margin-top: 27px;" id="add"  class="btn btn-primary">Add</a>
											<a onclick="update_item()" id="update" style="padding-left: 5px ;padding-right: 5px;" class="btn btn-warning pull-left">Update</a>
										</div>
									</div>              
								</div>
								<div id="list_transaksi_reservasi" class="col-xs-12">
									<div class="box-body">
										<label><strong>List Produk</strong></label>
										<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
											<thead>
												<tr>
													<th>No</th>
													<th>Treatment</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody id="tabel_temp_data_transaksi">

											</tbody>
											<tfoot>

											</tfoot>
										</table>
									</div>
								</div>

								<div class="col-md-12"><strong><div id="nilai_uang_muka" class="pull-right" style="font-size: 20px"></div></strong></div>

							</div>
						</div>

						<div class="col-xs-12 form_reservasi" style="margin-bottom: 15px;">
							<a onclick="confirm_bayar()"  class="btn btn-success btn-block btn-lg" style="padding: 10px 0; border-radius: 8px !important;"><i class="fa fa-save"></i> Simpan</a>
						</div>
					</form>
					<div id="cari_transaksi" style="margin-top: 100px">
						<table class="table table-striped table-hover table-bordered" id="daftar_reservasi"  style="font-size:1.0em;">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Tanggal Transaksi</th>
									<th>Kode Customer</th>
									<th>Nama Customer</th>
									<th>Status</th>
									<th>Detail</th>
								</tr>
							</thead>
							<tbody id="scroll_data">

								<tr>
									<td>1</td>
									<td>RES_030218144936_8</td>
									<td>2018-02-03</td>
									<td>20171209001</td>
									<td>Ihsan</td>
									<td>menunggu</td>
									<td align="center">
										<div class="btn-group">
											<a href="<?php echo base_url ('pendaftaran_layanan/detail') ?>" data-toggle="tooltip" title="Detail" class="btn btn-success btn-circle green"><i class="fa fa-search"></i> </a>
										</div>
									</td> 
								</tr> 
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

  $('#nama_barang').hide();

  function formDefault() {
  	$('#kategori_bahan').val('');
  	$('.sec_bahan_baku').hide();
  	$('.sec_perlengkapan').hide();
  	$('.sec_produk').hide();
  	$('#nama_barang').hide();
  	$('.pilih select').show();
  	$('.pilih').show();
  	$('.jumlah').val('0');
  	$('#satuan_stok').val('');
  	$('#harga').val('0');
  	$('#jenis_diskon_item').val('Persen');
  	$('#diskon_item').val('0');
  	$('#sub_total').val('0');
  	$('#expired_date').val('');
  	$('.sec_expdate').hide();
  }


  $(".form_reservasi").hide();
  $(".sec_perlengkapan").hide();

  function setting() {
  	$('#modal_setting').modal('show');
  }

  function simpan_member() {
  	var kode_member = $("#kode_member").val();
  	if (kode_member == '') {
  		alert('Nama Customer Harus Diisi.');
  	}else{
  		save_member();
  	};
  }
  function update_member() {
  	$('#modal-member-update').modal('show');
  }

  function save_member(){
  	document.getElementById('kode_member').disabled = true;
    // document.getElementById('nomor_nota').readOnly = true;
    $('#modal-member').modal('hide');
    $("#update_member").show();
    $("#simpan_member").hide();
    $(".form_reservasi").show();
    $("#dokter").show();
    $("#tanggal_reservasi").show();
}

function delete_member(){
	document.getElementById('kode_member').disabled = false;
    // document.getElementById('nomor_nota').readOnly = false;
    $('#modal-member-update').modal('hide');
    $("#update_member").hide();
    $("#simpan_member").show();
    $(".form_reservasi").hide();

    var kode_reservasi = $('#kode_reservasi').val();
    var kode_member = $('#kode_member').val();
    var url = 'http://192.168.100.17/elladerma_cs/reservasi/reservasi/hapus_temp';
    $.ajax({
    	type: "POST",
    	url: url,
    	data: $('#data_form').serialize(),
    	beforeSend:function(){
    		$(".tunggu").show();  
    	},
    	success: function(msg) {

    		$(".tunggu").hide();
    		$('#modal-confirm').modal('hide');
    		$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_cs/reservasi/reservasi/get_reservasi/"+kode_reservasi);
    		$('#kategori_bahan').val('bahan baku');
    		get_grandtotal();
    		window.location.href="";
    	}
    });
    return false;
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



$(document).ready(function(){
	$(".select2").select2();
	$("#tanggal").hide();
	$("#dokter").hide();
	$("#tanggal_reservasi").hide();
	$("#update").hide();
	$("#update_member").hide();
	$("#peralatan").hide();
	$("#form_expired").hide();
	$(".sec_bahan_baku").hide();
	$(".sec_produk").hide();
	$(".sec_expdate").hide();



	var kode_reservasi = $('#kode_reservasi').val() ;  
	$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_cs/reservasi/get_reservasi/"+kode_reservasi);

	$(".tgl").datepicker();

	$('#nomor_nota').on('change',function(){
		var nomor_nota = $('#nomor_nota').val();
		var url = "http://192.168.100.17/elladerma_cs/reservasi/get_kode_nota";
		$.ajax({
			type: 'POST',
			url: url,
			data: {nomor_nota:nomor_nota},
			success: function(msg){
				if(msg == 1){
					$(".notif_nota").html('<div class="alert alert-warning">Kode_Telah_dipakai</div>');
					setTimeout(function(){
						$('.notif_nota').html('');
					},1700);              
					$('#nomor_nota').val('');
				}
				else{

				}
			}
		});
	});


	$("#kode_sub").val('2.1.1');

	$("#proses_pembayaran").change(function(){
		var proses_pembayaran = $("#proses_pembayaran").val();
		if(proses_pembayaran== 'cash'){
			$("#kode_sub").val('2.1.1');
		}
		else if(proses_pembayaran== 'debet'){
			$("#kode_sub").val('2.1.2');

		}
		else{
			$("#kode_sub").val('2.1.3');
		}
		if(proses=="kredit"){
			$("#tanggal").show();
		}else{
			$("#tanggal").hide();
		}
	});



	$("#dibayar").keyup(function(){
		var dibayar = $("#dibayar").val();
		var kode_reservasi = $('#kode_reservasi').val() ;
		var grand = $("#tb_grand_total").text();
		var proses_pembayaran = $('#proses_pembayaran').val() ;
		var url = "http://192.168.100.17/elladerma_cs/reservasi/get_rupiah";
		var url_kredit = "http://192.168.100.17/elladerma_cs/reservasi/get_rupiah_kredit";
		if(proses_pembayaran==''){
			alert('Pembayaran Harus Diisi');
		}
		else{
			if(proses_pembayaran=='cash' || proses_pembayaran=='debet'){
				$.ajax({
					type: "POST",
					url: url,
					data: {dibayar:dibayar,kode_reservasi:kode_reservasi,grand:grand},
					success: function(msg) {            
						var data = msg.split("|");  
						var nilai_dibayar = data[1];
						var nilai_kembali = data[0];
						$("#nilai_dibayar").html(nilai_dibayar);


					}
				});
			}
			else if(proses_pembayaran=='credit'){
				$.ajax({
					type: "POST",
					url: url_kredit,
					data: {dibayar:dibayar,kode_reservasi:kode_reservasi,grand:grand},
					success: function(msg) {            
						var data = msg.split("|");  
						var nilai_dibayar = data[1];
						var nilai_kembali = data[0];
						$("#nilai_dibayar").html(nilai_dibayar);
						$("#nilai_kembali").html(nilai_kembali);
					}
				});
			}
		}

	})

	$("#simpan_transaksi").click(function(){


	});

});
function simpan_transaksi() {
	var simpan_transaksi = "http://192.168.100.17/elladerma_cs/reservasi/reservasi/simpan_transaksi";
	var kode_reservasi = $('#kode_reservasi').val() ;
	$.ajax({
		type: "POST",
		url: simpan_transaksi,
        // data: $('#data_form').serialize(),
        data: {

        	kode_reservasi:$('#kode_reservasi').val(),
        	kode_transaksi:$('#kode_transaksi').val(),
        	kode_dokter:$('#kode_dokter').val(),
        	kode_item:$('#kode_item').val(),
        	tanggal_reservasi:$('#tanggal_reservasi').val(),
        	kode_member:$('#kode_member').val(),
        },
        beforeSend:function(){
        	$(".tunggu").show();  
        },
        success: function(msg)
        {
        	$(".tunggu").hide();  
        	$("#modal-confirm-bayar").modal('hide');
        	var data = msg.split("|");
        	var num = parseInt(data[0]);
        	var pesan = data[1];

        	if(num > 0){  
        		kode = $("#kode_sub").val();
        		setTimeout(function(){$('.sukses').html(msg);
                // window.location = "http://192.168.100.17/elladerma_cs/reservasi/tambah";
                window.location = "";
                // window.open("http://192.168.100.17/elladerma_cs/reservasi/print_reservasi/"+kode_reservasi);
            },1500);  
        	}
        	else{
        		$(".sukses").html(pesan);   
        		setTimeout(function(){$('.sukses').html('');
        			window.location = "";
        		},1500); 
        	}     
        }
    });
	return false;
}
function add_item(){
	var kode_reservasi = $('#kode_reservasi').val();
	var kode_member = $('#kode_member').val();
	var kode_paket = $('#kode_paket').val();

	var url = "http://192.168.100.17/elladerma_cs/reservasi/reservasi/add_item_temp/ ";

	if(kode_member == ''){
		$(".sukses").html('<div class="alert alert-danger">Nomor Nota dan member harus diisi.</div><span aria-hidden="true">&times;</span>');   
		setTimeout(function(){
			$('.sukses').html('');     
		},3000);
	}
	else{
		$.ajax({
			type: "POST",
			url: url,
			data: {
				kode_paket:kode_paket,
				kode_reservasi:kode_reservasi,
				kode_member:kode_member
			},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(data)
			{
				$(".tunggu").hide();
				$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_cs/reservasi/reservasi/get_reservasi/"+kode_reservasi);
				$('.sukses').html('');     
				$('#kode_paket').val('');

			}
		});
	}
}

function actDelete(id) {
	$('#id-delete').val(id);
	$('#modal-confirm').modal('show');
}

function actEdit(id) {
  // alert(id);
  var id = id;
  var kode_reservasi = $('#kode_reservasi').val();
  var url = "http://192.168.100.17/elladerma_cs/reservasi/reservasi/get_temp_reservasi";
  $.ajax({
  	type: 'POST',
  	url: url,
  	dataType: 'json',
  	data: {id:id},
  	success: function(reservasi){
  		$("#add").hide();
  		$("#update").show();



  		$("#kode_paket").val(reservasi.kode_paket);
  		$("#kode_paket_lama").val(reservasi.kode_paket);
      // $("#id_item").val(reservasi.id);






      $("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_cs/reservasi/reservasi/get_reservasi/"+kode_reservasi);
      // document.getElementById('kode_perawatan').disabled = true;
  }
});
}



function update_item(){
	var kode_reservasi = $('#kode_reservasi').val();
	var kode_member = $('#kode_member').val();
	var kode_paket = $('#kode_paket').val();
	var kode_paket_lama = $('#kode_paket_lama').val();

	var url = "http://192.168.100.17/elladerma_cs/reservasi/reservasi/update_item/ ";

	$.ajax({
		type: "POST",
		url: url,
		data: { 
			kode_reservasi:kode_reservasi,
			kode_member:kode_member,
			kode_paket:kode_paket,
			kode_paket_lama:kode_paket_lama,

		},
		success: function(data)
		{
			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_cs/reservasi/reservasi/get_reservasi/"+kode_reservasi);
			$("#kode_paket").val('');
			$("#kode_paket_lama").val('');

			$("#add").show();
			$("#update").hide();

		}
	});
}

function actDelete(id) {
	var kode_reservasi = $('#kode_reservasi').val();
	var url = 'http://192.168.100.17/elladerma_cs/reservasi/reservasi/hapus_bahan_temp/delete';
	$.ajax({
		type: "POST",
		url: url,
		dataType: 'json',
		data: {
			id:id
		},
		beforeSend:function(){
			$(".tunggu").show();  
		},
		success: function(msg) {

			$(".tunggu").hide();
			$('#modal-confirm').modal('hide');
			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_cs/reservasi/reservasi/get_reservasi/"+kode_reservasi);
			$('#kategori_bahan').val('bahan baku');
      // get_grandtotal();

  }
});
	return false;
}

function get_kembali() {
	var uang_muka = $('#uang_muka').val();
	var grand_total = $('#grand_total').val();
	var jenis_pembayaran = $('#jenis_pembayaran').val();
	var url = 'http://192.168.100.17/elladerma_cs/reservasi/get_kembali';

	if((parseInt(uang_muka) < 0 || uang_muka=='-') && jenis_pembayaran=='cash'){
		alert("Nominal Salah");
		$('#uang_muka').val('');
		get_grandtotal();

	}else if((parseInt(uang_muka) < 0 || uang_muka=='-' || parseInt(uang_muka) >= parseInt(grand_total)) && jenis_pembayaran=='kredit'){
		alert("Nominal Salah");
		$('#uang_muka').val('');
		get_grandtotal();
		$('#nilai_uang_muka').text('Rp. 0');

	}else{
		$.ajax({
			type: "POST",
			url: url,
			dataType: 'json',
			data: {
				grand_total:grand_total,uang_muka:uang_muka,jenis_pembayaran:jenis_pembayaran
			},
			success: function(msg) {
				$('#nilai_dibayar').text(msg.nilai_kembali);
				$('#kembalian').val(msg.kembali);
				$('#nilai_uang_muka').text(msg.nilai_uang_muka);
			}
		});
		return false;
	}

}



function setValZero()
{
	$('#jumlah').val('0');
	$('#harga').val('0');
	$('#sub_total').val('0');
	$('#diskon_item').val('0');
}



</script>
