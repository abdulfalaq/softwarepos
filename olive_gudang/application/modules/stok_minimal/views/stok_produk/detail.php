
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
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
					<span class="pull-left" style="font-size: 24px">Detail Stok Produk </span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="row">

						<div class="col-md-5" id="">
							<div class="input-group">
								<span class="input-group-addon">Tanggal Awal</span>
								<input type="date" class="form-control tgl"  id="tgl_awal">
							</div>
						</div>
						<div class="col-md-5" id="">
							<div class="input-group">
								<span class="input-group-addon">Tanggal Akhir</span>
								<input type="date" class="form-control tgl" id="tgl_akhir">
							</div>
						</div>                        
						<div class="col-md-2 pull-left">
							<button style="width: 147px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
						</div>
					</div><br>

					<table  class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
						<thead>
							<tr width="100%">
								<th>No</th>
								<th>Tanggal Pembelian</th>
								<th>Nama Produk</th>
								<th>Jumlah Stok</th>
								<th>Expired Date</th>
							</tr>
						</thead>
						<tbody id="scroll_data">
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
</div>