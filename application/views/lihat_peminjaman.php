
<!DOCTYPE html>
<html>
    <title>Peminjaman</title>
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
    <script>
        $(function() {
            $("#datepicker").datepicker({dateFormat: 'dd/mm/yy'});
        });

        function validasi_input(form) {
            if (form.peminjam.value == "") {
                swal("Anda belum memilih peminjam!", "", "warning");
                form.peminjam.focus();
                return (false);
            }
        }

        function validasi_input2(form) {
            if (form.id_transaksi.value == "") {
                swal("Anda belum memasukkan ID Transaksi!", "", "warning");
                form.id_transaksi.focus();
                return (false);
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
                $this->load->view("header_footer/header_peminjaman");
                $status_user = $_SESSION["status_user"];
                ?>
            </div>

            <!-- First Parallax Image with Logo Text -->
            <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
            </div>

            <!-- Container (About Section) -->
            <div class="w3-content w3-container w3-center" id="about">
                <!--<img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">-->
            </div>

            <table style="width:70%;margin-top:2%" align='center'>

                <tr>
                    <th>
                <div class="w3-container w3-responsive w3-margin-bottom">

                    <div class="col-xs-12">
                        <table style="width:100%">
                            <tr>
                                <!--<th colspan="2"></th>-->
                                <th colspan="5" style="text-align:left;" class="w3-small">
                                    <b style="color:red;">Pencarian peminjaman berdasarkan <u class="w3-hover-text-black">Tanggal / Nama Peminjam / ID Transaksi</u></b>
                                </th>
                            </tr>
                            <tr>
                            <form action="<?php echo base_url('/PeminjamanControl/lihat_pinjaman'); ?>">
                                <th style="width: 30%">
                                    <input class='inputTanggal form-control' style="height: 40px;width:95%;margin-top:15px" type="text" id='datepicker' class="form-control" name="tgl" placeholder="Pilih Tanggal Pinjam" required="">
                                </th>
                                <th style="width: 5%;margin-left:1px">
                                    <button class="btn btn-success w3-hover-text-black" name="cari" value="CARI"><i class="fa fa-search"></i>&nbsp;</button>
                                </th>
                            </form>
                            <th style="width: 30%">

                            </th>
                            <form action="<?php echo base_url('/PeminjamanControl/lihat_pinjaman'); ?>" onsubmit="return validasi_input(this)">
                                <th style="width: 30%">
                                    <select class='w3-input w3-border form-control' name='peminjam' style='height: 40px;width: 93%;margin-top:10px' placeholder='Masukkan'>
                                        <option value='' required='' disabled='disabled' selected>-- Pilih Peminjam --</option>
                                        <?php
                                        foreach ($id_peminjam as $r):
                                            echo "
                                    <option value='$r->id_user' style='color:black'>$r->nama_user</option>
                                    ";
                                        endforeach;
                                        ?>
                                    </select>
                                </th>
                                <th style="width: 5%">
                                    <button class="btn btn-success w3-hover-text-black" name="cari" value="CARI"><i class="fa fa-search"></i>&nbsp;</button>
                                </th>
                            </form>
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                            <form action="<?php echo base_url('/PeminjamanControl/lihat_pinjaman'); ?>" onsubmit="return validasi_input2(this)">
                                <th style="width: 30%">
                                    <input class='inputTanggal form-control' style="height: 40px;width:93%;margin-top:15px" type="text" class="form-control" name="id_transaksi" placeholder="Masukkan ID Transaksi">
                                </th>
                                <th style="width: 5%;margin-left:1px">
                                    <button class="btn btn-success w3-hover-text-black" name="cari" value="CARI"><i class="fa fa-search"></i>&nbsp;</button>
                                </th>
                            </form>
                            </tr>
                        </table>

                    </div>

                </div>
                <table style="width:100%;">
                    <tr>
                    <form action="<?php echo base_url('/site/lihat_pinjaman_status'); ?>" onsubmit="return validasi_input2(this)">
                        <th style="margin-left:1px">
                            <button class="btn btn-succes w3-green w3-large w3-hover-text-black" name="statusApprove" value="0">Belum Approve</button>
                        </th>
                        <th style="margin-left:1px">
                            <button class="btn btn-warning w3-theme w3-large w3-hover-text-black" name="statusApprove" value="1">Sudah Approve</button>
                        </th>
                        <th colspan="3" style="width:80%"></th>
                    </form>
                    </tr>
                </table>
            </th>
            <th></th>
            <th></th>

        </tr>
        <tr><th>

        <div class="w3-responsive w3-card-4 w3-padding-16 w3-center
        <?php
        if ($pinjam_instrumen == NULL) {
            echo "";
        } else {
            echo " scroll";
        }
        ?>
             ">
            <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left">
                <?php
                if ($pinjam_instrumen == NULL) {
                    echo "<h4 style='text-align: center;margin-bottom:10%' class='w3-theme w3-padding w3-large'>"
                    . "<b class='w3-padding-16 w3-xxlarge'>Halaman Untuk Melihat Peminjaman</b><br>Pilih Opsi Pencarian Di atas Untuk Melihat Daftar Peminjaman"
                    . "<br><img src='";
                    echo base_url('images/note.png');
                    echo "' class='w3-center w3-margin-top w3-margin-bottom w3-animate-top'></h4></div>";
                    if (isset($tanggal)) {
                        echo "<script>swal(\"Peminjaman Kosong\", \"Pencarian tanggal : $tanggal\", \"error\");</script>";
                    }
                    if (isset($peminjam)) {
                        echo "<script>swal(\"Peminjaman Kosong\", \"Pencarian peminjam : $peminjam\", \"error\");</script>";
                    }
                    if (isset($transaksi)) {
                        echo "<script>swal(\"Peminjaman Kosong\", \"Pencarian ID Transaksi : $transaksi\", \"error\");</script>";
                    }
                } else {
                    if (isset($tanggal)) {
                        $tgl = date('d/m/Y');
                        if ($tgl == $tanggal) {
                            echo "<b style='color: green' class='w3-xxlarge w3-text-green w3-animate-opacity'>Daftar Amprah Hari Ini</b></div>";
                        } else {
                            echo "<b style='color: green' class='w3-xxlarge w3-text-green w3-animate-opacity'>Daftar Amprah Tanggal $tanggal</b></div>";
                        }
                    }
                    if (isset($peminjam)) {
                        echo "<b style='color: green' class='w3-xxlarge w3-text-green w3-animate-opacity'>Daftar Amprah $peminjam</b></div>";
                    }
                    if (isset($transaksi)) {
                        echo "<b style='color: green' class='w3-xxlarge w3-text-green w3-animate-opacity'>Amprah ID Transaksi $transaksi</b></div>";
                    }
                    echo "
                <table class = 'w3-table w3-striped w3-bordered w3-animate-opacity w3-card' align = 'center' style='margin-bottom:10%'>
                <thead><tr class = 'w3-theme'>
                <th></th>
                <th style = 'text-align: left;'>ID TRANSAKSI</th>
                <th style = 'text-align: left;'>PEMINJAM</th>
                <th style = 'text-align: center;'>TANGGAL PINJAM</th>
                <th style = 'text-align: center;'>TANGGAL KEMBALI</th>
                <th style = 'text-align: center;'></th>
                </tr>
                <tbody>";

                    $nomor = 1;
                    foreach ($pinjam_instrumen as $r):
                        echo "<form action='";
                        echo base_url('site/lihat_peminjamanan_detail');
                        echo "' method='POST'>";
                        echo "
                <tr>
                <td>$nomor</td>
                <td style='text-align: left'>$r->id_transaksi</td>
                <td style='text-align: left;width:25%'><b>$r->nama_user</b></td>
                <td style='text-align: center'>$r->tanggal_pinjam</td>
                <td style='text-align: center'>$r->tanggal_kembali</td>
                <td style='text-align: center'><input type='submit' value='LIHAT' class='btn btn-success w3-hover-text-black'> <i class='w3-text-green fa fa-check-circle'></i></input></td>
                <input type='hidden' name='id' value='$r->id_peminjam'>
                <input type='hidden' name='transaksi' value='$r->id_transaksi'>";
                        echo "</form>";
                        $nomor++;
                    endforeach;

                    $this->session->unset_userdata('pinjam_instrumen');
                }
                ?>
                </tbody>
                </table>
            </div>
        </th></tr></table>
    <?php
    if (isset($_SESSION["konfirmasi"])) {
        $ubah = $_SESSION["konfirmasi"];
        if ($ubah) {
            echo "<script>swal(\"Konfirmasi Peminjaman Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
        } else {
            echo "<script>swal(\"Konfirmasi Peminjaman Gagal\", \"Tekan OK untuk melanjutkan\", \"error\");</script>";
        }
        $this->session->unset_userdata('konfirmasi');
    }
    if (isset($pinjam_intrumen)) {
        echo "<script>swal(\"Peminjaman Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
    }
    $this->session->unset_userdata('nama_instrumen');
    $this->session->unset_userdata('cari_instrumen');
    $this->session->unset_userdata('konfirmasi');
    ?>

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
