
<!-- back button -->
<a href="<?php echo base_url('pemasukan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i>Dashboard</a></li>
		<li><a href="<?php echo base_url('pemasukan'); ?>">Pemasukan</a></li>
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
					<span class="pull-left" style="font-size: 24px">Tambah Pemasukan </span>
					<a href="<?php echo base_url('pemasukan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('pemasukan/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form"  method="post">
						<?php
						$uri = $this->uri->segment(4);
						if(!empty($uri)){
							$data = $this->olive_keuangan->get_where('keuangan_masuk',array('id'=>$uri));
							$hasil_data = $data->row();
						}
						?>
						<div class="row">
							<input type="hidden" name="id" value="<?php echo @$hasil_data->id ?>" />
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Kode Pemasukan</b></label>
								<input class="form-control" type="text" id="kode_sub_kategori_keuangan" required="" name="kode_sub_kategori_keuangan" value="<?php echo "P_".date('ymdhis')?>" readonly="" />
							</div>

							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Kategori</b></label>
								<input class="form-control" type="text" id="nama_kategori_keuangan" name="nama_kategori_keuangan" required="" value="Pemasukan" readonly="" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Nominal</b></label>
								<div class="input-group">
									<input type="number" class="form-control" value="" name="nominal" required="" id="nominal" >
									<span class="input-group-addon"><div id="rupiah"></div></span>
								</div>
							</div>
							<div class="form-group  col-xs-6">
								<label class="gedhi"><b>Nama Akun</b></label>
								<input class="form-control" type="text" id="nama_sub_kategori_keuangan" required="" name="nama_sub_kategori_keuangan" placeholder="Sub Kategori" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label><b>Keterangan</b></label>
								<textarea class="form-control" value="" required="" name="keterangan" id="keterangan" ></textarea>
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
	$("#nominal").keyup(function(){
		var nominal = $('#nominal').val();

		if (nominal <= 0 ) {
			alert('Nominal tidak boleh dibawah 0.')
			$('#nominal').val('');

		}else{

			var url = "<?php echo base_url() . 'pemasukan/pemasukan/get_rupiah'; ?>";
			$.ajax({
				type: 'POST',
				url: url,
				data: {
					nominal:nominal
				},
				success: function(msg){
					$('#rupiah').html(msg);
				}
			});
		}
		return false;
	});

	$('#data_form').submit(function(){

		var url = "<?php echo base_url(). 'pemasukan/pemasukan/simpan'; ?>";
		$.ajax( {  
			type : "post", 
			url : url,
			data : $(this).serialize(),
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success : function(data) {  
				$(".tunggu").hide();   
				$(".alert_berhasil").show();   
				window.location="<?php echo base_url('pemasukan/pemasukan');?>"; 
			},  
			error : function() {  
				alert("Data gagal dimasukkan.");  
			}  
		});
		return false;
	});
</script>
