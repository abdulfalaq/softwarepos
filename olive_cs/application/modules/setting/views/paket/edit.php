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
					<span class="pull-left" style="font-size: 24px">Edit Paket </span>
					<a href="<?php echo base_url('setting/paket/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Paket</a>
					<a href="<?php echo base_url('setting/paket/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Paket</a>
				</div>
				<div class="panel-body">
					<form id="form" action="" method="post">
						<div class="box-body">
							<div class="notif_nota" ></div>
							<label><h3>Edit Paket</h3></label>
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
								<div class="form-group col-md-6">
									<label>Jenis Item</label>
									<select class="form-control"  name="jenis_produk" id="jenis_produk" required="">
										<option value="">Pilih Jenis Item</option>
										<option value="treatment">Treatment</option>
										<option value="produk">Produk</option>
										<option value="mix">Mix</option>
									</select> 

								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="gedhi">HPP</label>
										<input type="text" class="form-control" readonly=""  placeholder="HPP" value="<?php echo $get_gudang->hpp ?>" name="hpp" id="hpp"  readonly="true"/>
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
								<div class="form-group col-md-12">
									<div onclick="lock_temp()" id="lock_temp"  class="btn btn-warning pull-right">Lock</div>
									<button type="submit" id="Cancel" onclick="unlock_temp()" class="btn btn-primary pull-right" >Cancel</button>
								</div>
							</div>
						</div>
						<div  id="input2">
							<hr style="width:100%;border-color:#26a69a"><br>
							<div class="container" style="width: 100%">
								<div class="col-md-12 row">
									<div class="col-md-2" id="jenis_kategori" >
										<label>Jenis</label>
										<select class="form-control" name="jenis"  id="jenis" >
											<option value="" >-- Pilih Jenis --</option>
											<option value="treatment">Treatment</option>
											<option value="produk">Produk</option>
										</select>
									</div>
									<div class="col-md-2" id="dropdown_treatment">
										<label>Treatment</label>
										<select id="treatment" name="treatment" style="width: 100%" class="form-control "> 
											<option value="" selected="">Pilih Treatment</option>
											<?php 
											$ambil_data = $this->db_olive->get('master_perawatan');
											$hasil_ambil_data = $ambil_data->result();
											foreach ($hasil_ambil_data as $key => $value) {
												?>
												<option value="<?php echo $value->kode_perawatan ;?>"><?php echo $value->nama_perawatan ;?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-md-2" id="dropdown_produk">
										<label>Produk</label>
										<select id="produk" name="produk" style="width: 100%" class="form-control" >
											<option value="" selected="">Pilih Produk</option>
											<?php 
											$ambil_data = $this->db_olive->get('master_produk');
											$hasil_ambil_data = $ambil_data->result();
											foreach ($hasil_ambil_data as $key => $value) {
												?>
												<option value="<?php echo $value->kode_produk ;?>"><?php echo $value->nama_produk ;?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-md-2">
										<label>QTY</label>
										<input type="number" class="form-control" placeholder="Jumlah" name="qty" id="qty"/>
										<input type="hidden" name="id_item" id="id_item" />
									</div>
									<div class="col-md-2" id="div_satuan">
										<label>Satuan</label>
										<input readonly="" type="text" class="form-control" placeholder="Satuan" name="satuan_text" id="satuan_text"/>
										<input type="hidden" readonly="true" class="form-control" placeholder="Satuan" name="kode_satuan" id="kode_satuan"/>
									</div>
									<div class="col-md-2" id="div_hpp">
										<label>HPP</label>
										<input readonly="" type="text" class="form-control" placeholder="Hpp" name="hpp_total" id="hpp_total"/>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<a onclick="add()" id="add" class="btn btn-primary" style="margin-top: 25px;">Add</a>
											<a onclick="update()" id="update" class="btn btn-primary" style="margin-top: 25px;">Update</a>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<a onclick="cancel()" id="Cancel2" class="btn btn-primary" style="margin-top: 25px;">Cancel</a>
										</div>
									</div>
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
												<th>Action</th>
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
												<th><?= $value->qty ?></th>
												<th><?= $value->hpp ?></th>
												<th>
													<a onclick="actEdit('<?php echo $value->id ?>')" style="background-color: #f0ad4e;color:white" class="btn btn-no-radius"><i class="fa fa-pencil"></i></a>
													<a onclick="actDelete('<?php echo $value->id ?>')" style="background-color: #c9302c;color:white" class="btn btn-no-radius"><li class="fa fa-remove"></li></a>
												</th>
											</tr>
											<?php } ?>
										</tbody>
										<tfoot>

										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<div id="tombol" style="float: right; margin-top: 20px">
							<div class="col-md-12">
								<a class="btn btn-lg btn-info pull-right opsi_stok_out"  id="simpang" onclick="update_besar()"><i class="fa fa-send"></i> Update</a>
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
	function update_besar(){
		var status = $('#status').val();
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/paket/update_besar' ?>",  
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
	$('#jenis').change(function(){
		pilihan1 = $(this).val();
		if(pilihan1 =="treatment") {
			$("#dropdown_treatment").show();
			$("#div_satuan").hide();
			$("#dropdown_produk").hide();
		}else if(pilihan1 =="produk"){
			$("#dropdown_treatment").hide();
			$("#dropdown_produk").show();
			$("#div_satuan").show();
		}else{
			$("#dropdown_treatment").hide();
			$("#dropdown_produk").hide();
		}
	});

	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id').val(key);
	}
	function hapus_data() {
		var id = $('#id').val();
		$.ajax({
			url: '<?php echo base_url('setting/paket/hapus_data_opsi'); ?>',
			type: 'post',
			data:{id:id},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				load_tabel(kode_paket); 
			}
		});
	}

	function actEdit(id) {
		var id = id; 
		jenis_produk = $('#jenis_produk').val();
		var url = "<?php echo base_url().'setting/paket/get_opsi_paket'; ?>";
		$.ajax({
			type: 'POST',
			url: url,
			dataType: 'json',
			data: {id:id},
			success: function(pembelian){
				$("#jenis").val(pembelian.jenis_produk);
				$('#jenis').attr('disabled',true);
				$("#qty").val(pembelian.qty);
				$("#id_item").val(pembelian.id);
				$("#satuan_text").val(pembelian.alias);
				$("#kode_satuan").val(pembelian.kode_satuan);
				$("#hpp_total").val(pembelian.hpp);

				if(pembelian.jenis_produk == 'treatment')
				{	
					$("#jenis").show();
					$('#treatment').attr('disabled',true);
					$("#treatment").show();
					$("#produk").hide();
					$("#dropdown_produk").hide();
					$("#dropdown_treatment").show();
					$("#treatment").val(pembelian.kode_treatment);
				}else if(pembelian.jenis_produk == 'produk')
				{
					$('#produk').attr('disabled',true);
					$("#jenis").show();
					$("#produk").show();
					$("#dropdown_produk").show();
					$("#treatment").hide();
					$("#dropdown_treatment").hide();
					$("#produk").val(pembelian.kode_produk);
				}else{
					$("#jenis_kategori").hide();
				}

				$("#add").hide();
				$("#update").show();	
			}

		});
	}

	function lock_temp(){
		kode_paket = $('#kode_paket').val();
		nama_paket = $('#nama_paket').val();
		harga_jual = $('#harga_jual').val();
		jenis_produk = $('#jenis_produk').val();
		status = $('#status').val();
		if(kode_paket=='' || nama_paket=='' || harga_jual=="" || jenis_produk == "" || status == ""){
			alert("Silahkan Lengkapi Form");
		}else{
			$('#modal_simpan').modal('show');
		}
	}

	$(document).ready(function(){
		$('#input2').hide()
		$('#list_transaksi_pembelian').hide();
		$('#Cancel').hide();
		$('#Cancel2').hide();
		$('#update').hide();


		$('#save_treatment').click(function(){ 
			var pilih_jenis = $('#jenis_produk').val()

			$('#kode_paket').attr('readonly',true);
			$('#nama_paket').attr('readonly',true);
			$('#harga_jual').attr('readonly',true);
			$('#harga_promo').attr('readonly',true);
			$('#jenis_produk').attr('disabled',true);
			$('#status').attr('disabled',true);

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

	function jenis_dropdown(){
		var jenis_produk = $("#jenis_produk").val();
		if(jenis_produk == 'treatment')
		{
			$("#dropdown_treatment").show();
			$("#dropdown_produk").hide();
			$("#div_satuan").hide();
			$("#div_hpp").show();
			$("#satuan").val('');
			$("#hpp").val('');
		}else if(jenis_produk == 'produk')
		{ 
			$("#dropdown_treatment").hide();
			$("#dropdown_produk").show();
			$("#div_satuan").show();
			$("#div_hpp").show();
			$("#satuan").val('');
			$("#hpp").val('');
		}
		else{
			$("#dropdown_treatment").hide();
			$("#dropdown_produk").hide();
			$("#div_satuan").show();
			$("#div_hpp").show();
			$("#satuan").val('');
			$("#hpp").val('');
		}

	};

	function add() {  
		jenis_produk = $('#jenis_produk').val();
		hpp_total = $('#hpp_total').val();
		qty = $('#qty').val();
		if (hpp_total!='' && qty!='') {
			$.ajax( {  
				type :"post",  
				url : "<?php echo base_url() . 'setting/paket/add_opsi' ?>",  
				cache :false,  
				data :$('#form').serialize()+ "&jenis_produk=" + jenis_produk,
				dataType: 'Json',
				beforeSend:function(){
					$(".tunggu").show();   
				},
				success : function(ambil) { 
					if (ambil.response == 'sukses') {
						$(".tunggu").hide();       
						load_tabel(kode_paket); 
						$('#jenis').val('');  
						$('#treatment').val('');
						$('#produk').val('');
						$('#satuan').val('');
						$('#qty').val('');
						$('#hpp_total').val('');
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
		}else{
			alert('Lengkapi Form !!!');
		}             

	}



	function load_tabel(obj){
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/paket/load_tabel_opsi' ?>",  
			data:{kode_paket:obj},
			success : function(data) { 
				$("#load_tabel").html(data);   
			} 
		});
		return false;
	}


	$("#produk").on('change',function(){
		var produk = $('#produk').val();
		var keterangan = "<?php echo base_url().'setting/paket/cari_produk'?>";
		$.ajax({
			type: "POST",
			url: keterangan,
			dataType: 'json',
			data: {produk:produk},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg)
			{
				$('#hpp_total').val('');
				$('#qty').val('');
				$(".tunggu").hide();
				$('#satuan').val(msg.kode);
				$('#satuan_text').val(msg.alias);

				$('#hpp_total').val('');
			}
		});
		return false;
	});

	$("#treatment").on('change',function(){
		var treatment = $('#treatment').val();
		var keterangan = "<?php echo base_url().'setting/paket/cari_treatment'?>";
		$.ajax({
			type: "POST",
			url: keterangan,
			dataType: 'json',
			data: {treatment:treatment},
			beforeSend:function(){
				$(".tunggu").show();  
			},
			success: function(msg)
			{
				$('#hpp_total').val('');
				$('#qty').val('');
				$(".tunggu").hide();

				$('#hpp_total').val('');
			}
		});
		return false;
	});

	$("#qty").keyup(function(){

		var qty = $('#qty').val();
		var milih = $('#jenis_produk').val();
		var jenis = $('#jenis').val();

		if(parseInt(qty) <= 0){
			alert("Jumlah Salah ..!");
			$('#qty').val('');

		}else{

			if(milih =='treatment'){

				var treatment = $('#treatment').val();
				var keterangan = "<?php echo base_url().'setting/paket/cari_treatment'?>";
				$.ajax({
					type: "POST",
					url: keterangan,
					dataType: 'json',
					data: {treatment:treatment},

					success: function(msg)
					{
						$(".tunggu").hide();
						$('#satuan_text').val(msg.alias);
						$('#kode_satuan').val(msg.kode);
						$('#hpp_total').val(msg.hpp);
					}
				});	

			}else if(milih =='produk'){
				var produk = $('#produk').val();
				var keterangan = "<?php echo base_url().'setting/paket/cari_produk'?>";
				$.ajax({
					type: "POST",
					url: keterangan,
					dataType: 'json',
					data: {produk:produk},

					success: function(msg)
					{
						$(".tunggu").hide();
						$('#satuan_text').val(msg.alias);
						$('#kode_satuan').val(msg.kode);
						$('#hpp_total').val(msg.hpp);
					}
				});	
			}else{
				if (jenis =='treatment') {
					var treatment = $('#treatment').val();
					var keterangan = "<?php echo base_url().'setting/paket/cari_treatment'?>";
					$.ajax({
						type: "POST",
						url: keterangan,
						dataType: 'json',
						data: {treatment:treatment},

						success: function(msg)
						{
							$(".tunggu").hide();
							$('#satuan_text').val(msg.alias);
							$('#kode_satuan').val(msg.kode);
							$('#hpp_total').val(msg.hpp);
						}
					});	
				}else if(jenis =='produk'){
					var produk = $('#produk').val();
					var keterangan = "<?php echo base_url().'setting/paket/cari_produk'?>";
					$.ajax({
						type: "POST",
						url: keterangan,
						dataType: 'json',
						data: {produk:produk},

						success: function(msg)
						{
							$(".tunggu").hide();
							$('#satuan_text').val(msg.alias);
							$('#kode_satuan').val(msg.kode);
							$('#hpp_total').val(msg.hpp);
						}
					});	
				}

			}
		}

	});
	function update() {  
		var kode_paket = $('#kode_paket').val();
		var treatment = $('#treatment').val();
		var produk = $('#produk').val();
		var jenis_produk = $('#jenis_produk').val();
		var jenis = $('#jenis').val();
		var kode_satuan = $('#kode_satuan').val();
		var qty = $('#qty').val();
		var hpp_total = $('#hpp_total').val();
		var id_item = $('#id_item').val();

		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/paket/update_opsi' ?>",  
			cache :false,  
			data :{kode_paket:kode_paket,treatment:treatment,produk:produk,qty:qty,hpp_total:hpp_total,jenis:jenis,kode_satuan:kode_satuan,id_item:id_item,jenis_produk:jenis_produk},
			dataType: 'Json',
			beforeSend:function(){
				$(".tunggu").show();   
			},
			success : function(data) { 
				if (data.response == 'sukses') {
					$(".tunggu").hide();       
					load_tabel(kode_paket); 
					$('#jenis').val('');  
					$('#treatment').val('');
					$('#produk').val('');
					$('#satuan').val('');
					$('#qty').val('');
					$('#hpp_total').val('');
					$("#add").show();
					$("#update").hide();
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
	};
	function cancel(key) {
		$('#Cancel2').hide();
		$('#update').hide();
		$('#add').show();

		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'setting/paket/cancel' ?>",  
			data :{kode_paket:key},
			dataType: 'Json',
			success : function(){
				$('#jenis_produk').val('');
				$('#treatment').val('');
				$('#produk').val('');
				$('#satuan').val('');
				$('#qty').val('');
				$('#hpp').val('');
			}
		});
		return false;   
	};
	function get_nominal_harga_paket(){
		var hpp = $('#harga_jual').val();
		if(parseInt(hpp) < 0){
			alert("Harga Jual Salah");
			$('#harga_jual').val('');
			$(".rp_harga_paket").html("Rp. 0");
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'setting/paket/get_hpp' ?>",
				data: {
					hpp: hpp
				},

				success: function(msg)
				{
					$(".rp_harga_paket").html(msg);
				}
			});
		}
	}

</script>
