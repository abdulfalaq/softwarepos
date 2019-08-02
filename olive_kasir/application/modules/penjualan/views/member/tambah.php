<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Member</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Member </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Member </span>
					<a href="<?php echo base_url('penjualan/member/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Member</a>
					<a href="<?php echo base_url('penjualan/member/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Member</a>
				</div>
				<div class="panel-body">
					<form id="form_member">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<h5>Kode Member</h5>
									<input type="text" id="kode_member" name="kode_member" class="form-control" placeholder="kode member">
									<?php
										$get_unit = $this->db->get('setting')->row();
									?>
									<input type="hidden" id="kode_unit_jabung" name="kode_unit_jabung" value="<?php echo $get_unit->kode_unit;?>" class="form-control" placeholder="kode Unit jabung">
								</div>
								<div class="col-md-6">
									<h5>Kategori Member</h5>
									<select name="kategori_member" class="form-control" id="kategori_member">
										<option value="">-- Pilih Kategori Member</option>
										<option value="Member Umum">Member Umum</option>
										<option value="Member Konsinyasi">Member Konsinyasi</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Keterangan</h5>
									<input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="keterangan">
								</div>
								<div class="col-md-6">
									<h5>Status FEE</h5>
									<select class="form-control" name="status_fee" id="status_fee" onchange="jenis_status_fee()">
										<option value="non_fee">Non FEE</option>
										<option value="fee">FEE</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 n_fee" style="display: none;">
									<h5>Nominal FEE</h5>
									<input type="text" id="nominal_fee" name="nominal_fee" class="form-control" placeholder="Nominal Fee">
								</div>
								<div class="col-md-6">
									<h5>Harga</h5>
									<select name="kategori_harga" class="form-control" id="kategori_harga">
										<option value="">-- Pilih Harga</option>
										<option value="Harga 1">Harga 1</option>
										<option value="Harga 2">Harga 2</option>
										<option value="Harga 3">Harga 3</option>
										<option value="Harga 4">Harga 4</option>
										<option value="Harga 5">Harga 5</option>
										<option value="Harga 6">Harga 6</option>
										<option value="Harga 7">Harga 7</option>
										<option value="Harga 8">Harga 8</option>
										<option value="Harga 9">Harga 9</option>
										<option value="Harga 10">Harga 10</option>
									</select>
								</div>
								<div class="col-md-6">
									<h5>Ongkos Kirim</h5>
									<input type="text" id="ongkir" name="ongkir" class="form-control" placeholder="Ongkos Kirim">
								</div>
								<div class="col-md-6">
									<h5>Status</h5>
									<select name="status_member" id="status_member" class="form-control">
										<option value="1">Aktif</option>
										<option value="0">Tidak Aktif</option>
									</select>
								</div>
							</div>
							<div class="row">

							</div>
							<div class="row"><br>
								<h3>A. Data Perusahaan</h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Nama Perusahaan</h5>
									<input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control" placeholder="Nama Perusahaan">
								</div>
								<div class="col-md-6">
									<h5>Alamat Perusahaan</h5>
									<input type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="form-control" placeholder="Alamat Perusahaan">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Telepon Perusahaan</h5>
									<input type="text" id="telp_perusahaan" name="telp_perusahaan" class="form-control" placeholder="Telepon Perusahaan">
								</div>
								<div class="col-md-6">
									<h5>No. Rekening Perusahaan</h5>
									<input type="text" id="no_rek_perusahaan" name="no_rek_perusahaan" class="form-control" placeholder="No. Rekening Perusahaan">
								</div>
							</div>
							<div class="row"><br>
								<h3>B. Data PIC</h3>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Nama PIC</h5>
									<input type="text" id="nama_pic" name="nama_pic" class="form-control" placeholder="Nama PIC">
								</div>
								<div class="col-md-6">
									<h5>Alamat PIC</h5>
									<input type="text" id="alamat_pic" name="alamat_pic" class="form-control" placeholder="Alamat PIC">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<h5>Telepon PIC</h5>
									<input type="text" id="telp_pic" name="telp_pic" class="form-control" placeholder="Telepon PIC">
								</div>
								<div class="col-md-6">
									<h5>No. Rekening PIC</h5>
									<input type="text" id="no_rek_pic" name="no_rek_pic" class="form-control" placeholder="No. Rekening PIC">
								</div>
							</div>
							<div class="row"><br>
								<hr>
							</div>
							<div class="row"><br>
								<div class="col-md-12">
									<button class="btn btn-info btn-lg btn-no-radius pull-right"><i class="fa fa-send"></i> Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
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



<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	function jenis_status_fee(){
		status_fee = $('#status_fee').val();
		if (status_fee == 'fee') {
			$('.n_fee').show();
		}else{
			$('.n_fee').hide();
		}
	}

	$("#form_member").submit( function() {  
		kode_member       = $('#kode_member').val(); 
		kode_unit_jabung  = $('#kode_unit_jabung').val();                
		kategori_member   = $('#kategori_member').val();                
		keterangan 		  = $('#keterangan').val();  
		status_fee 		  = $('#status_fee').val();  
		nominal_fee 	  = $('#nominal_fee').val();  
		kategori_harga    = $('#kategori_harga').val();  
		ongkir 		      = $('#ongkir').val();  
		status_member     = $('#status_member').val();  
		nama_perusahaan   = $('#nama_perusahaan').val();  
		alamat_perusahaan = $('#alamat_perusahaan').val();  
		telp_perusahaan   = $('#telp_perusahaan').val();  
		no_rek_perusahaan = $('#no_rek_perusahaan').val();  
		nama_pic          = $('#nama_pic').val();  
		alamat_pic        = $('#alamat_pic').val();  
		telp_pic          = $('#telp_pic').val();  
		no_rek_pic        = $('#no_rek_pic').val();  

		if (kode_member != '' && kategori_member != '' && status_fee != '' && kategori_harga != '' && ongkir != '' && nama_perusahaan != '' && telp_perusahaan != '' && no_rek_perusahaan != '' && nama_pic != '' && telp_pic != '' && no_rek_pic != '') {
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'penjualan/member/simpan_member' ?>",  
				cache :false,  
				data :$(this).serialize(),
				dataType: 'Json',
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(data) { 
					if (data.response == 'sukses') {
						$(".tunggu").hide();   
						$(".alert_berhasil").show();   
						setInterval(function(){ window.location="<?php echo base_url('penjualan/member/daftar');?>"; }, 1500);
					}else{
						alert('Gagal Menyimpan data');
						setInterval(function(){ location.reload() }, 2000);
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});
			return false;   
		}else {
			alert('Harap Melengkapi Form.');
		}              
	});

</script> 