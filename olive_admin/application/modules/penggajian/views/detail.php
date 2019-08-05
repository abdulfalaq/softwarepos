<?php 
$kode_transaksi=$this->uri->segment(3);
$this->db->where('kode_transaksi',$kode_transaksi);
$get_gudang = $this->db->get('clouoid1_olive_keuangan.transaksi_penggajian')->row();
?>
<a href="<?php echo base_url('penggajian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penggajian'); ?>">Penggajian</a></li>
		<li><a href="#">Detail</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Detail</span>
					<a href="<?php echo base_url('penggajian/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('penggajian/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="row">
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Tanggal Penggajian</b></label>

								<input type="date" class="form-control" value="<?php echo $get_gudang->tanggal_transaksi ?>" name="tanggal_transaksi" id="tanggal_transaksi" disabled>
							</div>
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Karyawan</b></label>
								<input class="form-control" type="text" id="kode_transaksi" name="kode_transaksi" value="<?php echo $get_gudang->kode_transaksi ?>" disabled="" /> 
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Gaji Pokok</b></label>
								<div class="input-group">
									<input type="text" class="form-control" onkeyup="get_jumlah()"  name="gaji_pokok" id="gaji_pokok" value="<?php echo @format_rupiah($get_gudang->gaji_pokok) ?>" disabled="" >
									<span class="input-group-addon"><div id="n_gaji_pokok"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Insentif Kehadiran</b></label>
								<div class="input-group">
									<input type="text" class="form-control" onkeyup="get_jumlah()"  name="insentif_kehadiran" id="insentif_kehadiran" value="<?php echo @format_rupiah($get_gudang->insentif_kehadiran) ?>" disabled="" >
									<span class="input-group-addon"><div id="n_insentif_kehadiran"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Insentif Treatment & Masker</b></label>
								<div class="input-group">
									<input type="text" class="form-control" onkeyup="get_jumlah()"  name="insentif_treatment" id="insentif_treatment" value="<?php echo @format_rupiah($get_gudang->insentif_treatment) ?>" disabled="" >
									<span class="input-group-addon"><div id="n_insentif_treatment"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Tunjangan Jabatan</b></label>
								<div class="input-group">
									<input type="text" class="form-control" onkeyup="get_jumlah()"  name="tunjangan_jabatan" id="tunjangan_jabatan" value="<?php echo @format_rupiah($get_gudang->tunjangan_jabatan) ?>" disabled="" >
									<span class="input-group-addon"><div id="n_tunjangan_jabatan"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Insentif Cuti</b></label>
								<div class="input-group">
									<input type="text" class="form-control" onkeyup="get_jumlah()"  name="insentif_cuti" id="insentif_cuti"  value="<?php echo @format_rupiah($get_gudang->insentif_cuti) ?>" disabled="" >
									<span class="input-group-addon"><div id="n_insentif_cuti"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Lembur</b></label>
								<div class="input-group">
									<input type="text" class="form-control" onkeyup="get_jumlah()"  name="lembur" id="lembur" value="<?php echo @format_rupiah($get_gudang->lembur) ?>" disabled="" >
									<span class="input-group-addon"><div id="n_lembur"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Potongan</b></label>
								<div class="input-group">
									<input type="text" class="form-control" onkeyup="get_jumlah()"  name="potongan" id="potongan" value="<?php echo @format_rupiah($get_gudang->potongan) ?>" disabled="" >
									<span class="input-group-addon"><div id="n_potongan"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Total</b></label>
								<input type="text" disabled class="form-control"  name="total_gaji" id="total_gaji" value="<?php echo @format_rupiah($get_gudang->total_gaji) ?>" disabled="" >
							</div>
						</div>
						<br><br>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

</script>
