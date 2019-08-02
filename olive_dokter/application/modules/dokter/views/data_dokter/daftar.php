
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('dokter'); ?>">Dokter</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Dokter </h1>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">List Layanan </span>
					<br><br>
				</div>
				<div class="panel-body">
					<div id="cari_transaksi">
						<table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Transaksi</th>
									<th>Nama Member</th>
									<th>Nama Layanan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="scroll_data">
								<?php
								$this->db->from('olive_cs.transaksi_registrasi');
								$this->db->join('olive_master.master_member','olive_master.master_member.kode_member = olive_cs.transaksi_registrasi.kode_member');
								$this->db->join('olive_master.master_layanan','olive_master.master_layanan.kode_layanan = olive_cs.transaksi_registrasi.kode_layanan');
								$this->db->where('olive_cs.transaksi_registrasi.kode_layanan !=','perawatan');
								$this->db->where('olive_cs.transaksi_registrasi.status','menunggu');
								$this->db->order_by('olive_cs.transaksi_registrasi.id','DESC');
								$get_sapi = $this->db->get()->result();
								$no = 0;
								foreach ($get_sapi as $value) { $no++;
									?> 
									<tr>
										<td><?= $no ?></td>
										<td><?= $value->kode_transaksi ?></td>
										<td><?= $value->nama_member ?></td>
										<td><?= $value->nama_layanan ?></td>


										<td align="center">
											<a href="<?php echo base_url('dokter/data_dokter/tambah/'. $value->kode_transaksi) ?>" class="btn btn-warning btn-no-radius btn-lg"><i class="fa fa-pencil"></i> Proses</a>
										</td>
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

	<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Alert</h4>
				</div>
				<div class="modal-body text-center">
					<h2>Anda yakin akan menghapus data ini?</h2>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>	
		</div>	
	</div>	



	<script type="text/javascript">
		function hapus(key) {
			$('#modal-hapus').modal('show');
		}
	</script>