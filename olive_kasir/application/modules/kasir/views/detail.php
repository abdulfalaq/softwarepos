<!-- back button -->
<a href="<?php echo base_url('kasir/layanan_paket'); ?>"><button class="button-back"></button></a>
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
					$this->db->from('olive_cs.transaksi_order_paket');
					$get_gudang = $this->db->get()->row();
					?>
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<label><h3><b>Detail Transaksi</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Transaksi</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->kode_transaksi ?>" class="form-control" placeholder="Kode Transaksi" name="kode_transaksi" id="kode_transaksi" />
									</div>
									<div class="form-group">
										<label class="gedhi">Kode Customer</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->kode_member ?>" class="form-control"/>
									</div>
									<div class="form-group">
										<label>ID Petugas</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->id_petugas ?>" class="form-control"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Tanggal Transaksi</label>
										<input type="text" value="<?php echo $get_gudang->tanggal_transaksi ?>" readonly="true" class="form-control" placeholder="Tanggal Transaksi" name="tanggal_transaksi" id="tanggal_transaksi"/>
									</div>
									<div class="form-group">
										<label>Status</label>
										<input readonly="true" type="text" value="<?php echo $get_gudang->status ?>" class="form-control" placeholder="Nota Referensi" name="status" id="status" />
									</div>
								</div>
							</div>
						</div> 
						<div id="list_transaksi_reservasi">
							<div class="box-body">
								<?php
								$id=$this->uri->segment(4);
								$this->db->from('olive_cs.opsi_transaksi_order_paket');
								$get_gudang = $this->db->get()->result();
								?>
								<table id="datatable" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th>Jenis</th>
											<th>Qty</th>
											<th>HPP</th>
											<th>Harga</th>
										</tr>
									</thead>
									<tbody id="tabel_temp_data_transaksi">
										<?php 
										$no = 0;
										foreach ($get_gudang as $value) { 
											$no++; ?>
											<tr>
												<td><?php echo $no ?></td>
												<td><?php echo $value->kode_transaksi ?></td>
												<th><?php echo $value->jenis_item ?></th>
												<th><?php echo $value->qty ?></th>
												<th><?php echo $value->hpp ?></th>
												<th><?php echo $value->harga ?></th>
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

