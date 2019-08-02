<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Perencanaan Produksi Bulanan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perencanaan Produksi Bulanan </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Perencanaan Produksi Bulanan </span>
					<a href="<?php echo base_url('pembelian/perencanaan_produksi/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perencanaan Produksi Bulanan</a>
					<a href="<?php echo base_url('pembelian/perencanaan_produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Perencanaan Produksi Bulanan</a>
				</div>
				<?php
				$get_setting=$this->db->get('setting');
				$hasil_setting=$get_setting->row();
				$kode_unit_jabung=@$hasil_setting->kode_unit;
				$kode_perencanaan=$this->uri->segment(4);

				$get_perencanaan=$this->db->get_where('perencanaan_produksi',array('kode_perencanaan' =>$kode_perencanaan));
				$hasil_perencanaan=$get_perencanaan->row();

				?>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1">
								<h5 >Kode</h5>
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control" kode='kode_perencanaan' id="kode_perencanaan" value="<?php echo @$kode_perencanaan;?>" readonly>
								<input type="hidden" id="kode_unit_jabung" value="<?php echo @$kode_unit_jabung;?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<h5 >Bulan</h5>
							</div>
							<div class="col-md-5">
								<input type="" name="" readonly="" class="form-control" value="<?php echo @BulanIndo($hasil_perencanaan->bulan)?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<h5 >Tahun</h5>
							</div>
							<div class="col-md-5">
								<input type="" name="" readonly="" class="form-control" value="<?php echo @$hasil_perencanaan->tahun?>">
							</div>
							
						</div>
					</div>
					<div class="clearfix"></div>
					<hr>
					<br>
					<div class="col-md-8" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>QTY</th>
									
								</tr>
							</thead>

							<tbody id="data_opsi_perencanaan">
								<?php
								
								$this->db->where('kan_suol.opsi_perencanaan_produksi.kode_perencanaan', $kode_perencanaan);
								$this->db->from('kan_master.master_produk');
								$this->db->join('kan_suol.opsi_perencanaan_produksi', 'kan_suol.opsi_perencanaan_produksi.kode_produk = kan_master.master_produk.kode_produk ');
								$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode ');
								$get_opsi_perencanaan = $this->db->get();
								$hasil_opsi_perencanaan=$get_opsi_perencanaan->result();
								$no=1;
								foreach ($hasil_opsi_perencanaan as $opsi) {
									?>
									<tr>
										<td><?php echo $no++;?></td>
										<td><?php echo @$opsi->nama_produk;?></td>
										<td><?php echo @$opsi->qty.' '.@$opsi->nama;?></td>
										
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
