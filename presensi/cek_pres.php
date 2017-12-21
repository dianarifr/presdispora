<?php 
//error_reporting(0);
include('../koneksi.php');
date_default_timezone_set('Asia/Jakarta');
$jam =  date('Y-m-d H:i:s');
$tgl = date('Y-m-d');
$kdk = $_POST['kdk'];
$cek_lagi=mysql_query("SELECT COUNT(*), ID_KAR FROM Karyawan WHERE KODE_KAR='$kdk' AND STS_KAR <> 0");
$ketemu = mysql_fetch_array($cek_lagi);
//CEK KODE KAR ADA ATAU TIDAK
if ($ketemu[0]==0) {
	echo "<p class='bg-danger' style='text-align:center;'>Presensi Gagal, Coba Lagi !</p>";
}
else{
	$cekdata = mysql_query("SELECT count(*) from presensi where ID_KAR = '$ketemu[1]' AND TGL_PRES = '$tgl'");
	$ada = mysql_fetch_array($cekdata);
	//CEK SUDAH PRES ATAU BLM
	if ($ada[0]==0) {
		//INSERT
		//STS_PRES AWAL / ALPHA = 0, MASUK = 1, masuk tapi jam pulang < dari semestinya = 0
		// $idpresX = mysql_fetch_array(mysql_query("select count(*) from presensi where TGL_PRES = '$tgl'"));
		// $ceQ 	= $idpresX[0]+1;
		// $idpres = "PRES".$ceQ;

		mysql_query("INSERT INTO PRESENSI(`JAM_MASUK`, `JAM_PULANG`, `ID_KAR`, `TGL_PRES`, `STS_PRES`) VALUES('$jam','','$ketemu[1]','$tgl','0')");
	}
	else{
		//UPDATE JAM PULANG, STS_PRES = 1
		// if (date('l')=="Friday"){ $minjampulang = "14:30"; }else{ $minjampulang = "15:30"; } // cek jam pulang senin - kamis, jumat
		// if (date('H:i') >= $minjampulang){
		// 	$sts_pres = '1'; //jika jam pulang >= jam sistem, makan hadir(sts_pres = 1)
		// }else{
		// 	$sts_pres = '1'; //jika jam pulang < jam sistem, maka dianggap masuk tapi jam pulang < dari semestinya (sts_pres = 2)
		// }
		mysql_query("UPDATE PRESENSI SET JAM_PULANG = '$jam', STS_PRES = '1' where ID_KAR = '$ketemu[1]' AND TGL_PRES = '$tgl'");
	}
	
	echo "<p class='bg-info' style='text-align:center;'>Presensi Berhasil </p>";
}
?>