<?php 
	include('header.php');
    
    $no_slip = $_REQUEST['no_slip'];
    $r_aksi = $_POST['act'];
    if (isset($r_aksi)) {
        if ($r_aksi == 'simpan') {
            $id_kar = StrNull($_POST['id_kar']);
            $tgl_penggajian = StrNull($_POST['tgl_penggajian']);
            $periode = StrNull($_POST['cboBulan'].$_POST['cboTahun']);
            $total_gaji = IntNull($_POST['total_gaji']);
            if (empty($no_slip)) { //insert
                $q = "SELECT no_slip FROM penggajian WHERE periode='$periode' AND id_kar='$id_kar'";
                if (mysql_num_rows(mysql_query($q)) > 0) {
                    $msg = "Gagal Tambah Data Penggajian, Penggajian Karyawan Pada Periode tersebut Sudah dilakukan ";
                }else{
                    $q = "INSERT INTO penggajian(id_kar,tgl_penggajian,periode,total_gaji) VALUES('$id_kar','$tgl_penggajian','$periode','$total_gaji')";
                    echo $q;
                    if (mysql_query($q)) {
                        $msg = "Sukses Tambah Data Penggajian ";
                    }else{
                        $msg = "Gagal Tambah Data Penggajian ";
                    }
                }
            }else{ //update
                $no_slip = $_POST['no_slip'];
                $q = "UPDATE penggajian 
                        SET id_kar='$id_kar', tgl_penggajian='$tgl_penggajian', periode='$periode', total_gaji='$total_gaji'
                        WHERE no_slip = '$no_slip' ";
                if (mysql_query($q)) {
                    $msg = "Sukses Ubah Data Penggajian ";
                }else{
                    $msg = "Gagal Ubah Data Penggajian ";
                }
            }
        }
    }
    else if(isset($no_slip)) {
    	$q = "SELECT g.no_slip, g.id_kar, g.tgl_penggajian, g.periode, g.total_gaji ";
    	$q.= "FROM penggajian g ";
        $q.= "WHERE g.no_slip = '$no_slip' ";
    	$rs = mysql_query($q);
        $row = mysql_fetch_array($rs);
    }
?>

<div class="col-lg-12">
    <h1 class="page-header">Tambah / Edit Data Penggajian</h1>
</div>
<div class="col-lg-12 ">
    <!-- onSubmit="return validasiForm(this);" -->
    <div class="panel panel-default"> 
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="form" >
            <div class="panel-heading text-center">
                <input type="hidden" name="no_slip" value="<?= $row['no_slip'] ?>">
                <input type="hidden" name="act" id="act">
                <button id="simpan" class="btn btn-primary" onclick="save()">Simpan Data</button>
                <a href="penggajian_list.php" class="btn btn-warning">Kembali</a>
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
                    <label class="control-label">No Slip</label>
                    <input name="kode_gaji" id="kode_gaji" class="form-control" value="<?= ($row['no_slip']!=""?'SL'.str_pad($row['no_slip'], 6, "0", STR_PAD_LEFT):$row['no_slip']) ?>" readonly placeholder="auto">
                </div>
                <div class="form-group col-md-8">
                    <label class="control-label">Periode</label>
                        
                    <select id="cboBulan" name="cboBulan" class="form-control" required>
                        <option value="">Pilih Periode Bulan..</option>
                        <?php for ($i=1; $i <= 12 ; $i++) { 
                            $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                            if($val == substr($row['periode'],0,2))
                                echo("<option value='".$val."' selected>".namaBulan_id($val)."</option>");
                            else
                                echo("<option value='".$val."'>".namaBulan_id($val)."</option>");
                        }
                        ?>
                    </select>
                    <select name="cboTahun" id="cboTahun" class="form-control" required>
                        <option value="" >Pilih Periode Tahun...</option>
                        <?php for ($i=(date('Y')-5); $i <= (date('Y')+5) ; $i++) { 
                            if($i == substr($row['periode'],2,4))
                                echo("<option value='".$i."' selected>".$i."</option>");
                            else
                                echo("<option value='".$i."'>".$i."</option>");
                        }
                        ?>
                    </select>
                </div> 
                <div class="form-group col-md-8">
                    <label class="control-label">Nama Karyawan</label>
                    <select id="id_kar" name="id_kar" class="form-control" required>
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
                    <label class="control-label">Total Gaji</label>
                    <input type="text" name="total_gaji" id="total_gaji" class="form-control" readonly value="<?= ($row['total_gaji']!=""?number_format($row['total_gaji'],'0',',','.'):"") ?>">
                </div>
                <div class="form-group col-md-8">
                    <label class="control-label">Tanggal Pembayaran</label>
                    <input name="tgl_penggajian" id="tgl_penggajian" class="form-control" value="<?= $row['tgl_penggajian'] ?>" required placeholder="Wajib diisi..">
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
        if(document.getElementById("cboBulan").value=="")
        {
            alert("Periode Bulan harus diisi!");
            form.cboBulan.focus();
            return false;
        }
        if(document.getElementById("cboTahun").value=="")
        {
            alert("Periode Tahun harus diisi!");
            form.cboTahun.focus();
            return false;
        }
        if(document.getElementById("id_kar").value=="")
        {
            alert("Nama Karyawan harus diisi!");
            form.id_kar.focus();
            return false;
        }
        if(document.getElementById("tgl_penggajian").value=="")
        {
            alert("Tanggal Pembayaran harus diisi!");
            // form.tgl_penggajian.focus();
            return false;
        }
        
        if (temp) {
            document.getElementById("act").value = "simpan";
            goSave();
        }
    }
    $(document).ready(function(){
        $('#tgl_penggajian').datetimepicker({
            format: "YYYY-MM-DD",
            locale: 'id',
        });

        $('#id_kar').on('change', function(){
            $("#total_gaji").val('Checking...');
            $.post("../ajax.php",{ fungsi: "checkGaji", id_kar:$(this).val() }, function(data)
            {
                $("#total_gaji").val(data);
            });
        });
    })
</script>

