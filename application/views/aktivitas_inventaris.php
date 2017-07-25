
<!DOCTYPE html>
<html>
    <title>Aktivitas Inventaris</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/w3.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/lato.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/jquery-ui.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('/resources/demos/style.css')?>">
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-1.12.4.js')?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-ui.js')?>"></script>
    <!--    <head>
            <meta http-equiv="refresh" content="5">
        </head>-->
    <script>
        <!--
        function showTime() {
//            var a_p = "";
            var today = new Date();
            var curr_hour = today.getHours();
            var curr_minute = today.getMinutes();
            var curr_second = today.getSeconds();
            var curr_bulan;
            if (curr_hour == 0) {
                curr_hour = 24;
            }


            var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            curr_bulan = monthNames[today.getMonth()];

            var dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var curr_day = dayNames[today.getDay()];
            curr_hour = checkTime(curr_hour);
            curr_minute = checkTime(curr_minute);
            curr_second = checkTime(curr_second);
            document.getElementById('clock').innerHTML = "<i class='fa fa-clock-o w3-large w3-text-green' style='margin-top:4px;margin-left:5px;margin-right:5px'></i>" + curr_day + ", " + curr_bulan + " " + today.getDate() + ", " + today.getFullYear() + " (" + curr_hour + ":" + curr_minute + ":" + curr_second + ")";
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        setInterval(showTime, 500);
        
        $(function() {
            $("#datepicker").datepicker({dateFormat: 'dd/mm/yy', maxDate: 0});

        });
        

        //-->
    </script>
    <style>
        body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
        body, html {
            height: 20%;
            color: #777;
            line-height: 1.8;
        }

        /* Create a Parallax Effect */
        .bgimg-1, .bgimg-2, .bgimg-3 {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* First image (Logo. Full height) */
        .bgimg-1 {
            background-image: url('images/Rute TransJogja.png');
            min-height: 100%;
        }

        /* Second image (Portfolio) */
        .bgimg-2 {
            min-height: 1000%;
        }

        /* Third image (Contact) */
        .bgimg-3 {
            background-image: url("");
            min-height: 400px;
        }

        .w3-wide {letter-spacing: 10px;}
        .w3-hover-opacity {cursor: pointer;}

        /* Turn off parallax scrolling for tablets and phones */
        @media only screen and (max-device-width: 1024px) {
            .bgimg-1, .bgimg-2, .bgimg-3 {
                background-attachment: scroll;
            }
        }
    </style>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <?php
            $this->load->view("header_footer/header_inventaris");
            ?>
        </div>

        <div id="id01" class="modal w3-responsive">
            <div class="modal-content animate w3-black" style="margin-top:8%;width:40%">
                <div class="w3-padding-16">
                    <table align="center" style="width:80%">
                        <tr>
                            <td colspan="2" style="text-align:center" class="w3-xlarge">
                                Pencarian Aktivitas Inventaris
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Berdasarkan Nama Pegawai CSSD :
                            </td>
                        </tr>
                        <tr><td style="color:gray">
                                <form method="" action='<?php echo base_url('/site/cari_aktivitas_inventaris'); ?>'>
                                    <?php
                                    echo "
                            <select class='w3-input w3-border w3-padding' name='pegawai' style='width:95%;' placeholder='Masukkan' required=''>";
                                    echo "
                                    <option value='' required='' disabled='disabled' selected>Pencarian Pegawai</option>
                                    ";
                                    foreach ($pegawai as $r):
                                        echo "
                                    <option value='$r->id_user' style='color:black'>$r->nama_user</option>
                                    ";
                                    endforeach;
                                    echo "</select></td>";
                                    ?>
                                    <td><button class="btn btn-success w3-hover-text-black" name="cari" value="CARI"><i class="fa fa-search"></i>&nbsp;</button></td>
                                </form>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Berdasarkan Tanggal :
                            </td>
                        </tr>
                        <tr>
                        <form method="" action='<?php echo base_url('/site/cari_aktivitas_inventaris'); ?>'>
                            <td style="color:black">
                                <input class='inputTanggal' style="height: 40px;width:95%;" type="text" class="form-control" id='datepicker' required='' name="tanggal" placeholder="Pencarian Tanggal">
                            </td>
                            <td><button class="btn btn-warning w3-hover-text-black" name="cari" value="CARI"><i class="fa fa-search"></i>&nbsp;</button></td>
                        </form>
                        </tr></table> 
                </div>
            </div>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <div class="bgimg-2 w3-display-container">
            <div  class="w3-display-topmiddle" style="width: 95%;">
                <table align="center" style="width:100%" class="w3-margin-right"><tr>
                        <th class="w3-top" style="width:50%">
                    <table class="w3-table w3-striped w3-bordered w3-card w3-margin-right w3-opacity-min w3-hover-opacity-off" align="center">
                        <tbody class="w3-margin-top">
                            <tr>
                                <th colspan="6" class="w3-green w3-animate-opacity">
                        <h3 class="w3-left w3-xlarge"><i class='fa fa-briefcase w3-xxlarge'></i> <b>Aktivitas Peminjaman</b></h3>
                        <?php
                        if (isset($cari)) {
                            echo "<tr><td colspan='6' class='w3-white'><h4 class='w3-left w3-large'> Pencarian : $cari </h4></td></tr>";
                        }
                        ?>
                        </th>

                        </tr>
                        <tr class="w3-margin-top">
                            <?php
                            if (isset($cari_peminjaman)) {
                                $aktivitasPinjam = count($cari_peminjaman);
                                $aktivitasInstrumen = count($cari_instrumen);
                                
                                if ($aktivitasInstrumen==0 && $aktivitasPinjam==0){
                                    echo "<script>swal(\"Aktivitas Inventaris Kosong\", \"Pencarian : $cari\", \"error\");</script>";
                                }
                                if ($aktivitasPinjam == 0) {
                                    echo "<tr>"
                                    . "<td colspan='3' style='margin-bottom:50%'>Tidak Ada Aktivitas Peminjaman ($cari)</td>"
                                    . "";
                                } else {
                                    foreach ($cari_peminjaman as $r):
                                        echo "<tr>"
                                        . "<td style='text-align:'>$r->hari, </td>"
                                        . "<td>$r->tanggal</td>"
                                        . "<td style='color:red'><u style='color:blue'>$r->nama_user</u>, melakukan approve terhadap peminjaman <br><u style='color:blue'>$r->peminjam</u>. Transaksi : <b style='color:black'>$r->id_transaksi</b></td>"
                                        . "</tr>";
                                    endforeach;
                                }
                            } else {
                                $aktivitasPinjam = count($peminjaman);
                                if ($aktivitasPinjam == 0) {
                                    echo "<tr>"
                                    . "<td colspan='3' style='margin-bottom:50%'>Belum Ada Aktivitas Peminjaman Hari ini</td>"
                                    . "";
                                } else {
                                    foreach ($peminjaman as $r):
                                        echo "<tr>"
                                        . "<td style='text-align:'>$r->hari, </td>"
                                        . "<td>$r->tanggal</td>"
                                        . "<td style='color:red'><u style='color:blue'>$r->nama_user</u>, melakukan approve terhadap peminjaman <br><u style='color:blue'>$r->peminjam</u>. Transaksi : <b style='color:black'>$r->id_transaksi</b></td>"
                                        . "</tr>";
                                    endforeach;
                                }
                            }
                            ?>

                        </tr>
                        </tbody>
                    </table>
                    </th>
                    <th class="w3-row-padding" style="width:1%">
                        <!--<div ></div>-->
                    </th>
                    <th class="w3-top" style="width:49%">
                    <table class="w3-table w3-striped w3-bordered w3-card w3-margin-left w3-margin-right w3-opacity-min w3-hover-opacity-off" align="center">
                        <tbody class="w3-margin-top">
                            <tr>
                                <th colspan="6" class="w3-theme w3-animate-opacity">
                        <h3 class="w3-left w3-xlarge">
                            <i class='fa fa-scissors w3-xxlarge'></i> <b>Aktivitas Inventaris Instrumen</b>
                        </h3>
                        <?php
                        if (isset($cari)) {
                            echo "<tr><td colspan='6' class='w3-white'><h4 class='w3-left w3-large'> Pencarian : $cari </h4></td></tr>";
                        }
                        ?>
                        </th>

                        </tr>
                        <tr class="w3-margin-top">
                            <?php
                            if (isset($cari_instrumen)) {
                                $aktivitasInstrumen = count($cari_instrumen);
                                if ($aktivitasInstrumen == 0) {
                                    echo "<tr>"
                                    . "<td colspan='3' style='text-align:'>Tidak Ada Aktivitas Inventaris Instrumen ($cari)</td>"
                                    . "";
                                } else {
                                    foreach ($cari_instrumen as $r):
                                        echo "<tr>"
                                        . "<td style='text-align:'>$r->hari, </td>"
                                        . "<td>$r->tanggal</td>"
                                        . "<td style='color:red'><u style='color:blue'>$r->nama_user</u>, $r->keterangan Instrumen <u style='color:blue'>$r->nama_instrumen</u></td>"
                                        . "</tr>";
                                    endforeach;
                                }
                            } else {
                                $aktivitasInstrumen = count($instrumen);
                                if ($aktivitasInstrumen == 0) {
                                    echo "<tr>"
                                    . "<td colspan='3' style='text-align:'>Belum Ada Aktivitas Inventaris Instrumen Hari ini</td>"
                                    . "";
                                } else {
                                    foreach ($instrumen as $r):
                                        echo "<tr>"
                                        . "<td style='text-align:'>$r->hari, </td>"
                                        . "<td>$r->tanggal</td>"
                                        . "<td style='color:red'><u style='color:blue'>$r->nama_user</u>, $r->keterangan Instrumen <u style='color:blue'>$r->nama_instrumen</u></td>"
                                        . "</tr>";
                                    endforeach;
                                }
                            }
                            ?>

                        </tr>
                        </tbody>
                    </table>
                    </th>
                    </tr></table>
            </div>

        </div>
        <script>
        function myFunction() {
            var navbar = document.getElementById("myNavbar");
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                navbar.className = "w3-bar" + " w3-card-2" + " w3-animate-top" + " w3-white";
            } else {
                navbar.className = navbar.className.replace(" w3-card-2 w3-animate-top w3-white", "");
            }
        }
        function toggleFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        var modal2 = document.getElementById('id02');
        modal2.style.display = "block";
        </script>
    </body>
</html>
