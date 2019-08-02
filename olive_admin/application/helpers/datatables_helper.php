<?php 
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function get_edit_hapus($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="edit/'.$id.'" key="'.$id.'" class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i></a>
    <a onclick="actDelete(\''.$id.'\')" class="btn btn-no-radius btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></a>
    </div>

    ';
    
    return $html;



   /* $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;*/
}

function get_detail_stok_new($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail_stok/'.$id.'" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-eye"></i></a>

    </div>
    ';
    
    return $html;



   /* $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;*/
}
function get_edit_delete($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    
    <a onclick="actEdit(\''.$id.'\')"  class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i></a>
    <a onclick="actDelete(\''.$id.'\')" class="btn btn-no-radius btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></a>
    </div>
    ';
    
    return $html;
}
function get_del_id_temp($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    
    <a style="padding:4px;height: 34px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-icon-only btn-circle red"><i class="fa fa-trash"></i></a>
    </div>
    ';
    
    return $html;
}
function get_validasi($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="validasi/'.$uri.'/'.$id.'" data-toggle="tooltip" title="Validasi" class="btn btn-xs green"><i class="fa fa-check-square-o"></i>  Validasi</a>
    </div>
    ';
    
    return $html;
}
function get_detail_validasi($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="validasi/'.$id.'" data-toggle="tooltip" title="Validasi" class="btn btn-xs green"><i class="fa fa-check-square-o"></i> Validasi</a>
    </div>
    ';
    
    return $html;
}

function get_url_detail_edit_delete($url,$id){
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail_'.$url.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    <a href="'.$url.'/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
    <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" class="btn btn-icon waves-effect btn-no-radius waves-light btn-success m-b-5"><i class="fa fa-eye"></i></a>
    <a href="edit/'.$id.'" key="'.$id.'" class="btn btn-icon waves-effect btn-no-radius waves-light btn-warning m-b-5"><i class="fa fa-pencil"></i></a>
    <a onclick="actDelete(\''.$id.'\')" class="btn btn-no-radius btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></a>
    </div>

    ';
    
    return $html;



   /* $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;*/
}
function ambil_bonus($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" class="btn btn-warning">Ambil Bonus</a>
    </div>
    ';
    
    return $html;
}

function get_del_id($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete_master_keu($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail_'.$uri.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    <a href="tambah_'.$uri.'/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
    <a style="padding:3.5px;" onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete_keu($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail_'.$uri.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit_delete_string($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i></a>
    <a href="tambah/'.$id.'" key="'.$id.'" id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"></i></a>
    <a onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Delete" class="btn btn-icon-only btn-circle red"><i class="fa fa-remove"></i></a>
    </div>
    ';
    
    return $html;


  /*  $ci =& get_instance();

    $html = '
    <div class="btn-group">
        <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a  onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;*/
}

function get_detail_edit_delete_reservasi($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    
    <a href="detail_reservasi/'.$id.'" id="detail" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i></a>
    
    <a onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Cancel" class="btn btn-icon-only btn-circle red"><i class="fa fa-remove"></i></a>
    </div>
    ';
    
    return $html;
    
    /*$ci =& get_instance();
<a href="reservasi/'.$id.'" key="'.$id.'" hidden id="ubah" data-toggle="tooltip" title="Edit" class="btn btn-icon-only btn-circle yellow"><i class="fa fa-pencil"></i></a>
    $html = '
    <div class="btn-group">
        <a href="detail_reservasi/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
        <a href="reservasi/'.$id.'/edit" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
        <a style="padding:3.5px;" onclick="actDelete(\''.$id.'\')" data-toggle="tooltip" title="Cancel" class="btn btn-xs red"><i class="fa fa-trash"> cancel</i></a>
    </div>
    ';
    
    return $html;*/
}

function get_detail_edit_delete_string_bj($kode_unit,$kode_rak,$id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$kode_unit.'/'.$kode_rak.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    <a href="tambah/'.$kode_unit.'/'.$kode_rak.'/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
    <a style="padding:3.5px;" onclick="actDelete(\''.$id."|".$kode_unit."|".$kode_rak.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_detail_edit($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    <a href="tambah/'.$id.'" data-toggle="tooltip" title="Edit" class="btn btn-xs yellow"><i class="fa fa-pencil"></i> edit</a>
    </div>
    ';
    
    return $html;
}

function cek_status($id)
{
    if($id=='1')
        return '<span class="label label-info">AKTIF</span>';
    else 
        return '<span class="label label-danger">NON AKTIF</span>';
}

function cek_status_piutang($id)
{
    if($id!='0')
        return '<span class="label label-warning">Angsuran</span>';
    else 
        return '<span class="label label-success">Lunas</span>';
}

function get_edit_del($id,$kode)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="actEdit('.$id.')" data-toggle="tooltip" title="Edit" class="btn purple btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</a>
    <a style="padding:3.5px;" onclick="actDelete('.$id.',\''.$kode.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_edit_del_bj($id,$kode_unit,$kode_rak,$kode_bahan_jadi)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="actEdit('.$id.')" data-toggle="tooltip" title="Edit" class="btn purple btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</a>
    <a style="padding:3.5px;" onclick="actDelete('.$id.',\''.$kode_unit.'\',\''.$kode_rak.'\',\''.$kode_bahan_jadi.'\')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_edit_del_id($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a onclick="actEdit('.$id.')" data-toggle="tooltip" title="Edit" class="btn purple btn-xs btn-default"><i class="fa fa-pencil"></i> Edit</a>
    <a onclick="actDelete('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}

function get_del_temp($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a style="padding:3.5px;" onclick="actDeleteTemp('.$id.')" data-toggle="tooltip" title="Delete" class="btn btn-xs red"><i class="fa fa-trash"> delete</i></a>
    </div>
    ';
    
    return $html;
}


function get_detail($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
    </div>
    ';
    
    return $html;
}

function get_detail_laporan($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail_laporan/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-icon-only btn-circle green"><i class="fa fa-search"></i> </a>
    </div>
    ';
    
    return $html;
}

function get_detail_persediaan($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail_stok/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_print($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> Detail</a>
    <a href="print_po/'.$id.'" target="_blank" data-toggle="tooltip" title="Print" class="btn btn-xs blue"><i class="fa fa-print"></i> Print</a>
    </div>
    ';
    
    return $html;
}


function get_detail_mutasi($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail_mutasi/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_stok($kode_unit, $kode_rak ,$kode_bahan)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="../detail/'.$kode_unit.'/'.$kode_rak.'/'.$kode_bahan.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_validasi_opname($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="../validasi_opname/'.$uri.'/'.$id.'" data-toggle="tooltip" title="Validasi" class="btn btn-xs green"><i class="fa fa-check-square-o"></i>  Validasi</a>
    </div>
    ';
    
    return $html;
}

function get_detail_spoil($uri, $id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="../detail_spoil/'.$uri.'/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs green"><i class="fa fa-search"></i> detail</a>
    </div>
    ';
    
    return $html;
}

function get_detail_proses($id)
{
    $ci =& get_instance();

    $html = '
    <div class="btn-group">
    <a href="detail/'.$id.'" data-toggle="tooltip" title="Detail" class="btn btn-xs blue"><i class="fa fa-search"></i> detail</a>
    <a href="proses/'.$id.'" data-toggle="tooltip" title="Proses" class="btn btn-xs green"><i class="fa fa-pencil"></i> proses</a>
    </div>
    ';
    
    return $html;
}

function cek_status_retur($status)
{
    if($status=='menunggu'){
        return '<div class="btn btn-xs red">'.$status.'</div>';
    }
    else {
        return '<div class="btn btn-xs green">'.$status.'</div>';
    }
}

function cek_status_meja($id)
{
    if($id==0)
        return '<span class="label label-success">Kosong</span>';
    else 
        return '<span class="label label-danger">Terpakai</span>';
}


?>