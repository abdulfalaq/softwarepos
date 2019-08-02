
<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('master_merchant')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/mercant/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Merchant</a></li>
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
					<span class="pull-left" style="font-size: 24px">Tambah Merchant </span>
					<a href="<?php echo base_url('setting/mercant/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Merchant</a>
					<a href="<?php echo base_url('setting/mercant/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Merchant</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body">
							<!-- <div class="sukses alert alert-success"></div> -->
							<div class="form-group">
								<label>Kode Merchant</label>
								<input type="text" onchange="cek_kode()" name="kode_merchant" id="kode_merchant" class="form-control" required="">
							</div>
							<div class="form-group">
								<label>Nama Merchant</label>
								<input type="text" name="nama_merchant" id="nama_merchant" class="form-control" required="">
							</div>
							<div class="form-group">
								<label>Tanggal Awal</label>
								<input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required="">
							</div>
							<div class="form-group">
								<label>Tanggal Akhir</label>
								<input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"  required="">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="status" id="status"  required="">
									<option value="">-- Pilih Status --</option>
									<option  value="1" >Aktif</option>
									<option  value="0" >Tidak Aktif</option>
								</select> 
							</div>
						</div>
						<div class="panel-footer text-right">
							<button type="submit" id="insert" name="submit" class="btn btn-lg btn-primary">Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- //row -->
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$("#formGudang").submit( function() {  
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/mercant/simpan_member' ?>",  
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
					window.location="<?php echo base_url('setting/mercant/daftar');?>"; 
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
		kode_merchant = $('#kode_merchant').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/mercant/cek_kode_promo' ?>",  
			data :{ kode_merchant:kode_merchant},
			dataType: 'Json',
			success : function(data) { 
				if (data.peringatan == 'kosong') {

				}else{
					alert('Kode Sudah Ada, Silahkan Masukkan Kode Yang Lain');
					$('#kode_merchant').val('');
				}
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});  

	} 

</script>
