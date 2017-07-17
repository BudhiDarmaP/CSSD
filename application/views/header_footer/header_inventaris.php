<div class="w3-bar w3-card w3-white" id="myNavbar">
    <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
        <i class="fa fa-bars"></i>
    </a>
    <a href="<?php echo base_url('/site/halamanUtama/'); ?>" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
    <!--javascript untuk dialog cari ada dikelas view aktivitas_inventaris paling bawah-->
    <a onclick="document.getElementById('id01').style.display = 'block'"  class="w3-bar-item w3-button"><i class="fa fa-search"></i> CARI</a>
    <!--javascript untuk jam aktif ada dikelas view aktivitas_inventaris paling atas-->
    <b id='clock' class="w3-bar-item w3-button w3-animate-opacity"></b>
</div>