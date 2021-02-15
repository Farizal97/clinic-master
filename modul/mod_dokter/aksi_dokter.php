<?php
session_start();
if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo "<link href='http://fonts.googleapis.com/css?family=Creepster|Audiowide' rel='stylesheet' type='text/css'>
        <link href=\"css/error.css\" rel='stylesheet' type=\"text/css\" />
<p class=\"error-code\">
    404
</p>

<p class=\"not-found\">Not<br/>Found</p>

<div class=\"clear\"></div>
<div class=\"content\">
    The page your are looking for is not found.
    <br>
    <a href=\"index.php\">Go Back</a>
    or
    <br>
    <br>
</div>";
}
else{
    include "../../config/inc.connection.php";
    include "../../config/inc.library.php";
    
    $module = $_GET['module'];
    $act = $_GET['act'];
    
    if($module=='dokter' AND $act=='hapus'){
        $delete = "DELETE FROM dokter WHERE kd_dokter = '$_GET[kd_dokter]'";
        mysql_query($delete, $koneksidb);
        header("location:../../media.php?module=".$module);
    }
    elseif($module=='dokter' AND $act=='input'){
        $nm_dokter = $_POST['nm_dokter'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $sip  = $_POST['sip'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $spesialisasi = $_POST['spesialisasi'];
        $jenis_kelamin = $_POST['spesialisasi'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $bagi_hasil = $_POST['bagi_hasil'];
        $kodeBaru = buatKode("dokter", "D"); 
        
        $input ="INSERT dokter SET kd_dokter = '$kodeBaru',
                                   nm_dokter = '$nm_dokter', 
                                   alamat = '$alamat', 
                                   no_telepon = '$no_telepon', 
                                   jns_kelamin = '$jenis_kelamin', 
                                   tempat_lahir = '$tempat_lahir', 
                                   tanggal_lahir ='$tanggal_lahir',
                                   sip = '$sip',
                                   spesialisasi='$spesialisasi', 
                                   bagi_hasil = '$bagi_hasil'";
        mysql_query($input, $koneksidb);
        header("location:../../media.php?=".$module);
    }
    elseif($module=='dokter' AND $act=='update' ){
        $nm_dokter = $_POST['nm_dokter'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $sip  = $_POST['sip'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $spesialisasi = $_POST['spesialisasi'];
        $jenis_kelamin = $_POST['spesialisasi'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $bagi_hasil = $_POST['bagi_hasil'];
        $Kode = $_POST['Kode'];
        
        $update = "UPDATE dokter SET nm_dokter = '$nm_dokter',
                                     alamat ='$alamat', 
                                     no_telepon = '$no_telepon', 
                                     jns_kelamin = '$jenis_kelamin',
                                     tempat_lahir = '$tempat_lahir', 
                                     tanggal_lahir = '$tanggal_lahir', 
                                     sip = '$sip', 
                                     spesialisasi = '$spesialisasi', 
                                     bagi_hasil = '$bagi_hasil'
                            WHERE kd_dokter = '$Kode'";
        mysql_query($update,$koneksidb);
        header("location:../../media.php?module=".$module);
    } 
}

