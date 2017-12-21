<?php
//error_reporting(0);
include('../koneksi.php');
session_start();

$kdk = $_POST['kdk'];
$pwd = $_POST['pwd'];
// pastikan username dan password adalah berupa huruf atau angka.
if (isset($kdk) and isset($pwd)) {
	$cek_lagi=mysql_query("SELECT username FROM user WHERE username='$kdk' AND username='$pwd'");
	$ketemu=mysql_num_rows($cek_lagi);
	$r=mysql_fetch_array($cek_lagi);

	// Apabila username dan password ditemukan
	if ($ketemu > 0){
	  	$_SESSION['username'] = $r['username'];
		echo "<p class='bg-primary' style='text-align:center;'>Login Berhasil</p>";
		echo '<script>
				$(document).ready(function(){
					setTimeout(function(){
						location.href ="page/dashboard.php"
					}, 
					2000);});
			
			</script>';
		
	}else{
			echo "<p class='bg-danger' style='text-align:center;'>Username atau Password salah!</p>";
	}
}
/* */
?>
