
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Paket</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Paket </span>
					<a href="<?php echo base_url('setting/paket/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/paket/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-5">
									<label><b>Kode paket</label>

										<input required name="kode_paket" value="PKT2108" readonly="true" type="text" class="form-control" id="kode_paket"/>
									</div>
									<div class="form-group  col-xs-5">
										<label class="gedhi"><b>Nama paket</label>
											<input readonly="" required value="Paket  B" type="text" class="form-control" name="nama_paket" />
										</div>
										<div class="form-group  col-xs-5">
											<label class="gedhi"><b>Harga Paket </label>
												<input required type="number" readonly="" class="form-control" name="harga_paket" value="550000" />
											</div>

											<div class="form-group  col-xs-5">

												<label class="gedhi"><b>Status</label>
													<select disabled="" required class="form-control stok select2" name="status">

														<option value="">--Pilih Status--</option>
														<option selected value="1" >Aktif</option>
														<option  value="0" >Nonaktif</option>
													</select> 
												</div>


											</div>
											<div class="box-body">
												<table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1em;">
													<thead>
														<tr>
															<th>No</th>
															<th>Kode Paket</th>
															<th>Jenis Produk</th>
															<th>Kode Produk</th>
															<th>Nama Produk</th>
															<th>QTY Produk</th>
														</tr>
													</thead>
													<tbody id="scroll_data">

														<tr>
															<td>1</td>
															<td>PKT2108</td>
															<td>treatment</td>
															<td>TRT_101017102550_1</td>
															<td>Body Massage</td>
															<td>2</td>
														</tr>

													</tbody>
													<tfoot>

													</tfoot>
												</table>
											</div>
											<div class="box-footer">

											</div>
										</div>
									</form>

								</div>
							</div>
						</div>
