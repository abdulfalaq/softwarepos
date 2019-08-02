

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('Setting'); ?>">Setting</a></li>
		<li><a href="#">Redem Poin</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Redem Poin</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Redem Poin</span>
					<a href="<?php echo base_url('setting/redem_poin/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Redem Poin</a>
					<a href="<?php echo base_url('setting/redem_poin/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Redem Poin</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5" >
									<label class="gedhi"><b>Jenis Produk</b></label>
									<select  class="form-control stok select2" id="jenis_produk" name="jenis_produk" >
										<option value="">--Pilih Jenis Produk--</option>
										<option  value="Perawatan" >Perawatan</option>
										<option  value="Produk" >Produk</option>
									</select> 
								</div>
								<div class="form-group  col-xs-5" id="drop_produk">
									<label class="gedhi"><b>Produk</b></label>
									<select   class="form-control stok select2" id="kode_produk" name="kode_produk">
										<option selected="true" value="">--Pilih Produk--</option>
										<option  value="PR0001">Panadol</option>
										<option  value="PR0002">Pembersih Wajah</option>
										<option  value="PR0003">Demacolin</option>
										<option  value="PR0004">acne lotion</option>
										<option  value="PR0005">Masker Naturgo</option>
										<option  value="PR0006">tes</option>
										<option  value="PR0007">air mawar</option>
									</select> 
								</div> 
								<div class="form-group  col-xs-5" id="drop_perawatan">
									<label class="gedhi"><b>Perawatan</b></label>
									<select   class="form-control stok select2" id="kode_perawatan"  name="kode_perawatan">
										<option selected="true" value="">--Pilih Perawatan--</option>
										<option  value="TRT_101017102550_1">Body Massage</option>
										<option  value="TRT_101017153319_1">potong kuku</option>
										<option  value="TRT_101017154024_1">Acne Treatment</option>
										<option  value="TRT_231017121148_1">segar</option>
									</select> 
								</div> 
								<div class="form-group  col-xs-5">
									<label class="gedhi"><b>Setara Poin</b></label>
									<input  value="" type="text" class="form-control" id="setara_poin" name="setara_poin" />
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

<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#data_form').submit(function(){
		$.ajax({
			type: 'post',
			url: '<?php echo base_url('setting/redem_poin/simpan'); ?>',
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
					window.location="<?php echo base_url('setting/redem_poin/daftar');?>";
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
</script>
