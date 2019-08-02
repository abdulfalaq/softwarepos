
<!-- back button -->
<a href="<?php echo base_url('setting/asset/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Asset</a></li>
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
	$this->db->where('id',$id);
	$get_kategori = $this->db->get('olive_master.master_aset')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Asset </span>
					<a href="<?php echo base_url('setting/asset/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/asset/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Aset</label>
									<input type="hidden" name="id" value="<?php echo $get_kategori->id?>" />
									<input readonly='true' type="text" class="form-control" value="<?php echo $get_kategori->kode_aset?>" name="kode_aset" id="kode_aset" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Aset</label>
									<input value="<?php echo $get_kategori->nama_aset?>" readonly disabled type="text" class="form-control" name="nama_aset" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Kategori</label>
									<input value="<?php echo $get_kategori->kategori?>" readonly disabled type="text" class="form-control" name="kategori" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Keterangan</label>
									<input value="<?php echo $get_kategori->keterangan?>" readonly disabled type="text" class="form-control" name="keterangan" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Jumlah barang</label>
									<input value="<?php echo $get_kategori->jml_barang?>" readonly disabled type="text" class="form-control" id="jml_barang" name="jml_barang" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">QTY Fisik</label>
									<input value="<?php echo $get_kategori->qty_fisik?>"  type="text" class="form-control" readonly disabled id="qty_fisik" name="qty_fisik" />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Jumlah Rusak</label>
									<input value="<?php echo $get_kategori->jumlah_rusak?>"  type="text" class="form-control" readonly disabled id="jumlah_rusak" name="jumlah_rusak" />
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>				
	</div>
</div>

