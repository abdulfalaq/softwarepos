<?php 
$kode_paket=$this->uri->segment(4);
$this->db_olive->where('kode_paket',$kode_paket);
$get_gudang = $this->db_olive->get('master_paket')->row();
?>
<!-- back button -->
<a href="<?php echo base_url('setting/paket/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('setting'); ?>">Setting</a></li>
		<li><a href="#">Paket</a></li>
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
					<span class="pull-left" style="font-size: 24px">Detail Paket </span>
					<a href="<?php echo base_url('setting/paket/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Paket</a>
					<a href="<?php echo base_url('setting/paket/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Paket</a>
				</div>
				<div class="panel-body">
					<form id="form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3>Tambah Paket</h3></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Kode Paket</label>
										<input  type="text" readonly="" value="<?php echo $get_gudang->kode_paket ?>" class="form-control" placeholder="Kode Paket"  name="kode_paket" id="kode_paket" required="" />
									</div>
								</div>
								<div class=" form-group col-md-6">
									<div class="form-group">
										<label class="gedhi">Nama Paket</label>
										<input type="text" readonly="" class="form-control" placeholder="Nama paket" value="<?php echo $get_gudang->nama_paket ?>" name="nama_paket" id="nama_paket" required=""/>
									</div>
								</div>
								<div class="">
									<div class="form-group  col-md-6">
										<label class="gedhi">Harga Jual</label>
										<div class="input-group">
											<span class="input-group-addon rp_harga_paket">Rp 0,00</span>
											<input required type="number" readonly="" class="form-control input-group" onkeyup="get_nominal_harga_paket()" name="harga_jual" id="harga_jual" value="<?php echo $get_gudang->harga_jual ?>" required="" />
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">HPP</label>
										<input type="text" class="form-control" readonly=""  placeholder="HPP" value="<?php echo format_rupiah($get_gudang->hpp) ?>" name="hpp" id="hpp_subtotal"  readonly="true"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label>Status</label>
									<select class="form-control" name="status" disabled="" id="status" required="">
										<option value="">Pilih Status</option>
										<option <?php if($get_gudang->status=='1'){echo "selected";}?> value="1">Aktif</option>
										<option <?php if($get_gudang->status=='0'){echo "selected";}?> value="0">Tidak Aktif</option>
									</select> 
								</div>
							</div>
						</div>

						<div id="list_transaksi_pembelian">
							<div class="box-body">
								<br>
								<label style="font-weight:700;font-size:14px;">
									List Komposisi Paket
								</label>
								<div id="load_tabel">
									<table id="datatable" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode</th>
												<th>Nama</th>
												<th>QTY</th>
												<th>HPP</th>
											</tr>
										</thead>
										<tbody id="tabel_temp_paket">
											<?php
											$data = $this->input->post();
											$this->db_olive->from('opsi_master_paket');

											$this->db_olive->select('opsi_master_paket.id');
											$this->db_olive->select('opsi_master_paket.kode_paket');
											$this->db_olive->select('opsi_master_paket.jenis_produk');
											$this->db_olive->select('master_produk.nama_produk');
											$this->db_olive->select('master_perawatan.nama_perawatan');
											$this->db_olive->select('opsi_master_paket.qty');
											$this->db_olive->select('opsi_master_paket.hpp');
											$this->db_olive->join('master_perawatan',' master_perawatan.kode_perawatan = opsi_master_paket.kode_treatment','left');
											$this->db_olive->join('master_produk',' master_produk.kode_produk = opsi_master_paket.kode_produk','left');
											$this->db_olive->where('opsi_master_paket.kode_paket',$get_gudang->kode_paket);
											$this->db_olive->order_by('opsi_master_paket.id','DESC');
											$get_sapi = $this->db_olive->get()->result();

											$total_hpp = 0;
											$no = 0;
											foreach ($get_sapi as $value) { ?>
											<?php 
											$no++; ?>
											<tr>
												<th><?= $no ?></th>
												<th><?= $value->kode_paket ?></th>
												<th>
													<?php if($value->jenis_produk == 'treatment'){
														echo ($value->nama_perawatan);
													}else {
														echo ($value->nama_produk);
													}
													?>
												</th>
												<th><?= ($value->qty) ?></th>
												<th><?= format_rupiah($value->hpp) ?></th>
											</tr>
											<?php } ?>
										</tbody>
										<tfoot>

										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="modal_simpan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background-color:grey">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" style="color:#fff;">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				<span style="font-weight:bold; font-size:12pt">Apakah anda yakin akan menyimpan data tersebut?</span>
				<input id="kode_supplier" type="hidden">
			</div>
			<div class="modal-footer" style="background-color:#eee">
				<button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
				<button id="save_treatment" class="btn green">Ya</button>
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
				<input type="hidden" id="id">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#simpang").hide();


	function cek_kode_paket() {
		var kode_paket = $('#kode_paket').val();
		$.ajax({
			url: '<?php echo base_url('setting/paket/cek_kode_paket'); ?>',
			type: 'post',
			data:{kode_paket:kode_paket},
			dataType:'json',
			success: function(hasil){ 
				if(hasil.respon=='gagal'){
					alert('Kode Paket Telah Dipakai !');
					$('#kode_paket').val('');
				}
			}
		});
	}
	function unlock_temp() {
		var kode_paket = $('#kode_paket').val();
		$.ajax({
			url: '<?php echo base_url('setting/paket/delete_all_temp'); ?>',
			type: 'post',
			data:{kode_paket:kode_paket},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success: function(hasil){
				window.location.reload();
			}
		});
	}
	function simpan_besar(){
		var status = $('#status').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/paket/simpan_besar' ?>",  
			cache :false,  
			data :$('#form').serialize()+"&status="+status,
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();    
					$(".alert_berhasil").show();   
					window.location="<?php echo base_url('setting/paket/daftar');?>"; 
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
	}
	

	$(document).ready(function(){
		$('#input2').hide()
		$('#list_transaksi_pembelian').show();
		$('#Cancel').hide();
		$('#Cancel2').hide();
		$('#update').hide();


		$('#save_treatment').click(function(){ 
			var pilih_jenis = $('#jenis_produk').val()

			$('#kode_paket').attr('readonly',true);
			$('#nama_paket').attr('readonly',true);
			$('#harga_jual').attr('readonly',true);
			$('#harga_promo').attr('readonly',true);
			$('#jenis_produk').attr('readonly',true);
			$('#status').attr('readonly',true);

			document.getElementById('kode_paket').readOnly = true;
			document.getElementById('nama_paket').readOnly = true;
			document.getElementById('harga_jual').readOnly = true;
			document.getElementById('status').disabled = true;
			document.getElementById('jenis_produk').disabled = true;
			$('#modal_simpan').modal('hide');
			$("#input2").show();
			$("#simpang").show();
			$('#list_transaksi_pembelian').show();
			$("#Lock").hide();

			if (pilih_jenis == 'treatment') {
				$('#jenis_produk').val('treatment');
				$('#jenis_kategori').hide();
				$('#Cancel').show();
				$('#lock_temp').hide();
				jenis_dropdown();
			}
			else if (pilih_jenis == 'produk') {
				$('#jenis_produk').val('produk');
				$('#jenis_kategori').hide();
				$('#Cancel').show();
				$('#lock_temp').hide();
				jenis_dropdown();
			}
			else if (pilih_jenis == 'mix') {
				$('#jenis_produk').val('mix');
				$('#jenis_kategori').show();
				$('#Cancel').show();
				$('#lock_temp').hide();
				jenis_dropdown();
			}
		});

		$("#dropdown_treatment").hide();
		$("#dropdown_produk").hide();

		function reloadpage(){
			location.reload()
		}

	});

	

	
	
</script>
