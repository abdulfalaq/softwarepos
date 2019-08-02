<?php 
$this->olive_master->order_by('id','DESC');
$get_gudang = $this->olive_master->get('master_layanan_periksa')->result();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/layanan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Layanan Periksa</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Layanan Periksa</h1>

	<?php $this->load->view('menu_setting'); ?>
	<div class="clearfix"></div>
	<?php 
	$kode_periksa=$this->uri->segment(4);
	$this->olive_master->where('kode_periksa',$kode_periksa);
	$get_gudang = $this->olive_master->get('master_layanan_periksa')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Layanan Periksa </span>
					<a href="<?php echo base_url('setting/layanan/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah </a>
					<a href="<?php echo base_url('setting/layanan'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Daftar</a>
				</div>
				<div class="panel-body">
					<form id="data_form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3><b>Layanan Periksa</b></h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Periksa</label>
										<input type="text" readonly="" value="<?php echo $get_gudang->kode_periksa?>"   class="form-control" placeholder="Kode " name="kode_periksa" id="kode_periksa" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Periksa</label>
										<input type="text" class="form-control"  value="<?php echo $get_gudang->nama_periksa?>" placeholder="Nama Periksa"  name="nama_periksa" id="nama_periksa"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi"><b>Harga Periksa</b></label>
										<input type="number" class="form-control" value="<?php echo $get_gudang->harga_periksa?>" name="harga_periksa" id="harga_periksa" />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Status</label>
										<select class="form-control select2" name="status"   value="<?php echo $get_gudang->status?>"  id="status" "">
											<option selected="true" value="">Pilih Status</option>
											<option <?php if($get_gudang->status=='1'){echo "selected";}?>  value="1">AKTIF</option>
											<option <?php if($get_gudang->status=='0'){echo "selected";}?>  value="0">TIDAK AKTIF</option>
										</select> 
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group" align="right">
										<br> <br>  
										<button type="submit" class="btn btn-no-radius btn-info pull-right">Update</button>
									</div>
								</div>
							</div>
						</div> 
						<div class="box-footer clearfix">

						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
</div>

<script type="text/javascript">
	$('#data_form').submit(function(){
		$.ajax({
			type: 'post',
			url: '<?php echo base_url('setting/layanan/update'); ?>',
			cache: false,
			data: $(this).serialize(),
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();   
					$(".alert_berhasil").show();   
					window.location="<?php echo base_url('setting/layanan/daftar');?>";
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