<?php 
	include('header.php');
    
    $id_jabatan = $_REQUEST['id_jabatan'];
    $r_aksi = $_POST['act'];
    if (isset($r_aksi)) {
        if ($r_aksi == 'simpan') {
            $nama_jabatan = StrNull($_POST['nama_jabatan']);
            if (empty($id_jabatan)) { //insert
                $ceknomor = mysql_fetch_array(mysql_query("SELECT CAST(SUBSTRING(id_jabatan,2,LENGTH(id_jabatan)-1) AS UNSIGNED INTEGER) AS id_jabatan FROM jabatan ORDER BY id_jabatan DESC "));
                $no = $ceknomor['id_jabatan']+1;
                $id_jabatan = "J".$no;
                $q = "INSERT INTO jabatan(id_jabatan,nama_jabatan) VALUES('$id_jabatan','$nama_jabatan')";
                if (mysql_query($q)) {
                    $msg = "Sukses Tambah Data Jabatan ";
                }else{
                    $msg = "Gagal Tambah Data Jabatan ";
                }
            }else{ //update
                $id_jabatan = $_POST['id_jabatan'];
                $q = "UPDATE jabatan 
                        SET nama_jabatan='$nama_jabatan'
                        WHERE id_jabatan = '$id_jabatan' ";
                if (mysql_query($q)) {
                    $msg = "Sukses Ubah Data Jabatan ";
                }else{
                    $msg = "Gagal Ubah Data Jabatan ";
                }
            }
        }
    }
    else if(isset($id_jabatan)) {
    	$q = "SELECT j.id_jabatan, j.nama_jabatan ";
    	$q.= "FROM jabatan j ";
        $q.= "WHERE j.id_jabatan = '$id_jabatan' ";
    	$rs = mysql_query($q);
        $row = mysql_fetch_array($rs);
    }
?>

<div class="col-lg-12">
    <h1 class="page-header">Tambah / Edit Data Jabatan</h1>
</div>
<div class="col-lg-12 ">
    <!-- onSubmit="return validasiForm(this);" -->
    <div class="panel panel-default"> 
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="form" >
            <div class="panel-heading text-center">
                <input type="hidden" name="id_jabatan" value="<?= $row['id_jabatan'] ?>">
                <input type="hidden" name="act" id="act">
                <button id="simpan" class="btn btn-primary" onclick="save()">Simpan Data</button>
                <a href="jabatan_list.php" class="btn btn-warning">Kembali</a>
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
                    <label class="control-label">Kode Jabatan</label>
                    <input name="kode_gaji" id="kode_gaji" class="form-control" value="<?= $row['id_jabatan'] ?>" readonly placeholder="auto">
                </div><div class="form-group col-md-8">
                    <label class="control-label">Nama Jabatan</label>
                    <input name="nama_jabatan" id="nama_jabatan" class="form-control" value="<?= $row['nama_jabatan'] ?>" placeholder="Wajib diisi.." required>
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
        if(document.getElementById("nama_jabatan").value=="")
        {
            alert("Nama Jabatan harus diisi!");
            form.nominal.focus();
            return false;
        }
        
        if (temp) {
            document.getElementById("act").value = "simpan";
            goSave();
        }
    }
</script>

