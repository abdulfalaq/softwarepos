
<a href="<?php echo base_url('setting'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('Setting'); ?>">Setting</a></li>
		<li><a href="#">Poin</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Poin</h1>

	<?php $this->load->view('menu_setting'); ?>

	<div class="clearfix"></div>
	<?php 
	$get_gudang = $this->db2->get('setting_poin')->row();
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span style="font-size: 24px">Data Poin</span>
				</div>
				<div class="panel-body">
					<form id="formGudang">
						<div class="box-body"> 
							<div class="row">           
								<div class="col-md-12">
									<div class="form-group col-md-6">
										<label class="gedhi">Nominal Poin</label>
										<div class="input-group">
											<span class="input-group-addon r_nm"><?php echo format_rupiah($get_gudang->nominal_poin) ?></span>
											<input type="number" class="form-control input-group" onkeyup="get_nominal_hpp()" name="nominal_poin" id="nominal_poin" value="<?php echo $get_gudang->nominal_poin; ?>" required=""/>
										</div>
									</div>

									<div class="form-group col-md-6">
										<label class="gedhi">Nominal Transaksi</label>
										<div class="input-group">
											<span class="input-group-addon r_in"><?php echo format_rupiah($get_gudang->nominal_transaksi) ?></span>
											<input type="number" class="form-control input-group" onkeyup="get_insentif()" name="nominal_transaksi" id="nominal_transaksi" value="<?php echo $get_gudang->nominal_transaksi; ?>" required="" />
										</div>
									</div>								
								</div>
							</div>
							<div class="box-footer pull-right">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
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
			url : "<?php echo base_url() . 'setting/poin/update_poin' ?>",  
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
					window.location="<?php echo base_url('setting/poin/edit');?>"; 
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
		var nominal = $('#nominal_poin').val();
		if(parseInt(nominal) < 0){
			alert("Nominal Salah");
			$('#nominal_poin').val('');
			$(".r_nm").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/poin/get_nomin' ?>",
				data: {
					nominal: nominal
				},

				success: function(msg)
				{
					$(".r_nm").html(msg);
				}
			});
		}
	}

	function get_insentif(){
		var nominal = $('#nominal_transaksi').val();
		if(parseInt(nominal) < 0){
			alert("Nominal Salah");
			$('#nominal_transaksi').val('');
			$(".r_in").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/poin/get_nomin' ?>",
				data: {
					nominal: nominal
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
