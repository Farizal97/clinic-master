<style type="text/css">
    form .cmxform label.error, label.error {
	/* remove the next line when you have trouble in IE6 with labels in list */
	color: red;
	font-style: italic
    }
</style>
<!--panggil jquery validation -->
    
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
    or
    <br>
    <br>
</div>";
}
else{
    $aksi = "modul/mod_pasien/aksi_pasien.php";
    
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    
    $dataKode = buatKode("pasien","RM");
    
    switch($act){
        default:
            echo"     <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=pasien\">Data Pasien</a>
            </li>
        </ul>
    </div>"; 
     echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Pasien</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=pasien&act=tambahpasien\">Tambah Data</button></div>
       ";
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>Nomor RM</th>    
        <th>Nama Pasien</th>
        <th>NO Identitas</th>
        <th>No Telepon</th>
      
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>"; 
   $query  = "SELECT * FROM pasien";
   $tampil = mysql_query($query,$koneksidb);
   
    while ($tyo = mysql_fetch_array($tampil)):
         echo "<tr><td>$tyo[nomor_rm]</td>
             <td>$tyo[nm_pasien]</td>
             <td>$tyo[no_identitas]</td>
             <td>$tyo[no_telepon]</td>";
        echo "           
                   <td>
            <a class=\"btn btn-info btn-xs\" title=\"Edit\" href=\"?module=pasien&act=editpasien&nomor_rm=$tyo[nomor_rm]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
               
            </a>
            <a class=\"btn btn-danger btn-xs\" title=\"Delete\" href=\"$aksi?module=pasien&act=hapus&nomor_rm=$tyo[nomor_rm]\" onclick=\"return confirm('ANDA YAKIN AKAN MENGHAPUS DATA TINDAKAN KLINIK INI..?')\">
                <i class=\"glyphicon glyphicon-trash\"></i>
                
            </a>
                   </td>    
             </tr>";
      
   endwhile;
        echo "</tbody></table>
       </div><!-- box content -->
       </div><!--box inner -->
       </div><!--box col-md-12 -->
       </div><!-- row -->";
               
        break;
        
        case "tambahpasien":
            echo " <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=pasien\">Form Tambah Pasien</a>
            </li>
        </ul>
    </div>";
    
    echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Pasien</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form  class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=pasien&act=input\" >
                    <div class=\"form-group\">
                        <label>Kode Pasien</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nomor_rm\" placeholder=\"Nomor RM\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Pasien</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_pasien\"   placeholder=\"Nama Pasien\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>No Identitas (KTP / SIM)</label>
                        <input type=\"text\" class=\"form-control\" name=\"no_identitas\"   placeholder=\"No Identitas\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label class=\"control-label\" for=\"jenis_kelamin\" >Jenis Kelamin</label>
                       <div class=\"controls\">
                    <input type=\"radio\" name=\"jenis_kelamin\" value=\"Laki-laki\" id=\"jenis_kelamin\" required> Laki-laki 
                     <input type=\"radio\" name=\"jenis_kelamin\" value=\"Perempuan\" required> Perempuan
            ";
                        
                  echo" 
                       </div>
                    </div>";
                  
        echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Golongan Darah</label>
                <div class=\"controls\">
               <input type=\"radio\" name=\"gol_darah\" value=\"A\" required title=\"dipilih ya\"> A 
               <input type=\"radio\" name=\"gol_darah\" value=\"AB\" > AB
               <input type=\"radio\" name=\"gol_darah\" value=\"B\" > B
               <input type=\"radio\" name=\"gol_darah\" value=\"O\" > O
               ";
            
        echo "
            </div>
            </div>";
         echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Agama</label>
                <div class=\"controls\">
                <input type=\"radio\" name=\"agama\" value=\"Islam\" required title=\"Agama Di pilih ya\"> Islam
                <input type=\"radio\" name=\"agama\" value=\"katolik\">Kristen Katholik
                <input type=\"radio\" name=\"agama\" value=\"protestan\">Kristen Protestan
                <input type=\"radio\" name=\"agama\" value=\"budha\">Budha
                <input type=\"radio\" name=\"agama\" value=\"hindu\">Hindu
                ";
            
        echo "
            </div>
            </div>";
        
        echo "<div class=\"form-group \">
                   <label class=\"control-label\">Tempat Lahir</label> 
                   <input type=\"text\" class=\"form-control\" name=\"tempat_lahir\" required>
               </div> 
              <div class=\"form-group \">
                   <label class=\"control-label\">Tanggal Lahir</label> 
                   <input type=\"date\" class=\"form-control\" name=\"tanggal_lahir\" required>
               </div> 
               <div class=\"form-group \">
                   <label class=\"control-label\">Alamat</label> 
                   <input type=\"text\" class=\"form-control\" name=\"alamat\" required>
               </div> 
               <div class=\"form-group \">
                   <label class=\"control-label\">No telepon</label> 
                   <input type=\"text\" class=\"form-control\" name=\"no_telepon\" required>
               </div>";
        
         echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Status Nikah</label>
                <div class=\"controls\">
                <input type=\"radio\" name=\"status_nikah\" value=\"belum menikah\" required title=\"Dipilih ya\">Belum Menikah
                <input type=\"radio\" name=\"status_nikah\" value=\"sudah menikah\">Sudah Menikah
                ";
           
        echo "
            </div>
            </div>";
        
         echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Pekerjaan</label>
                <div class=\"controls\">
                <input type=\"radio\" name=\"pekerjaan\" value=\"wiraswasta\" required title=\"dipilih ya\">Wiraswasta
                <input type=\"radio\" name=\"pekerjaan\" value=\"pelajar\">Mahasiswa / Pelajar
                <input type=\"radio\" name=\"pekerjaan\" value=\"pns\">Pegawai Negri Sipil
                <input type=\"radio\" name=\"pekerjaan\" value=\"swasta\">Pegawai Swasta
                ";
           
        echo "
            </div>
            </div>";
                  
       echo"
                    <button type=\"submit\" class=\"btn btn-default\">Save</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Cancel</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";
        break;
    
    case"editpasien":
    $query = "SELECT * FROM pasien WHERE nomor_rm = '$_GET[nomor_rm]'";
    $tampil = mysql_query($query, $koneksidb);
    $r = mysql_fetch_array($tampil);
    
    $dataKode = $r['nomor_rm'];
           
            echo " <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=pasien\">Form Tambah Pasien</a>
            </li>
        </ul>
    </div>";
    
    echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Pasien</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form  class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=pasien&act=update\" >
                <input type=\"hidden\" name=\"Kode\" value=\"$r[nomor_rm]\">    
                    <div class=\"form-group\">
                        <label>Kode Pasien</label>
                        <input type=\"text\" class=\"form-control\"  name=\"nomor_rm\" placeholder=\"Nomor RM\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Pasien</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_pasien\"   placeholder=\"Nama Pasien\" value=\"$r[nm_pasien]\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>No Identitas (KTP / SIM)</label>
                        <input type=\"text\" class=\"form-control\" name=\"no_identitas\"   placeholder=\"No Identitas\"  value =\"$r[no_identitas]\"required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label class=\"control-label\" for=\"jenis_kelamin\" >Jenis Kelamin</label>
                       <div class=\"controls\">";
    
                    if($r['jns_kelamin']=="Laki-laki"){
                        echo "<input type=\"radio\" name=\"jenis_kelamin\" value=\"Laki-laki\" id=\"jenis_kelamin\" checked required> Laki-laki 
                              <input type=\"radio\" name=\"jenis_kelamin\" value=\"Perempuan\" id=\"jenis_kelamin\" required> Perempuan   
                            ";
                        
                    }
                    else{
                        echo "<input type=\"radio\" name=\"jenis_kelamin\" value=\"Laki-laki\" id=\"jenis_kelamin\"  required> Laki-laki 
                              <input type=\"radio\" name=\"jenis_kelamin\" value=\"Perempuan\" id=\"jenis_kelamin\" checked required> Perempuan   ";
                    }
                        
                  echo" 
                       </div>
                    </div>";
                  
        echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Golongan Darah</label>
                <div class=\"controls\">";
        
        if($r['gol_darah']=="A"){
            echo "<input type=\"radio\" name=\"gol_darah\" value=\"A\" checked required title=\"dipilih ya\"> A 
               <input type=\"radio\" name=\"gol_darah\" value=\"AB\" > AB
               <input type=\"radio\" name=\"gol_darah\" value=\"B\" > B
               <input type=\"radio\" name=\"gol_darah\" value=\"O\" > O";
        }
        elseif($r['gol_darah']=="AB"){
            echo "<input type=\"radio\" name=\"gol_darah\" value=\"A\" required title=\"dipilih ya\"> A 
               <input type=\"radio\" name=\"gol_darah\" value=\"AB\" checked > AB
               <input type=\"radio\" name=\"gol_darah\" value=\"B\" > B
               <input type=\"radio\" name=\"gol_darah\" value=\"O\" > O";
        }
        elseif($r['gol_darah']=="B"){
           echo" <input type=\"radio\" name=\"gol_darah\" value=\"A\" required title=\"dipilih ya\"> A 
               <input type=\"radio\" name=\"gol_darah\" value=\"AB\" > AB
               <input type=\"radio\" name=\"gol_darah\" value=\"B\" checked > B
               <input type=\"radio\" name=\"gol_darah\" value=\"O\" > O";
        }
        else{
            echo"<input type=\"radio\" name=\"gol_darah\" value=\"A\" required title=\"dipilih ya\"> A 
               <input type=\"radio\" name=\"gol_darah\" value=\"AB\" > AB
               <input type=\"radio\" name=\"gol_darah\" value=\"B\" > B
               <input type=\"radio\" name=\"gol_darah\" value=\"O\" checked > O";
        }
            
        echo "
            </div>
            </div>";
         echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Agama</label>
                <div class=\"controls\">";
         if($r['agama']=="Islam"){
             echo " <input type=\"radio\" name=\"agama\" value=\"Islam\" checked required title=\"Agama Di pilih ya\"> Islam
                <input type=\"radio\" name=\"agama\" value=\"Kristen Katholik\">Kristen Katholik
                <input type=\"radio\" name=\"agama\" value=\"Kristen Protestan\">Kristen Protestan
                <input type=\"radio\" name=\"agama\" value=\"Budha\">Budha
                <input type=\"radio\" name=\"agama\" value=\"Hindu\">Hindu";
         }
         elseif($r['agama']=="Kristen Katholik"){
             echo " <input type=\"radio\" name=\"agama\" value=\"Islam\" required title=\"Agama Di pilih ya\"> Islam
                <input type=\"radio\" name=\"agama\" value=\"Kristen Katholik\" checked>Kristen Katholik
                <input type=\"radio\" name=\"agama\" value=\"Kristen Protestan\">Kristen Protestan
                <input type=\"radio\" name=\"agama\" value=\"Budha\">Budha
                <input type=\"radio\" name=\"agama\" value=\"Hindu\">Hindu";
         }
         elseif($r['agama']=='Kristen Protestan'){
             echo " <input type=\"radio\" name=\"agama\" value=\"Islam\" required title=\"Agama Di pilih ya\"> Islam
                <input type=\"radio\" name=\"agama\" value=\"Kristen Katholik\">Kristen Katholik
                <input type=\"radio\" name=\"agama\" value=\"Kristen Protestan\" checked>Kristen Protestan
                <input type=\"radio\" name=\"agama\" value=\"Budha\">Budha
                <input type=\"radio\" name=\"agama\" value=\"Hindu\">Hindu";
         }
         elseif($r['agama']=='Budha'){
             echo " <input type=\"radio\" name=\"agama\" value=\"Islam\" required title=\"Agama Di pilih ya\"> Islam
                <input type=\"radio\" name=\"agama\" value=\"Kristen Katholik\">Kristen Katholik
                <input type=\"radio\" name=\"agama\" value=\"Kristen Protestan\">Kristen Protestan
                <input type=\"radio\" name=\"agama\" value=\"Budha\" checked>Budha
                <input type=\"radio\" name=\"agama\" value=\"Hindu\">Hindu";
         }
         else{
               echo " <input type=\"radio\" name=\"agama\" value=\"Islam\" required title=\"Agama Di pilih ya\"> Islam
                <input type=\"radio\" name=\"agama\" value=\"Kristen Katholik\">Kristen Katholik
                <input type=\"radio\" name=\"agama\" value=\"Kristen Protestan\">Kristen Protestan
                <input type=\"radio\" name=\"agama\" value=\"Budha\">Budha
                <input type=\"radio\" name=\"agama\" value=\"Hindu\" checked>Hindu"; 
         }
            
        echo "
            </div>
            </div>";
        
        echo "<div class=\"form-group \">
                   <label class=\"control-label\">Tempat Lahir</label> 
                   <input type=\"text\" class=\"form-control\" name=\"tempat_lahir\"  value =\"$r[tempat_lahir]\"required>
               </div> 
              <div class=\"form-group \">
                   <label class=\"control-label\">Tanggal Lahir</label> 
                   <input type=\"date\" class=\"form-control\" name=\"tanggal_lahir\" value=\"$r[tanggal_lahir]\" required>
               </div> 
               <div class=\"form-group \">
                   <label class=\"control-label\">Alamat</label> 
                   <input type=\"text\" class=\"form-control\" name=\"alamat\" value=\"$r[alamat]\" required>
               </div> 
               <div class=\"form-group \">
                   <label class=\"control-label\">No telepon</label> 
                   <input type=\"text\" class=\"form-control\" name=\"no_telepon\" value=\"$r[no_telepon]\" required>
               </div>";
        
         echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Status Nikah</label>
                <div class=\"controls\">";
         if($r['stts_nikah']="Belum Menikah"){
             echo "<input type=\"radio\" name=\"status_nikah\" value=\"Belum Menikah\" checked required title=\"Dipilih ya\">Belum Menikah
                <input type=\"radio\" name=\"status_nikah\" value=\"Sudah Menikah\">Sudah Menikah";
         }
         else{
             echo "<input type=\"radio\" name=\"status_nikah\" value=\"Belum Menikah\" required title=\"Dipilih ya\">Belum Menikah
                <input type=\"radio\" name=\"status_nikah\" value=\"Sudah Menikah\" checked>Sudah Menikah";
         }
           
        echo "
            </div>
            </div>";
        
         echo "<div class=\"form-group\">
                <label class=\"control-label\" for=\"selectError\">Pekerjaan</label>
                <div class=\"controls\">";
         if($r['pekerjaan']=="Wiraswasta"){
             echo "<input type=\"radio\" name=\"pekerjaan\" value=\"Wiraswasta\" checked required title=\"dipilih ya\">Wiraswasta
                <input type=\"radio\" name=\"pekerjaan\" value=\"Mahasiswa / Pelajar\">Mahasiswa / Pelajar
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Negri Sipil\">Pegawai Negri Sipil
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Swasta\">Pegawai Swasta";
         }
         elseif($r['pekerjaan']=="Mahasiswa / Pelajar"){
             echo "<input type=\"radio\" name=\"pekerjaan\" value=\"Wiraswasta\" required title=\"dipilih ya\">Wiraswasta
                <input type=\"radio\" name=\"pekerjaan\" value=\"Mahasiswa / Pelajar\" checked >Mahasiswa / Pelajar
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Negri Sipil\">Pegawai Negri Sipil
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Swasta\">Pegawai Swasta";
         }
         elseif($r['pekerjaan']=="Pegawai Negri Sipil"){
             echo "<input type=\"radio\" name=\"pekerjaan\" value=\"Wiraswasta\" required title=\"dipilih ya\">Wiraswasta
                <input type=\"radio\" name=\"pekerjaan\" value=\"Mahasiswa / Pelajar\">Mahasiswa / Pelajar
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Negri Sipil\" checked>Pegawai Negri Sipil
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Swasta\">Pegawai Swasta";
         }
         else{
             echo "<input type=\"radio\" name=\"pekerjaan\" value=\"Wiraswasta\" required title=\"dipilih ya\">Wiraswasta
                <input type=\"radio\" name=\"pekerjaan\" value=\"Mahasiswa / Pelajar\">Mahasiswa / Pelajar
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Negri Sipil\">Pegawai Negri Sipil
                <input type=\"radio\" name=\"pekerjaan\" value=\"Pegawai Swasta\" checked>Pegawai Swasta";
         }
           
        echo "
            </div>
            </div>";
                  
       echo"
                    <button type=\"submit\" class=\"btn btn-default\">Save</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Cancel</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";
    break;
    }
}