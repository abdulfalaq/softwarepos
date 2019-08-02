
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
	<?php 
	$kode_peralatan=$this->uri->segment(4);
	$this->db2->where('kode_peralatan',$kode_peralatan);
	$get_gudang = $this->db2->get('master_peralatan')->row();
	?>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Master Peralatan</span>
					<a href="<?php echo base_url('master/master_peralatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Master Semen Beku</a>
					<a href="<?php echo base_url('master/master_peralatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Master Semen Beku</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="formGudang">
						<div class="form-body">
							<div class="form-group">
								<label>Kode Peralatan</label>
								<input type="text" class="form-control" name="kode_peralatan" id="kode_peralatan" readonly value="<?php echo $get_gudang->kode_peralatan; ?>" required="">
							</div>
							<div class="form-group">
								<label>Nama Peralatan</label>
								<input type="text" name="nama_peralatan" class='form-control' id="nama_peralatan"  value="<?php echo $get_gudang->nama_peralatan; ?>" required="">
							</div>
							<div class="form-group">
								<label class="control-label">Gudang</label>
								<select required="" class="form-control" id="kode_gudang" name="kode_gudang" >
									<option value="">Pilih</option>
									<?php
									$get_paket = $this->db2->get('master_gudang')->result();
									foreach ($get_paket as $value) {?>
										<option 
										<?php 
										if($get_gudang->kode_gudang==$value->kode_gudang){ echo "selected"; }?> 
										value="<?php echo $value->kode_gudang ?>"><?php echo $value->nama_gudang ?>
									</option>
									<?php }
									?>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Satuan Stok</label>
								<select required="" class="bs-select form-control select" name="kode_satuan_stok" id="kode_satuan_stok">
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
							<div class="form-group">
								<label class="control-label">Stok Minimal</label>
								<input type="text" class="form-control" name="stok_minimal" id="stok_minimal"  value="<?php echo $get_gudang->stok_minimal; ?>" required="">
							</div>
							<div class="form-group">
								<label class="control-label">HPP</label>
								<input type="text" class="form-control" name="hpp" id="hpp"  value="<?php echo $get_gudang->hpp; ?>" required="">
							</div>
							<div class="form-group">
								<label class="control-label">Harga Jual</label>
								<input type="text" class="form-control" name="harga_jual" id="harga_jual"  value="<?php echo $get_gudang->harga_jual; ?>" required="">
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
					</form>
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
			url : "<?php echo base_url() . 'master/master_peralatan/update_member' ?>",  
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
