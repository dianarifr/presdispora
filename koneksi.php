<?php
error_reporting(0);
define('DB_NAMA', 'presdispora'); // sesuaikan dengan nama database anda
define('DB_USER', 'root'); // sesuaikan dengan nama pengguna database anda
define('DB_PASSWORD', ''); // sesuaikan dengan kata sandi database anda
define('DB_HOST', 'localhost'); // ganti jika letak database mysql di komputer lain
mysql_select_db(DB_NAMA,mysql_connect(DB_HOST,DB_USER,DB_PASSWORD));

function namaBulan_id($bulan="01"){
	switch($bulan)
	{
		case '01':
			$nama = "Januari";
			break;
		case '02':
			$nama = "Februari";
			break;
		case '03':
			$nama = "Maret";
			break;
		case '04':
			$nama = "April";
			break;				
		case '05':
			$nama = "Mei";
			break;
		case '06':
			$nama = "Juni";
			break;
		case '07':
			$nama = "Juli";
			break;
		case '08':
			$nama = "Agustus";
			break;
		case '09':
			$nama = "September";
			break;
		case '10':
			$nama = "Oktober";
			break;
		case '11':
			$nama = "November";
			break;
		case '12':
			$nama = "Desember";
			break;			
		default:
			$nama = "Error";
			break;																						
	}
	return $nama;
}

function namaHari_id($hari="Sun")
{
	switch($hari)
	{
		case 'Sun':
			$nama = "Minggu";
			break;
		case 'Mon':
			$nama = "Senin";
			break;
		case 'Tue':
			$nama = "Selasa";
			break;
		case 'Wed':
			$nama = "Rabu";
			break;
		case 'Thu':
			$nama = "Kamis";
			break;
		case 'Fri':
			$nama = "Jumat";
			break;
		case 'Sat':
			$nama = "Sabtu";
			break;		
		default:
			$nama = "Error";
			break;																						
	}
	return $nama;
}

function StrNull($text){
	if (!empty($text)) {
		return $text;
	}else{
		return 'NULL';
	}
}

function IntNull($text){
	if (!empty($text)) {
		return str_replace(".", "", $text);
	}else{
		return 0;
	}
}

function convertNumberToWord($digit)
{
	$kalimat="";
	$bagi = 1000000;
	
	$digitAsli = $digit;
	$angka = $digit;
	while($digit>1)
	{		
		if(floor($digit/$bagi)>=1)
		{
			$angka = floor($digit/$bagi); 
			$digit = $digit - ($angka*$bagi);
			$sisa = floor($angka/100);
			if($sisa==1)
				$kalimat.= "Seratus ";
			elseif($sisa>1)
				$kalimat.=spellNumber($sisa)."Ratus ";
			
			$angka = $angka-($sisa*100);
			$sisa = floor($angka/10);
			
			if($angka==11)
			{
				$kalimat.= "Sebelas ";
				$sisa = 0;
			}
			elseif($angka>11 and $angka<20)
			{
				$belasan = $angka%10;
				$kalimat.= spellNumber($belasan)."Belas ";
				$sisa = 0;
			}
			else
			{			
				if($angka==10)
					$kalimat.= "Sepuluh ";
				elseif($angka>=20)
					$kalimat.=spellNumber($sisa)."Puluh ";
					
				$angka = $angka-($sisa*10);
				$sisa = $angka;
			}
			if($sisa==1 && $bagi==1000)
			{
				if($digitAsli>=2000)
					$kalimat.= "Satu Ribu ";
				else
					$kalimat.="Seribu ";
			}
			elseif($sisa>0)
				$kalimat.=spellNumber($sisa);
				
			if($bagi == 1000000000)
				$kalimat.="Milyar ";
			elseif($bagi == 1000000)
				$kalimat.="Juta ";
			elseif($bagi == 1000 && $sisa<>1)
				$kalimat.="Ribu ";
		}
		$bagi = $bagi/1000;	
	}
	return $kalimat . " Rupiah";
}

function spellNumber($angka)
{
	$kata = "";
	switch($angka)
	{
	case 1:
		$kata = "Satu ";
		break;
	case 2:
		$kata = "Dua ";
		break;
	case 3:
		$kata = "Tiga ";
		break;
	case 4:
		$kata = "Empat ";
		break;
	case 5:
		$kata = "Lima ";
		break;
	case 6:
		$kata = "Enam ";
		break;
	case 7:
		$kata = "Tujuh ";
		break;
	case 8:
		$kata = "Delapan ";
		break;
	case 9:
		$kata = "Sembilan ";
		break;
	};
	return $kata;												
}

?>
