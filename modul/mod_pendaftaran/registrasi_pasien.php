<?php 
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
      # Fungsi membuat nomor antrian
    function nomorAntrian($tanggal) {
	//$tanggal dalam format Y-m-d
	$antriKe= 0;
	$mySql	= "SELECT count(*) as jum_antri FROM pendaftaran WHERE tgl_janji='$tanggal' ORDER BY nomor_antri";
	$myQry 	= mysql_query($mySql) or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	if(mysql_num_rows($myQry) >=1) {
		$antriKe	= $myData['jum_antri'] + 1;
	}
	else {
		$antriKe	= 1;
	}
	
	return $antriKe;
    }
    if(isset($_POST['save'])){
           $module = $_GET['module']; 
           $nomor_rm = $_POST['nomor_rm'];
           $nm_pasien = $_POST['nm_pasien'];
           $tanggal_daftar = $_POST['tanggal_daftar'];
           $tanggal_janji = $_POST['tanggal_janji'];
           $jam  = $_POST['jam'];
           $keluhan_pasien = $_POST['keluhan_pasien'];
           $tindakan = $_POST['tindakan'];
           $kodeBaru = buatKode("pendaftaran", "");
           $userlogin = $_SESSION['namauser'];
           $nomorAntri = nomorAntrian($tanggal_janji);
           
           $mySql2 = "INSERT pendaftaran SET no_daftar = '$kodeBaru',
                                            nomor_rm = '$nomor_rm',
                                            tgl_daftar = '$tanggal_daftar',
                                            tgl_janji = '$tanggal_janji',
                                            jam_janji ='$jam',
                                            keluhan = '$keluhan_pasien',
                                            kd_tindakan = '$tindakan',
                                            nomor_antri = '$nomorAntri',
                                            username = '$userlogin'";
           $myQry1 = mysql_query($mySql2, $koneksidb)or die("Gagal Simpan".mysql_error()); 
           if($myQry1){
               echo "<script>document.location='media.php?module=pendaftaran&sukses';</script>";
           }else{
               echo "<script>document.location='media.php?module=pendaftaran&gagal';</script>";
           }
    }   
   $dataKode = buatKode("pendaftaran", "");
   //mendapatkan data pasien 
    $nomor_rm = isset($_GET['nomor_rm']) ? $_GET['nomor_rm'] : '';
    $mySql = "SELECT nomor_rm, nm_pasien FROM pasien WHERE nomor_rm = '$nomor_rm'";
    $myQry = mysql_query($mySql,$koneksidb);
    $dataGw = mysql_fetch_array($myQry);
    $dataPasien = $dataGw['nm_pasien'];
     
?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Pendaftaran Pasien</a>
        </li>
    </ul>
</div>
   <!-- Halaman Tambah Pendaftar Pasien -->
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner ">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th"></i> Data Pendaftaran Pasien</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#info">Pendaftaran Baru</a></li>
                    <li><a href="#datapendaftar">Tampil Data Pendaftaran Pasien</a></li>
                    
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="info">
                        <h3>Pendaftaran Baru</h3>
                        <div class="box-content">
                            <form role ="form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?> ">
                              <div class="form-group">
                                    <label>Kode Registrasi</label>
                                    <input type="text" class="form-control"  name="kode" placeholder="Kode" value="<?php echo $dataKode; ?>" readonly required>
                              </div>
                              
                              <div class="form-group">
                                    <label>Nomor RM</label>
                                    <input type="text" name="nomor_rm" class="form-control" placeholder="Nomor RM" value="<?php echo $nomor_rm; ?>" required/> <br><p>Isi Dengan Klik Daftar Pasien</p> <a href="#" data-target="#daftarPasien" data-toggle="modal" class="btn  btn-info btn-xs"> Daftar Pasien <i
                                    class="glyphicon glyphicon-search"></i></a> 
                              </div>
                              
                              <div class="form-group">
                                    <label>Nama Pasien</label>
                                    <input type="text" name="nm_pasien" class="form-control" placeholder="Nama Pasien" value="<?php echo $dataPasien; ?>" required/>  
                              </div>
                              
                              <div class="form-group">
                                    <label>Tgl.Daftar</label>
                                    <input type="date" name="tanggal_daftar" class="form-control"  placeholder="Tanggal Daftar" required>
                              </div>
                            
                               <div class="form-group col-md-4">
                                    <label>Tgl.Janji</label>
                                    <input type="date" name="tanggal_janji" class="form-control" placeholder="Tanggal Janji" required> 
                              </div>  
                              <div class="form-group col-md-6">
                                    <label>Jam</label>
                                    <input type="time" name="jam" class="form-control" placeholder="Jam" required>
                              </div> 
                              <br>
                              <br>
                              <br>
                              <br>
                              <div class="form-group">
                                    <label>Keluhan Pasien</label>
                                    <input type="text" name="keluhan_pasien" class="form-control" placeholder="Keluhan Pasien" required>
                              </div>
                              
                              <div class="form-group">
                                    <label>Tindakan Pasien</label>
                                <div class="controls">
                                    <select data-rel="chosen" name="tindakan">
                                     <option value="0">-Pilih Data-</option>
       <?php
            $query = "SELECT * FROM tindakan ORDER BY nm_tindakan";
            $tampil = mysql_query($query, $koneksidb);
            while($r = mysql_fetch_array($tampil)){
               echo "<option value=\"$r[kd_tindakan]\">$r[nm_tindakan]</option>"; 
            }
            echo"
               </select>
               </div>
               </div>
            <button type=\"submit\" name=\"save\" class=\"btn btn-default btn-warning\">Save</button>";
             
                    
               echo" </form>
                        </div>
                    </div>";
              ?> 
              <?php
              //tampil data pendaftar
              
              echo "
                    <div class=\"tab-pane\" id=\"datapendaftar\">
                        <h4>Data Pendaftar</h4>
                        <table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
                            <thead>
                            <tr>
                                  <th>No.Daftar</th>
                                  <th>tgl.Daftar</th>
                                  <th>Nomor rm</th>
                                  <th>Nama Pasien</th>
                                  <th>Tgl.Janji</th>
                                  <th>Jam Janji</th>
                                  <th >Tools</th>
                             </tr>     
                            <thead>
                            <tbody>";
              
          $a = mysql_query("SELECT pendaftaran.no_daftar, pendaftaran.tgl_daftar,pendaftaran.tgl_janji,pendaftaran.jam_janji, pasien.nomor_rm, pasien.nm_pasien,tindakan.nm_tindakan FROM pendaftaran "
                  . "       LEFT JOIN pasien ON pendaftaran.nomor_rm = pasien.nomor_rm "
                  . "       LEFT JOIN tindakan ON pendaftaran.kd_tindakan = tindakan.kd_tindakan ORDER BY pendaftaran.no_daftar ASC");
         
          while($b = mysql_fetch_array($a)){
              
            echo"
                            
                                <tr>
                                    <td>$b[no_daftar] </td>
                                    <td>$b[tgl_daftar] </td>
                                    <td>$b[nomor_rm]</td>
                                    <td>$b[nm_pasien] </td>
                                    <td>$b[tgl_janji]</td>
                                    <td>$b[jam_janji]</td>
                                    <td><a href=\"../clinic-master/cetak/pendaftaran_cetak.php?no_daftar=$b[no_daftar]\" target=\"_blank\">Cetak</a></td>
                                </tr>";
                            
                }
           ?>             
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/span-->
   
</div><!--/row-->    

   <?php     
//modal pencarian pasien        
echo "<!--modal pencarian pasien -->
            <div class=\"modal fade\" id=\"daftarPasien\" tabindex=\"-1\" role=\"dialog\" 
         aria-hidden=\"true\">

        <div class=\"modal-dialog modal-lg\">
            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
                    <h3>Daftar Pasien</h3>
                </div>
                <div class=\"modal-body\">
                    <table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor RM</th>
                                <th>Nama Pasien</th>
                                <th>Kelamin</th>
                                <th>Gol Darah</th>
                                <th>Alamat</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                        ";
        $query= "SELECT * FROM pasien ORDER BY nomor_rm ";
        $tampil = mysql_query($query,$koneksidb);
        $no=1;
        while ($r =mysql_fetch_array($tampil)):
    echo "<tr>
            <td>$no</td>
            <td>$r[nomor_rm]</td>
            <td>$r[nm_pasien]</td>
            <td>$r[jns_kelamin]</td>
            <td>$r[gol_darah]</td>
            <td>$r[alamat]</td>
            <td><a href=\"?module=pendaftaran&nomor_rm=$r[nomor_rm]\" target=\"_self\" alt=\"Daftar\">Daftar</a></td>
         </tr>";
        $no++;
   endwhile;      
                            
    echo "                        
                        </tbody>
                    <table>
                </div>
                
            </div>
        </div>
    </div>";
    ?>

<?php 
   }
?>