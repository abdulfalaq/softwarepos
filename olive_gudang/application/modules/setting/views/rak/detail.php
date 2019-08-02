
<!-- back button -->
<a href="<?php echo base_url('setting/rak/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Rak</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Rak </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<?php 
	$id=$this->uri->segment(4);
	$this->db_olive_master->where('id',$id);
	$get_kategori = $this->db_olive_master->get('master_rak')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Rak </span>
					<a href="<?php echo base_url('setting/rak/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/rak/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Rak</label>
									<input type="hidden" name="id" value="<?php echo $get_kategori->id?>" />
									<input  type="text" class="form-control" readonly="" value="<?php echo $get_kategori->kode_rak?>" readonly name="kode_rak" id="kode_rak" />
								</div>

								<div class="form-group col-xs-5">
									<label class="gedhi"><b>Nama Rak</label>
									<input type="text" class="form-control" readonly value="<?php echo $get_kategori->nama_rak?>" name="nama_rak"  />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Status</label>
									<select class="form-control select2" name="status" disabled="" id="status">
										<option selected="" value="">--Pilih Status--</option>
										<option  <?php if($get_kategori->status=='1'){echo "selected";}?> value="1" >Aktif</option>
										<option  <?php if($get_kategori->status=='0'){echo "selected";}?> value="0" >Tidak Aktif</option>
									</select> 
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>				
	</div>
</div>
