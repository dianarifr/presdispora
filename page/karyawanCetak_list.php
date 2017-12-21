<?php 
	require '../koneksi.php';

	$qsql = mysql_query("select * from KARYAWAN where ID_KAR = '".$_GET['id_kar']."'");
	$data = mysql_fetch_array($qsql);

	$idk = $data['ID_KAR'];
	$nmk = $data['NAMA_KAR'];
	$almtk = $data['ALAMAT_KAR'];
	$kdk = $data['KODE_KAR'];


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Data Karyawan</title>
	<!-- Bootstrap Core CSS -->
    <link href="../dist/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	.table {
		    width: 100%;
		    max-width: 60%;
		}
		td{
			font-size: 12pt;
		}
    </style>
</head>
<body>
	<center>
		<table class="table table-bordered" style="margin-top:130px;font-size:24px;">
			<tr>
				<td width="80px;">
					<img src="../dist/img/logo.png" style="width:90%;margin-left:5px;">
				</td>
				<td class="text-center"><h3>Informasi Data Karyawan</h3></td>
			</tr>
			<tr>
				<td>Id</td>
				<td><?php echo $idk ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><?php echo $nmk ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><?php echo $almtk ?></td>
			</tr>
			<tr style="background-color:yellow;">
				<td>*Kode </td>
				<td ><?php echo $kdk ?></td>
			</tr>
			<tr >
				<td colspan="2" style="text-align:center">*digunakan untuk login presensi</td>
			</tr>
		</table>
	</center>
</body>
</html>