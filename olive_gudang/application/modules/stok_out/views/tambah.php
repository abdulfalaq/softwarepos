<!-- back button -->
<a href="<?php echo base_url('stok_out'); ?>"><button class="button-back"></button></a>
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
					<span class="pull-left" style="font-size: 24px">Tambah Stok Out</span>
					<a href="<?php echo base_url('stok_out/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Stok Out</a>
					<a href="<?php echo base_url('stok_out'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Stok Out</a>
				</div>
				<div class="panel-body">
					<form id="form">
						<div class="row">
							<div class="col-md-1">
								<label>Tanggal</label>
							</div>
							<div class="col-md-4">
								<input type="date" name="tanggal" id="tanggal" class="form-control">
								<input type="hidden" name="kode_stok_out"  id="kode_stok_out" value="<?php echo ('SO_').date('ymdis') ?>" class="form-control" >
								<?php   
								$user     = $this->session->userdata('astrosession');
								$pengguna = $user->uname; 
								?>
								<input type="hidden" name="kode_petugas" id="kode_petugas" value="<?php echo $pengguna ?>">
							</div>
							<div class="col-md-2">
								<a class="btn btn-warning btn_lock" onclick="lock_tanggal()">Lock</a>
								<a class="btn btn-danger btn_cancel" onclick="unlock_tanggal()">Cancel</a>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2">
								<label >Jenis Item</label>
								<select class="form-control  opsi_stok_out" name="pilih_item" id="pilih_item">
									<option value="Bahan"> Bahan</option>
									<option value="Perlengkapan"> Perlengkapan</option>
								</select>
							</div>
							<div class="col-md-2">
								<div id="bahan1">
									<label id="kode_bahan1">Bahan</label>
									<select class="form-control  opsi_stok_out" name="kode_bahan" id="kode_bahan">
										<option value="">-- Pilih Bahan --</option>
										<?php  
										$get_paket = $this->db->get('olive_master.master_bahan_baku')->result();
										foreach ($get_paket as $value) {?>
										<option value="<?php echo $value->kode_bahan_baku ?>"><?php echo $value->nama_bahan_baku ?></option>
										<?php }

										?>
									</select>
								</div>
								<div id="perlengkapan1">
									<label id="kode_perlengkapan1">Perlengkapan</label>
									<select class="form-control  opsi_stok_out" name="kode_perlengkapan" id="kode_perlengkapan" onchange="get_perlengkapan()">
										<option value="">-- Pilih Perlengkapan --</option>
										<?php  
										$get_perlengkapan = $this->db->get('olive_master.master_perlengkapan')->result();
										foreach ($get_perlengkapan as $value) {?>
										<option value="<?php echo $value->kode_perlengkapan ?>"><?php echo $value->nama_perlengkapan ?></option>
										<?php }

										?>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<label>QTY</label>
								<input type="number" name="jumlah" id="jumlah" class="form-control opsi_stok_out" >
							</div>
							<div class="col-md-2">
								<label>Satuan</label>
								<input type="text" readonly="" name="satuan_text" id="satuan_text" class="form-control opsi_stok_out">
								<input type="hidden" name="satuan" id="satuan" class="form-control">
							</div>
							<div class="col-md-2">
								<label>Keterangan</label>
								<input type="text"  name="keterangan" id="keterangan" class="form-control opsi_stok_out">
								<input type="hidden" name="id" id="id" />
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-primary btn_add opsi_stok_out" onclick="tambah_temporari()" style="margin-top: 25px;"><i class="fa fa-plus"></i> ADD</button>
								<a class="btn btn-primary btn_update opsi_stok_out" onclick="update_temporari('#kode_stok_out')" style="margin-top: 25px;"><i class="fa fa-petypencil"></i> Update</a>
							</div>
						</div>
						<br>
						<hr>
						<br>
						<div class="col-md-12 row">
							<div id="oraight">
								<table id="" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Bahan Baku</th>
											<th>QTY</th>
											<th>Keterangan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="data_temp">    

									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-12">
							<button type="button" class="btn btn-lg btn-info pull-right opsi_stok_out btn_simpan_besar" onclick="simpan_besar()"><i class="fa fa-send"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
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
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="simpan_so()" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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
				<input type="hidden" id="id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button onclick="hapus_data()" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	unlock_tanggal();
	$('.btn_cancel').hide();
	$(".btn_update").hide();
	$("#bahan1").show();
	$("#perlengkapan1").hide();
	$(".btn_simpan_besar").attr("disabled",true);
	

	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id').val(key);
	}
	function hapus_data() {
		var id=$('#id').val();
		$.ajax({
			url: '<?php echo base_url('stok_out/hapus_temporari_stok'); ?>',
			type: 'post',
			data:{id:id},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				load_table()
			}
		});
	}

	function tampil_update(key){
		var id = key; 
		var kode_bahan = $('#kode_bahan').val();
		var kode_perlengkapan = $('#kode_perlengkapan').val();
		var url = "<?php echo base_url().'stok_out/get_temp_stok'; ?>";
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: {id:id},
			success: function(pembelian){
				$("#pilih_item").val(pembelian.jenis_item);
				$("#jumlah").val(pembelian.jumlah);
				$("#id").val(pembelian.id);
				$("#satuan_text").val(pembelian.alias);
				$("#satuan").val(pembelian.kode_satuan);
				$("#keterangan").val(pembelian.keterangan);
				

				if(pembelian.jenis_item == 'Bahan')
				{
					$("#bahan1").show();
					$("#perlengkapan1").hide();
					$("#kode_bahan").val(pembelian.kode_bahan_baku);
				}else{
					$("#perlengkapan1").show();
					$("#bahan1").hide();
					$("#kode_perlengkapan").val(pembelian.kode_bahan_baku);
				}
				$(".btn_update").show();
				$(".btn_add").hide();
			}
		});
	}
	function detail(){
		$("#kode_bahan_baku").attr('readonly',true);
		$("#kode_perlengkapan").attr('readonly',true);
		$("#satuan").attr('readonly',true);
		$("#satuan_text").attr('readonly',true);
		$("#jumlah").attr('readonly',true);
		$("#keterangan").attr('readonly',true);
	}

	function tambah_temporari(){
		kode_bahan 			= $("#kode_bahan").val();
		kode_perlengkapan 	= $("#kode_perlengkapan").val();
		satuan				= $("#satuan").val();
		satuan_text			= $("#satuan_text").val();
		keterangan 			= $("#keterangan").val();
		jumlah				= $("#jumlah").val();
		pilih_item			= $("#pilih_item").val();
		

		

		if (pilih_item =='Perlengkapan' && kode_perlengkapan !='' && satuan!='' && satuan_text!='' && keterangan!='' && jumlah!='') {


			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'stok_out/simpan_temporari' ?>",  
				cache :false,  
				data :$('#form').serialize(),
				dataType: 'Json',
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(ambil) { 
					if (ambil.response == 'sukses') {
						$(".tunggu").hide();    
						$(".btn_simpan_besar").attr("disabled",false); 
						load_table()
						$("#kode_bahan").val('');
						$("#kode_perlengkapan").val('');
						$("#satuan").val('');
						$("#satuan_text").val('');
						$("#jumlah").val('');
						$("#keterangan").val('');
					}else if(ambil.response == 'tidak'){
						$(".tunggu").hide();   
						alert('Data Sudah Ada ! ');
						$("#kode_bahan").val('');
						$("#kode_perlengkapan").val('');
						$("#satuan").val('');
						$("#satuan_text").val('');
						$("#keterangan").val('');
						$("#jumlah").val('');
					}else{
						alert('Gagal Menyimpan data');
						setInterval(function(){ location.reload() }, 2000);
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});
			return false;
		}else if(pilih_item =='Bahan' && kode_bahan !='' && satuan!='' && satuan_text!='' && keterangan!='' && jumlah!=''){


			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'stok_out/simpan_temporari' ?>",  
				cache :false,  
				data :$('#form').serialize(),
				dataType: 'Json',
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(ambil) { 
					if (ambil.response == 'sukses') {
						$(".tunggu").hide();    
						$(".btn_simpan_besar").attr("disabled",false); 
						load_table()
						$("#kode_bahan").val('');
						$("#kode_perlengkapan").val('');
						$("#satuan").val('');
						$("#satuan_text").val('');
						$("#jumlah").val('');
						$("#keterangan").val('');
					}else if(ambil.response == 'tidak'){
						$(".tunggu").hide();   
						alert('Data Sudah Ada ! ');
						$("#kode_bahan").val('');
						$("#kode_perlengkapan").val('');
						$("#satuan").val('');
						$("#satuan_text").val('');
						$("#keterangan").val('');
						$("#jumlah").val('');
					}else{
						alert('Gagal Menyimpan data');
						setInterval(function(){ location.reload() }, 2000);
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});
		}else{
			alert('Lengkapi Form !');
			$("#kode_bahan").val('');
			$("#kode_perlengkapan").val('');
			$("#satuan").val('');
			$("#satuan_text").val('');
			$("#keterangan").val('');
			$("#jumlah").val('');
		}

	}

	function simpan_besar(){

		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok_out/simpan_besar' ?>",  
			cache :false,  
			data :$('#form').serialize(),
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(ambil) { 
				if (ambil.response == 'sukses') {
					$(".tunggu").hide();    
					$(".alert_berhasil").show();   
					window.location="<?php echo base_url('stok_out');?>";
				}else{
					alert('Gagal Menyimpan data');
					setInterval(function(){ location.reload() }, 2000);
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false; 
	}

	function update_temporari(){
		kode_stok_out = $('#kode_stok_out').val();

		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok_out/update_temporari' ?>",  
			cache :false,  
			data :$('#form').serialize(),
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();    
					load_table()
					$("#kode_bahan_baku").val('');
					$("#kode_perlengkapan").val('');
					$("#satuan").val('');
					$("#satuan_text").val('');
					$("#jumlah").val('');
					$("#keterangan").val('');
					$(".btn_update").hide();
					$(".btn_add").show();
				}else{
					alert('Gagal Menyimpan data');
					setInterval(function(){ location.reload() }, 2000);
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false; 
	}

	function load_table(obj){
		kode_stok_out 	= $('#kode_stok_out').val();
		$('#oraight').load('<?php echo base_url() ?>stok_out/tampil/'+kode_stok_out);
	}


	$("#kode_perlengkapan").on('change',function(){
		var kode_perlengkapan = $('#kode_perlengkapan').val();
		var keterangan = "<?php echo base_url().'stok_out/cari_perlengkapan'?>";
		$.ajax({
			type: "POST",
			url: keterangan,
			dataType: 'json',
			data: {kode_perlengkapan:kode_perlengkapan},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg)
			{	
				$(".tunggu").hide();
				$('#satuan').val(msg.kode);
				$('#satuan_text').val(msg.alias);

			}
		});
		return false;
	});



	$("#kode_bahan").on('change',function(){
		var kode_bahan = $('#kode_bahan').val();
		var keterangan = "<?php echo base_url().'stok_out/cari_bahan'?>";
		$.ajax({
			type: "POST",
			url: keterangan,
			dataType: 'json',
			data: {kode_bahan:kode_bahan},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg)
			{
				$(".tunggu").hide();
				$('#satuan').val(msg.kode);
				$('#satuan_text').val(msg.alias);

			}
		});
		return false;
	});

	$('#pilih_item').on('change',function(){
		var item = $("#pilih_item").val();
		if(item == 'Bahan')
		{
			$("#bahan1").show();
			$("#perlengkapan1").hide();
			$("#kode_perlengkapan").val('');
			$("#satuan").val('');
			$("#satuan_text").val('');
			$("#jumlah").val('');
			$("#keterangan").val('');
		}else{ 
			$("#perlengkapan1").show();
			$("#bahan1").hide();
			$("#kode_bahan_baku").val('');
			$("#satuan").val('');
			$("#satuan_text").val('');
			$("#jumlah").val('');
			$("#keterangan").val('');
		}
	});

	function lock_tanggal(){
		var tanggal =$('#tanggal').val();
		if(tanggal==''){
			alert('Silahkan Pilih Tanggal ..!');
		}else{
			$('#tanggal').attr('readonly',true);
			$('.opsi_stok_out').attr('disabled',false);
			$('.btn_lock').hide();
			$('.btn_cancel').show();
		}

	}
	function unlock_tanggal(){
		$('#tanggal').attr('readonly',false);
		$('.opsi_stok_out').attr('disabled',true);
		$('.btn_lock').show();
		$('.btn_cancel').hide();

		var kode_stok_out=$('#kode_transaksi').val();
		$.ajax({
		//url: '<?php echo base_url('stok/stok_out/hapus_opsi_stokout_all'); ?>',
		type: 'post',
		data:{kode_stok_out:kode_stok_out},
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			load_data_temp();
		}
	});
	}

	function get_satuan(){
		var kode_bahan_baku=$("#kode_bahan_baku").val();
		$.ajax({
		//url: '<?php echo base_url('stok/stok_out/get_satuan'); ?>',
		type: 'post',
		data:{kode_bahan_baku:kode_bahan_baku},
		dataType:'json',
		beforeSend:function(){
			//$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$("#kode_satuan_stok").val(hasil.kode_satuan_stok);
			$("#satuan_stok").val(hasil.nama);
			$("#kuota_pengadaan").val(hasil.total_kebutuhan);
			$("#harga_satuan").val(hasil.hpp);
		}
	});

	}

	function cek_qty(){
		var qty =$('#qty').val();
		if(qty=='-' ||  parseInt(qty) < 0){
			alert('QTY Salah ..!');
			$('#qty').val('');
		}

	}
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	function load_data_temp(){
		var kode_transaksi=$('#kode_transaksi').val();
		$('#data_temp').load("<?php echo base_url().'stok/stok_out/data_opsi/'?>"+kode_transaksi);
	}

	function add_item(){
		var kode_transaksi=$("#kode_transaksi").val();
		var kode_bahan_baku=$("#kode_bahan_baku").val();
		var keterangan=$("#keterangan").val();
		var qty=$("#qty").val();
		var kode_satuan_stok=$("#kode_satuan_stok").val();
		if(kode_bahan_baku=='' || qty=='' ){
			alert('Harap Lengkapi Form..!');
		}else{
			$.ajax({
				url: '<?php echo base_url('stok/stok_out/add_item'); ?>',
				type: 'post',
				data:{kode_transaksi:kode_transaksi,kode_bahan_baku:kode_bahan_baku,qty:qty,kode_satuan_stok:kode_satuan_stok,keterangan:keterangan},
				dataType:'json',
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(msg){
					$(".tunggu").hide();
					if(msg.hasil=='gagal'){
						alert("Bahan Baku Telah Ditambahkan ...!");
					}else{
						$("#kode_bahan_baku").select2('val','');
						$("#qty").val('');
						$("#satuan_stok").val('');
						$("#kode_satuan_stok").val('');
						$("#keterangan").val('');
						load_data_temp();
					}

				}
			});
		}
	}

	

	function confirm_simpan(){
		$('#modal-konfirmasi').modal('show');
	}

	function simpan_so() {
		var kode_stok_out=$('#kode_transaksi').val();
		var tanggal_transaksi=$('#tanggal').val();
		var kode_unit=$('#kode_unit').val();

		$.ajax({
			url: '<?php echo base_url('stok/stok_out/simpan_so'); ?>',
			type: 'post',
			data:{kode_stok_out:kode_stok_out,tanggal_transaksi:tanggal_transaksi,kode_unit:kode_unit},
			beforeSend:function(){
				$('#modal-konfirmasi').modal('hide');
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('stok/stok_out/daftar');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}

</script>