
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Kepengurusan</a></li>
		<li>Profil Pengurus</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
		<h1>Profil Pengurus</h1>

		<?php $this->load->view('menu_setting'); ?>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 20px;">Edit Data Pengurus</span>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus/tambah'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus'); ?>" type="button" class="btn btn-no-radius btn-primary"><i class="fa fa-list"></i> Daftar Data</a>
					</div>
					<div class="panel-body">
						<div class="form-group">
							<label>Jabatan</label>
							<select name="jabatan" id="jabatan" class="form-control" required="">
								<option value="">--Pilih Jabatan</option>
								<option value="">Kepala Koperasi</option>
							</select>
						</div>
						<div class="form-group">
							<label>Nama</label>
							<input type="text" name="nama" id="nama" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>Pendidikan Terakhir</label>
							<input type="text" name="pendidikan" id="pendidikan" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>Lama Menjadi Anggota</label>
							<div class="input-group">
								<input type="text" name="lama" id="lama" class="form-control" required="" placeholder="10">
								<span class="input-group-addon">Tahun</span>
							</div>
						</div>
						<div class="form-group">
							<label>Periode Kepengurusan</label>
							<div class="input-group">
								<select name="tahun_awal" id="tahun_awal" class="form-control">
									<option value="2000">2000</option>
									<option value="2001">2001</option>
									<option value="2003">2003</option>
								</select>
								<span class="input-group-addon">S/d</span>
								<select name="tahun_akhir" id="tahun_akhir" class="form-control">
									<option value="2000">2000</option>
									<option value="2001">2001</option>
									<option value="2003">2003</option>
								</select>
							</div>
						</div>
					</div>
					<div class="panel-footer text-right">
						<button class="btn btn-lg btn-super btn-no-radius btn-warning"><i class="fa fa-edit"></i> SIMPAN</button>
					</div>
				</div>
			</div>
		</div> <!-- //row -->
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	$(document).ready(function(){
		$('#update_btn').hide();
	});

	function update() {
		$('#simpan_btn').hide();
		$('#update_btn').show();
	}

	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$('#update_btn').click(function(){
		$('#update_btn').hide();
		$('#simpan_btn').show();
	});
</script>