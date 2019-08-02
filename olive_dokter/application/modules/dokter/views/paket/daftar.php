
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Paket</a></li>
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
					<span class="pull-left" style="font-size: 24px">Data Paket </span>
					<a href="<?php echo base_url('setting/paket/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/paket/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<div id="cari_transaksi">
							<div id="cari_transaksi">
								<table id="datatable" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode Paket</th>
											<th>Nama Paket</th>
											<th>Harga Paket</th>
											<th>Status Paket</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="scroll_data">

										<tr>
											<td>1</td>
											<td>PKT2108</td>
											<td>Paket  B</td>
											<td>Rp 550.000,00</td>
											<td><span class="label label-info">AKTIF</span></td>
											<td align="center">
												<div class="btn-group">
													<a href="<?php echo base_url('setting/paket/detail') ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-primary btn-circle green"><i class="fa fa-search"></i></a>
													<a href="<?php echo base_url('setting/paket/edit') ?>" key="8" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i></a>
													<a onclick="" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-remove"></i></a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
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
		function hapus(key) {
			$('#modal-hapus').modal('show');
		}
	</script>