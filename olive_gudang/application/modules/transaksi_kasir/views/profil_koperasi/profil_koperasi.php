
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li>Profil Koperasi</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Profil Koperasi</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-6">
			<form id="data_form" method="post">
				<table class="table-form" width="100%">
					<?php 
					$ambil = $this->db->get('setting');
					$hasil_ambil = $ambil->row();
					?>
					<tr>
						<td width="260px">Nama Koperasi</td>
						<input type="hidden" id="id" name="id" value="<?php echo $hasil_ambil->id?>">
						<td><input type="text" name="nama_koperasi" id="nama_koperasi" class="form-control" required="" value="<?php echo $hasil_ambil->nama_koperasi?>"></td>
					</tr>
					<tr>
						<td>Nomor Badan Hukum (BH)</td>
						<td><input type="text" name="no_badan_hukum" id="no_badan_hukum" class="form-control" required="" value="<?php echo $hasil_ambil->no_badan_hukum?>"></td>
					</tr>
					<tr>
						<td>Tanggal Badan Hukum <i>(Bln/Tgl/Thn)</i></td>
						<td><input type="date" name="periode_kerja_tanggal" id="periode_kerja_tanggal" class="form-control" required="" value="<?php echo $hasil_ambil->periode_kerja_tanggal?>"></td>
					</tr>
					<tr>
						<td>Nomor Induk Koperasi (NIK)</td>
						<td><input type="text" name="nik_koperasi" id="nik_koperasi" class="form-control" required="" value="<?php echo $hasil_ambil->nik_koperasi?>"></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td><textarea name="alamat_koperasi" id="alamat_koperasi" class="form-control" required="" rows="4" ><?php echo $hasil_ambil->alamat_koperasi;?></textarea></td>
					</tr>
					<tr>
						<td>No Telp Kantor</td>
						<td><input type="text" name="no_telp_koperasi" id="no_telp_koperasi" class="form-control" required="" value="<?php echo $hasil_ambil->no_telp_koperasi?>"></td>
					</tr>
					<tr>
						<td>Modal Awal</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon" id="rupiah_modal">Rp.</span>
								<input type="text" name="modal_awal" id="modal_awal" class="form-control" required="" value="<?php echo $hasil_ambil->modal_awal?>">
							</div>
						</td>
					</tr>
					<tr>
						<td>Pajak</td>
						<td>
							<div class="input-group">
								<input type="number" name="pajak" id="pajak" class="form-control" required="" value="<?php echo $hasil_ambil->pajak?>">
								<span class="input-group-addon">%</span>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2"><button type="submit" class="btn btn-block btn-lg btn-super btn-no-radius btn-danger">SIMPAN</button></td>
					</tr>
				</table>
			</form>
		</div>

		<div class="col-sm-6">
			<div class="setting-information" style="margin: 0">

				<h3 class="text-center"><?php echo $hasil_ambil->nama_koperasi?></h3>
				<p class="text-center">Nomor : <?php echo $hasil_ambil->no_badan_hukum?></p>

				<table width="100%" class="table-form" style="margin-top: 50px;">
					<tr>
						<td width="200px">Tanggal Badan Hukum</td>
						<td align="center" width="40px">:</td>
						<td><?php echo tanggalIndo($hasil_ambil->periode_kerja_tanggal)?></td>
					</tr>
					<tr>
						<td width="200px">Nomor Induk Koperasi</td>
						<td align="center" width="40px">:</td>
						<td><?php echo $hasil_ambil->no_badan_hukum?></td>
					</tr>
					<tr>
						<td width="200px">Alamat</td>
						<td align="center" width="40px">:</td>
						<td><?php echo $hasil_ambil->alamat_koperasi?></td>
					</tr>
					<tr>
						<td width="200px">Telp</td>
						<td align="center" width="40px">:</td>
						<td><?php echo $hasil_ambil->no_telp_koperasi?></td>
					</tr>
					<tr>
						<td width="200px">Modal Awal</td>
						<td align="center" width="40px">:</td>
						<td><?php echo format_rupiah($hasil_ambil->modal_awal)?></td>
					</tr>
					<tr>
						<td width="200px">Pajak</td>
						<td align="center" width="40px">:</td>
						<td><?php echo $hasil_ambil->pajak?> %</td>
					</tr>
				</table>
			</div>
		</div>
	</div> <!-- //row -->
</div>

<script type="text/javascript">
	$('#data_form').submit(function(){

		$.ajax({
			url: '<?php echo base_url('setting/edit_profile'); ?>',
			type: 'post',
			data: $(this).serialize(),
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(data){
				window.location.reload();
			}
		});
		return false;

	})

	$("#modal_awal").keyup(function(){
		var modal_awal = $('#modal_awal').val();
		var url = "<?php echo base_url() . 'setting/get_rupiah_modal_awal'; ?>";
		if (modal_awal < 0 ) {
			alert('Modal Awal tidak boleh dibawah 0.')
			$('#modal_awal').val('');

		}else{
			$('#rupiah_modal').text(toRp(modal_awal));
		}
		return false;
	});
	$("#pajak").keyup(function(){
		var pajak = $('#pajak').val();
		if (pajak =='-'  || pajak >100) {
			alert('Persentase Pajak Salah')
			$('#pajak').val('');

		}else{
			
		}
		
	});
	function toRp(angka){
		var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
		var rev2    = '';
		for(var i = 0; i < rev.length; i++){
			rev2  += rev[i];
			if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
				rev2 += '.';
			}
		}
		return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
	}
</script>