<?php 
	include('header.php');
    
    $id_izin = $_REQUEST['id_izin'];
    $r_aksi = $_POST['act'];
    if (isset($r_aksi)) {
        if ($r_aksi == 'simpan') {
            $id_kar = StrNull($_POST['id_kar']);
            $tgl_izin = StrNull($_POST['tgl_izin']);
            $ket_izin = StrNull($_POST['ket_izin']);
            if (empty($id_izin)) { //insert
                $q = "INSERT INTO izin(id_kar,tgl_izin,ket_izin) VALUES('$id_kar','$tgl_izin','$ket_izin')";
                if (mysql_query($q)) {
                    $q = "INSERT INTO presensi(id_kar, tgl_pres, sts_pres) VALUES('$id_kar','$tgl_izin','2')";
                    if (mysql_query($q)) {
                        $msg = "Sukses Tambah Data Izin ";
                    }else{
                        $msg = "Gagal Tambah Data Izin ";
                    }
                }else{
                    $msg = "Gagal Tambah Data Izin ";
                }
            }else{ //update
                $row = mysql_fetch_array(mysql_query("SELECT tgl_izin FROM izin WHERE id_izin = '$id_izin'"));
                $id_izin = $_POST['id_izin'];
                $q = "UPDATE izin 
                        SET id_kar='$id_kar', tgl_izin='$tgl_izin', ket_izin='$ket_izin'
                        WHERE id_izin = '$id_izin' ";
                if (mysql_query($q)) {
                    $q = "DELETE FROM presensi WHERE TGL_PRES = '".$row['tgl_izin']."' AND id_kar = '".$id_kar."' ";
                    if (mysql_query($q)) {
                        $q = "INSERT INTO presensi(id_kar, tgl_pres, sts_pres) VALUES('$id_kar','$tgl_izin','2')";
                        if (mysql_query($q)) {
                            $msg = "Sukses Tambah Data Izin ";
                        }else{
                            $msg = "Gagal Tambah Data Izin ";
                        }
                    }else{
                        $msg = "Gagal Tambah Data Izin ";
                    }
                }else{
                    $msg = "Gagal Ubah Data Izin ";
                }
            }
        }
    }
    else if(isset($id_izin)) {
    	$q = "SELECT i.id_izin, i.id_kar, i.tgl_izin, i.ket_izin ";
    	$q.= "FROM izin i ";
        $q.= "WHERE i.id_izin = '$id_izin' ";
    	$rs = mysql_query($q);
        $row = mysql_fetch_array($rs);
    }
?>

<div class="col-lg-12">
    <h1 class="page-header">Tambah / Edit Data Izin</h1>
</div>
<div class="col-lg-12 ">
    <!-- onSubmit="return validasiForm(this);" -->
    <div class="panel panel-default"> 
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="form" >
            <div class="panel-heading text-center">
                <input type="hidden" name="id_izin" value="<?= $row['id_izin'] ?>">
                <input type="hidden" name="act" id="act">
                <button id="simpan" class="btn btn-primary" onclick="save()">Simpan Data</button>
                <a href="izin_list.php" class="btn btn-warning">Kembali</a>
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
                    <label class="control-label">Nama Karyawan</label>
                    <select id="id_kar" name="id_kar" class="form-control" required o>
                        <option value="">Pilih Karyawan..</option>
                        <?php
                            $q = "SELECT id_kar, nama_kar FROM karyawan ";
                            $hasil = mysql_query($q);
                            while ($r = mysql_fetch_array($hasil)) {
                                if($r['id_kar'] == $row['id_kar'])
                                    echo "<option value='".$r['id_kar']."' selected>".$r['nama_kar']."</option>";
                                else
                                    echo "<option value='".$r['id_kar']."'>".$r['nama_kar']."</option>";
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">Tanggal Izin</label>
                    <input name="tgl_izin" id="tgl_izin" class="form-control" value="<?= $row['tgl_izin'] ?>" required placeholder="Wajib diisi..">
                </div><div class="form-group col-md-8">
                    <label class="control-label">Nama Izin</label>
                    <textarea name="ket_izin" id="ket_izin" class="form-control" placeholder="Wajib diisi.." required><?= $row['ket_izin'] ?></textarea>
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
        if(document.getElementById("id_kar").value=="")
        {
            alert("Nama Karyawan harus diisi!");
            form.id_kar.focus();
            return false;
        }
        if(document.getElementById("tgl_izin").value=="")
        {
            alert("Tanggal Izin harus diisi!");
            form.tgl_izin.focus();
            return false;
        }
        if(document.getElementById("ket_izin").value=="")
        {
            alert("Keterangan harus diisi!");
            form.ket_izin.focus();
            return false;
        }
        
        if (temp) {
            document.getElementById("act").value = "simpan";
            goSave();
        }
    }
    $(document).ready(function(){
        $('#tgl_izin').datetimepicker({
            format: "YYYY-MM-DD",
            locale: 'id',
            //maxDate: moment().add(30, 'days'),
        });
    })
</script>

