
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">POS</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>POS</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data POS </span>
					<a href="<?php echo base_url('penjualan/pos/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah POS</a>
					<a href="<?php echo base_url('penjualan/pos/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data POS</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th>Tanggal Penjualan</th>
									<th>Kode Penjualan</th>
									<th>Member</th>
									<th width="5%">Action</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$this->db->order_by('kan_suol.transaksi_penjualan.id','DESC');
								$this->db->like('kan_suol.transaksi_penjualan.tanggal_penjualan',date('Y-m'));
								$this->db->from('kan_suol.transaksi_penjualan');
								$this->db->join('kan_master.master_member', 'kan_suol.transaksi_penjualan.kode_member = kan_master.master_member.kode_member','left');
								$get_penjualan=$this->db->get();
								$hasil_penjualan=$get_penjualan->result();
								$no=1;
								foreach ($hasil_penjualan as $penjualan) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @TanggalIndo($penjualan->tanggal_penjualan);?></td>
										<td><?php echo @$penjualan->kode_penjualan;?></td>
										<td><?php echo @$penjualan->nama_pic.' - '.@$penjualan->nama_perusahaan;?></td>
										<td>
											<a href="<?php echo base_url().'penjualan/pos/detail/'.@$penjualan->kode_penjualan;?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5">
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