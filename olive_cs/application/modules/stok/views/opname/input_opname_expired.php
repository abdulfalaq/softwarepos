
<!-- back button -->
<a href="<?php echo base_url('stok'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('stok'); ?>">Stok</a></li>
		<li><a href="#">Opname</a></li>
		<li></li>
	</ol>
</div>

<div class="clearfix"></div>

<div class="container">
	<h1>Opname </h1>

	<?php $this->load->view('menu_stok'); ?>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Input Opname </span>
					<br><br>
				</div>
				<form id="data_form">
					<?php
					$kode_opname=$this->uri->segment(4);
					$kode_bahan=$this->uri->segment(5);
					$this->db->where('kode_opname', @$kode_opname);
					$get_opname=$this->db->get('transaksi_opname');
					$hasil_opname=$get_opname->row();

					$get_unit=$this->db->get('setting');
					$hasil_unit=$get_unit->row();
					?>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<label>Kode Opname</label>
									<input type="text" name="kode_opname" id="kode_opname" class="form-control" readonly="" value="<?php echo @$hasil_opname->kode_opname;?>">
								</div>
								<div class="col-md-4">
									<label>Tanggal</label>
									<input type="date" name="tanggal" id="tanggal" class="form-control" readonly="" value="<?php echo @$hasil_opname->tanggal_opname;?>">
								</div>
								<input type="hidden" name="kode_unit" id="kode_unit" value="<?php echo @$hasil_unit->kode_unit;?>">
								<input type="hidden" name="kode_bahan" id="kode_bahan" value="<?php echo @$kode_bahan;?>">
								<input type="hidden" name="jenis_bahan" id="jenis_bahan" value="<?php echo @$hasil_opname->jenis_bahan;?>">
							</div>
						</div>
						<hr>
						<div class="col-md-12" style="margin-top: 20px;">
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th style="width: 70px;">No</th>
										<th>Nama Produk</th>
										<th>QTY Stok</th>
										<th>QTY Opname</th>
										<th>Expired Date</th>
									</tr>
								</thead>
								<tbody id="data_opsi_temp">
									<?php
									$jenis_bahan=@$hasil_opname->jenis_bahan;
									
									$this->db->select('kan_suol.transaksi_stok.id, 
										kan_suol.transaksi_stok.sisa_stok,
										kan_suol.transaksi_stok.tanggal_expired,
										kan_suol.transaksi_stok.kode_bahan');
									$this->db->where('kan_suol.transaksi_stok.jenis_transaksi', 'produksi');
									$this->db->where('kan_suol.transaksi_stok.status', 'masuk');
									$this->db->where('kan_suol.transaksi_stok.sisa_stok >', 0);
									$this->db->where('kan_suol.transaksi_stok.kode_bahan', @$kode_bahan);
									$this->db->from('kan_suol.transaksi_stok');
									if($jenis_bahan=='BDP'){
										$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.transaksi_stok.kode_bahan=kan_master.master_barang_dalam_proses.kode_barang');
										$this->db->join('kan_master.master_satuan', 'kan_master.master_barang_dalam_proses.kode_satuan_stok=kan_master.master_satuan.kode');

										$this->db->select('kan_master.master_barang_dalam_proses.nama_barang, kan_master.master_satuan.nama');
									}elseif ($jenis_bahan=='Produk') {
										$this->db->join('kan_master.master_produk', 'kan_suol.transaksi_stok.kode_bahan=kan_master.master_produk.kode_produk');
										$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok=kan_master.master_satuan.kode');
										$this->db->select('kan_master.master_produk.nama_produk, kan_master.master_satuan.nama');
									}
									
									$get_temp=$this->db->get();
									$hasil_temp=$get_temp->result();
									$no=1;
									
									foreach ($hasil_temp as $temp) {
										?>
										<input type="hidden" name="id_transaksi[]" value="<?php echo @$temp->id;?>">
										<input type="hidden" name="qty_stok[]" value="<?php echo @$temp->sisa_stok;?>">
										<input type="hidden" name="exp_date[]" value="<?php echo @$temp->tanggal_expired;?>">
										<tr>
											<td><?php echo $no++;?></td>
											<td>
												<?php if($jenis_bahan=='BDP'){ 
													echo @$temp->nama_barang;
												}elseif ($jenis_bahan=='Produk') {
													echo @$temp->nama_produk;
												}?>
											</td>
											<td><?php echo @$temp->sisa_stok.' '.@$temp->nama;?></td>
											<td>
												<input type="number" name="qty_opname[]" id="qty_opname_<?php echo @$temp->id;?>" class="form-control jumlah_opanme" onkeyup="hitung_sisa('<?php echo @$temp->id;?>')">
											</td>
											<td><?php echo @TanggalIndo($temp->tanggal_expired);?></td>
										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<a onclick="konfirm_simpan()" class="btn_simpan btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> SIMPAN</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- //row -->
</div>

<div id="modal-kofirm" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body text-center">
				<h2>Anda yakin akan menyimpan data ini ?</h2>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				<button type="button" class="btn btn-success" onclick="simpan_opname()"><i class="fa fa-send"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	function hitung_sisa(id) {
		var qty_opname=$('#qty_opname_'+id).val();
		if(qty_opname < 0){
			alert("QTY Opname Salah ...!");
			$('#qty_opname_'+id).val('');
		}
	}
	function konfirm_simpan() {
		$('#modal-kofirm').modal('show');
	}
	function simpan_opname(){
		
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/opname/simpan_opname_expired' ?>",  
			cache :false,  
			data :$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) {
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('stok/opname/input_opname_produk/'.$kode_opname);?>";
				},1500);
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		
		return false;  
	}
</script>
