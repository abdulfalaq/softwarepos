<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Piutang</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Piutang </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Piutang </span>
					<a href="<?php echo base_url('penjualan/piutang/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Umum</a>
					<a href="<?php echo base_url('penjualan/piutang/daftar_konsinyasi'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Piutang Konsinyasi</a>
				</div>

				<?php
				$get_setting=$this->db->get('setting');
				$hasil_setting=$get_setting->row();
				$kode_unit_jabung=@$hasil_setting->kode_unit;
				$kode_member=$this->uri->segment(4);
				?>
				<div class="panel-body">
					
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal Transaksi</th>
									<th>Kode Transaksi</th>
									<th>Nominal Piutang</th>
									<th>Tanggal Jatuh Tempo</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody id="data_opsi_perencanaan">
								<?php
								$this->db_kasir->where('kode_member', $kode_member);
								$this->db_kasir->where('kode_unit_jabung', $kode_unit_jabung);
								$get_piutang = $this->db_kasir->get('transaksi_piutang');
								$hasil_piutang = $get_piutang->result();
								if (count($hasil_piutang) <= 0) { ?>
									<tr class="text-center">
										<td colspan="7"><h5>Data Kosong</h5></td>
									</tr>
								<?php }
								$no=1;
								foreach ($hasil_piutang as $piutang) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo tanggalIndo(@$piutang->tanggal_transaksi);?></td>
										<td><?php echo @$piutang->kode_piutang;?></td>
										<td align="right"><?php echo format_rupiah(@$piutang->sisa);?></td>
										<td><?php echo tanggalIndo(@$piutang->tanggal_jatuh_tempo);?></td>
										<td><?php echo cek_status_piutang(@$piutang->sisa);?></td>
										<td>
											<a href="<?= base_url('penjualan/piutang/detail_pertransaksi/'.$kode_member.'/'.$piutang->kode_piutang); ?>" class="btn btn-success btn-sm btn-no-radius"><i class="fa fa-search"></i> Detail</a>
											<a href="<?= base_url('penjualan/piutang/angsur/'.$kode_member.'/'.$piutang->kode_piutang); ?>" class="btn btn-info btn-sm btn-no-radius">Angsur</a>
											
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
