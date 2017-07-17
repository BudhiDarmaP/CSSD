<div class="w3-bar w3-card w3-white" id="myNavbar">
    <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
        <i class="fa fa-bars"></i>
    </a>

    <a href="<?php echo base_url('/site/halamanUtama/'); ?>" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
    <?php
    if (isset($_SESSION["status_user"])) {
        $status_user = $_SESSION["status_user"];
        if ($status_user == 0 || $status_user == 1) {
            if ($status_user == 0) {
                echo "
                            <a href=\"";
                echo base_url('/site/tambah_user/');
                echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-users\"></i> USER</a>
            ";
            }
            echo "
                            <a href=\"";
            echo base_url('/site/halamanInstrumen/');
            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-scissors\"></i> INSTRUMEN</a>
                            <a href=\"";
            echo base_url('/site/peminjaman/');
            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-pencil\"></i> PEMINJAMAN</a>
                            <a href=\"";
            echo base_url('/site/pengembalian/');
            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-recycle\"></i> PENGEMBALIAN</a>
                            <a href=\"";
            echo base_url('/site/laporan/');
            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-paperclip\"></i> LAPORAN</a>
                        ";
        } elseif ($status_user == 2) {
            echo "
                            <a href=\"";
            echo base_url('/site/tambah_peminjaman/');
            echo "\" class=\"w3-bar-item w3-button w3-hide-small\"><i class=\"fa fa-pencil\"></i> PEMINJAMAN</a>
                        ";
        } else {
            redirect(base_url('/LoginControl/destroy_session/'));
        }
    }
    ?>
    <a href="<?php echo base_url('/site/ubah_password_konfirmasi/'); ?>" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> UBAH PASSWORD</a>
    <a href="<?php echo base_url('/LoginControl/destroy_session'); ?>" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"><i class="fa fa-sign-out"></i> KELUAR</a>
</div>