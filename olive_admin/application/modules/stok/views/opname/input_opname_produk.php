
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
										<th>QTY Fisik</th>
										<th>Selisih</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="data_opsi_temp">
									<?php
									$jenis_bahan=@$hasil_opname->jenis_bahan;
									$this->db->where('kan_suol.opsi_transaksi_opname.kode_opname', @$kode_opname);
									$this->db->from('kan_suol.opsi_transaksi_opname');
									if($jenis_bahan=='BDP'){
										$this->db->join('kan_master.master_barang_dalam_proses', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_barang_dalam_proses.kode_barang');
										$this->db->join('kan_master.master_satuan', 'kan_master.master_barang_dalam_proses.kode_satuan_stok=kan_master.master_satuan.kode');
									}elseif ($jenis_bahan=='Produk') {
										$this->db->join('kan_master.master_produk', 'kan_suol.opsi_transaksi_opname.kode_bahan=kan_master.master_produk.kode_produk');
										$this->db->join('kan_master.master_satuan', 'kan_master.master_produk.kode_satuan_stok=kan_master.master_satuan.kode');
									}
									
									$get_temp=$this->db->get();
									$hasil_temp=$get_temp->result();
									$no=1;
									foreach ($hasil_temp as $temp) {
										?>
										<tr>
											<td><?php echo $no++;?></td>
											<td>
												<?php if($jenis_bahan=='BDP'){ 
													echo @$temp->nama_barang;
												}elseif ($jenis_bahan=='Produk') {
													echo @$temp->nama_produk;
												}?>

											</td>
											<td><?php echo @$temp->stok_awal.' '.@$temp->nama;?></td>
											<td><?php echo @$temp->stok_akhir.' '.@$temp->nama;?></td>
											<td><?php echo @$temp->selisih.' '.@$temp->nama;?></td>
											<td><?php if(@$temp->stok_awal < @$temp->stok_akhir){ echo "Lebih";}else{echo "Kurang";}?></td>
											<td>
												<?php
												if(empty($temp->stok_akhir)){
													?>
													<a href="<?php echo base_url('stok/opname/input_opname_expired/'.@$temp->kode_opname.'/'.@$temp->kode_bahan); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i> Opname</a>
													<?php
												}
												?>
												
											</td>

										</tr>
										<?php
									}
									?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<a onclick="simpan_opname()" class="btn_simpan btn btn-no-radius btn-info btn-md pull-right"><i class="fa fa-send"></i> SIMPAN</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- //row -->
</div>

<script type="text/javascript">
	function simpan_opname(){
		
		$.ajax( {  
			type :"post",  
			url : "<?php echo base_url() . 'stok/opname/simpan_opname_produk' ?>",  
			cache :false,  
			data :$('#data_form').serialize(),
			beforeSend:function(){
				$(".tunggu").show();
			},
			success : function(data) {
				$(".tunggu").hide();
				$(".alert_berhasil").show();
				setTimeout(function(){
					window.location="<?php echo base_url('stok/opname/daftar');?>";
				},1500);
			},  
			error : function() {
				alert("Data gagal dimasukkan.");  
			}  
		});
		
		return false;  
	}
</script>