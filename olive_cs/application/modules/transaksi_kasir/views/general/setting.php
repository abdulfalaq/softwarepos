
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="page-title">
	<h1>Setting Aplikasi</h1>
</div>

<div class="container">
	<?php
	$get_setting=$this->db->get('setting');
	$hasil_setting=$get_setting->row();
	?>
	<div class="col-sm-6">
		<form id="data_form" onsubmit="return false">
			<table width="100%" class="table-form">
				<tr>
					<td colspan="2"><h4>Data Penggunaan Aplikasi</h4></td>
				</tr>
				<tr>
					<td>Kode</td>
					<td><input type="text" required="" name="kode" id="kode" value="<?php echo $hasil_setting->kode ;?>" class="form-control">
						<input type="hidden" required="" name="id" id="id" value="<?php echo $hasil_setting->id ;?>" class="form-control">
					</td>
				</tr>
				<tr>
					<td>Nama Koperasi</td>
					<td><input type="text" required="" value="<?php echo @$hasil_setting->nama_koperasi ;?>" name="nama_koperasi" id="nama_koperasi" class="form-control"></td>
				</tr>
				<tr>
					<td>Nama PIC</td>
					<td><input type="text" required="" value="<?php echo @$hasil_setting->nama_pic ;?>" name="nama_pic" id="nama_pic" class="form-control"></td>
				</tr>
				<tr>
					<td>Alamat Koperasi</td>
					<td><input type="text" required="" value="<?php echo @$hasil_setting->alamat_koperasi ;?>" name="alamat_koperasi" id="alamat_koperasi" class="form-control"></td>
				</tr>
				<tr>
					<td>No Telp Koperasi</td>
					<td><input type="text" required="" value="<?php echo @$hasil_setting->no_telp_koperasi ;?>" name="no_telp_koperasi" id="no_telp_koperasi" class="form-control"></td>
				</tr>
				<tr>
					<td>No Telp PIC</td>
					<td><input type="text" required="" value="<?php echo @$hasil_setting->no_telp_pic ;?>" name="no_telp_pic" id="no_telp_pic" class="form-control"></td>
				</tr>
				<tr>
					<td colspan="2"><h4>Periode Kerja / Tahun</h4></td>
				</tr>
				<tr>
					<td>Bulan</td>
					<td>
					
					<select required="" name="periode_kerja_bulan" id="periode_kerja_bulan" class="form-control">
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='01'){ echo "selected";}?> value="01">Januari</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='02'){ echo "selected";}?> value="02">Februari</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='03'){ echo "selected";}?> value="03">Maret</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='04'){ echo "selected";}?> value="04">April</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='05'){ echo "selected";}?> value="05">Mei</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='06'){ echo "selected";}?> value="06">Juni</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='07'){ echo "selected";}?> value="07">Juli</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='08'){ echo "selected";}?> value="08">Agustus</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='09'){ echo "selected";}?> value="09">September</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='10'){ echo "selected";}?> value="10">Oktober</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='11'){ echo "selected";}?> value="11">November</option>
						<option <?php if(@$hasil_setting->periode_kerja_bulan=='12'){ echo "selected";}?> value="12">Desember</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td><input type="date" required="" value="<?php echo @$hasil_setting->periode_kerja_tanggal ;?>" name="periode_kerja_tanggal" id="periode_kerja_tanggal" class="form-control"></td>
				</tr>
				<tr>
					<td colspan="2">
						<button type="submit" class="btn btn-lg btn-block btn-danger">SIMPAN</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div class="col-sm-6">
		<div class="setting-information">
			<p class="text-center">
				Aplikasi Sistem Informasi Wanita
				<br>
				Dedicated To
			</p>
			
			<table width="100%" class="table-form" style="margin-top: 50px;">
				<tr>
					<td width="150px">Kode</td>
					<td align="center" width="40px">:</td>
					<td><?php echo @$hasil_setting->kode ;?></td>
				</tr>
				<tr>
					<td>Nama Koperasi</td>
					<td align="center">:</td>
					<td><?php echo @$hasil_setting->nama_koperasi ;?></td>
				</tr>
				<tr>
					<td>Nama PIC</td>
					<td align="center">:</td>
					<td><?php echo @$hasil_setting->nama_pic ;?></td>
				</tr>
				<tr>
					<td>Alamat Koperasi</td>
					<td align="center">:</td>
					<td><?php echo @$hasil_setting->alamat_koperasi ;?></td>
				</tr>
				<tr>
					<td>No Telp Koperasi</td>
					<td align="center">:</td>
					<td><?php echo @$hasil_setting->no_telp_koperasi ;?></td>
				</tr>
				<tr>
					<td>No Telp PIC</td>
					<td align="center">:</td>
					<td><?php echo @$hasil_setting->no_telp_pic ;?></td>
				</tr>
				<tr>
					<td>Bulan</td>
					<td align="center">:</td>
					<td><?php echo @BulanIndo($hasil_setting->periode_kerja_bulan) ;?></td>
				</tr>
				<tr>
					<td>Tanggal</td>
					<td align="center">:</td>
					<td><?php echo @TanggalIndo($hasil_setting->periode_kerja_tanggal) ;?></td>
				</tr>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#data_form').submit(function () {
		$.ajax({
			url: '<?php echo base_url('setting/setting/simpan'); ?>',
			type: 'post',
			dataType: 'json',
			data: $(this).serialize(),
			beforeSend: function(){
				$('.loading').show();
			},
			success: function(data){
				$('.loading').hide();
				if(data.status_simpan == 'berhasil'){
					window.location.reload();
				}
			}
		});
		return false;
	})

</script>