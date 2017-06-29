
<!DOCTYPE html>
<html>
    <title>Hapus User</title>
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
        $id_user_hapus;
        $nama_user_hapus;
        $no_telp_user_hapus;
        $status_user_hapus;
        if (isset($hapus_user)) {
            foreach ($hapus_user as $r):
                $id_user_hapus = $r->id_user;
                $nama_user_hapus = $r->nama_user;
                $no_telp_user_hapus = $r->no_telepon;
                $status_user_hapus = $r->status_user;
            endforeach;
        }


        echo "<div id='id02' class='modal w3-responsive'>
                <div class='modal-content w3-animate-opacity w3-black' style='margin-top:15%;width:100%'>
                    <div class='container'>
                        <h2 class='w3-center'>Apakah Anda Yakin Akan Menghapus Data?</h2>
                        <h4 class='w3-center'>Hapus Data : $nama_user_hapus ($id_user_hapus)</h4>
                        </div>
                    <div class='container w3-center'>
                    <table align='center'><tr><td>
                    <form action='";
        echo base_url('/UserControl/hapusUser/');
        echo "'>
            <button class='btn btn-danger w3-large'>
                <input type='hidden' name='id_user' value='$id_user_hapus'>
            <span style='margin-right:10%%'>YA </span><i class=\"fa fa-remove w3-text-black w3-xlarge w3-margin-left\"></i>
            </button>
            </form></td>
            <td><div class='w3-container'></div></td>
            <td>
            <a class='btn btn-primary w3-large' href='";
        echo base_url('/site/tambah_user/');
        echo "' style='vertical-align:middle;'><span>TIDAK</span></a>
            </td></tr></table>
                    </div>";
        $this->session->unset_userdata('hapus_instrumen_confirm');
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
        </script>
    </body>
</html>
