<div id='cssmenu'>
	<ul>
		<li><a href='<?php echo @base_url('pembelian/perencanaan_produksi'); ?>'><i class="fa fa-university"></i> <span>Perencanaan Produksi</span></a></li>
		<li class="has-sub"><a href="#"><i class="fa fa-university"></i> <span>Pengadaan</span></a>
			<ul>
				<li class="has sub">
					<a href="<?= base_url('pembelian/pengadaan_bahan_baku') ?>"><span>Pengadaan Bahan Baku</span></a>
				</li>
				<li class="has sub">
					<a href="<?= base_url('pembelian/pengadaan_barang') ?>">Pengadaan Barang</a>
				</li>
				<li class="has sub">
					<a href="<?= base_url('pembelian/pengadaan_jasa') ?>">Pengadaan Jasa</a>
				</li>
				<li class="has sub">
					<a href="<?= base_url('pembelian/pengadaan_aset_inventasi') ?>">Pengadaan Asset/investasi</a>
				</li>
			</ul>
		</li>
		<li class="has-sub"><a href='#'><i class="fa fa-university"></i> <span>PO Supplier</span></a>
			<ul>
				<li class="has sub">
					<a href="<?= base_url('pembelian/po/daftar') ?>"><span>PO</span></a>
				</li>
				<li class="has sub">
					<a href="<?= base_url('pembelian/po/daftar_validasi') ?>">Validasi PO</a>
				</li>
				
			</ul>
		</li>
		<li><a href='<?php echo @base_url('pembelian/pembelian_bb'); ?>'><i class="fa fa-university"></i> <span>Pembelian</span></a></li>
		<!-- <li><a href='<?php echo @base_url('pembelian/retur'); ?>'><i class="fa fa-university"></i> <span>Retur Pembelian</span></a></li> -->
		<li class="has-sub"><a href='#'><i class="fa fa-university"></i> <span>Supplier</span></a>
			<ul>
				<li class="has sub">
					<a href="<?= base_url('pembelian/supplier') ?>"><span>Pengajuan Supplier</span></a>
				</li>
				<li class="has sub">
					<a href="#">Daftar Supplier</a>
				</li>
				
			</ul>
		</li>
		<li><a href='<?php echo @base_url('pembelian/hutang/daftar'); ?>'><i class="fa fa-money"></i> <span>Hutang</span></a></li>
	</ul>
</div>



