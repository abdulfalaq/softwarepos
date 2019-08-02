<!DOCTYPE html>
<head>
	<title>Laporan Analisa Market</title>
</head>
<body onload="window.print()">
	<h1 style="text-align: center">Laporan Analisa Market</h1>
	<br>
	<div class="panel-body">
		<div class="box-body">            
			<div class="row">      
				<div class="col-xs-12">
					<!-- /.box -->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" class="reload">
								</a>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>    
	</div> 
	<div class="row">
		
	</div>
</div>
<br>
<div class="panel panel-default">
	<div class="panel-heading text-right">
		<span class="pull-left" style="font-size: 24px">Pembatalan</span>
		<br>
		<br>
	</div>
	<div class="panel-body">
		<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Transaksi</th>
					<th>Total Nominal</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$tgl_awal=$this->uri->segment(4);
				$tgl_akhir=$this->uri->segment(5);
				$this->db->group_by('kode_transaksi');
				$this->db->select('kode_transaksi');
				$this->db->select_sum('subtotal');
				$get_batal=$this->db->get('olive_kasir.opsi_transaksi_batal');
				if (!empty($tgl_awal)) {
					$this->db->where('olive_kasir.opsi_transaksi_batal.tanggal_transaksi >=',$tgl_awal);
				}
				if (!empty($tgl_akhir)) {
					$this->db->where('olive_kasir.opsi_transaksi_batal.tanggal_transaksi <=',$tgl_akhir);
				}
				$hasil_batal=$get_batal->result();
				$no=1;
				foreach ($hasil_batal as $value) {
					?>
					<tr>
						<td><?php echo $no++?></td>
						<td><?php echo @$value->kode_transaksi;?></td>
						<td><?php echo @format_rupiah($value->subtotal);?></td>
					</tr>
					<?php
				}
				?>
				

			</tbody>                
		</table>
	</body>
	</html>