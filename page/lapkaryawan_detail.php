<?php 
	require '../koneksi.php';
	$q = "SELECT k.kode_kar, k.nama_kar, k.alamat_kar, k.jkel_kar ";
	$q.= "FROM jabatan j JOIN karyawan k ON(j.id_jabatan=k.id_jabatan) WHERE k.id_jabatan = '".$_GET['id_jabatan']."' ORDER BY k.nama_kar ASC";
	$rs = mysql_query($q);

	$qa = "SELECT nama_jabatan FROM jabatan WHERE id_jabatan = '".$_GET['id_jabatan']."' ";
	$rowa = mysql_fetch_array(mysql_query($qa));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Daftar Karyawan</title>
	<!-- Bootstrap Core CSS -->
    <link href="../dist/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	.table {
		    width: 100%;
		    max-width: 70%;
		    margin-bottom: 20px;
		}
    </style>
</head>
<body>
	<center>
		<br /><br />
		<h4>Data Karyawan <?= $rowa['nama_jabatan'] ?> <br> Periode <?= namaBulan_id(date('m')) . date(' Y') ?> </h4>
		<br /><br />
		<table class="table table-bordered">
			<tr>
				<td width="5%" class="text-center">No</td>
				<td width="20%" class="text-center">Kode Karyawan</td>
				<td width="30%" class="text-center">Nama Karyawan</td>
				<td width="20%" class="text-center">Alamat Karyawan</td>
				<td width="20%" class="text-center">Jenis Kelamin</td>
			</tr>
			<?php 
				$i=1;
				while ($row = mysql_fetch_array($rs)) {
					echo "<tr>";
					echo "<td class='text-center'>". $i ."</td>";
					echo "<td class='text-center'>". $row['kode_kar'] ."</td>";
					echo "<td >". $row['nama_kar'] ."</td>";
					echo "<td class='text-center'>". $row['alamat_kar'] ."</td>";
					echo "<td class='text-center'>". ($row['jkel_kar']=="l"?"Laki - laki":"Perempuan") ."</td>";
					echo "</tr>";
					$i++;
				}
				if ($i==1) {
					echo '<tr><td colspan="5" class="text-center">Data Tidak Ada</td></tr>';
				}else{
					echo '<tr><td colspan="4" class="text-center">Total </td>';
					echo '<td class="text-center">'. ($i-=1) .' Orang</td></tr>';
				}

			?>
		</table>

	</center>
</body>
</html>