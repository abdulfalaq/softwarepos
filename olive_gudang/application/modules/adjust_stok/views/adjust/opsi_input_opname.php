

<a href="<?php echo base_url('adjust_stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('adjust_stok'); ?>">Adjust Stok</a></li>
		<li><a href="#">Adjust</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Adjust Stok</h1>
	<?php $kode = $this->uri->segment(4); ?>
	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<form id="simpan_adjust">
			<input type="hidden" name="kode_opname" value="<?php echo $kode ?>">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading text-right" style="height: 55px">
						<span class="pull-left" style="font-size: 24px">Input Adjust</span>
					</div>
					<div class="panel-body">
						<div class="box-body">   
							<table class="table table-striped table-hover table-bordered" id="tabel_daftarr">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Bahan</th>
										<th>QTY Opname</th>
										<th>QTY Fisik</th>
										<th>Selisih</th>
										<th>Status</th>
										<th>Keterangan</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									$no = 0;									
									$this->db->where('kode_opname', $kode);
									$get_opname = $this->db->get('opsi_transaksi_opname')->result();
									foreach ($get_opname as $value) { $no++;
										if ($value->jenis_bahan == 'Perlengkapan') {
											$get_perlengkapan = $this->db_master->get_where('master_perlengkapan',array('kode_perlengkapan' => $value->kode_bahan ))->row();
											$nama_bahan = $get_perlengkapan->nama_perlengkapan;
										}else if ($value->jenis_bahan == 'Bahan Baku') {
											$get_bahan_baku = $this->db_master->get_where('master_bahan_baku',array('kode_bahan_baku' => $value->kode_bahan ))->row();
											$nama_bahan = $get_bahan_baku->nama_bahan_baku;
										}else if ($value->jenis_bahan == 'Produk') {
											$get_produk = $this->db_master->get_where('master_produk',array('kode_produk' => $value->kode_bahan ))->row();
											$nama_bahan = $get_produk->nama_produk;
										} ?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nama_bahan ?></td>
											<td><input type="number" readonly required="" id="stok_awal_<?php echo $value->id ?>" value="<?php echo $value->stok_awal ?>" class="form-control"></td>
											<td><input type="number" required="" id="stok_akhir_<?php echo $value->id ?>" onkeyup="qty_fisik_up('<?php echo $value->id ?>')" name="qty_akhir_<?php echo $value->id ?>" class="form-control qty_akhir"></td>
											<td><input type="text" required="" readonly id="selisih_<?php echo $value->id ?>" name="selisih_<?php echo $value->id ?>" class="form-control"></td>
											<td><input type="text" required="" readonly id="status_<?php echo $value->id ?>" name="status_<?php echo $value->id ?>" class="form-control"></td>
											<td><input type="text" required="" id="status" name="keterangan_<?php echo $value->id ?>" class="form-control" placeholder="keterangan"></td>
											<td>
												<a onclick="$('#modal-hapus').modal('show'), $('#id_del').val('<?php echo $value->id ?>')" class="btn btn-no-radius btn-danger" >Delete</a>
											</td>
										</tr>
										<?php 
									} ?>
								</tbody>
							</table>	
							<br><br>
							<a onclick="$('#modal-konfirmasi').modal('show')" class="btn btn-no-radius pull-right btn-info"><i class="fa fa-send"></i> Simpan</a>					
						</div>
					</div>
				</div>
			</div>

			<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content" style="border-radius:0px;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Konfirmasi</h4>
						</div>
						<div class="modal-body text-center">
							<h2>Anda Yakin Data Tersebut Benar ?</h2>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-warning btn-no-radius pull-left" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-no-radius btn-info">Yakin</button>
						</div>
					</div>
				</div>
			</div>

			<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content" style="border-radius:0px;">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Konfirmasi Hapus</h4>
						</div>
						<div class="modal-body text-center">
							<h2>Anda Yakin Data Tersebut Dihapus ?</h2>
							<input type="hidden" id="id_del">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success btn-no-radius pull-left" data-dismiss="modal">Batal</button>
							<a onclick="hapus_opsi()" class="btn btn-no-radius btn-danger">Yakin</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function(){



		document.querySelector('.qty_akhir').addEventListener("keypress", function (evt) {
			var theEvent = evt || window.event;
			var key = theEvent.keyCode || theEvent.which;
			key = String.fromCharCode( key) ;
			var regex =/^[0-9.,]+$/;
			if( !regex.test(key))  {
				theEvent.returnValue = false;
				if(theEvent.preventDefault) theEvent.preventDefault();
			}
		});

	});

	function get_bahan () {
		jenis_bahan = $('#jenis_bahan').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'adjust_stok/adjust/get_bahan' ?>",  
			cache :false,  
			data :{jenis_bahan:jenis_bahan},
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				$(".tunggu").hide();   
				$("#kode_bahan").html(data);
			}
		});
	}

	function load_table_opsi(){
		kode_opname 	= $('#kode_opname').val();
		$('.load_opsi_jadwal').load('<?php echo base_url() ?>adjust_stok/adjust/opsi_jadwal/'+kode_opname);
	}

	function add_jadwal_opname(){
		kode_opname = $('#kode_opname').val();
		tanggal 	= $('#tanggal').val();
		jenis_bahan = $('#jenis_bahan').val();
		kode_bahan 	= $('#kode_bahan').val();

		if (tanggal != '' && jenis_bahan != '' && kode_bahan != '') {
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'adjust_stok/adjust/add_opsi_jadwal_opname_temp' ?>",  
				cache :false,  
				dataType:'json',
				data :{kode_opname:kode_opname,tanggal_opname:tanggal,jenis_bahan:jenis_bahan,kode_bahan:kode_bahan},
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(data) { 
					if (data.response == 'sukses') {
						$(".tunggu").hide();   
						load_table_opsi();
						$('#tanggal').attr('disabled', true);
						$('#jenis_bahan').val('');
						$('#kode_bahan').html('');
					}else if(data.response == 'ada'){
						alert('Data Sudah Ada');
						$(".tunggu").hide();   
						load_table_opsi();
						$('#tanggal').attr('disabled', true);
						$('#jenis_bahan').val('');
						$('#kode_bahan').html('');
					}else{
						alert('Data gagal di simpan.');
						$(".tunggu").hide();   
					}

				}
			});
		}else{
			alert('Mohon Untuk Melengkapi Form.');
			$(".tunggu").hide();   
		}
	}
	function actDel(key){
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'adjust_stok/adjust/hapus_opsi_utama' ?>",  
			cache :false,  
			data :{id:key},
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				$(".tunggu").hide();   
				load_table_opsi();
			}
		});
	}

	function input_opname_pilih(){
		kode_opname 	= $('#kode_opname').val();
		window.location = '<?php echo base_url() ?>adjust_stok/adjust/input_opname/'+kode_opname;
	}

	function qty_fisik_up(key){
		stok_awal 	= $('#stok_awal_'+key).val();
		stok_akhir 	= $('#stok_akhir_'+key).val();
		if (stok_akhir != '') {
			selisih = parseInt(stok_awal) - parseInt(stok_akhir);
			
			if (parseInt(selisih) > 0) {
				$('#status_'+key).val('Kurang');
			}else if(parseInt(selisih) == 0){
				$('#status_'+key).val('Cocok');
			}else if(parseInt(selisih) < 0){
				$('#status_'+key).val('Lebih');
			}

			$('#selisih_'+key).val(Math.abs(selisih));
		}else{
			$('#selisih_'+key).val('');
			$('#status_'+key).val('');
		}
	}

	$("#simpan_adjust").submit(function() { 
		$.ajax( {  
			type 	:"post",  
			url 	:"<?php echo base_url() . 'adjust_stok/adjust/simpan_all_adjust' ?>",  
			data 	:$(this).serialize(),
			cache 	:false,
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				$(".tunggu").hide();   
				$(".alert_berhasil").show();   
				setTimeout(function(){ window.location = "<?php echo base_url().'adjust_stok/adjust/daftar' ?>" }, 2000)
			}
		});
		return false;
	})

	function hapus_opsi(){
		id = $('#id_del').val();
		$.ajax( {  
			type 	:"post",  
			url 	:"<?php echo base_url() . 'adjust_stok/adjust/hapus_opsi_utama' ?>",  
			data 	: {id:id},
			cache 	:false,
			beforeSend:function(){
				$(".tunggu").show();   
				$('#modal-hapus').modal('hide');
			},
			success : function(data) {   
				location.reload();
			}
		});
		return false;
	}
</script>