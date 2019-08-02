

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Supplier</a></li>
		<li><a href="#">Pendaftaran Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pendaftaran Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Pendaftaran Supplier</span>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>Kode Supplier</label>
									<input type="hidden" name="id" value="" />
									<input  type="text" class="form-control" value="" name="kode_supplier" id="kode_supplier" />
								</div>
								<div class="form-group  col-xs-6">
									<label>Nama PIC</label>
									<input type="text"  class="form-control" value=""  name="nama_pic" id="nama_pic" />
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>Nama Supplier</label>
									<input type="text"  class="form-control" value=""  name="nama_supplier" id="nama_supplier" />
								</div>
								<div class="form-group  col-xs-6">
									<label>No Telp PIC</label>
									<input type="hidden" name="id" id="id" />
									<input type="text"  class="form-control" value=""  name="telp_pic" id="telp_pic" />
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>No Telp Supplier</label>
									<input type="text"  class="form-control" value=""  name="telp_supplier" id="telp_supplier" />
								</div>
								<div id="div-status-member" class="input_status_supplier form-group  col-xs-6">
									<label>Status Supplier</label>
									<div class="">
										<select class="form-control" id="status_supplier" name="status_supplier">
											<option selected value="" >Pilih</option>
											<option  value="1">Aktif</option>
											<option  value="0">Tidak Aktif</option>
										</select>
									</div>
								</div>
								<div class="box-footer">
									<button type="submit"  style="float: right;margin-right: 15px" class="btn btn-primary" id='btn_simpan'>Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Tambah Supplier</span>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<table id="tabel_daftar" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>No.Telp</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="scroll_data">
									<tr>
										<td>1</td>
										<td>SP0004</td>
										<td>pak men</td>
										<td>12345</td>
										<td><span class="label label-info">AKTIF</span></td>
										<td align="center">
											<div class="btn-group">
												<a onclick="actEdit('4')" style="background-color: #af8c38;color:white" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"></i></a>
												<a onclick="actDelete('4')" style="background-color: #cb5a5e;color:white" data-toggle="tooltip" title="Delete" class="btn btn-icon-only btn-circle red"><i class="fa fa-remove"></i></a>
											</div>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>No.Telp</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
