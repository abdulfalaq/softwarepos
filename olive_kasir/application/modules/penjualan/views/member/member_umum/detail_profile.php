<?php 
$kode_member = $this->uri->segment(4);
$this->db_master->where('kode_member', $kode_member);
$get_member = $this->db_master->get('master_member')->row();

?>
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Profil Member</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>


<div class="container">
	<h1>Member </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Member </span>
					<a href="<?php echo base_url('penjualan/member/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Member</a>
					<a href="<?php echo base_url('penjualan/member/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Member</a>
				</div>
				<div class="panel-body">
					<?php
					$param = $this->uri->segment(4);
					$this->db->where('kode_member', $param);
					$get_member = $this->db_master->get('master_member')->row();
					?>
					<form id="form_member">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<h5>Kode Member</h5>
									<input type="text" readonly id="kode_member" name="kode_member" value="<?php echo $get_member->kode_member; ?>" class="form-control" placeholder="kode member" readonly>
									<input type="hidden" id="kode_unit_jabung" name="kode_unit_jabung" value="<?php echo $get_member->kode_unit_jabung;?>" class="form-control" placeholder="kode Unit jabung">
								</div>
								<div class="col-md-6">
									<h5>Kategori Member</h5>
									<select name="kategori_member" disabled class="form-control" id="kategori_member">
										<option value="">-- Pilih Kategori Member</option>
										<option <?php echo "Member Umum" == @$get_member->kategori_member ? 'selected' : '' ?> value="Member Umum">Member Umum</option>
										<option <?php echo "Member Konsinyasi" == @$get_member->kategori_member ? 'selected' : '' ?> value="Member Konsinyasi">Member Konsinyasi</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Keterangan</h5>
									<input type="text" id="keterangan" readonly name="keterangan" value="<?php echo $get_member->keterangan; ?>" class="form-control" placeholder="keterangan">
								</div>
								<div class="col-md-6">
									<h5>Status FEE</h5>
									<select class="form-control" disabled name="status_fee" id="status_fee" onchange="jenis_status_fee()">
										<option <?php echo "non_fee" == @$get_member->status_fee ? 'selected' : '' ?> value="non_fee">Non FEE</option>
										<option <?php echo "fee" == @$get_member->status_fee ? 'selected' : '' ?> value="fee">FEE</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 nominal_fee" style="display: none;">
									<h5>Nominal FEE</h5>
									<input type="text" id="nominal_fee" readonly name="nominal_fee" value="<?php echo $get_member->nominal_fee; ?>" class="form-control" placeholder="Nominal Fee">
								</div>
								<div class="col-md-6">
									<h5>Harga</h5>
									<select name="kategori_harga" disabled class="form-control" id="kategori_harga">
										<option value="">-- Pilih Harga</option>
										<option  <?php echo "Harga 1" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 1">Harga 1</option>
										<option <?php echo "Harga 2" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 2">Harga 2</option>
										<option <?php echo "Harga 3" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 3">Harga 3</option>
										<option <?php echo "Harga 4" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 4">Harga 4</option>
										<option <?php echo "Harga 5" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 5">Harga 5</option>
										<option <?php echo "Harga 6" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 6">Harga 6</option>
										<option <?php echo "Harga 7" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 7">Harga 7</option>
										<option <?php echo "Harga 8" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 8">Harga 8</option>
										<option <?php echo "Harga 9" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 9">Harga 9</option>
										<option <?php echo "Harga 10" == @$get_member->kategori_harga ? 'selected' : '' ?> value="Harga 10">Harga 10</option>
									</select>
								</div>
								<div class="col-md-6">
									<h5>Ongkos Kirim</h5>
									<input type="text" id="ongkir" readonly name="ongkir" value="<?php echo $get_member->ongkir; ?>" class="form-control" placeholder="Ongkos Kirim">
								</div>
								<div class="col-md-6">
									<h5>Status</h5>
									<select name="status_member" disabled id="status_member" class="form-control">
										<option <?php echo "1" == @$get_member->status_member ? 'selected' : '' ?> value="1">Aktif</option>
										<option <?php echo "0" == @$get_member->status_member ? 'selected' : '' ?>value="0">Tidak Aktif</option>
									</select>
								</div>
							</div>
							<div class="row">

							</div>
							<div class="row"><br>
								<h3>A. Data Perusahaan</h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Nama Perusahaan</h5>
									<input type="text" id="nama_perusahaan" readonly value="<?= @$get_member->nama_perusahaan ?>" name="nama_perusahaan" class="form-control" placeholder="Nama Perusahaan">
								</div>
								<div class="col-md-6">
									<h5>Alamat Perusahaan</h5>
									<input type="text" id="alamat_perusahaan" readonly value="<?= @$get_member->alamat_perusahaan ?>" name="alamat_perusahaan" class="form-control" placeholder="Alamat Perusahaan">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Telepon Perusahaan</h5>
									<input type="text" id="telp_perusahaan" readonly value="<?= @$get_member->telp_perusahaan ?>" name="telp_perusahaan" class="form-control" placeholder="Telepon Perusahaan">
								</div>
								<div class="col-md-6">
									<h5>No. Rekening Perusahaan</h5>
									<input type="text" id="no_rek_perusahaan" readonly name="no_rek_perusahaan" value="<?= @$get_member->no_rek_perusahaan ?>" class="form-control" placeholder="No. Rekening Perusahaan">
								</div>
							</div>
							<div class="row"><br>
								<h3>B. Data PIC</h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Nama PIC</h5>
									<input type="text" id="nama_pic" readonly name="nama_pic" value="<?= @$get_member->no_rek_perusahaan ?>" class="form-control" placeholder="Nama PIC">
								</div>
								<div class="col-md-6">
									<h5>Alamat PIC</h5>
									<input type="text" id="alamat_pic" readonly name="alamat_pic" value="<?= @$get_member->alamat_pic ?>" class="form-control" placeholder="Alamat PIC">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Telepon PIC</h5>
									<input type="text" id="telp_pic" readonly name="telp_pic" value="<?= @$get_member->telp_pic ?>" class="form-control" placeholder="Telepon PIC">
								</div>
								<div class="col-md-6">
									<h5>No. Rekening PIC</h5>
									<input type="text" id="no_rek_pic" readonly name="no_rek_pic" value="<?= @$get_member->no_rek_pic ?>" class="form-control" placeholder="No. Rekening PIC">
								</div>
							</div>
							<div class="row"><br>
								<hr>
							</div>
							<div class="row"><br>
								<div class="col-md-12">
									<a href="<?= base_url('penjualan/member_umum/profil_member') ?>" class="btn btn-warning btn-lg btn-no-radius pull-right"><i class="fa fa-angle-left"></i> Kembali</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
