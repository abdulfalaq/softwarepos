<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="#">Buka Kasir</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">List Transaksi Hari Ini</span>
					<br><br>
				</div>
				<div class="panel-body">    
					<div class="row">
						<div class="col-md-4">
							<label>Tanggal Awal</label>
							<input type="date" name="tgl_awal" id="tgl_awal" class="form-control">
						</div>
						<div class="col-md-4">
							<label>Tanggal Akhir</label>
							<input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control">
						</div>
						<div class="col-md-1">
							<button class="btn btn-primary" onclick="cari_list_filter()" style="margin-top: 25px;"><i class="fa fa-search"></i></button>
						</div>
					</div>
					<br>

					<div class="box-body" id="list_filter">            
						<div class="sukses" ></div>
						<table class="table table-striped table-hover table-bordered" id="tabel_daftar">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal Transaksi</th>
									<th>Kode Transaksi</th>
									<th>Nama Member</th>
									<th>Nama Layanan</th>
									<th>Grand Total </th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="scroll_data">
							</tbody>
						</table>

						<br><br>
						<input type="hidden" class="form-control rowcount" value="1">
						<input type="hidden" class="form-control pagenum " value="0">
					</div>
				</div>
			</div>
		</div><!-- /.col -->
	</div>
</div>
