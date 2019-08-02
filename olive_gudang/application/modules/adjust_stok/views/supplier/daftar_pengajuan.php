<!-- back button -->
<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Supplier</a></li>
		<li><a href="#">Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Supplier </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Pengajuan Supplier </span>
					<a href="<?php echo base_url('pembelian/supplier/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Pengajuan supplier</a>
					<a href="<?php echo base_url('pembelian/supplier/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pengajuan supplier</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="col-md-12" style="margin-top: 20px;">
							<table id="datatable" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>Kategori Supplier</th>
										<th>Tanggal</th>
										<th>Pengajuan Supplier</th>
										<th width="5%">Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$this->db_keuangan->order_by('id', 'desc');
									$get_pengajuan=$this->db_keuangan->get('pengajuan_supplier');
									$hasil_pengajuan=$get_pengajuan->result();
									$no=1;
									foreach ($hasil_pengajuan as $pengajuan) {
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$pengajuan->kode_supplier;?></td>
											<td><?php echo @$pengajuan->nama_supplier;?></td>
											<td><?php echo @$pengajuan->kategori_supplier;?></td>
											<td><?php echo @TanggalIndo($pengajuan->tanggal_pengajuan);?></td>
											<td><?php echo @$pengajuan->pengajuan_supplier;?></td>
											<td>
												<a href="<?php echo base_url().'pembelian/supplier/detail_pengajuan/'.@$pengajuan->id;?>" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5">
													<li class="fa fa-eye"></li>
												</a>
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

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Confirmasi</h4>
			</div>
			<div class="modal-body">
				<h3>Apakah anda yakin ingin menyimpan data tersebut ?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-no-radius btn-md" data-dismiss="modal">Cancel</button>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="simpan_pengajuan()" >Yakin</a>
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
