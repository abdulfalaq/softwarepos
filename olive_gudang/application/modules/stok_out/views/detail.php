
<!-- back button -->
<a href="<?php echo base_url('stok_out'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok_out'); ?>">Stok Out</a></li>
		<li><a href="#">Stok Out</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Detail Stok Out</h1>

	<!-- <?php $this->load->view('menu_master'); ?> -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Stok Out</span>
					<a href="<?php echo base_url('stok_out/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Stok Out</a>
					<a href="<?php echo base_url('stok_out'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Stok Out</a>
				</div>
				<div class="panel-body">
					<form id="data_form">
						<div class="row">
							<div class="col-md-12">
								<a class="btn btn-info"><i class="fa fa-barcode"></i> Kode Stok Out : <?php echo @$hasil_stok_out->kode_stok_out;?></a>
								<a class="btn btn-info pull-right"><i class="fa fa-calendar"></i> Tanggal Stok Out : <?php echo @TanggalIndo($hasil_stok_out->tanggal_input);?></a>
								<input type="hidden" name="kode_stok_out" id="kode_stok_out" value="<?php echo @$kode_stok_out;?>">
								<input type="hidden" name="kode_unit" id="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
								<input type="hidden" name="tanggal_stok_out" id="tanggal_stok_out" value="<?php echo @date('Y-m-d');?>">
							</div>
						</div>
						<br>
						<div class="col-md-12 row">
							<?php 
							$kode = $this->uri->segment(3);
							$this->db->from('clouoid1_olive_gudang.opsi_transaksi_stok_out');
							$this->db->where('clouoid1_olive_gudang.opsi_transaksi_stok_out.kode_stok_out',$kode);
							$get_gudang = $this->db->get()->result();
							?>
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Bahan Baku</th>
										<th>Nama Bahan Baku</th>
										<th>Jumlah Stok Out</th>
									</tr>
								</thead>
								<tbody>  
									<?php

									// $this->db->where('kan_suol.opsi_transaksi_stok_out.kode_stok_out', @$kode_stok_out);
									// $this->db->where('kan_suol.opsi_transaksi_stok_out.kode_unit_jabung', @$hasil_unit->kode_unit);
									// $this->db->from('kan_suol.opsi_transaksi_stok_out');
									// $this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_stok_out.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku','left');
									// $this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_stok = kan_master.master_satuan.kode','left');
									// $get_opsi_temp=$this->db->get();
									// $hasil_opsi_temp=$get_opsi_temp->result();
									// $no=1;
									?> 
									<?php 
									$no = 0;
									foreach ($get_gudang as $value) { 
										$no++; 
										if ($value->jenis_item == 'Perlengkapan') {
											$get_perlengkapan = $this->db->get_where('clouoid1_olive_gudang.opsi_transaksi_stok_out',array('kode_bahan_baku' => $value->kode_bahan_baku ))->row(); 
											$nama_bahan = $get_perlengkapan->kode_bahan_baku;

										}else{
											$get_bahan = $this->db->get_where('clouoid1_olive_master.master_bahan_baku',array('kode_bahan_baku' => $value->kode_bahan_baku ))->row(); 
											$nama_bahan = @$get_bahan->nama_bahan_baku;
										}
										?>
										<tr>
											<!-- <td><?php echo $no++;?></td>
											<td><?php echo @$opsi->kode_bahan_baku;?></td>
											<td><?php echo @$opsi->nama_bahan_baku;?></td>
											<td><?php echo @$opsi->jumlah.' '.@$opsi->nama;?></td> -->
											<td><?= $no ?></td>
											<td><?= $value->kode_bahan_baku ?></td>
											<td><?= $nama_bahan ?></td>
											<td><?= $value->jumlah ?></td>
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

