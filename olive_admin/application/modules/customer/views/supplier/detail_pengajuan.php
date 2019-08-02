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
					<span class="pull-left" style="font-size: 24px">Detail Pengajuan supplier </span>
					<a href="<?php echo base_url('pembelian/supplier/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Pengajuan supplier</a>
					<a href="<?php echo base_url('pembelian/supplier/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Pengajuan supplier</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="POST" enctype="multipart/form-data">
						<?php
						$id=$this->uri->segment(4);
						$this->db_keuangan->where('id', $id);
						$get_pengajuan=$this->db_keuangan->get('pengajuan_supplier');
						$hasil_pengajuan=$get_pengajuan->row();
						?>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<h5>Kategori Supplier</h5>
									<select name="kategori_supplier" id="kategori_supplier" class="form-control select2" disabled="">
										<option value="">Pilih Kategori Supplier</option>
										<option <?php if(@$hasil_pengajuan->kategori_supplier=='Supplier BB'){echo "selected";}?> value="Supplier BB">Supplier BB</option>
										<option <?php if(@$hasil_pengajuan->kategori_supplier=='Supplier Barang'){echo "selected";}?> value="Supplier Barang">Supplier Barang</option>
										<option <?php if(@$hasil_pengajuan->kategori_supplier=='Supplier Jasa'){echo "selected";}?> value="Supplier Jasa">Supplier Jasa</option>
										<option <?php if(@$hasil_pengajuan->kategori_supplier=='Supplier Aktiva Tetap'){echo "selected";}?> value="Supplier Aktiva Tetap">Supplier Aktiva Tetap</option>
									</select>
								</div>
								<div class="col-md-4">
									<h5>Tanggal</h5>
									<input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" value="<?php echo @$hasil_pengajuan->tanggal_pengajuan;?>" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<h5>Pengajuan Supplier</h5>
									<select name="pengajuan_supplier" id="pengajuan_supplier" disabled="" onchange="pilih_jenis_pengajuan()" class="form-control">
										<option value="">-- Pilih Jenis Pengajuan</option>
										<option <?php if(@$hasil_pengajuan->pengajuan_supplier=='baru'){echo "selected";}?> value="baru">Baru</option>
										<option <?php if(@$hasil_pengajuan->pengajuan_supplier=='lama'){echo "selected";}?> value="lama">Lama</option>
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
										<select name="kode_supplier_lama" class="form-control " id="kode_supplier_lama" disabled="">
											<option value="">Pilih Supplier -- </option>
											<?php
											$get_supplier=$this->db_master->get('master_supplier');
											$hasil_supplier=$get_supplier->result();
											foreach ($hasil_supplier as $supplier) {
												?>
												<option <?php if(@$hasil_pengajuan->kode_supplier==$supplier->kode_supplier){echo "selected";}?> value="<?php echo $supplier->kode_supplier;?>"><?php echo $supplier->nama_supplier;?></option>
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
										<input readonly="" type="text" value="<?php echo @$hasil_pengajuan->nama_supplier;?>" name="nama_supplier" id="nama_supplier" class="form-control" placeholder="Nama Supplier">
									</div>							
								</div>
								
							</div>
							<div id="keterangan" style="display: none">
								<div class="row">
									<div class="col-md-2">
										<h5>Alamat</h5>
									</div>
									<div class="col-md-4">
										<input readonly="" type="text" name="alamat_supplier" id="alamat_supplier" class="form-control" placeholder="Alamat" value="<?php echo @$hasil_pengajuan->alamat_supplier;?>">
									</div>							
								</div>
								<div class="row">
									<div class="col-md-2">
										<h5>Main Business</h5>
									</div>
									<div class="col-md-4">
										<input readonly="" type="text" name="main_business" id="main_business" class="form-control" placeholder="Main Business" value="<?php echo @$hasil_pengajuan->main_business;?>">
									</div>							
								</div>
								<div class="row">
									<div class="col-md-2">
										<h5>Contact Person</h5>
									</div>
									<div class="col-md-4">
										<input readonly="" type="text" name="kontak_person" id="kontak_person" class="form-control" placeholder="Contact Person" value="<?php echo @$hasil_pengajuan->kontak_person;?>">
									</div>							
								</div>
							</div>
							<?php
							$alasan_penambahan=explode("|", @$hasil_pengajuan->alasan_penambahan);
							?>
							<div class="col-md-12">
								<div class="row" id="alasan" style="display: none">
									<div class="col-md-6">
										<h5>Alasan Penambahan <span style="font-size: 10px;font-style: italic">( Pilih Yang Sesuai )</span> </h5>
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5><input name="alasan_penambahan[]" type="checkbox" disabled="" value="Produk Baru" <?php if(in_array('Produk Baru',$alasan_penambahan)){echo "checked";}?> > Produk Baru
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" type="checkbox" disabled="" value="Jasa Baru" <?php if(in_array('Jasa Baru',$alasan_penambahan)){echo "checked";}?> > Jasa Baru
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input type="checkbox" disabled="" name="alasan_penambahan[]" id="cek_supp" value="Supplier Lama Tidak Bagus" onchange="cek_supplier_lama(this)" <?php if(in_array('Supplier Lama Tidak Bagus',$alasan_penambahan)){echo "checked";}?> > Supplier Lama Tidak Bagus 
														</h5>
														<?php if(in_array('Supplier Lama Tidak Bagus',$alasan_penambahan)){
															?>
															<select name="supplier_tdk_bagus[]" class="form-control select2" id="supplier_tdk_bagus" style="width: 100%;" multiple="" disabled="">
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
															<?php
														}
														?>

													</div>
												</div>

												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]"  value="Harga Kompetitif" type="checkbox" disabled="" <?php if(in_array('Harga Kompetitif',$alasan_penambahan)){echo "checked";}?>> Harga Kompetitif 
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Kualitas Bagus" type="checkbox" disabled="" <?php if(in_array('Kualitas Bagus',$alasan_penambahan)){echo "checked";}?> > Kualitas Bagus
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Kemudahan Retur" type="checkbox" disabled="" <?php if(in_array('Kemudahan Retur',$alasan_penambahan)){echo "checked";}?> > Kemudahan Retur
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Delivery/Jadwal pengiriman tepat waktu" type="checkbox" disabled="" <?php if(in_array('Delivery/Jadwal pengiriman tepat waktu',$alasan_penambahan)){echo "checked";}?> > Delivery/Jadwal pengiriman tepat waktu
														</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-md-1"></div>
													<div class="col-md-11">
														<h5 style="margin-top: -5px;">
															<input name="alasan_penambahan[]" value="Contunuitas Barang" type="checkbox" disabled="" <?php if(in_array('Contunuitas Barang',$alasan_penambahan)){echo "checked";}?>> Contunuitas Barang</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input name="alasan_penambahan[]" value="Boleh Trial Sebelumnya" type="checkbox" disabled="" <?php if(in_array('Boleh Trial Sebelumnya',$alasan_penambahan)){echo "checked";}?>> Boleh Trial Sebelumnya
															</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input name="alasan_penambahan[]" value="Bersertifikasi Halal / MUI" type="checkbox" disabled="" <?php if(in_array('Bersertifikasi Halal / MUI',$alasan_penambahan)){echo "checked";}?> > Bersertifikasi Halal / MUI
															</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input name="alasan_penambahan[]" value="Bersertifikasi BPOM" type="checkbox" disabled="" <?php if(in_array('Bersertifikasi BPOM',$alasan_penambahan)){echo "checked";}?>> Bersertifikasi BPOM
															</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input name="alasan_penambahan[]" value="Sesuai Spek yang ditawarkan" type="checkbox" disabled="" <?php if(in_array('Sesuai Spek yang ditawarkan',$alasan_penambahan)){echo "checked";}?>> Sesuai Spek yang ditawarkan
															</h5>
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input name="alasan_penambahan[]" type="checkbox" disabled="" value="Lain - lain" onchange="cek_lain_lain(this)" <?php if(in_array('Lain - lain',$alasan_penambahan)){echo "checked";}?> > Lain - lain
															</h5>
															<?php if(in_array('Lain - lain',$alasan_penambahan)){
																?>
																<input readonly="" type="text" name="keterangan_penambahan" class="form-control" placeholder="" id="tambahan_lain" value="<?php echo @$hasil_pengajuan->keterangan_penambahan;?>">
																<span style="font-size: 10px;font-style: italic"> ( Isi Sendiri )</span>	
																<?php
															}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								$dokumen_pendukung=explode("|", @$hasil_pengajuan->dokumen_pendukung);
								$lampiran_dokumen=explode("|", @$hasil_pengajuan->lampiran_dokumen);
								?>
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
																<input type="checkbox" disabled="" name="dokumen_surat" id="dokumen_surat" value="Surat Penawaran dari Supplier" onchange="cek_surat(this)" <?php if(in_array('Surat Penawaran dari Supplier',$dokumen_pendukung)){echo "checked";}?> > Surat Penawaran dari Supplier 
																<?php if(in_array('Surat Penawaran dari Supplier',$dokumen_pendukung)){
																	?>
																	<a href="<?php echo base_url('component/upload/uploads').'/'.$lampiran_dokumen[0];?>" class="btn btn-info btn-xs"><i class="fa fa-download"></i> Download
																	</a>
																	<?php
																}
																?>
															</h5>
															
														</div>
													</div>
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input type="checkbox" disabled="" name="dokumen_company" value="Company profile/Katalog/Brosur" onchange="cek_company(this)" <?php if(in_array('Company profile/Katalog/Brosur',$dokumen_pendukung)){echo "checked";}?>> Company profile/Katalog/Brosur
																<?php if(in_array('Company profile/Katalog/Brosur',$dokumen_pendukung)){
																	?>
																	<a href="<?php echo base_url('component/upload/uploads').'/'.$lampiran_dokumen[1];?>" class="btn btn-info btn-xs"><i class="fa fa-download"></i> Download
																	</a>
																	<?php
																}
																?>
															</h5>
															
														</div>
													</div>	
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input type="checkbox" disabled="" name="dokumen_referensi" value="Referensi" onchange="cek_referensi(this)" <?php if(in_array('Referensi',$dokumen_pendukung)){echo "checked";}?>> Referensi
																<?php if(in_array('Referensi',$dokumen_pendukung)){
																	?>
																	<a href="<?php echo base_url('component/upload/uploads').'/'.$lampiran_dokumen[2];?>" class="btn btn-info btn-xs"><i class="fa fa-download"></i> Download
																	</a>
																	<?php
																}
																?>
															</h5>
															
														</div>
													</div>	
													<div class="row">
														<div class="col-md-1"></div>
														<div class="col-md-11">
															<h5 style="margin-top: -5px;">
																<input type="checkbox" disabled="" name="dokumen_contoh" value="Contoh Barang" onchange="cek_contoh(this)" <?php if(in_array('Contoh Barang',$dokumen_pendukung)){echo "checked";}?> > Contoh Barang
																<?php if(in_array('Contoh Barang',$dokumen_pendukung)){
																	?>
																	<a href="<?php echo base_url('component/upload/uploads').'/'.$lampiran_dokumen[3];?>" class="btn btn-info btn-xs"><i class="fa fa-download"></i> Download
																	</a>
																	<?php
																}
																?>
															</h5>
															
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
		pilih_jenis_pengajuan();
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
		}else if(pengajuan_supplier == 'lama'){
			$('#baru').hide();
			$('#alasan').show();
			$('#lampiran').show();
			$('#keterangan').show();
			$('#lama').show();
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
		alert(obj);
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
	
</script>