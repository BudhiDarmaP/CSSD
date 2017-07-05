<div class="w3-responsive w3-card-4 w3-padding-16" >
    <div class="w3-container w3-responsive w3-margin-bottom w3-center w3-animate-left w3-large w3-green">
        <b class='w3-padding '>Laporan Harian</b>
    </div>
    <form method="post" action='<?php echo base_url(''); ?>' onsubmit="return validasi_input(this)">
        <table  align="center" style="width:33%;margin-bottom:3%">
            <tr style='text-align: center'>
                <th style='text-align: center; width: 17%'>PILIH TANGGAL</th>
                <th style='text-align: center; width: 10%' class='inputTanggal'>
                    <input type='text' id='tanggal' name='tgl' placeholder='Klik untuk isi' required=''></th>
                <th style='text-align: left; width: 3%'>
                    <button style='text-align: lef' class="btn btn-success" name="cari" value="CARI"><i class="fa fa-search">
                        </i>&nbsp;</button></th>
            </tr>
        </table>
    </form>
</div>