
<!-- back button -->
<a href="<?php echo base_url('setting/user/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting/user/daftar'); ?>">Setting</a></li>
		<li><a href="#">User</a></li>
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
	$this->db->from('clouoid1_olive_master.master_user user');
	$this->db->join('clouoid1_olive_master.master_jabatan jabatan','jabatan.kode_jabatan = user.jabatan','left');
	$this->db->where('user.kode_karyawan',$id);
	$get_user = $this->db->get()->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail User </span>
					<a href="<?php echo base_url('setting/user/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/user/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Username</label>
									<input readonly required name="uname" value="<?php echo $get_user->uname?>" readonly="true" type="text" class="form-control" id="uname"/>
								</div>
								<div class="form-group  col-xs-5">
									<label>Password</label>
									<input type="password" class="form-control" value="<?php echo paramDecrypt($get_user->upass); ?>" name="upass" id="upass" readonly />
								</div>
								<div class="form-group  col-xs-5">
									<label>Jabatan</label>
									<select class="form-control select2" name="jabatan" id="jabatan" readonly disabled="">
										<option selected="true" value="">--Pilih Jabatan--</option>
										<?php
										$get_paket = $this->olive_master->get('master_jabatan')->result();
										foreach ($get_paket as $value) {?>
											<option 
											<?php 
											if($get_user->jabatan==$value->kode_jabatan){
												echo "selected";
											}?> 
											value="<?php echo $value->kode_jabatan ?>"><?php echo $value->nama_jabatan ?>
										</option>
										<?php }
										?>
									</select>
								</div>
								<div class="form-group  col-xs-5">
									<label>Status</label>
									<select class="form-control select2" name="status" id="status" readonly disabled="">
										<option selected="true" value="">--Pilih Status--</option>
										<option <?php echo "1" == @$get_user->status ? 'selected' : '' ?> value="1" >Aktif</option>
										<option <?php echo "0" == @$get_user->status ? 'selected' : '' ?> value="0" >Tidak Aktif</option>
									</select>
								</div>
							</div>
							<div class="box-footer">
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>