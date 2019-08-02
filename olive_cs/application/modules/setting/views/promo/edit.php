
<?php 
$this->db2->order_by('id','DESC');
$get_last_id = $this->db2->get('master_promo')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/promo/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Promo</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_promo=$this->uri->segment(4);
	$this->db2->where('kode_promo',$kode_promo);
	$get_gudang = $this->db2->get('master_promo')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Promo </span>
					<a href="<?php echo base_url('setting/promo/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/promo/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body">
							<!-- <div class="sukses alert alert-success"></div> -->
							<div class="form-group">
								<label>Kode Promo</label>
								<input type="text" name="kode_promo" id="kode_promo" class="form-control" readonly value="<?php echo $get_gudang->kode_promo; ?>" required="">
							</div>
							<div class="form-group">
								<label>Nama Promo</label>
								<input type="text" name="nama_promo" id="nama_promo" class="form-control"  value="<?php echo $get_gudang->nama_promo; ?>" required="">
							</div>
							<div class="form-group">
								<label>Tanggal Awal</label>
								<input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control tgl"  value="<?php echo $get_gudang->tanggal_awal; ?>" required="">
							</div>
							<div class="form-group">
								<label>Tanggal Akhir</label>
								<input type="text" class="form-control tgl" name="tanggal_akhir" id="tanggal_akhir"   value="<?php echo $get_gudang->tanggal_akhir; ?>" required="">
							</div>
							<div class="form-group">
								<label>Status</label>
								<select name="status" id="status" class="form-control" required="">
									<option value="">-- Pilih Status --</option>
									<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
									<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
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
<script src="<?php echo base_url().'component/lib/jquery.min.js'?>"></script>
<script src="<?php echo base_url().'component/lib/zebra_datepicker.js'?>"></script>
<link rel="stylesheet" href="<?php echo base_url().'component/lib/css/default.css'?>"/>
<script type="text/javascript">
	$('.tgl').Zebra_DatePicker({});
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$("#formGudang").submit( function() {  
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/promo/update_member' ?>",  
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
					window.location="<?php echo base_url('setting/promo/daftar');?>"; 
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
