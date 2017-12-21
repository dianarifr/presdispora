<?php 
	include('header.php');
    function kode(){
        $charSet ='ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $k = rand(0,strlen($charSet)-1);
            $randomString .= $charSet{$k};
        }
        return $randomString;
    };

    $id_kar = $_REQUEST['id_kar'];
    $r_aksi = $_POST['act'];
    if (isset($r_aksi)) {
        if ($r_aksi == 'simpan') {
            $id_jabatan = StrNull($_POST['id_jabatan']);
            $nama_kar = StrNull($_POST['nama_kar']);
            $alamat_kar = StrNull($_POST['alamat_kar']);
            $kode_kar = StrNull($_POST['kode_kar']);
            $no_telp_kar = StrNull($_POST['no_telp_kar']);
            $tgl_lhr_kar = StrNull($_POST['tgl_lhr_kar']);
            $tl_kar = StrNull($_POST['tl_kar']);
            $agama_kar = StrNull($_POST['agama_kar']);
            $jkel_kar = StrNull($_POST['jkel_kar']);
            $sts_kar = IntNull($_POST['sts_kar']);
            if (empty($id_kar)) { //insert
                $ceknomor = mysql_fetch_array(mysql_query("SELECT CAST(SUBSTRING(ID_KAR,3,LENGTH(ID_KAR)-1) AS UNSIGNED INTEGER) AS ID_KAR FROM KARYAWAN ORDER BY ID_KAR DESC "));
                $no = $ceknomor['ID_KAR']+1;
                $id_kar = "KR".$no;
                $q = "INSERT INTO karyawan(ID_KAR, ID_JABATAN, NAMA_KAR, ALAMAT_KAR, NO_TELP_KAR, STS_KAR, KODE_KAR, TGL_LHR_KAR, AGAMA_KAR, JKEL_KAR, TL_KAR) VALUES('$id_kar','$id_jabatan','$nama_kar','$alamat_kar','$no_telp_kar','$sts_kar','$kode_kar','$tgl_lhr_kar','$agama_kar','$jkel_kar','$tl_kar')";
                if (mysql_query($q)) {
                    $msg = "Sukses Tambah Data Karyawan ";
                }else{
                    $msg = "Gagal Tambah Data Karyawan ";
                }
            }else{ //update
                $id_kar = $_POST['id_kar'];
                $q = "UPDATE karyawan 
                        SET ID_JABATAN='$id_jabatan', NAMA_KAR='$nama_kar', ALAMAT_KAR='$alamat_kar', NO_TELP_KAR='$no_telp_kar', STS_KAR='$sts_kar', TGL_LHR_KAR='$tgl_lhr_kar', AGAMA_KAR='$agama_kar', JKEL_KAR='$jkel_kar', TL_KAR='$tl_kar'
                        WHERE id_kar = '$id_kar' ";
                if (mysql_query($q)) {
                    $msg = "Sukses Ubah Data Karyawan ";
                }else{
                    $msg = "Gagal Ubah Data Karyawan ";
                }
            }
        }
    }
    else if(isset($id_kar)) {
    	$q = "SELECT k.id_kar, k.nama_kar, k.alamat_kar, k.kode_kar, k.id_jabatan,
            k.sts_kar, k.no_telp_kar, k.tgl_lhr_kar, k.tl_kar, k.agama_kar, k.jkel_kar, k.sts_kar ";
    	$q.= "FROM karyawan k ";
        $q.= "WHERE id_kar = '$id_kar' ";
    	$rs = mysql_query($q);
        $row = mysql_fetch_array($rs);
    }
?>

<div class="col-lg-12">
    <h1 class="page-header">Tambah / Edit Data Karyawan</h1>
</div>
<div class="col-lg-12 ">
    <div class="panel panel-default">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="form">
            <div class="panel-heading text-center">
                <input type="hidden" name="id_kar" value="<?= $row['id_kar'] ?>">
                <input type="hidden" name="act" id="act">
                <button type="button" id="simpan" class="btn btn-primary" onclick="save()">Simpan Data</button>
                <a href="karyawan_list.php" class="btn btn-warning">Kembali</a>
                <br><br>
                <?php 
                    if(isset($msg)){ 
                        if (substr($msg, 0, 5) == "Gagal") {
                            echo '<div class="alert alert-danger">'. $msg . '</div>';
                        } else {
                            echo '<div class="alert alert-success">'. $msg . '</div>';
                        }
                    }
                ?>
            </div>
            <div class="panel-body">
                <div class="form-group col-md-8">
                    <label class="control-label">Kode Karyawan</label>
                    <input name="kode_kar" id="kode_kar" class="form-control" value="<?= ($row['kode_kar']==""?kode():$row['kode_kar']) ?>" readonly>
                </div><div class="form-group col-md-8">
                    <label class="control-label">Nama</label>
                    <input name="nama_kar" id="nama_kar" class="form-control" value="<?= $row['nama_kar'] ?>" required placeholder="Wajib diisi.." o>
                </div>
                <div class="form-group col-md-8">
                    <label class="control-label">Alamat</label>
                    <input name="alamat_kar" id="alamat_kar" class="form-control" value="<?= $row['alamat_kar'] ?>" required placeholder="Wajib diisi.." >
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">Jabatan</label>
                    <select id="id_jabatan" name="id_jabatan" class="form-control" required o>
                        <option value="">Pilih Jabatan..</option>
                        <?php
                            $q = "SELECT id_jabatan, nama_jabatan FROM JABATAN ";
                            $hasil = mysql_query($q);
                            while ($r = mysql_fetch_array($hasil)) {
                                if($r['id_jabatan'] == $row['id_jabatan'])
                                    echo "<option value='".$r['id_jabatan']."' selected>".$r['nama_jabatan']."</option>";
                                else
                                    echo "<option value='".$r['id_jabatan']."'>".$r['nama_jabatan']."</option>";
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">No HP</label>
                    <input name="no_telp_kar" id="no_telp_kar" class="form-control" value="<?= $row['no_telp_kar'] ?>" required placeholder="Wajib diisi.." >
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">Tanggal Lahir</label>
                    <input name="tgl_lhr_kar" id="tgl_lhr_kar" class="form-control" value="<?= $row['tgl_lhr_kar'] ?>">
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">Tempat Lahir</label>
                    <input name="tl_kar" id="tl_kar" class="form-control" value="<?= $row['tl_kar'] ?>">
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">Agama</label>
                    <select class="form-control" name="agama_kar">
                    <?php 
                        $agama = array('Islam','Kristen','Katolik','Hindu','Budha','Lain-Lain');
                        foreach ($agama as $key) {
                            if($key == $row['agama_kar'])
                                echo "<option value='".$key."' selected>".$key."</option>";
                            else
                                echo "<option value='".$key."'>".$key."</option>";
                        }
                    ?>
                    </select>
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">Jenis Kelamin</label>
                    <div class="input-group">
                        <div class="radio">
                          <label>
                            <input type="radio" name="jkel_kar" id="jkel_kar" value="l" <?php if($row['jkel_kar']=='l'){echo 'checked';}else{echo '';} ?> >
                            Laki - Laki
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="jkel_kar" id="jkel_kar" value="p" <?php if($row['jkel_kar']=='p'){echo 'checked';}else{echo '';} ?> >
                            Perempuan
                          </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-8">
                    <label class="control-label">Status Aktif</label>
                    <div class="input-group">
                        <div class="radio">
                          <label>
                            <input type="radio" name="sts_kar" id="sts_kar" value="1" <?php if(empty($row['sts_kar'])){echo 'checked';} if($row['sts_kar']=='1'){echo 'checked';}else{echo '';} ?> >
                            Aktif
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="sts_kar" id="sts_kar" value="0" <?php if($row['sts_kar']=='0'){echo 'checked';}else{echo '';} ?> >
                            Tidak Aktif
                          </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('footer.php') ?>

<script type="text/javascript">
    function goSave() {
        document.getElementById("form").submit();
    }
    function save() {
        var temp = true;
        if(document.getElementById("nama_kar").value=="")
        {
            alert("Nama harus diisi!");
            form.nama_kar.focus();
            return false;
        }
        if(document.getElementById("alamat_kar").value=="")
        {
            alert("Alamat harus diisi!");
            form.alamat_kar.focus();
            return false;
        }
        if(document.getElementById("id_jabatan").value=="")
        {
            alert("Jabatan harus diisi!");
            form.id_jabatan.focus();
            return false;
        }
        if(document.getElementById("no_telp_kar").value=="")
        {
            alert("No HP harus diisi!");
            form.no_telp_kar.focus();
            return false;
        }

        if (temp) {
            document.getElementById("act").value = "simpan";
            goSave();
        }
    }
    $(document).ready(function(){
        $('#tgl_lhr_kar').datetimepicker({
            format: "YYYY-MM-DD",
            locale: 'id',
            maxDate: 'now',
            //maxDate: moment().add(30, 'days'),
        });
    })
</script>

