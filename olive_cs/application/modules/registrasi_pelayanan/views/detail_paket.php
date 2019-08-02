<!-- back button -->
<a href="<?php echo base_url('registrasi_pelayanan/layanan_paket'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('kasir/pendaftaran_layanan'); ?>">Reservasi</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail</span>
					<br><br>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<?php 
					$id=$this->uri->segment(4);
					$this->db->from('olive_cs.transaksi_reservasi');
					$this->db->join('olive_master.master_member','master_member.kode_member = olive_cs.transaksi_reservasi.kode_member', 'left');
					$this->db->where('olive_cs.transaksi_reservasi.kode_reservasi',$id);
					$get_gudang = $this->db->get()->row();
					?>
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<label><h3><b>Detail Transaksi</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Transaksi</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->kode_reservasi ?>" class="form-control" placeholder="Kode Transaksi" name="kode_reservasi" id="kode_reservasi" />
									</div>
									<div class="form-group">
										<label class="gedhi">Kode Customer</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->kode_member ?>" class="form-control"/>
									</div>
									<div class="form-group">
										<label>Jenis Reservasi</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->jenis_reservasi ?>" class="form-control"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Tanggal Transaksi</label>
										<input type="text" value="<?php echo $get_gudang->tanggal_transaksi ?>" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_transaksi" id="tanggal_transaksi"/>
									</div>
									<div class="form-group">
										<label>Nama Customer</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->nama_member ?>" class="form-control" placeholder="Nota Referensi" name="nama_member" id="nama_member" />
									</div>
								</div>
							</div>
						</div> 
						<div id="list_transaksi_reservasi">
							<div class="box-body">
								<?php
								$id=$this->uri->segment(4);
								$this->db->from('olive_cs.opsi_transaksi_reservasi');
								$this->db->join('olive_master.master_perawatan','master_perawatan.kode_perawatan = olive_cs.opsi_transaksi_reservasi.kode_item', 'left');
								$this->db->join('olive_master.master_produk','master_produk.kode_produk = olive_cs.opsi_transaksi_reservasi.kode_item', 'left');
								$this->db->where('olive_cs.opsi_transaksi_reservasi.kode_reservasi',$id);
								$get_gudang = $this->db->get()->result();
								?>
								<table id="datatable" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th>Nama</th>
											<th>Qty</th>
											<th>Qty Diambil</th>
											<th>Qty Sisa</th>
										</tr>
									</thead>
									<tbody id="tabel_temp_data_transaksi">
										<?php 
										$no = 0;
										foreach ($get_gudang as $value) { 
											$no++; ?>
											<tr>
												<td><?php echo $no ?></td>
												<td><?php echo $value->kode_item ?></td>
												<th><?php echo $value->nama_perawatan; echo $value->nama_produk ?></th>
												<th><?php echo $value->qty_item ?></th>
												<th><?php echo $value->qty_diambil ?></th>
												<th><?php echo $value->qty_sisa ?></th>
											</tr>
											<?php 
										} 
										?>
									</tbody>
									<tfoot>

									</tfoot>
								</table>
							</div>
						</div><br>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

