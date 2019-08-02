
<!-- back button -->
<a href="<?php echo base_url('registrasi_pelayanan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="clearfix"></div>
<br>
<div class="container">
	<div class="page-content">
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 24px">Detail </span>
						<br><br>
					</div>
					<div class="panel-body">
						<?php 
						$kode_transaksi=$this->uri->segment(3);
						if ($kode_transaksi == 'detail') {
							$kode_transaksi=$this->uri->segment(4);
						}
						$this->db->from('olive_cs.transaksi_registrasi');
						$this->db->join('olive_master.master_member','master_member.kode_member = olive_cs.transaksi_registrasi.kode_member', 'left');
						$this->db->join('olive_master.master_layanan','master_layanan.kode_layanan = olive_cs.transaksi_registrasi.kode_layanan', 'left');
						$this->db->where('olive_cs.transaksi_registrasi.kode_transaksi', $kode_transaksi);
						$data_periksa = $this->db->get()->row(); 
						?>
						<form id="data_form" method="post">
							<div class="box-body">            
								<div class="row">
									<div class="form-group  col-xs-6">
										<label><b>Kode Transaksi</b></label>
										<input required name="kode_transaksi" value="<?php echo $data_periksa->kode_transaksi ?>" readonly="true" type="text" class="form-control" id="kode_transaksi"/>
									</div>
									<div class="form-group  col-xs-6">
										<label class="gedhi"><b>Tanggal Transaksi</b></label>
										<input type="date" name="date" class="form-control" value="<?php echo $data_periksa->tanggal_transaksi ?>" style="background-color: #eee">
									</div>
									<div class="form-group  col-xs-6">
										<label class="gedhi"><b>Nama Customer</b></label>
										<input readonly="" required value="<?php echo $data_periksa->nama_member ?>" type="text" class="form-control" name="nama_bahan_baku" />
									</div>
									<div class="form-group  col-xs-6">
										<label class="gedhi"><b>Nama Layanan</b></label>
										<input  readonly="" required type="text" class="form-control" name="stok_minimal" value="<?php echo $data_periksa->nama_layanan ?>" />
									</div>
									<hr>
									<div class="col-xs-12">
										<hr>
										<div id="bottom" class="row">
											<div class="sukses" ></div>
											<div id="list_transaksi_pembelian">
												<div class="box-body col-xs-12">
													<?php 
													$this->db->from('opsi_transaksi_registrasi tr');
													$this->db->join('olive_master.master_perawatan mp','mp.kode_perawatan = tr.kode_item','left');
													$this->db->join('olive_master.master_produk mpr','mpr.kode_produk = tr.kode_item','left');
													$this->db->where('tr.kode_transaksi',$kode_transaksi);
													$this->db->order_by('tr.id','DESC');
													$data_periksa = $this->db->get()->result(); 		
													?>
													<table id="tabel_daftar" class="table table-bordered table-striped">
														<thead>
															<tr>
																<th>No</th>
																<th>Nama Item</th>
																<th>Qty</th>
															</tr>
														</thead>
														<tbody id="data_temp">
															<?php 
															$no = 0;
															foreach ($data_periksa as $value) { 
																$no++; ?>
																<tr>
																	<td><?php echo @$no ?></td>
																	<td><?php echo @$value->nama_perawatan; echo @$value->nama_produk ?></td>
																	<td><?php echo @$value->qty ?></td>
																</tr>
																<?php
															}
															?>
														</tbody>
														<tfoot>

														</tfoot>
													</table>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="box-footer">

								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>