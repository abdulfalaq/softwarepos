<?php 
$this->db2->order_by('id','DESC');
$get_last_id = $this->db2->get('master_gudang')->row();
?>

<!-- back button -->
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Pembelian</a></li>
		<li><a href="#">Pengadaan asset</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Gudang</span>
					<a href="<?php echo base_url('master/gudang/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Gudang</a>
					<a href="<?php echo base_url('master/gudang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Gudang</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body">
							<!-- <div class="sukses alert alert-success"></div> -->
							<div class="form-group">
								<label>Kode Gudang</label>
								<input type="text" name="kode_gudang" id="kode_gudang" class="form-control" required="">
							</div>
							<div class="form-group">
								<label>Nama Gudang</label>
								<input type="text" class="form-control" name="nama_gudang" id="nama_gudang" required="" >
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<input type="text" class="form-control" name="keterangan" id="keterangan" required="" >
							</div>
							<div class="form-group">
								<label>Status</label>
								<select name="status" id="status" class="form-control select" required="">
									<option value="">-- Pilih Status --</option>
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
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
		kode_gudang = $('#kode_gudang').val();                
		nama_gudang = $('#nama_gudang').val();                 
		keterangan = $('#keterangan').val();  
		status 		= $('#status').val(); 
		if (kode_gudang != '' && kode_gudang != '' ) {
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'master/gudang/simpan_member' ?>",  
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
						window.location="<?php echo base_url('master/gudang/daftar');?>"; 
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
		}else {
			alert('Harap Melengkapi Form.');
		}              
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
