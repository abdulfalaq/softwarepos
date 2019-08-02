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
				$get_setting	 = $this->db->get('setting');
				$hasil_setting	 = $get_setting->row();
				$kode_unit_jabung= @$hasil_setting->kode_unit;

				$kode_pengadaan = $this->uri->segment(4);
				$get_pengadaan 	= $this->db->get_where('pengadaan',array('kode_pengadaan' =>$kode_pengadaan));
				$hasil_pengadaan= $get_pengadaan->row();
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
						<form id="data_form">
							<hr>
							<br>
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr style="background-color: #d3d3d3;">
										<th>No</th>
										<th>Nama Bahan Baku</th>
										<th>Kode Supplier</th>
										<th>Nama Supplier</th>
										<th>Total Kebutuhan</th>
										<th>Stock Awal</th>
										<th>Kekurangan<br>Kebutuhan</th>
										<th>Harga Satuan</th>
										<th>Jumlah Harga</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$get_supplier  = $this->db_master->get('master_supplier');
									$hasil_supplier= $get_supplier->result();

									$this->db->from('kan_master.master_bahan_baku');
									$this->db->join('kan_suol.opsi_pengadaan', 'kan_suol.opsi_pengadaan.kode_bahan_baku = kan_master.master_bahan_baku.kode_bahan_baku ');
									$this->db->join('kan_master.master_supplier', 'kan_master.master_supplier.kode_supplier = kan_suol.opsi_pengadaan.kode_supplier ');
									$this->db->join('kan_master.master_satuan', 'kan_master.master_satuan.kode = kan_master.master_bahan_baku.kode_satuan_pembelian ');
									$this->db->where('kan_suol.opsi_pengadaan.kode_pengadaan', $kode_pengadaan);
									$this->db->where('kan_master.master_supplier.kode_unit_jabung', $kode_unit_jabung);
									$get_opsi_pengadaan   = $this->db->get();
									$hasil_opsi_pengadaan = $get_opsi_pengadaan->result();
									$no 		= 1;
									$subtotal	= 0;
									foreach ($hasil_opsi_pengadaan as $opsi) {
										$subtotal +=@$opsi->kekurangan_kebutuhan * $opsi->harga_satuan;
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td><?php echo @$opsi->nama_bahan_baku;?></td>
											<td><?php echo @$opsi->kode_supplier;?></td>
											<td><?php echo @$opsi->nama_supplier;?></td>
											<td><?php echo @$opsi->total_kebutuhan.' ';echo @$opsi->alias;?></td>
											<td><?php echo @$opsi->real_stok / @$opsi->konversi;echo ' '.@$opsi->alias;?></td>
											<td><?php echo @$opsi->kekurangan_kebutuhan.' ';echo @$opsi->alias;?></td>
											<td class="text-right"><?php echo @format_rupiah($opsi->harga_satuan);?></td>
											<td class="text-right"><?php echo @format_rupiah(@$opsi->kekurangan_kebutuhan * $opsi->harga_satuan);?></td>

										</tr>  
										<?php
									}
									?>
									<tr>
										<th colspan="7"></th>
										<th>Sub Total</th>
										<th class="text-right"><?php echo @format_rupiah($hasil_pengadaan->nominal_subtotal);?></th> 
										<input type="hidden" name="kode_pengadaan" value="<?php echo @$kode_pengadaan;?>">
										<input type="hidden" name="subtotal" value="<?php echo @$subtotal;?>">     
									</tr>
									<tr>
										<th colspan="7"></th>
										<th>PPN <?php echo @$hasil_pengadaan->ppn;?>%</th>
										<th class="text-right"><?php echo @format_rupiah($hasil_pengadaan->nominal_ppn);?></th>
										<input type="hidden" name="ppn" value="<?php echo @$nominal_ppn;?>">    
									</tr>
									<tr>
										<th colspan="7"></th>
										<th>Grandtotal</th>
										<th class="text-right"><?php echo @format_rupiah($hasil_pengadaan->nominal_grand_total);?></th>
										<input type="hidden" name="grandtotal" value="<?php echo @$grandtotal;?>">   
									</tr>
								</tbody>
							</table>
						</form>
						<br>
						
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
<!-------------------------------------------------- Modal ---------------------------------------------->

<script type="text/javascript">
	$('.btn_simpan').hide();
	$('#kode_supplier').attr('disabled',true);
	function edit_supplier() {
		$('.btn_edit').hide();
		$('.btn_simpan').show();
		$('#kode_supplier').attr('disabled',false);
	}
	function confirm_simpan(){
		var total = 0;
		$('.supplier').each(function() {
			var isi = this.value;
			if (isi=='') {
				total += 1;
			}
		});
		if(total==0){
			$('#modal-konfirmasi').modal('show');
		}else{
			alert('Silahkan Pilih Supplier ..!');
		}
		
	}
	function simpan_supplier(){
		$('#modal-konfirmasi').modal('hide');
		$.ajax({
			url: '<?php echo base_url('pembelian/pengadaan_bahan_baku/simpan_supplier'); ?>',
			type: 'post',
			data:$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();
			},
			success: function(hasil){
				$(".tunggu").hide();
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('pembelian/pengadaan_bahan_baku');?>";
				},1500);
			},
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
	}
</script>