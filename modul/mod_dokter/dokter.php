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
                      nm_dokter : "required",
                      /*harga : {
                          required : true,
                          number : true
                      } */ 
                      alamat: "required",
                      no_telepon:{
                          required : true, 
                          number : true
                      }, 
                      sip :{
                          required : true,
                          number : true
                      }, 
                      
                      tempat_lahir: "required",
                      tanggal_lahir : "required",
                      jenis_kelamin : "required",
                      spesialisasi : "required", 
                     bagi_hasil : {
                         required : true, 
                         number : true
                     }
                  },
        //set dengan bahasa indonesia          
                messages:{
                    nm_dokter:{
                        required:'Nama Tidak Boleh Kosong !!!'
                    },
                    alamat:{
                        required : 'Alamat Tidak Boleh Kosong'
                    },
                    no_telepon:{
                        required : 'No Telpon Harus Di isi', 
                        number : 'Isi Dengan Angka'
                    }, 
                    sip:{
                        required : 'SIP Harus Di isi', 
                        number :'Isi Dengan Nomor SIP'
                    },
                    tempat_lahir:{
                        required : 'Tempat Lahir Tidak Boleh Kosong'
                    }, 
                    tanggal_lahir:{
                        required : 'Mohon Isi Tanggal Lahir'
                    }, 
                    jenis_kelamin:{
                        required : 'Tidak Boleh Kosong'
                    },
                    spesialisasi:{
                        required :'Tidak Boleh KOsong'
                    }, 
                    bagi_hasil:{
                        required : 'Tidak Boleh Kosong', 
                        number : 'isi dengan angka'
                    }
                    
                /*harga:{
                        required :'Harga Harus Di isi',
                        number:'Di isi Dengan Angka Saja'
                    }*/
                }  
              });  
            });
    </script>
  

<?php

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
     
     $aksi = "modul/mod_dokter/aksi_dokter.php";
     
     $act = isset($_GET['act']) ? $_GET['act'] : '';
     $dataKode = buatKode("dokter","D");//membuat kode otomatis 
     switch($act){
         //show dokter
         default :
                echo"     <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=dokter\">Data Dokter</a>
            </li>
        </ul>
    </div>"; 
 echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Dokter</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=dokter&act=tambahdokter\">Tambah Data</button></div>
       ";
echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>    
        <th>Nama Dokter</th>
        <th>Alamat</th>
        <th>No Telpon</th>
        
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>"; 
   $query  = "SELECT * FROM dokter";
   $tampil = mysql_query($query,$koneksidb);
    $no = 1;
    while ($tyo = mysql_fetch_array($tampil)):
         
         echo "<tr><td>$no</td>
             <td>$tyo[nm_dokter]</td>
             <td>$tyo[alamat]</td>
             <td>$tyo[no_telepon]</td>
            ";
        echo "           
                   <td>
            <a class=\"btn btn-warning\" href=\"?module=dokter&act=viewdokter&kd_dokter=$tyo[kd_dokter]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                View
            </a>       
                   
            <a class=\"btn btn-info\" href=\"?module=dokter&act=editdokter&kd_dokter=$tyo[kd_dokter]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a>
            <a class=\"btn btn-danger\" href=\"$aksi?module=dokter&act=hapus&kd_dokter=$tyo[kd_dokter]\" onclick=\"return confirm('ANDA YAKIN AKAN MENGHAPUS DATA TINDAKAN KLINIK INI..?')\">
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
    
    //tambah dokter    
     case"tambahdokter":
           echo " <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=dokter\">Form Tambah Dokter</a>
            </li>
        </ul>
    </div>";
    
    echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Dokter</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=dokter&act=input\">
                    <div class=\"form-group\">
                        <label>Kode Dokter</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_dokter\" placeholder=\"Kode Tindakan\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Dokter</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_dokter\" id=\"nm_dokter\"  placeholder=\"Nama Dokter\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Alamat</label>
                        <input type=\"text\" class=\"form-control\" name=\"alamat\" id=\"alamat\"  placeholder=\"Alamat\"  required>
                    </div>
                    
                    <div class=\"form-group\" >
                        <label>No telepon</label>
                      <input  type=\"text\" name=\"no_telepon\" class=\"form-control\" placeholder=\"No Telepon\" >  
                    </div><br>
                    
                    <div class=\"form-group\" >
                        <label>SIP (Surat Izin Praktek)</label>
                      <input  type=\"text\" name=\"sip\" class=\"form-control\" placeholder=\"Surat Ijin Praktek\" >  
                    </div><br>
                    
                    <div class=\"form-group\">
                        <label class=\"control-label\">Tempat Lahir</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Tempat Lahir\" name=\"tempat_lahir\" >
                    </div>
                    
                   <div class=\"form-group\">
                      <label class=\"control-label\">Tanggal Lahir</label>
                          <input type='date' class=\"form-control\" name=\"tanggal_lahir\" required />
                  </div>
                  
                   <div class=\"form-group\">
                        <label class=\"control-label\">Spesialisasi</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Spesialisasi\" name=\"spesialisasi\"  required>
                   </div>
                   
                   <div class=\"form-group\">
                        <label class=\"control-label\">Jenis Kelamin</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Gender\" name=\"jenis_kelamin\"  required>
                   </div>
                   
                    <div class=\"form-group\">
                        <label class=\"control-label\">Bagi Hasil %</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Bagi Hasil\" name=\"bagi_hasil\"  required>
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
     
     case "editdokter":
           $query = "SELECT * FROM dokter WHERE kd_dokter = '$_GET[kd_dokter]'";
           $tampil = mysql_query($query,$koneksidb);
           $r  = mysql_fetch_array($tampil);
           $dataKode = $r['kd_dokter'];
        echo " <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=dokter\">Form Ubah Dokter</a>
            </li>
        </ul>
    </div>";  
        
        echo "<div class=\"row\">
    <div class=\"box col-md-12\">
        <div class=\"box-inner\">
            <div class=\"box-header well\" data-original-title=\"\">
                <h2><i class=\"glyphicon glyphicon-edit\"></i> Form Add Dokter</h2>

                <div class=\"box-icon\">
                 
                    <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-chevron-up\"></i></a>
                    <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i
                            class=\"glyphicon glyphicon-remove\"></i></a>
                </div>
            </div>
            <div class=\"box-content\">
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=dokter&act=update\">
                    <input type=\"hidden\" name=\"Kode\" value=\"$r[kd_dokter]\">
                    <div class=\"form-group\">
                        <label>Kode Dokter</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_dokter\" placeholder=\"Kode Tindakan\" value=\"$dataKode\" readonly=\"readonly\">
                        <input type=\"hidden\" name=\"txtKode\" value=\"$dataKode]\">    
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Dokter</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_dokter\" id=\"nm_dokter\"  placeholder=\"Nama Dokter\" value=\"$r[nm_dokter]\" required>
                        <input type=\"hidden\" name=\"txtNamaDokter\" value=\"$r[nm_dokter]\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Alamat</label>
                        <input type=\"text\" class=\"form-control\" name=\"alamat\" id=\"alamat\"  placeholder=\"Alamat\" value=\"$r[alamat]\" required>
                    </div>
                    
                    <div class=\"form-group\" >
                        <label>No telepon</label>
                      <input  type=\"text\" name=\"no_telepon\" class=\"form-control\" placeholder=\"No Telepon\" value=\"$r[no_telepon]\">  
                    </div><br>
                    
                    <div class=\"form-group\" >
                        <label>SIP (Surat Izin Praktek)</label>
                      <input  type=\"text\" name=\"sip\" class=\"form-control\" placeholder=\"Surat Ijin Praktek\" value=\"$r[sip]\">  
                    </div><br>
                    
                    <div class=\"form-group\">
                        <label class=\"control-label\">Tempat Lahir</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Tempat Lahir\" name=\"tempat_lahir\" value=\"$r[tempat_lahir]\">
                    </div>
                    
                   <div class=\"form-group\">
                      <label class=\"control-label\">Tanggal Lahir</label>
                          <input type='date' class=\"form-control\" name=\"tanggal_lahir\" value=\"$r[tanggal_lahir]\" required/>
                  </div>
                  
                   <div class=\"form-group\">
                        <label class=\"control-label\">Spesialisasi</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Spesialisasi\" name=\"spesialisasi\" value=\"$r[spesialisasi]\" required>
                   </div>
                   
                   <div class=\"form-group\">
                        <label class=\"control-label\">Jenis Kelamin</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Gender\" name=\"jenis_kelamin\" value=\"$r[jns_kelamin]\" required>
                   </div>
                   
                    <div class=\"form-group\">
                        <label class=\"control-label\">Bagi Hasil %</label>
                        <input type=\"text\" class=\"form-control\" placeholder=\"Bagi Hasil\" value=\"$r[bagi_hasil]\" name=\"bagi_hasil\" required>
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