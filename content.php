<?php 
//apabila belum login
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
    include "config/inc.connection.php";
    include "config/inc.library.php";
    //page beranda
    if($_GET['module']=='beranda'){
        if($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user' ){
                include "modul/mod_beranda/beranda.php";
        }
    }
    
    //halaman modul
    elseif($_GET['module']=='modul'){
        if($_SESSION['leveluser']=='admin' ){
            include "modul/mod_modul/modul.php";
        }
    }
    
    //halaman user
    elseif($_GET['module']=='user'){
        if($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
            include "modul/mod_user/user.php";
        }
    }
        
    //halaman tindakan
    elseif($_GET['module']=='tindakan'){
        if($_SESSION['leveluser']=='admin'){
            include "modul/mod_tindakan/tindakan.php";
        }
    }
    
    //halaman dokter
    elseif($_GET['module']=='dokter'){
        if($_SESSION['leveluser']=='admin'){
            include "modul/mod_dokter/dokter.php";
        }
    }
    
    //halaman obat 
    elseif($_GET['module']=='obat'){
        if($_SESSION['leveluser']=='admin'){
            include "modul/mod_obat/obat.php";
        }
    }
    
    //halaman Pasien 
    elseif($_GET['module']=='pasien'){
        if($_SESSION['leveluser']=='admin'){
            include "modul/mod_pasien/pasien.php";
        }
    }
    
    //halaman registrasi pasien 
    elseif($_GET['module']=='pendaftaran'){
        if($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
            include "modul/mod_pendaftaran/registrasi_pasien.php";
        }
    }
    
    
    
    //halaman rawat jalan
    elseif($_GET['module']=='rawatjalan'){
        if($_SESSION['leveluser']=='admin'){
            include "modul/mod_rawatjalan/rawat_jalan.php";
        }    
    }

    
    
    else{
        echo "<meta http-equiv='refresh' content='0; url=error.php'>";
    }
    
}