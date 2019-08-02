<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Produk</a></li>
		<li>Pinjaman</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Produk Pinjaman</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Produk Pinjaman</span>
					<a href="<?php echo base_url('setting/pinjaman'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
					<a href="<?php echo base_url('setting/pinjaman/data_produk'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
				</div>
				<div class="panel-body">
					<div class="row">	
						<div class="col-lg-12">
							<label>Kode Produk Pinjaman</label>
							<div class="input-group" style="width: 50%">
								<input type="text" id="kode_pinjaman" name="kode_pinjaman" class="form-control" value="<?php echo "PRP_".date('ymdhis');?>" required="" readonly>								
							</div><br>
							<label>Nama Produk Pinjaman</label>
							<div class="input-group" style="width: 50%">
								<input type="text" id="nama_pinjaman" name="nama_pinjaman" class="form-control" required="">
							</div><br>
							<label>Plafond Pinjaman / Maks. Pinjaman</label>
							<div class="input-group" style="width: 50%">
								<input type="number" id="plafond" name="plafond" class="form-control" >
							</div><br>
							<label>Tenor / Jumlah Angsuran</label>
							<div class="input-group" style="width: 50%">
								<input type="number" id="tenor" name="tenor" class="form-control" required="" value="">
								<span class="input-group-addon">Bulan</span>
							</div><br>
							<!-- <label>Jenis Jasa</label>
							<div class="input-group" style="width: 50%">
								<select name="jasa" id="jasa" onchange="jenis_jasa()">
									<option value="">- Pilih Jenis Jasa</option>
									<option value="bulan">Bulan</option>
									<option value="tahun">Tahun</option>
								</select>
							</div><br> -->
							<input type="hidden" name="jasa" id="jasa" value="bulan">
							<label class="tahun">* Jasa Pertahun</label>
							<div class="input-group tahun" style="width: 50%">
								<span class="input-group-addon">%</span>
								<input type="number" id="pertahun" name="pertahun" onkeyup="hitung_per_bulan()" onkeydown="hitung_per_bulan()" placeholder="0" class="form-control">
								<span class="input-group-addon"> / Tahun</span>
							</div><br>
							<label class="tahun">* Jasa Perbulan</label>
							<div class="input-group tahun" style="width: 50%">
								<span class="input-group-addon">%</span>
								<input type="number" id="perbulan" name="" placeholder="0" class="form-control" readonly>
								<span class="input-group-addon"> / Bulan</span>
							</div>
							<label class="bulan" style="margin-top: -32px;">Jasa Perbulan</label>
							<div class="input-group bulan" style="width: 50%">
								<span class="input-group-addon">%</span>
								<input type="number" id="jasa_perbulan" name="jasa_perbulan" placeholder="0" class="form-control">
								<span class="input-group-addon"> / Bulan</span>
							</div>
						</div>
						<div class="col-lg-12"><br>
							<label>Status Denda</label>
							<div class="input-group" style="width: 50%">
								<select name="status_denda" id="status_denda" onchange="status_denda()">
									<option value="tidak">Tidak Ada</option>
									<option value="ada">Ada</option>					
								</select>
							</div><br>
							<label class="status_denda">Nominal Denda</label>
							<div class="input-group status_denda" style="width: 50%">
								<span class="input-group-addon">Rp.</span>
								<input type="number" id="nominal_denda" name="nominal_denda" placeholder="0" class="form-control">
							</div><br>

							<label>Biaya Provisi</label>
							<div class="input-group" style="width: 50%">
								<select name="status_provisi" id="status_provisi" onchange="status_provisi()">					
									<option value="tidak">Tidak Ada</option>
									<option value="ada">Ada</option>
								</select>
							</div><br>
							<label class="status_provisi">Nominal Biaya Provisi</label>
							<div class="input-group status_provisi" style="width: 50%">
								<input type="text" id="nominal_provisi" name="nominal_provisi" placeholder="0" class="form-control">
								<span class="input-group-addon">%</span>
							</div><br>

							<label>Administrasi</label>
							<div class="input-group" style="width: 50%">
								<span class="input-group-addon">Rp.</span>
								<input type="number" id="nominal_administrasi" name="nominal_administrasi" placeholder="0" class="form-control">
							</div><br>

							<label>Potongan</label>
							<div class="input-group" style="width: 50%">
								<select name="potongan" id="potongan" onchange="status_angsuran()">
									<option value="">-- Pilih Potongan --</option>
									<option value="di bayar di depan">Di Bayar Di Depan</option>
									<option value="cicilan bulan pertama">Cicilan Bulan Pertama</option>	
									<option value="tidak ada">Tidak Ada</option>					
								</select>
							</div><br>
							<div  style="display: none;">
								<div id="ket_tambahan">
									<div class="form-group">
										<label>Nama Potongan</label>
										<div class="input-group" style="width: 50%">
											<input type="text" id="nama_potongan[]" name="nama_potongan[]"  class="form-control">
										</div>
									
										<label>Potongan</label>
										<div class="input-group" style="width: 50%">
											<input type="text" id="nama_potongan[]" name="nama_potongan[]"  class="form-control">
										</div>
									</div>
								</div>
							</div>

							<div id="ket_tambahan2" >

							</div>
							<div class="form-group">
								<div class="col-md-4">
								<a onclick="tambah_ket()" class="btn btn-md btn-success"><i class="fa fa-plus"></i></a>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="panel-footer text-right">
					<button class="btn btn-lg  btn-no-radius btn-primary" id="submit"><i class="fa fa-save"></i> SIMPAN</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal -->
<div id="modalku" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalku" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3 class="modal-title" style="color:#fff;">Konfirmasi</h3>
			</div>	
			<div class="modal-body">
				<h4 class="modal-title" style="color:grey;">Yakin Memilih Jenis Pinjaman Tersebut ?</h4>
			</div>			
			<div class="modal-footer">
				<button class="btn btn-danger" onclick="location.reload()" aria-hidden="true">BATAL</button>
				<button class="btn btn-info" onclick="pilih_pinjaman()" aria-hidden="true">YA</button>
			</div>
		</div>
	</div>
</div>





<div id="modal-insert" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h3>Simpan data ini?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" id="submit_insert" class="btn btn-primary">Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>

	$(document).ready(function(){
		$('.status_denda').hide();
		$('.status_provisi').hide();
		$('.status_angsuran').hide();
		$('.tahun').hide();
	});

	function jenis_jasa() {
		var jasa = $('#jasa').val();
		if(jasa == 'bulan'){
			$('.bulan').fadeIn("slow");			
			$('.tahun').fadeOut("slow");
		}else if(jasa == 'tahun'){
			$('.tahun').fadeIn("slow");			
			$('.bulan').fadeOut("slow");
		}else{
			$('.bulan').fadeOut("slow");			
			$('.tahun').fadeOut("slow");
		}
	}

	function status_denda() {
		var status_denda = $('#status_denda').val();
		if(status_denda == 'ada'){
			$('.status_denda').fadeIn("slow");
		}else{
			$('.status_denda').fadeOut("slow");
		}
	}

	function status_provisi() {
		var status_provisi = $('#status_provisi').val();
		if(status_provisi == 'ada'){
			$('.status_provisi').fadeIn("slow");			
		}else{
			$('.status_provisi').fadeOut("slow");			
		}
	}

	function status_angsuran() {
		var status_angsuran = $('#status_angsuran').val();
		if(status_angsuran == 'ada'){
			$('.status_angsuran').fadeIn("slow");			
		}else{
			$('.status_angsuran').fadeOut("slow");			
		}
	}

	function hitung_per_bulan(){
		var pertahun 		= $('#pertahun').val();
		var total_perbulan 	= pertahun / 12;
		var parsing 		= parseFloat((total_perbulan * 100) / 100).toFixed(3)

		$('#perbulan').val(parsing);
	}


	$('#ketentuan_pinjaman').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0 || nominal >= 100){
			alert('Ketentuan Pinjaman salah!');
			$(this).val('');
		}
	});
	$('#nominal_administrasi').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0){
			alert('Nominal administrasi salah!');
			$(this).val('');
		}
	});

	$('#nominal_provisi').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0){
			alert('Nominal provisi salah!');
			$(this).val('');
		}
	});
	$('#nominal_denda').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0){
			alert('Nominal Denda salah!');
			$(this).val('');
		}
	});

	$('#plafond').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0){
			alert('Nominal plafond salah!');
			$(this).val('');
		}
	});

	$('#nominal_provisi').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0 || nominal > 100){
			alert('Nominal provisi salah!');
			$(this).val('');
		}
	});

	$('#pertahun').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0 || nominal >= 100){
			alert('Nominal provisi salah!');
			$(this).val('');
		}
	});

	$('#jasa_perbulan').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0 || nominal >= 100){
			alert('Nominal jasa perbulan salah!');
			$(this).val('');
		}
	});




	$('#submit').click(function(){
		$('#modal-insert').modal('show');
	});


	$('#submit_insert').click(function(){
		$('#modal-insert').modal('hide');

		var jenis_pinjaman = $('#jenis_pinjaman').val();
		var kode_pinjaman = $('#kode_pinjaman').val();
		var nama_pinjaman = $('#nama_pinjaman').val();
		var plafond = $('#plafond').val();
		var tenor = $('#tenor').val();
		var jenis_jasa = $('#jasa').val();
		var jasa_perbulan = $('#jasa_perbulan').val();
		var pertahun = $('#pertahun').val();
		var perbulan = $('#perbulan').val();
		var status_denda = $('#status_denda').val();
		var nominal_administrasi = $('#nominal_administrasi').val();
		var nominal_denda = $('#nominal_denda').val();
		var status_provisi = $('#status_provisi').val();
		var nominal_provisi = $('#nominal_provisi').val();
		var status_angsuran = $('#status_angsuran').val();
		var penarikan_jasa_pinjaman = $('#potongan').val();

		if($('#jasa').val() == 'tahun'){
			var bulanan = perbulan;
		}else if($('#jasa').val() == 'bulan'){
			var bulanan = jasa_perbulan;
		}
		if(jenis_pinjaman=='' || kode_pinjaman=="" || nama_pinjaman=="" || plafond=="" || tenor=="" || jenis_jasa=="" || status_denda==""){
			alert("Lengkapi Form ..!");
		}else{
			$.ajax({
				url: '<?php echo @base_url('setting/pinjaman/act_simpan'); ?>',
				type: 'post',
				data:{
					jenis_pinjaman : jenis_pinjaman,
					kode_pinjaman : kode_pinjaman,
					nama_produk : nama_pinjaman,
					plafon : plafond,
					tenor : tenor,
					jenis_jasa:jenis_jasa,
					jasa_per_tahun : pertahun,
					jasa_per_bulan : bulanan,
					status_denda : status_denda, 
					nominal_denda : nominal_denda, 
					nominal_biaya_administrasi : nominal_administrasi,
					biaya_provisi : status_provisi,
					persentase_biaya_provisi : nominal_provisi,
					status_agunan : status_angsuran,
					penarikan_jasa_pinjaman : penarikan_jasa_pinjaman,
					status_pinjamanan : ''
				},
				success : function(response){
					if(response == 'ok'){
						swal({
							title : '',
							type : 'success',
							text : 'Data berhasil ditambahkan',
						},function(){
							window.location.href='';
						});
					}else{
						alert(response);
					}
				}
			});
		}		
	});

	function tambah_ket(){
		var text = parseInt($('#text_ket').text());
		var no=text+1;
		$('#text_ket').text(no+' .');
		$('#ket_tambahan').clone().appendTo('#ket_tambahan2');
	}
</script>