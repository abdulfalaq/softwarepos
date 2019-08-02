

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('Customer'); ?>">Customer</a></li>
		<li><a href="#">Perencanaan Produksi</a></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perencanaan Produksi</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span  style="font-size: 24px">Daftar Perencanaan Produksi</span>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="box-body">
							<form id="data_form" method="post">
								<div class="box-body">            
									<div class="row">
										<div class="form-group  col-xs-5">
											<label><b>Kode Customer</label>
												<input type="hidden" id="id" name="id" value=""></input>
												<input  name="kode_member" value="20180210001" readonly="true" type="text" class="form-control input_kode_member" id="kode_member"/>
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
						</div>
					</div>
				</div>
			</div>	
			<div class="container">
				<div class="panel panel-default">
					<div class="panel-heading text-left">
						<span  style="font-size: 24px">Daftar Perencanaan Produksi</span>
					</div>
					<div class="box-body">
						<div class="portlet-body">
							<div class="form-group">
								<div class="col-md-3">
									<input type="text" class="form-control" id="nama_customer" placeholder="Cari Nama Customer">
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-success" onclick="cari_member()"><i class="fa fa-search"></i> &nbsp Cari</button>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<div class="col-md-12 row">
								<div class="box-body">
									<table id="datatable" class="table table-striped table-bordered">
										<thead>
											<tr >
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
												<td><span class="label label-info">AKTIF</span></td>
											</tr>
										</tbody>
									</table>
									<input type="hidden" class="form-control rowcount" value="0">
									<input type="hidden" class="form-control pagenum " value="0">
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
</div>


