
<?php 
$this->db2->order_by('id','DESC');
$get_last_id = $this->db2->get('master_semen_beku')->result();
?>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Master Semen Beku</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_semen_beku=$this->uri->segment(4);
	$this->db2->where('kode_semen_beku',$kode_semen_beku);
	$get_gudang = $this->db2->get('master_semen_beku')->row();
	?>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Master Semen Beku</span>
					<a href="<?php echo base_url('master/semen_beku/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Master Semen Beku</a>
					<a href="<?php echo base_url('master/semen_beku/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Master Semen Beku</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-body">
							<div class="form-group col-md-6">
								<label class="control-label">No. Pejantan</label>
								<input type="text" class="form-control" name="kode_semen_beku" id="kode_semen_beku" readonly value="<?php echo $get_gudang->kode_semen_beku; ?>" disabled="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Nama Pejantan</label>
								<input type="text" class="form-control" name="nama_pejantan" id="nama_pejantan" readonly value="<?php echo $get_gudang->nama_pejantan; ?>" disabled="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">ID Dam</label>
								<input type="text" class="form-control" name="id_dam" id="id_dam" readonly value="<?php echo $get_gudang->id_dam; ?>" disabled="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Nama Dam</label>
								<input type="text" class="form-control" name="nama_dam" id="nama_dam" readonly value="<?php echo $get_gudang->nama_dam; ?>" disabled="">
							</div>

							<div class="form-group col-md-6">
								<label class="control-label">ID Sire</label>
								<input type="text" class="form-control" name="id_sire" id="id_sire" readonly value="<?php echo $get_gudang->id_sire; ?>" disabled="">
							</div>


							<div class="form-group col-md-6">
								<label class="control-label">Nama Sire</label>
								<input type="text" class="form-control" name="nama_sire" id="nama_sire" readonly value="<?php echo $get_gudang->nama_sire; ?>" disabled="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">No Batch</label>
								<input type="text" class="form-control" name="no_batch" id="no_batch" readonly value="<?php echo $get_gudang->no_batch; ?>" disabled="">
							</div>

							<div class="form-group col-md-6">
								<label class="control-label">Harga Beli</label>
								<input type="text" class="form-control" name="harga_beli" id="harga_beli" readonly value="<?php echo $get_gudang->harga_beli; ?>" disabled="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Harga Jual</label>
								<input type="text" class="form-control" name="harga_jual" id="harga_jual" readonly value="<?php echo $get_gudang->harga_jual; ?>" disabled="">
							</div>	
							<div class="form-group col-md-6">
								<label class="control-label">Stock Minimal</label>
								<input type="text" readonly value="<?php echo $get_gudang->stok_minimal; ?>" class="form-control" name="stok_minimal" id="stok_minimal"  disabled="">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Satuan</label>
								<select disabled="" class="form-control"  id="kode_satuan_stok" name="kode_satuan_stok">
								<option value="">Pilih</option>
								<?php
								$get_paket = $this->db2->get('master_satuan')->result();
								foreach ($get_paket as $value) {?>
									<option 
									<?php 
									if($get_gudang->kode_satuan_stok==$value->kode){ echo "selected"; }?> 
									value="<?php echo $value->kode ?>"><?php echo $value->nama ?>
								</option>
								<?php }
								?>
							</select>
						</div>
						<div class="col-sm-6">
							<label>Status</label>
							<select name="status" id="status" class="form-control" disabled="">
								<option value="">-- Pilih Status --</option>
								<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
								<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
							</select>
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
