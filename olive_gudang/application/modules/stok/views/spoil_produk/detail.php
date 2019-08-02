
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Spoil</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Spoil Produk</h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Spoil </span>
					<a href="<?php echo base_url('stok/spoil_produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Spoil</a>
					<a href="<?php echo base_url('stok/spoil_produk/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Spoil</a>
				</div>
				<?php
				$get_unit=$this->db->get('setting');
				$hasil_unit=$get_unit->row();
				$kode_spoil=$this->uri->segment(4);

				$get_spoil=$this->db->get_where('transaksi_spoil', array('kode_spoil' => $kode_spoil,'kode_unit_jabung' => @$hasil_unit->kode_unit));
				$hasil_spoil=$get_spoil->row();
				?>
				<div class="panel-body">
					<form id="data_form">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-info"><i class="fa fa-barcode"></i> Kode Spoil : <?php echo @$hasil_spoil->kode_spoil;?></a>
								<a class="btn btn-info pull-right"><i class="fa fa-calendar"></i> Tanggal Spoil : <?php echo @TanggalIndo($hasil_spoil->tanggal_spoil);?></a>
								<input type="hidden" name="kode_spoil" id="kode_spoil" value="<?php echo @$kode_spoil;?>">
								<input type="hidden" name="kode_unit" id="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
								<input type="hidden" name="tanggal_spoil" id="tanggal_spoil" value="<?php echo @date('Y-m-d');?>">
							</div>
						</div>
						<br>
						<div class="col-md-12 row">

							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Bahan</th>
										<th>Nama Bahan</th>
										<th>Jumlah Spoil</th>
										<th>Keterangan</th>
									</tr>
								</thead>
								<tbody>  
									<?php

									$this->db->where('kan_suol.opsi_transaksi_spoil.kode_spoil', @$kode_spoil);
									$this->db->where('kan_suol.opsi_transaksi_spoil.kode_unit_jabung', @$hasil_unit->kode_unit);
									$this->db->from('kan_suol.opsi_transaksi_spoil');
									$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_spoil.kode_bahan = kan_master.master_produk.kode_produk','left');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok = kan_master.master_satuan.kode','left');
									$get_opsi_temp=$this->db->get();
									$hasil_opsi_temp=$get_opsi_temp->result();
									$no=1;
									foreach ($hasil_opsi_temp as $opsi) {
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$opsi->kode_bahan;?></td>
											<td><?php echo @$opsi->nama_produk;?></td>
											<td><?php echo @$opsi->jumlah.' '.@$opsi->nama;?></td>
											<td><?php echo @$opsi->keterangan;?></td>
										</tr>
										<?php
									}
									?>  

								</tbody>
							</table>

						</div>
						
					</form>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>

