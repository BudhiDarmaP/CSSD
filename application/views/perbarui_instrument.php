
<!DOCTYPE html>
<html>
    <title>Perbarui Instrument</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/jquery-1.7.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/jquery-ui.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
    <!--    <head>
            <meta http-equiv="refresh" content="5">
        </head>-->
    <script>
        <!--
        function showTime() {
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
            document.getElementById('clock').innerHTML = curr_day + ", " + curr_bulan + " " + today.getDate() + ", " + today.getFullYear() + " (" + curr_hour + ":" + curr_minute + ":" + curr_second + ")";
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        setInterval(showTime, 500);

        function validasi_input(form) {
            if (form.nama_instrumen.value == "") {
                swal("Pilih nama instrumen!", "", "error");
//                alert("Anda belum memilih peminjam!");
//                form.nama_instrumen.focus();
                return (false);
            }

            return (true);
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
            <div class="w3-bar w3-card w3-white" id="myNavbar">
                <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i>
                </a>

                <a href="<?php echo base_url('/site/halamanUtama/'); ?>" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
                <a href="<?php echo base_url('/site/tambah_instrument/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-plus"></i> TAMBAH</a>
                <a href="<?php echo base_url('/site/instrumen/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-search"></i> CARI</a>
                <a href="<?php echo base_url('/site/perbarui_instrument/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-edit"></i> PERBARUI</a>
                <a href="<?php echo base_url('/site/hapus_instrument/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-eraser"></i> HAPUS</a>
                <a href="<?php echo base_url('/LoginControl/destroy_session'); ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"><i class="fa fa-sign-out"></i> KELUAR</a>
            </div>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>
        <?php
        if (isset($tambah_stok_instrumen)) {
            if ($tambah_stok_instrumen) {
                echo "<script>swal(\"Stok Instrumen Berhasil Diperbarui\", \"Instrumen : $nama_instrumen\", \"success\");</script>";
            } else {
                echo "<script>swal(\"Kesalahan Input\", \"Penambahan Stok Steril Melebihi Jumlah Stok Instrumen : $nama_instrumen\", \"error\");</script>";
            }
        }
        ?>

        <div class="bgimg-2 w3-display-container">
            <div  class="w3-display-topmiddle" style="width: 95%;">
                <table align="center" style="width:100%" class="w3-margin-right"><tr>
                        <th class="w3-top" style="width:50%">
                    <table class="w3-table w3-striped w3-bordered w3-card w3-margin-right w3-animate-top" align="center">
                        <tbody class="w3-margin-top">
                            <tr>
                                <th colspan="6" class="w3-green">
                        <h3 class="w3-left w3-xlarge"><i class='fa fa-plus-circle w3-xxlarge' style="margin-top:15px"></i> <b>Perbaharui Stok Instrumen</b></h3>
                        </th>
                        </tr>
                        <tr>
                            <th colspan="6" class="w3-green">
                        <h5 class="w3-left w3-hover-text-black">
                            <b>Form ini digunakan untuk menambahkan stok instrumen tertentu yang sudah ada CSSD</b>
                            <br>1. Masukkan nama instrumen yang tersedia di CSSD
                            <br>2. Masukkan jumlah tambahan stok pada instrumen tersebut
                            <br><a class="w3-text-black w3-hover-text-white">Apabila terjadi kehilangan : 
                                Klik tanda panah kebawah pada <b class="w3-hover-text-black">Jumlah Strok Tambahan</b>. 
                                Klik hingga angka sesuai dengan jumlah instrumen yang hilang.</a>
                            <br>3. Klik "Perbarui"
                        </h5>
                        </th>
                        </tr>
                        <tr class="w3-margin-top">
                            <td>
                                <form method="post" action="<?php echo base_url('/InstrumenControl/tambahStok'); ?>" onsubmit='return validasi_input(this)'>
                                    <div class="w3-row-padding w3-text-black">
                                        <div class=" w3-margin-bottom">
                                            <label>Nama Instrumen</label>
                                            <select class="w3-input w3-border w3-padding-16" name="nama_instrumen" style="color:grey">
                                                <option value="" disabled='disabled' selected>-- Pilih Nama Instrumen --</option>
                                                <?php
                                                foreach ($instrumen as $s):
                                                    echo "
                                            <option value='$s->id_instrumen' style='color:black'>$s->nama_instrumen</option>";
                                                endforeach;
                                                ?>
                                            </select> 
                                        </div>

                                        <div class=" w3-margin-bottom">
                                            <label>Jumlah Stok Tambahan</label>
                                            <input class="w3-input w3-border" type="number" value="" name="jumlah_instrumen" required="" placeholder="0" min='' onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="w3-margin-bottom w3-center">
                                            <button class="btn btn-success w3-text-black w3-hover-text-white w3-xlarge" type="submit" name="ubah" value="yes"><i class="fa fa-edit"></i> PERBARUI</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </th>
                    <th class="w3-row-padding" style="width:1%">
                        <!--<div ></div>-->
                    </th>
                    <th class="w3-top" style="width:50%">
                    <table class="w3-table w3-striped w3-bordered w3-card w3-margin-left w3-margin-right w3-animate-top" align="center">
                        <tbody class="w3-margin-top">
                            <tr>
                                <th colspan="6" class="w3-theme">
                        <h3 class="w3-left w3-xlarge"><i class='fa fa-hand-stop-o fa-check-circle-o w3-xxlarge' style="margin-top:15px"></i> <b>Perbaharui Stok Steril Instrumen</b></h3>


                        </th>

                        </tr>
                        <tr>
                            <th colspan="6" class="w3-theme">
                        <h5 class="w3-left w3-hover-text-black">
                            <b>Form ini digunakan untuk memperbaharui stok instrumen yang sudah steril berdasarkan instrumen tertentu</b>
                            <br>1. Masukkan nama instrumen yang tersedia di CSSD
                            <br>2. Masukkan jumlah instrumen yang sudah steril
                            <br>3. Klik "Perbarui"
                        </h5>
                        </th>
                        </tr>
                        <tr class="w3-margin-top ">
                            <td>
                                <form method="post" action="<?php echo base_url('/InstrumenControl/tambahSteril'); ?>" onsubmit='return validasi_input(this)'>
                                    <div class="w3-row-padding">
                                        <div class=" w3-margin-bottom">
                                            <label>Nama Instrumen</label>
                                            <select class="w3-input w3-border w3-padding-16" name="nama_instrumen" style="color:grey">
                                                <option value="" disabled='disabled' selected>-- Pilih Nama Instrumen --</option>
                                                <?php
                                                foreach ($instrumen as $s):
                                                    echo "
                                            <option value='$s->id_instrumen' style='color:black'>$s->nama_instrumen</option>";
                                                endforeach;
                                                ?>
                                            </select> 
                                        </div>

                                        <div class=" w3-margin-bottom">
                                            <label>Jumlah Insturmen Sudah Disterilkan</label>
                                            <input class="w3-input w3-border" type="number" value="" name="jumlah_instrumen" required="" placeholder="0" min='1' onkeypress="return isNumber(event)">
                                        </div>
                                        <div class="w3-margin-bottom w3-center">
                                            <button class="btn btn-warning w3-text-black w3-hover-text-white w3-xlarge" type="submit" name="ubah" value="yes"><i class="fa fa-edit"></i> PERBARUI</button>
                                        </div>
                                    </div>
                                </form>
                            </td>
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
