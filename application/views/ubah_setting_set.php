<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
        <link href="<?php echo base_url('bootstrap-3.3.6/css/scroll.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
        <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
        <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
        <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
        <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
        <title>Edit Setting Set</title>
    </head>
    <script>
        function validate()
        {
            var chks = document.getElementsByName('id[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++)
            {
                if (chks[i].checked)
                {
                    hasChecked = true;
                    break;
                }
            }

            if (hasChecked == false)
            {
                swal("Pilih instrumen!", "", "warning");
                return false;
            }

            return true;
        }
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
            background-image: url('Gambar/Rute2.png');
            min-height: 100%;
        }

        .w3-wide {letter-spacing: 10px;}
        .w3-hover-opacity {cursor: pointer;}

        /* Turn off parallax scrolling for tablets and phones */
        @media only screen and (max-device-width: 1024px) {
            .bgimg-1, .bgimg-2, .bgimg-3 {
                background-attachment: scroll;
            }
        }
        .buttonTambah{
            display: inline-block;
            border-radius: 4px;
            background-color: green;
            border: none;
            color: #fff;
            text-align: center;
            font-size: 22px;
            padding: 5px;
            width: 140px;
            /*height: 50px;*/
            /*transition: all 0.5s;*/
            cursor: pointer;
            margin: 5px;
        }

        .buttonTambah span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            /*transition: 0.5s;*/
        }

        .buttonTambah span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            /*transition: 0.5s;*/
        }

        .buttonTambah:hover span {
            padding-right: 25px;
        }

        .buttonAtur:hover span:after {
            opacity: 1;
            right: 0;
        }

        .scroll {
            height: 450px;
        }
    </style>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <?php
            $this->load->view("header_footer/header_instrumen");
            $nama_set;
            ?>
        </div>

        <div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
        </div>

        <?php
        if (isset($_GET['setting_set'])) {
            $setting_set=$_GET['setting_set'];
            if ($setting_set=='true') {
                echo "<script>swal(\"Ubah Setting Set Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
            } else if($setting_set=='false'){
                echo "<script>swal(\"Ubah Setting Set Gagal\", \"Tekan OK untuk melanjutkan\", \"error\");</script>";
            }
        }
        
        if(isset($_SESSION['nama_set_baru'])){
            $nm = $_SESSION['nama_set_baru'];
            echo "<script>swal(\"Ubah Nama Setting Set Berhasil\", \"Nama : $nm\", \"success\");</script>";
            $this->session->unset_userdata('nama_set_baru');
        }
        
        ?>

        <div class="w3-content w3-container w3-center" id="about">
        </div>

        <div class="w3-container w3-margin-top">
            <div class="w3-responsive w3-card-4 w3-padding-16" >
                <div class="w3-container w3-white w3-padding-16" style="width:100%">
                    <div class="w3-row-padding w3-card w3-padding-16" style="margin:0 50px;margin-bottom:5%">
                        <table align="center" style="width:100%;"><tr><td>
                                    <div class="w3-half w3-margin-bottom" style="width:40%">
                                        <th style="width: 35%;text-align:right">
                                            <form action="<?php echo base_url('InstrumenControl/panggil_ubah_setting_set'); ?>">
                                                <label><select class='form-control w3-input w3-border w3-padding w3-bordered' name='set' required="" style="height:40px;width:98%;text-align: center">
                                                        <option value='' required='' disabled='disabled' selected>-- Pilih Setting Set --</option>
                                                        <?php
                                                        foreach ($set as $s):
                                                            echo "
                                                        <option value='$s->id_set' style='color:black'>$s->nama_set</option>";
                                                        endforeach;
                                                        ?>
                                                    </select></label>
                                                <button class="buttonTambah w3-hover-text-black w3-orange" type="submit" name="ubah" value="yes"><i class="fa fa-pencil-square-o"></i> UBAH</button>
                                            </form></th>
                                        <table align="center" style="width:100%;"><tr><th style="width: 35%;text-align:center">
                                                    <div class="w3-container w3-responsive w3-margin-bottom w3-left w3-animate-left w3-xxlarge w3-center" style="width:100%">
                                                        <?php
                                                        if (isset($_SESSION["ada_instrumen"])) {
                                                            $tampil=$_SESSION["nama_set"];
                                                            echo '<b class="fa fa-stethoscope" style="color: red;"></b> Ubah Setting: <b style="color: red;">';
                                                            echo $tampil;
                                                            echo " </b><a onclick=\"document.getElementById('id02').style.display = 'block'\"  class=\"btn btn-default w3-text-green w3-xlarge w3-hover-text-black w3-margin-bottom\" style=\"\" title=\"Ubah Nama Setting Set\"><i class=\"fa fa-edit\"></i></a>
                                                            <br><b style=\"color: green;\">Pilih Daftar Instrumen</b>";
                                                        }else{
                                                            echo'<h1 style="color: green;" class="fa fa-stethoscope"></h1>';
                                                        }
                                                        ?>
                                                    </div></table>
                                        <form method="POST" action="<?php echo base_url('/InstrumenControl/ubah_setting_set'); ?>" class="scroll">
                                            <table class="w3-table w3-striped w3-bordered w3-animate-opacity w3-card" align="center" style="">
                                                <tbody>
                                                    <?php
                                                    $tampil = 0;
                                                    $ada_instrumen;
                                                    if (isset($_SESSION["ada_instrumen"])) {
                                                        $ada_instrumen = $_SESSION["ada_instrumen"];
                                                        if ($ada_instrumen) {
                                                            $tampil = count($ada_instrumen);
                                                        }
                                                    }
                                                    if ($tampil == 0) {
                                                        echo "<tr><td style='text-align: center;' colspan='4'>
                                                    <h3 style='color: red' class='w3-padding-64'>TIDAK ADA INSTRUMEN</h3></td></tr>";
                                                    } else {
                                                        echo "<tr class='w3-theme'>
                                                    <th style='width:5%'></th>
                                                    <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                                    <th style='text-align: center;'>JUMLAH</th>
                                                    <th style='text-align: center;'>INPUT</th>
                                                    <th style='text-align: center;'></th>
                                                    </tr>";


                                                        if (isset($ada_instrumen)) {
                                                            $nomor = 1;
                                                            foreach ($ada_instrumen as $r):
                                                                if ($r->nama_instrumen==null) {
                                                                    redirect(base_url('/site/ubah_setting_set/?setting_set=false'));
                                                                }
                                                                echo "
                                                    <tr>
                                                    <td>$nomor.</td>
                                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>";
                                                                if (!isset($r->data)) {
                                                                    echo "<td style='text-align: center'>$r->jumlah</td>
                                                    <td style='text-align: center'>
                                                    <input type='number' name='input[]' min='0' max='$r->jumlah' value='1'></td>";
                                                                } else {
                                                                    echo "<td style='text-align: center'>$r->data</td>
                                                    <td style='text-align: center'>
                                                    <input type='number' name='input[]' min='0' max='$r->data' value='$r->jumlah'></td>";
                                                                }
                                                                echo"<input type='hidden' name='id[]' value='$r->id_instrumen'>
                                                    </form>
                                                    <form action='";
                                                                echo base_url('InstrumenControl/hapus_instrumen');
                                                                echo "' method='GET'>
                                                    <td style='width:1%; text-align: left'>
                                                    <button type='submit' style='margin-top:0px;' class='btn w3-hover-text-black w3-red' name='nomor_index' value='$r->id_instrumen' title='Hapus dari list'>
                                                    <b><i class='fa fa-close'></i></b></button></td>
                                                    </form>
                                                    </td></tr>";
                                                                $nomor++;
                                                            endforeach;
                                                            $nama_set = $_SESSION["nama_set"];
                                                            $id_set = $_SESSION["id_set"];
                                                            echo "<input type='hidden' name='nama_set' value='$nama_set'>
                                                              <input type='hidden' name='id_set' value='$id_set'>";
                                                        }
                                                        echo "<tr style='text-align: right'> <td colspan='5'style='text-align: center'>
                                                            <a onclick=\"document.getElementById('id01').style.display = 'block'\"  class=\"btn btn-default w3-text-green w3-xlarge w3-hover-text-black w3-margin-top\" style=\"width:10%\" title=\"Tambah list pinjam\"><i class=\"fa fa-plus\"></i></a>
                                                            <button class=\"btn btn-default w3-xlarge w3-hover-text-black w3-margin-top w3-green\" style=\"width:20%\"><i class=\"fa fa-edit\"></i> SIMPAN</button>
                                                        </td></tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                    </div>
                        </table>
                    </div>
                    <div id="id01" class="modal w3-responsive">
                        <div class="modal-content w3-white" style="margin-top:5%;width:70%">
                            <div class="w3-padding-16">
                                <span onclick="document.getElementById('id01').style.display = 'none'" class="w3-xxlarge close w3-margin-top w3-hover-text-red" title="Tutup">&times;</span>
                                <table align="center" style="width:90%" class="w3-card">
                                    <tr class="w3-green">
                                        <td colspan="2" style="text-align:center" class="w3-xlarge">
                                            <b>Penambahan Daftar Pinjam</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <form action='<?php echo base_url('InstrumenControl/tambah_instrumen'); ?>' class="scroll">
                                                <table class="w3-table w3-striped w3-bordered w3-animate-opacity w3-card" align="center" style="width:100%;">
                                                    <tr class='w3-theme'>
                                                        <th></th>
                                                        <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                                        <th style='text-align: center;'>JUMLAH INSTRUMEN</th>
                                                        <th style='text-align: center;'>PILIH</th>
                                                    </tr>
                                                    <?php
                                                    $cetak = true;
//                                                    $tambah_instrumen = $_SESSION["tambah_instrumen"];
                                                    if (isset($tambah_instrumen)) {
                                                        $index = 1;
                                                        foreach ($tambah_instrumen as $r):
                                                            foreach ($ada_instrumen as $row) {
                                                                if ($r->id_instrumen == $row->id_instrumen) {
                                                                    $cetak = false;
                                                                    break;
                                                                }
                                                            }

                                                            if ($cetak) {
                                                                echo "
                                                            <tr>
                                                            <td>$index. </td>
                                                            <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                                            <td style='text-align: center'>$r->steril</td>
                                                            <td style='text-align: center'>
                                                            <input type='checkbox' name='id[]' value='$r->id_instrumen'>
                                                            </td>
                                                            </tr>";
                                                                $index++;
                                                            }
                                                            $cetak = true;
                                                        endforeach;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td colspan='4' style='text-align: center'>
                                                            <button class='btn btn-success w3-xlarge w3-hover-text-black' style='width:40%'><i class='fa fa-plus-circle'></i> TAMBAH</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                </table> 

                            </div>
                        </div>
                    </div>
                    
                    <div id="id02" class="modal w3-responsive">
                        <div class="modal-content w3-white" style="margin-top:5%;width:50%">
                            <div class="w3-padding-16">
                                <span onclick="document.getElementById('id02').style.display = 'none'" class="w3-xxlarge close w3-margin-top w3-hover-text-red" title="Tutup">&times;</span>
                                <table align="center" style="width:80%" class="w3-card">
                                    <tr class="w3-green">
                                        <td colspan="2" style="text-align:center" class="w3-xlarge">
                                            <b>Ubah Nama Setting Set</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <form action='<?php echo base_url('InstrumenControl/ubah_nama_set'); ?>'>
                                                <table class="w3-table w3-striped w3-bordered w3-animate-opacity w3-card" align="center" style="width:100%;">
                                                    <tr class='w3-theme'>
                                                        <table align="center" style="width:80%;"><tr><td>
                                        <div class="w3-half w3-margin-top" style="width:100%">
                                            <label>Nama Setting Set :</label>
                                            <?php
                                            if (isset($_SESSION["nama_set"])) {
                                                $nama_set=$_SESSION["nama_set"];
                                                $posisi = strpos($nama_set,": ");
                                                if ($posisi) {
                                                $nama= explode(': ', $nama_set);
                                                echo "<input class='w3-input w3-border' type='text' placeholder='Masukkan nama baru setting set' value='$nama[0]' name='nama' required>"
                                                        . "<label>Jenis Setting Set : </label>"
                                                        . "<input class='w3-input w3-border' type='text' placeholder='Masukkan jenis baru setting set' name='jenis' value='$nama[1]'>";
                                                }else {
                                                echo "<input class='w3-input w3-border' type='text' placeholder='Masukkan nama baru setting set' value='$nama_set' name='nama' required>"
                                                        . "<label>Jenis Setting Set : </label>"
                                                        . "<input class='w3-input w3-border' type='text' placeholder='Masukkan jenis baru setting set' name='jenis' value=''>";
                                                }
                                            }
                                            ?>
                                        </div>
                                                </tr>
                                                <tr>
                                                    <td colspan='4' style='text-align: center'>
                                                        <button class='btn btn-success w3-xlarge w3-hover-text-black' style=''><i class='fa fa-edit'></i> Ubah</button>
                                                    </td>
                                                    </tr>
                                                    <tr><td>
                                                            <div class="w3-half w3-margin-top" style="width:100%"></div>
                                                        </td></tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                </table> 
                            </div>
                        </div>
                    </div>
                    
                    <div class="w3-half w3-margin-bottom">
                    </div>
                </div>
            </div>

            <?php
            $this->load->view("header_footer/footer");
            ?>
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
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                var modal2 = document.getElementById('id02');
                window.onclick = function (event) {
                    if (event.target == modal2) {
                        modal2.style.display = "none";
                    }
                }
            </script>
    </body>
</html>