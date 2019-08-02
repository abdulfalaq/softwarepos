
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Bahan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Bahan </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Bahan </span>
					<a href="<?php echo base_url('setting/bahan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/bahan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Bahan</label>
									<input  type="hidden" onchange="cek_kode()" class="form-control" value="" name="id" id="id" required="" />
									<input  type="text" onchange="cek_kode()" class="form-control" value="" name="kode_bahan_baku" id="kode_bahan_baku" required="" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Bahan</label>
									<input value="" type="text" class="form-control" name="nama_bahan_baku" id="nama_bahan_baku" required="" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Rak</label>
									<select name="kode_rak" id="kode_rak" class="form-control" required="">
										<option value="">-- Pilih Rak --</option>
										<?php  
										$get_rak = $this->db->get('olive_master.master_rak')->result();
										foreach ($get_rak as $value) {?>
											<option value="<?php echo $value->kode_rak ?>"><?php echo $value->nama_rak ?></option>
											<?php }

											?>
										</select> 
									</div>
									<div class="form-group  col-xs-5">
										<label class="gedhi">Satuan Stok</label>
										<select  class="form-control stok select2" name="kode_satuan_stok" id="kode_satuan_stok" required="">
											<option selected="true" value="">--Pilih satuan stok--</option>
											<option  value="S_01">kilogram</option>
											<option  value="S_02">mililiter</option>
											<option  value="S_03">liter</option>
											<option  value="S_04">pieces</option>
											<option  value="S_05">porsi</option>
											<option  value="S_06">botol</option>
											<option  value="S_07">gram</option>
											<option  value="S_08">kilogram</option>
											<option  value="S_09">Box / Kotak</option>
										</select> 
									</div>
									<div class="form-group  col-xs-5">
										<label class="gedhi">Minimal Stok</label>
										<input type="number" class="form-control" name="stok_minimal" id="stok_minimal" onkeyup="get_stok_minimal()" value="" required="" />
									</div>
									<div class="form-group  col-xs-5">
										<label class="gedhi">HPP</label>
										<div class="input-group">
											<span class="input-group-addon rp_hpp">Rp 0,00</span>
											<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="hpp" id="hpp" value="" required="" />
										</div>
									</div>
									<div class="form-group  col-xs-5">
										<label class="gedhi">Status</label>
										<select class="form-control stok select2" name="status" id="status" required="">

											<option value="">--Pilih Status--</option>
											<option  value="1" >Aktif</option>
											<option  value="0" >Nonaktif</option>
										</select> 
									</div>
								</div>
								<div class="box-footer">
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
		$(document).ready(function(){

		});
		$("#data_form").submit( function() {              
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'setting/bahan/simpan' ?>",  
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
						setInterval(function(){ window.location="<?php echo base_url('setting/bahan/daftar');?>"; }, 1500);
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
		function get_nominal_hpp(){
			var hpp = $('#hpp').val();

			if (hpp < 0) {
				alert('Nominal HPP tidak boleh kurang dari 0');
				$('#hpp').val('');

			}else{

				$.ajax({
					type: "POST",
					url: "http://192.168.100.17/elladerma_gudang/master/bahan_baku/get_hpp",
					data: {
						hpp: hpp
					},

					success: function(msg)
					{

						$(".rp_hpp").html(msg);

					}
				});
			}


		}

		function get_stok_minimal(){
			var stok_minimal = $('#stok_minimal').val();

			if (stok_minimal < 0) {
				alert('Stok Minimal tidak boleh kurang dari 0');
				$('#stok_minimal').val('');

			}else{

				$.ajax({
					type: "POST",
					url: "http://192.168.100.17/elladerma_gudang/master/bahan_baku/get_stok_minimal",
					data: {
						stok_minimal: stok_minimal
					},

					success: function(msg)
					{

						$(".rp_stok_minimal").html(msg);

					}
				});
			}


		}

		function cek_kode(){
			kode_bahan_baku = $('#kode_bahan_baku').val();
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'setting/bahan/cek_kode_promo' ?>",  
				data :{ kode_bahan_baku:kode_bahan_baku},
				dataType: 'Json',
				success : function(data) { 
					if (data.peringatan == 'kosong') {

					}else{
						alert('Kode Sudah Ada, Silahkan Masukkan Kode Yang Lain');
						$('#kode_bahan_baku').val('');
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});  

		} 

	</script>