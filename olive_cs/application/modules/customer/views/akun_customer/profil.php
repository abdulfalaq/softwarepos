

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('customer'); ?>">Customer</a></li>
		<li><a href="#">Profil</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Profil</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span  style="font-size: 24px">Detail Customer</span>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">


								<div class="form-group  col-xs-6">
									<label><b>Kode Customer</label>
										<div class="">
											<input readonly name="kode_member" value="20171010001"   type="text" class="form-control" id="kode_member" />
										</div>
									</div>



									<div id="div-alamat-member" class="input_alamat form-group  col-xs-6">
										<label><b>Alamat Customer</label>
											<div class="">
												<input readonly name="alamat_member" value="Malang"   type="text" class="form-control" id="alamat_member" />
											</div>
										</div> 




										<div id="div-nama-member" class="input_nama_member form-group  col-xs-6">
											<label><b>Nama Customer</label>
												<div class="">
													<input readonly name="nama_member" value="Arda"  type="text" class="form-control" id="nama_member" />
												</div>
											</div>



											<div id="div-tempat-lahir" class="input_nama_member form-group  col-xs-6">
												<label><b>No. Telp</label>
													<div class="">
														<input readonly name="telp_member" value="0813010"  type="text" class="form-control" id="telp_member" />
													</div>
												</div>

												<div id="div-no-ktp" class="input_no_ktp form-group  col-xs-6">
													<label><b>No.KTP</label>
														<div class="">
															<input readonly name="no_ktp" value="02910290"  type="text" class="form-control" id="no_ktp" />
														</div>
													</div>




													<div id="div-tempat-lahir" class="input_nama_member form-group  col-xs-6">
														<label><b>Pekerjaan</label>
															<div class="">
																<input readonly name="pekerjaan" value="Swasta"  type="text" class="form-control" id="pekerjaan" />
															</div>
														</div>




														<div id="div-tempat-lahir" class="input_nama_member form-group  col-xs-6">
															<label><b>Tempat Lahir</label>
																<div class="">
																	<input readonly type="text" value="Malang" class="form-control" placeholder="Tempat Lahir" name="tempat_lahir" id="tempat_lahir"/>
																</div>
															</div>



															<div id="div-status-member" class="input_status_member form-group  col-xs-6">
																<label><b>Status Perkawinan</label>
																	<div class="">
																		<select class="form-control" id="status_perkawinan" name="status_perkawinan" disabled="">
																			<option  value="" >Pilih</option>
																			<option  value="Menikah">Menikah</option>
																			<option selected value="Belum Menikah">Belum Menikah</option>
																		</select>
																	</div>
																</div>



																<div id="div-tanggal-lahir" class="input_nama_member form-group  col-xs-6">
																	<label><b>Tanggal Lahir</label>
																		<div class="">
																			<input readonly type="date" value="1990-01-05" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir"/>
																		</div>
																	</div>





<!--                 <div id="div-telp" class="input_telp form-group  col-xs-6">
                  <label><b>Telepon Member</label>
                  <div class="">
                    <input readonly name="telp_member" value="0813010"  type="text" class="form-control" id="telp_member" />
                  </div>
              </div>  -->

              <div id="div-kategori_member" class="input_kategori_member form-group  col-xs-6">
              	<label><b>Kategori Customer</label>
              		<div class="">
              			<select class="form-control" id="kategori_member" name="kategori_member" disabled="">
              				<option  value="" >Pilih</option>
              				<option  value="Umum">Umum</option>
              				<option selected value="Member">Member</option>
              			</select>
              		</div>
              	</div>


              	<div id="div-jenis-kelamin" class="input_nama_member form-group  col-xs-6">
              		<label><b>Jenis Kelamin</label>
              			<div class="">
              				<select class="form-control jenis_kelamin" id="jenis_kelamin" name="jenis_kelamin" disabled="">
              					<option value="" selected="">--Pilih Jenis Kelamin--</option>
              					<option selected value="Laki - Laki">Laki - Laki</option>
              					<option  value="Perempuan">Perempuan</option>
              				</select>
              			</div>
              		</div>




              		<div id="div-status-member" class="input_status_member form-group  col-xs-6">
              			<label><b>Status Customer</label>
              				<div class="">
              					<select class="form-control" id="status" name="status_member" disabled="">
              						<option  value="" >Pilih</option>
              						<option selected value="1">Aktif</option>
              						<option  value="0">Tidak Aktif</option>
              					</select>
              				</div>
              			</div>

              			<br>
              			<br>
              			<br>


              			<!--  -->



              		</div>
               <!--<div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>-->
        </div>
    </form>

</div>
</div>
</div>
</div>
</div>

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