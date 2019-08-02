<?php 
$kode_produk=$this->uri->segment(4);
$this->db2->where('kode_produk',$kode_produk);
$get_gudang = $this->db2->get('master_produk')->row();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/produk'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Produk</h1>

	<?php $this->load->view('menu_setting'); ?>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Produk </span>
					<a href="<?php echo base_url('setting/produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/produk'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Produk</b></label>
									<input  type="text" class="form-control" required readonly="" value="<?php echo $get_gudang->kode_produk ?>" name="kode_produk" id="kode_produk" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Satuan Stok</b></label>
									<select required=""  class="form-control stok select2" name="kode_satuan_stok" id="kode_satuan_stok">
										<option value="">-- Pilih Satuan Stok --</option>
										<?php  
										$get_chill = $this->db2->get('master_satuan')->result();
										foreach ($get_chill as $value) {?>
											<option 
											<?php 
											if($get_gudang->kode_satuan_stok==$value->kode){
												echo "selected";
											}?> 
											value="<?php echo $value->kode ?>"><?php echo $value->nama ?>
										</option>
										<?php }

										?>
									</select> 
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Nama Produk</b></label>
									<input required=""   value="<?php echo $get_gudang->nama_produk ?>" type="text" class="form-control" name="nama_produk" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Minimal Stok</b></b></label>
									<input onkeyup="get_stok_minimal()" type="number" class="form-control r_mn" name="stok_minimal" id="stok_minimal" required="" value="<?php echo $get_gudang->stok_minimal ?>" />
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Harga Jual</label>
									<div class="input-group">
										<span class="input-group-addon r_nm"><?php echo format_rupiah($get_gudang->harga_jual) ?></span>
										<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" required=""   value="<?php echo $get_gudang->harga_jual ?>" name="harga_jual" id="harga_jual" />
									</div>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Kategori Produk</b></label>
									<select required=""  class="form-control stok select2" name="kode_kategori_produk" id="kode_kategori_produk">
										<option value="">-- Pilih Kategori Produk --</option>
										<?php  
										$get_chill = $this->db2->get('master_kategori_produk')->result();
										foreach ($get_chill as $value) {?>
											<option 

											<?php 
											if($get_gudang->kode_kategori_produk==$value->kode_kategori_produk){
												echo "selected";
											}?> 
											value="<?php echo $value->kode_kategori_produk ?>"><?php echo $value->nama_kategori_produk ?>
										</option>
										<?php }

										?>
									</select> 
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Insensif Masker</label>
									<div class="input-group">
										<span class="input-group-addon r_mm"><?php echo format_rupiah($get_gudang->insentif_masker) ?></span>
										<input type="number" class="form-control input-group" onkeyup="get_nominal_im()"   value="<?php echo $get_gudang->insentif_masker ?>" name="insentif_masker" id="insentif_masker" required=""/>
									</div>
								</div>
								<div class="form-group  col-xs-5">
									<label><b>Redem Poin</b></label>
									<input  type="number"  value="<?php echo $get_gudang->redeem_poin ?>" required="" class="form-control" name="redeem_poin" id="redeem_poin" />
								</div>
							</div>
							<div class="form-group  col-xs-5">
								<label class="gedhi">HPP</label>
								<div class="input-group">
									<span class="input-group-addon r_pp"><?php echo format_rupiah($get_gudang->hpp) ?></span>
									<input type="number" class="form-control input-group" onkeyup="get_nominal_hp()" required=""  value="<?php echo $get_gudang->hpp ?>" name="hpp" id="hpp" />
								</div>
							</div>
							<div class="form-group col-xs-5">
								<label>Status</label>
								<select class="form-control" name="status" id="status" required="" style="width:520px">
									<option selected="true" value="">Pilih Status</option>
									<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
									<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
								</select> 
							</div>
							<br><br><br><br>
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

<script type="text/javascript">

	$("#formGudang").submit( function() {        
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/produk/update_member' ?>",  
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
					window.location="<?php echo base_url('setting/produk/daftar');?>";
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

	function get_nominal_hpp(){
		var nominal = $('#harga_jual').val();
		if(parseInt(nominal) < 0){
			alert("Harga Jual Salah");
			$('#harga_jual').val('');
			$(".r_nm").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/produk/get_nomin' ?>",
				data: {
					nominal: nominal
				},

				success: function(msg)
				{
					$(".r_nm").html(msg);
				}
			});
		}
	}


	function get_nominal_hp(){
		var nominal = $('#hpp').val();
		if(parseInt(nominal) < 0){
			alert("HPP Salah");
			$('#hpp').val('');
			$(".r_pp").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/produk/get_nomin' ?>",
				data: {
					nominal: nominal
				},

				success: function(msg)
				{
					$(".r_pp").html(msg);
				}
			});
		}
	}


	function get_nominal_im(){
		var nominal = $('#insentif_masker').val();
		if(parseInt(nominal) < 0){
			alert("Insentif Masker Salah");
			$('#insentif_masker').val('');
			$(".r_mm").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/produk/get_nomin' ?>",
				data: {
					nominal: nominal
				},

				success: function(msg)
				{
					$(".r_mm").html(msg);
				}
			});
		}
	}



	function get_stok_minimal(){
		var nominal = $('#stok_minimal').val();
		if(parseInt(nominal) < 0){
			alert("Minimal Stok Salah");
			$('#stok_minimal').val('');
			$(".r_mn").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/produk/get_nomin' ?>",
				data: {
					nominal: nominal
				},

				success: function(msg)
				{
					$(".r_mn").html(msg);
				}
			});
		}
	}

	function cek_kode(){
		kode_produk = $('#kode_produk').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/produk/cek_kode_promo' ?>",  
			data :{ kode_produk:kode_produk},
			dataType: 'Json',
			success : function(data) { 
				if (data.peringatan == 'kosong') {

				}else{
					alert('Kode Sudah Ada, Silahkan Masukkan Kode Yang Lain');
					$('#kode_produk').val('');
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});  

	} 


</script>
</script>
</div>
</div>
</div>
<script src="http://192.168.100.17/amway/component/bootstrap/js/bootstrap.min.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/fastclick/fastclick.min.js"></script>
<script src="http://192.168.100.17/amway/component/dist/js/app.min.js"></script>
<script src="http://192.168.100.17/amway/component/dist/js/demo.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/jquery.matchHeight-min.js"></script>
<!-- DataTables -->
<script src="http://192.168.100.17/amway/component/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script src="http://192.168.100.17/amway/component/plugins/select2/select2.full.min.js"></script>


<script>
	$(function () {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
	});

	$('.select2').select2();
</script>


