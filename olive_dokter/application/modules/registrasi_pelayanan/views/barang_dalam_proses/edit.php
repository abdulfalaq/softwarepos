<style>
.loader {
	border: 2px solid #d1d1d1;
	border-top: 2px solid grey;
	border-radius: 50%;
	width: 20px;
	height: 20px;
	margin: 0px auto;
	animation: spin 2s linear infinite;
	margin-top: 6px;
}

@keyframes spin {
	0% { transform: rotate(0deg); }
	100% { transform: rotate(360deg); }
}

.page_loader {
	width: 86%;
	height: 100%;
	background:rgba(255, 255, 255, 0.77);
	z-index: 99;
	position: absolute;
	text-align: center;
	display: none;
}
</style>

<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Barang Dalam Proses</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>
<div class="container">
	<h1>Master Barang Dalam Proses </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Barang Dalam Proses </span>
					<a href="<?php echo base_url('master/barang_dalam_proses/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Barang Dalam Proses</a>
					<a href="<?php echo base_url('master/barang_dalam_proses/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Barang Dalam Proses</a>
				</div>
				<?php
				$kode_barang=$this->uri->segment(4);
				$get_barang=$this->db2->get_where('master_barang_dalam_proses',array('kode_barang' =>$kode_barang));
				$hasil_barang=$get_barang->row();
				?>
				<div class="panel-body">
					<form action="">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-5">
									<label for="">Kode Barang</label>
									<input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Bahan Baku" readonly aria-describedby="basic-addon1" value="<?php echo @$hasil_barang->kode_barang; ?>">
								</div>
								<div class="col-md-5">
									<label for="">Satuan Stok</label>
									<select name="kode_satuan_stok" id="kode_satuan_stok" class="form-control">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_satuan')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_barang->kode_satuan_stok==@$value->kode){ echo "selected";}?> value="<?= $value->kode ?>"><?= $value->nama ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-5">
									<label for="">Nama Barang</label>
									<input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang"  aria-describedby="basic-addon1" value="<?php echo @$hasil_barang->nama_barang; ?>">
								</div>
								<div class="col-md-5">
									<label for="">Gudang</label>
									<select name="kode_gudang" id="kode_gudang" class="form-control">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_gudang')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_barang->kode_gudang==@$value->kode_gudang){ echo "selected";}?> value="<?= $value->kode_gudang ?>"><?= $value->nama_gudang ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								
								<div class="col-md-5">
									<label for="">Stok Minimal</label>
									<input type="number" class="form-control" placeholder="Stok Minimal" onkeyup="cek_minimal()" id="stok_minimal" name="stok_minimal" aria-describedby="basic-addon1" value="<?php echo @$hasil_barang->stok_minimal; ?>">
								</div>
							</div><br>
							
							<div class="row">
								<div class="col-md-10 text-right">
									<a onclick="lock_form_top()" id="btn_lock" class="btn btn-warning btn-no-radius btn-md">Lock</a>
								</div>
							</div>
							<br>
							<hr>
							<br>
							<div id="addforms">
								<div class="row">
									<div class="col-md-2">
										<h5>Jenis Bahan</h5>
									</div>
									<div class="col-md-2">
										<h5>Bahan</h5>
									</div>
									<div class="col-md-2">
										<h5>Jumlah</h5>
									</div>
									<div class="col-md-2">
										<h5>Satuan</h5>
									</div>
									<div class="col-md-2">
										<h5>Konversi</h5>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<select name="jenis_bahan" id="jenis_bahan" onchange="get_bahan()">
											<option value="">-- Pilih Jenis Bahan</option>
											<option value="BB">Bahan Baku</option>
											<option value="BDP">Bahan Dalam Proses</option>
										</select>
									</div>
									<div class="col-md-2">
										<div class="page_loader" id="load_select" >
											<div class="loader"></div>
										</div>
										<select name="bahan" id="bahan" onchange="get_satuan()">
											<option value="">-- Pilih Bahan</option>
										</select>
									</div>
									<div class="col-md-2">
										<input type="number" onkeyup="cek_jumlah()" class="form-control" id="jumlah" name="jumlah">
									</div>
									<div class="col-md-2">
										<div class="page_loader" id="load_satuan" >
											<div class="loader"></div>
										</div>
										<input type="text" class="form-control" id="satuan" name="satuan" readonly>
									</div>
									<div class="col-md-2">
										<input type="number" onkeyup="cek_konversi()" class="form-control" id="konversi" name="konversi">
									</div>
									<div class="col-md-1">
										<a onclick="add_bdp()" class="btn btn-info btn-no-radius btn-md"><i class="fa fa-plus"></i> Add</a>
									</div>
								</div>
								<br><hr><br>
								<div class="col-md-12 row">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Bahan</th>
												<th>Jumlah</th>
												<th>Konversi</th>
												<th>Satuan</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody id='load_temp'>
											
										</tbody>
									</table>
									<hr><br>
								</div>
								<a onclick="$('#modal-konfirmasi').modal('show')" class="btn btn-no-radius btn-info pull-right btn-lg"><i class="fa fa-send"></i> Simpan</a>
								<a onclick="location.reload()" class="btn btn-no-radius btn-warning pull-right btn-lg"><i class="fa fa-close"></i> Cancel</a>
								<br>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<div id="modal-simpan" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="simpan_bdp()" class="btn btn-success"><i class="fa fa-trash"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#addforms').hide();
	});

	function hapus(key) {
		$('#modal-hapus').modal('show');
	}
	function cek_minimal() {
		stok_minimal = $('#stok_minimal').val();
		if(stok_minimal=='' || parseInt(stok_minimal) < 0){
			alert("Stok Minimal Salah ..!");
			$('#stok_minimal').val('');
		}
	}
	function cek_jumlah() {
		jumlah = $('#jumlah').val();
		if(jumlah=='' || parseInt(jumlah) < 0){
			alert("Jumlah Salah ..!");
			$('#jumlah').val('');
		}
	}
	function cek_konversi() {
		konversi = $('#konversi').val();
		if(konversi=='' || parseInt(konversi) < 0){
			alert("Konversi Salah ..!");
			$('#konversi').val('');
		}
	}

	function get_bahan() {
		jenis_bahan = $('#jenis_bahan').val();

		$.ajax({  
			type 	:"post",  
			url 	:"<?php echo base_url() . 'master/barang_dalam_proses/get_bahan' ?>",  
			cache 	:false,  
			data 	:{jenis_bahan:jenis_bahan},
			beforeSend:function(){
				$('#load_select').show();
			},
			success : function(data) { 
				$('#load_select').hide();
				$('#bahan').html(data);
			},  
			error : function() {
				alert("Data Diambil.");  
			}  
		});
		return false;   
	}

	function get_satuan(){
		kode_bahan 	= $('#bahan').val();
		jenis_bahan = $('#jenis_bahan').val();

		$.ajax({  
			type 	:"post",  
			url 	:"<?php echo base_url() . 'master/barang_dalam_proses/get_satuan' ?>",  
			cache 	:false,  
			data 	:{kode_bahan:kode_bahan,jenis_bahan:jenis_bahan},
			dataType:'Json',
			beforeSend:function(){
				$('#load_satuan').show();
			},
			success : function(data) { 
				$('#load_satuan').hide();
				$('#satuan').val(data.satuan);
			},  
			error : function() {
				alert("Data Gagal Diambil.");  
			}  
		});
		return false;   
	}

	function lock_form_top(){
		stok_minimal 			= $('#stok_minimal').val();
		kode_satuan_stok 		= $('#kode_satuan_stok').val();
		nama_barang 			= $('#nama_barang').val();
		kode_gudang 			= $('#kode_gudang').val();
		

		if (stok_minimal == '' || kode_satuan_stok == '' || nama_barang == '' ||  kode_gudang == ''  ) {
			alert('Harap Melengkapi Form.');
		} else {
			$('#stok_minimal').attr('disabled',true);
			$('#kode_satuan_stok').attr('disabled',true);
			$('#nama_barang').attr('disabled',true);
			$('#kode_satuan_pembelian').attr('disabled',true);
			$('#kode_gudang').attr('disabled',true);
			
			$('#btn_lock').attr('disabled',true);
			$('#addforms').fadeIn('fast');
			load_table_temp();
		}
		return false;   
	}

	function add_bdp(){
		jenis_bahan = $('#jenis_bahan').val();
		bahan 		= $('#bahan').val();
		jumlah 		= $('#jumlah').val();
		konversi 	= $('#konversi').val();
		kode_barang = $('#kode_barang').val();

		if (jenis_bahan == '' || bahan == '' || jumlah == '' || satuan == '' || konversi == '') {
			alert('Harap Melengkapi Form.');
		}else{
			$.ajax({  
				type 	:"post",  
				url 	:"<?php echo base_url() . 'master/barang_dalam_proses/add_bdp_temp' ?>",  
				cache 	:false,  
				data 	:{jenis_bahan:jenis_bahan,bahan:bahan,jumlah:jumlah,konversi:konversi,kode_barang:kode_barang},
				dataType:'Json',
				beforeSend:function(){
					$('.tunggu').show();
				},
				success : function(data) { 
					$('.tunggu').hide();
					if (data.response == 'sukses') {
						load_table_temp();
						$('.tunggu').hide();
						 $('#jenis_bahan').val('');
						 $('#bahan').val('');
						 $('#jumlah').val('');
						 $('#konversi').val('');
						 $('#satuan').val('');
					}else{
						alert('Kesalahan Menambah Data');
					}
				},  
				error : function() {
					alert("Data Gagal Ditambahkan.");  
				}  
			})
		}
		return false;
	}

	function load_table_temp(){
		$('#load_temp').load("<?php echo base_url().'master/barang_dalam_proses/load_table_temp'?>");
	}



	function delete_temp(key){
		var confirm = confirm("Press a button!");
		if (confirm == true) {
			$.ajax({  
				type 	:"post",  
				url 	:"<?php echo base_url() . 'master/barang_dalam_proses/delete_temporary_item' ?>",  
				cache 	:false,  
				data 	:{id:key},
				success : function(data) { 
					load_table_temp();
				}
			})
		} 
		
	}
	function simpan_bdp() {
		var kode_barang=$('#kode_barang').val();
		var kode_satuan_stok=$('#kode_satuan_stok').val();
		var nama_barang=$('#nama_barang').val();
		var kode_gudang=$('#kode_gudang').val();
		var stok_minimal=$('#stok_minimal').val();
		
		$.ajax({
			url: '<?php echo base_url('master/barang_dalam_proses/update_bdp'); ?>',
			type: 'post',
			data:{kode_barang:kode_barang,kode_satuan_stok:kode_satuan_stok,kode_gudang:kode_gudang,nama_barang:nama_barang,stok_minimal:stok_minimal},
			beforeSend:function(){
				$('#modal-konfirmasi').modal('hide');
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('master/barang_dalam_proses/daftar');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
</script>