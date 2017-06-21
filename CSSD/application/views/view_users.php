<!DOCTYPE html>
<html>
<head>
	<title>Menghubungkan codeigniter dengan database mysql</title>
</head>
<body>
	<h1>Mengenal Model Pada Codeigniter | MalasNgoding.com</h1>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Nama</th>
			<th>Password</th>
			<th>No Telephone</th>
		</tr>
		<?php foreach($user as $u){ ?>
		<tr>
			<td>//<?php echo $u->id_user?></td>
			<td>//<?php echo $u->nama_user?></td>
			<td>//<?php echo $u->password?></td>
			<td>//<?php echo $u->no_telepon?></td>
			<td>//<?php echo $u->status_user?></td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>