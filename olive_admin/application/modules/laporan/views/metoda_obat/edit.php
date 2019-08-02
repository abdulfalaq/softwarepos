
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('master'); ?>">master</a></li>
		<li><a href="<?php echo base_url('master/metoda_obat/daftar'); ?>">Metoda Obat</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Master Metoda Obat</h1>

	<?php $this->load->view('menu_master'); ?><br>

	<div class="clearfix"></div>
	<?php 
	$kode_gudang=$this->uri->segment(4);
	$this->db_master->where('id',$kode_gudang);
	$get_gudang = $this->db_master->get('master_metoda_obat')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Edit Metoda</span>
					<a href="<?php echo base_url('master/metoda_obat/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah</a>
					<a href="<?php echo base_url('master/metoda_obat/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data</a>
				</div>
				<div class="panel-body">
					<div class="sukses" ></div>
					<form id="data_form">
						<div class="form-body row">
							<div class="col-md-6">
								<label class="control-label">Kode Metoda</label>
								<input type="hidden" id="id" name="id" required="" value="<?php echo $get_gudang->id?>" />
								<input type="text" class="form-control" name="kode_metoda_obat" id="kode_metoda_obat" required="" value="<?php echo $get_gudang->kode_metoda_obat?>" readonly/>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Metoda</label>
								<input type="text" cols="11" class="form-control" name="metoda_obat"  style="height: 52px;" id="metoda_obat" placeholder="Pemakaian" required="" value="<?php echo $get_gudang->metoda_obat?>">
							</div>
							<div class="form-group col-md-6">
								<label class="control-label">Status</label>
								<select class="form-control" id="status" name="status" required="" value="<?php echo $get_gudang->status?>">
									<option  value="">-->Pilih<--</option>
									<option <?php if($get_gudang->status=='1'){echo "selected";}?>  value="1">AKTIF</option>
									<option <?php if($get_gudang->status=='0'){echo "selected";}?>  value="0">TIDAK AKTIF</option>
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
	$(function () {  
		$("#data_form").submit( function() {
			id 					= $('#id').val();
			kode_metoda_obat 	= $('#kode_metoda_obat').val();
			metoda_obat 		= $('#metoda_obat').val();
			status 				= $('#status').val();
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'master/metoda_obat/update_metoda' ?>",  
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
						window.location="<?php echo base_url('master/metoda_obat/daftar');?>"; 
					}else{
						alert('Gagal Menyimpan data');
							setInterval(function(){ location.reload() }, 1000);
						}
					},  
					error : function() {
						alert("Data gagal dimasukkan.");  
					}  
				});
			return false;   
		});
	});
</script>