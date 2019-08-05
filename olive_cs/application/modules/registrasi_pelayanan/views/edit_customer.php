<style type="text/css">
.bg-yellow {
	border-color: #c49f47 !important;
	background-image: none !important;
	background-color: #c49f47 !important;
	color: #FFFFFF !important;
}
.bg-red {
	border-color: #cb5a5e !important;
	background-image: none !important;
	background-color: #cb5a5e !important;
	color: #FFFFFF !important;
}
.bg-blue {
	border-color: #3598dc !important;
	background-image: none !important;
	background-color: #3598dc !important;
	color: #FFFFFF !important;
}
.bg-purple {
	border-color: #8e5fa2 !important;
	background-image: none !important;
	background-color: #8e5fa2 !important;
	color: #FFFFFF !important;
}
.purple.btn {
	color: #FFFFFF;
	background-color: #8e5fa2;
}
.bg-red {
	border-color: #cb5a5e !important;
	background-image: none !important;
	background-color: #cb5a5e !important;
	color: #FFFFFF !important;
}
.bg-green {
	border-color: #26a69a !important;
	background-image: none !important;
	background-color: #26a69a !important;
	color: #FFFFFF !important;
}
.yellow.btn {
	color: #FFFFFF;
	background-color: #c49f47;
}
.blue.btn {
	color: #FFFFFF;
	background-color: #3598dc;
}
.red.btn {
	color: #FFFFFF;
	background-color: #cb5a5e;
}
.yellow.btn {
	color: #FFFFFF;
	background-color: #c49f47;
}
body{
	background-color: #e4feff;
}

.form_shadow{
	background-color: white;
	padding: 20px;
	box-shadow: 0px 2px 8px grey;
}

td, th, tr{
	border:solid 1px #217377 !important;
}

td{
	font-size: 13px;
}
.table-bordered{
	border:solid 1px #217377 !important;
}
.btn-shadow{
	box-shadow: 0px 2px 5px #7f7171;
}
.box-pannel{
	padding: 5px !important;
	padding-left: 15px !important;
	padding-right: 10px !important;
	box-shadow: 0px 2px 6px grey;
}
.box-girl{
	background-color: #ff01cc;
	box-shadow: 0px 2px 7px #cbcbcb;
	transition:all 0.4s;
}

.box-tosca{
	box-shadow: 0px 2px 8px #1a3f42;
}

.ps {
	width: 20%;
	float: left;
}
<?php 

$this->db->order_by('id','DESC');
$get_gudang = $this->db->get('clouoid1_olive_master.master_member')->result();

?>
</style>
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="clearfix"></div>
<?php 
$kode_member=$this->uri->segment(4);
$this->db->where('kode_member',$kode_member);
$get_kategori = $this->db->get('clouoid1_olive_master.master_member')->row();
?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">	
			<div class="col-md-7" >
				<div class="col-md-12 form_shadow" style="padding: 0px;width :100%;height: 900px" >
					<div>
						<div class="panel-heading text-left" style="background-color: #2f898e;color: white">
							<h4>Data Customer</h4>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4">
									<div>
										<input type="text" name="" class="form-control" placeholder="Cari Nama Customer">
									</div>
								</div>
								<div class="col-md-6">
									<div>
										<button class="btn btn-success"><i class="fa fa-search"></i>Cari</button>
									</div>
									<br>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<table id="datatable" class="table table-striped table-bordered" style="font-size: 10px">
										<thead>
											<tr>
												<th width="30px;">No</th>
												<th>Nama Customer</th>
												<th>No KTP / SIM</th>
												<th>Jenis Kelamin</th>
												<th>Telp. Customer</th>
												<th>Tanggal Registrasi</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>    
											<?php 
											$no = 0;
											foreach ($get_gudang as $value) { 
												$no++; ?>
												<tr>
													<th><?= $no ?></th>
													<th><?= $value->nama_member ?></th>
													<th><?= $value->no_ktp ?></th>
													<th><?= $value->jenis_kelamin ?></th>
													<th><?= $value->telp_member ?></th>
													<th><?= $value->tanggal_registrasi ?></th>
													<th>
														<?php if($value->status_member == 1){
															echo ('Aktif');
														}else {
															echo ('Tidak Aktif');
														}
														?>
													</th>
												</tr>
												<?php }
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div  class="col-md-5" id="tabel3" >
					<div class="row" style=" margin-top:20px;">
						<div class="ps text-center">
							<a href="<?php echo base_url().'registrasi_pelayanan'; ?>">
								<img src="<?php echo base_url(''); ?>assets/images/icon/I3.png" style="width: 55px;max-height: 55px;margin-bottom:7px">
								<label style="font-size: 10px">REGISTER PELAYANAN</label>
							</a>
						</div>
						<div class="ps text-center">	
							<a href="<?php echo base_url().'registrasi_pelayanan/tambah_customer'; ?>">
								<img  src="<?php echo base_url(); ?>assets/images/icon/I2.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
								<label style="font-size: 10px">TAMBAH CUSTOMER</label>
							</a>
						</div>
						<div class="ps text-center">	
							<a href="<?php echo base_url().'registrasi_pelayanan/akun_customer'; ?>">
								<img src="<?php echo base_url(); ?>assets/images/icon/I1.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
								<label style="font-size: 10px">AKUN KUSTOMER</label>
							</a>
						</div>
						<div class="ps text-center">	
							<a>
								<img src="<?php echo base_url(); ?>assets/images/icon/I4.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
								<label style="font-size: 10px">DAFTAR PAKET</label>
							</a>
						</div>
						<div class="ps text-center">	
							<a>
								<img src="<?php echo base_url(); ?>assets/images/icon/list transaksi.png" style="width: 55px;max-height: 55px;margin-bottom:7px;">
								<label style="font-size: 10px">LIST DAFTAR PAKET</label>
							</a>
						</div>
					</div><hr>
					<div class="row">
						<div class="col-md-12">
							<div  style="margin-top: 20px;padding: 0px">
								<div class="panel panel-default">
									<div class="panel-heading text-left" style="background-color: #2f898e;color: white">
										<h4>Tambah Customer</h4>
									</div>
									<div class="panel-body">
										<form id="formGudang">
											<div class="row">
												<div class="form-group  col-xs-6">
													<label><b>Kode Customer</label>
													<input type="text" value="<?php echo $get_kategori->kode_member?>" class="form-control" name="kode_member" id="kode_member" readonly="">
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Alamat Customer</label>
													<input type="text" value="<?php echo $get_kategori->alamat_member?>" class="form-control" name="alamat_member" id="alamat_member" required="">
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Nama Customer</label>
													<input type="text" value="<?php echo $get_kategori->nama_member?>" class="form-control" name="nama_member" id="nama_member" required="">
												</div>
												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>No. Telp</label>
													<input type="number" value="<?php echo $get_kategori->telp_member?>" class="form-control" name="telp_member" id="telp_member" required="">
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>No. KTP / SIM</label>
													<input type="number" value="<?php echo $get_kategori->no_ktp?>" class="form-control" name="no_ktp" id="no_ktp" required="">
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Pekerjaan</label>
													<select class="form-control input_pekerjaan select2" name="pekerjaan" id="pekerjaan" required="">
														<option selected="true" value="">--Pilih Pekerjaan--</option>
														<option <?php if($get_kategori->pekerjaan=='PNS'){echo "selected";}?>  value="PNS" >PNS</option>
														<option <?php if($get_kategori->pekerjaan=='Guru'){echo "selected";}?> value="Guru" >Guru</option>
														<option <?php if($get_kategori->pekerjaan=='Dosen'){echo "selected";}?> value="Dosen" >Dosen</option>
														<option <?php if($get_kategori->pekerjaan=='Pelajar/Mahasiswa'){echo "selected";}?> value="Pelajar/Mahasiswa" >Pelajar/Mahasiswa</option>
														<option <?php if($get_kategori->pekerjaan=='BUMN'){echo "selected";}?> value="BUMN" >BUMN</option>
														<option <?php if($get_kategori->pekerjaan=='Swasta'){echo "selected";}?> value="Swasta" >Swasta</option>
														<option <?php if($get_kategori->pekerjaan=='Wiraswasta'){echo "selected";}?> value="Wiraswasta" >Wiraswasta</option>
														<option <?php if($get_kategori->pekerjaan=='IRT'){echo "selected";}?> value="IRT" >IRT</option>
														<option <?php if($get_kategori->pekerjaan=='Lain - Lain'){echo "selected";}?> value="Lain-lain" >Lain - Lain</option>
													</select> 
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Tempat Lahir</label>
													<input  value="<?php echo $get_kategori->tempat_lahir?>" type="text" id="tempat_lahir" class="form-control input_tempat_lahir" name="tempat_lahir" required="" />
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Status Perkawinan</label>
													<select  class="form-control stok select2 input_status_perkawinan" name="status_perkawinan" id="status_perkawinan" required="">
														<option value="">--Pilih Status Perkawinan--</option>
														<option  <?php if($get_kategori->status_perkawinan=='Menikah'){echo "selected";}?> value="Menikah" >Menikah</option>
														<option  <?php if($get_kategori->status_perkawinan=='Belum Menikah'){echo "selected";}?> value="Belum Menikah" >Belum Menikah</option>
														<option  <?php if($get_kategori->status_perkawinan=='Janda/Duda'){echo "selected";}?> value="Janda/Duda" >Janda/Duda</option>
													</select> 
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Tanggal Lahir</label>
													<input  value="<?php echo $get_kategori->tanggal_lahir?>" type="date" id="tanggal_lahir" class="form-control input_tanggal_lahir" name="tanggal_lahir" required=""/>
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Agama</label>
													<select  class="form-control stok select2 input_agama" name="agama" id="agama" required="">
														<option value="">--Pilih Agama--</option>
														<option <?php if($get_kategori->agama=='Islam'){echo "selected";}?> value="Islam" >Islam</option>
														<option <?php if($get_kategori->agama=='Kristen'){echo "selected";}?> value="Kristen" >Kristen</option>
														<option <?php if($get_kategori->agama=='Katolik'){echo "selected";}?> value="Katolik" >Katolik</option>
														<option <?php if($get_kategori->agama=='Hindu'){echo "selected";}?> value="Hindu" >Hindu</option>
														<option <?php if($get_kategori->agama=='Budha'){echo "selected";}?> value="Budha" >Budha</option>
														<option <?php if($get_kategori->agama=='Lain-lain'){echo "selected";}?> value="Lain-lain" >Lain-lain</option>
													</select> 
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Jenis Kelamin</label>
													<select  class="form-control stok select2 input_jenis_kelamin" name="jenis_kelamin" id="jenis_kelamin" required="">

														<option value="">--Pilih Jenis Kelamin--</option>
														<option <?php if($get_kategori->jenis_kelamin=='Laki-laki'){echo "selected";}?> value="Laki-laki" >Laki-laki</option>
														<option <?php if($get_kategori->jenis_kelamin=='Perempuan'){echo "selected";}?> value="Perempuan" >Perempuan</option>
													</select> 
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Kategori Customer</label>
													<select  class="form-control stok select2 input_kategori_member" name="kategori_member" id="kategori_member" required="">
														<option value="">--Pilih Kategori Member--</option>
														<option <?php if($get_kategori->kategori_member=='Non Member'){echo "selected";}?> value="Non Member" >Non Member</option>
														<option <?php if($get_kategori->kategori_member=='Member'){echo "selected";}?> value="Member" >Member</option>
													</select> 
												</div>

												<div class="form-group  col-xs-6">
													<label class="gedhi"><b>Afiliasi</label>
													<select  class="form-control stok select2 input_status" name="afiliasi" id="afiliasi" required="">
														<option value="">--Pilih Afiliasi--</option>
														<option <?php if($get_kategori->afiliasi=='Event'){echo "selected";}?> value="Event" >Event</option>
														<option <?php if($get_kategori->afiliasi=='Instagram'){echo "selected";}?> value="Instagram" >Instagram</option>
														<option <?php if($get_kategori->afiliasi=='Facebook'){echo "selected";}?> value="Facebook" >Facebook</option>
														<option <?php if($get_kategori->afiliasi=='Twitter'){echo "selected";}?> value="Twitter" >Twitter</option>
														<option <?php if($get_kategori->afiliasi=='Keluarga'){echo "selected";}?> value="Keluarga/Teman" >Keluarga/Teman</option>
														<option <?php if($get_kategori->afiliasi=='Lain-lain'){echo "selected";}?> value="Lain-lain" >Lain-lain</option>
													</select> 
												</div>


												<div div class="form-group  col-xs-6">
													<select name="status_member" id="status_member" class="form-control" required="" value="<?php echo $get_kategori->status_member;?>">
														<option value="">-- Pilih Status --</option>
														<option <?php if($get_kategori->status_member=='1'){echo "selected";}?> value="1">Aktif</option>
														<option <?php if($get_kategori->status_member=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
													</select>
												</div>
											</div>
											<div>
												<button type="submit" id="insert" name="submit" class="btn btn-success btn-lg  btn-no-radius btn-shadow data_kasir"  style="width: 100%; margin: 5px; margin-left: 0; background-color: #2f898e">UPDATE</button>
											</div>
											<div class="btn btn-danger btn-lg  btn-no-radius btn-shadow data_kasir" onclick="batal_transaksi()" style="width: 100%; margin: 5px; margin-left: 0 ">CANCEL
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br>

					<br>
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
					<input type="hidden" id="kode_member">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

	$("#formGudang").submit( function() {              
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'registrasi_pelayanan/tambah_customer/update_member' ?>",  
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
					setInterval(function(){ window.location="<?php echo base_url('registrasi_pelayanan/tambah_customer/tambah_customer');?>"; }, 1500);
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
	}); 
	</script>