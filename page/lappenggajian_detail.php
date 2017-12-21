<?php 
	require '../koneksi.php';
	$q = "SELECT p.no_slip, k.nama_kar, p.tgl_penggajian, p.total_gaji ";
	$q.= "FROM penggajian p JOIN karyawan k ON(p.id_kar=k.id_kar) WHERE periode = '".$_GET['tgl_pres']."' ORDER BY p.no_slip ASC";
	$rs = mysql_query($q);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penggajian Karyawan</title>
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
		<h4>Laporan Penggajian Karyawan Periode <?= namaBulan_id(substr($_GET['tgl_pres'],0,2)) . ' ' . substr($_GET['tgl_pres'],2,4); ?> </h4>
		<br /><br />
		<table class="table table-bordered">
			<tr>
				<td width="5%" class="text-center">No</td>
				<td width="20%" class="text-center">No SLIP</td>
				<td width="30%" class="text-center">Nama Karyawan</td>
				<td width="20%" class="text-center">Tanggal diBayar</td>
				<td width="20%" class="text-center">Total diBayar</td>
			</tr>
			<?php 
				$i=1;
				while ($row = mysql_fetch_array($rs)) {
					$slip = $row['no_slip'];
                    $slip = 'SL'.str_pad($slip, 6, "0", STR_PAD_LEFT);
					echo "<tr>";
					echo "<td class='text-center'>". $i ."</td>";
					echo "<td >". $slip ."</td>";
					echo "<td >". $row['nama_kar'] ."</td>";
					echo "<td class='text-center'>". $row['tgl_penggajian'] ."</td>";
					echo "<td class='text-center'>". number_format($row['total_gaji'],0,',','.') ."</td>";
					echo "</tr>";
					$i++;
					$tot += $row['total_gaji'];
				}
				if ($i==1) {
					echo '<tr><td colspan="5" class="text-center">Data Tidak Ada</td></tr>';
				}else{
					echo '<tr><td colspan="4" class="text-center">Total </td>';
					echo '<td class="text-center">'. number_format($tot,0,',','.') .'</td></tr>';
				}

			?>
		</table>

	</center>
</body>
</html>