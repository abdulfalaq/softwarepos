
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Kategori Penyakit</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Kategori Penyakit</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$id=$this->uri->segment(4);
	$this->db_master->where('id',$id);
	$get_kategori = $this->db_master->get('master_kategori_penyakit')->row();
	?>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Data Kategori Penyakit</span>
					<a href="<?php echo base_url('master/kategori_penyakit/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/kategori_penyakit/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-group">
							<div class="col-md-12">
								<div class="sukses">
								</div>
								<table class="table">
									<tr>
										<td><label>Kode Kategori Penyakit</label></td>
										<input type="hidden" name="id" id="id" class="form-control" value="<?php echo $get_kategori->id?>" required="">
										<td><input readonly type="text" name="kode_kategori_penyakit" value="<?php echo $get_kategori->kode_kategori_penyakit?>" class='form-control' id="kode_kategori" required placeholder="Kode Kategori" /></td>
									</tr>
									<tr>
										<td><label>Nama Kategori Penyakit</label></td>
										<td>
											<input type="text" name="nama_kategori_penyakit" class='form-control' value="<?php echo $get_kategori->nama_kategori_penyakit?>" id="nama_kategori" required placeholder="Nama Kategori"  />
										</td>
									</tr>
									<tr>
										<td><label>Status</label></td>
										<td>
											<select class="form-control" id="status" name="status">
												<option <?php if($get_kategori->status=='1'){echo "selected";}?>  value="1">Aktif</option>
												<option <?php if($get_kategori->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
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
	$(function () {  
		$("#data_form").submit( function() {
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'master/kategori_penyakit/update' ?>",  
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
						window.location="<?php echo base_url('master/kategori_penyakit/daftar');?>"; 
					}else{
						alert('Gagal Menyimpan data');
							//setInterval(function(){ location.reload() }, 2000);
						}
					},  
					error : function() {
						alert("Data gagal dimasukkan.");  
					}  
				});
			return false;   
		});
	});
</script>