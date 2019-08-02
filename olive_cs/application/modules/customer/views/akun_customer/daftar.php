

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('customer'); ?>">Customer</a></li>
		<li><a href="#">Akun Customer</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun Customer</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span  style="font-size: 24px">Data Akun Cusotmer</span>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Nama Customer</label>
						<input type="text" class="form-control" id="nama_member" />
						<input type="hidden" class="form-control" id="kode_member" value="" />
					</div>
				</div>

				<div class="col-md-3">
					<a onclick="cari_produk()" style="margin-top: 25px;" class="btn btn-primary green-seagreen"><i class="fa fa-search"></i> Cari</a>

				</div>
				<br>
				<br>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="box-body">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Kode Customer</th>
										<th>Nama Customer</th>
										<th>Alamat Customer</th>
										<th>Telepon</th>
										<th width="220px">Action</th>
									</tr>
								</thead>
								<tbody id="scroll_data">
									<tr>                <td>1</td>
										<td>20171010001</td>                  
										<td>Arda</td>                  
										<td>Malang</td>
										<td><span class="label label-info">AKTIF</span></td>
										<td align="center"><a href="<?php echo base_url('customer/akun_customer/detail'); ?>"class="btn btn-primary btn-lg"><i class="fa fa-eye"></i> Detail</a></td>
									</tr>
								</tbody>                
							</table>
							<input type="hidden" class="form-control rowcount" value="0">
							<input type="hidden" class="form-control pagenum " value="0">

						</div>

						<!------------------------------------------------------------------------------------------------------>

					</div>
				</div>
			</div><!-- /.col -->
		</div>
	</div>    
</div>  

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menghapus data bahan baku tersebut ?</span>
				<input id="id-delete" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn green" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button onclick="delData()" class="btn red">Ya</button>
			</div>
		</div>
	</div>
</div>
