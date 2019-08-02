
<a href="<?php echo base_url('laporan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('laporan'); ?>">Laporan</a></li>
		<li><a href="#">Laporan New Member</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Laporan</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<br>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Laporan New Member</span>
					<br>
					<br>
				</div>
				<div class="panel-body">
					<div class="row">
						<button style="margin-right: 15px" type="button" id="cetak_penjualan" class="btn btn-no-radius btn-info pull-right"><i class="fa fa-print"></i> Print</button>
					</div>
					<br>
					<br>
					<div id="load_table">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="50px;">No</th>
									<th>Kode Member</th>
									<th width="133px;">Nama Member</th>
								</tr>
							</thead>
							<tbody id="cari_transaksi">
								<?php 
								$no=0;
								$this->db->from('olive_master.master_member');
								$this->db->where('tanggal_registrasi', date('Y-m-d'));
								$this->db->order_by('id','DESC');
								$get_data = $this->db->get()->result();
								foreach ($get_data as  $value) { $no++;?>
								<tr>
									<td><?php echo $no++ ?></td>
									<td><?php echo $value->kode_member ?></td>
									<td><?php echo $value->nama_member ?></td>
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
