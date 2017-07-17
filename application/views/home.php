
<!DOCTYPE html>
<html>
    <title>Halaman Utama</title>
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
            min-height: 400px;
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
        <?php
        if (isset($sudahLogin)) {
            echo "<div id=\"id02\" class=\"modal w3-responsive w3-white\">
                <div class=\"modal-content w3-animate-opacity w3-black\" style=\"margin-top:15%;width:40%\">
                    <div class=\"w3-padding-16\">
                    <table align='center' style='width:80%'>
                        <tr>
                            <td style='text-align:center' class='w3-xlarge'>
                                Anda Sudah Login
                            </td>
                        </tr>
                        <tr>
                            <td style='text-align:center' class='w3-xlarge'>
                                <a class=\"buttonAtur\" href=\""
            ?><?php echo base_url('site/halamanUtama/') ?><?php
            echo "\" style=\"vertical-align:middle;\"><span>HOME</span></a>
                            </td>
                        </tr>";
            echo "</table>
                    </div>
                </div>
            </div>";
        }
        ?>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <!-- Container (About Section) -->
        <div class="w3-content w3-container w3-center" id="about">
            <img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">
            <?php
            $status_user = $_SESSION['status_user'];
            $status_user_text;
            if ($status_user == 0) {
                $status_user_text = 'Super Administrator';
            } elseif ($status_user == 1) {
                $status_user_text = 'Pegawai CSSD';
            } else {
                $status_user_text = 'Peminjam';
            }
            echo "<br><span class='w3-large w3-animate-opacity'>Status User : <b class='w3-text-red '>$status_user_text<b> </span>";

            if ($status_user == 0 || $status_user == 1) {
                echo "
                <table align='center' style='width:20%' class='w3-margin-bottom w3-animate-zoom'>
                    <tr>
                        <th>";
                echo "
                            <form action='";
                echo base_url('site/aktivitas_inventaris');
                echo "'>
                                <button class='btn btn-success w3-large w3-hover-text-black' style=''><i class='fa'></i><b>Aktivitas Inventaris</b></button>
                        </th>
                    </tr>
                </table>";
            }
            ?>
        </div>

        <!-- Second Parallax Image with Portfolio Text -->
        <div class="bgimg-2 w3-display-container w3-opacity-min">
            <div class="w3-display-topmiddle w3-center w3-black w3-opacity w3-animate-fading w3-padding-small">
                <span class="w3-xxlarge w3-text-white w3-wide w3-animate-opacity">Central Sterile Supply Department</span>
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
