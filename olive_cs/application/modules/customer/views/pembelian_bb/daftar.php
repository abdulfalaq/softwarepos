
<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Pembelian</a></li>
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
					<span class="pull-left" style="font-size: 24px">Data Pembelian </span>
					<a href="<?php echo base_url('pembelian/pembelian_bb/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Pembelian</a>
					<a href="<?php echo base_url('pembelian/pembelian_bb/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pembelian</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th>Tanggal Pembelian</th>
									<th>Kode Pembelian</th>
									<th>Nota Referensi</th>
									<th>Supplier</th>
									<th width="5%">Action</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$this->db->order_by('kan_suol.transaksi_pembelian.id','DESC');
								$this->db->like('kan_suol.transaksi_pembelian.tanggal_pembelian',date('Y-m'));
								$this->db->from('kan_suol.transaksi_pembelian');
								$this->db->join('kan_master.master_supplier', 'kan_suol.transaksi_pembelian.kode_supplier = kan_master.master_supplier.kode_supplier');
								$get_pembelian=$this->db->get();
								$hasil_pembelian=$get_pembelian->result();
								$no=1;
								foreach ($hasil_pembelian as $pembelian) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @TanggalIndo($pembelian->tanggal_pembelian);?></td>
										<td><?php echo @$pembelian->kode_pembelian;?></td>
										<td><?php echo @$pembelian->nomor_nota;?></td>
										<td><?php echo @$pembelian->nama_supplier;?></td>
										<td>
											<a href="<?php echo base_url().'pembelian/pembelian_bb/detail/'.@paramEncrypt($pembelian->kode_pembelian);?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5">
												<li class="fa fa-eye"></li>
											</a>

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