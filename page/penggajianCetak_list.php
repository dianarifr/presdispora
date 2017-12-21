<?php 
	require '../koneksi.php';

	$q = "SELECT g.no_slip,k.nama_kar,g.tgl_penggajian, g.periode, g.total_gaji  ";
	$q.= "FROM penggajian g JOIN karyawan k ON g.id_kar = k.id_kar ";
    $q.= "WHERE g.no_slip = '".$_GET['no_slip']."' ";
	$rs = mysql_query($q);
	$data = mysql_fetch_array($rs);


	$no_slip = $data['no_slip'];
	$no_slip = 'SL'.str_pad($no_slip, 6, "0", STR_PAD_LEFT);
	$nama_kar = $data['nama_kar'];
	$tgl_penggajian = $data['tgl_penggajian'];
	$periode = $data['periode'];
	$total_gaji = $data['total_gaji'];


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cetak Slip Gaji</title>
	<!-- Bootstrap Core CSS -->
    <link href="../dist/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	.table {
		    width: 100%;
		    max-width: 40%;
		}
		td{
			font-size: 12pt;
		}
    </style>
</head>
<body>
	<center>
		<table class="table" style="margin-top:130px;font-size:24px;">
			<tr>
				<td width="80px;" class="text-center">
					<img src="../dist/img/logo.png" style="width:40%;margin-left:5px;">
				</td>
				<td class="text-center"><h3>SLIP GAJI</h3></td>
			</tr>
			<tr>
				<td style="width: 150px;">No Gaji</td>
				<td><?php echo $no_slip ?></td>
			</tr>
			<tr>
				<td>Nama Karyawan</td>
				<td><?php echo $nama_kar ?></td>
			</tr>
			<tr>
				<td>Periode</td>
				<td><?php echo namaBulan_id(substr($periode,0,2))." ".substr($periode,2,4) ?></td>
			</tr>
			<tr>
				<td>Nominal</td>
				<td><strong><?= number_format($total_gaji,0,',','.') ?></strong></td>
			</tr>
			<tr>
				<td>Terbilang</td>
				<td><em><?= convertNumberToWord($total_gaji) ?></em></td>
			</tr>
			<tr>
				<td colspan="2">
					<br><br>
					<table style="width: 100%">
						<tr>
							<td style="padding-left: 20px;">Penerima,</td>
							<td class="text-right"><?= date('d') . ' ' . namaBulan_id(date('m')) . ' ' . date('Y') ?></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td><?php echo $nama_kar ?></td>
							<td class="text-right"><?php echo "DISPORA JATIM" ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</center>
</body>
</html>