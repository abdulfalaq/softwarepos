
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Anggota</a></li>
		<li>Pendaftaran</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<form id="form" onsubmit="return false">
		<h1>Pendaftaran Anggota</h1>

		<?php $this->load->view('menu_setting'); 
		$this->db->select_max('kode_anggota');
		$get_kode=$this->db->get('data_anggota');
		$hasil_kode=$get_kode->row();

		$this->db->select_max('id');
		$get_max_anggota = $this->db->get('data_anggota');
		$max_anggota = $get_max_anggota->row();

		$this->db->where('id', $max_anggota->id);
		$get_anggota = $this->db->get('data_anggota');
		$anggota = $get_anggota->row();
		$nomor = substr(@$anggota->kode_anggota, 0);
		$nomor = $nomor + 1;
		$string = strlen($nomor);
		if($string == 1){
			$kode_anggota ='000'.$nomor;
		} else if($string == 2){
			$kode_anggota ='00'.$nomor;
		} else if($string == 3){
			$kode_anggota ='0'.$nomor;
		} else if($string == 4){
			$kode_anggota =''.$nomor;
		}
		?>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right">
						<span class="pull-left" style="font-size: 20px;">Tambah Data Anggota</span>
						<a href="<?php echo @base_url('setting/anggota_pendaftaran'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-plus"></i> Pendaftaran</a>
						<a href="<?php echo @base_url('setting/anggota_verifikasi'); ?>" type="button" class="btn btn-no-radius btn-warning"><i class="fa fa-check"></i>List Verifikasi</a>
						<a href="<?php echo @base_url('setting/anggota_akun'); ?>" type="button" class="btn btn-no-radius btn-primary"><i class="fa fa-list"></i> List Anggota</a>
					</div>
					<div class="panel-body">
						<div class="col-sm-6">
							<table width="100%" class="table-form">
								<tr>
									<td colspan="2"><h4>Data Anggota</h4></td>
								</tr>
								<tr>
									<td width="280px">Kategori Anggota</td>
									<td><select name="kategori_anggota" id="kategori_anggota" onchange="get_kategori()" class="form-control" required="">
										<option value="">--Pilih Kategori --</option>
										<option value="Anggota">Anggota</option>
										<option value="Non Anggota">Non Anggota</option>
									</select></td>
								</tr>
								<tr>
									<td width="280px">Nama Anggota</td>
									<td><input type="text" name="nama_anggota" id="nama_anggota" class="form-control" required=""></td>
								</tr>
								<tr>
									<td>Kode Anggota</td>
									<td><input type="text" name="kode_anggota" id="kode_anggota" class="form-control" readonly="" required="" value="<?php echo $kode_anggota; ?>"></td>
								</tr>
								<tr>
									<td>Jenis Kelamin</td>
									<td>
										<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required="">
											<option value="L">Laki-Laki</option>
											<option value="P">Perempuan</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Tempat Lahir</td>
									<td><input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required=""></td>
								</tr>
								<tr>
									<td>Tanggal Lahir <i>(Tgl/Bln/Thn)</i></td>
									<td><input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="1980-01-01" required=""></td>
								</tr>
								<tr>
									<td>Pekerjaan</td>
									<td><input type="text" name="pekerjaan" id="pekerjaan" required="" class="form-control"></td>
								</tr>
								<tr>
									<td>Alamat</td>
									<td><textarea name="alamat" id="alamat" required="" class="form-control" rows="5"></textarea></td>
								</tr>
								<tr>
									<td>No Telp</td>
									<td><input type="text" name="no_telp" id="no_telp" required="" class="form-control"></td>
								</tr>
								<tr>
									<td>No Telp Alternatif</td>
									<td><input type="text" name="no_telp_alternatif" id="no_telp_alternatif" class="form-control"></td>
								</tr>
								<tr>
									<td>Status Pernikahan</td>
									<td>
										<select onchange="status_perkawinan();" name="status_pernikahan" id="status_pernikahan" class="form-control">
											<option value="belum kawin">Belum Kawin</option>
											<option value="kawin">Kawin</option>
											<option value="janda">Janda</option>
										</select>
									</td>
								</tr>
								<tr class="kawin">
									<td>Nama Suami / Istri</td>
									<td><input type="text" name="nama_istri_suami" class="form-control"></td>
								</tr>
								<tr class="kawin">
									<td>Tempat Lahir Suami / Istri</td>
									<td><input type="text" name="tempat_lahir_istri_suami" class="form-control"></td>
								</tr>
								<tr class="kawin">
									<td>Tanggal Lahir Suami / Istri <i>(Tgl/Bln/Thn)</i></td>
									<td><input type="date" name="tanggal_lahir_istri_suami" class="form-control" value="1980-01-01"></td>
								</tr>
								<tr class="kawin">
									<td>Pekerjaan Suami / Istri</td>
									<td><input type="text" name="pekerjaan_istri_suami" class="form-control"></td>
								</tr>
								<tr class="kawin">
									<td>Alamat Suami / Istri</td>
									<td><textarea name="alamat_istri_suami" class="form-control" rows="5"></textarea></td>
								</tr>
								<tr class="kawin">
									<td>No Telp Suami / Istri</td>
									<td><input type="text" name="no_telp_istri_suami" class="form-control"></td>
								</tr>
							</table>
						</div>
						<?php
						$tanggal_sekarang = date('Y-m-d');
						$setting_terakhir_simpanan_wajib = $this->db->query("SELECT*FROM master_simpanan_wajib WHERE tanggal_aktivasi<='$tanggal_sekarang' order by tanggal_aktivasi desc,id desc limit 1") -> row();
						$setting_terakhir_simpanan_pokok = $this->db->query("SELECT*FROM master_simpanan_pokok WHERE tanggal_aktivasi<='$tanggal_sekarang' order by tanggal_aktivasi desc,id desc limit 1") -> row();
						?>
						<div class="col-sm-6">
							<table width="100%" class="table-form">
								<tr>
									<td colspan="2"><h4>Simpanan</h4></td>
								</tr>
								<tr>
									<td>Simpanan Pokok</td>
									<td>
										<div class="input-group">
											<span class="input-group-addon" id="rp_pokok">Rp</span>
											<input type="number" name="simpanan_pokok" id="simpanan_pokok" required="" value="<?php echo @$setting_terakhir_simpanan_pokok->nominal_simpanan_pokok; ?>" class="form-control anggota">
										</div>
									</td>
								</tr>
								<tr>
									<td>Simpanan Wajib</td>
									<td>
										<div class="input-group">
											<span class="input-group-addon" id="rp_wajib">Rp</span>
											<input type="number" name="simpanan_wajib" id="simpanan_wajib" required="" value="<?php echo @$setting_terakhir_simpanan_wajib->nominal_simpanan_wajib; ?>" class="form-control anggota">
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<button type="submit" class="btn btn-lg btn-super btn-no-radius btn-block btn-danger">SIMPAN</button>
									</td>
								</tr>
							</table>

							<div class="alert alert-success">
								<strong><i class="fa fa-check"></i> Ok!</strong> Data anggota berhasil disimpan
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- //row -->
	</form>
</div>




<script type="text/javascript">
	$(document).ready(function(){
		$('#update_btn').hide();
		status_perkawinan();
		$('.alert').hide();
	});


	function status_perkawinan(){
		var nikah = $('#status_pernikahan').val();
		if(nikah == "kawin"){
			$('.kawin').show();
		}else{
			$('.kawin').hide();
		}
	}
	function get_kategori(){
		var kategori_anggota = $('#kategori_anggota').val();
		if(kategori_anggota == "Anggota"){
			$('.anggota').attr('readonly',false);
		}else{
			$('.anggota').attr('readonly',true);
			$('#simpanan_pokok').val('0');
			$('#simpanan_wajib').val('0');
		}
	}

	
	$('#simpanan_pokok').keyup(function(){
		var nominal = $(this).val();
		if(parseInt(nominal) <= 0){
			alert('Nominal simpanan pokok salah');
			$(this).val('');
		}else{
			$('#rp_pokok').text(toRp(nominal));
		}
	});

	$('#simpanan_wajib').keyup(function(){
		var nominal = $(this).val();
		if(parseInt(nominal) <= 0){
			alert('Nominal simpanan wajib salah');
			$(this).val('');
		}else{
			$('#rp_wajib').text(toRp(nominal));
		}
	});


	$('#form').submit(function(){
		$.ajax({
			url : '<?php echo @base_url('setting/anggota_pendaftaran/act_simpan'); ?>',
			type : 'post',
			data : $(this).serialize(),
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(response){
				$(".tunggu").hide(); 
				if(response == 'ok'){
					$('.alert').show();
					setTimeout(function(){ window.location.href=''; },2000);
				}else{
					alert(response);
				}
			}
		});
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