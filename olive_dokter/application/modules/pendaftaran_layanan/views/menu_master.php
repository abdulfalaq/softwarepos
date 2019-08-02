<div id='cssmenu'>
	<ul>
		<li><a href='<?php echo @base_url('penjualan/pesanan_penjualan'); ?>'><i class="fa fa-university"></i> <span>Pesanan Penjualan</span></a></li>
		<li><a href='<?php echo @base_url('penjualan/pos'); ?>'><i class="fa fa-university"></i> <span>POS</span></a></li>

		<li class='has-sub'><a href='#'><i class="fa fa-user"></i> <span>Member</span></a>
			<ul>
				<li class="has sub">
					<a href='<?php echo @base_url('penjualan/member/tambah'); ?>'><span>Tambah Member</span></a>
				</li>
				<li class="has sub">
					<a href='#'><span>Member Umum</span></a>
					<ul>
						<li><a href="<?php echo @base_url('penjualan/member_umum/record_transaksi_member'); ?>">Record Transaksi Member</a></li>
						<li><a href="<?php echo @base_url('penjualan/member_umum/profil_member'); ?>">Profil Member</a></li>
						<li><a href="<?php echo @base_url('penjualan/member_umum/evaluasi_member'); ?>">Evaluasi member</a></li>
					</ul>
				</li>
				<li class="has sub">
					<a href='#'><span>Member Konsinyasi</span></a>
					<ul>
						<li><a href="<?php echo @base_url('penjualan/member_konsinyasi/record_transaksi_member'); ?>">Record Transaksi Member</a></li>
						<li><a href="<?php echo @base_url('penjualan/member_konsinyasi/profil_member'); ?>">Profil Member</a></li>
						<li><a href="<?php echo @base_url('penjualan/member_konsinyasi/evaluasi_member'); ?>">Evaluasi member</a></li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href='<?php echo @base_url('penjualan/event'); ?>'><i class="fa fa-university"></i> <span>Event</span></a></li>
		<li><a href='<?php echo @base_url('penjualan/retur'); ?>'><i class="fa fa-university"></i> <span>Retur Penjualan</span></a></li>
		<li><a href='<?php echo @base_url('penjualan/piutang'); ?>'><i class="fa fa-university"></i> <span>Piutang</span></a></li>
	</ul>
</div>