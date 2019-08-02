
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master_pelayanan'); ?>">Pelayanan</a></li>
		<li><a href="<?php echo base_url('master_pelayanan/tambah'); ?>">Tambah Pelayanan</a></li>
		<li><a href="#"></a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pelayanan</h1>

	<?php $this->load->view('menu_master'); ?><br>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Pelayanan</span>
					<a href="<?php echo base_url('master/master_pelayanan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/master_pelayanan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-group">
							<div class="col-md-12">
								<div class="sukses">
								</div>
								<div class="col-md-6">
									<label class="control-label">Kode Pelayanan</label>
									<input type="hidden" id="id" name="id" required="" />
									<input type="text" class="form-control" name="kode_pelayanan" id="kode_pelayanan" required="" />
								</div>
								<div class="col-md-6">
									<label class="control-label">Nama Pelayanan</label>
									<input type="text" class="form-control" name="nama_pelayanan" id="nama_pelayanan" required="" />
								</div>
								<div class="col-md-6">
									<label class="control-label">Nominal</label>
									<input type="number" class="form-control" name="nominal" id="nominal" required="" />
								</div>
								<div class="form-group col-md-6">
									<label class="control-label">Status</label>
									<select class="form-control" id="status" name="status" required="">
										<option  value="">-- Pilih Status --</option>
										<option  value="1">Aktif</option>
										<option  value="0">Tidak Aktif</option>
									</select>
								</div>
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
				url : "<?php echo base_url() . 'master/master_pelayanan/simpan' ?>",  
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
						window.location="<?php echo base_url('master/master_pelayanan/daftar');?>"; 
					}else{
						alert('Gagal Menyimpan data');
						setInterval(function(){ location.reload() }, );
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