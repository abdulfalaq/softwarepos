<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Record Transaksi Member</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Record Transaksi Member</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span style="font-size: 24px">Data Record Transaksi </span>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-striped" id="datatable">
									<thead>
										<tr>
											<th>NO</th>
											<th>Kode Member</th>
											<th>Nama Member</th>
											<th>Alamat</th>
											<th>Telepon</th>
											<th>Keterangan</th>
											<th>Status</th>
											<th>Kategori Member</th>
										</tr>
									</thead>
									<?php 
									$this->db_master->where('kategori_member','Member Konsinyasi');
									$this->db_master->order_by('id','DESC');
									$get_member = $this->db_master->get('master_member')->result();
									?>
									<tbody>
										<?php 
										$no = 0;
										foreach ($get_member as $value) { $no++; ?>
										<tr>
											<th><?php echo $no ?></th>
											<th><?php echo $value->kode_member ?></th>
											<th><?php echo $value->nama_pic ?> - <?php echo $value->nama_perusahaan ?></th>
											<th><?php echo $value->alamat_perusahaan ?></th>
											<th><?php echo $value->telp_pic ?></th>
											<th><?php echo $value->keterangan ?></th>
											<th><?php echo $value->kategori_member ?></th>
											<td>
												<a href="<?= base_url('penjualan/member_konsinyasi/get_detail_record/'.$value->kode_member) ?>" class="btn btn-info btn-no-radius"><i class="fa fa-search"></i> Record Transaksi</a>
											</td>
										</tr>
										<?php }
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
</div>
