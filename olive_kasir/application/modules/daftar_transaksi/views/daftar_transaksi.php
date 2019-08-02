<?php 
$tanggal 	= date('Y-m-d');
$month 		= date("m",strtotime($tanggal));

$this->db->where('MONTH(tanggal_transaksi)', date('m'));
$this->db->where('YEAR(tanggal_transaksi)', date('Y'));
$this->db->where('status', 'selesai');
$this->db->order_by('tanggal_transaksi','desc');
$this->db->group_by('tanggal_transaksi');
$get_transaksi = $this->db->get('transaksi_layanan')->result();


?>
<!-- back button -->
<a href="<?php echo base_url(); ?>"><button class="button-back"></button></a>
<!-- //back button -->
<div class="container">
	<ol class="breadcrumb">
		<li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
		<li><a href="<?php echo base_url('daftar_transaksi'); ?>"> Data Transaksi</a></li>
		<li>Daftar Trasaksi</li>
	</ol>
</div>

<div class="clearfix"></div>
<div class="container">
	
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<span class="pull-left" style="font-size: 24px">Daftar Transaksi Layanan </span>
					<br><br>
				</div>
				<div class="panel-body">
					<div class="col-md-12 row">
						<div class="row">
							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Bulan</span>
									<select class="form-control" name="bulan" id="bulan" required="">              
										<option value="">-- Bulan --</option>
										<option value="01">Januari</option>
										<option value="02">Februari </option>
										<option value="03"> Maret</option>
										<option value="04">April</option>
										<option value="05">Mei</option>
										<option value="06"> Juni </option>
										<option value="07">Juli </option>
										<option value="08">Agustus</option>
										<option value="09">September</option>
										<option value="10">Oktober </option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
								</div>
							</div>

							<div class="col-md-5" id="">
								<div class="input-group">
									<span class="input-group-addon">Tahun</span>
									<select class="form-control" name="tahun" id="tahun" required="">              
										<option value="">
											-- Tahun --
										</option>
										<?php
										$tahun_awal=date('Y');
										$tahun_akhir=date('Y')-10;
										for ($tahun=$tahun_awal; $tahun > $tahun_akhir; $tahun--) { 
											?>
											<option value="<?php echo $tahun;?>"><?php echo $tahun;?></option>
											<?php
										}
										?>
									</select>
								</div>
							</div>                        
							<div class="col-md-2 pull-left">
								<button style="width: 90px" type="button" class="btn btn-warning pull-right" id="cari"><i class="fa fa-search"></i> Cari</button>
							</div>
						</div>
						<br>
						<br>
						<div id="">
							<div>
								<div class="row">
								</div>
								<table id="tabel_daftar" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal Transaksi</th>
											<th>Grand Total</th>
											<th class="act">Action</th>
										</tr>
									</thead>
									<tbody id="hasil_cari">
										<?php 
										$no = 0;
										foreach ($get_transaksi as $value) { 
											$no++; ?>
											<tr>
												<td><?php echo $no ?></td>
												<td><?php echo tanggalIndo($value->tanggal_transaksi); ?></td>
												<td align="right"><?php 
												$this->db->select_sum('grand_total');
												$this->db->where('status', 'selesai');
												$this->db->where('tanggal_transaksi', $value->tanggal_transaksi);
												$total_jual = $this->db->get('transaksi_layanan');
												$hasil_total = $total_jual->row();
												echo format_rupiah(@$hasil_total->grand_total); ?></td>
												<td align="center">
													<div class="btn-group">
														<a href="<?php echo base_url('daftar_transaksi/daftar_transaksi/detail/'.$value->tanggal_transaksi) ?>" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle btn-primary"><i class="fa fa-search"></i></a>
													</div>
												</td>
											</tr>
											<?php }
											?>
										</tbody>          
										<tfoot>
											<tr>
												<th>No</th>
												<th>Tanggal Transaksi</th>
												<th>Grand Total</th>
												<th class="act">Action</th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#cari').click(function(){
			var bulan =$("#bulan").val();
			var tahun =$("#tahun").val();
			if (bulan=='' || tahun==''){ 
				alert('Pilih Bulan & Tahun ..!')
			}
			else{
				$.ajax( {  
					type :"post",  
					url : "<?php echo base_url().'daftar_transaksi/cari_data'; ?>",  
					cache :false,

					data : {bulan:bulan,tahun:tahun},
					beforeSend:function(){
						$(".tunggu").show();  
					},
					success : function(data) {
						$(".tunggu").hide();  
						$("#hasil_cari").html(data);
					} 
				});
			}
		});
</script>