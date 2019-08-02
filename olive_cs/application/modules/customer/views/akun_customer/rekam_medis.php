

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
					<span  style="font-size: 24px">Customer</span>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="box-body">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Kode Transaksi</th>
										<th>Kode Customer</th>
										<th>Nama Customer</th>
										<th>Kode Dokter</th>
										<th>Nama Dokter</th>
										<th>Keluhan</th>
										<th>Anamnesa</th>
										<th>Pemeriksaan Awal</th>
										<th>Diagnosa</th>
										<!-- <th width="220px">Action</th> -->
									</tr>
								</thead>
								<tbody id="scroll_data">

									<tr>                <td>1</td>
										<td>LYN_141117150243_4</td>                  
										<td>20171010001</td>                  
										<td>Arda</td>
										<td>K_0002</td>                  
										<td>Dea Resita</td>                    
										<td>wajah berjerawat</td>
										<td>pemberian facial acne treatment</td>
										<td>cek jenis kulit</td>
										<td>-</td>

									</tr>
									<tr>                <td>2</td>
										<td>LYN_161117192315_1</td>                  
										<td>20171010001</td>                  
										<td>Arda</td>
										<td>K_0001</td>                  
										<td>Nadia Safira</td>                    
										<td></td>
										<td>wajah beruntusan</td>
										<td></td>
										<td>wajah beruntusan</td>

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
