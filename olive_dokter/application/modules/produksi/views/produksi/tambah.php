
<!-- back button -->
<a href="<?php echo base_url('admin'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('produksi'); ?>">Produksi</a></li>
		<li><a href="#">Hasil Produksi</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Hasil Produksi</h1>

	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Hasil Produksi </span>
					<a href="<?php echo base_url('produksi/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Hasil Produksi</a>
					<a href="<?php echo base_url('produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Hasil Produksi</a>
				</div>
				<div class="panel-body">
					<form id="data_produksi">
						<div class="row">
							<div class="col-md-2 text-right">
								<label>Kode Produksi</label>
							</div>
							<div class="col-md-6">
								<input type="text" readonly="" name="kode_produksi" class="form-control">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-2 text-right">
								<label>Tanggal Produksi</label>
							</div>
							<div class="col-md-6">
								<input type="date" readonly="" name="tanggal_produksi" class="form-control" value="<?php echo date('Y-m-d') ?>">
							</div>
						</div>
						<hr><br>
						<div class="col-md-12" style="margin-top: 20px;">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th style="width: 70px;">No</th>
										<th>Produk</th>
										<th>QTY</th>
										<th width="200px">Barang Rusak</th>
										<th width="200px">Sample Uji</th>
									</tr>
								</thead>
								<tbody id="data_opsi_temp">

								</tbody>
							</table>
						</div>
						<!-- ---------------------------------------------------------------------------- -->
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel-heading text-right">
										<span class="pull-left" style="font-size: 20px">DATA UJI</span>
										<br>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<table id="tabel_analisa" class="table table-bordered table-striped" style="width:50%;">
													<tr>
														<td style="text-align: center;width:25%;"><label>Tanggal</label></td>
														<td >
															<input type="date" class="form-control" name="tanggal_uji" required value="<?php echo date("Y-m-d"); ?>">
														</td>
													</tr>
													<tr>
														<td style="text-align: center;"><label>JENIS SAMPLE</label></td>
														<td><input type="text" name="jenis_sample" class='form-control' required placeholder="Jenis Sample"/></td>
													</tr>              
												</table>
											</div>
											<div class="col-md-12" id="tabel_temp_uji">

											</div>
											<div class="col-md-12">

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- ---------------------------------------------------------------------------- -->

						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel-heading text-right">
										<span class="pull-left" style="font-size: 20px">RELEASE PRODUCT</span>
										<br>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12" id="tabel_temp_rilis_produk">

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- ---------------------------------------------------------------------------- -->

						<div class="col-md-12">
							<button type="submit" class="btn btn-info btn-lg btn-no-radius pull-right"><i class="fa fa-send"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>

<div id="modal-kode-tr" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Transaksi Produksi</h4>
			</div>
			<div class="modal-body">
				<h5>Kode Perintah Produksi</h5>
				<select name="kode_perintah" class="form-control select2" id="kode_perintah">
					<option value="">-- Pilih Kode --</option>
					<?php
					$this->db->select('kode_produksi');
					$this->db->where('status', 'menunggu');
					$get_produksi = $this->db->get('transaksi_produksi')->result();
					foreach ($get_produksi as $produksi) {
						echo '<option>'.$produksi->kode_produksi.'</option>';
					}
					?>
				</select>
			</div>
			<div class="modal-footer">
				<a href="<?php base_url('produksi/daftar') ?>" class="btn btn-danger btn-no-radius btn-md" >Cancel</a>
				<a class="btn btn-info btn-no-radius btn-info" onclick="cari_transaksi()" >Cari</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#modal-kode-tr').modal('show');
	$('#modal-kode-tr').modal({backdrop: 'static', keyboard: false})  
});

function cari_transaksi(){
	kode_perintah = $('#kode_perintah').val();
	$('input[name="kode_produksi"]').val(kode_perintah);

	$('#modal-kode-tr').modal('hide');
	$("#data_opsi_temp").load("<?php echo base_url().'produksi/get_produksi_temp/'; ?>"+kode_perintah);
	$("#tabel_temp_uji").load("<?php echo base_url().'produksi/get_tabel_uji_temp/'; ?>"+kode_perintah);
	$("#tabel_temp_rilis_produk").load("<?php echo base_url().'produksi/get_tabel_rilis_produk_temp/'; ?>"+kode_perintah);
}

$('#data_produksi').submit(function(){
	$.ajax({
		url: '<?php echo base_url('produksi/produksi/simpan_produksi'); ?>',
		type: 'post',
		data: $(this).serialize(),
		beforeSend:function(){
			$(".tunggu").show();
		},
		success: function(hasil){
			$(".tunggu").hide();
			$(".alert_berhasil").show();
			setTimeout(function(){
				$(".alert_berhasil").hide();
					window.location="<?php echo base_url('produksi/perintah_produksi');?>";
				},1500);
		},
	});
	return false;
});
</script>