
<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">PO Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>PO Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Validasi PO Supplier </span>
					<br><br>
				</div>
				<div class="panel-body">
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode PO</th>
								<th>Tanggal Transaksi</th>
								<th>Tanggal Barang Datang</th>
								<th>Petugas</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="data_pengadaan">
							<?php

							$this->db->select('kan_suol.transaksi_po.kode_po, kan_suol.transaksi_po.tanggal_input,kan_suol.transaksi_po.tanggal_barang_datang,kan_suol.transaksi_po.status');
							$this->db->select('kan_master.master_user.nama_user');

							$this->db->order_by('kan_suol.transaksi_po.id','DESC');
							$this->db->like('kan_suol.transaksi_po.tanggal_barang_datang',date('Y-m'));
							$this->db->from('kan_suol.transaksi_po');
							$this->db->join('kan_master.master_user', 'kan_suol.transaksi_po.kode_petugas = kan_master.master_user.kode_user ');
							$get_po = $this->db->get();
							$hasil_po=$get_po->result();
							$no=1;
							foreach ($hasil_po as $po) {
								?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo @$po->kode_po;?></td>
									<td><?php echo @TanggalIndo($po->tanggal_input);?></td>
									<td><?php echo @TanggalIndo($po->tanggal_barang_datang);?></td>
									<td><?php echo @$po->nama_user;?></td>
									<td><?php echo @$po->status;?></td>
									<td>
										<?php
										if(@$po->status=='menunggu'){
											?>
											<a href="<?php echo base_url().'pembelian/po/validasi/'.@paramEncrypt($po->kode_po);?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-info m-b-5"><i class="fa fa-check"></i> Validasi</a>
											<?php
										}else{
											?>
											<a href="<?php echo base_url().'pembelian/po/detail_validasi/'.@paramEncrypt($po->kode_po);?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5"><i class="fa fa-eye"></i></a>
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