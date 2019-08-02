<a href="<?php echo base_url('stok_persediaan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok_persediaan'); ?>">Stok Persediaan</a></li>
		<li><a href="#">Stok Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1> Stok Produk </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Stok Produk</span>
					<a id="print" target="_blank" class="btn btn-success btn-no-radius"><i class="fa fa-print"></i> Print</a>
				</div>
				<div class="panel-body"> 
					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Kode Produk</th>
								<th>Nama Produk</th>
								<th>Jumlah Stok</th>
								<th>Satuan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>    
							<?php 
							$no = 0;
							$this->db->from('olive_master.master_produk mp');
							$this->db->join('olive_master.master_satuan m_s','m_s.kode = mp.kode_satuan_stok','left');
							$this->db->order_by('mp.id','DESC');
							$get_gudang = $this->db->get()->result();
							foreach ($get_gudang as $value) { 
								$no++; ?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $value->kode_produk ?></td>
									<td><?= $value->nama_produk ?></td>
									<td><?= $value->real_stock ?></td>
									<td><?= ucwords($value->nama) ?></td>
									<td align="center">
										<div class="btn-group">
											<a href="<?php echo base_url('stok_persediaan/stok_produk/detail/'.$value->kode_produk); ?>" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-info btn-no-radius"><i class="fa fa-search"></i></a>
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
			</div> 
		</div>    
	</div>  
	<script type="text/javascript">

	$("#print").click(function(){
		var kode_produk = $("#kode_produk").val();
		window.open("<?php echo base_url().'stok_persediaan/stok_produk/print_perlengkapan'; ?>/"+kode_produk);
	});
	</script>
