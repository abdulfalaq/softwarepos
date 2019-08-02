<?php 

$this->db2->where('status','1');
$get_gudang = $this->db2->get('master_peralatan')->result();

?>

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Master Peralatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Peralatan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Master Peralatan</span>
					<a href="<?php echo base_url('master/master_peralatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Master Semen Beku</a>
					<a href="<?php echo base_url('master/master_peralatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Master Semen Beku</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="form-body">
							<div class="form-group">
								<label>Kode Peralatan</label>
								<input type="text" class="form-control" name="kode_peralatan" id="kode_peralatan" >
							</div>
							<div class="form-group">
								<label>Nama Peralatan</label>
								<input type="text" name="nama_peralatan" class='form-control' id="nama_peralatan" >
							</div>
							<div class="form-group">
								<label class="control-label">Gudang</label>
								<select class="form-control" id="kode_gudang" name="kode_gudang" required="">
									<option value="">Pilih</option>
									<?php
									$get_paket = $this->db2->get('master_gudang')->result();
									foreach ($get_paket as $value) {?>
										<option value="<?php echo $value->kode_gudang ?>"><?php echo $value->nama_gudang ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">Satuan Stok</label>
									<select class="bs-select form-control select" name="kode_satuan_stok" id="kode_satuan_stok">
										<option value="">Pilih</option>
										<?php
										$get_paket = $this->db2->get('master_satuan')->result();
										foreach ($get_paket as $value) {?>
											<option value="<?php echo $value->kode ?>"><?php echo $value->nama ?></option>
											<?php }
											?>
										</select>
									</div>
									<div class="form-group">
										<label class="control-label">Stok Minimal</label>
										<input type="text" class="form-control" name="stok_minimal" id="stok_minimal" >
									</div>
									<div class="form-group">
										<label class="control-label">HPP</label>
										<input type="text" class="form-control" name="hpp" id="hpp" >
									</div>
									<div class="form-group">
										<label class="control-label">Harga Jual</label>
										<input type="text" class="form-control" name="harga_jual" id="harga_jual" >
									</div>
									<div class="form-group">
										<label class="control-label">Status</label>
										<select class="form-control" id="status" name="status" >
											<option  value="">Pilih</option>
											<option  value="1">Aktif</option>
											<option  value="0">Tidak Aktif</option>
										</select>
									</div>
								</div>
								<div class="panel-footer text-right">
									<button type="submit" id="insert" name="submit" class="btn btn-lg btn-primary">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
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
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'master/master_peralatan/simpan_member' ?>",  
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
					window.location="<?php echo base_url('master/master_peralatan/daftar');?>"; 
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
