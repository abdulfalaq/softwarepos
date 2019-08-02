<!DOCTYPE html>
<head>
	<title>Cetak Stok Bahan</title>
</head>
<body onload="window.print()">
	<?php 
	$this->db->from('olive_master.master_bahan_baku mbb');
	$this->db->join('olive_master.master_satuan satuan', 'mbb.kode_satuan_stok = satuan.kode','left');
	$this->db->order_by('mbb.id','DESC');
	$get_gudang = $this->db->get()->result(); 
	?>
	<h1 style="text-align: center">Daftar Stok Bahan</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
			<tr width="100%">
				<th>No</th>
				<th>Kode Bahan</th>
				<th>Nama Bahan</th>
				<th>Jumlah Stok</th>
				<th>Satuan</th>
			</tr>
		</thead>
		<tbody>    
			<?php 
			$no = 0;
			foreach ($get_gudang as $value) { 
				$no++; ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $value->kode_bahan_baku ?></td>
					<td><?= $value->nama_bahan_baku ?></td>
					<td><?= $value->real_stock ?></td>
					<td><?= $value->nama ?></td>
				</td>
			</tr>
			<?php }
			?>
		</tbody>     
	</table>
</body>
</html>