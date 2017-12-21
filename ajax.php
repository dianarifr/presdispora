<?php 
	include 'koneksi.php';
	switch ($_POST['fungsi']) {
    case "checkGaji":
        $result = mysql_query("select nominal 
        						FROM gaji g JOIN karyawan k ON(g.id_jabatan = k.id_jabatan)
        						WHERE id_kar ='" . $_POST['id_kar'] . "'");
       if(mysql_num_rows($result)>0){
            $data = mysql_fetch_array($result);
            echo number_format($data['nominal'],0,',','.');
            break;
        }else{
            echo 0;
            break;
        }
        break;
    }
?>