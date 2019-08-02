<!-- back button -->
<a href="<?php echo base_url('pembelian'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
		<li><a href="#">Pengadaan Bahan Baku</a></li>
		<li></li>
	</ol>
</div>
<div class="clearfix"></div>
<div class="container">
	<h1>Pengadaan Bahan Baku</h1>
	<?php $this->load->view('menu_master'); ?>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-left">
					<span class="" style="font-size: 24px">Pengadaan Bahan Baku</span>
				</div>
				<?php
				$get_setting=$this->db->get('setting');
				$hasil_setting=$get_setting->row();
				$kode_unit_jabung=@$hasil_setting->kode_unit;

				$kode_pengadaan=$this->uri->segment(4);
				$get_pengadaan=$this->db->get_where('pengadaan',array('kode_pengadaan' =>$kode_pengadaan));
				$hasil_pengadaan=$get_pengadaan->row();
				?>
				<div class="panel-body">
					<h4>Edit Pengadaan</h4>
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<h5>Kode</h5>
									</div>
									<div class="col-md-3">
										<h5>Bulan</h5>
									</div>
									<div class="col-md-3">
										<h5>Tahun</h5>
									</div>
									<div class="col-md-3">
										<h5>Unit</h5>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<input type="text" class="form-control" value="<?php echo @$hasil_pengadaan->kode_pengadaan;?>" placeholder="Lock" readonly>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="<?php echo @BulanIndo($hasil_pengadaan->bulan);?>" placeholder="Lock" readonly>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="<?php echo @$hasil_pengadaan->tahun;?>" placeholder="Lock" readonly>
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" value="<?php echo @$hasil_setting->nama_unit;?>" placeholder="Lock" readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<form id="data_form" onsubmit="return false;">
							<hr>
							<br>
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr style="background-color: #d3d3d3;">
										<th>No</th>
										<th>Nama Bahan Baku</th>
										<th>Nama Supplier</th>
										<th>Total Kebutuhan</th>
										<th>Stock Awal</th>
										<th>Kekurangan<br>Kebutuhan</th>
										<th>QTY PO</th>
										<th>Harga Satuan</th>
										<th>Jumlah Harga</th>
										
									</tr>
								</thead>
								
								<?php
								$get_supplier=$this->db_master->get('master_supplier');
								$hasil_supplier=$get_supplier->result();

								$this->db->where('kan_suol.opsi_pengadaan.kode_pengadaan', $kode_pengadaan);
								$this->db->from('kan_master.master_bahan_baku');
								$this->db->join('kan_suol.opsi_pengadaan', 'kan_suol.opsi_pengadaan.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
								$this->db->join('kan_master.master_satuan', 'kan_master.master_satuan.kode = kan_master.master_bahan_baku.kode_satuan_pembelian ');
								$get_opsi_pengadaan = $this->db->get();
								$hasil_opsi_pengadaan=$get_opsi_pengadaan->result();
								$no=1;
								$subtotal=0;
								foreach ($hasil_opsi_pengadaan as $opsi) {
									?>
									<tbody id="copy_supplier<?php echo $opsi->kode_bahan_baku?>" >
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$opsi->nama_bahan_baku;?></td>
											<td>
												<select  name="kode_supplier_<?php echo $opsi->kode_bahan_baku?>[]" class="form-control supplier select2" required="">
													<option value="">- Pilih Supplier</option>
													<?php
													foreach ($hasil_supplier as $supplier) {
														?>
														<option <?php if(@$opsi->kode_supplier==@$supplier->kode_supplier){ echo "selected";}?> value="<?php echo $supplier->kode_supplier?>"><?php echo $supplier->nama_supplier;?></option>
														<?php
													}
													?>
												</select>
											</td>
											<td><?php echo @$opsi->total_kebutuhan.' ';echo @$opsi->alias;?></td>
											<td><?php echo @$opsi->real_stok / @$opsi->konversi;echo ' '.@$opsi->alias;?></td>
											<td><?php echo @$opsi->kekurangan_kebutuhan.' ';echo @$opsi->alias;?></td>
											<td>
												<input type="hidden" class="kekurangan_<?php echo $opsi->kode_bahan_baku?>" value="<?php echo @$opsi->kekurangan_kebutuhan;?>">
												<input type="number" name="qty_po_<?php echo $opsi->kode_bahan_baku?>[]" id="qty_po" class="form-control  qty_po_<?php echo $opsi->kode_bahan_baku?>" value="<?php echo @$opsi->kekurangan_kebutuhan;?>" onkeyup="hitung_subtotal(this)">
											</td>
											<td>
												<input type="number" name="harga_<?php echo $opsi->kode_bahan_baku?>[]" id="harga_satuan" class="form-control" value="<?php echo @$opsi->harga_satuan;?>" onkeyup="hitung_subtotal(this)">
											</td>
											<td class="text-right">
												<label id="label_jml_harga" class="label_<?php echo $opsi->kode_bahan_baku;?>"><?php echo @@format_rupiah($opsi->nominal_subtotal);?></label>
												<input type="hidden" name="jml_harga_<?php echo $opsi->kode_bahan_baku;?>[]"  id="jml_harga" value="<?php echo @$opsi->kekurangan_kebutuhan * $opsi->hpp;?>" class="subtotal jml_harga_<?php echo $opsi->kode_bahan_baku;?>">
											</td>
											
											
										</tr> 
									</tbody>


									<?php
								}
								?>
								<tr>
									<th colspan="6"></th>
									<th>Sub Total</th>
									<th class="text-right"><label id="label_subtotal"><?php echo @format_rupiah($hasil_pengadaan->nominal_subtotal);?></label></th> 
									<input type="hidden" name="kode_pengadaan" value="<?php echo @$kode_pengadaan;?>">
									<input type="hidden" name="subtotal" id="subtotal" value="<?php echo @$hasil_pengadaan->nominal_subtotal;?>">   
									<td></td>  
								</tr>
								<tr>
									<th colspan="6"></th>
									<th>PPN 
										<div class="input-group">
											<input type="number" name="ppn" id="ppn" class="form-control" placeholder="PPN" aria-describedby="basic-addon1" value="<?php echo @$hasil_pengadaan->ppn;?>" onkeyup="hitung_grandtotal()">
											<span class="input-group-addon" id="basic-addon1">%</span>
										</div>
										
									</th>
									<th class="text-right"><label id="label_ppn"><?php echo @format_rupiah($hasil_pengadaan->nominal_ppn);?></label></th>
									<input type="hidden" name="nominal_ppn" id="nominal_ppn" value="<?php echo @$hasil_pengadaan->nominal_ppn;?>">    
									<td></td> 
								</tr>
								<tr>
									<th colspan="6"></th>
									<th>Grandtotal</th>
									<th class="text-right"><label id="label_grantotal"><?php echo @format_rupiah($hasil_pengadaan->nominal_grand_total);?></label></th>
									<input type="hidden" name="grandtotal" id="grandtotal" value="<?php echo @$hasil_pengadaan->nominal_grand_total;?>">  
									<td></td>  
								</tr>
								
							</table>
						</form>
						<br>
						<button onclick="edit_supplier()" class="btn btn-warning btn-lg btn-no-radius pull-right btn_edit"><i class="fa fa-pencil"></i> Edit Supplier</button>
						<button onclick="confirm_simpan()" class="btn btn-info btn-lg btn-no-radius pull-right btn_simpan"><i class="fa fa-send"></i> Simpan</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-------------------------------------------------- Modal ---------------------------------------------->
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
				<button type="button" onclick="simpan_supplier()" class="btn btn-success"><i class="fa fa-trash"></i> Simpan</button>
			</div>
		</div>
	</div>
</div>
<div id="modal-gagal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title danger">Konfirmasi Gagal</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Total Kebutuhan dengan QTY PO tidak Sesuai ...!</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">OK</button>
				
			</div>
		</div>
	</div>
</div>
<div id="modal-gagal-supp" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title danger">Konfirmasi Gagal</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Terdapat Bahan Baku dengan Supplier sama ...!</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">OK</button>
				
			</div>
		</div>
	</div>
</div>
<!-------------------------------------------------- Modal ---------------------------------------------->

<script type="text/javascript">
	$('.btn_simpan').hide();
	$('.btn_add').attr('disabled',true);
	$('.supplier').attr('disabled',true);
	$('.form-control').attr('disabled',true);
	function edit_supplier() {
		$('.btn_edit').hide();
		$('.btn_simpan').show();
		$('.supplier').attr('disabled',false);
		$('.form-control').attr('disabled',false);
		$('.btn_add').attr('disabled',false);
	}
	function tambah_supplier(kode_bahan){
		$('.qty_po_'+kode_bahan).val('');
		$('.jml_harga_'+kode_bahan).val('');
		$('.label_'+kode_bahan).html('Rp. 0');
		$('#tr_supplier'+kode_bahan).clone().appendTo('#copy_supplier'+kode_bahan);

		form_id = $('#copy_supplier'+kode_bahan);
		form_id.find('.select_supp').addClass('supplier');
		form_id.find('#qty_po').addClass('qty_po');
		form_id.find('#harga_satuan').addClass('harga_satuan');
	}
	function delete_supplier(obj){
		tr = $(obj).parent().parent();
		tr.closest('.tr_dupliacte').remove();
		hitung_subtotal(obj);
	}
	function hitung_subtotal(obj){
		tr = $(obj).parent().parent();
		qty_po=tr.find('input[id="qty_po"]').val();
		harga_satuan=tr.find('input[id="harga_satuan"]').val();
		if(parseInt(qty_po) < 0){
			alert("QTY PO Salah..!");
			tr.find('input[id="qty_po"]').val('');
		}else if(parseInt(harga_satuan) < 0){
			alert("Harga Satuan Salah..!");
			tr.find('input[id="harga_satuan"]').val('');
		}else{
			tr.find('label[id="label_jml_harga"]').html(toRp(qty_po * harga_satuan));
			tr.find('input[id="jml_harga"]').val(qty_po * harga_satuan);
			var subtotal=0;
			$('.subtotal').each(function() {
				var num = parseInt(this.value, 10);
				if (!isNaN(num)) {
					subtotal += num;
				}
			});
			$('#label_subtotal').html(toRp(subtotal));
			$('#subtotal').val(subtotal);
			hitung_grandtotal();
		}
		
	};
	function hitung_grandtotal(){
		subtotal=$('#subtotal').val();
		ppn=$('#ppn').val();
		if(parseInt(ppn) < 0 || parseInt(ppn) > 100){
			alert("PPN Salah");
			$('#ppn').val('');
			$('#label_ppn').html(toRp(0));
			$('#label_grantotal').html(toRp(0));
			
		}else{
			nominal_ppn=(subtotal * ppn) /100;
			grandtotal=subtotal - nominal_ppn;

			$('#label_ppn').html(toRp(nominal_ppn));
			$('#label_grantotal').html(toRp(grandtotal));
			$('#nominal_ppn').val(nominal_ppn);
			$('#grandtotal').val(grandtotal);
		}
	}
	function confirm_simpan(){
		var total = 0;
		$('.supplier').each(function() {
			var isi = this.value;
			if (isi=='') {
				total += 1;
			}
		});
		$('.qty_po').each(function() {
			var isi = this.value;
			if (isi=='') {
				total += 1;
			}
		});
		$('.harga_satuan').each(function() {
			var isi = this.value;
			if (isi=='') {
				total += 1;
			}
		});
		ppn=$('#ppn').val();
		if(total==0 && ppn !=''){
			$('#modal-konfirmasi').modal('show');
		}else{
			alert('Silahkan Lengkapi From ..!');
		}
		
	}
	function simpan_supplier(){
		$('#modal-konfirmasi').modal('hide');
		$.ajax({
			url: '<?php echo base_url('pembelian/pengadaan_bahan_baku/update_supplier'); ?>',
			type: 'post',
			data:$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();
			},
			dataType:'json',
			success: function(hasil){
				$(".tunggu").hide();
				if(hasil.respon=='gagal'){
					$('#modal-gagal').modal('show');
				}else if(hasil.respon=='gagal_supp'){
					$('#modal-gagal-supp').modal('show');
				}else{
					$(".alert_berhasil").show();
					setTimeout(function(){
						window.location="<?php echo base_url('pembelian/pengadaan_bahan_baku');?>";
					},1500);
				}

			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
	function toRp(angka){
		var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
		var rev2    = '';
		for(var i = 0; i < rev.length; i++){
			rev2  += rev[i];
			if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
				rev2 += '.';
			}
		}
		return 'Rp. ' + rev2.split('').reverse().join('') + ',00';
	}
</script>