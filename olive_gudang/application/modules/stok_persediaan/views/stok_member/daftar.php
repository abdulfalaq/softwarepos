<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('kartu_member')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('stok_persediaan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok_persediaan'); ?>">Stok Persediaan</a></li>
		<li><a href="#">Stok Kartu Member</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1> Stok Kartu Member </h1>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span style="font-size: 24px">Data Stok Kartu Member</span>
				</div>
				<div class="panel-body">
					<!-- <div class="row">

						<div class="col-md-4">
							<div class="form-group">
								<label>Nama Stok Perlengkapan</label>
								<input type="text" class="form-control" id="nama_produk" />
							</div>
						</div>
						<div class="col-md-3">
							<a onclick="cari_produk()" style="margin-top: 25px;" class="btn btn-primary green-seagreen"><i class="fa fa-search"></i> Cari</a>

						</div>
					</div> -->

					<table id="datatable" class="table table-striped table-bordered">
						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Kode Kartu Member</th>
								<th>Nama Kartu Member</th>
							</tr>
						</thead>
						<tbody>    
							<?php 
							$no = 0;
							foreach ($get_gudang as $value) { 
								$no++; ?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $value->kode_kartu_member ?></td>
									<td><?= $value->nama_kartu_member ?></td>								
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
