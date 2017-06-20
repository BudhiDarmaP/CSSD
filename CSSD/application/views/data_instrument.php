<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <table border="1" style="border-collapse: collapse;">
        <tr style="background: grey">
            <td>ID Instrument</td>
            <td>Nama Instrument</td>
            <td>Jumlah</td>
            <td>Steril</td>
            <td colspan="2"></td>
        </tr>
        <?php foreach ($data as $instrument) {?>
        <tr>
            <td><?php echo $instrument['id_instrument']; ?></td>
            <td><?php echo $instrument['nama_instrument']; ?></td>
            <td><?php echo $instrument['jumlah']; ?></td>
            <td><?php echo $instrument['steril']; ?></td>
            <td><a href="<?php echo base_url()."index.php///".$isntrument['id_peminjam']; ?>">Edit</td>
            <td><a href="<?php echo base_url()."index.php/instrument/delete_data/".$isntrument['id_peminjam']; ?>">Delete</td>
        </tr>
        <?php } ?>
    </table>
    <a href="<?php echo base_url()."index.php/instrument/add_data";?>">Insert</a>
    </body>
</html>
