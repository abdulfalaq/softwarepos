
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Data Koperasi</a></li>
		<li><a href="#">Rekening</a></li>
		<li>Kewajiban</li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Kewajiban</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 20px;">Daftar Setting</span>
					<a href="<?php echo @base_url('setting/setting_rekening/get_nomer_kewajiban'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-gear"></i> Setting</a>
					<a href="<?php echo @base_url('setting/setting_rekening/tambah_kewajiban'); ?>" type="button" class="btn btn-no-radius btn-success"><i class="fa fa-plus"></i> Tambah Kewajiban</a>
					<a href="<?php echo @base_url('setting/setting_rekening/daftar_kewajiban'); ?>" type="button" class="btn btn-no-radius btn-primary"><i class="fa fa-list"></i> Daftar Kewajiban</a>
				</div>				<div class="panel-body">
					<div class="col-sm-6">
						<table width="100%" class="table-form">

							<tr>
								<td width="280px">Setting No Akun</td>
								<td><input type="text" name="no_akun" id="no_akun" class="form-control" required=""></td>
								<td> <a onclick="add_item()" id="simpan_nomer"  style="margin-left: 10px;" class="btn btn-no-radius btn-success"><i class="fa fa-save"></i> Sett</a> <a type="button" id="update_nomer"  style="margin-left: 10px;" class="btn btn-no-radius btn-warning"><i class="fa fa-save"></i> Edit</a></td>
							</tr>
<!-- 							<tr class="form_sub_akun">
								<td colspan="2"><h4>Sub Akun</h4></td>
							</tr>
							<tr class="form_sub_akun">
								<td><div id="view_kode"></div><input type="hidden" name="kode_sub_akun" id="kode_sub_akun"></td>
								<td>
									<select name="kode_akun" id="kode_akun" class="form-control" required="">
										<option value="">Pilih Akun</option>
										<?php 
										$ambil_data = $this->db->get('setting_kategori_akun');
										$hasil_ambil_data = $ambil_data->result();
										foreach ($hasil_ambil_data as $key => $value) {
											?>
											<option value="<?php echo $value->kode_kategori ;?>"><?php echo $value->nama_kategori ;?></option>
											<?php
										}
										?>
									</select>
								</td>
								<td>
									<button  onclick="add_item()" style="margin-left: 10px;" class="btn btn-no-radius btn-info"><i class="fa fa-plus"></i> Add</button>
								</td>
							</tr> -->
						</table>
						<br>
						
					</div>
				</div>
				<div class="panel-footer text-right">
					<!-- <button class="btn btn-lg btn-super btn-no-radius btn-primary"><i class="fa fa-save"></i> SIMPAN</button> -->
				</div>
			</div>
		</div>
	</div> <!-- //row -->
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
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript">
	$(document).ready(function(){
		$('#update_btn').hide();
		$('.form_sub_akun').hide();
		$('#update_nomer').hide();

		$('#simpan_nomer').on('click', function() {
			var no_akun = $('#no_akun').val();
			if (no_akun != '') {
				$('.form_sub_akun').show();
				document.getElementById('no_akun').setAttribute("disabled","disabled");
				get_kode();
			}else{
				alert("Silahkan cek formnya !");
			}
		});



	});

	function add_item(){
		var no_akun = $('#no_akun').val();
		if (no_akun == '') {
			alert("Silahkan cek formnya !")
		}
		else{
			$.ajax({
				type: "POST",
				url : "<?php echo base_url() . 'setting/setting_rekening/simpan_nomer_kewajiban' ?>",  
				data: { 
					no_akun:no_akun,
				},
				beforeSend:function(){
					$(".tunggu").show();  
				},
				success: function(data)
				{
					$(".tunggu").hide();  
					
					// setTimeout(function(){
					// 	window.location = "<?php echo base_url().'setting/setting_rekening/daftar_kewajiban' ?>"  
					// },2000);


				}
			});
		}
	}




	function update() {
		$('#simpan_btn').hide();
		$('#update_btn').show();
	}

	function get_kode() {

		var no_akun = $('#no_akun').val();

		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/setting_rekening/get_kode' ?>",  
			cache :false,  
			data :{no_akun:no_akun},
			success : function(sub_kode) {  
				$('#kode_sub_akun').val(sub_kode);
				$('#view_kode').html(sub_kode);
			},  
			error : function() {  
				alert("test");
			}  
		});	
	}

	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$('#update_btn').click(function(){
		$('#update_btn').hide();
		$('#simpan_btn').show();
	});
</script>