
<!-- back button -->
<a href="<?php echo base_url('penggajian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penggajian'); ?>">Penggajian</a></li>
		<li><a href="#">Tambah</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Penggajian </span>
					<a href="<?php echo base_url('penggajian/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('penggajian/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form"  method="post">
						<div class="row">
							<input type="hidden" name="id" value="" />
							<input class="form-control" type="hidden" id="kode_transaksi" name="kode_transaksi" value="<?php echo 'P_'.date('ymdHis');?>" readonly="" />
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Tanggal Penggajian</b></label>

								<input type="date" class="form-control" value="<?php echo date('Y-m-d');?>" name="tanggal_transaksi" id="tanggal_transaksi" required="">
							</div>
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Karyawan</b></label>
								<select required class="form-control select2" id="kode_karyawan" name="kode_karyawan" onchange="get_karyawan()">
									<option value="">--Pilih Karyawan--</option>
									<?php
									$this->db->where('status_karyawan', '1');
									$get_karyawan=$this->db->get('olive_master.master_karyawan')->result();
									foreach ($get_karyawan as $karyawan) {
										?>
										<option value="<?php echo @$karyawan->kode_karyawan;?>"><?php echo @$karyawan->nama_karyawan;?></option>
										<?php
									}
									?>
								</select> 
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Gaji Pokok</b></label>
								<div class="input-group">
									<input type="number" class="form-control" readonly value="" name="gaji_pokok" id="gaji_pokok" >
									<span class="input-group-addon" ><div id="n_gaji_pokok"></div></span>
								</div>
							</div>

						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Insentif Kehadiran</b></label>
								<div class="input-group">
									<input type="number" class="form-control" required="" onkeyup="get_insentif()" onclick="get_insentif()" value="" name="insentif_kehadiran" id="insentif_kehadiran" >
									<span class="input-group-addon"><div id="n_insentif_kehadiran"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Insentif Treatment & Masker</b></label>
								<div class="input-group">
									<input type="number" class="form-control"  value="" name="insentif_treatment" id="insentif_treatment" readonly>
									<span class="input-group-addon"><div id="n_insentif_treatment"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Tunjangan Jabatan</b></label>
								<div class="input-group">
									<input type="number" class="form-control" required="" onkeyup="get_tunjangan()" onclick="get_tunjangan()" value="" name="tunjangan_jabatan" id="tunjangan_jabatan" >
									<span class="input-group-addon"><div id="n_tunjangan_jabatan"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Insentif Cuti</b></label>
								<div class="input-group">
									<input type="number" class="form-control" required="" onkeyup="get_cuti()" onclick="get_cuti()" value="" name="insentif_cuti" id="insentif_cuti" >
									<span class="input-group-addon"><div id="n_insentif_cuti"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Lembur</b></label>
								<div class="input-group">
									<input type="number" class="form-control" required="" onkeyup="get_lembur()" onclick="get_lembur()" value="" name="lembur" id="lembur" >
									<span class="input-group-addon"><div id="n_lembur"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Potongan</b></label>
								<div class="input-group">
									<input type="number" class="form-control" required="" onkeyup="get_potongan()" onclick="get_potongan()" value="" name="potongan" id="potongan" >
									<span class="input-group-addon"><div id="n_potongan"></div></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Total</b></label>
								<div class="input-group">
									<input type="number" readonly class="form-control" value="" name="total_gaji" id="total_gaji" >
									<span class="input-group-addon"><div id="n_total_gaji"></div></span>
								</div>
							</div>
							<div class="col-md-6" style="margin-top: -400px;" id="tabel_insentif">
								<label><b>List Transaksi Treatment & Masker</b></label>
								<table class="table table-striped table-hover table-bordered" >
									<thead>
										<tr>
											<th>No.</th>
											<th>Tanggal</th>
											<th>Insentif</th>
										</tr>
									</thead>
									<tbody id="list_insentif">
										
									</tbody>
								</table>
							</div>
						</div>
						<br>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#tabel_insentif").hide();
	function get_karyawan(){
		var url = "<?php echo base_url().'penggajian/get_karyawan'; ?>";
		var kode_karyawan = $("#kode_karyawan").val();
		$.ajax( {
			type:"POST", 
			url : url,  
			cache :false,  
			data :{kode_karyawan:kode_karyawan},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {  
				$(".tunggu").hide();
				$("#gaji_pokok").val(data.gaji);
				$("#insentif_treatment").val(data.total_withdraw);
				$("#n_gaji_pokok").text(toRp(data.gaji));
				$("#n_insentif_treatment").text(toRp(data.total_withdraw));
				if(data.nama_jabatan=='Terapis' || data.kode_jabatan=='J_0001'){
					$("#tabel_insentif").show();
					$("#list_insentif").load('<?php echo base_url().'penggajian/list_insentif'; ?>/'+kode_karyawan);
				}else{
					$("#tabel_insentif").hide();
					
				}
				hitung_total();
			} 
		});
	}
	function get_insentif(obj){
		var insentif_kehadiran = parseInt($("#insentif_kehadiran").val());
		if(insentif_kehadiran < 0){
			alert('Jumlah Insentif Kehadiran Salah');
			$("#insentif_kehadiran").val('');
		}else{
			$("#n_insentif_kehadiran").text(toRp(insentif_kehadiran));
			hitung_total();
		}
	}
	function get_tunjangan(obj){
		var tunjangan_jabatan = parseInt($("#tunjangan_jabatan").val());
		if(tunjangan_jabatan < 0){
			alert('Jumlah Tunjangan Jabatan Salah');
			$("#tunjangan_jabatan").val('');
		}else{
			$("#n_tunjangan_jabatan").text(toRp(tunjangan_jabatan));
			hitung_total();
		}
	}
	function get_cuti(obj){
		var insentif_cuti = parseInt($("#insentif_cuti").val());
		if(insentif_cuti < 0){
			alert('Jumlah Insentif Cuti Salah');
			$("#insentif_cuti").val('');
		}else{
			$("#n_insentif_cuti").text(toRp(insentif_cuti));
			hitung_total();
		}
	}
	function get_lembur(obj){
		var lembur = parseInt($("#lembur").val());
		if(lembur < 0){
			alert('Jumlah Lembur Salah');
			$("#lembur").val('');
		}else{
			$("#n_lembur").text(toRp(lembur));
			hitung_total();
		}
	}
	function get_potongan(obj){
		var potongan = parseInt($("#potongan").val());
		if(potongan < 0){
			alert('Jumlah Potongan Salah');
			$("#potongan").val('');
		}else{
			$("#n_potongan").text(toRp(potongan));
			hitung_total();
		}
	}

	function hitung_total(){
		var gaji_pokok = parseInt($("#gaji_pokok").val());
		var insentif_treatment = parseInt($("#insentif_treatment").val());
		var insentif_kehadiran = parseInt($("#insentif_kehadiran").val());
		var tunjangan_jabatan = parseInt($("#tunjangan_jabatan").val());
		var insentif_cuti = parseInt($("#insentif_cuti").val());
		var lembur = parseInt($("#lembur").val());
		var potongan = parseInt($("#potongan").val());

		var url = "<?php echo base_url().'penggajian/get_total_gaji'; ?>";
		$.ajax( {
			type:"POST", 
			url : url,  
			cache :false,  
			data :{gaji_pokok:gaji_pokok,insentif_treatment:insentif_treatment,insentif_kehadiran:insentif_kehadiran,tunjangan_jabatan:tunjangan_jabatan,insentif_cuti:insentif_cuti,lembur:lembur,potongan:potongan},
			dataType:'json',
			
			success : function(data) {  
				$("#total_gaji").val(data);
				$("#n_total_gaji").text(toRp(data));
			} 
		});
	}
	function toRp(angka){
		if(isNaN(angka)){
			return 'Rp.0,00';
		}else{
			var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
			var rev2    = '';
			for(var i = 0; i < rev.length; i++){
				rev2  += rev[i];
				if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
					rev2 += '.';
				}
			}
			return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
			
		}
		
	}
	$("#data_form").submit(function(){
		var url = "<?php echo base_url().'penggajian/simpan_penggajian'; ?>";
		$.ajax( {
			type:"POST", 
			url : url,  
			cache :false,  
			data :$(this).serialize(),
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {  
				$(".tunggu").hide();
				window.location="<?php echo base_url().'penggajian/daftar'; ?>";  
			},
			error : function() {  
      			alert("gagal");  
    		} 
		});
		return false;
	});
</script>

