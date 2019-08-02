
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Merchant</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Merchant</h1>

	<?php $this->load->view('menu_setting'); ?>
	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit merchant </span>
					<a href="<?php echo base_url('setting/mercant/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/mercant'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>

							<label><h3><b>Edit merchant</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode merchant</label>

										<input type="text" value="PR004" class="form-control" placeholder="Kode " name="kode_merchant" id="kode_merchant" />
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama merchant</label>
										<input type="text" class="form-control" placeholder="Nama merchant" value="Wardah" name="nama_merchant" id="nama_merchant"/>
									</div>
								</div>

								<div class="col-md-6">
									<label>Tanggal Awal merchant</label>
									<input type="date" class="form-control" name="tgl_awal" id="tgl_awal" value="2017-11-01" />
								</div>


								<div class="col-md-6">
									<label>Tanggal Akhir merchant</label>
									<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" value="2017-11-30" />
								</div>
								<div class="col-md-6">

									<label>Status</label>
									<select class="form-control" name="status" id="status">

										<option value="">--Pilih Status--</option>
										<option selected value="1" >Aktif</option>
										<option  value="0" >Nonaktif</option>
									</select> 
								</div>
								<div class="col-md-3" style="padding:25px;">

								</div>
							</div>
						</div> 
						<br>
						<div class="box-footer clearfix">
							<a onclick="simpan_all()"  class="btn btn-success pull-right">Ubah</a>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div> <!-- //row -->
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