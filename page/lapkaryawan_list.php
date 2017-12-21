<?php 
    include('header.php');

?>

<div class="col-lg-12">
    <h1 class="page-header">Laporan Penggajian Karyawan</h1>
</div>
<div class="col-lg-12 ">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <div class="text-left">
                        <label class="col-sm-4 control-label">Jabatan</label>
                        <div class="col-sm-4">
                            <select id="id_jabatan" name="id_jabatan" class="form-control" required>
                                <option value="">Pilih Jabatan..</option>
                                <?php
                                    $q = "SELECT id_jabatan, nama_jabatan FROM JABATAN ";
                                    $hasil = mysql_query($q);
                                    while ($r = mysql_fetch_array($hasil)) {
                                        echo "<option value='".$r['id_jabatan']."'>".$r['nama_jabatan']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="text-center">
                        <button id="cetak" class="btn btn-primary">Tampilkan Data</button>
                    </div>
                </div>
            </div>
            <?php 
                if(isset($msg)){ 
                    if (substr($msg, 0, 5) == "Gagal") {
                        echo '<div class="alert alert-danger text-center">'. $msg . '</div>';
                    } else {
                        echo '<div class="alert alert-success text-center">'. $msg . '</div>';
                    }
                }
            ?>
            
        </div>
    </div>
</div>

<?php include('footer.php') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#cetak').on('click', function () {
            var id_jabatan = $("#id_jabatan").val();
            if ($("#id_jabatan").val() != "") {
                var url = "lapkaryawan_detail.php?id_jabatan="+id_jabatan;
                // e.stopImmediatePropagation(); //mencegah tidak open tab 2x
                var win = window.open(url,"_blank")
                win.focus();
            }else{
                alert("Jabatan diisi!");
            }
        });
    });
</script>