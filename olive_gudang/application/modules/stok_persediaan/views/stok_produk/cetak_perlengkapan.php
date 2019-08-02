<!DOCTYPE html>
<head>
	<title>Cetak Stok Produk</title>
</head>
<body onload="window.print()"> 
	<h1 style="text-align: center">Daftar Stok Produk</h1>
	<br>
	<table style="width:100%;padding-left:5px;border-collapse:collapse;font-size:18px" border="1">
		<thead>
			<tr width="100%">
				<th>No</th>
				<th>Kode Produk</th>
				<th>Nama Produk</th>
				<th>Jumlah Stok</th>
				<th>Satuan</th>
			</tr>
		</thead>
		<tbody>    
			<?php 
			$no = 0;
			$this->db->from('olive_master.master_produk mp');
			$this->db->join('olive_master.master_satuan m_s','m_s.kode = mp.kode_satuan_stok','left');
			$this->db->order_by('mp.id','DESC');
			$get_gudang = $this->db->get()->result();
			foreach ($get_gudang as $value) { 
				$no++; ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $value->kode_produk ?></td>
					<td><?= $value->nama_produk ?></td>
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