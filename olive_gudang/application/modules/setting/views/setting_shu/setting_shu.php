
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li>SHU</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting Shu</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-6">
			<form id="data_form" method="post">
				<table class="table-form" width="100%">
					<?php 
					$ambil = $this->db->get('setting_shu');
					$hasil_ambil = $ambil->row();
					?>
					<tr>
						<td width="260px">Tanggal</td>
						<input type="hidden" id="id" name="id" value="<?php echo @$hasil_ambil->id?>">
						<td><input type="date" name="tanggal" id="tanggal" class="form-control" required="" value="<?php echo @$hasil_ambil->tanggal?>"></td>
					</tr>

					<tr>
						<td width="260px">Cadangan</td>
						<td><input type="number" name="shu_cadangan" class="form-control" id="qty1" required="" value="<?php echo @$hasil_ambil->shu_cadangan?>"></td>
					</tr>

					<tr>
						<td width="260px">Simpanan</td>
						<td><input type="number" name="shu_simpanan" class="form-control" id="qty2" required="" value="<?php echo @$hasil_ambil->shu_simpanan?>"></td>
					</tr>

					<tr>
						<td width="260px">Pinjaman</td>
						<td><input type="number" name="shu_pinjaman" class="form-control" id="qty3" required="" value="<?php echo @$hasil_ambil->shu_pinjaman?>"></td>
					</tr>

					<tr>
						<td width="260px">Pengurus</td>
						<td><input type="number" name="shu_pengurus" class="form-control" id="qty4" required="" value="<?php echo @$hasil_ambil->shu_pengurus?>"></td>
					</tr>

					<tr>
						<td width="260px">Pendidikan</td>
						<td><input type="number" name="shu_pendidikan" class="form-control" id="qty5" required="" value="<?php echo @$hasil_ambil->shu_pendidikan?>"></td>
					</tr>

					<tr>
						<td width="260px">Dana Sosial</td>
						<td><input type="number" name="shu_sosial" class="form-control" id="qty6" required="" value="<?php echo @$hasil_ambil->shu_sosial?>"></td>
					</tr>

					<tr>
						<td width="260px">Karyawan</td>
						<td><input type="number" name="shu_karyawan" class="form-control" id="qty7" required="" value="<?php echo @$hasil_ambil->shu_karyawan?>"></td>
					</tr>
					
					<tr>
						<td colspan="2"><button type="submit" class="btn btn-block btn-lg btn-super btn-no-radius btn-danger">SIMPAN</button></td>
					</tr>
				</table>
			</form>
		</div>

		<div class="col-sm-6">
			<div class="setting-information" style="margin: 0">

				<h3 class="text-center">Setting Shu</h3>
				<p class="text-center">Tanggal : <?php echo @tanggalIndo(@$hasil_ambil->tanggal);?></p>

				<table width="100%" class="table-form" style="margin-top: 50px;">
					<tr>
						<td width="200px">Cadangan</td>
						<td align="center" width="40px">:</td>
						<td><?php echo @$hasil_ambil->shu_cadangan;?> %</td>
					</tr>
					<tr>
						<td width="200px">Simpanan</td>
						<td align="center" width="40px">:</td>
						<td><?php echo @$hasil_ambil->shu_simpanan;?> %</td>
					</tr>

					<tr>
						<td width="200px">Pinjaman</td>
						<td align="center" width="40px">:</td>
						<td><?php echo @$hasil_ambil->shu_pinjaman;?> %</td>
					</tr>

					<tr>
						<td width="200px">Pengurus</td>
						<td align="center" width="40px">:</td>
						<td><?php echo @$hasil_ambil->shu_pengurus;?> %</td>
					</tr>

					<tr>
						<td width="200px">Pendidikan</td>
						<td align="center" width="40px">:</td>
						<td><?php echo @$hasil_ambil->shu_pendidikan;?> %</td>
					</tr>

					<tr>
						<td width="200px">Dana Sosial</td>
						<td align="center" width="40px">:</td>
						<td><?php echo @$hasil_ambil->shu_sosial;?> %</td>
					</tr>
					<tr>
						<td width="200px">Karyawan</td>
						<td align="center" width="40px">:</td>
						<td><?php echo @$hasil_ambil->shu_karyawan;?> %</td>
					</tr>
				</table>
			</div>
		</div>
	</div> <!-- //row -->
</div>

<script type="text/javascript">
	$('#data_form').submit(function(){
		var tot=0;
		for(var i=0;i<8;i++){
			if(parseInt($('#qty'+i).val()))
				tot += parseInt($('#qty'+i).val());

		}

		// alert(tot);
		if (tot<100) {
			alert("Total dari keseluruhan form kurang dari 100%");
		}if(tot>100){
			alert("Total dari keseluruhan form lebih dari 100% ");

		}if(tot==100){
			$.ajax({
				url: '<?php echo base_url('setting/setting_shu/edit_shu'); ?>',
				type: 'post',
				data: $(this).serialize(),
				beforeSend: function(){
					$('.loading').show();
				},
				success: function(data){
					window.location.reload();
				}
			});
		}
		return false

	});

	
	$('#qty1').keyup(function(){
		var qty = $('#qty1').val();
		if(qty<0){
			alert("Jumlah Salah !");
			$('#qty1').val('');
		}
	});

	$('#qty2').keyup(function(){
		var qty = $('#qty2').val();
		if(qty<0){
			alert("Jumlah Salah !");
			$('#qty2').val('');
		}
	});

	$('#qty3').keyup(function(){
		var qty = $('#qty3').val();
		if(qty<0){
			alert("Jumlah Salah !");
			$('#qty3').val('');
		}
	});

	$('#qty4').keyup(function(){
		var qty = $('#qty4').val();
		if(qty<0){
			alert("Jumlah Salah !");
			$('#qty4').val('');
		}
	});

	$('#qty5').keyup(function(){
		var qty = $('#qty5').val();
		if(qty<0){
			alert("Jumlah Salah !");
			$('#qty5').val('');
		}
	});

	$('#qty6').keyup(function(){
		var qty = $('#qty6').val();
		if(qty<0){
			alert("Jumlah Salah !");
			$('#qty6').val('');
		}
	});

	$('#qty7').keyup(function(){
		var qty = $('#qty7').val();
		if(qty<0){
			alert("Jumlah Salah !");
			$('#qty7').val('');
		}
	});
</script>