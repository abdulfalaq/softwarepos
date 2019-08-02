
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Nominal Stok</a></li>
		<li><a href="#">Barang Dalam Proses</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Stok Barang Dalam Proses </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Barang Dalam Proses </span>
					<br>

				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<table style="" width="100%" class="table table-hover table-bordered">
							<thead>
								<th>No</th>
								<th>Tanggal</th>
								<th>Uraian</th>
								<th colspan="2" class="text-center">Stok Masuk</th>
								<th colspan="2" class="text-center">Stok Keluar</th>
								<th colspan="2" class="text-center">Saldo</th>

							</thead>
							<thead>
								<th></th>
								<th></th>
								<th></th>
								<th style="border-top: #ddd;border-top-style: solid;border-width: thin;">Jumlah</th>
								<th>Harga Satuan</th>
								<th style="border-top: #ddd;border-top-style: solid;border-width: thin;">Jumlah</th>
								<th>Harga Satuan</th>
								<th style="border-top: #ddd;border-top-style: solid;border-width: thin;">Jumlah</th>

								<th>Total</th>
							</thead>
							<tbody>

							</tbody>
						</table>
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