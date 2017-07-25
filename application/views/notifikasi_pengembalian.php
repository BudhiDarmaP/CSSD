
<!DOCTYPE html>
<html>
    <title>Notifikasi Pengembalian</title>
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
            background-image: url(<?php echo base_url('images/RSUD.jpg'); ?>);
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
            padding: 2px;
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
            height:38px; margin-left:3px;'
            }
        </style>
        <body>

            <!-- Navbar (sit on top) -->
            <div class="w3-top">
                <?php
                $this->load->view("header_footer/header_main");
                $pengembalian = $_SESSION['pengembalian'];
                ?>
            </div>

            <!-- First Parallax Image with Logo Text -->
            <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
            </div>

            <table style="width:100%" align='center'>
                <tr><th>
                <div class="w3-container w3-center w3-margin-top">
                    <div class="w3-container w3-responsive w3-margin-bottom w3-center">
                        <?php
                        if ($pengembalian == NULL) {
                            echo "<h4 style='text-align: center;margin-bottom:15%' class='w3-theme w3-padding w3-large'>"
                            . "<b class='w3-padding-16 w3-xxlarge'>Tidak ada jadwal amprah yang dikembalikan hari ini"
                            . "<br><img src='";
                            echo base_url('images/note.png');
                            echo "' class='w3-center w3-margin-top w3-margin-bottom w3-animate-top'></h4>";
                        } else {
                            echo "<b style='color: green;' class='w3-xxlarge w3-text-green w3-animate-opacity w3-animate-left'>Daftar Amprah Belum Dikembalikan Hari Ini</b>";
                            echo "
                <table class = 'w3-table w3-striped w3-bordered w3-card' align = 'center' style='width:70%'>
                <thead><tr class = 'w3-theme'>
                
                <th style = 'text-align: left;' class='w3-card'>No.</th>
                <th style = 'text-align: left;' class='w3-card'>ID TRANSAKSI</th>
                <th style = 'text-align: left;' class='w3-card'>Peminjam</th>
                <th style = 'text-align: left;' class='w3-card'>No. Telepon</th>
                <th style = 'text-align: left;' class='w3-card'>Jenis Peminjam</th>
                <th style = 'text-align: center;' class='w3-card'>Tanggal Pinjam</th>
                <th style = 'text-align: center;' class='w3-card'>Belum Kembali</th>
                </tr>
                <tbody>";

                            $nomor = 1;
                            $jenis_peminjam = '';
                            foreach ($pengembalian as $r):
                                if ($r->status_user == 2) {
                                    $jenis_peminjam = 'Internal';
                                } else if ($r->status_user == 3) {
                                    $jenis_peminjam = 'Eksternal';
                                }
                                echo "<form action='";
                                echo base_url('site/lihat_peminjamanan_detail');
                                echo "' method='POST'>";
                                echo "
                <tr>
                <td>$nomor</td>
                <td style='text-align: left'>$r->id_transaksi</td>
                <td style='text-align: left;width:25%'><b>$r->nama_user</b></td>
                <td style='text-align: left;'><b>$r->no_telepon</b></td>
                <td style='text-align: left;'><b>$jenis_peminjam</b></td>
                <td style='text-align: center' class='w3-text-red'>$r->tanggal_pinjam</td>
                <td style='text-align: center'>$r->jumlah_pinjam Instrumen</td>";
                                $nomor++;
                            endforeach;
                            echo "</tbody></table>";
                        }
                        ?>

                    </div>
                </div>
            </th></tr>
        <tr>
            <td style="text-align:center">
                <img src='<?php echo base_url('images/note.png')?>' class='w3-center w3-margin-top w3-margin-bottom w3-center'>
            </td>
        </tr></table>

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
