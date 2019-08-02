
<!-- back button -->
<a href="<?php echo base_url('stok_persediaan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok_persediaan'); ?>">Stok Persediaan</a></li>
		<li><a href="#">Stok Persediaan Bahan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1> Stok Persediaan Bahan </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Stok Persediaan Bahan</span>
					<a id="print" target="_blank" class="btn btn-success btn-no-radius "><i class="fa fa-print"></i> Print</a>
				</div>
				<div class="panel-body"> 
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Kode Bahan</th>
								<th>Nama Bahan</th>
								<th>Jumlah Stok</th>
								<th>Satuan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>    
							<?php 
							$no = 0; 
							$this->db->from('olive_master.master_bahan_baku mbb');
							$this->db->join('olive_master.master_satuan satuan', 'mbb.kode_satuan_stok = satuan.kode','left');
							$this->db->order_by('mbb.id','DESC');
							$get_gudang = $this->db->get()->result(); 
							foreach ($get_gudang as $value) { 
							$no++; ?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $value->kode_bahan_baku ?></td>
								<td><?= $value->nama_bahan_baku ?></td>
								<td><?= $value->real_stock ?></td>
								<td><?= $value->nama ?></td>
								<td align="center">
									<div class="btn-group">
										<a href="<?php echo base_url('stok_persediaan/stok_bahan/detail/'.$value->kode_bahan_baku); ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-info btn-no-radius"><i class="fa fa-search"></i></a>
									</div>
								</td>
							</tr>
							<?php }
							?>
						</tbody>          

					</table>
				</div>
				<input type="hidden" class="form-control rowcount" value="0">
				<input type="hidden" class="form-control pagenum" value="0">
			</div>

			<!------------------------------------------------------------------------------------------------------>

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
				<input type="hidden" id="kode_produk">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div> 
<script type="text/javascript">

$("#print").click(function(){
	var kode_bahan_baku = $("#kode_bahan_baku").val();
	window.open("<?php echo base_url().'stok_persediaan/stok_bahan/print_perlengkapan'; ?>/"+kode_bahan_baku);
});
</script>
