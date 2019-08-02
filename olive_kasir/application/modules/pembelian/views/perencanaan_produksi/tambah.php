<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Perencanaan Produksi Bulanan</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Perencanaan Produksi Bulanan </h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Tambah Perencanaan Produksi Bulanan </span>
					<a href="<?php echo base_url('pembelian/perencanaan_produksi/tambah'); ?>" class="btn btn-success btn-no-radius"><i class="fa fa-plus"></i> Tambah Perencanaan Produksi Bulanan</a>
					<a href="<?php echo base_url('pembelian/perencanaan_produksi/daftar'); ?>" class="btn btn-primary btn-no-radius"><i class="fa fa-list"></i> Data Perencanaan Produksi Bulanan</a>
				</div>
				<?php
				$get_setting=$this->db->get('setting');
				$hasil_setting=$get_setting->row();
				$kode_unit_jabung=@$hasil_setting->kode_unit;
				?>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-1">
								<h5 >Kode</h5>
							</div>
							<div class="col-md-5">
								<input type="text" class="form-control" kode='kode_perencanaan' id="kode_perencanaan" value="<?php echo 'PPRO_'.date('ymdHis');?>" readonly>
								<input type="hidden" id="kode_unit_jabung" value="<?php echo $kode_unit_jabung;?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<h5 >Bulan</h5>
							</div>
							<div class="col-md-5">
								<select name="bulan" id="bulan" class="form-control perencanaan">
									<option value="">- Pilih Bulan --</option>	
									<option value="1">Januari</option>	
									<option value="2">Februari</option>	
									<option value="3">Maret</option>	
									<option value="4">April</option>	
									<option value="5">Mei</option>	
									<option value="6">Juni</option>	
									<option value="7">Juli</option>	
									<option value="8">Agustus</option>	
									<option value="9">September</option>	
									<option value="10">Oktober</option>	
									<option value="11">November</option>	
									<option value="12">Desember</option>	
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<h5 >Tahun</h5>
							</div>
							<div class="col-md-5">
								<select name="tahun" id="tahun" class="form-control perencanaan">
									<option value="">- Pilih Tahun --</option>
									<?php 
									$tahun_skrg = date('Y');
									$tahun_then = date('Y', strtotime('+5 year', strtotime($tahun_skrg)));
									for ($i=$tahun_skrg; $i <= $tahun_then ; $i++) { ?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-1">
								<button onclick="lock_perencanaan()" class="btn_lock btn btn-info btn-no-radius btn-md">LOCK</button>
								<button onclick="unlock_perencanaan()" class="btn_cancel btn btn-danger btn-no-radius btn-md">CANCEL</button>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						<hr><br>
						<div class="row">
							<div class="col-md-3">
								<h5>Nama Produk</h5>
							</div>
							<div class="col-md-2">
								<h5>QTY</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<select name="kode_produk" id="kode_produk" class="form-control opsi_perencanaan select2" >
									<option value="">-- Pilih Produk --</option>
									<?php
									$get_produk=$this->db_master->get_where('master_produk',array('status' =>'1','kode_unit_jabung' =>$kode_unit_jabung));
									$hasil_produk=$get_produk->result();
									foreach ($hasil_produk as $produk) {
										?>
										<option value="<?php echo $produk->kode_produk;?>"><?php echo $produk->nama_produk;?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="col-md-2">
								<input type="number" onkeyup="cek_qty()" name="qty" id="qty" placeholder="QTY" class="form-control opsi_perencanaan">
								<input type="hidden" id="id_opsi">
							</div>
							<div class="col-md-2">
								<button onclick="add_item()" class="btn_add btn btn-success btn-no-radius btn-md opsi_perencanaan"><i class="fa fa-plus"></i> Tambah</button>
								<button onclick="update_item()" class="btn_update btn btn-success btn-no-radius btn-md opsi_perencanaan"><i class="fa fa-save"></i> Update</button>
							</div>
						</div>
					</div>
					<div class="col-md-12" style="margin-top: 20px;">
						<table id="" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>QTY</th>
									<th>Action</th>
								</tr>
							</thead>

							<tbody id="data_opsi_perencanaan">

							</tbody>
						</table>
					</div>
					<div class="col-md-12">
						<button onclick="confirm_simpan_perencanaan()" class="opsi_perencanaan btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> SIMPAN</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-------------------------------------------------- Modal ---------------------------------------------->
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
				<button type="button" onclick="hapus_data()" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus Data</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="simpan_perencanaan()" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
<!-------------------------------------------------- Modal ---------------------------------------------->


<script type="text/javascript">
	unlock_perencanaan();
	$('.btn_cancel').hide();
	$('.btn_update').hide();
	function lock_perencanaan(){
		var bulan=$('#bulan').val();
		var tahun=$('#tahun').val();
		if(bulan=='' || tahun==''){
			alert("Lengkapi Form ...!");
		}else{
			$('.perencanaan').attr('disabled',true);
			$('.opsi_perencanaan').attr('disabled',false);
			$('.btn_lock').hide();
			$('.btn_cancel').show();
		}
		
	}
	function unlock_perencanaan(){
		$('.perencanaan').attr('disabled',false);
		$('.opsi_perencanaan').attr('disabled',true);
		$('.btn_lock').show();
		$('.btn_cancel').hide();

		var kode_perencanaan=$('#kode_perencanaan').val();
		$.ajax({
			url: '<?php echo base_url('pembelian/perencanaan_produksi/hapus_opsi_perencanaan_all'); ?>',
			type: 'post',
			data:{kode_perencanaan:kode_perencanaan},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				load_opsi_perencanaan();
			}
		});
	}
	function cek_qty(){
		var qty=$('#qty').val();
		
		if(qty=='' || parseInt(qty)==''){
			alert("QTY Salah ...!");
			$('#qty').val('');
		}
		
	}
	function load_opsi_perencanaan(){
		var kode_perencanaan=$('#kode_perencanaan').val();
		$('#data_opsi_perencanaan').load("<?php echo base_url().'pembelian/perencanaan_produksi/data_opsi_perencanaan/'?>"+kode_perencanaan);
	}
	function add_item() {
		var kode_perencanaan=$('#kode_perencanaan').val();
		var kode_produk=$('#kode_produk').val();
		var qty=$('#qty').val();
		if(kode_produk=='' || qty==''){
			alert('Lengkapi Form ..!');
		}else{
			$.ajax({
				url: '<?php echo base_url('pembelian/perencanaan_produksi/simpan_opsi_perencanaan'); ?>',
				type: 'post',
				data:{kode_perencanaan:kode_perencanaan,kode_produk:kode_produk,qty:qty},
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){
					$(".tunggu").hide();
					load_opsi_perencanaan();
					$('#kode_produk').val('').trigger('change');
					$('#qty').val('');
				}
			});
		}
		
	}
	function actEdit(id) {
		var id=id;
		$.ajax({
			url: '<?php echo base_url('pembelian/perencanaan_produksi/get_opsi_perencanaan'); ?>',
			type: 'post',
			data:{id:id},
			dataType:'json',
			beforeSend:function(){
			},
			success: function(hasil){
				$('#id_opsi').val(hasil.id_temp);
				$('#kode_produk').val(hasil.kode_produk).trigger('change');
				$('#qty').val(hasil.qty);
				$('.btn_update').show();
				$('.btn_add').hide();
			}
		});
	}
	function update_item() {
		var kode_produk=$('#kode_produk').val();
		var qty=$('#qty').val();
		var id_temp=$('#id_opsi').val();
		if(kode_produk=='' || qty==''){
			alert('Lengkapi Form ..!');
		}else{
			$.ajax({
				url: '<?php echo base_url('pembelian/perencanaan_produksi/update_opsi_perencanaan'); ?>',
				type: 'post',
				data:{id_temp:id_temp,kode_produk:kode_produk,qty:qty},
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(hasil){
					$(".tunggu").hide();
					load_opsi_perencanaan();
					$('#kode_produk').val('').trigger('change');
					$('#qty').val('');
					$('#id_opsi').val('');
					$('.btn_update').hide();
					$('.btn_add').show();
				}
			});
		}
	}
	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id_temp').val(key);
	}
	function hapus_data() {
		var id_temp=$('#id_temp').val();
		$.ajax({
			url: '<?php echo base_url('pembelian/perencanaan_produksi/hapus_opsi_perencanaan'); ?>',
			type: 'post',
			data:{id_temp:id_temp},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				load_opsi_perencanaan();
			}
		});
	}
	function confirm_simpan_perencanaan(){
		var jml_opsi=$('#jml_opsi').val();
		if(parseInt(jml_opsi)=='1' || jml_opsi==null){
			alert('Silahkan Tambah Bahan Baku PO ..!');
		}else{
			$('#modal-konfirmasi').modal('show');
		}
		
	}
	function simpan_perencanaan() {
		var kode_unit_jabung=$('#kode_unit_jabung').val();
		var kode_perencanaan=$('#kode_perencanaan').val();
		var bulan=$('#bulan').val();
		var tahun=$('#tahun').val();
		var kode_produk=$('#kode_produk').val();
		var qty=$('#qty').val();

		$.ajax({
			url: '<?php echo base_url('pembelian/perencanaan_produksi/simpan_perencanaan'); ?>',
			type: 'post',
			data:{kode_unit_jabung:kode_unit_jabung,kode_perencanaan:kode_perencanaan,kode_produk:kode_produk,qty:qty,bulan:bulan,tahun:tahun},
			beforeSend:function(){
				$('#modal-konfirmasi').modal('hide');
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('pembelian/perencanaan_produksi/daftar');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
</script>