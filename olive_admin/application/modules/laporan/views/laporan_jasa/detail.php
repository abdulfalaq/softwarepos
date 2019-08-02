
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Pengadaan asset</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pembelian</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Asset</span>
					<a href="<?php echo base_url('master/master_breed/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/master_breed/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-group">
							<div class="col-md-12">
								<div class="sukses">
								</div>
								<table class="table">
									<tr>
										<td><label>Kode Diagnosa Penyakit</label></td>
										<td><input readonly type="text" name="kode" value="DP021149" class='form-control' id="kode" required placeholder="Kode Diagnosa" /></td>
									</tr>

									<tr>
										<td><label>Nama Diagnosa Penyakit</label></td>
										<td>
											<input type="text" name="nama_diagnosa" class='form-control' id="nama_diagnosa" required placeholder="Nama Diagnosa"  />
										</td>
									</tr>

									<tr>
										<td><label>Jenis Penyakit</label></td>
										<td>
											<select required class="form-control" id="kategori_penyakit" name="kategori_penyakit">
												<option  value="">Pilih</option>

												<option   value="KP092918">App. Logomotoris</option>
												<option   value="KP092948">Gangguan Reproduksi</option>
												<option   value="KP093018">Mammaria</option>
												<option   value="KP093039">Metabolic/Intoxicasi</option>
												<option   value="KP093057">Sistem Digestivus</option>
												<option   value="KP093121">Sistem Musculi et Cutanea</option>
												<option   value="KP093151">Sistem Respira et Cardiovascular</option>
												<option   value="KP094006">AASew</option>

											</select>
										</td>
									</tr>

									<tr>
										<td><label>Status</label></td>
										<td>
											<select class="form-control" id="status_diagnosa" name="status_diagnosa">
												<option  value="1">Aktif</option>
												<option  value="0">Tidak Aktif</option>
											</select>
										</td>
									</tr>

								</table>
							</div>
						</div>
						<div class="box-footer clearfix">
							<button type="submit" style="margin-top: 20px;" class="pull-right btn btn-primary" id="data_form">Save <i class="fa fa-arrow-circle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>