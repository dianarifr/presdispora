<?php 
	require '../koneksi.php';
	$q = "SELECT JAM_MASUK, JAM_PULANG, TGL_PRES, STS_PRES ";
	$q.= "FROM presensi WHERE date_format(tgl_pres,'%m%Y') = '".$_GET['tgl_pres']."' AND id_kar = '".$_GET['id_kar']."' ORDER BY TGL_PRES ASC";
	$rs = mysql_query($q);

	$qa = "SELECT k.nama_kar, j.nama_jabatan FROM karyawan k JOIN jabatan j ON k.id_jabatan = j.id_jabatan WHERE k.id_kar = '".$_GET['id_kar']."' ";
	$row = mysql_fetch_array(mysql_query($qa));

?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Presensi Karyawan</title>
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
		<h4>Data Presensi Karyawan Periode <?= namaBulan_id(substr($_GET['tgl_pres'],0,2)) . ' ' . substr($_GET['tgl_pres'],2,4); ?> </h4>
		<br /><br />
		<table class="table">
			<tr>
				<td style="width: 150px;">Kode Karyawan</td>
				<td style="width: 10px;">:</td>
				<td><?= $_GET['id_kar'] ?></td>
				
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $row['nama_kar']; ?></td>
			</tr>
			<tr>
				<td>Jabatan</td>
				<td>:</td>
				<td><?= $row['nama_jabatan'] ?></td>
			</tr>
		</table><br />
		<br><br>
		<table class="table table-bordered">
			<tr>
				<td rowspan="2" width="50px" style="text-align:center">No</td>
				<td rowspan="2" width="150px" style="text-align:center">Tanggal</td>
				<td rowspan="2" width="150px" style="text-align:center">Hari</td>
				<td colspan="2" style="text-align:center">Presensi</td>
				<td rowspan="2" width="200px" style="text-align:center">Keterangan</td>
			</tr>
			<tr>
				<td width="100px" style="text-align:center">Masuk</td>
				<td width="100px" style="text-align:center">Pulang</td>
			</tr>
			<?php 
				$i=1;
				while ($row = mysql_fetch_array($rs)) {
					$hr = substr($row['TGL_PRES'],8,2);
					$bln = namaBulan_id(substr($row['TGL_PRES'],5,2));
					$thn = substr($row['TGL_PRES'],0,4);
					echo "<tr>";
					echo "<td class='text-center'>".$i."</td>";
					echo "<td class='text-center'>". $hr . ' ' . $bln . ' ' . $thn ."</td>";
					echo "<td class='text-center'>". namaHari_id(date('D', strtotime($row['TGL_PRES']))) ."</td>";
					echo "<td class='text-center'>". date('h:m', strtotime($row['JAM_MASUK'])) ."</td>";
					echo "<td class='text-center'>". date('h:m', strtotime($row['JAM_PULANG'])) ."</td>";
					echo "<td class='text-center'>";
					if ($row['STS_PRES']=="0") {
						echo 'Tidak Hadir'; $t++;
					}
					elseif ($row['STS_PRES']=="1"){
						echo 'Hadir'; $h++;
					}
					else{
						echo 'Izin'; $z++;
					}
					echo "</td>";
					echo "</tr>";
					$i++;
				}
				if ($i==1) {
					echo '<tr><td colspan="6" style="text-align:center">Data Tidak Ada</td></tr>';
				}else{
			?>
					<table class="table">
						<tr>
							<td width="150px">Keterangan</td>
							<td width="10px">&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>Hadir</td>
							<td>:</td>
							<td><?= ($h?$h:"-"); ?> Hari</td>
						</tr>
						<tr>
							<td>Tidak Hadir</td>
							<td>:</td>
							<td><?= ($t?$t:"-"); ?> Hari</td>
						</tr>
						<tr>
							<td>Izin</td>
							<td>:</td>
							<td><?= ($z?$z:"-"); ?> Hari</td>
						</tr>
					</table>
			<?php
				}

			?>
		</table>

	</center>
</body>
</html>