
<table id="datatable" class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Bahan Baku</th>
			<th>QTY</th>
			<th>Keterangan</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$kode = $this->uri->segment(3);
		$this->db->from('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp');
		$this->db->where('clouoid1_olive_gudang.opsi_transaksi_stok_out_temp.kode_stok_out',$kode);
		$get_sapi = $this->db->get()->result();
		$no = 0;
		foreach ($get_sapi as $value) { $no++;
			if ($value->jenis_item == 'Perlengkapan') {
				$get_perlengkapan = $this->db->get_where('clouoid1_olive_master.master_perlengkapan',array('kode_perlengkapan' => $value->kode_bahan_baku ))->row(); 
				$nama_bahan = $get_perlengkapan->nama_perlengkapan;

			}else{
				$get_bahan = $this->db->get_where('clouoid1_olive_master.master_bahan_baku',array('kode_bahan_baku' => $value->kode_bahan_baku ))->row(); 
				$nama_bahan = $get_bahan->nama_bahan_baku;
			}?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $nama_bahan ?></td>
				<td><?= $value->jumlah ?></td>
				<td><?= $value->keterangan ?></td>
				<td align="center"><div class="btn-group">
					<a onclick="tampil_update('<?php echo $value->id ?>')"   class="btn btn-icon btn-warning "><i class="fa fa-pencil"></i></a>
					<a onclick="actDelete('<?php echo $value->id ?>')" class="btn  btn-danger "><i class="fa fa-remove"></i></a>
				</div>
			</td>
		</tr>
		<?php }
		?>
	</tbody>
</table>
