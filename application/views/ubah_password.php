
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
    <link href="./images/Logo.png" rel="icon" type="image/png"/>
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

                <a href="<?php echo base_url('/site/halamanUtama/'); ?>" class="w3-bar-item w3-button"><i class="fa fa-home"></i>HOME</a>
                <a href="<?php echo base_url('/site/instrumen/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-scissors"></i>INSTRUMEN</a>
                <a href="<?php echo base_url('/site/peminjaman/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-pencil"></i>PEMINJAMAN</a>
                <a href="<?php echo base_url('/site/laporan/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-paperclip"></i>LAPORAN</a>
                <a href="<?php echo base_url('/site/ubah_password/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i>UBAH PASSWORD</a>
                <a href="<?php echo base_url('/LoginControl/destroy_session'); ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-green"><i class="fa fa-sign-out"></i> KELUAR</a>
            </div>
        </div>

        <!-- First Parallax Image with Logo Text -->
        <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
        </div>

        <!-- Container (About Section) -->
        
        <!-- Second Parallax Image with Portfolio Text -->
<!--        <div class="bgimg-2">
        </div>-->
        
        <div class="bgimg-2 w3-display-container w3-opacity-min w3-animate-top">
            <div  class="w3-display-topmiddle w3-padding w3-col l6 m8">
                <div class="w3-container w3-theme">
                    <h3><i class="fa fa-users w3-margin-right"></i>UBAH PASSWORD</h3>
                    <table class="w3-xxlarge w3-text-white w3-wide w3-animate-opacity">
                        <tr><th class="w3-large">Anda Masuk Sebagai</th></tr>
                        <tr><td><?php $nama = $_SESSION["nama_user"]; echo $nama ?></td></tr>
                    </table>
                
                </div>
                <div class="w3-container w3-white w3-padding-16 w3-card">
                    <form action="./BusControl">
                        <div class="w3-row-padding w3-padding" style="margin:0 -16px;">
                            <div>
                                <label><i class="fa fa-key"></i> Masukkan Password Lama</label>
                                <input class="w3-input w3-border" type="text" value="" name="oldpassword" required="" placeholder="Old Password">
                            </div>
                        </div>
                        <div class="w3-row-padding w3-padding" style="margin:0 -16px;">
                            <div>
                                <label><i class="fa fa-"></i> Masukkan Password Baru</label>
                                <input class="w3-input w3-border" type="text" value="" name="newpassword" required="" placeholder="New Password">
                            </div>
                        </div>
                        <div class="w3-row-padding w3-padding" style="margin:0 -16px;">
                            <div>
                                <label><i class="fa fa-check"></i> Konfirmasi Password Baru</label>
                                <input class="w3-input w3-border" type="text" value="" name="platbus" required="" placeholder="Confirm New Password">
                            </div>
                        </div>

                        <button class="w3-button w3-green" type="submit" name="ubah" value="yes"><h2><i class="fa fa-check-circle w3-margin-right"></i> UBAH</h2></button>
                    </form>

                </div>
            </div>
        </div>
        

<!--        <footer class="w3-center w3-green w3-margin-bottom">
            <div class="w3-section w3-padding-small"></div>
            <div class="w3-xlarge w3-section">
                <i class="fa fa-facebook-official w3-hover-opacity"></i>

            </div>
            <p>Powered by <a title="" target="_blank" class="w3-hover-text-black">CSSD RSUD Karangasem</a></p>
            <div class="w3-section w3-padding-small"></div>-->
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
            </script>
            <script>
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
        <!--</footer>-->
    </body>
</html>
