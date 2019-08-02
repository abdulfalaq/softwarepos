
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Gudang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Gudang </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_gudang=$this->uri->segment(4);
	$this->db2->where('kode_gudang',$kode_gudang);
	$get_gudang = $this->db2->get('master_gudang')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Gudang </span>
					<a href="<?php echo base_url('master/gudang/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Gudang</a>
					<a href="<?php echo base_url('master/gudang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Gudang</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="row">
							<div class="col-sm-6">
								<label>Kode Gudang</label>
								<input type="text" readonly value="<?php echo $get_gudang->kode_gudang?>" name="kode_gudang" id="kode_gudang" class="form-control" required="">
							</div>
							<div class="col-sm-6">
								<label>Nama Gudang</label>
								<input type="text" name="nama_gudang" id="nama_gudang" value="<?php echo $get_gudang->nama_gudang?>" class="form-control" required="">
							</div>
						</div><br>
						<div class="row">
							<div class="col-sm-6">
								<label>Keterangan</label>
								<input type="text" name="keterangan" id="keterangan" value="<?php echo $get_gudang->keterangan?>" class="form-control" required="">
							</div>
							<div class="col-sm-6">
								<label>Status</label>
								<select name="status" id="status" class="form-control" required="">
									<option value="">-- Pilih Status --</option>
									<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
									<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
								</select>
							</div>
							<div class="col-sm-12">
								<hr>
								<br>
								<button type="submit" class="btn btn-no-radius btn-info pull-right"><i class="fa fa-send"></i> Simpan</button>
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
		nama_gudang = $('#nama_gudang').val();                
		keterangan 	= $('#keterangan').val();                
		status 		= $('#status').val();  
		if (nama_gudang != '' && keterangan != '' && status != '') {
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'master/gudang/update_gudang' ?>",  
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
						setInterval(function(){ window.location="<?php echo base_url('master/gudang/daftar');?>"; }, 1500);
					}else{
						alert('Gagal Menyimpan data');
						setInterval(function(){ location.reload() }, 2000);
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});
			
		}else {
			alert('Harap Melengkapi Form.');
		}    
		return false;             
	});   

</script>
