<!DOCTYPE html>
<html>
    <title>Konfirmasi Peminjaman</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
    <link href="<?php echo base_url('images/Logo.png'); ?>" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/jquery-ui.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('/resources/demos/style.css')?>">
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-1.12.4.js')?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-ui.js')?>"></script>

    <script>
        $(function() {
            $("#datepicker").datepicker({minDate: 0});
            $("#datepicker").datepicker({dateformat: 'dd-MM-yy HH:mi'});
        });
        $(function() {
            $("#datepicker2").datepicker({minDate: 0});
            $("#datepicker2").datepicker({dateformat: 'dd-MM-yy HH:mi'});
        });

        function validasi_input(form) {
            if (form.peminjam.value == "" && <?php
$status_user = $_SESSION["status_user"];
echo "$status_user";
?> == 1) {
                swal("Anda belum memilih peminjam!", "", "warning");
                form.peminjam.focus();
                return (false);
            }
            // varibel miliday sebagai pembagi untuk menghasilkan hari
            var miliday = 24 * 60 * 60 * 1000;
            //buat object Date
            var testanggal = form.tgl_pinjam.value;
            var testanggal2 = form.tgl_kembali.value;
            var tanggal1 = new Date(testanggal);
            var tanggal2 = new Date(testanggal2);
            // Date.parse akan menghasilkan nilai bernilai integer dalam bentuk milisecond
            var tglPertama = Date.parse(tanggal1);
            var tglKedua = Date.parse(tanggal2);
            var selisih = (tglKedua - tglPertama) / miliday;

            if (selisih < 0) {
                swal("Kesalahan dalam pemilihan tanggal!", "", "error");

                form.tgl_pinjam.focus();
                form.tgl_kembali.focus();
                return (false);
            }
            return (true);
        }
    </script>
    <script src="JavaScript.js"></script>
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
        .buttonPinjam{
            display: inlin-block;
            border-radius: 4px;
            background-color: #f44336;
            border: none;
            color: #fff;
            text-align: center;
            font-size: 22px;
            padding: 3px;
            width: 140px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;
        }
        .buttonPinjam span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }
        .buttonPinjam span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: 20px;
            transition: 0.5s;
        }
        .buttonPinjam:hover span {
            padding-right: 25px;
        }
        .inputTanggal input{
            width:200px; border:1px dotted #CI_Unit_test; 
            border-radius:4px; -moz-border-radius:4px; 
            height:38px; margin-left:3px;'
            }
        </style>
        <body>
            <?php
            if (isset($_SESSION["sudah_pinjam"])) {
                $login = $_SESSION["sudah_pinjam"];
                if ($login) {
                    redirect(base_url('site/lihat_peminjaman'));
                }
            }
            ?>
            <!-- Navbar (sit on top) -->
            <div class="w3-top">
                <?php
                $this->load->view("header_footer/header_peminjaman");
                $status_user = $_SESSION["status_user"];
                ?>
            </div>

            <!-- First Parallax Image with Logo Text -->
            <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
            </div>

            <!-- Container (About Section) -->
            <!--            <div class="w3-content w3-container w3-center" id="about">
                            <img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">
                        </div>-->

            <div class="w3-responsive w3-card-4 w3-padding-16" >
                <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
                    <b class='w3-padding '>Konfirmasi Peminjaman Setting Set </b>
                </div>

                <form action='<?php echo base_url('/PeminjamanControl/konfirmasi_set'); ?>' onsubmit="return validasi_input(this)">
                    <table  align="center" style="width:60%;margin-bottom:3%">
                        <tr style='text-align: center'>
                            <?php
                            if ($status_user == 1 || $status_user == 0) {
                                echo "<th style='text-align: center'>PEMINJAM</th>
                            <td style='text-align: right;color:red'><select class='w3-input w3-border w3-padding' name='peminjam' style='width: 80%;text-align:center' placeholder='Masukkan'>";
                                echo "
                                    <option value='' required='' disabled='disabled' selected>-- Pilih Peminjam --</option>
                                    ";
                                foreach ($id_peminjam as $r):
                                    echo "
                                    <option value='$r->id_user' style='color:black'>$r->nama_user</option>
                                    ";
                                endforeach;
                                echo "</select></td>
                            <td></td>
                            <th style='text-align: right'>TANGGAL PINJAM</th>
                            <td style='text-align: right' class='inputTanggal'><input type='text' id='datepicker' name='tgl_pinjam' placeholder='Klik untuk isi' required=''></td>
                            </tr>
                            <tr style='text-align: center'>
                            <th></th>
                            <td></td>
                            <td></td>
                            <th style='text-align: right'>TANGGAL KEMBALI</th>
                            <td style='text-align: right' class='inputTanggal'><input type='text' id='datepicker2' name='tgl_kembali' placeholder='Klik untuk isi' required=''></td>";
                            }else {
                                echo "<input type='hidden' name='peminjam' value=''>
                                    
                            <th style='text-align:center;'>TANGGAL PINJAM</th>
                            <td class='inputTanggal'><input type='text' id='datepicker' name='tgl_pinjam' placeholder='Klik untuk isi' required=''></td>
                            <td style='width:60%'></td>
                            
                                    
                            </tr>";
                            }
                            ?>
                        </tr></table>
                    <table class="w3-table w3-striped w3-bordered w3-card w3-animate-opacity" align="center" style="width:60%;margin-bottom:10%">
                        <thead>
                            <tr class="w3-theme">
                                <th style="text-align: center;">ID INSTRUMEN</th>
                                <th style="text-align: left;">NAMA INSTRUMEN</th>
                                <th style="text-align: center;">JUMLAH INSTRUMEN STERIL</th>
                                <th style="text-align: center;">JUMLAH PINJAM</th>
                            </tr>
                        <tbody>
                            <?php
                            foreach ($cari_instrumen as $r):
                                echo "
                                    <tr>
                                    <td style='text-align: center'>$r->id_instrumen</td>
                                    <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center'>$r->steril</td>
                                    <td style='text-align: center'>";
                                if ($r->jumlah > $r->steril) {
                                    echo "<input type='number' name='jumlah[]' value='$r->steril' max='$r->steril' min='0' placeholder='0' required='' onkeypress=\"return isNumber(event)\">";
                                } else {
                                    echo "<input type='number' name='jumlah[]' value='$r->jumlah' max='$r->steril' min='0' placeholder='0' required='' onkeypress=\"return isNumber(event)\">";
                                }
                                echo "<input type='hidden' value='$r->id_instrumen' name='id_instrumen[]'>    
                                    <input type='hidden' value='$r->steril' name='steril[]'>    
                                    </td>
                                    </tr>";
                            endforeach;
                            $this->session->unset_userdata('nama_instrumen');
                            $this->session->unset_userdata('cari_instrumen');
                            ?>
                        </tbody>
                        <tr>
                            <td colspan="4" style="text-align: center">
                                <button class="btn btn-warning w3-xlarge w3-hover-text-black" style="width:20%"><i class="fa fa-briefcase"></i> PINJAM</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="bgimg-3 w3-display-container w3-opacity-min">
            <div class="w3-animate-fading w3-padding-small">

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
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            var modal2 = document.getElementById('id02');
            // When the user clicks anywhere outside of the modal, close it
            modal2.style.display = "block";
            window.onclick = function(event) {
                if (event.target == modal2) {
                    modal2.style.display = "none";
                }
            }
        </script>
    </body>
</html>