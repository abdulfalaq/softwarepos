<!DOCTYPE html>
<head>
	<title>Cetak Stok Perlengkapan</title>
</head>
<body onload="window.print()"> 
	<h1 style="text-align: center">Daftar Stok Perlengkapan</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
			<tr width="100%">
				<th>No</th>
				<th>Kode Perlengkapan</th>
				<th>Nama Perlengkapan</th>
				<th>Jumlah Stok</th>
				<th>Satuan</th>
			</tr>
		</thead>
		<tbody>    
			<?php 
			$no = 0;
			$this->db->from('olive_master.master_perlengkapan mp');
			$this->db->join('olive_master.master_satuan ms','ms.kode = mp.kode_satuan_stok','left');
			$this->db->order_by('mp.id','DESC');
			$get_gudang = $this->db->get()->result(); 
			foreach ($get_gudang as $value) { 
				$no++; ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $value->kode_perlengkapan ?></td>
					<td><?= $value->nama_perlengkapan ?></td>
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