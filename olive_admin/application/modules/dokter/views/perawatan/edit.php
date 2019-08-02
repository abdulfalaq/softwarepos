
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Perawatan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Perawatan </span>
					<a href="<?php echo base_url('setting/perawatan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/perawatan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Perawatan</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Perawatan</label>
										<input readonly='true' type="text" value="TRT_231017121148_1" class="form-control" placeholder="Kode " name="kode_perawatan" id="kode_perawatan" />
									</div>

									<div class="form-group">
										<label class="gedhi"><b>Harga Jual</label>
											<div class="input-group">
												<span class="input-group-addon rp_hpp">Rp 0,00</span>
												<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="harga_perawatan" id="harga_perawatan" value="10000" />
											</div>
										</div>


									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="gedhi">Nama Perawatan</label>
											<input type="text" class="form-control" placeholder="Nama Perawatan" value="segar" name="nama_perawatan" id="nama_perawatan"/>
										</div>

										<div class="form-group">
											<label>Status</label>
											<select class="form-control select2" name="status" id="status" "">
												<option selected="true" value="">Pilih Status</option>
												<option value="1" selected>Aktif</option>
												<option value="0" >Nonaktif</option>
											</select> 
										</div>

									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="gedhi"><b>Insentif Terapis</label>
												<div class="input-group">
													<span class="input-group-addon rp_insentif">Rp 0,00</span>
													<input type="number" class="form-control input-group" onkeyup="get_insentif()" name="insentif_terapis" id="insentif_terapis" value="4500" />
												</div>
											</div>
										</div>
										<div class="col-md-6">



											<div class="form-group">
												<label class="gedhi">HPP</label>
												<input type="text" class="form-control" placeholder="HPP" value="9000" name="harga_promo" id="harga_promo" readonly="true"/>
											</div>

										</div>
										<div class="col-md-12">
											<div class="form-group">
												<br> <br>  
												<div onclick="lock_perawatan()" id="lock_perawatan"  class="btn btn-primary pull-right" style="margin-right:5px">Simpan</div>
											</div>
										</div>
									</div>
								</div>
							</b>
						</label>
					</div>
				</div>
			</b>
		</label>
	</div>
</div>				



<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus bahan tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delData()" class="btn red">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm-bayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Simpan</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menyimpan Data Perawatan <span id="bayare"></span> ?</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button id="simpan_transaksi" class="btn red">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm-temp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Komposisi Perawatan</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Silahkan Masukan Komposisi Perawatan!</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

			</div>
		</div>
	</div>
</div>

<div id="modal-confirm-ubah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Ubah</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan mengubah Data Perawatan <span id="bayare"></span> ?</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button id="simpan_ubah" class="btn red">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm-tanggal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Jatuh Tempo</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Silahkan Pilih Tanggal Jatuh Tempo !</span>
				<input id="id-delete" type="hidden">
				<input id="bahan-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">OK</button>

			</div>
		</div>
	</div>
</div>

<div id="modal_setting" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content" >
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
				<label><b><i class="fa fa-gears"></i>Setting</b></label>
			</div>

			<form id="form_setting" >
				<div class="modal-body">
					<div class="box-body">

						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label>Note</label>
									<input type="text" name="keterangan"  class="form-control" />
								</div>

							</div>
						</div>

					</div>

					<div class="modal-footer" style="background-color:#eee">
						<button class="btn red" data-dismiss="modal" aria-hidden="true">Cancel</button>
						<button type="submit" class="btn btn-success">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</div>