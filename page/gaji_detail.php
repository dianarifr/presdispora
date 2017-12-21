<?php 
	include('header.php');
    
    $id_gaji = $_REQUEST['id_gaji'];
    $r_aksi = $_POST['act'];
    if (isset($r_aksi)) {
        if ($r_aksi == 'simpan') {
            $nominal = IntNull($_POST['nominal']);
            $id_jabatan = StrNull($_POST['id_jabatan']);
            if (empty($id_gaji)) { //insert
                $q = "INSERT INTO gaji(nominal, id_jabatan) VALUES('$nominal','$id_jabatan')";
                if (mysql_query($q)) {
                    $msg = "Sukses Tambah Data Gaji ";
                }else{
                    $msg = "Gagal Tambah Data Gaji ";
                }
            }else{ //update
                $id_gaji = $_POST['id_gaji'];
                $q = "UPDATE gaji 
                        SET nominal='$nominal', id_jabatan='$id_jabatan'
                        WHERE id_gaji = '$id_gaji' ";
                if (mysql_query($q)) {
                    $msg = "Sukses Ubah Data Gaji ";
                }else{
                    $msg = "Gagal Ubah Data Gaji ";
                }
            }
        }
    }
    else if(isset($id_gaji)) {
    	$q = "SELECT g.id_gaji, g.nominal, g.id_jabatan ";
    	$q.= "FROM gaji g ";
        $q.= "WHERE id_gaji = '$id_gaji' ";
    	$rs = mysql_query($q);
        $row = mysql_fetch_array($rs);
    }
?>

<div class="col-lg-12">
    <h1 class="page-header">Tambah / Edit Data Gaji</h1>
</div>
<div class="col-lg-12 ">
    <!-- onSubmit="return validasiForm(this);" -->
    <div class="panel panel-default"> 
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="form" >
            <div class="panel-heading text-center">
                <input type="hidden" name="id_gaji" value="<?= $row['id_gaji'] ?>">
                <input type="hidden" name="act" id="act">
                <button id="simpan" class="btn btn-primary" onclick="save()">Simpan Data</button>
                <a href="gaji_list.php" class="btn btn-warning">Kembali</a>
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
                    <label class="control-label">Kode Gaji</label>
                    <input name="kode_gaji" id="kode_gaji" class="form-control" value="<?= ($row['id_gaji']!=""?'GJ'.str_pad($row['id_gaji'], 6, "0", STR_PAD_LEFT):$row['id_gaji']) ?>" readonly placeholder="auto">
                </div>
                <div class="form-group col-md-8">
                    <label class="control-label">Nominal</label>
                    <input name="nominal" id="nominal" class="form-control" value="<?= ($row['nominal']!=""?number_format($row['nominal'],'0',',','.'):"") ?>" placeholder="Wajib diisi.." onkeydown="return numbersonly(this, event);" required>
                </div>
                <div class="form-group col-md-8">
                    <label class="control-label">Jabatan</label>
                    <select id="id_jabatan" name="id_jabatan" class="form-control" required>
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
        if(document.getElementById("nominal").value=="")
        {
            alert("Nominal harus diisi!");
            form.nominal.focus();
            return false;
        }
        if(document.getElementById("id_jabatan").value=="")
        {
            alert("Jabatan harus diisi!");
            form.id_jabatan.focus();
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

