<?php
session_start();
if(empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
    echo"<link href='http://fonts.googleapis.com/css?family=Creepster|Audiowide' rel='stylesheet' type='text/css'>
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
    //hapus tindakan
    if($module=='tindakan' AND $act=='hapus'){
        $delete = "DELETE FROM tindakan WHERE kd_tindakan ='$_GET[kd_tindakan]' ";
        mysql_query($delete,$koneksidb);
        header("location:../../media.php?module=".$module);  
    }
    
    //input data tindakan
    elseif($module=='tindakan' AND $act=='input'){
        $nm_tindakan = $_POST['nm_tindakan'];
        $harga = $_POST['harga'];
        
        //validasi jika nama tindakan telah tersedia di dalam database 
        $cekSql = "SELECT * FROM tindakan WHERE nm_tindakan = '$nm_tindakan'";
        $cekQry = mysql_query($cekSql,$koneksidb) or die("Gagal Query Cek Sql".mysql_error());
        if(mysql_num_rows($cekQry)>=1){
            echo "<script>window.alert('Nama Tindakan $nm_tindakan yang anda masukan sudah ada')
    window.location='../../media.php?module=tindakan&act=tambahtindakan'</script>";
        } 
        else{
            $kodeBaru = buatKode("tindakan","T");
        $input = "INSERT tindakan SET kd_tindakan = '$kodeBaru',
                                      nm_tindakan = '$nm_tindakan', 
                                      harga = '$harga'";
        mysql_query($input, $koneksidb);
        header("location:../../media.php?module=".$module);
        }
    }
    
    elseif($module=='tindakan' AND $act=='update'){
        $nm_tindakan = $_POST['nm_tindakan'];
        $harga = $_POST['harga'];
        //validasi jika nama tindakan telah tersedia di dalam database 
        $cekSql = "SELECT * FROM tindakan WHERE nm_tindakan = '$nm_tindakan' AND NOT(nm_tindakan= '".$_POST['txtNama']."')";
        $cekQry = mysql_query($cekSql,$koneksidb) or die("Gagal Query Cek Sql".mysql_error());
        if(mysql_num_rows($cekQry)>=1){
            echo "<script>window.alert('Nama Tindakan $nm_tindakan yang anda masukan sudah ada')
    window.location='../../media.php?module=tindakan&act=edittindakan'</script>";
        }
        else{
            $update = "UPDATE tindakan SET nm_tindakan ='$nm_tindakan',
                                           harga = '$harga'
                                WHERE kd_tindakan = '$_POST[txtKode]'";
            mysql_query($update,$koneksidb);
            header("location:../../media.php?module=".$module);
        }
    }
}


