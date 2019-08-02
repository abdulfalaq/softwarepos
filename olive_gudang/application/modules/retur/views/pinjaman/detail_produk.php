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
					<span class="pull-left" style="font-size: 24px">Detail Produk Pinjaman</span>
					<a href="<?php echo base_url('setting/pinjaman'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
					<a href="<?php echo base_url('setting/pinjaman/data_produk'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
				</div>
				<?php
				$id=$this->uri->segment(4);
				$this->db->where('id',$id);
				$get_produk=$this->db->get('master_produk_pinjaman');
				$hasil_produk=$get_produk->row();
				?>
				<div class="panel-body">
					<div class="row">	
						<div class="col-lg-12">
							<label>Ketentuan Pinjaman</label>
							<div class="input-group" style="width: 50%">
								<input disabled="" type="text" id="ketentuan_pinjaman"  name="ketentuan_pinjaman" value="<?php echo @$hasil_produk->ketentuan_pinjaman;?>"  class="form-control" required="">
								<span class="input-group-addon"> %</span>
							</div><br>
							<label>Nama Pinjaman</label>
							<div class="input-group" style="width: 50%">
								<input disabled="" type="text" id="nama_pinjaman" value="<?php echo @$hasil_produk->nama_produk;?>" name="nama_pinjaman" class="form-control" required="">
							</div><br>
							<label>Plafond Pinjaman / Maks. Pinjaman</label>
							<div class="input-group" style="width: 50%">
								<input disabled="" type="number" value="<?php echo @$hasil_produk->plafon;?>" id="plafond" name="plafond" class="form-control" >
							</div><br>
							<label>Tenor / Jumlah Angsuran</label>
							<div class="input-group" style="width: 50%">
								<input disabled="" type="number" id="tenor" name="tenor" class="form-control" required="" value="<?php echo @$hasil_produk->tenor;?>">
								<span class="input-group-addon">Bulan</span>
							</div><br>
							<label>Jenis Jasa</label>
							<div class="input-group" style="width: 50%">
								<select disabled="" readonly name="jasa" id="jasa" onchange="jenis_jasa()">
									<option value="">- Pilih Jenis Jasa</option>
									<option <?php  if(@$hasil_produk->jenis_jasa=="bulan"){echo "selected";}?> value="bulan">Bulan</option>
									<option <?php  if(@$hasil_produk->jenis_jasa=="tahun"){echo "selected";}?> value="tahun">Tahun</option>
								</select>
							</div><br>
							<label class="tahun">* Jasa Pertahun</label>
							<div class="input-group tahun" style="width: 50%">
								<span class="input-group-addon">%</span>
								<input disabled="" type="number" value="<?php echo @$hasil_produk->jasa_per_tahun;?>" id="pertahun" name="pertahun" onkeyup="hitung_per_bulan()" onkeydown="hitung_per_bulan()" placeholder="0" class="form-control">
								<span class="input-group-addon"> / Tahun</span>
							</div><br>
							<label class="tahun">* Jasa Perbulan</label>
							<div class="input-group tahun" style="width: 50%">
								<span class="input-group-addon">%</span>
								<input disabled="" type="number" id="perbulan" value="<?php echo @$hasil_produk->jasa_per_bulan;?>" name="" placeholder="0" class="form-control" readonly>
								<span class="input-group-addon"> / Bulan</span>
							</div><br>
							<label class="bulan" style="margin-top: -32px;">** Jasa Perbulan</label>
							<div class="input-group bulan" style="width: 50%">
								<span class="input-group-addon">%</span>
								<input disabled="" type="number" id="jasa_perbulan" value="<?php echo @$hasil_produk->jasa_per_bulan;?>" name="jasa_perbulan" placeholder="0" class="form-control">
								<span class="input-group-addon"> / Bulan</span>
							</div>
						</div>
						<div class="col-lg-12">

							<label>Status Denda</label>
							<div class="input-group" style="width: 50%">
								<select disabled="" readonly name="status_denda" id="status_denda" onchange="status_denda()">
									<option <?php if(@$hasil_produk->biaya_administrasi=="tidak"){echo "selected";}?> value="tidak">Tidak Ada</option>
									<option <?php if(@$hasil_produk->biaya_administrasi=="ada"){echo "selected";}?> value="ada">Ada</option>					
								</select>
							</div><br>
							<label class="status_denda">Nominal Denda</label>
							<div class="input-group status_denda" style="width: 50%">
								<span class="input-group-addon">Rp.</span>
								<input disabled="" type="number" id="nominal_denda" value="<?php echo @$hasil_produk->nominal_denda;?>" name="nominal_denda" placeholder="0" class="form-control">
							</div><br>

							<label>Biaya Provisi</label>
							<div class="input-group" style="width: 50%">
								<select disabled="" readonly name="status_provisi" id="status_provisi" onchange="status_provisi()">					
									<option <?php if(@$hasil_produk->biaya_provisi=="tidak"){echo "selected";}?> value="tidak">Tidak Ada</option>
									<option <?php if(@$hasil_produk->biaya_provisi=="ada"){echo "selected";}?> value="ada">Ada</option>
								</select>
							</div><br>
							<label class="status_provisi">Nominal Biaya Provisi</label>
							<div class="input-group status_provisi" style="width: 50%">
								<input disabled="" type="text" id="nominal_provisi"  value="<?php echo @$hasil_produk->nominal_biaya_provisi;?>" name="nominal_provisi" placeholder="0" class="form-control">
								<span class="input-group-addon">%</span>
							</div><br>

							<label>Administrasi</label>
							<div class="input-group" style="width: 50%">
								<span class="input-group-addon">Rp.</span>
								<input disabled="" type="number" id="nominal_administrasi" value="<?php echo @$hasil_produk->nominal_biaya_administrasi;?>" name="nominal_administrasi" placeholder="0" class="form-control">
							</div><br>

							<label>Potongan</label>
							<div class="input-group" style="width: 50%">
								<select disabled="" readonly name="potongan" id="potongan" onchange="status_angsuran()">
									<option <?php if(@$hasil_produk->penarikan_jasa_pinjaman=="di bayar di depan"){echo "selected";}?> value="di bayar di depan">Di Bayar Di Depan</option>
									<option <?php if(@$hasil_produk->penarikan_jasa_pinjaman=="cicilan bulan pertama"){echo "selected";}?> value="cicilan bulan pertama">Cicilan Bulan Pertama</option>	
									<option <?php if(@$hasil_produk->penarikan_jasa_pinjaman=="tidak ada"){echo "selected";}?> value="tidak ada">Tidak Ada</option>					
								</select>
							</div><br>
						</div>
					</div>
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
<script>

	$(document).ready(function(){
		$('.status_denda').hide();
		$('.status_provisi').hide();
		$('.status_angsuran').hide();
		$('.tahun').hide();
		$('.bulan').hide();
		jenis_jasa();
		status_denda();
		status_provisi();
		status_angsuran();
		hitung_per_bulan()
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
		var parsing 		= parseFloat(Math.round(total_perbulan * 100) / 100).toFixed(3)

		$('#perbulan').val(parsing);
	}
</script>