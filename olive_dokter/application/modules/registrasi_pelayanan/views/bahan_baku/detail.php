<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Bahan Baku</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Bahan Baku </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_bahan_baku=$this->uri->segment(4);
	$this->db2->where('kode_bahan_baku',$kode_bahan_baku);
	$get_bahan = $this->db2->get('master_bahan_baku')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Bahan Baku </span>
					<a href="<?php echo base_url('master/bahan_baku/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Bahan Baku</a>
					<a href="<?php echo base_url('master/bahan_baku/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Bahan Baku</a>
				</div>
				<div class="panel-body">
					<form id="form_bahan_baku">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-5">
									<label for="">Kode Bahan Baku</label>
									<input type="text" class="form-control" disabled=""  name="kode_bahan_baku" id="kode_bahan_baku" value="<?php echo $get_bahan->kode_bahan_baku;?>"  placeholder="Kode Bahan Baku" readonly aria-describedby="basic-addon1">
								</div>
								<div class="col-md-5">
									<label for="">Satuan Pembelian</label>
									<select name="kode_satuan_pembelian" id="kode_satuan_pembelian" disabled="" class="form-control">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_satuan')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if($get_bahan->kode_satuan_pembelian==$value->kode) echo "selected";?> value="<?= $value->kode ?>"><?= $value->nama ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-5">
									<label for="">Nama Bahan Baku</label>
									<input type="text" class="form-control" disabled=""  placeholder="Nama Bahan Baku" id="nama_bahan_baku" name="nama_bahan_baku" aria-describedby="basic-addon1" value="<?php echo $get_bahan->nama_bahan_baku;?>">
								</div>
								<div class="col-md-5">
									<label for="">Satuan Stok</label>
									<select name="kode_satuan_stok" id="kode_satuan_stok" disabled="" class="form-control">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_satuan')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if($get_bahan->kode_satuan_stok==$value->kode) echo "selected";?> value="<?= $value->kode ?>"><?= $value->nama ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-5">
									<label for="">Gudang</label>
									<select name="kode_gudang" id="kode_gudang" disabled="" class="form-control">
										<option value="">-- Pilih Gudang</option>
										<?php 
										$get_satuan = $this->db2->get('master_gudang')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if($get_bahan->kode_gudang==$value->kode_gudang) echo "selected";?> value="<?= $value->kode_gudang ?>"><?= $value->nama_gudang ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="col-md-5">
									<label for="">Konversi</label>
									<input type="text" class="form-control" disabled=""  placeholder="Konversi" id="konversi" name="konversi" aria-describedby="basic-addon1" value="<?php echo $get_bahan->konversi;?>">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-5">
									<label for="">HPP</label>
									<input type="text" class="form-control" disabled=""  placeholder="HPP" id="hpp" name="hpp" aria-describedby="basic-addon1" value="<?php echo $get_bahan->hpp;?>">
								</div>
								<div class="col-md-5">
									<label for="">Stok Minimal</label>
									<input type="text" class="form-control" disabled=""  placeholder="Jumlah Stok Minimal" id="stok_minimal" name="stok_minimal" aria-describedby="basic-addon1" value="<?php echo $get_bahan->stok_minimal;?>">
								</div>
							</div><br><hr><br>
							
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
