
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Promo</a></li>
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
					<span class="pull-left" style="font-size: 24px">Edit Promo </span>
					<a href="<?php echo base_url('setting/promo/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/promo/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>

							<label><h3><b>Edit Promo</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Promo</label>
										<input readonly='true' type="text" value="p324" class="form-control" placeholder="Kode " name="kode_promo" id="kode_promo" />
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Promo</label>
										<input type="text" class="form-control" placeholder="Nama Promo" value="Promo Natal" name="nama_promo" id="nama_promo"/>
									</div>

								</div>

								<div class="col-md-6">
									<label>Tanggal Awal Promo</label>
									<input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="2017-12-08" />
								</div>


								<div class="col-md-6">
									<label>Tanggal Akhir Promo</label>
									<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="2017-12-25" />
								</div>

								<div class="col-md-6">

									<label>Status</label>
									<select class="form-control" name="status" id="status">

										<option value="">--Pilih Status--</option>
										<option selected value="1" >Aktif</option>
										<option  value="0" >Nonaktif</option>
									</select> 
								</div>

							</div>
							<div class="col-md-12" style="padding:10px; text-align: right;">
								<a onclick="simpan_all()"  class="btn btn-success pull-right">Ubah</a>
							</div>
						</div> 
						<br>

						<div class="box-footer clearfix">

						</div>
					</form>

				</div>
			</div>		
		</div>
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