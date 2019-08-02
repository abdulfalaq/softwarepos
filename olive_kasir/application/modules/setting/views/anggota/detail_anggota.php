<?php
$id = $this->uri->segment(4);
$data = $this->db->get_where('data_anggota',array('id'=>$id))->row();

$data_wajib = $this->db->get_where('data_simpanan_wajib',array('kode_anggota'=>$data->kode_anggota))->row();
$data_pokok = $this->db->get_where('data_simpanan_pokok',array('kode_anggota'=>$data->kode_anggota))->row();
$data_tabungan = $this->db->get_where('data_tabungan',array('kode_anggota'=>$data->kode_anggota))->result();
$this->db->where('kode_anggota', $data->kode_anggota);
$this->db->where('sisa_pinjaman >', '0');
$this->db->where('sisa_pinjaman !=', '');
$data_pinjaman = $this->db->get('data_pinjaman')->result();
?>


<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Anggota</a></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pendaftaran Anggota</h1>

	<?php $this->load->view('menu_setting'); ?>

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
								<td><select name="kategori_anggota" disabled="" id="kategori_anggota" onchange="get_kategori()" class="form-control" required="">
									<option value="">--Pilih Kategori --</option>
									<option <?php if(@$data->kategori_anggota=='Anggota'){ echo "selected";}; ?> value="Anggota">Anggota</option>
									<option <?php if(@$data->kategori_anggota=='Non Anggota'){ echo "selected";}; ?> value="Non Anggota">Non Anggota</option>
								</select></td>
							</tr>
							<tr>
								<td width="280px">Nama Anggota</td>
								<td><input type="text" name="" class="form-control" value="<?php echo @$data->nama_anggota; ?>" readonly=""></td>
							</tr>
							<tr>
								<td>Kode Anggota</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->kode_anggota; ?>"></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>
									<select name="" class="form-control" disabled="">
										<option value="L" <?php echo @$data->jenis_kelamin=='L'?'selected':''; ?>>Laki-Laki</option>
										<option value="P" <?php echo @$data->jenis_kelamin=='P'?'selected':''; ?>>Prempuan</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Tempat Lahir</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->tempat_lahir; ?>"></td>
							</tr>
							<tr>
								<td>Tanggal Lahir <i>(Bln/Tgl/Thn)</i></td>
								<td><input type="date" name="" class="form-control" value="<?php echo @$data->tanggal_lahir; ?>" readonly=""></td>
							</tr>
							<tr>
								<td>Pekerjaan</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->pekerjaan; ?>"></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td><textarea name="" class="form-control" rows="5" readonly=""><?php echo @$data->alamat; ?></textarea></td>
							</tr>
							<tr>
								<td>No Telp</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->no_telp; ?>"></td>
							</tr>
							<tr>
								<td>No Telp Alternatif</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->no_telp_alternatif; ?>"></td>
							</tr>
							<tr>
								<td>Status Pernikahan</td>
								<td>
									<select onchange="status_perkawinan();" name="status_pernikahan" id="status_pernikahan" class="form-control" disabled="">
										<option <?php echo @$data->status_pernikahan=='belum kawin'?'selected':''; ?> value="belum kawin">Belum Kawin</option>
										<option <?php echo @$data->status_pernikahan=='kawin'?'selected':''; ?> value="kawin">Kawin</option>
									</select>
								</td>
							</tr>
							<tr class="kawin">
								<td>Nama Suami / Istri</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->nama_istri_suami; ?>"></td>
							</tr>
							<tr class="kawin">
								<td>Tempat Lahir Suami / Istri</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->tempat_lahir_istri_suami; ?>"></td>
							</tr>
							<tr class="kawin">
								<td>Tanggal Lahir Suami / Istri <i>(Bln/Tgl/Thn)</i></td>
								<td><input type="date" name="" class="form-control" readonly="" value="<?php echo @$data->tanggal_lahir_istri_suami; ?>"></td>
							</tr>
							<tr class="kawin">
								<td>Pekerjaan Suami / Istri</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->pekerjaan_istri_suami; ?>"></td>
							</tr>
							<tr class="kawin">
								<td>Alamat Suami / Istri</td>
								<td><textarea name="alamat_istri_suami" class="form-control" rows="5" readonly=""><?php echo @$data->alamat_istri_suami; ?></textarea></td>
							</tr>
							<tr class="kawin">
								<td>No Telp Suami / Istri</td>
								<td><input type="text" name="" class="form-control" readonly="" value="<?php echo @$data->no_telp_istri_suami; ?>"></td>
							</tr>
						</table>
					</div>
					<div class="col-sm-6">
						<table width="100%" class="table-form">
							<tr>
								<td colspan="2"><h4>Simpanan</h4></td>
							</tr>
							<tr>
								<td>Simpanan Pokok</td>
								<td><input readonly="" id="simpanan_pokok" onkeyup="cek_nominal_simpanan_pokok()" type="number" class="form-control" value="<?php echo @$data_pokok->total_simpanan_pokok; ?>" ></td>
							</tr>
							<tr>
								<td>Simpanan Wajib</td>
								<td><input readonly="" id="simpanan_wajib" value="<?php echo @$data_wajib->total_simpanan_wajib; ?>" type="number" class="form-control"></td>
							</tr>
							<?php
							foreach ($data_tabungan as $tabungan) {
								?>
								<tr>
									<td>Tabungan <?php echo $tabungan->nama_produk; ?></td>
									<td><input readonly="" value="<?php echo @$tabungan->total_saldo_tabungan; ?>" type="number" class="form-control"></td>
								</tr>
								<?php
							}
							?>
							<tr>
								<td colspan="2"><h4>Pinjaman</h4></td>
							</tr>
							<?php
							foreach ($data_pinjaman as $pinjaman) {
								?>
								<tr>
									<td>Pinjaman <?php echo $pinjaman->nama_produk_pinjaman; ?></td>
									<td><input readonly="" value="<?php echo @$pinjaman->sisa_pinjaman; ?>" type="number" class="form-control"></td>
								</tr>
								<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>




<script type="text/javascript">
	$(document).ready(function(){
		$('#update_btn').hide();
		status_perkawinan();
		get_kategori();
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
		var simpanan_pokok = '<?php echo @$setting_terakhir_simpanan_pokok->nominal_simpanan_pokok; ?>';
		var simpanan_wajib = '<?php echo @$setting_terakhir_simpanan_wajib->nominal_simpanan_wajib; ?>';
		if(kategori_anggota == "Anggota"){
			$('.anggota').attr('readonly',false);
			$('#simpanan_pokok').val(simpanan_pokok);
			$('#simpanan_wajib').val(simpanan_wajib);
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
		}
	});

	$('#simpanan_wajib').keyup(function(){
		var nominal = $(this).val();
		if(parseInt(nominal) <= 0){
			alert('Nominal simpanan wajib salah');
			$(this).val('');
		}
	});
</script>