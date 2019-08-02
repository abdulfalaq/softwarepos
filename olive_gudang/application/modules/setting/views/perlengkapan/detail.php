<?php 
$kode_perlengkapan=$this->uri->segment(4);
$this->db2->where('kode_perlengkapan',$kode_perlengkapan);
$get_gudang = $this->db2->get('master_perlengkapan')->row();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/perlengkapan/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Perlengkapan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perlengkapan </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Perlengkapan </span>
					<a href="<?php echo base_url('setting/perlengkapan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perlengkapan</a>
					<a href="<?php echo base_url('setting/perlengkapan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Perlengkapan</a>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Perlengkapan</label>
										<input  type="text" class="form-control" name="kode_perlengkapan" id="kode_perlengkapan"  disabled readonly="" value="<?php echo $get_gudang->kode_perlengkapan ?>">
									</div>
									<div class="form-group  col-xs-5">
										<label class="gedhi"><b>Satuan Stok</label>
											<select disabled readonly="" class="form-control" name="kode_satuan_stok" id="kode_satuan_stok">
												<option>-- Pilih Satuan Stok --</option>
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
											<label class="gedhi"><b>Nama Perlengkapan</label>
												<input type="text" class="form-control" id="nama_perlengkapan" name="nama_perlengkapan" disabled readonly="" value="<?php echo $get_gudang->nama_perlengkapan ?>">
											</div>

											<div class="form-group  col-xs-5">
												<label class="gedhi"><b>Kode Rak</label>
													<select disabled readonly="" class="form-control" name="kode_rak" id="kode_rak">
														<option value="">-- Pilih Satuan Stok --</option>
														<?php  
														$get_chill = $this->db2->get('master_rak')->result();
														foreach ($get_chill as $value) {?>
															<option 
															<?php 
															if($get_gudang->kode_rak==$value->kode_rak){
																echo "selected";
															}?> 
															value="<?php echo $value->kode_rak ?>"><?php echo $value->nama_rak ?>
															
														</option>
														<?php }

														?>
													</select> 
												</div>
												<div class="form-group  col-xs-5">
													<label class="gedhi"><b>Minimal Stok</label>
														<input type="number" class="form-control" name="stok_minimal" id="stok_minimal" disabled readonly="" value="<?php echo $get_gudang->stok_minimal ?>">
													</div>
													<div class="form-group col-xs-5">
														<label>Status</label>
														<select class="form-control" disabled="" name="status" id="status" disabled="">
															<option selected="true" value="">Pilih Status</option>
															<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
															<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
														</select> 
													</div>
												</div>
												<div class="form-group  col-xs-5">
													<label class="gedhi">HPP</label>
													<div class="input-group">
														<span class="input-group-addon r_nm"><?php echo format_rupiah($get_gudang->hpp) ?></span>
														<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" readonly value="<?php echo $get_gudang->hpp; ?>" disabled="" name="hpp" id="hpp" />
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div> <!-- //row -->
				</div>
			</div>
		</div> <!-- //row -->
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
				url : "<?php echo base_url() . 'setting/perlengkapan/simpan_member' ?>",  
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
						window.location="<?php echo base_url('setting/perlengkapan/daftar');?>"; 
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
			var nominal = $('#hpp').val();
			if(parseInt(nominal) < 0){
				alert("HPP Salah");
				$('#hpp').val('');
				$(".r_nm").html("Rp. 0");
			}else{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url() . 'setting/perlengkapan/get_nomin' ?>",
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


