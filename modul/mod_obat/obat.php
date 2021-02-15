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
                      nm_obat : "required",
                      harga_modal : {
                          required : true,
                          number : true
                      }, 
                      harga_jual:{
                          required : true,
                          number : true
                      },
                      stok :{
                          required : true, 
                          number: true
                      }, 
                      ket : "required"
                  },
        //set dengan bahasa indonesia          
                messages:{
                    nm_obat:{
                        required:'Nama Tidak Boleh Kosong !!!'
                    },
                    harga_modal:{
                        required :'Harga Harus Di isi',
                        number:'Di isi Dengan Angka Saja'
                    },
                    harga_jual:{
                        required :'Harga Harus Di isi',
                        number:'Di isi Dengan Angka Saja'
                    }, 
                    stok: {
                        required : 'Stok Tidak Boleh Kosong', 
                        number : 'Di isi dengan angka saja'
                    }, 
                    ket : {
                        required : 'Keterangan Tidak Boleh Kosong'
                    } 
                }  
              });  
            });
    </script>
<?php
//apabila belum login
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
    $aksi = "modul/mod_obat/aksi_obat.php";
    $act = isset($_GET['act']) ? $_GET['act'] : '';
    
    $dataKode = buatKode("obat", "H");
    
    switch($act){
        default :
             echo"     <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=obat\">Data Obat</a>
            </li>
        </ul>
    </div>"; 
     echo "<div class=\"row\">
       <div class=\"box col-md-12\">
       <div class=\"box-inner\">
    <div class=\"box-header well\" data-original-title=\"\">
        <h2><i class=\"glyphicon glyphicon-user\"></i> Data Obat</h2>

        <div class=\"box-icon\">
            
            <a href=\"#\" class=\"btn btn-minimize btn-round btn-default\"><i
                    class=\"glyphicon glyphicon-chevron-up\"></i></a>
            <a href=\"#\" class=\"btn btn-close btn-round btn-default\"><i class=\"glyphicon glyphicon-remove\"></i></a>
        </div>
    </div>
       <div class=\"box-content\">
       <div class=\"alert alert-info\"><button class=\"btn btn-success\" onclick=window.location.href=\"?module=obat&act=tambahobat\">Tambah Data</button></div>
       ";
     echo "<table class=\"table table-striped table-bordered bootstrap-datatable datatable responsive\">
       <thead>
    <tr>
         <th>No.</th>    
        <th>Nama Obat</th>
        <th>Harga Modal</th>
        <th>Harga Jual</th>
        <th>Stok</th>
        <th>Action</th> 
    </tr>
    </thead>
    <tbody>"; 
   $query  = "SELECT * FROM obat";
   $tampil = mysql_query($query,$koneksidb);
    $no = 1;
    while ($tyo = mysql_fetch_array($tampil)):
         $harga_jual = format_angka($tyo['harga_jual']); 
         $harga_modal = format_angka($tyo['harga_modal']);
         echo "<tr><td>$no</td>
             <td>$tyo[nm_obat]</td>
             <td>Rp. $harga_modal</td>
             <td>Rp. $harga_jual</td>
             <td>$tyo[stok]</td>
            ";
        echo "           
                   <td>       
            <a class=\"btn btn-info\" href=\"?module=obat&act=editobat&kd_obat=$tyo[kd_obat]\">
                <i class=\"glyphicon glyphicon-edit icon-white\"></i>
                Edit
            </a>
            <a class=\"btn btn-danger\" href=\"$aksi?module=obat&act=hapus&kd_obat=$tyo[kd_obat]\" onclick=\"return confirm('ANDA YAKIN AKAN MENGHAPUS DATA TINDAKAN KLINIK INI..?')\">
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
        
    case "tambahobat":
        echo " <div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=obat\">Form Tambah Obat</a>
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
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=obat&act=input\">
                    <div class=\"form-group\">
                        <label>Kode Obat</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_obat\" placeholder=\"Kode Obat\" value=\"$dataKode\" readonly=\"readonly\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Obat</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_obat\" id=\"nm_obat\"  placeholder=\"Nama Obat\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Harga Modal</label>
                        <input type=\"text\" class=\"form-control\" name=\"harga_modal\" id=\"harga_modal\"  placeholder=\"Harga Modal\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Harga Jual</label>
                        <input type=\"text\" class=\"form-control\" name=\"harga_jual\" id=\"harga_jual\"  placeholder=\"Harga Jual\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Stok</label>
                        <input type=\"text\" class=\"form-control\" name=\"stok\" id=\"stok\"  placeholder=\"Stok\" required>
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Keterangan</label>
                        <input type=\"text\" class=\"form-control\" name=\"ket\" id=\"ket\"  placeholder=\"Keterangan\" required>
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
    
    case "editobat":
        $query = "SELECT * FROM obat WHERE kd_obat = '$_GET[kd_obat]'";
        $tampil = mysql_query($query,$koneksidb);
        $r = mysql_fetch_array($tampil);
        
        $dataKode = $r['kd_obat']; 
        
        echo "<div>
        <ul class=\"breadcrumb\">
            <li>
                <a href=\"?module=beranda\">Home</a>
            </li>
            <li>
                <a href=\"?module=obat\">Form Edit Obat</a>
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
                <form role=\"form\" class=\"cmxform\" id=\"form1\" method=\"POST\" action=\"$aksi?module=obat&act=update\">
                    <input type=\"hidden\" name=\"Kode\" value=\"$r[kd_obat]\">
                    <div class=\"form-group\">
                        <label>Kode Obat</label>
                        <input type=\"text\" class=\"form-control\"  name=\"kd_obat\" placeholder=\"Kode Obat\" value=\"$dataKode\" readonly=\"readonly\">
                        <input type=\"hidden\" name=\"Kode\" value=\"$r[kd_obat]\">
                            
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Nama Obat</label>
                        <input type=\"text\" class=\"form-control\" name=\"nm_obat\" id=\"nm_obat\"  placeholder=\"Nama Obat\" required value=\"$r[nm_obat]\">
                        <input type=\"hidden\" value=\"$r[nm_obat]\" name=\"txtNama\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Harga Modal</label>
                        <input type=\"text\" class=\"form-control\" name=\"harga_modal\" id=\"harga_modal\"  placeholder=\"Harga Modal\" required value=\"$r[harga_modal]\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Harga Jual</label>
                        <input type=\"text\" class=\"form-control\" name=\"harga_jual\" id=\"harga_jual\"  placeholder=\"Harga Jual\" required value=\"$r[harga_jual]\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Stok</label>
                        <input type=\"text\" class=\"form-control\" name=\"stok\" id=\"stok\"  placeholder=\"Stok\" required value=\"$r[stok]\">
                    </div>
                    
                    <div class=\"form-group\">
                        <label>Keterangan</label>
                        <input type=\"text\" class=\"form-control\" name=\"ket\" id=\"ket\"  placeholder=\"Keterangan\" required value=\"$r[keterangan]\">
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
