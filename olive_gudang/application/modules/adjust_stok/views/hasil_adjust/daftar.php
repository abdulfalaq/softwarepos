<a href="<?php echo base_url('adjust_stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('adjust_stok'); ?>">Adjust Stok</a></li>
		<li><a href="#">Hasil Adjust</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Adjust Stok</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Hasil Adjust</span>
				</div>
				<div class="panel-body">
					<form id="pencarian_form" method="post" style="margin-left: 0px;" class="form-horizontal" target="_blank">
						<div class="row">
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Awal</span>
									<input type="text" class="form-control tgl" id="tgl_awal" />
								</div>
							</div>
							<div class="col-md-4" id="trx_penjualan">
								<div class="input-group">
									<span class="input-group-addon">Tanggal Akhir</span>
									<input type="text" class="form-control tgl" id="tgl_akhir" />
								</div>
							</div>
							<div class=" col-md-2">
								<div class="input-group">
									<button type="button" class="btn btn-warning" id="cari"><i class="fa fa-search"></i> Cari</button>
								</div>
							</div>
							
						</div>
						<br>
					</form>
					<div class="box-body">            
						<div class="sukses" ></div>
						<form id="data_form" method="post" hidden>
							<div class="box-body">            
								<div class="row">
									<div class="col-md-10 " id="">
										<div class="col-md-5 " id="">
											<div class="input-group">
												<span class="input-group-addon">Filter</span>
												<select class="form-control" id="kategori_filter">
													<option value="">- PILIH Filter -</option>
													<option value="kategori">Kategori Produk</option>
													<option value="blok">Blok</option>
												</select>
											</div>
											<br>
										</div>
									</div>
									<div class="col-md-10 " id="opsi_filter">
										<div class="col-md-5 " id="">
											<div class="input-group">
												<span class="input-group-addon">Filter By</span>
												<select class="form-control" id="jenis_filter">
													<option value="">- PILIH Filter -</option>

												</select>
											</div>
											<br>
										</div>                        
									</div>
									<div class="col-md-10 " id="opsi_filter">
										<div class="col-md-5 " id="">
											<button style="width: 100px" type="button" class="btn btn-warning " ><i class="fa fa-search"></i> Cari</button>
										</div>
									</div>
								</div> 
							</div>
						</div>
					</form>
					<div class="sukses"></div>
					<form id="data_opname">
						<div id="cari_transaksi">
							<table class="table table-striped table-hover table-bordered datatable" id="datatable">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Opname</th>
										<th>Tanggal Opname</th>
										<th>Kode Produk</th>
										<th>Nama Produk</th>
										<th>Jenis Bahan</th>
										<th>Stok Awal</th>
										<th>Stok Akhir</th>
										<th>Selisih</th>
										<th>Status</th>
										<th>Keterangan</th>                    
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="scroll_data">
									<?php 
									$this->db->select('nama_produk');
									$this->db->select('nama_bahan_baku');
									$this->db->select('nama_perlengkapan');
									$this->db->select('olive_gudang.opsi_transaksi_opname.id');
									$this->db->select('olive_gudang.opsi_transaksi_opname.kode_opname');
									$this->db->select('olive_gudang.opsi_transaksi_opname.tanggal_opname');
									$this->db->select('olive_gudang.opsi_transaksi_opname.kode_bahan');
									$this->db->select('olive_gudang.opsi_transaksi_opname.jenis_bahan');
									$this->db->select('olive_gudang.opsi_transaksi_opname.stok_awal');
									$this->db->select('olive_gudang.opsi_transaksi_opname.stok_akhir');
									$this->db->select('olive_gudang.opsi_transaksi_opname.selisih');
									$this->db->select('olive_gudang.opsi_transaksi_opname.status');
									$this->db->select('olive_gudang.opsi_transaksi_opname.keterangan');
									$this->db->select('olive_gudang.opsi_transaksi_opname.validasi');

									$this->db->order_by('olive_gudang.opsi_transaksi_opname.id','DESC');
									$this->db->from('olive_gudang.opsi_transaksi_opname');
									$this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_opname.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
									$this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_opname.kode_bahan = olive_master.master_produk.kode_produk', 'left');
									$this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_opname.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
									$get_gudang = $this->db->get()->result();
									$no = 0;

									foreach ($get_gudang as $value) { 
										$no++; ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $value->kode_opname ?></td>
											<td><?= tanggalIndo ($value->tanggal_opname) ?></td>
											<td><?= $value->kode_bahan ?></td>
											<td>
												<?php 
												if(@$value->jenis_bahan=='Bahan Baku'){
													echo @$value->nama_bahan_baku;
												}elseif (@$value->jenis_bahan=='Produk') {
													echo @$value->nama_produk;
												}elseif (@$value->jenis_bahan=='Perlengkapan') {
													echo @$value->nama_perlengkapan;
												}
												?>  
											</td>
											<td><?= $value->jenis_bahan ?></td>
											<td><?= $value->stok_awal ?></td>
											<td><?= $value->stok_akhir ?></td>
											<td><?= $value->selisih ?></td>
											<td><?= $value->status ?></td>
											<td><?= $value->keterangan ?></td>
											<td align="center">
												<?php
												if($value->validasi!='confirmed'){
													?>
													<a onclick="validasi('<?php echo $value->id; ?>','<?php echo $value->status; ?>')" class="btn btn-info btn-no-radius"><i class="fa fa-check"></i> Validasi</a>
													<?php
												}
												?>
												
											</td>
									</tr>
									<?php 
								} 
								?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<div id="modal-kurang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Validasi Data Kurang</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menyelesaikan data tersebut ?</span>
				<input id="id-kurang" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button key="kurang_tanpa_nominal" class="btn btn-warning btn-no-radius proses" >Dihibahkan</button>
				<button  class="btn btn-success btn-no-radius tindak_lanjuti">Ditindak lanjuti</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-nominal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Validasi Data Kurang</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">Masukan Nominal Untuk Menindak Lanjuti ?</span>
				<input id="id-nominal" type="hidden">
				<input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal" />
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn btn-warning btn-no-radius" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button key="kurang" class="btn btn-success btn-no-radius proses">Ya</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-lebih" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Validasi Data Lebih</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">apakah anda yakin memvalidasi data tersebut ?</span>
				<input id="id-lebih" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button onclick="jangan_disesuaikan()" class="btn btn-warning btn-no-radius">Tidak Disesuaikan</button>
				<button key="lebih" class="btn btn-success btn-no-radius proses">Disesuaikan</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-cocok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi Validasi Data Cocok</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:14pt">apakah anda yakin memvalidasi data tersebut ?</span>
				<input id="id-cocok" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn btn-warning btn-no-radius" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button key="cocok" class="btn btn-success btn-no-radius proses">Ya</button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>component/lib/jquery.min.js"></script>
<script src="<?php echo base_url();?>component/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>component/lib/css/default.css"/>
<script>
	$('.tgl').Zebra_DatePicker({});


	$('#cari').click(function(){
		var tgl_awal =$("#tgl_awal").val();
		var tgl_akhir =$("#tgl_akhir").val();
		if (tgl_awal=='' || tgl_akhir==''){ 
			alert('Masukan Tanggal Awal & Tanggal Akhir..!')
		}
		else{
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url()?>adjust_stok/hasil_adjust/cari_daftar",  
				cache :false,
				beforeSend:function(){
					$(".tunggu").show();  
				},  
				data : {tgl_awal:tgl_awal,tgl_akhir:tgl_akhir},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success : function(data) {
					$(".tunggu").hide();  
					$("#cari_transaksi").html(data);
				},  
				error : function(data) {  

				}  
			});
		}

	});

	function validasi(id,status){
		if(status=="Kurang"){
			$('#id-kurang').val(id);
			$('#modal-kurang').modal('show');
		}else if(status=="Cocok"){
			$('#id-cocok').val(id);
			$('#modal-cocok').modal('show');
		}else if(status=="Lebih"){
			$('#id-lebih').val(id);

			$('#modal-lebih').modal('show');
		}
	}

	$('.tindak_lanjuti').click(function(){
		var id = $('#id-kurang').val();
		$('#id-nominal').val(id) ;
		$('#modal-nominal').modal('show');

	});

	$('.proses').click(function(){
		var status_validasi = $(this).attr('key');
		if(status_validasi=="kurang"){
			var id = $('#id-nominal').val();
			var nominal_opname = $('#nominal').val();
			var url = "<?php echo base_url().'adjust_stok/hasil_adjust/sesuaikan'; ?>"
		}else if(status_validasi=="cocok"){
			var id = $('#id-cocok').val();
			var url = "<?php echo base_url().'adjust_stok/hasil_adjust/sesuaikan'; ?>"
		}else if(status_validasi=="lebih"){

			var id = $('#id-lebih').val();
			var url = "<?php echo base_url().'adjust_stok/hasil_adjust/sesuaikan'; ?>"
		}else if(status_validasi=="kurang_tanpa_nominal"){
			var id = $('#id-kurang').val();
			var url = "<?php echo base_url().'adjust_stok/hasil_adjust/sesuaikan'; ?>"
		}
		if(parseInt(nominal_opname) < 0 || nominal_opname=='-'){
			alert('Nominal Opname Salah');
		}else{
			$.ajax( {  
				type :"post",  
				url : url,  
				cache :false,
				data : {status_validasi:status_validasi,id:id,nominal_opname:nominal_opname},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				dataType:'json',
				success : function(data) {
					$(".tunggu").hide();
					if(data.respon=='gagal'){
						$('#modal-kurang').modal('hide');
						$('#modal-cocok').modal('hide');
						$('#modal-lebih').modal('hide');
						$('#modal-nominal').modal('hide');
						$('.sukses').html(data.notif);
					}else{
						window.location = "<?php echo base_url().'adjust_stok/hasil_adjust/daftar'; ?>";
					}

				},  
				error : function(data) {  
				}  
			});
		}

	});
	function jangan_disesuaikan(){
		var id = $('#id-lebih').val();
		var url = "<?php echo base_url().'adjust_stok/hasil_adjust/tidak_sesuaikan'; ?>"
		$.ajax( {  
			type :"post",  
			url : url,  
			cache :false,
			data : {id:id},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {
				
				window.location = "<?php echo base_url().'adjust_stok/hasil_adjust/daftar'; ?>";

			},  
			error : function(data) {  
			}  
		});
	}
</script>