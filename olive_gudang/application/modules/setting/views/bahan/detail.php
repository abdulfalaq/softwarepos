
<!-- back button -->
<a href="<?php echo base_url('setting/bahan/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Bahan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Bahan </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<?php 
	$id=$this->uri->segment(4);
	$this->db_olive->where('id',$id);
	$get_kategori = $this->db_olive->get('master_bahan_baku')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Bahan </span>
					<a href="<?php echo base_url('setting/bahan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/bahan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Bahan</label>
									<input  type="hidden" class="form-control" value="<?php echo $get_kategori->id?>" name="id" id="id" readonly="" />
									<input  type="text" class="form-control" value="<?php echo $get_kategori->kode_bahan_baku?>" name="kode_bahan_baku" id="kode_bahan_baku" readonly="" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Bahan</label>
									<input type="text" class="form-control" name="nama_bahan_baku" id="nama_bahan_baku" value="<?php echo $get_kategori->nama_bahan_baku?>" readonly/>
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Rak</label>
									<select name="kode_rak" id="kode_rak" class="form-control" disabled value="<?php echo $get_kategori->kode_rak?>">
										<option value="">--Pilih Rak--</option>
										<?php 
										$get_satuan = $this->db_olive->get('master_rak')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$get_kategori->kode_rak==@$value->kode_rak){ echo "selected";}?> value="<?= $value->kode_rak ?>"><?= $value->nama_rak ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Satuan Stok</label>
									<select name="kode_satuan_stok" id="kode_satuan_stok" disabled class="form-control stok select2" value="<?php echo $get_kategori->kode_satuan_stok?>">
										<option value="">--Pilih Satuan Stok--</option>
										<?php 
										$get_satuan = $this->db_olive->get('master_satuan')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$get_kategori->kode_satuan_stok==@$value->kode){ echo "selected";}?> value="<?= $value->kode ?>"><?= $value->nama ?></option>
										<?php }
										?>
									</select> 
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Minimal Stok</label>
									<input type="number" class="form-control" name="stok_minimal" id="stok_minimal" onkeyup="get_stok_minimal()" value="<?php echo $get_kategori->stok_minimal?>" readonly="" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">HPP</label>
									<div class="input-group">
										<span class="input-group-addon rp_hpp"><?php echo format_rupiah($get_kategori->hpp) ?></span>
										<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="hpp" id="hpp" value="<?php echo $get_kategori->hpp?>" readonly="" />
									</div>
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Status</label>
									<select class="form-control stok select2" name="status" id="status" value="<?php echo $get_kategori->status?>"  disabled>
										<option value="">--Pilih Status--</option>
										<option   <?php if($get_kategori->status=='1'){echo "selected";}?>  value="1" >Aktif</option>
										<option   <?php if($get_kategori->status=='0'){echo "selected";}?>  value="0" >Nonaktif</option>
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