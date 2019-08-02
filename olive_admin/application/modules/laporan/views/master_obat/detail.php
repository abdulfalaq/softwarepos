
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Master Obat</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$code= $this->uri->segment('4');
	$this->db2->from('master_obat');
	$this->db2->join('master_metoda_obat','master_metoda_obat.kode_metoda_obat =  master_obat.kode_metoda_obat','left');
	$this->db2->join('master_satuan','master_satuan.kode =  master_obat.kode_satuan_stok','left');
	$this->db2->join('master_gudang','master_gudang.kode_gudang =  master_obat.kode_gudang','left');
	$this->db2->where('master_obat.kode_obat', $code );
	$get_obat = $this->db2->get()->row();
	?>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail</span>
					<a href="<?php echo base_url('master/master_obat/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/master_obat/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-body row">
							<div class="col-md-6">
								<label class="control-label">Kode Obat</label>
								<input type="text" class="form-control" name="kode_obat" id="kode_obat" readonly="" placeholder="Kode Obat" value="<?php echo $get_obat->kode_obat?>" />
							</div>
							<div class="col-md-6">
								<label class="control-label">Nama Obat</label>
								<input type="text" value="<?php echo $get_obat->nama_obat?>" class="form-control" readonly="" name="nama_obat" id="nama_obat" value="" placeholder="Nama obat" required="" />
							</div>
							<div class="col-md-6">
								<label class="control-label">Jenis</label>
								<input type="text" class="bs-select form-control" value="<?php echo $get_obat->jenis_obat?>" readonly="" name="jenis_obat" id="jenis_obat" required="">
							</div>
							<div class="col-md-6">
								<label>Gudang </label>
								<input type="text"class="form-control select2" value="<?php echo $get_obat->nama_gudang?>" readonly="" id="kode_gudang" required="" name="kode_gudang">
							</div>
							<div class="col-md-6">
								<label class="control-label">Metoda Obat</label>
								<input type="text" class="bs-select form-control select2" readonly="" value="<?php echo $get_obat->metoda_obat?>" name="kode_metoda_obat" required="" id="kode_metoda_obat">
							</div>
							<div class="col-md-6">
								<label class="control-label">Stok Minimal</label>
								<input type="text" value="<?php echo $get_obat->stok_minimal?>" readonly="" class="form-control" name="stok_minimal" required="" id="stok_minimal" value="" placeholder="Masukkan Stok barang">
							</div>
							<div class="col-md-6">
								<label class="control-label">Satuan Obat</label>
								<input type="text"  name="kode_satuan_stok" readonly="" value="<?php echo $get_obat->nama?>" id="kode_satuan_stok" class="form-control" required=""> 

							</div>
							<div class="col-md-6">
								<label class="control-label">HPP</label>
								<input type="text" class="form-control" readonly="" value="<?php echo $get_obat->hpp?>" name="hpp" id="hpp" required="" value="" placeholder="obat">
							</div>
							<div class="col-md-6">
								<label class="control-label">Harga Jual</label>
								<input type="text" class="form-control" readonly="" value="<?php echo $get_obat->harga_jual?>" name="harga_jual" required="" id="harga_jual" value="" placeholder="Masukkan Harga Jual">
							</div>

							<div class="col-md-6">
								<label class="control-label">Status Bantuan</label>
								<input type="text" class="bs-select form-control select2" readonly="" value="<?php echo $get_obat->status_bantuan?>" name="status_bantuan" required="" id="status_bantuan">
							</div>
							<div class="col-md-6">
								<label class="control-label">Status</label>
								<input type="text" class="bs-select form-control select2" readonly="" 
								value="<?php if($get_obat->status=='1'){
									echo ('Aktif');
									}else {
										echo ('Tidak Aktif');
									} ?>" 
									required="" name="status" id="status">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
