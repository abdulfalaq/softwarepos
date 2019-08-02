
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
					<span class="pull-left" style="font-size: 24px">Tambah Diagnosa</span>
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
											<input  type="text" name="kode_diagnosa_penyakit"  class='form-control' id="kode_diagnosa_penyakit" required placeholder="Kode Diagnosa Penyakit" />
										</td>
									</tr>

									<tr>
										<td>
											<label>Nama Diagnosa Penyakit</label>
										</td>
										<td>
											<input type="text" name="nama_diagnosa_penyakit" class='form-control' id="nama_diagnosa_penyakit" required placeholder="Nama Diagnosa Penyakit"  />
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
												$this->db_master->where('status','1');
												$get_paket = $this->db_master->get('master_kategori_penyakit')->result();
												foreach ($get_paket as $value) {?>
												<option value="<?php echo $value->kode_kategori_penyakit ?>"><?php echo $value->nama_kategori_penyakit ?></option>
												<?php }

												?>

											</select>
										</td>
									</tr>

									<tr>
										<td>
											<label>Status</label>
										</td>
										<td>
											<select class="form-control" id="status" name="status" required>
												<option value="">--Pilih Status--</option>
												<option  value="1">Aktif</option>
												<option  value="0">Tidak Aktif</option>
											</select>
										</td>
									</tr>

								</table>
							</div>
						</div>
						<div class="box-footer clearfix">
							<button type="submit" style="margin-top: 20px;" class="pull-right btn btn-primary" id="data_form">Save <i class="fa fa-arrow-circle-right"></i></button>
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
			url : "<?php echo base_url() . 'master/diagnosa/simpan_diagnosa' ?>",  
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