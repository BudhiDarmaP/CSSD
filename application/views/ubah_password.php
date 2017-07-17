
<!DOCTYPE html>
<html>
    <title>Ubah Password</title>
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
    <link href="<?php echo base_url('images/Logo.png'); ?>" rel="icon" type="image/png"/>
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
            $this->load->view("header_footer/header_main");
            ?>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <?php
        if (isset($_SESSION["ubah_password"])) {
            $ubah = $_SESSION["ubah_password"];
            if ($ubah) {
                echo "<script>swal(\"Ubah Password Berhasil\", \"Tekan OK untuk melanjutkan\", \"success\");</script>";
            } else {
                echo "<script>swal(\"Ubah Password Gagal\", \"Tekan OK untuk melanjutkan\", \"error\");</script>";
            }
            $this->session->unset_userdata('ubah_password');
        }
        ?>

        <div class="bgimg-2 w3-display-container w3-opacity-min w3-animate-top">
            <div  class="w3-display-topmiddle w3-padding w3-col l6 m8">
                <form action="<?php echo base_url('UserControl/ubahPassword') ?>">
                    <?php
                    if (isset($_GET["status"])) {
                        $status = $_GET["status"];
                        $nama = $_SESSION["nama_user"];
                        if ($status == 0) {
                            $username = $_SESSION["username"];
                            echo "<div class=\"w3-container w3-theme\">
                                <h3><i class=\"fa fa-users w3-margin-right\"></i>UBAH PASSWORD</h3>
                                <table class=\"w3-xxlarge w3-text-white w3-wide w3-animate-opacity\">
                                    <tr><th class=\"w3-large\">Anda Masuk Sebagai</th></tr>
                                    <tr><td>$nama</td></tr>
                                </table>
                            </div>
                            <div class=\"w3-container w3-white w3-padding-16 w3-card\">
                                
                                    <div class=\"w3-row-padding w3-padding\" style=\"margin:0 -16px;\">
                                    <div>
                                        <label><i class=\"fa fa-key\"></i> Masukkan Password Lama</label>
                                        <input class=\"w3-input w3-border\" type=\"password\" value=\"\" name=\"oldpassword\" required=\"\" placeholder=\"Old Password\">
                                    </div>
                                    </div>
                                    <div class=\"w3-row-padding w3-padding\" style=\"margin:0 -16px;\">
                                    <div>
                                        <label><i class=\"fa fa-key\"></i> Masukkan Password Baru</label>
                                        <input class=\"w3-input w3-border\" type=\"password\" value=\"\" name=\"newpassword\" required=\"\" placeholder=\"New Password\">
                                    </div>
                                    </div>
                                    <div class=\"w3-row-padding w3-padding\" style=\"margin:0 -16px;\">
                                    <div>
                                        <label><i class=\"fa fa-check\"></i> Konfirmasi Password Baru</label>
                                        <input class=\"w3-input w3-border\" type=\"password\" value=\"\" name=\"confirmpassword\" required=\"\" placeholder=\"Confirm New Password\">
                                        <input type=\"hidden\" name=\"username\" value=\"$username\">
                                        <input type=\"hidden\" name=\"status\" value=\"$status\">
                                    </div>
                                    </div>
                                    <button class=\"w3-button w3-green\" type=\"submit\" name=\"ubah\" value=\"yes\"><h2><i class=\"fa fa-check-circle w3-margin-right\"></i> UBAH</h2></button>
                                
                            </div>";
                        } else {
                            $aksesadmin = $_SESSION["status_user"];
                            if ($aksesadmin == 0) {
                                echo "<div class=\"w3-container w3-theme\">
                                <h3 class=\"w3-xxlarge w3-text-white w3-animate-opacity\"><i class=\"fa fa-users w3-margin-right\"></i>UBAHKAN PASSWORD</h3>
                                <table class=\"w3-xxlarge w3-text-white w3-wide w3-animate-opacity\">
                                    <tr><th class=\"w3-large\">Anda Masuk Sebagai</th></tr>
                                    <tr><td>$nama</td></tr>
                                </table>
                            </div>
                            <div class=\"w3-container w3-white w3-padding-16 w3-card\">
                                
                                    <div class=\"w3-row-padding w3-padding\" style=\"margin:0 -16px;\">
                                    <div>
                                        <label><i class=\"fa fa-user\"></i> Masukkan Username Pengguna</label>
                                        <input class=\"w3-input w3-border\" type=\"text\" value=\"\" name=\"username\" required=\"\" placeholder=\"Username\">
                                    </div>
                                    </div>
                                    <div class=\"w3-row-padding w3-padding\" style=\"margin:0 -16px;\">
                                    <div>
                                        <label><i class=\"fa fa-key\"></i> Masukkan Password Baru</label>
                                        <input class=\"w3-input w3-border\" type=\"password\" value=\"\" name=\"newpassword\" required=\"\" placeholder=\"New Password\">
                                        <input type=\"hidden\" name=\"status\" value=\"$status\">
                                    </div>
                                    </div>
                                    <button class=\"w3-button w3-green\" type=\"submit\" name=\"ubah\" value=\"yes\"><h2><i class=\"fa fa-check-circle w3-margin-right\"></i> UBAH</h2></button>
                                
                            </div>";
                            } else {
                                redirect(base_url('/site/check_log_in_super_admin/'));
                            }
                        }
                    }
                    ?>
                </form>
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
        </script>
    </body>
</html>
