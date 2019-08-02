
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Master Breed</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Breed</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$id=$this->uri->segment(4);
	$this->db_master->where('id',$id);
	$get_kategori = $this->db_master->get('master_breed')->row();
	?>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Master Breed</span>
					<a href="<?php echo base_url('master/master_breed/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/master_breed/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-body">
							<div class="form-group col-md-6">
								<label class="control-label">Breed</label>
								<input type="hidden" id="id" name="id" value="<?php echo $get_kategori->id?>">
								<input type="text" class="form-control" required name="nama_breed" id="nama_breed" value="<?php echo $get_kategori->nama_breed?>" >
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Status</label>
								<select class="bs-select form-control" required name="status" id="status">
									<option  value="" >--Pilih--</option>
									<option <?php if($get_kategori->status=='1'){echo "selected";}?> value="1" >Aktif</option>
									<option <?php if($get_kategori->status=='0'){echo "selected";}?> value="0" >Tidak Aktif</option>
								</select>
							</div>
						</div>

						<div class="box-footer clearfix">
							<button type="submit" style="margin-top: 20px; margin-right: 20px; margin-bottom: 15px;" class="pull-right btn btn-primary">Save <i class="fa fa-arrow-circle-right"></i></button>
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
				url : "<?php echo base_url() . 'master/master_breed/update' ?>",  
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
						window.location="<?php echo base_url('master/master_breed/daftar');?>"; 
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