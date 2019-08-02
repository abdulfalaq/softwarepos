<style>
	.bulan{
		margin-top: -10px;
	}
</style>

<h2>Pinjaman Reguler</h2>
<hr>


<div class="col-lg-12">	
	<div class="row">	
		<div class="col-lg-6">
			<label>Ketentuan Pinjaman</label>
			<div class="input-group" style="width: 500px">
				<input type="text" id="ketentuan_pinjaman" name="ketentuan_pinjaman" class="form-control" required="">
			</div><br>
			<label>Nama Pinjaman</label>
			<div class="input-group" style="width: 500px">
				<input type="text" id="nama_pinjaman" name="nama_pinjaman" class="form-control" required="">
			</div><br>
			<label>Plafond Pinjaman / Maks. Pinjaman</label>
			<div class="input-group" style="width: 500px">
				<input type="number" id="plafond" name="plafond" class="form-control" >
			</div><br>
			<label>Tenor / Jumlah Angsuran</label>
			<div class="input-group" style="width: 500px">
				<input type="number" id="tenor" name="tenor" class="form-control" required="" value="1">
				<span class="input-group-addon">Bulan</span>
			</div><br>
			<label>Jenis Jasa</label>
			<div class="input-group" style="width: 500px">
				<select name="jasa" id="jasa" onchange="jenis_jasa()">
					<option value="">- Pilih Jenis Jasa</option>
					<option value="bulan">Bulan **</option>
					<option value="tahun">Tahun *</option>
				</select>
			</div><br>
			<label class="tahun">* Jasa Pertahun</label>
			<div class="input-group tahun" style="width: 500px">
				<span class="input-group-addon">%</span>
				<input type="number" id="pertahun" name="pertahun" onkeyup="hitung_per_bulan()" onkeydown="hitung_per_bulan()" placeholder="0" class="form-control">
				<span class="input-group-addon"> / Tahun</span>
			</div><br>
			<label class="tahun">* Jasa Perbulan</label>
			<div class="input-group tahun" style="width: 500px">
				<span class="input-group-addon">%</span>
				<input type="number" id="perbulan" name="" placeholder="0" class="form-control" readonly>
				<span class="input-group-addon"> / Bulan</span>
			</div><br>
			<label class="bulan" style="margin-top: -32px;">** Jasa Perbulan</label>
			<div class="input-group bulan" style="width: 500px">
				<span class="input-group-addon">%</span>
				<input type="number" id="jasa_perbulan" name="jasa_perbulan" placeholder="0" class="form-control">
				<span class="input-group-addon"> / Bulan</span>
			</div><br>
		</div>


		<div class="col-lg-6">
			<label>Biaya Administrasi</label>
			<div class="input-group" style="width: 500px">
				<select name="status_denda" id="status_denda" onchange="status_denda()">
					<option value="tidak">Tidak Ada</option>
					<option value="ada">Ada</option>					
				</select>
			</div><br>
			<label class="status_denda">Nominal Administrasi</label>
			<div class="input-group status_denda" style="width: 500px">
				<span class="input-group-addon">Rp.</span>
				<input type="number" id="nominal_administrasi" name="nominal_administrasi" placeholder="0" class="form-control">
			</div><br>

			<label>Biaya Provisi</label>
			<div class="input-group" style="width: 500px">
				<select name="status_provisi" id="status_provisi" onchange="status_provisi()">					
					<option value="tidak">Tidak Ada</option>
					<option value="ada">Ada</option>
				</select>
			</div><br>
			<label class="status_provisi">Nominal Biaya Provisi</label>
			<div class="input-group status_provisi" style="width: 500px">
				<input type="text" id="nominal_provisi" name="nominal_provisi" placeholder="0" class="form-control">
				<span class="input-group-addon">%</span>
			</div><br>

			<label>Ketentuan Angsuran</label>
			<div class="input-group" style="width: 500px">
				<select name="status_angsuran" id="status_angsuran" onchange="status_angsuran()">
					<option value="tidak">Tidak Ada</option>
					<option value="ada">Ada</option>					
				</select>
			</div><br>
			<label class="status_angsuran">Penarikan Jasa Pinjaman</label>
			<div class="input-group status_angsuran" style="width: 500px">
				<select name="penarikan_jasa_pinjaman" id="penarikan_jasa_pinjaman" required="" class="form-control">
					<option value="">- Pilih Opsi Penarikan</option>
					<option value="semua">Semua</option>
					<option value="bulanan">Bulanan</option>
				</select>
			</div><br>
		</div>
	</div>
</div>
<hr style="border: solid 1px #c3c3c3;">
<button type="submit" id="submit" class="btn btn-success btn-md btn-no-radius pull-right" style="width: 100px;padding: 10px;letter-spacing:2px;">SIMPAN</button>
<a onclick="$('#modalbatal').modal('show')" class="btn btn-danger btn-md btn-no-radius pull-right" style="width: 100px;padding: 10px;letter-spacing:2px;margin-right: 10px;">BATAL</a>

<!-- modal -->
<div id="modalbatal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalbatal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3 class="modal-title" style="color:#fff;">Konfirmasi</h3>
			</div>	
			<div class="modal-body">
				<h4 class="modal-title" style="color:grey;">Apa anda yakin membatalkan pengisian form ?</h4>
			</div>			
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">BATAL</button>
				<button class="btn btn-info" onclick="location.reload()" aria-hidden="true">YA</button>
			</div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function(){
		$('.status_denda').hide();
		$('.status_provisi').hide();
		$('.status_angsuran').hide();
		$('.tahun').hide();
		$('.bulan').hide();
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
		var parsing 		= parseFloat(Math.round(total_perbulan * 100) / 100).toFixed(2)

		$('#perbulan').val(parsing);
	}


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

	$('#plafond').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0){
			alert('Nominal plafond salah!');
			$(this).val('');
		}
	});

	$('#nominal_provisi').keyup(function(){
		var nominal = parseInt($(this).val());
		if(nominal <= 0 || nominal >= 100){
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
		var jenis_pinjaman = $('#jenis_pinjaman').val();
		var ketentuan_pinjaman = $('#jenis_pinjaman').val();
		var nama_pinjaman = $('#nama_pinjaman').val();
		var plafond = $('#plafond').val();
		var tenor = $('#tenor').val();
		var jenis_jasa = $('#jasa').val();
		var jasa_perbulan = $('#jasa_perbulan').val();
		var pertahun = $('#pertahun').val();
		var perbulan = $('#perbulan').val();
		var biaya_administrasi = $('#status_denda').val();
		var nominal_administrasi = $('#nominal_administrasi').val();
		var status_provisi = $('#status_provisi').val();
		var nominal_provisi = $('#nominal_provisi').val();
		var status_angsuran = $('#status_angsuran').val();
		var penarikan_jasa_pinjaman = $('#penarikan_jasa_pinjaman').val();

		if($('#jasa').val() == 'tahun'){
			var bulanan = perbulan;
		}else if($('#jasa').val() == 'bulan'){
			var bulanan = jasa_perbulan;
		}

		$.ajax({
			url: '<?php echo @base_url('setting/pinjaman/act_simpan'); ?>',
			type: 'post',
			data:{
				jenis_pinjaman : jenis_pinjaman,
				ketentuan_pinjaman : ketentuan_pinjaman,
				nama_produk : nama_pinjaman,
				plafon : plafond,
				tenor : tenor,
				jasa_per_tahun : pertahun,
				jasa_per_bulan : bulanan,
				biaya_administrasi : biaya_administrasi, 
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
	});
</script>