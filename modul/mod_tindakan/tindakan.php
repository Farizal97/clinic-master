<style type="text/css">
    form .cmxform label.error, label.error {
	/* remove the next line when you have trouble in IE6 with labels in list */
	color: red;
	font-style: italic
    }
</style>
<!--panggil jquery validation -->
    <script src="lib/jquery.js"></script>
    <script src="dist/jquery.validate.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
              $("#form1").validate({
                  rules :{
                      nm_tindakan : "required",
                      harga : {
                          required : true,
                          number : true
                      }  
                  },
        //set dengan bahasa indonesia          
                messages:{
                    nm_tindakan:{
                        required:'Nama Tidak Boleh Kosong !!!'
                    },
                    harga:{
                        required :'Harga Harus Di isi',
                        number:'Di isi Dengan Angka Saja'
                    }
                }  
              });  
            });
    </script>
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
     
     $aksi = "modul/mod_tindakan/aksi_tindakan.php";
     
     $act = isset($_GET['act']) ? $_GET['act'] : '';
     $dataKode = buatKode("tindakan","T");//membuat kode otomatis 
     switch($act){
         //show tindakan
         default :
                echo"     <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=tindakan\">Data Tindakan Pasien</a>
            </li>
        </ul>
    </div>"; 
 echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Tindakan Pasien</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=tindakan&act=tambahtindakan\">Tambah Data</button></div>
       ";
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>    
        <th>Nama Tindakan</th>
        <th>Harga</th>
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>"; 
   $query  = "SELECT * FROM tindakan";
   $tampil = mysql_query($query,$koneksidb);
    $no = 1;
    while ($tyo = mysql_fetch_array($tampil)):
        $hargatindakan =format_angka($tyo['harga']); 
         echo "<tr><td>$no</td>
             <td>$tyo[nm_tindakan]</td>";
        echo "
                   <td>Rp. $hargatindakan ,-</td>";
       
        echo "           
                   <td>
            <a class=\"btn btn-info\" href=\"?module=tindakan&act=edittindakan&kd_tindakan=$tyo[kd_tindakan]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a>
            <a class=\"btn btn-danger\" href=\"$aksi?module=tindakan&act=hapus&kd_tindakan=$tyo[kd_tindakan]\" onclick=\"return confirm('ANDA YAKIN AKAN MENGHAPUS DATA TINDAKAN KLINIK INI..?')\">
                <i class=\"glyphicon glyphicon-delete icon-white\"></i>
                Delete
            </a>
                   </td>    
             </tr>";
       $no++; 
   endwhile;
        echo "</tbody></table>
       </div><!-- box content -->
       </div><!--box inner -->
       </div><!--box col-md-12 -->
       </div><!-- row -->";
       
        break;
    
    //tambah tindakan    
     case"tambahtindakan":
           echo " <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=tindakan\">Form Tambah Tindakan</a>
            </li>
        </ul>
    </div>";
    
    echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Tindakan</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=tindakan&act=input\">
                    <div class=\"form-group\">
                        <label>Kode Tindakan</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_tindakan\" placeholder=\"Kode Tindakan\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Tindakan</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_tindakan\" id=\"nm_tindakan\"  placeholder=\"Nama Tindakan\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Harga</label>
                        <input type=\"text\" class=\"form-control\" name=\"harga\" id=\"harga\"  placeholder=\"Harga\" required>
                    </div>
                    
                    <button type=\"submit\" class=\"btn btn-default\">Save</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Cancel</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";
     break;
     
     case "edittindakan":
           $query = "SELECT * FROM tindakan WHERE kd_tindakan = '$_GET[kd_tindakan]'";
           $tampil = mysql_query($query,$koneksidb);
           $r  = mysql_fetch_array($tampil);
           
           $dataKode = $r['kd_tindakan'];
           
        echo " <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=tindakan\">Form Ubah Tindakan</a>
            </li>
        </ul>
    </div>";  
        
        echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Update Tindakan</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=tindakan&act=update\">
                    <input type=\"hidden\" name=\"kode\" value=\"$r[kd_tindakan]\">    
                    <div class=\"form-group\">
                        <label>Kode Tindakan</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_tindakan\" placeholder=\"Kode Tindakan\" value=\"$dataKode\" readonly=\"readonly\">
                        <input type=\"hidden\" name=\"txtKode\" value=\"$r[kd_tindakan]\">    
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Tindakan</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_tindakan\" id=\"nm_tindakan\"  placeholder=\"Nama Tindakan\" value=\"$r[nm_tindakan]\" required>
                        <input type=\"hidden\" name=\"txtNama\" value=\"$r[nm_tindakan]\">    
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Harga</label>
                        <input type=\"text\" class=\"form-control\" name=\"harga\" id=\"harga\"  placeholder=\"Harga\" value=\"$r[harga]\" required>
                    </div>
                    
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

