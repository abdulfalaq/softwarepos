<!-- back button -->
<a href="<?php echo base_url('retur/tambah_retur/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url('retur'); ?>">Retur</a></li>
    <li><a href="#">Data Retur</a></li>
    <li></li>
  </ol>
</div>

<div class="clearfix"></div>

<div class="container">
  <?php $this->load->view('menu_setting'); ?>

  <div class="clearfix"></div>
 <?php 
  $kode_retur=$this->uri->segment(4);
  $this->db->where('kode_retur',$kode_retur);
  $this->db->from('clouoid1_olive_gudang.transaksi_retur');
  $this->db->join('clouoid1_olive_gudang.transaksi_pembelian', 'clouoid1_olive_gudang.transaksi_retur.kode_pembelian = clouoid1_olive_gudang.transaksi_pembelian.kode_pembelian', 'left');
  $this->db->join('clouoid1_olive_master.master_supplier', 'clouoid1_olive_gudang.transaksi_retur.kode_supplier = clouoid1_olive_master.master_supplier.kode_supplier', 'left');
  $get_retur = $this->db->get()->row();
  ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading text-right">
          <span class="pull-left" style="font-size: 24px">Data Retur Pembelian</span>
          <br><br>
        </div>
        <div class="panel-body">
         <form id="data_form" action="" method="post">
          <div class="box-body">
             <label><h3><b>Retur Pembelian</b></h3></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kode Transaksi Retur</label>
                  <input type="text" value="<?php echo @$get_retur->kode_retur?>" class="form-control" placeholder="Kode Transaksi" name="kode_retur" id="kode_retur" readonly/>
                </div>
                <div class="form-group">
                  <label class="gedhi">Tanggal Transaksi</label>
                  <input type="text" readonly value="<?php echo @TanggalIndo($get_retur->tanggal_retur_keluar);?>" class="form-control " placeholder="Tanggal Transaksi" name="tanggal_retur_keluar" id="tanggal_retur_keluar"/>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Nota Referensi</label>
                  <input type="text" class="form-control" value="<?php echo @$get_retur->nomor_nota?>" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" readonly/>
                  <input type="hidden" class="form-control" placeholder="Nota Referensi" name="kode_pembelian" id="kode_pembelian" readonly/>
                </div>
                <div class="form-group">
                  <label>Supplier</label>
                  <input type="text" class="form-control" value="<?php echo @$get_retur->nama_supplier?>" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" readonly/>
                </div>
              </div>
            </div>
          </div> 
          <?php 

          $this->db->where('kode_retur',$kode_retur);
          $this->db->order_by('id','DESC');
          $this->db->select('nama');
          $this->db->select('nama_bahan_baku');
          $this->db->select('nama_perlengkapan');
          $this->db->select('nama_produk');
          $this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur.id');
          $this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur.jumlah');
          $this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur.harga_satuan');
          $this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur.subtotal');
          $this->db->select('clouoid1_olive_gudang.opsi_transaksi_retur.kategori_bahan');

          $this->db->from('clouoid1_olive_gudang.opsi_transaksi_retur');
          $this->db->join('clouoid1_olive_master.master_bahan_baku', 'clouoid1_olive_gudang.opsi_transaksi_retur.kode_bahan = clouoid1_olive_master.master_bahan_baku.kode_bahan_baku', 'left');
          $this->db->join('clouoid1_olive_master.master_perlengkapan', 'clouoid1_olive_gudang.opsi_transaksi_retur.kode_bahan = clouoid1_olive_master.master_perlengkapan.kode_perlengkapan', 'left');
          $this->db->join('clouoid1_olive_master.master_produk', 'clouoid1_olive_gudang.opsi_transaksi_retur.kode_bahan = clouoid1_olive_master.master_produk.kode_produk', 'left');
          $this->db->join('clouoid1_olive_master.master_satuan', 'clouoid1_olive_gudang.opsi_transaksi_retur.kode_satuan = clouoid1_olive_master.master_satuan.kode', 'left');
          $get_temp=$this->db->get()->result();
          ?>
          <div id="list_retur_pembelian">
            <div class="box-body">
              <label><h3><b>Item Retur Pembelian</b></h3></label>

              <table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>QTY</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>

                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 0;
                  foreach ($get_temp as $value) { 
                    $no++; ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td>
                        <?php 
                        if(@$value->kategori_bahan=='bahan baku'){
                          echo @$value->nama_bahan_baku;
                        }elseif (@$value->kategori_bahan=='produk') {
                          echo @$value->nama_produk;
                        }elseif (@$value->kategori_bahan=='perlengkapan') {
                          echo @$value->nama_perlengkapan;
                        }
                        ?>  
                      </td>
                      <td><?= $value->jumlah ?> </td>
                      <td><?= format_rupiah($value->harga_satuan) ?></td>
                      <td><?= format_rupiah($value->subtotal) ?></td>

                    </tr>
                    <?php 
                  } 
                  ?>

                  <tr>
                    <td colspan="3"></td>
                    <td style="font-weight:bold;">Total</td>
                    <td><?php echo format_rupiah (@$get_retur->total_nominal)?></td>

                  </tr>

                  <tr>
                    <td colspan="3"></td>
                    <td style="font-weight:bold;">Grand Total</td>
                    <td><?php echo format_rupiah (@$get_retur->grand_total)?></td>

                  </tr>
                </tbody>
                <tfoot>
                </tfoot>

              </table>
            </div>
          </div>

          <br>
          <hr>
          <div class="box-footer clearfix">

          </div>

        </form>

      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


