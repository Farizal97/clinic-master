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
    $aksi = "modul/mod_user/aksi_user.php";
    
    //mengatasi variabel yang belum di definisikan
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    
    switch($act){
        default:
            
            echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=user\">Data User / Petugas</a>
            </li>
        </ul>
    </div>";
            
    echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
       <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Modul</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">";
       if($_SESSION['leveluser']=='admin'){
        $query  = "SELECT * FROM users ORDER BY username";
        $tampil = mysql_query($query, $koneksidb);
        echo "<div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=user&act=tambahuser\">Tambah Data</button></div>";
        }
        else{
            $query  = "SELECT * FROM users WHERE username = '$_SESSION[namauser]'";
            $tampil = mysql_query($query, $koneksidb);
        }
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>    
        <th>Username</th>
        <th>Nama Lengkap</th>
        <th>E-mail</th>
        <th>Level</th>
        <th>Blokir</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>"; 
   
    $no = 1;
    while ($tyo = mysql_fetch_array($tampil)){
         echo "<tr><td>$no</td>
             <td>$tyo[username]</td>
                   <td>$tyo[nama_lengkap]</td>
                   <td>$tyo[email]</td>
                   <td>$tyo[level]</td>";
         if($tyo['blokir']=='Y'){
             echo "<td class=\"center\">
                       <span class=\" label-default label label-danger\">$tyo[blokir]</span> 
                 </td>";
         }
         else{
                echo "<td class=\"center\">
                    <span class=\" label-success label label-default  \">$tyo[blokir]</span>
                    </td>";
         }
        echo "           
                   <td>
            <a class=\"btn btn-info\" href=\"?module=user&act=edituser&id=$tyo[id_session]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a>
                   </td>    
             </tr>";
       $no++; 
    }
        echo "</tbody></table>
       </div><!-- box content -->
       </div><!--box inner -->
       </div><!--box col-md-12 -->
       </div><!-- row -->";
        break;
    
    //tambah data user    
    case"tambahuser":
        if($_SESSION['leveluser']=='admin'){
         echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=user\">Form Isi Data User</a>
            </li>
        </ul>
    </div>";
           echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Modul</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" method=\"POST\" action=\"$aksi?module=user&act=input\">
                    <div class=\"form-group\">
                        <label>Username</label>
                        <input type=\"text\" class=\"form-control\"  name=\"username\" placeholder=\"Username\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Password</label>
                        <input type=\"password\" class=\"form-control\" name=\"password\"  placeholder=\"Password\" required>
                    </div>
                    
                     <div class=\"form-group\">
                        <label>Nama Lengkap</label>
                        <input type=\"text\" class=\"form-control\" name=\"nama_lengkap\" placeholder=\"Nama Lengkap\" required>
                     </div>   
                     
                     <div class=\"form-group\">
                        <label>E-mail</label>
                        <input type=\"text\" class=\"form-control\" name=\"email\" placeholder=\"E-mail\" required>
                     </div>
                     
                    <button type=\"submit\" class=\"btn btn-default\">Save</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Cancel</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";
        }
 else {
     echo "<link href='http://fonts.googleapis.com/css?family=Creepster|Audiowide' rel='stylesheet' type='text/css'>
        <link href=\"../../css/error.css\" rel='stylesheet' type=\"text/css\" />
            <p class=\"error-code\">
                404
            </p>

    <p class=\"not-found\">Not<br/>Found</p>

<div class=\"clear\"></div>
    <div class=\"content\">
        Anda Tidak Berhak
        <br>
        <a href=\"index.php\">Go Back</a>

        <br>
        <br>
</div>";
 }
           
    break;

    case "edituser":
      $query = "SELECT * FROM users WHERE id_session='$_GET[id]'";
      $hasil = mysql_query( $query,$koneksidb);
      $r     = mysql_fetch_array($hasil);
        
    if($_SESSION['leveluser']=='admin'){
        echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=user\">Form Edit User</a>
            </li>
        </ul>
    </div>";
    
    echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Edit User</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" method=\"POST\" action=\"$aksi?module=user&act=update\">
                <input type = \"hidden\" name=\"id\" value=\"$r[id_session]\">    
                    <div class=\"form-group\">
                        <label>Username</label>
                        <input type=\"text\" class=\"form-control\"  name=\"username\" placeholder=\"Username\" value=\"$r[username]\" readonly='readonly'>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Password</label>
                        <input type=\"password\" class=\"form-control\" name=\"password\"  placeholder=\"Password\">
                    </div>
                    
                     <div class=\"form-group\">
                        <label>Nama Lengkap</label>
                        <input type=\"text\" class=\"form-control\" name=\"nama_lengkap\" placeholder=\"Nama Lengkap\" value=\"$r[nama_lengkap]\" required>
                     </div>   
                     
                     <div class=\"form-group\">
                        <label>E-mail</label>
                        <input type=\"text\" class=\"form-control\" name=\"email\" placeholder=\"E-mail\"  value=\"$r[email]\" required>
                     </div>";
                     
                if($r['blokir']=='N'){
                    echo "
                        <div class=\"form-group\">
                        <label>Status User</label><br>
                        <input type=\"radio\" name=\"blokir\"  value=\"N\" checked>
                        N | <input type=\"radio\" name=\"blokir\"  value=\"Y\">
                        Y
                     </div>";
                }  
                else{
                    echo "<div class=\"form-group\">
                        <label>Status User</label><br>
                        <input type=\"radio\" name=\"blokir\"  value=\"Y\" checked>
                        Y | <input type=\"radio\" name=\"blokir\"  value=\"N\">
                        N
                     </div>";
                }
                     
                   echo "  <div>
                            <label>*) Apabila password tidak diubah, dikosongkan saja.<br />
                                **) Username tidak bisa diubah.</label>
                     </div>
                     
                    <button type=\"submit\" class=\"btn btn-default\">Save</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Cancel</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";
    }  
    else{
        echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Edit User</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                    <form role=\"form\" method=\"POST\" action=\"$aksi?module=user&act=update\">
                    <input type = \"hidden\" name=\"id\" value=\"$r[id_session]\">
                    <input type=\"hidden\" name=\"blokir\" value=\"$r[blokir]\">
                    <div class=\"form-group\">
                        <label>Username</label>
                        <input type=\"text\" class=\"form-control\"  name=\"username\" placeholder=\"Username\" value=\"$r[username]\" readonly='readonly'>
                    </div>
                    
            <div class=\"form-group\">
                <label>Password</label>
                <input type=\"password\" class=\"form-control\" name=\"password\"  placeholder=\"Password\" required>
            </div>
                    
            <div class=\"form-group\">
                <label>Nama Lengkap</label>
                <input type=\"text\" class=\"form-control\" name=\"nama_lengkap\" placeholder=\"Nama Lengkap\" value=\"$r[nama_lengkap]\" required>
            </div>   
                     
            <div class=\"form-group\">
                        <label>E-mail</label>
                        <input type=\"text\" class=\"form-control\" name=\"email\" placeholder=\"E-mail\"  value=\"$r[email]\" required>
            </div>";
        
        echo "<div>
                            <label>*) Apabila password tidak diubah, dikosongkan saja.<br />
                                **) Username tidak bisa diubah.</label>
                     </div>
                     
                    <button type=\"submit\" class=\"btn btn-default\">Save</button> | 
                    <button type=\"button\" class=\"btn btn-warning\" onclick=\"self.history.back()\">Cancel</button>
            </form>";
        
        echo "</div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->";
    }
    break;
    }
}
