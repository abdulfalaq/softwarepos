<?php 
$kode_karyawan=$this->uri->segment(4);
$this->db2->where('kode_karyawan',$kode_karyawan);
$get_gudang = $this->db2->get('master_karyawan')->row();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/karyawan/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Karyawan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Karyawan </span>
					<a href="<?php echo base_url('setting/karyawan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/karyawan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="formGudang" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label>Kode Karyawan</label>							
									<input  type="text" class="form-control" onchange="cek_kode()" name="kode_karyawan" id="kode_karyawan" disabled="" value="<?php echo $get_gudang->kode_karyawan ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Jabatan</label>
									<select   class="form-control stok select2" name="kode_jabatan" name="kode_jabatan" disabled="">
										<option selected="true" value="">--Pilih Nama Jabatan--</option>
										<?php 
										$ambil_data = $this->db->get('olive_master.master_jabatan');
										$hasil_ambil_data = $ambil_data->result();
										foreach ($hasil_ambil_data as $value) {
											?>
											<option <?php if(@$get_gudang->kode_jabatan==@$value->kode_jabatan){ echo "selected";}?> value="<?php echo $value->kode_jabatan ;?>"><?php echo $value->nama_jabatan ;?></option>
											<?php
										}
										?>
									</select> 
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Karyawan</label>
									<input  type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" disabled="" value="<?php echo $get_gudang->nama_karyawan ?>"/>
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Tanggal Kontrak Awal</label>
									<input  type="text" class="form-control" name="tgl_mulai_kerja" id="tgl_mulai_kerja" disabled="" value="<?php echo tanggalIndo ($get_gudang->tgl_mulai_kerja) ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">No KTP</label>
									<input type="number" class="form-control" name="no_ktp"  id="no_ktp" disabled="" value="<?php echo $get_gudang->no_ktp ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Tanggal Kontrak Akhir</label>
									<input type="text" class="form-control" name="tgl_berhenti_kerja" id="tgl_berhenti_kerja" disabled="" value="<?php echo tanggalIndo ($get_gudang->tgl_berhenti_kerja) ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">No Telp</label>
									<input type="number" class="form-control" name="telp_karyawan" id="telp_karyawan" disabled="" value="<?php echo $get_gudang->telp_karyawan ?>"/>
								</div>
								<div class="row">
									<div class="form-group  col-xs-5">
										<label class="gedhi">Gaji</label>
										<div class="input-group">
											<span class="input-group-addon r_nm""><?php echo format_rupiah($get_gudang->gaji) ?></span>
											<input  type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="gaji" id="gaji" disabled="" value="<?php echo $get_gudang->gaji ?>"/>
										</div>
									</div> 
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Alamat Asal</label>
									<input type="text" class="form-control" name="alamat_karyawan"  id="alamat_karyawan" disabled="" value="<?php echo $get_gudang->alamat_karyawan ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Alamat Domisili</label>
									<input type="text" class="form-control" name="alamat_domisili" id="alamat_domisili" disabled="" value="<?php echo $get_gudang->alamat_domisili ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Pendidikan Terakhir</label>
									<select class="form-control stok select2" name="pendidikan_terakhir" name="pendidikan_terakhir" disabled="">
										<option  value="">-- Pendidikan Terakhir --</option>
										<option <?php if($get_gudang->pendidikan_terakhir=='Perguruan Tinggi'){echo "selected";}?> value="Perguruan Tinggi">Perguruan Tinggi</option>
										<option <?php if($get_gudang->pendidikan_terakhir=='SMA Sederajat'){echo "selected";}?> value="SMA Sederajat">SMA Sederajat</option>
										<option <?php if($get_gudang->pendidikan_terakhir=='SMP Sederajat'){echo "selected";}?> value="SMP Sederajat">SMP Sederajat</option>
										<option <?php if($get_gudang->pendidikan_terakhir=='SD Sederajat'){echo "selected";}?> value="SD Sederajat">SD Sederajat</option>
									</select> 
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Sekolah / Institusi</label>
									<input type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" disabled="" value="<?php echo $get_gudang->nama_sekolah ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Nama Ayah</label>
									<input type="text" class="form-control" name="nama_ayah" id="nama_ayah" disabled="" value="<?php echo $get_gudang->nama_ayah ?>"/>
								</div>

								<div class="form-group  col-xs-5">
									<label class="gedhi">Pekerjaan</label>
									<select   class="form-control stok select2" name="pekerjaan_ayah" id="pekerjaan_ayah" disabled="">
										<option  value="">--Pilih Pekerjaan--</option>
										<option <?php if($get_gudang->pekerjaan_ayah=='PNS'){echo "selected";}?> value="PNS" >PNS</option>
										<option <?php if($get_gudang->pekerjaan_ayah=='Karyawan Swasta'){echo "selected";}?> value="Karyawan Swasta" >Karyawan Swasta</option>
										<option <?php if($get_gudang->pekerjaan_ayah=='Wiraswasta'){echo "selected";}?> value="Wiraswasta" >Wiraswasta</option>
										<option <?php if($get_gudang->pekerjaan_ayah=='Lain-lain'){echo "selected";}?> value="Lain-lain" >Lain - Lain</option>
									</select> 
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Status </label>
									<select   class="form-control stok" name="status_karyawan" id="status_karyawan" required="" disabled="">
										<option  value="">--Pilih Status--</option>
										<option <?php if($get_gudang->status_karyawan=='1'){echo "selected";}?> value="1" >Aktif</option>
										<option <?php if($get_gudang->status_karyawan=='0'){echo "selected";}?> value="0" >Tidak Aktif</option>						
									</select> 
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>