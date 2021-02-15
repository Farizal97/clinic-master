<?php
session_start();
if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo "<link href='http://fonts.googleapis.com/css?family=Creepster|Audiowide' rel='stylesheet' type='text/css'>
        <link href=\"../../css/error.css\" rel='stylesheet' type=\"text/css\" />
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
else {
    include "../../config/inc.connection.php";
    include "../../config/inc.library.php";
    include "../../config/library.php";
    $module = $_GET['module'];
    $act = $_GET['act'];
    
    //delete
    if($module=='pasien' AND $act=='hapus'){
        $delete = "DELETE FROM pasien WHERE nomor_rm = '$_GET[nomor_rm]'";
        mysql_query($delete, $koneksidb);
        header("location:../../media.php?module=".$module);
    }
    
    //tambah data
    elseif($module=='pasien' AND $act=='input'){
        $nm_pasien = $_POST['nm_pasien'];
        $no_identitas = $_POST['no_identitas'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $gol_darah = $_POST['gol_darah'];
        $agama = $_POST['agama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $status_nikah = $_POST['status_nikah'];
        $pekerjaan = $_POST['pekerjaan'];
        $kodeBaru = buatKode("pasien","RM");
        
        $input = "INSERT pasien SET nomor_rm = '$kodeBaru',
                                    nm_pasien = '$nm_pasien', 
                                    no_identitas = '$no_identitas', 
                                    jns_kelamin = '$jenis_kelamin', 
                                    gol_darah = '$gol_darah', 
                                    agama = '$agama',
                                    tempat_lahir = '$tempat_lahir', 
                                    tanggal_lahir = '$tanggal_lahir', 
                                    no_telepon = '$no_telepon', 
                                    alamat ='$alamat', 
                                    stts_nikah = '$status_nikah', 
                                    pekerjaan = '$pekerjaan',
                                    tgl_rekam = '$tgl_sekarang', 
                                    username = '$_SESSION[namauser]'";
        mysql_query($input,$koneksidb);
        header("location:../../media.php?module=".$module);
    }
    
    //update
    elseif($module=='pasien' AND $act=='update'){
        $nm_pasien = $_POST['nm_pasien'];
        $no_identitas = $_POST['no_identitas'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $gol_darah = $_POST['gol_darah'];
        $agama = $_POST['agama'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $status_nikah = $_POST['status_nikah'];
        $pekerjaan = $_POST['pekerjaan'];
        $Kode = $_POST['Kode']; 
        
        $update  = "UPDATE pasien SET nm_pasien = '$nm_pasien', 
                                    no_identitas = '$no_identitas', 
                                    jns_kelamin = '$jenis_kelamin', 
                                    gol_darah = '$gol_darah', 
                                    agama = '$agama',
                                    tempat_lahir = '$tempat_lahir', 
                                    tanggal_lahir = '$tanggal_lahir', 
                                    no_telepon = '$no_telepon', 
                                    alamat ='$alamat', 
                                    stts_nikah = '$status_nikah', 
                                    pekerjaan = '$pekerjaan',
                                    tgl_rekam = '$tgl_sekarang', 
                                    username = '$_SESSION[namauser]'
                    WHERE nomor_rm = '$Kode'";
        mysql_query($update, $koneksidb);
        header("location:../../media.php?module=".$module);
    }
}