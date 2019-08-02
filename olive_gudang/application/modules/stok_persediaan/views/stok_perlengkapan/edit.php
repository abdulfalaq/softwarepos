
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Rak</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Rak </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Rak </span>
					<a href="<?php echo base_url('setting/rak/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/rak/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="http://192.168.100.17/elladerma_gudang/admin/master/simpan_rak" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode Rak</label>
									<input type="hidden" name="id" value="" />
									<input  type="text" class="form-control" value="" readonly name="kode_rak" id="kode_rak" />
								</div>

								<div class="form-group col-xs-5">
									<label class="gedhi"><b>Nama Rak</label>
									<input type="text" value="" class="form-control" name="nama_rak"  />
								</div>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Status</label>
									<select class="form-control select2" name="status" id="status">
										<option selected="" value="">--Pilih Status--</option>
										<option  value="1" >Aktif</option>
										<option  value="0" >Tidak Aktif</option>
									</select> 
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
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