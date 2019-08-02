<style type="text/css">
  .ppi {
   height: 60px !important;
 }
</style>
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li>Stok Out</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Data Stok Out</h1>
	<!-- <?php $this->load->view('menu_master'); ?> -->
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Stok Out</span>
					<a href="<?php echo base_url('stok_out/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Stok Out</a>
					<a href="<?php echo base_url('stok_out'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Stok Out</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
            <?php 
            $this->db->order_by('id','DESC');
            $get_gudang = $this->db->get('transaksi_stok_out')->result();
            ?>
            <table id="datatable" class="table table-striped table-bordered">
             <thead>
              <tr>
               <th>No</th>
               <th>Tanggal Stok Out</th>
               <th>Kode Stok Out</th>
               <th>Petugas</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody>    
            <?php 
            $no = 0;
            foreach ($get_gudang as $value) { 
              $no++; ?>
              <tr>
               <td><?= $no ?></td>
               <td><?= $value->tanggal_input ?></td>
               <td><?= $value->kode_stok_out ?></td>
               <td><?= $value->kode_petugas ?></td>
               <td>
                <a href="<?php echo base_url('stok_out/detail/'.@$value->kode_stok_out);?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
              </td>
            </tr>
            <?php 
          } 
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>
<!-- Content Wrapper. Contains page content -->
<!-- /.content-wrapper -->
<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus pembelian bahan tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delData()" class="btn green">Ya</button>
			</div>
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
<div id="modal-supplier-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus data tersebut ?</span>
				<input id="kode_supplier" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delete_supplier()" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm-bayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Pembayaran</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan membayar pembelian tersebut<!-- bahan sebesar <span id="bayare"></span> --> ?</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button id="simpan_transaksi" class="btn green">Ya</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-confirm-tanggal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Jatuh Tempo</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Silahkan Pilih Tanggal Jatuh Tempo !</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

			</div>
		</div>
	</div>
</div>
<div id="modal-confirm-dibayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Bayar</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Nominal Pembayaran Kurang !</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

			</div>
		</div>
	</div>
</div>
<div id="modal-confirm-uangmuka" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Uang Muka</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Periksa Kembali Nominal Uang Muka !</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

			</div>
		</div>
	</div>
</div>



<script type="text/javascript">

  // setInterval(function(){
  //   var jenis_bahan = $('#kategori_bahan').val();
  //   if(jenis_bahan == ""){
  //       $('.sec_bahan_baku').hide();
  //       $('.sec_perlengkapan').hide();
  //       $('.pilih').show();
  //   }
  // },100);

  $('#nama_barang').hide();

  function formDefault() {
  	$('.jumlah').val('0');
  	$('#satuan_stok').val('');
  	$('#harga').val('0');
  	$('#jenis_diskon_item').val('Persen');
  	$('#diskon_item').val('0');
  	$('#sub_total').val('0');
  	$('.sec_expdate').hide();
  }


  $(".form_pembelian").hide();
  $(".sec_perlengkapan").hide();

  function setting() {
  	$('#modal_setting').modal('show');
  }

  function simpan_supplier() {
  	var kode_supplier = $("#kode_supplier").val();
  	if (kode_supplier == '') {
  		alert('Nama Supplier Harus Diisi.');
  	}else{
  		$('#modal-supplier').modal('show');
  	};
  }
  function update_supplier() {
  	$('#modal-supplier-update').modal('show');
  }

  function save_supplier(){
  	document.getElementById('kode_supplier').disabled = true;
  	document.getElementById('nomor_nota').readOnly = true;
  	$('#modal-supplier').modal('hide');
  	$("#update_supplier").show();
  	$("#simpan_supplier").hide();
  	$(".form_pembelian").show();
  }

  function delete_supplier(){
  	document.getElementById('kode_supplier').disabled = false;
  	document.getElementById('nomor_nota').readOnly = false;
  	$('#modal-supplier-update').modal('hide');
  	$("#update_supplier").hide();
  	$("#simpan_supplier").show();
  	$(".form_pembelian").hide();

  	var kode_pembelian = $('#kode_pembelian').val();
  	var kode_supplier = $('#kode_supplier').val();
  	var url = 'http://192.168.100.17/elladerma_gudang/kartu_member/hapus_temp';
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
  			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/kartu_member/get_kartu_member/"+kode_pembelian);
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
  		$("#bayare").text(uang);
  		$("#modal-confirm-bayar").modal('show');
  	}

  }

  $('#jenis_diskon_item').on('change',function(){
  	var jenis_diskon_item = $("#jenis_diskon_item").val();
  	var jumlah = $('#jumlah').val();
  	var harga = $('#harga').val();
  	var pembelian=(jumlah * harga);
  	if(jenis_diskon_item == 'Persen')
  	{ 
  		$(".icon_diskon_item").text('%');
  	}else if(jenis_diskon_item == 'Rupiah')
  	{
  		$(".icon_diskon_item").text('Rp');
  	}
  	$("#diskon_item").val('');
  	$("#sub_total").val(pembelian);
  });
  $('#jenis_diskon').on('change',function(){
  	var jenis_diskon = $("#jenis_diskon").val();
  	if(jenis_diskon == 'Persen')
  	{ 
  		$(".icon_diskon").text('%');
  	}else if(jenis_diskon == 'Rupiah')
  	{
  		$(".icon_diskon").text('Rp');
  	}
  	$("#diskon").val('');
  	get_grandtotal();
  });

  $("#diskon_item").keyup(function(){
  	var jenis_diskon_item = $("#jenis_diskon_item").val();
  	var diskon_item = parseInt($("#diskon_item").val());
  	var jumlah = $('#jumlah').val();
  	var harga = $('#harga').val();
  	var pembelian=(jumlah * harga);
  	if(jenis_diskon_item == 'Persen'){ 
  		if(diskon_item < 0 || diskon_item > 100){
  			alert('Jumlah Diskon Salah');
  			$("#diskon_item").val('');
  			$("#sub_total").val(pembelian);
  		}else{

  			var nilai_diskon = ( pembelian * diskon_item) /100;
  			var total = ( pembelian - nilai_diskon);
  			$("#sub_total").val(total);
  		}
  	}else if(jenis_diskon_item == 'Rupiah'){
  		if(diskon_item < 0 ||diskon_item > pembelian){
  			alert('Jumlah Diskon Salah');
  			$("#diskon_item").val('');
  			$("#sub_total").val(pembelian);
  		}else{
  			var total = ( pembelian - diskon_item);
  			$("#sub_total").val(total);
  		}
  	}

  });

  $("#diskon").keyup(function(){
  	var jenis_diskon = $("#jenis_diskon").val();
  	var diskon = parseInt($(this).val());
  	var pembelian=$('#total_pembelian').val();
  	if(jenis_diskon == 'Persen'){ 
  		if(diskon < 0 || diskon > 99){
  			alert('Jumlah Diskon Salah');
  			$("#diskon").val('');
  		}
  	}else if(jenis_diskon == 'Rupiah'){
  		if(diskon < 0 ||diskon > pembelian){
  			alert('Jumlah Diskon Salah');
  			$("#diskon").val('');
  		}
  	}
  	get_grandtotal();
  });

  $('#jenis_pembayaran').on('change',function(){
  	var jenis_pembayaran = $("#jenis_pembayaran").val();
  	$("#jatuh_tempo").val('');

  	if(jenis_pembayaran == 'cash')
  	{ 
  		$("#form_jatuh_tempo").hide();
  		$("#label_uang_muka").text('Dibayar');
  		$("#label_kembalian").text('Kembalian');
  	}else if(jenis_pembayaran == 'kredit')
  	{
  		$("#form_jatuh_tempo").show();
  		$("#uang_muka").val('');
  		$("#label_uang_muka").text('Uang Muka');
  		$("#label_kembalian").text('Hutang');
  	}
  	get_grandtotal();
  });

  var jenis_pembayaran = $("#jenis_pembayaran").val();
  if(jenis_pembayaran == 'cash')
  {
  	$("#form_jatuh_tempo").hide();
  	var total = $("#tabel_temp_data_transaksi #tb_grand_total").text();
  	$("#uang_muka").val(total);
  }else if(jenis_pembayaran == 'kredit')
  {
  	$("#form_jatuh_tempo").show();

  }


  $("#jumlah").keyup(function(){

  	var jumlah = parseInt($('#jumlah').val());
  	if(jumlah < 0  ){
  		alert("Jumlah Salah");
  	}else{
  		var jenis_diskon_item = $("#jenis_diskon_item").val();
  		var diskon_item = parseInt($("#diskon_item").val()); 
  		var harga = $('#harga').val();
  		var pembelian=(jumlah * harga);
  		if(jenis_diskon_item == 'Persen' && $("#diskon_item").val() !=''){ 
  			if(diskon_item < 0 || diskon_item > 100){
  				alert('Jumlah Diskon Salah');
  				$("#diskon_item").val('');
  				$("#sub_total").val('');
  			}else{

  				var nilai_diskon = ( pembelian * diskon_item) /100;
  				var total = ( pembelian - nilai_diskon);
  				$("#sub_total").val(total);
  			}
  		}else if(jenis_diskon_item == 'Rupiah' && $("#diskon_item").val() !=''){
  			if(diskon_item < 0 ||diskon_item > pembelian){
  				alert('Jumlah Diskon Salah');
  				$("#diskon_item").val('');
  				$("#sub_total").val('');
  			}else{
  				var total = ( pembelian - diskon_item);
  				$("#sub_total").val(total);
  			}
  		}else{
  			$("#sub_total").val(pembelian);
  		}
  	}
  });



  $("#harga").keyup(function(){
  	var harga = parseInt($('#harga').val());
  	if(harga < 0  ){
  		alert("Jumlah Salah");
  	}else{
  		var jenis_diskon_item = $("#jenis_diskon_item").val();
  		var diskon_item = parseInt($("#diskon_item").val()); 
  		var jumlah = parseInt($('#jumlah').val());
  		var pembelian=(jumlah * harga);
  		if(jenis_diskon_item == 'Persen' && $("#diskon_item").val() !=''){ 
  			if(diskon_item < 0 || diskon_item > 100){
  				alert('Jumlah Diskon Salah');
  				$("#diskon_item").val('');
  				$("#sub_total").val('');
  			}else{
  				var nilai_diskon = (pembelian * diskon_item) /100;
  				var total = ( pembelian - nilai_diskon);
  				$("#sub_total").val(total);
  			}

  		}else if(jenis_diskon_item == 'Rupiah' && $("#diskon_item").val() !=''){
  			if(diskon_item < 0 ||diskon_item > pembelian){
  				alert('Jumlah Diskon Salah');
  				$("#diskon_item").val('');
  				$("#sub_total").val('');
  			}else{
  				var total = ( pembelian - diskon_item);
  				$("#sub_total").val(total);
  			}
  		}else{
  			$("#sub_total").val(pembelian);

  		}
  	}

  });


  $(document).ready(function(){
  	$("#tanggal").hide();
  	$("#update").hide();
  	$("#update_supplier").hide();
  	$("#peralatan").hide();
  	$("#form_expired").hide();
  	$(".sec_bahan_baku").hide();
  	$(".sec_produk").hide();
  	$(".sec_expdate").hide();



  	var kode_pembelian = $('#kode_pembelian').val() ;  
  	$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/kartu_member/get_kartu_member/"+kode_pembelian);

  	$(".tgl").datepicker();

    // $('#nomor_nota').on('change',function(){
    //   var nomor_nota = $('#nomor_nota').val();
    //   var url = "http://192.168.100.17/elladerma_gudang/kartu_member/get_kode_nota";
    //   $.ajax({
    //     type: 'POST',
    //     url: url,
    //     data: {nomor_nota:nomor_nota},
    //     success: function(msg){
    //       if(msg == 1){
    //         $(".notif_nota").html('<div class="alert alert-warning">Kode_Telah_dipakai</div>');
    //         setTimeout(function(){
    //           $('.notif_nota').html('');
    //         },1700);              
    //         $('#nomor_nota').val('');
    //       }
    //       else{

    //       }
    //     }
    //   });
    // });


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
    	var kode_pembelian = $('#kode_pembelian').val() ;
    	var grand = $("#tb_grand_total").text();
    	var proses_pembayaran = $('#proses_pembayaran').val() ;
    	var url = "http://192.168.100.17/elladerma_gudang/kartu_member/get_rupiah";
    	var url_kredit = "http://192.168.100.17/elladerma_gudang/kartu_member/get_rupiah_kredit";
    	if(proses_pembayaran==''){
    		alert('Pembayaran Harus Diisi');
    	}
    	else{
    		if(proses_pembayaran=='cash' || proses_pembayaran=='debet'){
    			$.ajax({
    				type: "POST",
    				url: url,
    				data: {dibayar:dibayar,kode_pembelian:kode_pembelian,grand:grand},
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
    				data: {dibayar:dibayar,kode_pembelian:kode_pembelian,grand:grand},
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
    	var simpan_transaksi = "http://192.168.100.17/elladerma_gudang/kartu_member/simpan_transaksi";
    	var kode_pembelian = $('#kode_pembelian').val() ;
    	$.ajax({
    		type: "POST",
    		url: simpan_transaksi,
    		data: {
    			kode_pembelian:$('#kode_pembelian').val(),
    			nomor_nota:$('#nomor_nota').val(),
    			kode_supplier:$('#kode_supplier').val(),
    			total_pembelian:$('#total_pembelian').val(),
    			jenis_diskon:$('#jenis_diskon').val(),
    			diskon:$('#diskon').val(),
    			grand_total:$('#grand_total').val(),
    			proses_pembayaran:$('#jenis_pembayaran').val(),
    			uang_muka:$('#uang_muka').val(),
    			kembalian:$('#kembalian').val(),
    			tanggal_jatuh_tempo:$('#jatuh_tempo').val()
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
    					window.location = "";
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

    });

  });

function add_item(){
	var nama_kartu_member = $('#nama_kartu_member').val();
	var kode_kartu_member = $('#kode_kartu_member').val();
	var jumlah = $('#jumlah').val();
	var harga = $('#harga').val();
	var kode_pembelian = $('#kode_pembelian').val();
	var kode_supplier = $('#kode_supplier').val();
	var diskon = $('#diskon_item').val();
	var jenis_diskon = $('#jenis_diskon_item').val();
	var subtotal = $("#sub_total").val();

	var url = "http://192.168.100.17/elladerma_gudang/kartu_member/add_item_temp/ ";

	if(nomor_nota == '' && kode_supplier == ''){
		$(".sukses").html('<div class="alert alert-danger">Nomor Nota dan Supplier harus diisi.</div><span aria-hidden="true">&times;</span>');   
		setTimeout(function(){
			$('.sukses').html('');     
		},3000);
	}else if(jumlah == ''){
		$(".sukses").html('<div class="alert alert-danger">Silahkan Lengkapi Form</div>');   
		setTimeout(function(){
			$('.sukses').html('');     
		},3000);
	}
	else{
		$.ajax({
			type: "POST",
			url: url,
			data: {
				nama_kartu_member:$('#nama_kartu_member').val(),
				kode_kartu_member:$('#kode_kartu_member').val(),
				jumlah:$('#jumlah').val(),
				harga:$('#harga').val(),
				kode_pembelian:$('#kode_pembelian').val(),
				kode_supplier:$('#kode_supplier').val(),
				diskon_item:$('#diskon_item').val(),
				jenis_diskon_item:$('#jenis_diskon_item').val(),
				sub_total:$('#sub_total').val()
			},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(data)
			{
				$(".tunggu").hide();
				formDefault();

				if(data==1){
					$(".sukses").html('<div class="alert alert-danger">Item Telah Tersedia</div>');
					setTimeout(function(){$('.sukses').html('');},1800); 
				}else{
					$('.sukses').html('');     
					$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/kartu_member/get_kartu_member/"+kode_pembelian);
					$('#jumlah').val('');
					$('#qty').val('');
					$("#harga").val('');
					$("#diskon_item").val('');
					$('#sub_total').val('');
					get_grandtotal();
				}
			}
		});
	}
}

function actDelete(id) {
	$('#id-delete').val(id);
	$('#modal-confirm').modal('show');
}

function actEdit(id) {
  // $('#kategori_bahan').attr('disabled','disabled');
  // $('#kode_perlengkapan').attr('disabled','disabled');
  var id = id;
  var kode_pembelian = $('#kode_pembelian').val();
  var url = "http://192.168.100.17/elladerma_gudang/kartu_member/get_temp_kartu_member";
  $.ajax({
  	type: 'POST',
  	url: url,
  	dataType: 'json',
  	data: {id:id},
  	success: function(pembelian){
  		$("#add").hide();
  		$("#update").show();


      // $('#kategori_bahan').val(pembelian.kategori_bahan);
      $("#kode_bahan").val(pembelian.kode_bahan);
      $("#kode_produk").val(pembelian.kode_bahan);
      $("#kode_perlengkapan").val(pembelian.kode_bahan);
      $("#kategori_bahan").val(pembelian.kategori_bahan);
      $("#nama_bahan").val(pembelian.nama_bahan);
      $('#jumlah').val(pembelian.jumlah);
      $('#kode_satuan').val(pembelian.kode_satuan);
      $("#nama_satuan").val(pembelian.nama_satuan);
      $('#harga').val(pembelian.harga_satuan);
      $('#diskon_item').val(pembelian.diskon_item);
      $('#jenis_diskon_item').val(pembelian.jenis_diskon);
      $('#sub_total').val(pembelian.subtotal);
      $('#expired_date').val(pembelian.expired_date);
      $('#satuan_stok').val(pembelian.nama_satuan);
      $('#kode_supplier').val(pembelian.kode_supplier);
      $('#sub_total').val(pembelian.subtotal);
      $("#id_item").val(pembelian.id);

      $('.sec_expdate').val(pembelian.expired_date);

      $('#nama_barang').show();
      $('#nama_barang').val(pembelian.nama_bahan);
      $('.pilih select').hide();

      if(pembelian.kategori_bahan == "bahan_baku"){
      	$('.sec_expdate').show();
      }


      $("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/kartu_member/get_kartu_member/"+kode_pembelian);
      // document.getElementById('kode_bahan').disabled = true;
    }
  });
}

function update_item(){
	var kode_pembelian = $('#kode_pembelian').val();
	var diskon = $('#diskon_item').val();
	var jumlah = $('#jumlah').val();
	var harga_satuan = $('#harga').val();
	var subtotal = $("#sub_total").val();
	var jenis_diskon = $("#jenis_diskon_item").val();
	var id_item = $("#id_item").val();

	var url = "http://192.168.100.17/elladerma_gudang/kartu_member/update_item/ ";

	$.ajax({
		type: "POST",
		url: url,
		data: { 
			kode_pembelian:kode_pembelian,
			jumlah:jumlah,
			harga_satuan:harga_satuan,
			diskon_item:diskon,
			jenis_diskon:jenis_diskon,
			subtotal:subtotal,
			id:id_item
		},
		success: function(data)
		{
			formDefault();
			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/kartu_member/get_kartu_member/"+kode_pembelian);
			$('#jumlah').val('');
			$("#id_item").val('');
			$("#harga").val('');
			$("#sub_total").val('');
			$("#diskon_item").val('');
			$("#add").show();
			$("#update").hide();
			get_grandtotal();
		}
	});
}

function delData() {
	var id = $('#id-delete').val();
	var kode_pembelian = $('#kode_pembelian').val();
	var url = 'http://192.168.100.17/elladerma_gudang/kartu_member/hapus_bahan_temp/delete';
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
			$("#tabel_temp_data_transaksi").load("http://192.168.100.17/elladerma_gudang/kartu_member/get_kartu_member/"+kode_pembelian);
			$('#kategori_bahan').val('bahan baku');
			get_grandtotal();

		}
	});
	return false;
}

function get_grandtotal() {
	var kode_pembelian = $('#kode_pembelian').val();
	var kode_supplier = $('#kode_supplier').val();
	var diskon = $('#diskon').val();
	var jenis_diskon = $('#jenis_diskon').val();
	var jenis_pembayaran = $('#jenis_pembayaran').val();

	var url = 'http://192.168.100.17/elladerma_gudang/kartu_member/get_grandtotal';

	$.ajax({
		type: "POST",
		url: url,
		data: $('#data_form').serialize(),
		dataType: 'json',
		success: function(msg) {

			$('#grand_total').val(msg.grand_total);

			$('.nilai_diskon').text(msg.nilai_diskon);
			$('.nilai_grand_total').text(msg.nilai_grand_total);
			$('.nilai_pembelian').text(msg.nilai_pembelian);
			$('#total_pembelian').val(msg.total_pembelian);

			if(jenis_pembayaran=='cash'){
        //$('#uang_muka').val(msg.grand_total);

        $('#kembalian').val('');
      }else{
       $('#uang_muka').val('');
       $('#kembalian').val(msg.grand_total);
       $('#nilai_dibayar').text(msg.nilai_grand_total);
     }
   },  
   error : function() {  
     alert("Failed to action!");  
     return false;
   } 
 });
	return false;
}

function get_kembali() {
	var uang_muka = $('#uang_muka').val();
	var grand_total = $('#grand_total').val();
	var jenis_pembayaran = $('#jenis_pembayaran').val();
	var url = 'http://192.168.100.17/elladerma_gudang/kartu_member/get_kembali';

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
