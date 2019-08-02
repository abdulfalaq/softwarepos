
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">Master</a></li>
		<li><a href="#">Master Obat</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Obat</span>
					<a href="<?php echo base_url('master/master_obat/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/master_obat/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-body row">
							<div class="col-md-6">
								<label class="control-label">Kode Obat</label>
								<input type="text" class="form-control" name="kode_obat" id="kode_obat" placeholder="Kode Obat" required="" />
							</div>
							<div class="col-md-6">
								<label class="control-label">Nama Obat</label>
								<input type="text" class="form-control" name="nama_obat" id="nama_obat" value="" placeholder="Nama obat" required="" />
							</div>
							<div class="col-md-6">
								<label class="control-label">Jenis</label>
								<select class="bs-select form-control" name="jenis_obat" id="jenis_obat" required="">
									<option selected="true" value="">-- Pilih --</option>
									<option  value="Antibiotik" >Antibiotik</option>
									<option  value="Non Antibiotik" >Non Antibiotik</option>
								</select>
							</div>
							<div class="col-md-6">
								<label>Gudang </label>
								<select class="form-control select2"  id="kode_gudang" required="" name="kode_gudang">
									<option selected="true" value="">-- Pilih --</option>
									<?php
									$this->db2->where('status','1');
									$get_paket = $this->db2->get('master_gudang')->result();
									foreach ($get_paket as $value) {?>
										<option value="<?php echo $value->kode_gudang ?>"><?php echo $value->nama_gudang ?>
									</option>
									<?php }
									?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label">Metoda Obat</label>
								<select class="bs-select form-control select2" name="kode_metoda_obat" required="" id="kode_metoda_obat">
									<option value="">-- Pilih --</option>
									<?php
									$this->db2->where('status','1');
									$get_paket = $this->db2->get('master_metoda_obat')->result();
									foreach ($get_paket as $value) {?>
										<option value="<?php echo $value->kode_metoda_obat ?>"><?php echo $value->metoda_obat ?>
									</option>
									<?php }
									?>
								</select>
							</div>
								<div class="col-md-6">
								<label class="control-label">Stok Minimal</label>
								<input type="text" class="form-control" name="stok_minimal" required="" id="stok_minimal" value="" placeholder="Masukkan Stok barang">
							</div>
							<div class="col-md-6">
								<label class="control-label">Satuan Obat</label>
								<select  name="kode_satuan_stok" id="kode_satuan_stok" class="form-control" required=""> 
									<option  value="">-- Pilih --</option>
									<?php
									$get_paket = $this->db2->get('master_satuan')->result();
									foreach ($get_paket as $value) {?>
										<option value="<?php echo $value->kode ?>"><?php echo $value->nama ?>
									</option>
									<?php }
									?>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label">HPP</label>
								<input type="text" class="form-control" name="hpp" id="hpp" required="" value="" placeholder="obat">
							</div>
							<div class="col-md-6">
								<label class="control-label">Harga Jual</label>
								<input type="text" class="form-control" name="harga_jual" required="" id="harga_jual" value="" placeholder="Masukkan Harga Jual">
							</div>

							<div class="col-md-6">
								<label class="control-label">Status Bantuan</label>
								<select class="bs-select form-control select2" name="status_bantuan" required="" id="status_bantuan">
									<option  value="">-- Pilih --</option>
									<option  value="Subsidi">Subsidi</option>
									<option  value="Non Subsidi">Non Subsidi</option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label">Status</label>
								<select class="bs-select form-control select2" required="" name="status" id="status">
									<option  value="">-- Pilih --</option>
									<option  value="1">Aktif</option>
									<option  value="0">Tidak Aktif</option>
								</select>
							</div>
						</div>
						<div class="box-footer clearfix">
							<button type="submit" style="margin-top: 20px; margin-right: 20px; margin-bottom: 15px;" class="pull-right btn btn-primary" id="data_form">Save <i class="fa fa-arrow-circle-right"></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#data_form").submit( function() {              
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'master/master_obat/simpan' ?>",  
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
					setInterval(function(){ window.location="<?php echo base_url('master/master_obat/daftar');?>"; }, 1500);
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