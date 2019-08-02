<style>
	body{
		background-color: #e4feff;
	}
	.box-pannel{
		padding: 5px !important;
		padding-left: 15px !important;
		padding-right: 10px !important;
		box-shadow: 0px 2px 6px grey;
	}
</style>

<a href="<?php echo base_url('kasir/tambah_kasir'); ?>"><button class="button-back"></button></a>

<div class="clearfix"></div>

<div class="container">
	<div class="clearfix"></div>
	<div style="width:250px;color:white;background-color:#ff22a2;padding:8px;margin-bottom:15px;margin-top:20px;box-shadow:0px 2px 8px grey;text-align:center">
		<h4>Data Reservasi</h4>
	</div>
	<div class="row">
		<div class="col-sm-12 ">
			<div class="panel panel-default">
				<div class="panel-body box-pannel">    
					<br>
					<div class="box-body" id="list_filter">            
						<div class="sukses" ></div>
						<?php 
						$this->db->order_by('olive_cs.transaksi_order_paket.id', 'desc');
						$this->db->where('status', 'proses');
						$this->db->from('olive_cs.transaksi_order_paket');
						$this->db->join('olive_master.master_member', 'olive_cs.transaksi_order_paket.kode_member = olive_master.master_member.kode_member', 'left');
						$get_gudang = $this->db->get()->result();
						
						?>
						<table class="table table-striped table-hover table-bordered" id="datatable">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Kode Member</th>
									<th>Nama Member</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="scroll_data">
								<?php 
								$no = 0;
								foreach ($get_gudang as $value) { 
									$no++; ?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $value->kode_transaksi ?></td>
										<td><?= $value->kode_member ?></td>
										<td><?= $value->nama_member ?></td>
										<td>
											<div class="btn-group">
												<a href="<?php echo base_url ('kasir/layanan_paket/detail/'.$value->kode_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-success btn-circle green"><i class="fa fa-search"></i> </a>
												<a href="<?php echo base_url ('kasir/order_paket/proses/'.$value->kode_transaksi) ?>" data-toggle="tooltip" title="Proses" class="btn btn-primary btn-circle"><i class="fa fa-money"></i> </a>
											</div>
										</td>
									</tr>
									<?php 
								} 
								?>
							</tbody>
						</table>
						<br><br>
						<input type="hidden" class="form-control rowcount" value="1">
						<input type="hidden" class="form-control pagenum " value="0">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
