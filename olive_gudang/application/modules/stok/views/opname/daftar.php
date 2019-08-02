
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Opname</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Opname </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Opname </span>
					<br><br>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 70px;">No</th>
									<th>Kode Opname</th>
									<th>Tanggal</th>
									<th>Produk</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody id="data_opsi_temp">
								<?php
								$get_unit=$this->db->get('setting');
								$hasil_unit=$get_unit->row();

								$this->db->where('kode_unit_jabung', @$hasil_unit->kode_unit);
								
								$get_opname=$this->db->get('transaksi_opname');
								$hasil_opname=$get_opname->result();
								$no=1;
								foreach ($hasil_opname as $opname) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @$opname->kode_opname;?></td>
										<td><?php echo @TanggalIndo($opname->tanggal_opname);?></td>
										<td><?php echo str_replace('_',' ', @$opname->jenis_bahan);?></td>
										<td>
											<a href="<?php echo base_url('stok/opname/detail/'.@$opname->kode_opname); ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
											<?php
											if(@$opname->status=='proses' and @$opname->jenis_bahan=='BB'){
												?>
												<a href="<?php echo base_url('stok/opname/input_opname/'.@$opname->kode_opname); ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
												<?php
											}elseif (@$opname->status=='proses' and @$opname->jenis_bahan!='BB') {
												?>
												<a href="<?php echo base_url('stok/opname/input_opname_produk/'.@$opname->kode_opname); ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
												<?php
											}
											?>
										</td>
									</tr>
									<?php
								}
								?>
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