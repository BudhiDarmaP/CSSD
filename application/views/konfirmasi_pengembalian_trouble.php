<!DOCTYPE html>
<html>
    <title>Pengembalian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/scroll.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png'); ?>" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
        
        .scroll {
            height:700px;
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

        <div class="w3-responsive w3-card-4 w3-padding-16" >

            <?php
            $jumlah = $_GET['jumlah'];
            $id_instrumen = $_GET['id_instrumen'];
            $nama_instrumen = $_GET['nama_instrumen'];
            $id_transaksi = $_GET['id_transaksi'];
            echo "
                        <div class='w3-container w3-responsive w3-margin-bottom w3-center w3-card w3-green'>
                            <b class='w3-padding w3-animate-left w3-xlarge'>Kendala Pengembalian Instrumen<u class='w3-hover-text-black'></u></b>
                            <br><span class='w3-large'>Instrumen : <b class='w3-large'>$nama_instrumen</b></span>
                        </div>
                        <form method='' action='";
            echo base_url('PengembalianControl/kendala');
            echo "' class='scroll'>";
            echo "
                        <table class='w3-table w3-striped w3-bordered' align='center' style='width:50%;color:red'>
                        <tr><th>
                        <b>Pilih salah satu kondisi instrumen yang tersedia</b>
                        </th></tr>
                        </table>
                            <table class='w3-table w3-striped w3-bordered w3-card w3-animate-opacity' align='center' style='width:50%;margin-bottom:15%'>
                            <thead>
                            <tr class='w3-theme'>
                            <th style='text-align: center;width:5%'>No.</th>
                            <th style='text-align: left;width:50%'></th>
                            <th style='text-align: center;width:45%'>KONDISI</th>
                            </tr>";
            for ($i = 1; $i <= $jumlah; $i++) {
                echo "<tbody><tr>
                            <td>
                                $i.
                            </td>
                            <td>Instrumen $nama_instrumen ke-$i</td>
                            <td style='text-align:center'>
                                <input type='radio' name='kondisi$i' value='Baik' required='' class='w3-margin-left'> <b class='w3-margin-right'>Baik</b>
                                <input type='radio' name='kondisi$i' value='Rusak' required='' class='w3-margin-left'> <b class='w3-margin-right'>Rusak</b>
                                <input type='radio' name='kondisi$i' value='Hilang' required='' class='w3-margin-left'> <b class='w3-margin-right'>Hilang</b>
                            </td>
                        </tr>";
            }
            echo "<tr>
                            <td colspan='6' style='text-align: center'>
                                <button class='btn btn-default w3-xlarge w3-hover-text-yellow w3-black' style='width:20%'><i class='fa fa-check'></i> OK</button>
                                <input type='hidden' value='$id_transaksi' name='id_transaksi'>
                                <input type='hidden' value='$id_instrumen' name='id_instrumen'>
                                <input type='hidden' value='$jumlah' name='jumlah'>
                            </td>
                        </tr></tbody>
                    </table>
                    </form>";
            ?>
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
