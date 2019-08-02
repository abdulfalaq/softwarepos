<div id="load_laporan">
  <table class="table table-striped table-hover table-bordered" id="datatable"  style="font-size:1.0em;">
    <thead>
      <tr>
        <th width="30%">Period</th>
        <th width="30%">Kode Member</th>
        <th width="30%">Nama Member</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $data = $this->input->post();

      $bulan = date('m',strtotime($data['tanggal_awal']));
      $tahun = date('Y',strtotime($data['tanggal_awal']));

      $this->db->where('MONTH(tanggal_transaksi)', $bulan);
      $this->db->where('YEAR(tanggal_transaksi)', $tahun);  
      $this->db->group_by('kode_member');
      $get_member = $this->db->get('olive_kasir.transaksi_layanan')->result();
      $no = 0;
      foreach ($get_member as $value) { $no++;
        $tanggal_kedua = date('Y-m-d',strtotime('+1 months', strtotime($value->tanggal_transaksi)));

        $bulan_kedua = date('m',strtotime($tanggal_kedua));
        $tahun_kedua = date('Y',strtotime($tanggal_kedua));
        $this->db->where('MONTH(tanggal_transaksi)', $bulan_kedua);
        $this->db->where('YEAR(tanggal_transaksi)', $tahun_kedua);  
        $this->db->where('kode_member', $value->kode_member);
        $this->db->group_by('kode_member');
        $get_member_kedua = $this->db->get('olive_kasir.transaksi_layanan')->row();

        if (count($get_member_kedua) > 0) {
          $tanggal_ketiga = date('Y-m-d',strtotime('+1 months', strtotime($get_member_kedua->tanggal_transaksi)));

          $bulan_ketiga = date('m',strtotime($tanggal_ketiga));
          $tahun_ketiga = date('Y',strtotime($tanggal_ketiga));

          $this->db->from('olive_kasir.transaksi_layanan');
          $this->db->join('olive_master.master_member','olive_master.master_member.kode_member = olive_kasir.transaksi_layanan.kode_member','left');
          $this->db->where('MONTH(olive_kasir.transaksi_layanan.tanggal_transaksi)', $bulan_ketiga);
          $this->db->where('YEAR(olive_kasir.transaksi_layanan.tanggal_transaksi)', $tahun_ketiga);  
          $this->db->where('olive_kasir.transaksi_layanan.kode_member', $get_member_kedua->kode_member);
          $this->db->group_by('olive_kasir.transaksi_layanan.kode_member');
          $get_member_ketiga = $this->db->get()->row();

          if (count($get_member_ketiga) > 0) { ?>
          <tr>
            <td><?= BulanIndo($bulan) ?> - <?= BulanIndo($bulan_ketiga) ?></td>
            <td><?= $get_member_ketiga->kode_member ?></td>
            <td><?= $get_member_ketiga->nama_member ?></td>
          </tr>
          <?php }
        } 
      } ?>
    </tbody>                
  </table>
  <div class="row">
    <div class="col-md-2 pull-right">
      <button style="margin-left: 5px" type="button" onclick="cetak_member_retention('<?= $data['tanggal_awal'] ?>')" class="btn btn-info pull-right"><i class="fa fa-print"></i> Print</button>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('#datatable').dataTable();
  $('#datatable-keytable').DataTable( { keys: true } );
  $('#datatable-responsive').DataTable();
  $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
  var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
  $('.select2').select2();
});

</script>