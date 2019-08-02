
<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">PO Supplier</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>PO Supplier </h1>

	<?php $this->load->view('menu_master'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Validasi PO Supplier </span>
					<br><br>
				</div>
				<?php
				$user = $this->session->userdata('astrosession');
				?>
				<?php
				$kode_po=paramDecrypt($this->uri->segment(4));
				$this->db->where('kan_suol.transaksi_po.kode_po',$kode_po);
				$this->db->from('kan_suol.transaksi_po');
				$this->db->join('kan_master.master_user', 'kan_suol.transaksi_po.kode_petugas = kan_master.master_user.kode_user ');
				$get_po = $this->db->get();
				$hasil_po=$get_po->row();
				?>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-3">
							<label>Kode Transaksi</label>
							<input type="text" name="kode_transaksi"  id="kode_transaksi" value="<?php echo @$hasil_po->kode_po;;?>" class="form-control transaksi_po"  readonly="">

						</div>
						<div class="col-md-2">
							<label>Tanggal Transaksi</label>
							<input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo @$hasil_po->tanggal_input;;?>" class="form-control transaksi_po" readonly="">
						</div>
						<div class="col-md-2">
							<label>Operator</label>
							<input type="text" name="operator" id="operator" value="<?php echo @$hasil_po->nama_user; ?>" class="form-control transaksi_po" readonly="">
							<input type="hidden" name="kode_petugas" id="kode_petugas" value="" class="form-control transaksi_po" readonly="">
						</div>
						<div class="col-md-2">
							<label>Supplier</label>
							<select class="form-control transaksi_po" name="kode_supplier" id="kode_supplier" disabled="">
								<option value="">- Pilih Supplier -</option>
								<?php
								$get_supplier=$this->db_master->get('master_supplier');
								$hasil_supplier=$get_supplier->result();
								foreach ($hasil_supplier as $supplier) {
									?>
									<option <?php if(@$hasil_po->kode_supplier==$supplier->kode_supplier){ echo "selected";} ?> value="<?php echo $supplier->kode_supplier?>"><?php echo $supplier->nama_supplier?></option>
									<?php
								}
								?>
							</select>
						</div>
						<div class="col-md-2">
							<label>Tanggal Barang Datang</label>
							<input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo @$hasil_po->tanggal_barang_datang;?>" class="form-control transaksi_po" readonly="">
						</div>
					</div>
					<hr><br>
					<div class="row opsi_po">
						<div class="col-md-3">
							<label>Bahan Baku</label>
							<select class="form-control" name="kode_bahan_baku" id="kode_bahan_baku" disabled="">
								<option>- Pilih Bahan -</option>
							</select>
						</div>
						<div class="col-md-2">
							<label>QTY</label>
							<input type="number" name="qty" id="qty" onkeyup="cek_qty()" class="form-control">
						</div>
						<div class="col-md-2">
							<label>Kuota Pengadaan</label>
							<input type="text" readonly="" name="kuota_pengadaan" id="kuota_pengadaan" class="form-control">
						</div>
						<div class="col-md-2">
							<label>Satuan</label>
							<input type="text" readonly="" name="satuan_pembelian" id="satuan_pembelian" class="form-control">
							<input type="hidden" name="kode_satuan_pembelian" id="kode_satuan_pembelian" class="form-control">
							<input type="hidden" name="harga_satuan" id="harga_satuan" class="form-control">
							<input type="hidden" name="id_opsi" id="id_opsi" class="form-control">
						</div>
						
						<div class="col-md-2">
							<button class="btn btn-primary btn_add" onclick="add_item()" style="margin-top: 25px;"><i class="fa fa-plus"></i> ADD</button>
							<button class="btn btn-primary btn_update" onclick="update_item()" style="margin-top: 25px;"><i class="fa fa-pencil"></i> Update</button>
						</div>
					</div>
					<br>
					<table id="" class="table table-striped table-bordered ">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th>Nama Bahan</th>
								<th>QTY</th>
								<th width="15%">Action</th>
							</tr>
						</thead>

						<tbody id="data_temp">
							<?php
							$kode_po=paramDecrypt($this->uri->segment(4));
							$this->db->select('kan_suol.opsi_transaksi_po.id, kan_suol.opsi_transaksi_po.qty');
							$this->db->select('kan_master.master_bahan_baku.nama_bahan_baku, kan_master.master_satuan.nama');

							$this->db->where('kan_suol.opsi_transaksi_po.kode_po', $kode_po);
							$this->db->from('kan_suol.opsi_transaksi_po');
							$this->db->join('kan_master.master_bahan_baku', 'kan_suol.opsi_transaksi_po.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
							$this->db->join('kan_master.master_satuan', 'kan_master.master_bahan_baku.kode_satuan_pembelian = kan_master.master_satuan.kode ');
							$get_opsi_po = $this->db->get();
							$hasil_opsi_po=$get_opsi_po->result();
							$no=1;
							foreach ($hasil_opsi_po as $opsi) {
								?>
								<tr>
									<td><?php echo $no++;?></td>
									<td><?php echo @$opsi->nama_bahan_baku;?></td>
									<td><?php echo @$opsi->qty.' '.@$opsi->nama;?></td>
									<td><?php echo @get_edit_delete($opsi->id);?></td>     
								</tr>  
								<?php
							}
							?>
						</tbody>
					</table>
					<br>
					<br>
					<button class="btn btn-lg btn-success pull-right " onclick="confirm_simpan_po()">Simpan</button>
					<button class="btn btn-lg btn-danger pull-right " onclick="confirm_tolak_po()">Tolak</button>
				</div>
			</div>
		</div>
	</div> <!-- //row -->
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
				<button type="button" onclick="simpan_po()" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-tolak" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi Tolak</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menolak data ini?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" onclick="simpan_tolak()" class="btn btn-success"><i class="fa fa-save"></i> Tolak</button>
			</div>
		</div>
	</div>
</div>
<!-------------------------------------------------- Modal ---------------------------------------------->


<script type="text/javascript">
	$(".opsi_po").hide();
	$(".btn_update").hide();
	lock_transaksi();
	function lock_transaksi(){
		var kode_supplier=$("#kode_supplier").val();
		var kode_transaksi=$("#kode_transaksi").val();
		var kode_supplier=$('#kode_supplier').val();
		$.ajax({
			url: '<?php echo base_url('pembelian/po/get_bahan_baku'); ?>',
			type: 'post',
			data:{kode_supplier:kode_supplier},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#kode_bahan_baku').html(hasil);
			}
		});
		
	}
	
	function get_satuan(){
		var kode_bahan_baku=$("#kode_bahan_baku").val();
		$.ajax({
			url: '<?php echo base_url('pembelian/po/get_satuan'); ?>',
			type: 'post',
			data:{kode_bahan_baku:kode_bahan_baku},
			dataType:'json',
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$("#kode_satuan_pembelian").val(hasil.kode_satuan_pembelian);
				$("#satuan_pembelian").val(hasil.nama);
				$("#kuota_pengadaan").val(hasil.total_kebutuhan);
				$("#harga_satuan").val(hasil.hpp);
			}
		});
		
	}
	function cek_qty(){
		var qty=$("#qty").val();
		var kuota_pengadaan=$("#kuota_pengadaan").val();
		if(parseInt(qty) < 0){
			alert('QTY Salah ...!');
			$("#qty").val('');
		}else if(parseInt(qty) > parseInt(kuota_pengadaan) ){
			alert('QTY Melebihi Kuota ...!');
			$("#qty").val('');
		}
		
	}
	function load_data_temp(){
		window.location.reload();
	}
	function add_item(){
		var kode_transaksi=$("#kode_transaksi").val();
		var kode_supplier=$("#kode_supplier").val();
		var kode_bahan_baku=$("#kode_bahan_baku").val();
		var qty=$("#qty").val();
		var kode_satuan_pembelian=$("#kode_satuan_pembelian").val();
		var harga_satuan=$("#harga_satuan").val();
		if(kode_bahan_baku=='' || qty=='' ){
			alert('Harap Lengkapi Form..!');
		}else{
			$.ajax({
				url: '<?php echo base_url('pembelian/po/add_item'); ?>',
				type: 'post',
				data:{kode_transaksi:kode_transaksi,kode_supplier:kode_supplier,kode_bahan_baku:kode_bahan_baku,qty:qty,kode_satuan_pembelian:kode_satuan_pembelian,harga_satuan:harga_satuan},
				dataType:'json',
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(msg){
					$(".tunggu").hide();
					if(msg.hasil=='gagal'){
						alert("Bahan Baku Telah Ditambahkan ...!");
					}else{
						$("#kode_bahan_baku").val('');
						$("#qty").val('');
						$("#kuota_pengadaan").val('');
						$("#satuan_pembelian").val('');
						$("#kode_satuan_pembelian").val('');
						$("#harga_satuan").val('');
						load_data_temp();
					}
					
				}
			});
		}
	}
	function actEdit(id) {
		var id=id;
		$.ajax({
			url: '<?php echo base_url('pembelian/po/get_opsi_po_validasi'); ?>',
			type: 'post',
			data:{id:id},
			dataType:'json',
			beforeSend:function(){
			},
			success: function(hasil){
				$('#id_opsi').val(id);
				$('#kode_bahan_baku').val(hasil.kode_bahan_baku);
				$('#qty').val(hasil.qty);
				$('#kode_satuan_pembelian').val(hasil.kode_satuan);
				$("#satuan_pembelian").val(hasil.nama);
				$("#kuota_pengadaan").val(hasil.total_kebutuhan);
				$("#harga_satuan").val(hasil.hpp);
				$(".opsi_po").show();
				$('.btn_update').show();
				$('.btn_add').hide();
			}
		});
	}
	function update_item(){
		var id=$("#id_opsi").val();
		var kode_transaksi=$("#kode_transaksi").val();
		var kode_supplier=$("#kode_supplier").val();
		var kode_bahan_baku=$("#kode_bahan_baku").val();
		var qty=$("#qty").val();
		var kode_satuan_pembelian=$("#kode_satuan_pembelian").val();
		var harga_satuan=$("#harga_satuan").val();
		if(kode_bahan_baku=='' || qty=='' ){
			alert('Harap Lengkapi Form..!');
		}else{
			$.ajax({
				url: '<?php echo base_url('pembelian/po/update_item_validasi'); ?>',
				type: 'post',
				data:{id:id,kode_transaksi:kode_transaksi,kode_supplier:kode_supplier,kode_bahan_baku:kode_bahan_baku,qty:qty,kode_satuan_pembelian:kode_satuan_pembelian,harga_satuan:harga_satuan},
				dataType:'json',
				beforeSend:function(){
					$(".tunggu").show();
				},
				success: function(msg){
					$(".tunggu").hide();
					if(msg.hasil=='gagal'){
						alert("Bahan Baku Telah Ditambahkan ...!");
					}else{
						$("#kode_bahan_baku").val('');
						$("#qty").val('');
						$("#kuota_pengadaan").val('');
						$("#satuan_pembelian").val('');
						$("#kode_satuan_pembelian").val('');
						$("#harga_satuan").val('');
						$(".opsi_po").hide();
						load_data_temp();
					}
					
				}
			});
		}
	}
	function actDelete(key) {
		$('#modal-hapus').modal('show');
		$('#id_temp').val(key);
	}
	function hapus_data() {
		var id=$('#id_temp').val();
		$.ajax({
			url: '<?php echo base_url('pembelian/po/hapus_opsi_po_validasi'); ?>',
			type: 'post',
			data:{id:id},
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$('#modal-hapus').modal('hide');
				load_data_temp();
			}
		});
	}
	function confirm_tolak_po(){
		$('#modal-tolak').modal('show');
	}
	function confirm_simpan_po(){
		$('#modal-konfirmasi').modal('show');
	}
	function simpan_po() {
		var kode_po=$('#kode_transaksi').val();
		
		$.ajax({
			url: '<?php echo base_url('pembelian/po/terima_po'); ?>',
			type: 'post',
			data:{kode_po:kode_po},
			beforeSend:function(){
				$('#modal-konfirmasi').modal('hide');
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('pembelian/po/daftar_validasi');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
	function simpan_tolak() {
		var kode_po=$('#kode_transaksi').val();
		
		$.ajax({
			url: '<?php echo base_url('pembelian/po/tolak_po'); ?>',
			type: 'post',
			data:{kode_po:kode_po},
			beforeSend:function(){
				$('#modal-konfirmasi').modal('hide');
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('pembelian/po/daftar_validasi');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
</script>