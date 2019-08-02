<div id='cssmenu'>
	<ul>
		<li class='has-sub'><a href='#'><i class="fa fa-university"></i> <span>Nominal Stok</span></a>
			<ul>
				<li><a href='<?php echo @base_url('stok/stok_bahan_baku'); ?>'><span>Bahan Baku</span></a></li>
				<li><a href='<?php echo @base_url('stok/stok_barang_dalam_proses'); ?>'><span>Barang Dalam Proses</span></a></li>
				<li><a href='<?php echo @base_url('stok/stok_barang_jadi'); ?>'><span>Produk</span></a></li>
			</ul>
		</li>
		<li class='has-sub'><a href='#'><i class="fa fa-university"></i> <span>Spoil</span></a>
			<ul>
				<li><a href='<?php echo @base_url('stok/spoil_bb/daftar'); ?>'><span>Bahan Baku</span></a></li>
				<li><a href='<?php echo @base_url('stok/spoil_bdp/daftar'); ?>'><span>Barang Dalam Proses</span></a></li>
				<li><a href='<?php echo @base_url('stok/spoil_produk/daftar'); ?>'><span>Produk</span></a></li>
			</ul>
		</li>
		<li class='has-sub'><a href='#'><i class="fa fa-university"></i> <span>Opname</span></a>
			<ul>
				<li><a href='<?php echo @base_url('stok/opname/data_jadwal'); ?>'><span>Jadwal Opname</span></a></li>
				<li><a href='<?php echo @base_url('stok/opname/daftar'); ?>'><span>Opname</span></a></li>
				<li><a href='<?php echo @base_url('stok/opname/hasil_opname'); ?>'><span>Hasil Opname</span></a></li>
			</ul>
		</li>
		<?php
			$this->db_master->where('master_bahan_baku.real_stok <= master_bahan_baku.stok_minimal');
			$this->db_master->or_where('master_bahan_baku.real_stok',null);
			$this->db_master->from('master_bahan_baku');
			$this->db_master->join('master_gudang', 'master_gudang.kode_gudang = master_bahan_baku.kode_gudang');
			$this->db_master->join('master_satuan', 'master_satuan.kode = master_bahan_baku.kode_satuan_stok');
			$get_bahan_baku = $this->db_master->get()->result();
			$total_stok_min = count($get_bahan_baku);
		?>
		<li><a href='<?php echo @base_url('stok/stok_minimal'); ?>'><i class="fa fa-university"></i> <span>Stok Minimal</span> <span class="badge"><?php echo @$total_stok_min;?></span> </a></li>
		<li><a href='<?php echo @base_url('stok/stok_out'); ?>'><i class="fa fa-university"></i> <span>Stok Out</span></a></li> 
	</ul>
	
</div>