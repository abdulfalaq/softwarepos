<?php 
$this->db2->order_by('id','DESC');
$get_gudang = $this->db2->get('master_supplier')->result();
?>

<a href="<?php echo base_url('supplier'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('supplier'); ?>">Supplier</a></li>
		<li><a href="#">Pendaftaran Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Pendaftaran Supplier</h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php 
	$kode_supplier=$this->uri->segment(4);
	if (!empty($kode_supplier)) {

		$this->db2->where('kode_supplier',$kode_supplier);
		$get_supplier = $this->db2->get('master_supplier')->row();
	}	
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Pendaftaran Supplier</span>
				</div>
				<div class="panel-body">
					<form id="data_form"  method="post">
						<div class="box-body">            
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>Kode Supplier</label>
									<input type="hidden" name="id" id="id" value="<?php echo @$get_supplier->id ?>" />
									<input  type="text" class="form-control" onchange="cek_kode()" value="<?php echo @$get_supplier->kode_supplier ?>" <?php if (!empty($get_supplier)){echo 'readonly';} ?> name="kode_supplier" id="kode_supplier" required/>
								</div>
								<div class="form-group  col-xs-6">
									<label>Nama PIC</label>
									<input type="text"  class="form-control"  value="<?php echo @$get_supplier->nama_pic ?>"  name="nama_pic" id="nama_pic" required/>
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>Nama Supplier</label>
									<input type="text"  class="form-control"  value="<?php echo @$get_supplier->nama_supplier ?>"  name="nama_supplier" id="nama_supplier" required/>
								</div>
								<div class="form-group  col-xs-6">
									<label>No Telp PIC</label>
									<input type="number"  class="form-control"  value="<?php echo @$get_supplier->telp_pic ?>"  name="telp_pic" id="telp_pic" required/>
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>No Telp Supplier</label>
									<input type="number"  class="form-control"  value="<?php echo @$get_supplier->telp_supplier ?>"  name="telp_supplier" id="telp_supplier" required/>
								</div>
								<div id="div-status-member" class="input_status_supplier form-group  col-xs-6">
									<label>Status Supplier</label>
									<div class="">
										<select class="form-control" id="status_supplier" name="status_supplier" required>
											<option selected value="" >Pilih</option>
											<option <?php if(@$get_supplier->status_supplier=='1'){echo "selected";}?> value="1">Aktif</option>
											<option <?php if(@$get_supplier->status_supplier=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group  col-xs-6">
									<label>Alamat Supplier</label>
									<input type="text"  class="form-control" value="<?php echo @$get_supplier->alamat_supplier ?>"  name="alamat_supplier" id="alamat_supplier" required/>
								</div>
								<div class="box-footer">
									<button type="submit"  style="float: right;margin-right: 25px;margin-top: 40px" class="btn btn-primary" id='btn_simpan'>Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading text-right" style="height: 55px">
					<span class="pull-left" style="font-size: 24px">Tambah Supplier</span>
				</div>
				<div class="panel-body">
					<div class="box-body">            
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Supplier</th>
									<th>Nama Supplier</th>
									<th>No.Telp</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>    
								<?php 
								$no = 0;
								foreach ($get_gudang as $value) { 
									$no++; ?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $value->kode_supplier ?></td>
										<td><?= $value->nama_supplier ?></td>
										<td><?= $value->telp_supplier ?></td>
										<td><?php if($value->status_supplier == 1){
											echo ('Aktif');
										}else {
											echo ('Tidak Aktif');
										}
										?></td>
										<td align="center">
											<div class="btn-group">
												<a href="<?php echo base_url('supplier/pendaftaran_supplier/tambah/'.$value->kode_supplier ); ?>" key="4" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-warning btn-circle yellow"><i class="fa fa-pencil"></i></a>
												<a onclick="actDelete('<?php echo $value->kode_supplier ?>')" data-toggle="tooltip" title="Delete" class="btn btn-danger btn-circle red"><i class="fa fa-remove"></i></a>
											</div>
										</td>
									</tr>
									<?php }
									?>
								</tbody>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>No.Telp</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
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
					<input type="hidden" id="kode_supplier">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">

		$(function () {
			$("#data_form").submit( function() { 
				var id= $('#id').val(); 
				if(id!=""){
					var url ="<?php echo base_url() . 'supplier/pendaftaran_supplier/simpan_edit'; ?>";
				}else{
					var url = "<?php echo base_url() . 'supplier/pendaftaran_supplier/simpan_tambah'; ?>";
				}

				$.ajax( {  
					type :"post", 
					url:url,
					cache :false,  
					data :$(this).serialize(),
					dataType: 'Json',
					beforeSend:function(){
						$(".tunggu").show();  
					},
					success : function(data) { 
						$('#id').val(''); 
						if (data.response == 'sukses') {
							$(".tunggu").hide();   
							$(".alert_berhasil").show();   
							window.location="<?php echo base_url('supplier/pendaftaran_supplier/tambah');?>"; 
						}else{
							alert('Gagal Menyimpan data');
						}
					},  
					error : function() {  
						alert("Data gagal dimasukkan.");  
					}  
				});
				return false;                          
			});   

		});


		$(".ngeload").click(function(){
			if(parseInt($(".pagenum").val()) <= parseInt($(".rowcount").val())) {
				var pagenum = parseInt($(".pagenum").val()) + 1;
				$(".pagenum").val(pagenum);
				load_table(pagenum);
			}
		})


		function load_table(page){
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'pendaftaran_supplier/get_daftar_supplier' ?>",
				data: ({  page:$(".pagenum").val()}),
				beforeSend: function(){
					$(".tunggu").show();  
				},
				success: function(msg)
				{
					$(".tunggu").hide();
					$("#scroll_data").append(msg);

				}
			});
		}

		function actDelete(key) {
			$('#modal-hapus').modal('show');
			$('#kode_supplier').val(key);
		}
		function hapus_data() {
			var kode_supplier=$('#kode_supplier').val();
			$.ajax({
				url: '<?php echo base_url('supplier/pendaftaran_supplier/hapus_supplier'); ?>',
				type: 'post',
				data:{kode_supplier:kode_supplier},
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){
					$(".tunggu").hide();
					$('#modal-hapus').modal('hide');
					window.location.reload();
				}
			});
		}


		function actEdit(Object) {
			var id = Object;
			var url = '<?php echo base_url().'pendaftaran_supplier/get_edit'; ?>';
			$.ajax({
				type: "POST",
				url: url,
				data: {
					id: id
				},
				dataType:'json',
				success: function(msg) {
					$('#id').val(msg.id);
					$('#kode_supplier').val(msg.kode_supplier);
					$('#kode_supplier').attr('readonly', true);
					$('#nama_pic').val(msg.nama_pic);
					$('#nama_supplier').val(msg.nama_supplier);
					$('#telp_pic').val(msg.telp_pic);
					$('#telp_supplier').val(msg.telp_supplier);
					$('#alamat_supplier').val(msg.alamat_supplier);
					$('#status_supplier').val(msg.status_supplier);
					$('#btn_simpan').html("Edit");
				},
			});
		}

		function cek_kode(){
			kode_supplier = $('#kode_supplier').val();
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'supplier/pendaftaran_supplier/cek_kode_promo' ?>",  
				data :{ kode_supplier:kode_supplier},
				dataType: 'Json',
				success : function(data) { 
					if (data.peringatan == 'kosong') {

					}else{
						alert('Kode Sudah Ada, Silahkan Masukkan Kode Yang Lain');
						$('#kode_supplier').val('');
					}
				},  
				error : function() {
					alert("Data gagal dimasukkan.");  
				}  
			});  

		} 
	</script>