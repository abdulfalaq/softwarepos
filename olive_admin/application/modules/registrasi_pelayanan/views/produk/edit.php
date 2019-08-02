
<!-- back button -->
<a href="<?php echo base_url('master'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Produk</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Produk </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Produk </span>
					<a href="<?php echo base_url('master/produk/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Produk</a>
					<a href="<?php echo base_url('master/produk/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Produk</a>
				</div>
				<?php
				$kode_produk=$this->uri->segment(4);
				$get_produk=$this->db2->get_where('master_produk',array('kode_produk' =>$kode_produk));
				$hasil_produk=$get_produk->row();

				$get_harga=$this->db2->get_where('master_harga_barang',array('kode_barang' =>$kode_produk));
				$hasil_harga=$get_harga->row();
				?>
				<div class="panel-body">
					<form action="">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<label for="">Kode Produk</label>
									<input type="text" class="form-control data_produk" id="kode_produk" name="kode_produk" placeholder="Kode Bahan Baku" readonly  value="<?php echo @$hasil_produk->kode_produk; ?>">
								</div>
								<div class="col-md-6">
									<label for="">Nama Produk</label>
									<input type="text" class="form-control data_produk" id="nama_produk" name="nama_produk" placeholder="Nama Produk"  value="<?php echo @$hasil_produk->nama_produk; ?>">
								</div>
								
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<label for="">Satuan Stok</label>
									<select name="kode_satuan_stok" id="kode_satuan_stok" class="form-control data_produk">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_satuan')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_produk->kode_satuan_stok==@$value->kode){ echo "selected";}?> value="<?= $value->kode ?>"><?= $value->nama ?></option>
										<?php }
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="">Gudang</label>
									<select name="kode_gudang" id="kode_gudang" class="form-control data_produk">
										<option value="">-- Pilih Satuan</option>
										<?php 
										$get_satuan = $this->db2->get('master_gudang')->result();
										foreach ($get_satuan as $value) { ?>
										<option <?php if(@$hasil_produk->kode_gudang==@$value->kode_gudang){ echo "selected";}?> value="<?= $value->kode_gudang ?>"><?= $value->nama_gudang ?></option>
										<?php }
										?>
									</select>
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-6">
									<label for="">Stok Minimal</label>
									<input type="number" class="form-control data_produk" placeholder="Stok Minimal" onkeyup="cek_minimal()" id="stok_minimal" name="stok_minimal" value="<?php echo @$hasil_produk->stok_minimal; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 1</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 1" id="harga1" name="harga1" value="<?php echo @$hasil_harga->harga1; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 2</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 2" id="harga2" name="harga2" value="<?php echo @$hasil_harga->harga2; ?>">
								</div>
							</div><br>
							<div class="row">
								
								<div class="col-md-3">
									<label for="">Harga 3</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 3" id="harga3" name="harga3" value="<?php echo @$hasil_harga->harga3; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 4</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 4" id="harga4" name="harga4" value="<?php echo @$hasil_harga->harga4; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 5</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 5" id="harga5" name="harga5" value="<?php echo @$hasil_harga->harga5; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 6</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 6" id="harga6" name="harga6" value="<?php echo @$hasil_harga->harga6; ?>">
								</div>
							</div><br>
							<div class="row">
								<div class="col-md-3">
									<label for="">Harga 7</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 7" id="harga7" name="harga7" value="<?php echo @$hasil_harga->harga7; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 8</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 8" id="harga8" name="harga8" value="<?php echo @$hasil_harga->harga8; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 9</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 9" id="harga9" name="harga9" value="<?php echo @$hasil_harga->harga9; ?>">
								</div>
								<div class="col-md-3">
									<label for="">Harga 10</label>
									<input type="number" class="form-control harga data_produk" placeholder="Harga 10" id="harga10" name="harga10" value="<?php echo @$hasil_harga->harga10; ?>">
								</div>
							</div><br>
							
							<div class="row">
								<div class="col-md-12 text-right">
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
									
									<div class="col-md-1">
										<a onclick="add_produk()" class="btn btn-info btn-no-radius btn-md"><i class="fa fa-plus"></i> Add</a>
									</div>
								</div>
								<br><hr><br>
								<div class="col-md-12 row">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Bahan</th>
												<th>Jenis Bahan</th>
												<th>Jumlah</th>
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
	</div> <!-- //row -->
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
				<button type="button" onclick="simpan_produk()" class="btn btn-success"><i class="fa fa-trash"></i> Simpan</button>
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
	$('.harga').on('keyup', function() {
        harga=this.value;
        if(harga=='' || parseInt(harga) < 0){
			alert("Harga Salah ..!");
			$(this).val('');
		}
    });

	function get_bahan() {
		jenis_bahan = $('#jenis_bahan').val();

		$.ajax({  
			type 	:"post",  
			url 	:"<?php echo base_url() . 'master/produk/get_bahan' ?>",  
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
			url 	:"<?php echo base_url() . 'master/produk/get_satuan' ?>",  
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
		nama_produk 			= $('#nama_produk').val();
		kode_gudang 			= $('#kode_gudang').val();
		harga1= $('#harga1').val();
		harga2= $('#harga2').val();
		harga3= $('#harga3').val();
		harga4= $('#harga4').val();
		harga5= $('#harga5').val();
		harga6= $('#harga6').val();
		harga7= $('#harga7').val();
		harga8= $('#harga8').val();
		harga9= $('#harga9').val();
		harga10= $('#harga10').val();
		

		if (stok_minimal == '' || kode_satuan_stok == '' || nama_produk == '' ||  kode_gudang == '' || harga1 == '' || harga2 == ''
			|| harga3 == '' || harga4 == '' || harga5 == '' || harga6 == '' || harga7 == '' || harga9 == '' || harga10 == '') {
			alert('Harap Melengkapi Form.');
		} else {
			$('.data_produk').attr('disabled',true);
			$('#btn_lock').attr('disabled',true);
			$('#addforms').fadeIn('fast');
			load_table_temp();
		}
		return false;   
	}

	function add_produk(){
		jenis_bahan = $('#jenis_bahan').val();
		bahan 		= $('#bahan').val();
		jumlah 		= $('#jumlah').val();
		konversi 	= $('#konversi').val();
		kode_produk = $('#kode_produk').val();

		if (jenis_bahan == '' || bahan == '' || jumlah == '' || satuan == '' || konversi == '') {
			alert('Harap Melengkapi Form.');
		}else{
			$.ajax({  
				type 	:"post",  
				url 	:"<?php echo base_url() . 'master/produk/add_produk_temp' ?>",  
				cache 	:false,  
				data 	:{jenis_bahan:jenis_bahan,bahan:bahan,jumlah:jumlah,konversi:konversi,kode_produk:kode_produk},
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
		$('#load_temp').load("<?php echo base_url().'master/produk/load_table_temp'?>");
	}



	function delete_temp(key){
		var confirm = confirm("Press a button!");
		if (confirm == true) {
			$.ajax({  
				type 	:"post",  
				url 	:"<?php echo base_url() . 'master/produk/delete_temporary_item' ?>",  
				cache 	:false,  
				data 	:{id:key},
				success : function(data) { 
					load_table_temp();
				}
			})
		} 
		
	}
	function simpan_produk() {
		var kode_produk=$('#kode_produk').val();
		var kode_satuan_stok=$('#kode_satuan_stok').val();
		var nama_produk=$('#nama_produk').val();
		var kode_gudang=$('#kode_gudang').val();
		var stok_minimal=$('#stok_minimal').val();

		harga1= $('#harga1').val();
		harga2= $('#harga2').val();
		harga3= $('#harga3').val();
		harga4= $('#harga4').val();
		harga5= $('#harga5').val();
		harga6= $('#harga6').val();
		harga7= $('#harga7').val();
		harga8= $('#harga8').val();
		harga9= $('#harga9').val();
		harga10= $('#harga10').val();
		
		$.ajax({
			url: '<?php echo base_url('master/produk/update_produk'); ?>',
			type: 'post',
			data:{kode_produk:kode_produk,kode_satuan_stok:kode_satuan_stok,kode_gudang:kode_gudang,nama_produk:nama_produk,stok_minimal:stok_minimal,harga1:harga1,harga2:harga2,harga3:harga3,harga4:harga4,harga5:harga5,harga6:harga6,harga7:harga7,harga8:harga8,harga9:harga9,harga10:harga10
			},
			beforeSend:function(){
				$('#modal-konfirmasi').modal('hide');
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('master/produk/daftar');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
</script>