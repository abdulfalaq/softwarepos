
<!-- back button -->
<a href="<?php echo base_url('setting/jabatan/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Jabatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<?php 
	$id=$this->uri->segment(4);
	$this->olive_master->where('kode_jabatan',$id);
	$get_gudang = $this->olive_master->get('master_jabatan')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Jabatan </span>
					<a href="<?php echo base_url('setting/jabatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/jabatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Jabatan  </label>
									<input readonly='true' type="text" class="form-control"  value="<?php echo $get_gudang->kode_jabatan?>" name="kode_jabatan" id="kode_jabatan" />
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Jabatan  </label>
									<input  type="text"  value="<?php echo $get_gudang->nama_jabatan?>" id="nama_jabatan" class="form-control" name="nama_jabatan" />
								</div>

								<div class="form-group  col-xs-5">

									<label class="gedhi">Status</label>
									<select  class="form-control stok select2" id="status" name="status">
										<option value="">--Pilih Status--</option>
										<option <?php  if($get_gudang->status=="1"){echo "selected";}?> value="1" >Aktif</option>
										<option <?php  if($get_gudang->status=="0"){echo "selected";}?> value="0" >Nonaktif</option>
									</select> 
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#data_form").submit( function() {  
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/jabatan/update' ?>",  
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
					window.location="<?php echo base_url('setting/jabatan/daftar');?>"; 
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
