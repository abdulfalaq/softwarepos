<style>
.loader {
	border: 2px solid #d1d1d1;
	border-top: 2px solid grey;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	margin: 0px auto;
	animation: spin 2s linear infinite;
	margin-top: 6px;
}

@keyframes spin {
	0% { transform: rotate(0deg); }
	100% { transform: rotate(360deg); }
}

.page_loader {
	width: 86%;
	height: 100%;
	background:rgba(255, 255, 255, 0.77);
	z-index: 99;
	position: absolute;
	text-align: center;
	display: none;
}
</style>

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Barang Dalam Proses</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>
<div class="container">
	<h1>Master Barang Dalam Proses </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail Barang Dalam Proses </span>
					<a href="<?php echo base_url('master/barang_dalam_proses/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Barang Dalam Proses</a>
					<a href="<?php echo base_url('master/barang_dalam_proses/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Barang Dalam Proses</a>
				</div>
				<?php
				$kode_barang=$this->uri->segment(4);
				$get_barang=$this->db2->get_where('master_barang_dalam_proses',array('kode_barang' =>$kode_barang));
				$hasil_barang=$get_barang->row();
				?>
				<div class="panel-body">
					<form action="">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-5">
									<label for="">Kode Barang</label>
									<input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Bahan Baku" readonly aria-describedby="basic-addon1" value="<?php echo @$hasil_barang->kode_barang; ?>">
								</div>
								<div class="col-md-5">
									<label for="">Satuan Stok</label>
									<select name="kode_satuan_stok" id="kode_satuan_stok" class="form-control">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_satuan')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_barang->kode_satuan_stok==@$value->kode){ echo "selected";}?> value="<?= $value->kode ?>"><?= $value->nama ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-5">
									<label for="">Nama Barang</label>
									<input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang"  aria-describedby="basic-addon1" value="<?php echo @$hasil_barang->nama_barang; ?>">
								</div>
								<div class="col-md-5">
									<label for="">Gudang</label>
									<select name="kode_gudang" id="kode_gudang" class="form-control">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_gudang')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_barang->kode_gudang==@$value->kode_gudang){ echo "selected";}?> value="<?= $value->kode_gudang ?>"><?= $value->nama_gudang ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								
								<div class="col-md-5">
									<label for="">Stok Minimal</label>
									<input type="number" class="form-control" placeholder="Stok Minimal" onkeyup="cek_minimal()" id="stok_minimal" name="stok_minimal" aria-describedby="basic-addon1" value="<?php echo @$hasil_barang->stok_minimal; ?>">
								</div>
							</div><br>
							
							
							<br>
							<div id="addforms">						
								<br><hr><br>
								<div class="col-md-12 row">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Bahan</th>
												<th>Jumlah</th>
												<th>Konversi</th>
												<th>Satuan</th>
											</tr>
										</thead>
										<tbody id='load_temp'>
											<?php 
											$get_opsi=$this->db2->get_where('opsi_master_barang_dalam_proses',array('kode_barang' =>$kode_barang));
											$get_bdp_temp = $get_opsi->result();
											$no = 0;
											foreach ($get_bdp_temp as $value) { $no++; ?>
											<tr>
												<td><?= $no ?></td>
												<?php if ($value->jenis_bahan == 'BB') {
													$get_bahan_baku = $this->db2->get_where('master_bahan_baku', array('kode_bahan_baku' => $value->kode_bahan ))->row(); ?>
													<td><?= $get_bahan_baku->nama_bahan_baku ?></td>
													<?php }else{ $get_barang = $this->db2->get_where('master_barang_dalam_proses', array('kode_barang' => $value->kode_bahan ))->row(); ?>
													<td><?= $get_barang->nama_barang ?></td>
													<?php } 
													?>
													<td><?= $value->qty ?></td>
													<td><?= $value->konversi ?></td>
													<td>
														<?php 
														if ($value->jenis_bahan == 'BB') {
															$this->db2->from('master_bahan_baku');
															$this->db2->join('master_satuan', 'master_satuan.kode = master_bahan_baku.kode_satuan_stok', 'left');
															$this->db2->where('master_bahan_baku.kode_bahan_baku', $value->kode_bahan);
															$get_satuan = $this->db2->get()->row();

															echo @$get_satuan->nama;
														}elseif($value->jenis_bahan == 'BDP'){
															$this->db2->from('master_barang_dalam_proses');
															$this->db2->join('master_satuan', 'master_satuan.kode = master_barang_dalam_proses.kode_satuan_stok', 'left');
															$this->db2->where('master_barang_dalam_proses.kode_barang', $value->kode_bahan);
															$get_satuan = $this->db2->get()->row();

															echo @$get_satuan->nama;
														}
														?>
													</td>
												</tr>
												<?php }

												?>
											</tbody>
										</table>
										<hr><br>
									</div>

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div id="modal-simpan" class="modal fade" tabindex="-1" role="dialog">
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

	<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body text-center">
					<h2>Anda yakin akan menyimpan data ini?</h2>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" onclick="simpan_bdp()" class="btn btn-success"><i class="fa fa-trash"></i> Simpan</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function(){
		lock_form_top();
	});

	function lock_form_top(){
		stok_minimal 			= $('#stok_minimal').val();
		kode_satuan_stok 		= $('#kode_satuan_stok').val();
		nama_barang 			= $('#nama_barang').val();
		kode_gudang 			= $('#kode_gudang').val();


		if (stok_minimal == '' || kode_satuan_stok == '' || nama_barang == '' ||  kode_gudang == ''  ) {
			alert('Harap Melengkapi Form.');
		} else {
			$('#stok_minimal').attr('disabled',true);
			$('#kode_satuan_stok').attr('disabled',true);
			$('#nama_barang').attr('disabled',true);
			$('#kode_satuan_pembelian').attr('disabled',true);
			$('#kode_gudang').attr('disabled',true);

			$('#btn_lock').attr('disabled',true);
			$('#addforms').fadeIn('fast');

		}
		return false;   
	}


	</script>