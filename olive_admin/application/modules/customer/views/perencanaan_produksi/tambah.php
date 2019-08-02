

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('Setting'); ?>">Setting</a></li>
		<li><a href="#">Poin</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Poin</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Poin</span>
					<a href="<?php echo base_url('setting/poin/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Poin</a>
					<a href="<?php echo base_url('setting/poin/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Poin</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Customer</label>
										<input type="hidden" id="id" name="id" value=""></input>
										<input  name="kode_member" value="20180209001" readonly="true" type="text" class="form-control input_kode_member" id="kode_member"/>
									</div>

									<div class="form-group  col-xs-5">
										<label class="gedhi"><b>Alamat Customer</label>
											<input  value="" type="text" class="form-control input_alamat_member" name="alamat_member" id="alamat_member" />
										</div>

										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Nama Customer</label>
												<input  value="" type="text" id="nama_member" class="form-control input_nama_member" name="nama_member" />
											</div>
											<div class="form-group  col-xs-5">
												<label class="gedhi"><b>No. Telp</label>
													<input  value="" type="text" id="telp_member" class="form-control input_telp_member" name="telp_member" />
												</div>

												<div class="form-group  col-xs-5">
													<label class="gedhi"><b>No. KTP</label>
														<input  value="" type="text" id="no_ktp" class="form-control input_no_ktp" name="no_ktp" />
													</div>

													<div class="form-group  col-xs-5">
														<label class="gedhi"><b>Pekerjaan</label>
															<select class="form-control input_pekerjaan select2" name="pekerjaan" id="pekerjaan">
																<option selected="true" value="">--Pilih Pekerjaan--</option>
																<option  value="PNS" >PNS</option>
																<option  value="Guru" >Guru</option>
																<option  value="Dosen" >Dosen</option>
																<option  value="Pelajar/Mahasiswa" >Pelajar/Mahasiswa</option>
																<option  value="BUMN" >BUMN</option>
																<option  value="Swasta" >Swasta</option>
																<option  value="Wiraswasta" >Wiraswasta</option>
																<option  value="IRT" >IRT</option>
																<option  value="Lain-lain" >Lain - Lain</option>
															</select> 
														</div>

														<div class="form-group  col-xs-5">
															<label class="gedhi"><b>Tempat Lahir</label>
																<input  value="" type="text" id="tempat_lahir" class="form-control input_tempat_lahir" name="tempat_lahir" />
															</div>

															<div class="form-group  col-xs-5">
																<label class="gedhi"><b>Status Perkawinan</label>
																	<select  class="form-control stok select2 input_status_perkawinan" name="status_perkawinan" id="status_perkawinan">
																		<option value="">--Pilih Status Perkawinan--</option>
																		<option  value="Menikah" >Menikah</option>
																		<option  value="Belum Menikah" >Belum Menikah</option>
																		<option  value="Janda/Duda" >Janda/Duda</option>
																	</select> 
																</div>

																<div class="form-group  col-xs-5">
																	<label class="gedhi"><b>Tanggal Lahir</label>
																		<input  value="" type="date" id="tanggal_lahir" class="form-control input_tanggal_lahir" name="tanggal_lahir" />
																	</div>

																	<div class="form-group  col-xs-5">
																		<label class="gedhi"><b>Agama</label>
																			<select  class="form-control stok select2 input_agama" name="agama" id="agama">
																				<option value="">--Pilih Agama--</option>
																				<option  value="Islam" >Islam</option>
																				<option  value="Kristen" >Kristen</option>
																				<option  value="Katolik" >Katolik</option>
																				<option  value="Hindu" >Hindu</option>
																				<option  value="Budha" >Budha</option>
																				<option  value="Lain-lain" >Lain-lain</option>
																			</select> 
																		</div>

																		<div class="form-group  col-xs-5">
																			<label class="gedhi"><b>Jenis Kelamin</label>
																				<select  class="form-control stok select2 input_jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin">

																					<option value="">--Pilih Jenis Kelamin--</option>
																					<option  value="Laki-laki" >Laki-laki</option>
																					<option  value="Perempuan" >Perempuan</option>
																				</select> 
																			</div>

																			<div class="form-group  col-xs-5">
																				<label class="gedhi"><b>Kategori Customer</label>
																					<select  class="form-control stok select2 input_kategori_member" name="kategori_member" id="kategori_member">
																						<option value="">--Pilih Kategori Member--</option>
																						<option  value="Non Member" >Non Member</option>
																						<option  value="Member" >Member</option>
																					</select> 
																				</div>

																				<div class="form-group  col-xs-5">
																					<label class="gedhi"><b>Afiliasi</label>
																						<select  class="form-control stok select2 input_status" name="afiliasi" id="afiliasi">
																							<option value="">--Pilih Afiliasi--</option>
																							<option value="Event" >Event</option>
																							<option value="Instagram" >Instagram</option>
																							<option value="Facebook" >Facebook</option>
																							<option value="Twitter" >Twitter</option>
																							<option value="Keluarga/Teman" >Keluarga/Teman</option>
																							<option value="Lain-lain" >Lain-lain</option>
																						</select> 
																					</div>


																					<div class="form-group  col-xs-5">

																						<label class="gedhi"><b>Status</label>
																							<select  class="form-control stok select2 input_status" name="status_member" id="status_member">
																								<option value="">--Pilih Status--</option>
																								<option  value="1" >Aktif</option>
																								<option  value="0" >Nonaktif</option>
																							</select> 
																						</div>

																					</div>
																					<div class="box-footer">
																						<button type="submit" id="simpan" class="btn btn-primary">Simpan</button>               
																					</div>
																				</div>
																			</form>
																			<br>
																			<br>
																			<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
																				<div class="modal-dialog">
																					<div class="modal-content">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																							<h4 class="modal-title">Alert</h4>
																						</div>
																						<div class="modal-body text-center">
																							<h2>Anda yakin akan menghapus data ini?</h2>
																							<input type="hidden" id="kode_peralatan">
																						</div>
																						<div class="modal-footer">
																							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
																							<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="box-body">   
																				<div class="portlet-title">
																					<div class="caption">
																						Data Customer
																					</div>
																					<div class="tools">
																						<a href="javascript:;" class="collapse">
																						</a>
																						<a href="javascript:;" class="reload">
																						</a>

																					</div>
																				</div>
																				<div class="portlet-body">

																					<div class="box-body">            
																						<div class="sukses2" ></div>
																						<div class="row" >
																							<div class="form-group">
																								<div class="col-md-3">
																									<input type="text" class="form-control" id="nama_customer" placeholder="Cari Nama Customer">
																								</div>
																								<div class="col-md-2">
																									<button type="button" class="btn btn-success" onclick="cari_member()"><i class="fa fa-search"></i> &nbsp Cari</button>
																								</div>
																							</div>
																						</div>
																						<br><br>
																						<table  class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1em;">


																							<thead>
																								<tr width="100%">
																									<th>No</th>
																									<th>Kode Customer</th>
																									<th>Nama Customer</th>  
																									<th>No. KTP</th>
																									<th>Tempat Lahir</th>
																									<th>Tanggal Lahir</th>
																									<th>Jenis Kelamin</th>
																									<th>Alamat</th>
																									<th>Telp. Customer</th> 
																									<th>Pekerjaan</th>
																									<th>Tanggal Registrasi</th>
																									<th>Status Perkawinan</th>
																									<th>Kategori Customer</th>
																									<th>Status</th>
																								</tr>
																							</thead>
																							<tbody id="data_customer">
																								<tr>
																									<td>1</td>
																									<td>20171209003</td>
																									<td>Ratna</td>
																									<td>2342</td>
																									<td>Malang</td>
																									<td>09 Desember 2017</td>
																									<td>Perempuan</td>
																									<td>Malang</td>
																									<td>234324</td>
																									<td>Guru</td>
																									<td>09 Desember 2017</td>
																									<td>Belum Menikah</td>
																									<td>Member</td>
																									<td><span class="label label-info">AKTIF</span></td>
																								</tr>

																							</div>
																						</div>
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>