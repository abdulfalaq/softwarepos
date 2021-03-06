<?php 
$this->db->order_by('clouoid1_olive_master.master_perlengkapan.id','DESC');
$this->db->where('stok_minimal >= real_stock');
$this->db->from('clouoid1_olive_master.master_perlengkapan');
$this->db->join('clouoid1_olive_master.master_satuan','clouoid1_olive_master.master_perlengkapan.kode_satuan_stok = clouoid1_olive_master.master_satuan.kode','left');
$get_gudang = $this->db->get()->result();
?>
<!-- back button -->
<a href="<?php echo base_url('stok_minimal'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok_minimal'); ?>">Stok Minimal</a></li>
		<li><a href="#">Stok Prelengkapan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1> Stok Prelengkapan </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Stok Minimal Perlengkapan </span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Perlengkapan</th>
								<th>Nama Perlengkapan</th>
								<th>Jumlah Stok</th>
								<th align="right">Satuan</th>
							</tr>
						</thead>
						<tbody>    
							<?php 
							$no = 0;
							foreach ($get_gudang as $value) { 
								$no++; ?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $value->kode_perlengkapan ?></td>
									<td><?= $value->nama_perlengkapan ?></td>	
									<td><?= $value->stok_minimal ?></td>
									<td><?= $value->nama ?></td>								
								</tr>
								<?php }
								?>
							</tbody>                 
						</table>

					</div>
				</div>
			</div>
		</div>
	</div> 
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