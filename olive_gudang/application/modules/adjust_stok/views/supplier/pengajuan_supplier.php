<!-- back button -->
<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">supplier</a></li>
		<li><a href="#">supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>supplier </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Pengajuan supplier </span>
					<a href="<?php echo base_url('pembelian/supplier/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Pengajuan supplier</a>
					<a href="<?php echo base_url('pembelian/supplier/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pengajuan supplier</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="POST" enctype="multipart/form-data">

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<h5>Kategori Supplier</h5>
									<select name="kategori_supplier" id="kategori_supplier" class="form-control select2">
										<option value="">Pilih Kategori Supplier</option>
										<option value="Supplier BB">Supplier BB</option>
										<option value="Supplier Barang">Supplier Barang</option>
										<option value="Supplier Jasa">Supplier Jasa</option>
										<option value="Supplier Aktiva Tetap">Supplier Aktiva Tetap</option>
									</select>
								</div>
								<div class="col-md-4">
									<h5>Tanggal</h5>
									<input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" value="<?= (date('Y-m-d')) ?>" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<h5>Pengajuan Supplier</h5>
									<select name="pengajuan_supplier" id="pengajuan_supplier" onchange="pilih_jenis_pengajuan()" class="form-control">
										<option value="">-- Pilih Jenis Pengajuan</option>
										<option value="baru">Baru</option>
										<option value="lama">Lama</option>
									</select>
								</div>

							</div><br><br>
							<div class="form-lama" id="lama" style="display: none">
								<hr><br>
								<h4>*Lama</h4>
								<div class="row">
									<div class="col-md-2">
										<h5>Nama Supplier</h5>
									</div>
									<div class="col-md-4">
										<select name="kode_supplier_lama" class="form-control " id="kode_supplier_lama" onchange="get_supplier()">
											<option value="">Pilih Supplier -- </option>
											<?php
											$get_supplier=$this->db_master->get('master_supplier');
											$hasil_supplier=$get_supplier->result();
											foreach ($hasil_supplier as $supplier) {
												?>
												<option value="<?php echo $supplier->kode_supplier;?>"><?php echo $supplier->nama_supplier;?></option>
												<?php
											}
											?>
										</select>
									</div>							
								</div>
								
							</div>
							<div class="form-baru" id="baru" style="display: none">
								<hr><br>
								<h4>*Baru</h4>
								<div class="row">
									<div class="col-md-2">
										<h5>Nama Supplier</h5>
									</div>
									<div class="col-md-4">
										<input type="text" name="nama_supplier" id="nama_supplier" class="form-control" placeholder="Nama Supplier">
									</div>							
								</div>
								
							</div>
							<div id="keterangan" style="display: none">
								<div class="row">
									<div class="col-md-2">
										<h5>Alamat</h5>
									</div>
									<div class="col-md-4">
										<input type="text" name="alamat_supplier" id="alamat_supplier" class="form-control" placeholder="Alamat">
									</div>							
								</div>
								<div class="row">
									<div class="col-md-2">
										<h5>Main Business</h5>
									</div>
									<div class="col-md-4">
										<input type="text" name="main_business" id="main_business" class="form-control" placeholder="Main Business">
									</div>							
								</div>
								<div class="row">
									<div class="col-md-2">
										<h5>Contact Person</h5>
									</div>
									<div class="col-md-4">
										<input type="text" name="kontak_person" id="kontak_person" class="form-control" placeholder="Contact Person">
									</div>							
								</div>
							</div>
							<div class="col-md-12">
								<div class="row" id="alasan" style="display: none">
									<div class="col-md-6">
										<h5>Alasan Penambahan <span style="font-size: 10px;font-style: italic">( Pilih Yang Sesuai )</span> </h5>
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5>
															<input name="alasan_penambahan[]" type="checkbox" value="Produk Baru"> Produk Baru
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" type="checkbox" value="Jasa Baru"> Jasa Baru
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input type="checkbox" name="alasan_penambahan[]" value="Supplier Lama Tidak Bagus" onchange="cek_supplier_lama(this)"> Supplier Lama Tidak Bagus 
														</h5>
														<div id="select_supplier">
															<select name="supplier_tdk_bagus[]" class="form-control select2" id="supplier_tdk_bagus" style="width: 100%;" multiple="">
																<?php
																$get_supplier=$this->db_master->get('master_supplier');
																$hasil_supplier=$get_supplier->result();
																foreach ($hasil_supplier as $supplier) {
																	?>
																	<option value="<?php echo $supplier->kode_supplier;?>"><?php echo $supplier->nama_supplier;?></option>
																	<?php
																}
																?>
															</select>
															<span style="font-size: 10px;font-style: italic"> ( Nama Supplier )</span>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Harga Kompetitif" type="checkbox"> Harga Kompetitif 
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Kualitas Bagus" type="checkbox"> Kualitas Bagus
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Kemudahan Retur" type="checkbox"> Kemudahan Retur
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Delivery/Jadwal pengiriman tepat waktu" type="checkbox"> Delivery/Jadwal pengiriman tepat waktu
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Contunuitas Barang" type="checkbox"> Contunuitas Barang
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Kemudahan Retur" type="checkbox"> Kemudahan Retur
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Boleh Trial Sebelumnya" type="checkbox"> Boleh Trial Sebelumnya
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Bersertifikasi Halal / MUI" type="checkbox"> Bersertifikasi Halal / MUI
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Bersertifikasi BPOM" type="checkbox"> Bersertifikasi BPOM
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Sesuai Spek yang ditawarkan" type="checkbox"> Sesuai Spek yang ditawarkan
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" type="checkbox" value="Lain - lain" onchange="cek_lain_lain(this)"> Lain - lain
														</h5>
														<div id="input_lain_lain">
															<input type="text" name="keterangan_penambahan" class="form-control" placeholder="" id="tambahan_lain" ><span style="font-size: 10px;font-style: italic"> ( Isi Sendiri )</span>	
														</div>
														
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row" id="lampiran" style="display: none">
									<div class="col-md-6">
										<h5>Harap Dilampirkan Dokumen Pendukung Sebagai Berikut: </h5>
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input type="checkbox" name="dokumen_surat" value="Surat Penawaran dari Supplier" onchange="cek_surat(this)"> Surat Penawaran dari Supplier
														</h5>
														<input type="file" accept="application/pdf,image/*" name="lampiran_surat" id="lampiran_surat" class="form-control">
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input type="checkbox" name="dokumen_company" value="Company profile/Katalog/Brosur" onchange="cek_company(this)"> Company profile/Katalog/Brosur
														</h5>
														<input type="file" accept="application/pdf,image/*" name="lampiran_company" id="lampiran_company" class="form-control">
													</div>
												</div>	
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input type="checkbox" name="dokumen_referensi" value="Referensi" onchange="cek_referensi(this)"> Referensi
														</h5>
														<input type="file" accept="application/pdf,image/*" name="lampiran_referensi" id="lampiran_referensi" class="form-control">
													</div>
												</div>	
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input type="checkbox" name="dokumen_contoh" value="Contoh Barang" onchange="cek_contoh(this)"> Contoh Barang
														</h5>
														<input type="file" accept="application/pdf,image/*" name="lampiran_contoh" id="lampiran_contoh" class="form-control">
													</div>
												</div>	
											</div>
										</div>
									</div>

								</div>
								<br><hr><br>

							</div>
						</div>

					</form>
					<div class="col-md-12">
						<div class="row ">
							<a class="btn btn-info btn-md btn-no-radius pull-right " onclick="confirm_simpan()"><i class="fa fa-send"></i> Simpan</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Confirmasi</h4>
			</div>
			<div class="modal-body">
				<h3>Apakah anda yakin ingin menyimpan data tersebut ?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-no-radius btn-md" data-dismiss="modal">Cancel</button>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="simpan_pengajuan()" >Yakin</a>
			</div>
		</div>
	</div>
</div>

<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
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

<script>
	$(document).ready(function() {
		$('#select_supplier').hide();
		$('#input_lain_lain').hide();
		$('#lampiran_surat').hide();
		$('#lampiran_company').hide();
		$('#lampiran_referensi').hide();
		$('#lampiran_contoh').hide();
	});
	
	function pilih_jenis_pengajuan() {

		var pengajuan_supplier = $('#pengajuan_supplier').val();
		if (pengajuan_supplier == 'baru') {
			$('#baru').show();
			$('#alasan').show();
			$('#lampiran').show();
			$('#keterangan').show();
			$('#lama').hide();
			$('#kode_supplier_lama').val('').trigger('change');
			$('#alamat_supplier').attr('readonly',false);
			$('#main_business').attr('readonly',false);
			$('#kontak_person').attr('readonly',false);
		}else if(pengajuan_supplier == 'lama'){
			$('#baru').hide();
			$('#alasan').show();
			$('#lampiran').show();
			$('#keterangan').show();
			$('#lama').show();
			$('#alamat_supplier').attr('readonly',true);
			$('#main_business').attr('readonly',true);
			$('#kontak_person').attr('readonly',true);
		}else{
			$('#baru').hide();
			$('#alasan').hide();
			$('#lampiran').hide();
			$('#lama').hide();
			$('#keterangan').hide();
		}
	}

	function cek_supplier_lama(obj){
		

		if(obj.checked) {
			$('#select_supplier').show();
		}else{
			$('#select_supplier').hide();
			$('#supplier_tdk_bagus').val('').trigger('change');
		}
		
	}

	function cek_lain_lain(obj){
		if(obj.checked) {
			$('#input_lain_lain').show();
		}else{
			$('#input_lain_lain').hide();
			$('#tambahan_lain').val('');
		}
	}

	function cek_surat(obj){
		if(obj.checked) {
			$('#lampiran_surat').show();
		}else{
			$('#lampiran_surat').hide();
		}
	}

	function cek_company(obj){
		if(obj.checked) {
			$('#lampiran_company').show();
		}else{
			$('#lampiran_company').hide();
		}
	}
	function cek_referensi(obj){
		if(obj.checked) {
			$('#lampiran_referensi').show();
		}else{
			$('#lampiran_referensi').hide();
		}
	}

	function cek_contoh(obj){
		if(obj.checked) {
			$('#lampiran_contoh').show();
		}else{
			$('#lampiran_contoh').hide();
		}
	}

	function get_supplier(){
		var kode_supplier =$('#kode_supplier_lama').val();
		$.ajax({
			url: '<?php echo base_url('pembelian/supplier/get_supplier'); ?>',
			type: 'post',
			data:{kode_supplier:kode_supplier},
			dataType:'Json',
			success: function(response){
				$('#alamat_supplier').val(response.alamat_supplier);
				$('#main_business').val(response.main_business);
				$('#kontak_person').val(response.kontak_person);
			}
		});
	}

	function confirm_simpan(){
		var kategori_supplier=$('#kategori_supplier').val();
		var pengajuan_supplier=$('#pengajuan_supplier').val();
		var nama_supplier=$('#nama_supplier').val();
		var kode_supplier_lama=$('#kode_supplier_lama').val();
		var alamat_supplier=$('#alamat_supplier').val();
		var main_business=$('#main_business').val();
		var kontak_person=$('#kontak_person').val();

		if(kategori_supplier=='' || pengajuan_supplier=='' || alamat_supplier =='' || main_business=='' || kontak_person==''){
			alert('Silahkan lengkapi Form ..!');
		}else if(pengajuan_supplier == 'baru' && nama_supplier==''){
			alert('Silahkan lengkapi Form ..!');
		}else if(pengajuan_supplier == 'lama' && kode_supplier_lama==''){
			alert('Silahkan lengkapi Form ..!');
		}else{
			$('#modal-confirm').modal('show');
		}
	}

	function simpan_pengajuan(){

		var form = $('#data_form')[0];
		var data = new FormData(form);
		$.ajax({
			url: '<?php echo base_url('pembelian/supplier/simpan_pengajuan'); ?>',
			type: 'post',
			enctype: 'multipart/form-data',
			data: data,
			processData: false,
			contentType: false,
			beforeSend:function(){
				$('#modal-konfirmasi').modal('hide');
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('pembelian/supplier');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
</script>