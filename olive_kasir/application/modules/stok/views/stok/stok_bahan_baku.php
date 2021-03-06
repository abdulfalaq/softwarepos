
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Nominal Stok</a></li>
		<li><a href="#">Bahan Baku</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Stok Bahan Baku </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Stok Bahan Baku </span>
					<br>

				</div>
				<div class="panel-body">
					<?php 
					$this->db_master->select('*');
					$this->db_master->from('master_bahan_baku');
					$this->db_master->join('master_gudang', 'master_gudang.kode_gudang = master_bahan_baku.kode_gudang');
					$this->db_master->join('master_satuan', 'master_satuan.kode = master_bahan_baku.kode_satuan_stok');
					$get_bahan_baku = $this->db_master->get()->result();
					?>
					<div class="col-md-12 row">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Bahan</th>
									<th>Nama Bahan Baku</th>
									<th>Gudang</th>
									<th>Real Stok</th>
									<th>Stok Minimal</th>
									<th>HPP</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody>    
								<?php 
								$no = 0;
								foreach ($get_bahan_baku as $value) { 
									$no++; ?>
									<tr>
										<th><?php echo $no ?></th>
										<th><?php echo $value->kode_bahan_baku ?></th>
										<th><?php echo $value->nama_bahan_baku ?></th>
										<th><?php echo $value->nama_gudang ?></th>
										<th><?php echo $value->real_stok.' '.$value->nama ?></th>
										<th><?php echo $value->stok_minimal.' '.$value->nama ?></th>
										<th><?php echo format_rupiah($value->hpp) ?></th>
										<!-- <td>
											<a href="<?php echo base_url('stok/detail_bahan_baku/'.@$value->kode_bahan_baku);?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
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