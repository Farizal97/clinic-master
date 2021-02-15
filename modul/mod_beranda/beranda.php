<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $pasien = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM pasien")); ?>
        <a data-toggle="tooltip" title="Jumlah Pasien <?php echo $pasien['total']; ?>" class="well top-block" href="#">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Pasien</div>
            <div><?php echo $pasien['total']; ?></div>
            
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $dokter = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM dokter")); ?>
        <a data-toggle="tooltip" title="<?php echo $dokter['total']; ?>" class="well top-block" href="#">
            <i class="glyphicon glyphicon-star green"></i>

            <div>Dokter</div>
            <div><?php echo $dokter['total']; ?></div>
            
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
            <i class="glyphicon glyphicon-shopping-cart yellow"></i>

            <div>Sales</div>
            <div>$13320</div>
           
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <?php $obat = mysql_fetch_array(mysql_query("SELECT count(*) as total FROM obat")); ?>
        <a data-toggle="tooltip" title="Jumlah Obat <?php echo $obat['total']; ?>" class="well top-block" href="#">
            <i class="glyphicon glyphicon-heart red"></i>

            <div>Obat</div>
            <div><?php echo $obat['total']; ?></div>
         
        </a>
    </div>
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Introduction</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h1>Apotek Dan Klinik <br>
                        <small>Selamat Datang di sistem charisma hospital, sistem ini mengelola data apotek dan klinik</small>
                    </h1>
                    <p>Anda Saat Ini Login sebagai <?php echo $_SESSION['namauser']; ?> </p>

                    <p><b>Happy Coding - <a href="http://www.reinkarnasijreng.web.id/" target="_blank">Herry Prasetyo</a>
                        </b></p>

                   
                </div>
                
            </div>
        </div>
    </div>
</div>
