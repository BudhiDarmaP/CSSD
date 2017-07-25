<!DOCTYPE html>
<html>
    <title>Konfirmasi Pengembalian</title>
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

        function pilihsemua()
        {
            var transaksi = document.getElementsByName("id_instrumen[]");
            var jml = transaksi.length;
            var b = 0;
            for (b = 0; b < jml; b++)
            {
                transaksi[b].checked = true;

            }
        }

        function bersihkan()
        {
            var transaksi = document.getElementsByName("id_instrumen[]");
            var jml = transaksi.length;
            var b = 0;
            for (b = 0; b < jml; b++)
            {
                transaksi[b].checked = false;

            }
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
            width: 170px;
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
            height:38px; margin-left:3px;
        }
        .inputKet input{
            width:300px; border:1px dotted #CI_Unit_test; 
            border-radius:4px; -moz-border-radius:4px; 
            height:38px; margin-left:3px;
        }
    </style>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <?php
            $this->load->view("header_footer/header_main");
            ?>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <?php
        if (isset($_SESSION["konfirmasi"])) {
            $ubah = $_SESSION["konfirmasi"];
            if (!$ubah) {
                echo "<script>swal(\"Konfirmasi Pengembalian Gagal\", \"Tekan OK untuk melanjutkan\", \"error\");</script>";
            }
            if ($ubah != NULL) {
                echo "
            <div class='w3-content w3-container w3-center' id='about'>
                <img src='";
                echo base_url('images/LogoCSSD.png');
                echo "' class='w3-center w3-margin-top w3-margin-bottom w3-animate-top'>
            </div>";
            }
        }
        ?>

        <div class="w3-responsive w3-card-4 w3-padding-16" >

            <?php
            if (isset($_SESSION["konfirmasi"])) {
                $cek = $_SESSION["konfirmasi"];
                $id_transaksi = $_SESSION["transaksi"];
                if ($cek != NULL) {
                    echo "
                        <div class='w3-container w3-responsive w3-margin-bottom w3-center'>
                        <h4 style='color: red;margin-bottom:20%'><b>ID TRANSAKSI PEMINJAMAN TIDAK DITEMUKAN ATAU SUDAH DIKEMBALIKAN</b><br>ID Transaksi : $id_transaksi</h4>
                        </div>";
                }
                $this->session->unset_userdata('konfirmasi');
                $this->session->unset_userdata('transaksi');
            } else {
                $nama_user;
                foreach ($pengembalian as $r):
                    $nama_user = $r->nama_user;
                endforeach;
                echo "
                        <div class='w3-container w3-responsive w3-margin-bottom w3-center w3-card w3-green'>
                            <b class='w3-padding w3-animate-left w3-xlarge'>Konfirmasi Pengembalian <u class='w3-hover-text-black'>$nama_user</u></b>
                            <br><span class='w3-large'>ID Transaksi : $id_transaksi</span>
                        </div>
                        <form method='POST' action='";
                echo base_url('PengembalianControl/konfirm');
                echo "'>";
                echo "
                        <table class='w3-table w3-striped w3-bordered' align='center' style='width:70%;color:red'>
                        <tr><th>
                        <b>Centang <u>CEK</u> jika instrumen baik, Pilih \"<u><i class='fa fa-close'></i> Kendala</u>\" jika instrumen rusak/hilang.</b>
                        </th></tr>
                        </table>
                            <table class='w3-table w3-striped w3-bordered w3-card w3-animate-opacity' align='center' style='width:70%;margin-bottom:15%'>
                            <thead>
                            <tr class='w3-theme'>
                            <th style='text-align: center;'>TANGGAL PINJAM</th>
                            <th style='text-align: center;'>TANGGAL KEMBALI</th>
                            <th style='text-align: left;'>NAMA INSTRUMEN</th>
                            <th style='text-align: center;'>JUMLAH PINJAM</th>
                            <th style='text-align: center;'>CEK</th>
                            <th style='text-align: center;'></th>
                            </tr>";
                foreach ($pengembalian as $r):
                    echo "<tbody>
                             <tr>
                            <td style='text-align: center'>$r->tanggal_pinjam</td>
                            <td style='text-align: center'>$r->tanggal_kembali</td>
                            <td style='text-align: left'><b>$r->nama_instrumen</b></td>
                            <td style='text-align: center'>$r->jumlah_pinjam</td>
                            <td style='text-align: center'><input type='checkbox' value='$r->id_instrumen' name='id_instrumen[]'></td>
                            <input type='hidden' value='$r->id_transaksi' name='transaksi'>
                            </td>
                            <td style='text-align: center'><a href='";
                    echo base_url('site/konfirmasi_pengembalian_trouble');
                    echo "?id_transaksi=$r->id_transaksi&id_instrumen=$r->id_instrumen&nama_instrumen=$r->nama_instrumen&jumlah=$r->jumlah_pinjam'>
                        <b class='w3-text-red w3-hover-text-black'><i class='fa fa-close'></i> <u>Kendala</u></b></a></td>
                            </tr>";
                endforeach;
                echo "
                            <tr>
                                <td colspan='6' style='text-align:right'><a href='javascript:pilihsemua()'><u class='w3-hover-text-blue'>Check All</u></a>
                                &nbsp;&nbsp;<a href='javascript:bersihkan()'><u class='w3-hover-text-blue'>Uncheck All</u></a>
                                </td></tr>
                            <tr>
                            <tr>
                            <td colspan='6' style='text-align: center'>
                                <button class='btn btn-warning w3-xlarge w3-hover-text-black' style='width:20%'><i class='fa fa-briefcase'></i> KONFIRMASI</button>
                            </td>
                        </tr></tbody>
                    </table>
                    </form>";
            }
            $this->session->unset_userdata('konfirmasi');
            ?>
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
