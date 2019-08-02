<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Perencanaan Produksi Bulanan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perencanaan Produksi Bulanan </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Perencanaan Produksi Bulanan </span>
					<a href="<?php echo base_url('pembelian/perencanaan_produksi/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perencanaan Produksi Bulanan</a>
					<a href="<?php echo base_url('pembelian/perencanaan_produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Perencanaan Produksi Bulanan</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1">
								<h5 >Kode</h5>
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<h5 >Bulan</h5>
							</div>
							<div class="col-md-5">
								<select name="bulan" id="bulan">
									<option value="">- Pilih Bulan</option>	
									<option value="Januari">Januari</option>	
									<option value="Februari">Februari</option>	
									<option value="Maret">Maret</option>	
									<option value="April">April</option>	
									<option value="Mei">Mei</option>	
									<option value="Juni">Juni</option>	
									<option value="Juli">Juli</option>	
									<option value="Agustus">Agustus</option>	
									<option value="September">September</option>	
									<option value="Oktober">Oktober</option>	
									<option value="November">November</option>	
									<option value="Desember">Desember</option>	
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<h5 >Tahun</h5>
							</div>
							<div class="col-md-5">
								<select name="" id="">
									<option value="">-- Pilih Tahun</option>
									<?php 
									$tahun_skrg = date('Y');
									for ($i=$tahun_skrg; $i >= 1990 ; $i--) { ?>
									<option value="<?= $i ?>"><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-1">
								<button class="btn btn-info btn-no-radius btn-md">LOCK</button>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						<hr><br>
						<div class="row">
							<div class="col-md-3">
								<h5>Nama Produk</h5>
							</div>
							<div class="col-md-2">
								<h5>QTY</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<select name="produk" class="form-control" id="produk">
									<option value="">-- Pilih Produk</option>
								</select>
							</div>
							<div class="col-md-2">
								<input type="number" placeholder="QTY" class="form-control">
							</div>
							<div class="col-md-2">
								<button class="btn btn-success btn-no-radius btn-md"><i class="fa fa-plus"></i> Tambah</button>
							</div>
						</div>
					</div>
					<div class="col-md-8" style="margin-top: 20px;">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<td>#</td>
									<th>Nama</th>
									<th>QTY</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td>1</td>
									<td>Produk</td>
									<td>3</td>
									<td>
										<a href="" class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5">
											<li class="fa fa-pencil"></li>
										</a>
										<button id="menghapus"  class="btn btn-no-radius btn-icon waves-effect waves-light btn-danger m-b-5">
											<li class="fa fa-remove"></li>
										</button>
									</td>   
								</tr>                         
							</tbody>
						</table>
					</div>
					<div class="col-md-8">
						<button class="btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> SIMPAN</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-------------------------------------------------- Modal ---------------------------------------------->
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
		</div>
	</div>
</div>
<!-------------------------------------------------- Modal ---------------------------------------------->


<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}
</script>