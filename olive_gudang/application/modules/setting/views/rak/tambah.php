
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Rak</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Rak </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Rak </span>
					<a href="<?php echo base_url('setting/rak/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/rak/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Rak</label>
										<input type="hidden" name="id" value="" />
										<input  type="text" class="form-control" value="" onchange="cek_kode()" required name="kode_rak" id="kode_rak" />
									</div>

									<div class="form-group col-xs-5">
										<label class="gedhi"><b>Nama Rak</label>
											<input type="text" value="" class="form-control" required name="nama_rak"  />
										</div>
										<div class="form-group  col-xs-5">
											<label class="gedhi">Status</label>
											<select class="form-control select2" name="status" required id="status">
												<option selected="" value="">--Pilih Status--</option>
												<option  value="1" >Aktif</option>
												<option  value="0" >Tidak Aktif</option>
											</select> 
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div> 
			</div>
		</div>
		<script type="text/javascript">

			
			$(function () {  
				$("#data_form").submit( function() {
					$.ajax( {  
						type :"post",  
						url : "<?php echo base_url() . 'setting/rak/simpan' ?>",  
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
								window.location="<?php echo base_url('setting/rak/daftar');?>"; 
							}else{
								alert('Gagal Menyimpan data');
							//setInterval(function(){ location.reload() }, 2000);
						}
					},  
					error : function() {
						alert("Data gagal dimasukkan.");  
					}  
				});
					return false;   
				});
			});





			function cek_kode(){
				kode_rak = $('#kode_rak').val();
				$.ajax( {  
					type :"post",  
					url : "<?php echo base_url() . 'setting/rak/cek_kode_promo' ?>",  
					data :{ kode_rak:kode_rak},
					dataType: 'Json',
					success : function(data) { 
						if (data.peringatan == 'kosong') {

						}else{
							alert('Kode Sudah Ada, Silahkan Masukkan Kode Yang Lain');
							$('#kode_rak').val('');
						}
					},  
					error : function() {
						alert("Data gagal dimasukkan.");  
					}  
				});  

			} 
		</script>