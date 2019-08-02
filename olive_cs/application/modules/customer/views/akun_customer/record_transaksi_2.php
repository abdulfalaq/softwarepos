

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
	<h1>Record Transaksi Customer</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Record Transaksi Customer (Treatment)</span>
					<a href="<?php echo base_url('customer/akun_customer/record_transaksi'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-plus"></i> Record Transaksi Customer (Produk)</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="box-body">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="50px;">No</th>
										<th>Kode Transaksi</th>
										<th>Layanan</th>
										<th>Jenis Item</th>
										<th>Nama Item</th>
										<th>Kode Item</th>
										<th>Qty</th>
										<!-- <th width="220px">Action</th> -->
									</tr>
								</thead>
								<tbody id="scroll_data">

									<tr>                <td>1</td>
										<td>LYN_131117093010_1</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>Acne Treatment</td>                    
										<td>TRT_101017154024_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>2</td>
										<td>LYN_131117093010_1</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>potong kuku</td>                    
										<td>TRT_101017153319_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>3</td>
										<td>LYN_141117150243_4</td>                  
										<td>Konsul</td>
										<td>treatment</td>                  
										<td>Acne Treatment</td>                    
										<td>TRT_101017154024_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>4</td>
										<td>LYN_081217151831_3</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>Body Massage</td>                    
										<td>TRT_101017102550_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>5</td>
										<td>LYN_081217151831_3</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>Acne Treatment</td>                    
										<td>TRT_101017154024_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>6</td>
										<td>LYN_161117192315_1</td>                  
										<td>Konsul</td>
										<td>treatment</td>                  
										<td>Acne Treatment</td>                    
										<td>TRT_101017154024_1</td>                     
										<td>2</td>

									</tr>
									<tr>                <td>7</td>
										<td>LYN_150118130800_7</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>Acne Treatment</td>                    
										<td>TRT_101017154024_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>8</td>
										<td>LYN_170118084719_1</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>Body Massage</td>                    
										<td>TRT_101017102550_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>9</td>
										<td>LYN_170118084719_1</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>Acne Treatment</td>                    
										<td>TRT_101017154024_1</td>                     
										<td>1</td>

									</tr>
									<tr>                <td>10</td>
										<td>PKT_290118143923_3</td>                  
										<td>Treatment</td>
										<td>treatment</td>                  
										<td>Body Massage</td>                    
										<td>TRT_101017102550_1</td>                     
										<td>1</td>

									</tr>
								</tbody>                
							</table>
							<input type="hidden" class="form-control rowcount" value="0">
							<input type="hidden" class="form-control" value="20171010001" id="kode_member">
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
