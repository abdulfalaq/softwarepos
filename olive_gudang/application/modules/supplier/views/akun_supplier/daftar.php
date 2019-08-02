

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Suplier</a></li>
		<li><a href="#">Akun Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Akun Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Akun Supplier</span>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="box-body">            
							<div class="sukses" ></div>
							<?php 
							$this->db->order_by('id','DESC');
							$get_gudang = $this->db->get('olive_master.master_supplier')->result();
							?>
							<table class="table table-striped table-hover table-bordered" id="datatable">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>No.Telp</th>
										<th>Nama PIC</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="scroll_data">
									<?php 
									$no = 0;
									foreach ($get_gudang as $value) { 
										$no++; ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $value->kode_supplier ?></td>
											<td><?= $value->nama_supplier ?></td>
											<td><?= $value->telp_supplier ?></td>
											<td><?= $value->nama_pic ?></td>
											<td><?php if($value->status_supplier == 1){
												echo ('Aktif');
											}else {
												echo ('Tidak Aktif');
											}
											?></td>
											<td align="center">
												<a href="<?php echo base_url('supplier/akun_supplier/detail/'.$value->kode_supplier ) ?>" class="btn btn-primary btn-lg"><i class="fa fa-eye"></i> Detail</a>
											</td>
										</tr>
										<?php 
									} 
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>    
</div>
<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>