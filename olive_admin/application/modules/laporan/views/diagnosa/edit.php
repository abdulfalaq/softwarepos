<?php 
$kode_diagnosa_penyakit=$this->uri->segment(4);
$this->db_master->where('kode_diagnosa_penyakit',$kode_diagnosa_penyakit);
$get_gudang = $this->db_master->get('master_diagnosa_penyakit')->row();
?>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Diagnosa</a></li>
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
					<span class="pull-left" style="font-size: 24px">Edit Diagnosa</span>
					<a href="<?php echo base_url('master/diagnosa/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Diagnosa</a>
					<a href="<?php echo base_url('master/diagnosa/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Diagnosa</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="form">
						<div class="form-group">
							<div class="col-md-12">
								<div class="sukses">
								</div>
								<table class="table">
									<tr>
										<td>
											<label>Kode Diagnosa Penyakit</label>
										</td>
										<td>
											<input  type="text" readonly="" name="kode_diagnosa_penyakit"  class='form-control' id="kode_diagnosa_penyakit" required placeholder="Kode Diagnosa Penyakit" value="<?php echo $get_gudang->kode_diagnosa_penyakit; ?>" />
										</td>
									</tr>

									<tr>
										<td>
											<label>Nama Diagnosa Penyakit</label>
										</td>
										<td>
											<input type="text" name="nama_diagnosa_penyakit" class='form-control' id="nama_diagnosa_penyakit" required placeholder="Nama Diagnosa Penyakit" value="<?php echo $get_gudang->nama_diagnosa_penyakit; ?>" />
										</td>
									</tr>

									<tr>
										<td>
											<label>Kategori Penyakit</label>
										</td>
										<td>
											<select required class="form-control" id="kode_kategori_penyakit" name="kode_kategori_penyakit">
												<option value="">--Pilih Penyakit--</option>
												<?php
												$get_paket = $this->db_master->get('master_kategori_penyakit')->result();
												foreach ($get_paket as $value) {?>
												<option 
												<?php 
												if($get_gudang->kode_kategori_penyakit==$value->kode_kategori_penyakit){
													echo "selected";
												}?> 
												 value="<?php echo $value->kode_kategori_penyakit ?>"><?php echo $value->nama_kategori_penyakit ?>
											</option>
											<?php }
											?>
										</td>
									</tr>

									<tr>
										<td>
											<label>Status</label>
										</td>
										<td>
											<select class="form-control" id="status" name="status" required>
												<option value="">--Pilih Status--</option>
												<option <?php if ($get_gudang->status == '1') {
													echo 'selected';
												} ?> value="1">Aktif</option>
												<option <?php if ($get_gudang->status == '0') {
													echo 'selected';
												} ?>  value="0">Tidak Aktif</option>
											</select>
										</td>
									</tr>

								</table>
							</div>
						</div>
						<div class="box-footer clearfix">
							<button type="submit" style="margin-top: 20px;" class="pull-right btn btn-success" id="data_form">Update <i class="fa fa-arrow-circle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#form").submit( function() {        
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'master/diagnosa/update_diagnosa' ?>",  
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
					window.location="<?php echo base_url('master/diagnosa/daftar');?>"; 
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
</script>