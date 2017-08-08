<!DOCTYPE html>
<html>
    <title>Perbarui Instrument</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/bootstrap.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/All.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/scroll.css'); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/font-awesome.min.css'); ?>">
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Login.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/Tabel.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('bootstrap-3.3.6/css/sweetalert.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert-dev.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/js/JavaScript.js') ?>"></script>
    <link href="<?php echo base_url('images/Logo.png'); ?>" rel="icon" type="image/png"/>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-3.3.6/css/jquery-ui.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/resources/demos/style.css') ?>">
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-1.12.4.js') ?>"></script>
    <script src="<?php echo base_url('bootstrap-3.3.6/js/jquery-ui.js') ?>"></script>

    <script>
        function validate()
        {
            var chks = document.getElementsByName('id[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++)
            {
                if (chks[i].checked)
                {
                    hasChecked = true;
                    break;
                }
            }

            if (hasChecked == false)
            {
                swal("Pilih instrumen!", "", "warning");
                return false;
            }

            return true;
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
            width: 140px;
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
                $this->load->view("header_footer/header_instrumen");
                ?>
            </div>

            <!-- First Parallax Image with Logo Text -->
            <div class="bgimg-1 w3-display-container w3-opacity-min w3-green" id="home">
            </div>

            <!-- Container (About Section) -->
            <div class="w3-responsive w3-card-4 w3-padding-16" >
                <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
                    <b class='w3-padding '>Perbarui Instrument</b>
                </div>

                <div id='id01' class='modal w3-responsive'>
                    <div class='modal-content w3-white' style='margin-top:;width:70%'>
                        <div class='w3-padding-16'>
                            <a href='<?php echo base_url('/site/perbarui_instrument/'); ?>' class='w3-xxlarge close w3-margin-top w3-hover-text-red' title='Tutup'>&times;</a>
                            <table align='center' style='width:90%' class='w3-card'>
                                <tr class='w3-green'>
                                    <td colspan='2' style='text-align:center' class='w3-xlarge'>
                                        <b>Perbarui Stok 
                                            <?php
                                            if (isset($perbaruiStok)) {
                                                if ($perbaruiStok == 1) {
                                                    echo "Steril";
                                                }
                                            }
                                            ?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <form action='<?php echo base_url('/InstrumenControl/pilih_perbarui_banyak'); ?>' class='scroll' onSubmit="return validate()">
                                            <table class='w3-table w3-striped w3-bordered w3-animate-opacity w3-card' align='center' style='width:100%;'>
                                                <tr class='w3-theme'>
                                                    <th style='width:20%'></th>
                                                    <th></th>
                                                    <th style='text-align: left;'>NAMA INSTRUMEN</th>
                                                    <th style='text-align: center;'>PILIH</th>
                                                    <th style='width:20%'></th>
                                                </tr>
                                                <?php
                                                if (isset($ada_instrumen)) {
                                                    $index = 1;
                                                    foreach ($ada_instrumen as $r):
                                                        echo "
                                                <tr>
                                                    <td></td>
                                                    <td>$index. </td>
                                                    <td style='text-align: left;width:40%'><b>$r->nama_instrumen</b></td>
                                                    <td style='text-align: center'>
                                                        <input type='checkbox' name='id[]' value='$r->id_instrumen'>
                                                    </td>
                                                    <td></td>
                                                </tr>";
                                                        $index++;
                                                    endforeach;
                                                    echo "<input type='hidden' name='perbaruiStok' value='$perbaruiStok'>";
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan='6' style='text-align: center'>
                                                        <button class='btn btn-success w3-xlarge w3-hover-text-black' style='width:40%'>LANJUTKAN <i class='fa fa-arrow-right'></i></button>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </td>
                                </tr>
                            </table> 
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_SESSION["tambahStok"])) {
                    echo "
                <table class='w3-table w3-striped w3-bordered w3-card w3-animate-opacity' align='center' style='width:60%;margin-bottom:20%;'
                       <thead>
                        <tr class='w3-theme'>
                        <td></td>
                        <td></td>
                            <th style='text-align: left;'>NAMA INSTRUMEN</th>
                            <th style='text-align: center;'>JUMLAH STOK</th>
                            <td></td>
                                </tr>
                                <tbody>";
                    $index = 1;
                    $cari_instrumen = $_SESSION['tambahStok'];

                    foreach ($cari_instrumen as $r):
                        if ($r->id_instrumen == null) {
                            redirect(base_url('/site/perbarui_instrument'));
                        } else {
                            echo "
                                    <tr>
                                    <td style='width:20%'></td>
                                    <td>$index.</td>
                                    <td style='text-align: left;width:40%'><b>$r->nama_instrumen</b></td>
                                    <td style='text-align: center'>
                                    <input type='number' name='jumlah[]' value='' max='$r->steril' min='1' placeholder='0' required='' onkeypress=\"return isNumber(event)\">
                                    <input type='hidden' value='$r->id_instrumen' name='id_instrumen[]'>    
                                    </td>
                                    <td style='width:20%'></td>
                                    </form>";
                            $index++;
                        }
                    endforeach;
                    echo "
                </tbody>
                <tr>
                    <td colspan='5' style='text-align: center'>
                        <a onclick=\"document.getElementById('id01').style.display = 'block'\"  class='btn btn-default w3-text-green w3-xlarge w3-hover-text-black w3-margin-top' style='width:10%' title='Tambah list pinjam'><i class='fa fa-plus'></i></a>
                        <button class='btn btn-warning w3-xlarge w3-hover-text-black w3-margin-top' style='width:20%'><i class='fa fa-briefcase'></i> PINJAM</button>
                    </td>
                </tr>
            </table>";
                }
                ?>
                <!--</form>-->
            </div>



            <div class="bgimg-3 w3-display-container w3-opacity-min">
                <div class="w3-animate-fading w3-padding-small">
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
<?php
if (isset($_SESSION["tambahStok"]) || isset($_SESSION["tambahSteril"])) {
    echo "modal.style.display = 'none';";
} else {
    echo "modal.style.display = 'block';";
}
?>

        //                window.onclick = function(event) {
        //                    if (event.target == modal) {
        //                        modal.style.display = "none";
        //                    }
        //                }
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