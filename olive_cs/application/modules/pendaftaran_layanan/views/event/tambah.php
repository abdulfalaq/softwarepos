
<!-- back button -->
<a href="<?php echo base_url('penjualan'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
		<li><a href="#">Event</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Event </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>
	<?php
	$get_setting=$this->db->get('setting');
	$hasil_setting=$get_setting->row();
	$kode_unit_jabung=@$hasil_setting->kode_unit;
	?>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Event </span>
					<a href="<?php echo base_url('penjualan/event/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Event</a>
					<a href="<?php echo base_url('penjualan/event/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Event</a>
				</div>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<label for="">Nama Event</label>
								<input type="text" id="nama_event" name="nama_event" class="form-control">
								<input type="hidden" name="kode_event" id="kode_event" value="<?php echo 'EVN_'.date('ymdHis')?>">
							</div>
							<div class="col-md-6">
								<label for="">Tanggal Event</label>
								<input type="date" id="tanggal_event" name="tanggal_event" class="form-control">
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-3">
								<h5>Produk</h5>
							</div>
							<div class="col-md-2">
								<h5>QTY</h5>
							</div>
							<div class="col-md-2">
								<h5>Satuan</h5>
							</div>
							<div class="col-md-3">
								<h5>Expire Date</h5>
							</div>
							<div class="col-md-2"> 
							</div>
						</div>
						<div id="sukses"></div>
						<div class="row">
							<div class="col-md-3">
								<input type="hidden" id="id_opsi">
								<select name="kode_produk" id="kode_produk" class="form-control select2" onchange="change_produk()">
									<option value="">-- Pilih Produk</option>
									<?php
									$this->db_master->where('kode_unit_jabung', $kode_unit_jabung);
									$get_produk=$this->db_master->get('master_produk');
									$hasil_produk=$get_produk->result();
									foreach ($hasil_produk as $produk) {
										?>
										<option value="<?php echo @$produk->kode_produk;?>"><?php echo @$produk->nama_produk;?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-md-2">
								<input type="number" name="jumlah" id="jumlah" placeholder="QTY" onkeyup="cek_qty()" class="form-control">
							</div>
							<div class="col-md-2">
								<input type="text" readonly="" id="nama_satuan" placeholder="Satuan" class="form-control">
								<input type="hidden" name="kode_satuan" id="kode_satuan">
							</div>
							<div class="col-md-3">
								<input type="date" name="tanggal_expired" id="tanggal_expired" placeholder="EXP Date" class="form-control">
							</div>
							<div class="col-md-2">
								<button onclick="add_item()" class="btn btn-info btn-no-radius btn-block btn-add"> <i class="fa fa-plus"></i> Add</button>
								<button onclick="update_item()" class="btn btn-info btn-no-radius btn-md pull-right input_transaksi btn-update"><i class="fa fa-save"></i> Update</button>
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Produk</th>
											<th>QTY</th>
											<th>Exp Date</th>
											<th style="width:10%">Action</th>
										</tr>
									</thead>
									<tbody id="opsi_temp">

									</tbody>
								</table>
							</div>
						</div><br>
						<div class="row">
							<div class="col-md-12">
								<button onclick="confrim_simpan()" class="btn btn-lg btn-no-radius btn-success pull-right"><i class="fa fa-send"></i> SIMPAN</button>
							</div>
						</div>
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
				<input type="hidden" id="id_temp">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-danger" onclick="hapus_temp()"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>

<div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" >
	<div class="modal-dialog">
		<div class="modal-content" style="border-radius: 0;">
			<div class="modal-header" style="background-color: #0c7a23;color:white;border-bottom: 4px solid #fb8302;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Confirmasi</h4>
			</div>
			<div class="modal-body">
				<h3>Apakah anda yakin ingin menyimpan data tersebut ?</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-no-radius btn-md" data-dismiss="modal">Cancel</button>
				<a class="btn btn-info btn-no-radius btn-info btn-md" onclick="simpan_transaksi()" >Yakin</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-update').hide();
	});
	
	function change_produk(){
		kode_produk = $('#kode_produk').val();
		$.ajax({
			url: '<?php echo base_url('penjualan/event/get_data_produk'); ?>',
			type: 'post',
			data:{kode_produk:kode_produk},
			dataType:'Json',
			success: function(response){
				$('#nama_satuan').val(response.nama);
				$('#kode_satuan').val(response.kode_satuan_stok);
			}
		});
	}
	function cek_qty(){
		jumlah = $('#jumlah').val();
		if (parseInt(jumlah) < 0 ) {
			alert('Pengisian QTY Salah.');
			$('#jumlah').val('');
		}
	}
	function load_temp(){
		kode_event = $('#kode_event').val();
		$('#opsi_temp').load("<?php echo base_url('penjualan/event/tabel_temp').'/';?>"+kode_event);
		
	}
	function add_item(){
		kode_event = $('#kode_event').val();
		kode_produk = $('#kode_produk').val();
		jumlah = $('#jumlah').val();
		kode_satuan = $('#kode_satuan').val();
		tanggal_expired = $('#tanggal_expired').val();
		if(kode_produk=='' || jumlah==''  || tanggal_expired==''){
			alert('Silahkan Lengkapi From !');
		}else if(parseInt(jumlah) < 0){
			alert('QTY Salah !');
		}
		else{
			$.ajax({
				url: '<?php echo base_url('penjualan/event/add_item'); ?>',
				type: 'post',
				data:{
					kode_event:kode_event,
					kode_produk:kode_produk,
					jumlah:jumlah,
					kode_satuan:kode_satuan,
					tanggal_expired:tanggal_expired
				},
				dataType:'Json',
				success: function(msg){
					if(msg.respon=='gagal'){
						$('#sukses').html("<div class='alert alert-danger'>Stok Tidak Mencukupi</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else if(msg.respon=='produk_tersedia'){
						$('#sukses').html("<div class='alert alert-warning'>Produk Telah Tersedia</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else{
						$('#kode_produk').val('').trigger('change');
						$('#jumlah').val('');
						$('#kode_satuan').val('');
						$('#tanggal_expired').val('');
						load_temp();
					}
				}
			});
		}

	}
	function actEdit(id){
		$.ajax({
			url: '<?php echo base_url('penjualan/event/get_data_temp'); ?>',
			type: 'post',
			data:{id:id},
			dataType:'json',
			success: function(response){
				$('#kode_produk').val(response.kode_produk).trigger('change');
				$('#jumlah').val(response.jumlah);
				$('#kode_satuan').val(response.kode_satuan);
				$('#tanggal_expired').val(response.tanggal_expired);
				$('#id_opsi').val(response.id_temp);
				$('.btn-add').hide();
				$('.btn-update').show();
			}
		});
	}
	function update_item(){
		kode_event = $('#kode_event').val();
		id_opsi = $('#id_opsi').val();
		kode_produk = $('#kode_produk').val();
		jumlah = $('#jumlah').val();
		kode_satuan = $('#kode_satuan').val();
		tanggal_expired = $('#tanggal_expired').val();
		if(kode_produk=='' || jumlah==''  || tanggal_expired==''){
			alert('Silahkan Lengkapi From !');
		}else if(parseInt(jumlah) < 0){
			alert('QTY Salah !');
		}
		else{
			$.ajax({
				url: '<?php echo base_url('penjualan/event/update_item'); ?>',
				type: 'post',
				data:{
					kode_event:kode_event,
					id_opsi:id_opsi,
					kode_produk:kode_produk,
					jumlah:jumlah,
					kode_satuan:kode_satuan,
					tanggal_expired:tanggal_expired
				},
				dataType:'Json',
				success: function(msg){
					if(msg.respon=='gagal'){
						$('#sukses').html("<div class='alert alert-danger'>Stok Tidak Mencukupi</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else if(msg.respon=='produk_tersedia'){
						$('#sukses').html("<div class='alert alert-warning'>Produk Telah Tersedia</div>");
						setTimeout(function(){$('#sukses').html('');},1500);  
					}else{
						$('#kode_produk').val('').trigger('change');
						$('#id_opsi').val('');
						$('#jumlah').val('');
						$('#kode_satuan').val('');
						$('#tanggal_expired').val('');
						$('.btn-add').show();
						$('.btn-update').hide();
						load_temp();
					}
				}
			});
		}

	}
	function actDelete(id){
		$('#modal-hapus').modal('show');
		$('#id_temp').val(id);
	}

	function hapus_temp(){
		var id=$('#id_temp').val();
		$.ajax({
			url: '<?php echo base_url('penjualan/event/delete_temp'); ?>',
			type: 'post',
			data:{id:id},

			success: function(response){
				$('#modal-hapus').modal('hide');
				load_temp();

			}
		});
	}
	function confrim_simpan(){
		nama_event 		= $('#nama_event').val();
		tanggal_event 	= $('#tanggal_event').val();
		
		if(nama_event == '' ||  tanggal_event==''){
			alert('Silahkan Lengkapi Form !');
		}else{
			$('#modal-confirm').modal('show');
		}
	}
	function simpan_transaksi(){
		kode_event = $('#kode_event').val();
		nama_event = $('#nama_event').val();
		tanggal_event = $('#tanggal_event').val();
		

		$.ajax({
			url: '<?php echo base_url('penjualan/event/simpan_transaksi'); ?>',
			type: 'post',
			data:{
				kode_event:kode_event,
				nama_event:nama_event,
				tanggal_event:tanggal_event
			},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();
				$("#modal-confirm").modal('hide');
			},
			success: function(msg){
				$(".tunggu").hide();
				if(msg.respon=='produk_kosong'){
					$('#sukses').html("<div class='alert alert-warning'> Produk Event Kosong</div>");
					setTimeout(function(){$('#sukses').html('');},1500);  
				}else{
					$(".alert_berhasil").show();

					setTimeout(function(){
						window.location="<?php echo base_url('penjualan/event/tambah');?>";
					},1500);
				}
			}
		});

	}
</script>