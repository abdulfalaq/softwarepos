
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
						<span class="pull-left" style="font-size: 20px;">Daftar Pengurus</span>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus/tambah'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
						<a href="<?php echo @base_url('setting/kepengurusan_profil_pengurus'); ?>" type="button" class="btn btn-no-radius btn-primary"><i class="fa fa-list"></i> Daftar Data</a>
					</div>
					<div class="panel-body">
						<table id="datatables" class="table table-bordered table-blue">
							<thead>
								<th width="100px">No</th>
								<th>Nama</th>
								<th>Jabatan</th>
								<th width="100px">Action</th>
							</thead>
							<tbody>
								<td>1</td>
								<td>XXXX</td>
								<td>Kepala Koperasi</td>
								<td align="center">
									<a href="<?php echo base_url('setting/kepengurusan_profil_pengurus/edit/123'); ?>" class="btn btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
									<a href="#" onclick="hapus();" class="btn btn-danger" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
								</td>
							</tbody>
						</table>
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