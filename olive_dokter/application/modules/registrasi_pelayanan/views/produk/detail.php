
<!-- back button -->
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Produk </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Produk </span>
					<a href="<?php echo base_url('master/produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
					<a href="<?php echo base_url('master/produk/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
				</div>
				<?php
				$kode_produk=$this->uri->segment(4);
				$get_produk=$this->db2->get_where('master_produk',array('kode_produk' =>$kode_produk));
				$hasil_produk=$get_produk->row();

				$get_harga=$this->db2->get_where('master_harga_barang',array('kode_barang' =>$kode_produk));
				$hasil_harga=$get_harga->row();
				?>
				<div class="panel-body">
					<form action="">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<label for="">Kode Produk</label>
									<input type="text" class="form-control data_produk" id="kode_produk" name="kode_produk" placeholder="Kode Bahan Baku" readonly  value="<?php echo @$hasil_produk->kode_produk; ?>">
								</div>
								<div class="col-md-6">
									<label for="">Nama Produk</label>
									<input type="text" class="form-control data_produk" id="nama_produk" name="nama_produk" placeholder="Nama Produk"  value="<?php echo @$hasil_produk->nama_produk; ?>">
								</div>
								
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<label for="">Satuan Stok</label>
									<select name="kode_satuan_stok" id="kode_satuan_stok" class="form-control data_produk">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_satuan')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_produk->kode_satuan_stok==@$value->kode){ echo "selected";}?> value="<?= $value->kode ?>"><?= $value->nama ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="">Gudang</label>
									<select name="kode_gudang" id="kode_gudang" class="form-control data_produk">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_gudang')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_produk->kode_gudang==@$value->kode_gudang){ echo "selected";}?> value="<?= $value->kode_gudang ?>"><?= $value->nama_gudang ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<label for="">Stok Minimal</label>
									<input type="number" class="form-control data_produk" placeholder="Stok Minimal" onkeyup="cek_minimal()" id="stok_minimal" name="stok_minimal" value="<?php echo @$hasil_produk->stok_minimal; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 1</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 1" id="harga1" name="harga1" value="<?php echo @$hasil_harga->harga1; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 2</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 2" id="harga2" name="harga2" value="<?php echo @$hasil_harga->harga2; ?>">
								</div>
							</div><br>
							<div class="row">
								
								<div class="col-md-3">
									<label for="">Harga 3</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 3" id="harga3" name="harga3" value="<?php echo @$hasil_harga->harga3; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 4</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 4" id="harga4" name="harga4" value="<?php echo @$hasil_harga->harga4; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 5</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 5" id="harga5" name="harga5" value="<?php echo @$hasil_harga->harga5; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 6</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 6" id="harga6" name="harga6" value="<?php echo @$hasil_harga->harga6; ?>">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3">
									<label for="">Harga 7</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 7" id="harga7" name="harga7" value="<?php echo @$hasil_harga->harga7; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 8</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 8" id="harga8" name="harga8" value="<?php echo @$hasil_harga->harga8; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 9</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 9" id="harga9" name="harga9" value="<?php echo @$hasil_harga->harga9; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 10</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 10" id="harga10" name="harga10" value="<?php echo @$hasil_harga->harga10; ?>">
								</div>
							</div><br>
							
							<br>
							<hr>
							<br>
							<div id="addforms">
								
								<div class="col-md-12 row">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Bahan</th>
												<th>Jenis Bahan</th>
												<th>Jumlah</th>
												<th>Satuan</th>
												
											</tr>
										</thead>
										<tbody id='load_temp'>
											<?php 
											$get_opsi=$this->db2->get_where('opsi_master_produk', array('kode_produk' =>$kode_produk));
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
													<td><?= $value->jenis_bahan ?></td>
													<td><?= $value->qty ?></td>
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
		</div> <!-- //row -->
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
					<button type="button" onclick="simpan_produk()" class="btn btn-success"><i class="fa fa-trash"></i> Simpan</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function(){
		$('.data_produk').attr('disabled',true);
	});

	</script>