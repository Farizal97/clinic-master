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
    
    <br>
    <br>
</div>";
}
else{
    include "../../config/inc.connection.php";
    include "../../config/inc.library.php";
    $module = $_GET['module'];
    $act = $_GET['act'];
    
    //delete
    if($module=='obat' AND $act=='hapus'){
        $delete = "DELETE FROM obat WHERE kd_obat = '$_GET[kd_obat]' "; 
        mysql_query($delete,$koneksidb);
        header("location:../../media.php?module=".$module);
    }
    
    //tambah obat
    elseif($module=='obat' AND $act=='input'){
        $nm_obat = $_POST['nm_obat'];
        $harga_modal = $_POST['harga_modal'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok'];
        $ket = $_POST['ket'];
        
        //validasi jika ada nama obat yang sama 
        $cekSql = "SELECT * FROM obat WHERE nm_obat = '$nm_obat'";
        $cekQry = mysql_query($cekSql,$koneksidb);
        if(mysql_num_rows($cekQry)>=1){
            echo "<script>window.alert('Nama Obat $nm_obat yang anda masukan sudah ada')
    window.location='../../media.php?module=obat&act=tambahobat'</script>";
        }
        else{
            //untuk menyimpan data ke dalam database 
            $kodeBaru = buatKode("obat", "H"); 
            $input = "INSERT obat SET kd_obat = '$kodeBaru',
                                      nm_obat = '$nm_obat', 
                                      harga_modal= '$harga_modal', 
                                      harga_jual = '$harga_jual', 
                                      stok = '$stok', 
                                      keterangan = '$ket'";
            mysql_query($input, $koneksidb);
            header("location:../../media.php?module=".$module);
        }
            
    }
    //upadate data
    elseif($module=='obat' AND $act=='update'){
        $Kode = $_POST['Kode'];
        $nm_obat = $_POST['nm_obat'];
        $harga_modal = $_POST['harga_modal'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok'];
        $ket = $_POST['ket'];
        
        //validasi jika ada nama obat yang sama 
        $cekSql = "SELECT * FROM obat WHERE nm_obat = '$nm_obat' AND NOT(nm_obat='".$_POST['txtNama']."')";
        $cekQry = mysql_query($cekSql,$koneksidb);
        if(mysql_num_rows($cekQry)>=1){
            echo "<script>window.alert('Nama Obat $nm_obat yang anda masukan sudah ada')
    window.location='../../media.php?module=obat&act=tambahobat'</script>";
        }
        else{
        $update ="UPDATE obat SET     nm_obat = '$nm_obat', 
                                      harga_modal= '$harga_modal', 
                                      harga_jual = '$harga_jual', 
                                      stok = '$stok', 
                                      keterangan = '$ket'
                            WHERE kd_obat = '$Kode'";
        mysql_query($update, $koneksidb);
        header("location:../../media.php?module=".$module); 
     }
  }
    
}
