
<!-- back button -->
<a href="<?php echo base_url('setting/user/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">User</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah User </span>
					<a href="<?php echo base_url('setting/user/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('setting/user/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<form id="data_form" method="post">
						<div class="box-body">            
							<div class="row">
								<?php
								$uri = $this->uri->segment(4);
								if(!empty($uri)){
									$data = $this->olive_master->get_where('master_user',array('id'=>$uri));
									$hasil_data = $data->row();

									$get_karyawan = $this->olive_master->get_where('master_karyawan',array('kode_karyawan'=>$hasil_data->kode_karyawan));
									$hasil_get_karyawan = $get_karyawan->row();
								}
								?>
								<div class="form-group  col-xs-5">
									<label class="gedhi">Karyawan</label>
									<?php
									$karyawan = $this->olive_master->get('master_karyawan');
									$hasil_karyawan = $karyawan->result();
									?>
									<select class="form-control select2" name="kode_karyawan" id="kode_karyawan" required="" onchange="get_karyawan()">
										<option selected="true" value="">--Pilih Karyawan--</option>
										<?php foreach($hasil_karyawan as $daftar){ ?>
										<option <?php echo (@$daftar->kode_karyawan == @$hasil_data->kode_karyawan) ? 'selected' : '' ?> value="<?php echo $daftar->kode_karyawan ?>"><?php echo $daftar->nama_karyawan ?></option>
										<?php
									} 
									?>
								</select>
							</div>
							<div class="form-group  col-xs-5">
								<label class="gedhi">Username</label>
								<input type="hidden" name="id" value="" />
								<input type="text" class="form-control" value="<?php echo @$hasil_data->uname; ?>" name="uname" required=""/>
							</div>
							<div class="form-group  col-xs-5">
								<label class="gedhi">Password</label>
								<input type="password" class="form-control" value="<?php echo paramDecrypt(@$hasil_data->upass); ?>" required="" name="upass" id="upass" />
							</div>
							<div class="form-group  col-xs-5">
								<label class="gedhi">Jabatan</label>
								<input type="text" readonly="" class="form-control" value="<?php echo @$hasil_get_karyawan->jabatan; ?>" name="nama_jabatan" id="nama_jabatan" required=""/>
							</div>
							<div class="form-group  col-xs-5">
								<label class="gedhi">Status</label>
								<select class="form-control select2" name="status" id="status" required="">
									<option selected="true" value="">--Pilih Status--</option>
									<option <?php echo "1" == @$hasil_data->status ? 'selected' : '' ?> value="1" >Aktif</option>
									<option <?php echo "0" == @$hasil_data->status ? 'selected' : '' ?> value="0" >Tidak Aktif</option>
								</select>
							</div>
							<div id="modul">
							</div>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>


<script type="text/javascript">

	$(document).ready(function(){
		$(".select2").select2();
		$('#modul').hide();
		<?php if(!empty($uri)){ ?>
			$('#modul').show();
			<?php 
		}else{ ?>
			$('#modul').hide();
			<?php 
		} ?>

		$('.div_pic').hide();
	});

	$('#jabatan').change(function(){

		var jabatan = $('#jabatan').val();
		if(jabatan == ''){
			$('#modul').hide();
		}
		else if(jabatan == '004'){
			$('.div_pic').hide();
			$('#modul').show();
		}
		else if(jabatan == '008'){
			$('.div_pic').hide();
			$('#modul').show();
		}
		else if(jabatan == '006'){
			$('.div_pic').show();
			$('#modul').show();
		}
	});

	function get_karyawan(){
		var kode_karyawan=$('#kode_karyawan').val();
		var url = "<?php echo base_url(). 'setting/user/get_karyawan'; ?>";  
		$.ajax( {  
			type : "post", 
			url : url,
			cache : false,  
			data : {kode_karyawan:kode_karyawan},
			dataType:'json',
			success : function(data) {  
				$("#nama_jabatan").val(data.nama_jabatan);   

			},  
			error : function() {  
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
	
	$('#data_form').submit(function(){

		<?php 
		$uri = $this->uri->segment(4);
		if(!empty($uri)){ ?>
			var url = "<?php echo base_url(). 'setting/user/simpan_edit_user'; ?>";  
			<?php
		}else{ ?>
			var url = "<?php echo base_url(). 'setting/user/simpan_tambah_user'; ?>";
			<?php 
		} ?>

		$.ajax( {  
			type : "post", 
			url : url,
			cache : false,  
			data : $(this).serialize(),
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {   
				$(".sukses").html(data);   
				setTimeout(function(){$('.sukses').html('');
					window.location = "<?php echo base_url() . 'setting/user/' ?>";
				},1500);      
			},  
			error : function() {  
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;
	});
</script>