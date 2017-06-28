
<!DOCTYPE html>
<html>
    <title>Ubah Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <link href="<?php echo base_url('images/Logo.png') ?>" rel="icon" type="image/png"/>
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
        <?php
        if (isset($_SESSION["status_user"])) {
            $status = $_SESSION["status_user"];
            if ($status == 0) {
                echo "<div id='id02' class='modal w3-responsive'>
                <div class='modal-content w3-animate-opacity w3-black' style='margin-top:15%;width:100%'>
                    <div class='container'>
                        <h2 class='w3-center'>Perubahan Password Terhadap</h2>
                        </div>
                    <div class='container w3-center'>
                        <a class='btn btn-success w3-large' href='";
                echo base_url('/site/ubah_password?status=0/');
                echo "' style='vertical-align:middle;'><span>AKUN PRIBADI</span></a>
                        <a class='btn btn-primary w3-large' href='";
                echo base_url('/site/ubah_password?status=1/');
                echo "' style='vertical-align:middle;'><span>AKUN USER LAIN</span></a>
                    </div>
                    <div class='w3-center w3-margin-bottom'>
                        <a class='w3-xxlarge' href='";
                echo base_url('/site/halamanUtama/');
                echo "' style='vertical-align:middle;'><span><i class=\"fa fa-backward w3-margin w3-hover-text-green\"></i></span></a>
                    </div>
                    </div>";
                $this->session->unset_userdata('hapus_instrumen_confirm');
            } else {
                redirect(base_url('site/ubah_password?status=0'));
            }
        }
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
//            window.onclick = function(event) {
//                if (event.target == modal2) {
//                    modal2.style.display = "none";
//                }
//            }
        </script>
    </body>
</html>
