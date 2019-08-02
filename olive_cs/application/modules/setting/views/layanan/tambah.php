
<!-- back button -->
<a href="<?php echo base_url('setting/layanan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Layanan Periksa</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Layanan Periksa</h1>

	<?php $this->load->view('menu_setting'); ?>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Layanan Periksa </span>
					<a href="<?php echo base_url('setting/layanan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/layanan'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Layanan Periksa</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Periksa</label>
										<input type="text" value="" required="" class="form-control" placeholder="Kode " name="kode_periksa" id="kode_periksa" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Periksa</label>
										<input type="text" class="form-control" required="" placeholder="Nama Periksa" value="" name="nama_periksa" id="nama_periksa"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi"><b>Harga Periksa</b></label>
										<div class="input-group">
											<span class="input-group-addon rp_harga">Rp 0,00</span>
											<input type="number" required="" class="form-control input-group" onkeyup="get_nominal_harga_paket()" name="harga_periksa" id="harga_periksa" value="" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Status</label>
										<select class="form-control select2" required="" name="status" id="status" "">
											<option selected="true" value="">Pilih Status</option>
											<option value="1" >Aktif</option>
											<option value="0" >Nonaktif</option>
										</select> 
									</div>
								</div>
								<div class="col-md-12" align="right">
									<div class="form-group">
										<br> <br>  
										<button type="submit" class="btn btn-no-radius btn-info pull-right">Simpan</button>
									</div>
								</div>
							</div>
						</div> 
						<div class="box-footer clearfix">

						</div>
					</form>
				</div>
			</div>
		</div>
	</div> 
</div>
<script type="text/javascript">
$('#data_form').submit(function(){
	$.ajax({
		type: 'post',
		url: '<?php echo base_url('setting/layanan/simpan'); ?>',
		cache: false,
		data: $(this).serialize(),
		dataType: 'Json',
		beforeSend:function(){
			$(".tunggu").show();
		},
		success : function(data) { 
			if (data.response == 'sukses') {
				$(".tunggu").hide();   
				$(".alert_berhasil").show();   
				setTimeout(function(){window.location="<?php echo base_url('setting/layanan/daftar');?>";}, 2000);
			}else if(data.response == 'ada'){
				$(".tunggu").hide();   
				alert('Kode Sudah Ada, Silahkan Ganti Kode.');
			}else{
				alert('Gagal Menyimpan data');
				setTimeout(function(){ location.reload() }, 2000);
			}
		},  
		error : function() {
			alert("Data gagal dimasukkan.");  
		}  
	});
	return false; 
}); 


function get_nominal_harga_paket(){
	var hpp = $('#harga_periksa').val();
	if(parseInt(hpp) < 0){
		alert("Harga Periksa Salah");
		$('#harga_periksa').val('');
		$(".rp_harga").html("Rp. 0");
	}else{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url() . 'setting/perawatan/get_hpp' ?>",
			data: {
				hpp: hpp
			},

			success: function(msg)
			{
				$(".rp_harga").html(msg);
			}
		});
	}
}





function cek_kode(){
	kode_periksa = $('#kode_periksa').val();
	$.ajax( {  
		type :"post",  
		url : "<?php echo base_url() . 'setting/layanan/cek_kode_promo' ?>",  
		data :{ kode_periksa:kode_periksa},
		dataType: 'Json',
		success : function(data) { 
			if (data.peringatan == 'kosong') {

			}else{
				alert('Kode Sudah Ada, Silahkan Masukkan Kode Yang Lain');
				$('#kode_periksa').val('');
			}
		},  
		error : function() {
			alert("Data gagal dimasukkan.");  
		}  
	});  

} 
</script>
