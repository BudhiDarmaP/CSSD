
<!DOCTYPE html>
<html>
    <title>Result Peminjaman</title>
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
            <img src="<?php echo base_url('images/LogoCSSD.png') ?>" class="w3-center w3-margin-top w3-margin-bottom w3-animate-top">
        </div>
        <table style="width:70%" align='center'><tr><th>
            <div class="w3-responsive w3-card-4 w3-padding-16">
                <div class="w3-container w3-responsive w3-margin-bottom w3-center">

                    <?php
                    $status_user = $_SESSION["status_user"];
                    if ($pinjam_intrumen && $status_user != 1) {
                        echo "
                    <h4 style='text-align: center;margin-bottom:10%;' class='w3-theme w3-padding w3-large'>
                    <br><br><b style='color:red' class='w3-animate-fading'>Catat ID Transaksi Peminjaman Instrumen !</b><br>
                    <br>ID Transaksi : <br>
                    <b class='w3-padding-16 w3-xxxlarge w3-hover-text-black' title='Serahkan kepada CSSD agar segera di Approve'>$id_transaksi</b>
                    <br><br><img src='";
                        echo base_url('images/note.png');
                        echo "' class='w3-center w3-margin-top w3-margin-bottom'><br>Serahkan kepada CSSD agar segera di Approve</h4>";
                    } else {
                        
                    }
                    $this->session->unset_userdata('setting_set');
                    ?>

                </div>
            </div>
        </th></tr></table>

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
