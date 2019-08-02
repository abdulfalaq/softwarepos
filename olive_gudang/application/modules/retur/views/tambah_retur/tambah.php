<!-- back button -->
<a href="<?php echo base_url('retur'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url('master'); ?>">Retur</a></li>
    <li><a href="#">Tambah Retur</a></li>
    <li></li>
  </ol>
</div>

<div class="clearfix"></div>

<div class="container">
  <?php $this->load->view('menu_setting'); ?>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading text-right">
          <span class="pull-left" style="font-size: 24px">Retur Pembelian</span>
          <br><br>
        </div>
        <div class="panel-body">
          <div class="col-md-12 row">

            <div class="box-body">
              <label><h3><b>Retur Pembelian</b></h3></label>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Kode Transaksi Retur</label>
                    <input type="text" value="<?php echo 'RET_'.date('ymdHis')?>" class="form-control" placeholder="Kode Transaksi" name="kode_retur" id="kode_retur" readonly/>
                  </div>
                  <div class="form-group">
                    <label class="gedhi">Tanggal Transaksi</label>
                    <input type="text" readonly value="<?php echo TanggalIndo(date('Y-m-d'))?>" class="form-control " />
                    <input type="hidden" readonly value="<?php echo date('Y-m-d')?>" class="form-control " placeholder="Tanggal Transaksi" name="tanggal_retur_keluar" id="tanggal_retur_keluar"/>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nota Referensi</label>
                    <input type="text" class="form-control" placeholder="Nota Referensi" name="nomor_nota" id="nomor_nota" readonly/>
                    <input type="hidden" class="form-control" placeholder="Nota Referensi" name="kode_pembelian" id="kode_pembelian" readonly/>
                  </div>
                  <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" class="form-control" placeholder="" name="nama_supplier" id="nama_supplier" readonly/>
                    <input type="hidden" class="form-control" placeholder="" name="kode_supplier" id="kode_supplier" readonly/>
                  </div>
                </div>
              </div>
            </div> 

            <div class="sukses" ></div>
            <div class="gagal" ></div>
            <div class="box-body">
              <label><h3><b>Item Retur Pembelian</b></h3></label>
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-2">
                    <label>Jenis Barang</label>
                    <input type="text" name="kategori_bahan" id='kategori_bahan' class="form-control" readonly="">
                  </div> 

                  <div class="col-md-2">
                    <label>Nama </label>
                    <input type="text" name="nama_bahan" id='nama_bahan' class="form-control" readonly="">
                    <input type="hidden" name="kode_bahan" id='kode_bahan' class="form-control" readonly="">
                  </div>

                  <div class="col-md-2">
                    <label>QTY</label>
                    <input type="number" class="form-control" placeholder="QTY" name="jumlah" id="jumlah" />
                  </div>
                  <div class="col-md-2">
                    <label>Satuan</label>
                    <input type="text" class="form-control" placeholder="Satuan Stok" name="nama_satuan" id="nama_satuan" readonly/>
                    <input type="hidden" name="kode_satuan" id="kode_satuan" />
                  </div>
                  <div class="col-md-2">
                    <label>Harga Satuan</label>
                    <input type="text" class="form-control" placeholder="Harga Satuan" name="harga_satuan" id="harga_satuan" readonly/>
                  </div>
                  <div class="col-md-2" style="padding:25px; display:none;" id="add_item">
                    <div onclick="add_item()"  class="btn btn-primary">Add</div>
                  </div>
                  <div class="col-md-2" style="padding:25px;" id="update_item">
                    <div onclick="update_item()"  class="btn btn-primary">Update</div>
                    <input type="hidden" name="id_item" id="id_item" />
                  </div>
                </div>
              </div>
            </div>

            <div id="list_retur_pembelian">
              <div class="box-body">
                <table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>QTY</th>
                      <th>Harga Satuan</th>
                      <th>Subtotal</th>
                      <th width="100px">Action</th>
                    </tr>
                  </thead>
                  <tbody id="tabel_temp_data_retur">

                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
            </div>
            <button onclick="simpan_retur()" class="btn btn-success pull-right">Simpan</button>
            <div class="box-footer clearfix">
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="modal-confirm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:grey">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#fff;">Konfirmasi Hapus Data</h4>
        </div>
        <div class="modal-body">
          <span style="font-weight:bold; font-size:14pt">Apakah anda yakin akan menghapus pembelian bahan tersebut ?</span>
          <input id="id-delete" type="hidden">
        </div>
        <div class="modal-footer" style="background-color:#eee">
          <button class="btn red" data-dismiss="modal" aria-hidden="true">Tidak</button>
          <button onclick="delData()" class="btn green">Ya</button>
        </div>
      </div>
    </div>
  </div>

  <div id="modal-regular" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header" style="background-color:grey">
          <button type="button" class="close" onclick="" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title" style="color:#fff;">Transaksi Retur</h4>
        </div>
        <div class="modal-body" >
          <div class="form-body">

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Kode Pembelian</label>
                  <input type="text" id="cari_kode_pembelian" name="cari_kode_pembelian" class="form-control" placeholder="Masukkan Kode Pembelian" required="">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="gagal" ></div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer" style="background-color:#eee">
          <button onclick="cancel()" class="btn blue" data-dismiss="modal" aria-hidden="true">Cancel</button>
          <button class="btn green" onclick="cari_pembelian()">Cari</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    begin();
    $("#update_pembelian").hide();
    $("#bahan_baku").hide();
    $("#peralatan").hide();
    $("#form_expired").hide();
    $(".tgl").datepicker();
    $('#update_item').show();
  });

  function begin(){
    $('#modal-regular').modal('show'); 
  }

  function cancel(){
    window.location = "<?php echo base_url('retur/tambah_retur/daftar') ?>";
  }
  
  function load_list_temp(){
    var kode_retur = $('#kode_retur').val();
    $('#tabel_temp_data_retur').load("<?php echo base_url('retur/tambah_retur/tabel_temp_data_retur') ?>");
  }
  function cari_pembelian(){
    var cari_kode_pembelian = $('#cari_kode_pembelian').val();
    var kode_retur = $('#kode_retur').val();

    $.ajax({
      type: "POST",
      url: '<?php echo base_url().'retur/tambah_retur/cari_kode_pembelian/'?>',
      data: {cari_kode_pembelian:cari_kode_pembelian, kode_retur:kode_retur},
      dataType:'json',
      success: function(msg)
      {
        if(msg.respon=='kosong'){
          alert('Kode Pembelian Tidak Ditemukan !');
        }else{
          $('#modal-regular').modal('hide'); 
          $('#nomor_nota').val(msg.nomor_nota);
          $('#kode_pembelian').val(msg.kode_pembelian);
          $('#kode_supplier').val(msg.kode_supplier);
          $('#nama_supplier').val(msg.nama_supplier);
          load_list_temp();
        }
      },
    });
  }
  function actDelete(id) {
    $('#id-delete').val(id);
    $('#modal-confirm').modal('show');
  }
  function delData() {
    var id = $('#id-delete').val();
    var kode_pembelian = $('#kode_pembelian').val();
    var url = '<?php echo base_url(); ?>retur/tambah_retur/hapus_bahan_temp/';
    $.ajax({
      type: "POST",
      url: url,
      data: {
        id:id
      },
      beforeSend:function(){
        $(".tunggu").show();  
      },
      success: function(msg) {
        $('#modal-confirm').modal('hide');
        $(".tunggu").hide();
        load_list_temp();
      }
    });
    return false;
  }
  function actEdit(id) {
    var id = id;
    var url = "<?php echo base_url(); ?>retur/tambah_retur/get_temp_retur";
    $.ajax({
      type: 'POST',
      url: url,
      dataType: 'json',
      data: {id:id},
      success: function(pembelian){
        $('#kategori_bahan').val(pembelian.kategori_bahan);
        $('#kode_bahan').val(pembelian.kode_bahan);

        if(pembelian.kategori_bahan=='bahan baku'){
          $('#nama_bahan').val(pembelian.nama_bahan_baku);
        }else if(pembelian.kategori_bahan=='produk'){
          $('#nama_bahan').val(pembelian.nama_produk);
        }else if(pembelian.kategori_bahan=='perlengkapan'){
          $('#nama_bahan').val(pembelian.nama_perlengkapan);
        }
        $('#nama_satuan').val(pembelian.nama);
        $('#kode_satuan').val(pembelian.kode_satuan);
        $('#harga_satuan').val(pembelian.harga_satuan);
        $('#jumlah').val(pembelian.jumlah);
        $("#id_item").val(pembelian.id);
      }
    });
  }
  function update_item(){
    var kode_pembelian = $('#kode_pembelian').val();
    var kode_bahan = $('#kode_bahan').val();
    var jumlah = $('#jumlah').val();
    var harga_satuan = $('#harga_satuan').val();
    var id_item = $("#id_item").val();

    var url = "<?php echo base_url(); ?>retur/tambah_retur/update_item/ ";

    $.ajax({
      type: "POST",
      url: url,
      data: { 
        kode_pembelian:kode_pembelian,
        kode_bahan:kode_bahan,
        jumlah:jumlah,
        harga_satuan:harga_satuan,
        id:id_item
      },
      dataType:'json',
      success: function(data)
      {
        if(data.respon=='gagal'){
          $('.sukses').html('<div class="alert alert-danger">Jumlah Melebihi Pembelian </div>');
          setTimeout(function(){$('.sukses').html('');},1500); 
        }else{
          $('#kategori_bahan').val('');
          $('#kode_bahan').val('');
          $('#nama_bahan').val('');
          $('#nama_satuan').val('');
          $('#kode_satuan').val('');
          $('#harga_satuan').val('');
          $('#jumlah').val('');
          $("#id_item").val('');

          load_list_temp();
        }
      }
    });
  }
  function simpan_retur(){
    var kode_pembelian = $('#kode_pembelian').val();
    var kode_retur = $('#kode_retur').val();
    var nomor_nota = $('#nomor_nota').val();
    var kode_supplier = $('#kode_supplier').val();
    
    var url = "<?php echo base_url(); ?>retur/tambah_retur/simpan_retur/ ";

    $.ajax({
      type: "POST",
      url: url,
      data: { 
        kode_pembelian:kode_pembelian,
        kode_retur:kode_retur,
        nomor_nota:nomor_nota,
        kode_supplier:kode_supplier,
        
      },
      dataType:'json',
      beforeSend:function(){
        $(".tunggu").show();  
      },
      success: function(data)
      {
        $(".tunggu").hide();  
        if(data.respon=='gagal'){
          $('.sukses').html('<div class="alert alert-danger">Gagal Melakukan Retur </div>');
          setTimeout(function(){$('.sukses').html('');},1500); 
        }else{
          $(".alert_berhasil").show();  
          setTimeout(function(){ window.location="<?php echo base_url(); ?>retur/tambah_retur/daftar"},1000); 
        }
      }
    });
  }
</script>


