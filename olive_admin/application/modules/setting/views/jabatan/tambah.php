
<!-- back button -->
<a href="<?php echo base_url('setting/jabatan/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Jabatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Jabatan </span>
					<a href="<?php echo base_url('setting/jabatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/jabatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Jabatan  </label>									
									<input  type="text" class="form-control" onchange="cek_kode()" value="" required="" name="kode_jabatan" id="kode_jabatan" />
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Jabatan  </label>
									<input  value="" type="text" class="form-control" required="" id="nama_jabatan" name="nama_jabatan" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Status</label>
									<select  class="form-control stok select2" required="" id="status" name="status">
										<option value="">--Pilih Status--</option>
										<option  value="1" >Aktif</option>
										<option  value="0" >Nonaktif</option>
									</select> 
								</div>

							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$("#data_form").submit( function() {  
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/jabatan/simpan' ?>",  
			cache :false,  
			data :$(this).serialize(),
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();   
					$(".alert_berhasil").show();   
					window.location="<?php echo base_url('setting/jabatan/daftar');?>"; 
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
	});   



	function cek_kode(){
		kode_jabatan = $('#kode_jabatan').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/jabatan/cek_kode_promo' ?>",  
			data :{ kode_jabatan:kode_jabatan},
			dataType: 'Json',
			success : function(data) { 
				if (data.peringatan == 'kosong') {

				}else{
					alert('Kode Sudah Ada, Silahkan Masukkan Kode Yang Lain');
					$('#kode_jabatan').val('');
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});  

	} 
</script>