
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Pesanan Penjualan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pesanan Penjualan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Pesanan Penjualan </span>
					<a href="<?php echo base_url('penjualan/pesanan_penjualan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Pesanan Penjualan</a>
					<a href="<?php echo base_url('penjualan/pesanan_penjualan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pesanan Penjualan</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th>Tanggal Transaksi</th>
									<th>Kode Pesanan Penjualan</th>
									<th>Member</th>
									<th>Status</th>
									<th width="5%">Action</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$this->db->order_by('kan_suol.transaksi_penjualan_pesanan.id','DESC');
								$this->db->like('kan_suol.transaksi_penjualan_pesanan.tanggal',date('Y-m'));
								$this->db->from('kan_suol.transaksi_penjualan_pesanan');
								$this->db->join('kan_master.master_member', 'kan_suol.transaksi_penjualan_pesanan.kode_member = kan_master.master_member.kode_member');
								$get_pesanan=$this->db->get();
								$hasil_pesanan=$get_pesanan->result();
								$no=1;
								foreach ($hasil_pesanan as $pesanan) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @TanggalIndo($pesanan->tanggal);?></td>
										<td><?php echo @$pesanan->kode_pesanan;?></td>
										<td><?php echo @$pesanan->nama_pic;?> - <?php echo @$pesanan->nama_perusahaan;?></td>
										<td><?php echo @$pesanan->status;?></td>
										<td>
											<?php if($pesanan->status == 'sudah_dijadwalkan'){ ?>
											<a href="<?php echo base_url().'penjualan/pesanan_penjualan/detail/'.@$pesanan->kode_pesanan.'/sudah';?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5">
												<li class="fa fa-eye"></li>
											</a>
											<?php } else { ?>
											<a href="<?php echo base_url().'penjualan/pesanan_penjualan/detail/'.@$pesanan->kode_pesanan.'/belum';?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5">
												<li class="fa fa-pencil"></li>
											</a>
											<?php } ?>
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