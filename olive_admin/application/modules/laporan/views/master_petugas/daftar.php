

<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Pengadaan asset</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pembelian</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Data Aktifitas</span>
					<a href="<?php echo base_url('pembelian/master_petugas/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('pembelian/master_petugas/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="sukses" ></div>
						<table class="table table-striped table-hover table-bordered" id="tabel_daftar"  style="font-size:1.0em;">
							<thead>
								<tr>
									<th width="50px;">No</th>
									<th>ID Petugas</th>
									<th>Nama Petugas</th>
									<th>Wilayah</th>
									<th>Status</th>
									<th width="133px;">Action</th>
								</tr>
							</thead>
							<tbody>

								<tr>
									<td>1</td>
									<td>PE001</td>
									<td>Ryan</td>
									<td>as|Pos 1|</td>
									<td><span class="label label-success">Aktif</span></td>
									<td>
										<div class="btn-group">
											<a href="<?php echo base_url('pembelian/master_petugas/detail'); ?>" key="1" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i></a>
											<a href="<?php echo base_url('pembelian/master_petugas/edit'); ?>" key="1" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"></i></a>
											<a key="1" data-toggle="tooltip" title="Delete" id="hapus" class="btn btn-icon-only btn-circle red"><i class="fa fa-trash"></i> </a>
										</div>
									</td>
								</tr>

							</tbody>                
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>  
</div>    
