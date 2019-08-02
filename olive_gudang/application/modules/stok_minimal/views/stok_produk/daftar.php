<?php 
$this->db->order_by('olive_master.master_produk.id','DESC');
$this->db->where('stok_minimal >= real_stock');
$this->db->from('olive_master.master_produk');
$this->db->join('olive_master.master_satuan','olive_master.master_produk.kode_satuan_stok = olive_master.master_satuan.kode','left');
$get_gudang = $this->db->get()->result();
?>
<!-- back button -->
<a href="<?php echo base_url('stok_minimal'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok_minimal'); ?>">Stok Minimal</a></li>
		<li><a href="#">Stok Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Stok Produk </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Stok Produk</span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<!-- <div class="col-md-12" align="right" >
						<a id="print" target="_blank" style="margin-top: 25px;" class="btn btn-primary green-seagreen"><i class="fa fa-print"></i>Print</a>

					</div> -->
					<div class="row">
						<div class="col-md-12">
							<div style="height: 10px"></div>
						</div>
					</div>
					<br>
					<div class="col-md-12">
						<table  class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
							<thead>
								<tr width="100%">
									<th>No</th>
									<th>Kode Produk</th>
									<th>Nama Produk</th>
									<th>Jumlah Stok</th>
									<th>Satuan</th>
									<!-- <th>Action</th> -->
								</tr>
								<tbody>    
									<?php 
									$no = 0;
									foreach ($get_gudang as $value) { 
										$no++; ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $value->kode_produk ?></td>
											<td><?= $value->nama_produk ?></td>	
											<td><?= $value->stok_minimal ?></td>
											<td><?= $value->nama ?></td>					
											<!-- <td>
												<a title="Detail" class="btn btn-md green-seagreen btn-circle btn-primary" href="<?php echo base_url("stok_minimal/stok_produk/detail"); ?>">
													<i class="fa fa-eye"></i>
												</a>
											</td> -->
										</tr>
										<?php }
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