<!-- back button -->
<a href="<?php echo base_url('retur/tambah_retur/daftar'); ?>"><button class="button-back"></button></a>
<!-- //back button -->

<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url('retur'); ?>">Retur</a></li>
    <li><a href="#">Edit Retur</a></li>
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
  $this->db->from('olive_gudang.transaksi_retur');
  $this->db->join('olive_gudang.transaksi_pembelian', 'olive_gudang.transaksi_retur.kode_pembelian = olive_gudang.transaksi_pembelian.kode_pembelian', 'left');
  $this->db->join('olive_master.master_supplier', 'olive_gudang.transaksi_retur.kode_supplier = olive_master.master_supplier.kode_supplier', 'left');
  $get_retur = $this->db->get()->row();
  ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading text-right">
          <span class="pull-left" style="font-size: 24px">Edit Retur Pembelian</span>
          <br><br>
        </div>
        <div class="panel-body">
          <div class="box-body">
            <label><h3><b>Retur Pembelian</b></h3></label>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kode Transaksi Retur</label>
                  <input type="text" value="<?php echo @$get_retur->kode_retur?>" class="form-control" placeholder="Kode Transaksi" name="kode_retur" id="kode_retur" readonly/>
                  <input type="hidden" value="<?php echo @$get_retur->kode_pembelian?>" class="form-control" placeholder="Kode Transaksi" name="kode_retur" id="kode_retur" readonly/>
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
          $this->db->select('olive_gudang.opsi_transaksi_retur.id');
          $this->db->select('olive_gudang.opsi_transaksi_retur.jumlah');
          $this->db->select('olive_gudang.opsi_transaksi_retur.harga_satuan');
          $this->db->select('olive_gudang.opsi_transaksi_retur.subtotal');
          $this->db->select('olive_gudang.opsi_transaksi_retur.kategori_bahan');

          $this->db->from('olive_gudang.opsi_transaksi_retur');
          $this->db->join('olive_master.master_bahan_baku', 'olive_gudang.opsi_transaksi_retur.kode_bahan = olive_master.master_bahan_baku.kode_bahan_baku', 'left');
          $this->db->join('olive_master.master_perlengkapan', 'olive_gudang.opsi_transaksi_retur.kode_bahan = olive_master.master_perlengkapan.kode_perlengkapan', 'left');
          $this->db->join('olive_master.master_produk', 'olive_gudang.opsi_transaksi_retur.kode_bahan = olive_master.master_produk.kode_produk', 'left');
          $this->db->join('olive_master.master_satuan', 'olive_gudang.opsi_transaksi_retur.kode_satuan = olive_master.master_satuan.kode', 'left');
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
          <label><h3><b>Input Retur</b></h3></label>
          <div class="sukses" ></div>
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="col-xs-2" >
                  <label>Jenis Bahan</label>
                  <select class="form-control" id="kategori_bahan" name="kategori_bahan">
                    <option value="">--PILIH JENIS </option>
                    <option value="perlengkapan">Perlengkapan</option>
                    <option value="bahan baku">Bahan</option>
                    <option value="produk">Produk</option>
                  </select>
                  <input type="hidden" name="kode_barang" id="kode_barang" value="">
                </div>
                <div class="col-xs-2">
                  <label>Nama Bahan</label>
                  <select name="kode_bahan" id="kode_bahan" class="form-control">
                    <option>-- Pilih --</option>

                  </select>
                </div>

                <div class="col-xs-1">
                  <label>Jumlah</label>
                  <input type="text" class="form-control" placeholder="0" name="jumlah" id="jumlah"/>
                </div>
                <div class="col-xs-2">
                  <label>Harga </label>
                  <input type="text" class="form-control" placeholder="0" name="harga" id="harga" />
                  <input type="hidden" name="kode_satuan" id="kode_satuan" />
                </div>
                <div class="col-xs-2 sec_expdate">
                  <label>Exp Date</label>
                  <input type="date" name="expired_date" id="expired_date" class="form-control">
                </div>
                <div class="col-xs-2">
                  <label>Subtotal</label>
                  <input type="text" readonly="true" class="form-control" placeholder="Sub Total" name="sub_total" id="sub_total" />
                  <input type="hidden" name="id_item" id="id_item" />
                </div>
                <div class="col-xs-1" style="padding:auto 0px;">
                  <label>&nbsp;</label>
                  <a onclick="add_item()" id="add" style="margin-top: 25px;" class="btn btn-primary">Add</a>
                  <a onclick="update_item()" id="update" style="margin-top: 25px;" class="btn btn-warning pull-left">Update</a>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div id="list_transaksi_pembelian">
            <div class="box-body">
              <table id="tabel_daftar" class="table table-bordered table-striped" style="font-size:1.0em;">
                <thead>
                  <tr>
                    <th>No</th>

                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Exp.Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="tabel_temp_data_transaksi">

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
<script type="text/javascript">
  $(document).ready(function(){
    $("#update").hide();
    $('.sec_expdate').hide();
    load_temp();
  });
  function setValZero()
  {
    $('#jumlah').val('0');
    $('#harga').val('0');
    $('#sub_total').val('0');
    $('#diskon_item').val('0');
  }
  $('#kategori_bahan').change(function(){
    var kategori_bahan = $('#kategori_bahan').val();

    if(kategori_bahan == "bahan baku"){
      $('.sec_expdate').show();
    }
    else if(kategori_bahan == "produk"){
      $('.sec_expdate').show();
    }else if(kategori_bahan == "perlengkapan"){
      $('.sec_expdate').hide();
    }else{
      $('.sec_expdate').hide();
    }

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('retur/tambah_retur/get_bahan');?>",
      data: {
        kategori_bahan:kategori_bahan,
      },
      success: function(msg) {
        $('#kode_bahan').html(msg);
      }
    });

    setValZero();
  });
  $('#kode_bahan').change(function(){
    var kategori_bahan = $('#kategori_bahan').val();
    var kode_bahan = $('#kode_bahan').val();
    var url = "<?php echo base_url('retur/tambah_retur/get_satuan');?>";
    $.ajax({
      type: "POST",
      url: url,
      dataType: 'json',
      data: {
        kategori_bahan:kategori_bahan,kode_bahan:kode_bahan,
      },
      success: function(msg) {
        $('#satuan_stok').val(msg.nama);
        $('#kode_satuan').val(msg.kode_satuan_stok);
      }
    });
  });
  $("#jumlah").keyup(function(){
    var harga = parseInt($('#harga').val());
    var jumlah = parseInt($('#jumlah').val());
    if(jumlah < 0  ){
      alert("Jumlah Salah");
      $('#jumlah').val('');
    }else{
      pembelian=jumlah*harga;
      $("#sub_total").val(pembelian);
    }
  });
  $("#harga").keyup(function(){
    var harga = parseInt($('#harga').val());
    var jumlah = parseInt($('#jumlah').val());
    if(harga < 0  ){
      alert("Harga Salah");
      $('#harga').val('');
    }else{
      pembelian=jumlah*harga;
      $("#sub_total").val(pembelian);
    }

  });

  function load_temp(){
    var kode_retur = $('#kode_retur').val();
    $("#tabel_temp_data_transaksi").load("<?php echo base_url(); ?>retur/tambah_retur/get_table_input_retur/"+kode_retur);
  }
  function add_item(){
    var kode_retur = $('#kode_retur').val();
    var nomor_nota = $('#nomor_nota').val();
    var kode_supplier = $('#kode_supplier').val();
    var kode_bahan = $('#kode_bahan').val();
    var jumlah = $('#jumlah').val();

    var url = "<?php echo base_url(); ?>retur/tambah_retur/add_item_temp/ ";
    if(kode_bahan == '' || jumlah == ''){
      $(".sukses").html('<div class="alert alert-danger">Silahkan Lengkapi Form</div>');   
      setTimeout(function(){
        $('.sukses').html('');     
      },3000);
    }
    else{
      $.ajax({
        type: "POST",
        url: url,
        data: {
          kategori_bahan:$('#kategori_bahan').val(),
          kode_bahan:$('#kode_bahan').val(),
          kode_satuan:$('#kode_satuan').val(),
          kode_retur:$('#kode_retur').val(),
          jumlah:$('#jumlah').val(),
          harga:$('#harga').val(),
          jenis_diskon_item:$('#jenis_diskon_item').val(),
          diskon_item:$('#diskon_item').val(),
          sub_total:$('#sub_total').val(),
          expired_date:$('#expired_date').val()
        },
        beforeSend:function(){
          $(".tunggu").show();  
        },
        success: function(data)
        {
          $(".tunggu").hide();
          load_temp();

          if(data==1){
            $(".sukses").html('<div class="alert alert-danger">Item Telah Tersedia</div>');
            setTimeout(function(){$('.sukses').html('');},1800); 
          }else{
            $('.sukses').html('');     
            setValZero();
            $('#kode_bahan').val('');
            $('#kategori_bahan').val('');
            $('#jumlah').val('');
            $('#expired_date').val('');
            $("#harga").val('');
            $("#satuan_stok").val('');
            $("#diskon_item").val('');

            $('#sub_total').val('');
            $("#kode_satuan").val(''); 
            $("#nama_satuan").val(''); 

          }
        }
      });
    }
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
        load_temp();
      }
    });
    return false;
  }
  function actEdit(id) {
    $('#kategori_bahan').attr('disabled','disabled');
    var id = id;
    var kode_pembelian = $('#kode_pembelian').val();
    var url = "<?php echo base_url(); ?>retur/tambah_retur/get_temp_retur";
    $.ajax({
      type: 'POST',
      url: url,
      dataType: 'json',
      data: {id:id},
      success: function(pembelian){
        $("#add").hide();
        $("#update").show();

        $('#kategori_bahan').val(pembelian.kategori_bahan);
        if(pembelian.kategori_bahan=='bahan baku'){
          $('.sec_expdate').show();

          $('#kode_bahan').html('<option value="'+pembelian.kode_bahan+' selected">'+pembelian.nama_bahan_baku+'</option>');
        }else if(pembelian.kategori_bahan=='produk'){
          $('.sec_expdate').show();
          $('#kode_bahan').html('<option value="'+pembelian.kode_bahan+' selected">'+pembelian.nama_produk+'</option>');
        }else if(pembelian.kategori_bahan=='perlengkapan'){
          $('.sec_expdate').hide();
          $('#kode_bahan').html('<option value="'+pembelian.kode_bahan+' selected">'+pembelian.nama_perlengkapan+'</option>');
        }
        $('#jumlah').val(pembelian.jumlah);
        $('#kode_satuan').val(pembelian.kode_satuan);
        $("#nama_satuan").val(pembelian.nama);
        $('#harga').val(pembelian.harga_satuan);
        $('#diskon_item').val(pembelian.diskon_item);
        $('#jenis_diskon_item').val(pembelian.jenis_diskon);
        $('#sub_total').val(pembelian.subtotal);
        $('#expired_date').val(pembelian.expired_date);
        $('#satuan_stok').val(pembelian.nama);
        $('#sub_total').val(pembelian.subtotal);
        $("#id_item").val(pembelian.id);

        $('.sec_expdate').val(pembelian.expired_date);

        $('#nama_barang').show();
        $('#nama_barang').val(pembelian.nama_bahan);
        $('.pilih select').hide();

        if(pembelian.kategori_bahan == "bahan_baku"){
          $('.sec_expdate').show();
        }
        document.getElementById('kode_bahan').disabled = true;
      }
    });
  }
  function update_item(){
    $('#kategori_bahan').removeAttr('disabled');
    $('#kode_perlengkapan').removeAttr('disabled');
    var kode_retur = $('#kode_retur').val();
    var kategori_bahan = $('#kategori_bahan').val();
    var diskon = $('#diskon_item').val();
    var kode_bahan = $('#kode_bahan').val();
    var jumlah = $('#jumlah').val();
    var expired_date = $('#expired_date').val();
    var kode_satuan = $('#kode_satuan').val();
    var nama_satuan = $("#nama_satuan").val();
    var harga_satuan = $('#harga').val();
    var subtotal = $("#sub_total").val();
    var jenis_diskon = $("#jenis_diskon_item").val();
    var id_item = $("#id_item").val();

    var url = "<?php echo base_url(); ?>retur/tambah_retur/update_item_input/ ";

    $.ajax({
      type: "POST",
      url: url,
      data: { 
        expired_date:expired_date,
        kode_retur:kode_retur,
        kategori_bahan:kategori_bahan,
        kode_bahan:kode_bahan,
        jumlah:jumlah,
        kode_satuan:kode_satuan,
        nama_satuan:nama_satuan,
        harga_satuan:harga_satuan,
        diskon_item:diskon,
        jenis_diskon:jenis_diskon,
        subtotal:subtotal,
        id:id_item
      },
      success: function(data)
      {
        document.getElementById('kode_bahan').disabled = false;

        setValZero();
        $('#kode_bahan').val('');
        $('#kategori_bahan').val('');
        $('#jumlah').val('');
        $('#expired_date').val('');
        $("#harga").val('');
        $("#satuan_stok").val('');
        $("#diskon_item").val('');

        $('#sub_total').val('');
        $("#kode_satuan").val(''); 
        $("#nama_satuan").val(''); 
        $('.sec_expdate').hide();
        $("#add").show();
        $("#update").hide();
        load_temp();
      }
    });
  }

  function simpan_retur(){
    var kode_pembelian = $('#kode_pembelian').val();
    var kode_retur = $('#kode_retur').val();
    
    var url = "<?php echo base_url(); ?>retur/tambah_retur/simpan_input_retur/ ";

    $.ajax({
      type: "POST",
      url: url,
      data: { 
        kode_pembelian:kode_pembelian,
        kode_retur:kode_retur,
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