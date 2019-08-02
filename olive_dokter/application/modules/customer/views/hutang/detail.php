<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Hutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Hutang </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Hutang </span>
					<a href="<?php echo base_url('pembelian/hutang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Hutang</a>
				</div>
				
				<?php
				$get_setting=$this->db->get('setting');
				$hasil_setting=$get_setting->row();
				$kode_unit_jabung=@$hasil_setting->kode_unit;
				$kode_supplier=$this->uri->segment(4);
				?>
				<div class="panel-body">					
					<div class="col-md-12" style="margin-top: 20px;">
					
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal Transaksi</th>
									<th>Kode Transaksi</th>
									<th>Nominal Hutang</th>
									<th>Tanggal Jatuh Tempo</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody id="data_opsi_perencanaan">
								<?php
								$this->db_kasir->where('kode_supplier', $kode_supplier);
								$this->db_kasir->where('kode_unit_jabung', $kode_unit_jabung);
								$get_hutang = $this->db_kasir->get('transaksi_hutang');
								$hasil_hutang = $get_hutang->result();
								if (count($hasil_hutang) <= 0) { ?>
								<tr class="text-center">
									<td colspan="7"><h5>Data Kosong</h5></td>
								</tr>
								<?php }
								$no=1;
								foreach ($hasil_hutang as $hutang) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo tanggalIndo(@$hutang->tanggal_transaksi);?></td>
										<td><?php echo @$hutang->kode_hutang;?></td>
										<td align="right"><?php echo format_rupiah(@$hutang->sisa);?></td>
										<td><?php echo tanggalIndo(@$hutang->tanggal_jatuh_tempo);?></td>
										<td><?php echo cek_status_piutang(@$hutang->sisa);?></td>
										<td>
											<a href="<?= base_url('pembelian/hutang/detail_pertransaksi/'.$kode_supplier.'/'.paramEncrypt($hutang->kode_hutang)); ?>" class="btn btn-success btn-sm btn-no-radius"><i class="fa fa-search"></i> Detail</a>
											
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
