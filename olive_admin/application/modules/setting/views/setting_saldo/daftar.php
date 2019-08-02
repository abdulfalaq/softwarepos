
<!-- back button -->
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#"> Setting Saldo Awal</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Setting </h1>
	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<?php 
	$get_gudang = $this->db2->get('setting_saldo_awal')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Setting Saldo Awal</span>
					<br><br>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body"> 
							<div class="row">           
								<div class="col-md-12">
									<div class="form-group col-md-6">
										<label class="gedhi">Kas Awal</label>
										<div class="input-group">
											<span class="input-group-addon r_nm"><?php echo format_rupiah($get_gudang->kas_awal) ?></span>
											<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="kas_awal" id="kas_awal" value="<?php echo $get_gudang->kas_awal; ?>" required=""/>
										</div>
									</div>

									<div class="form-group col-md-6">
										<label class="gedhi">Pesediaan Awal</label>
										<div class="input-group">
											<span class="input-group-addon r_in"><?php echo format_rupiah($get_gudang->persediaan_awal) ?></span>
											<input type="number" class="form-control input-group" onkeyup="get_insentif()" name="persediaan_awal" id="persediaan_awal" value="<?php echo $get_gudang->persediaan_awal; ?>" required="" />
										</div>
									</div>								
								</div>
							</div>
							<div class="box-footer pull-right">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
					<?php 
					$this->db2->order_by('id','DESC');
					$get_awal = $this->db2->get('setting_saldo_awal')->result();
					?>
					<div class="row">      
						<div class="col-xs-12" style="margin-top: 20px">          
							<table class="table table-striped table-hover table-bordered" id="datatable">
								<thead>
									<tr>
										<th>Saldo Awal Kas</th>
										<th>Saldo Awal Persediaan</th>
									</tr>
								</thead>
								<tbody id="scroll_data">
									<?php 
									$no = 0;
									foreach ($get_awal as $value) { 
										$no++; ?>
										<tr>
											<td><?= format_rupiah($value->kas_awal) ?></td>
											<td><?= format_rupiah($value->persediaan_awal) ?></td>
										</tr>
										<?php 
									} 
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- //row -->
<div id="modal-hapus" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alert</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menghapus data ini?</h2>
				<input type="hidden" id="kode_peralatan">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function hapus(key) {
		$('#modal-hapus').modal('show');
	}

	$("#formGudang").submit( function() {  
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/setting_saldo/update_poin' ?>",  
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
					window.location="<?php echo base_url('setting/setting_saldo/');?>"; 
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



	function get_nominal_hpp(){
		var awal = $('#kas_awal').val();
		if(parseInt(awal) <= 0){
			alert("awal Salah");
			$('#kas_awal').val('');
			$(".r_nm").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/setting_saldo/get_nomin' ?>",
				data: {
					awal: awal
				},

				success: function(msg)
				{
					$(".r_nm").html(msg);
				}
			});
		}
	}

	function get_insentif(){
		var awal = $('#persediaan_awal').val();
		if(parseInt(awal) <= 0){
			alert("awal Salah");
			$('#persediaan_awal').val('');
			$(".r_in").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/setting_saldo/get_nomin' ?>",
				data: {
					awal: awal
				},

				success: function(msg)
				{
					$(".r_in").html(msg);
				}
			});
		}
	}

</script>
</div>
</div>
</div>
<script src="http://192.168.100.17/amway/component/bootstrap/js/bootstrap.min.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/fastclick/fastclick.min.js"></script>
<script src="http://192.168.100.17/amway/component/dist/js/app.min.js"></script>
<script src="http://192.168.100.17/amway/component/dist/js/demo.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/jquery.matchHeight-min.js"></script>
<!-- DataTables -->
<script src="http://192.168.100.17/amway/component/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="http://192.168.100.17/amway/component/plugins/datatables/dataTables.bootstrap.min.js"></script>


<script src="http://192.168.100.17/amway/component/plugins/select2/select2.full.min.js"></script>


<script>
	$(function () {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false
		});
	});

	$('.select2').select2();
</script>
