<?php 
	$kode_po = paramDecrypt($this->uri->segment(4));
 ?>
<table id="" class="table table-striped table-bordered">
	<thead>
		<tr style="background-color: #d3d3d3;">
			<th>No</th>
			<th>Nama Produk</th>
			<th>QTY PO</th>
			<th>QTY Penerimaan</th>
			<th>Harga Satuan</th>
			<th>Subtotal</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$no = 0;
		$master_subtotal = 0;
		$this->db->select('*');
		$this->db->where('kode_pembelian', $kode_po);
		$this->db->from('opsi_transaksi_pembelian_temp');
		$get_opsi_po = $this->db->get()->result();
		foreach ($get_opsi_po as $value) { 
			$no++;	
			$get_BB = $this->db_master->get_where('master_bahan_baku', array('kode_bahan_baku' => $value->kode_bahan_baku))->row();
			$subtotal = $value->qty*$value->harga_satuan;
			$master_subtotal = $master_subtotal + $subtotal;
			?>
			<tr>
				<td><?php echo $no ?></td>
				<td><?php echo $get_BB->nama_bahan_baku ?></td>
				<td><?php echo $value->qty_po ?></td>
				<td><?php echo $value->qty ?></td>
				<td class="text-right"><?php echo format_rupiah($value->harga_satuan) ?></td>
				<td class="text-right"><?php echo format_rupiah($subtotal) ?></td>
				<td>
					<a onclick="edit_row('<?php echo $value->id_temp ?>')" class="btn btn-info btn-md btn-no-radius"><i class="fa fa-pencil"></i></a>
					<a onclick="" class="btn btn-danger btn-md btn-no-radius"><i class="fa fa-trash"></i></a>
				</td>
			</tr>  
			<?php 
		} ?>
		<tr>
			<th colspan="4"></th>
			<th>Total</th>
			<th class="text-right"><?php echo format_rupiah($master_subtotal) ?></th>
			<th class="text-right"></th> 
			<input type="hidden" name="subtotal" id="subtotal" value="<?php echo $master_subtotal ?>" readonly>     
		</tr>
		<tr>
			<th colspan="4"></th>
			<th>Diskon (%)</th>
			<th class="text-right" id="diskon_persen_col_text">%</th>
			<th class="text-right"></th>    
			<input type="hidden" name="diskon_persen_col" id="diskon_persen_col">  
		</tr>
		<tr>
			<th colspan="4"></th>
			<th>Diskon (Rp)</th>
			<th class="text-right" id="diskon_rupiah_col_text"><?php echo format_rupiah('0') ?></th>
			<th class="text-right"></th>  
			<input type="hidden" name="diskon_rupiah_col" id="diskon_rupiah_col">    
		</tr>
		<tr>
			<th colspan="4"></th>
			<th>PPN (%)</th>
			<th class="text-right" id="diskon_ppn_col_text">%</th>
			<th class="text-right"></th>  
			<input type="hidden" name="diskon_ppn_col" id="diskon_ppn_col">    
		</tr>
		<tr>
			<th colspan="4"></th>
			<th>Grand Total</th>
			<th class="text-right" id="grand_total_text"><?php echo format_rupiah($master_subtotal) ?></th>
			<th class="text-right"></th>
			<input type="hidden" name="grand_total" id="grand_total" value="<?php echo $master_subtotal ?>">    
		</tr>
	</tbody>
</table>