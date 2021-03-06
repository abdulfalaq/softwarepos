
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
					<span class="pull-left" style="font-size: 24px">Hasil Opname </span>
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
									<th>Jenis Bahan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody >
								<?php
								$get_unit=$this->db->get('setting');
								$hasil_unit=$get_unit->row();

								$this->db->where('kode_unit_jabung', @$hasil_unit->kode_unit);
								$this->db->where('status', 'menunggu_validasi');
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
											<a href="<?php echo base_url('stok/opname/detail_hasil/'.@$opname->kode_opname); ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
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
	</div>
	
	<!-- //row -->
</div>

<div id="modal-valid" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi Validasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>apakah anda yakin memvalidasi data tersebut ?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak Disesuaikan</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Disesuaikan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	function kofirm_validasi(key) {
		$('#modal-valid').modal('show');
	}
</script>