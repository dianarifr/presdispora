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
                        <label class="col-sm-4 control-label">Periode Bulan</label>
                        <div class="col-sm-4">
                            <select id="cboBulan" name="cboBulan" class="form-control">
                                <option value="">Pilih Periode Bulan..</option>
                                <?php for ($i=1; $i <= 12 ; $i++) { 
                                    $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                                    echo("<option value='".$val."'>".namaBulan_id($val)."</option>");
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <label class="col-sm-4 control-label">Periode Tahun</label>
                        <div class="col-sm-4">
                            <select name="cboTahun" id="cboTahun" class="form-control" >
                                <option value="" >Pilih Periode Tahun...</option>
                                <?php for ($i=(date('Y')-5); $i <= (date('Y')+5) ; $i++) { 
                                    echo("<option value='".$i."'>".$i."</option>");
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
            var tgl = $("#cboBulan").val()+$("#cboTahun").val();
            if ($("#cboBulan").val() != "" && $("#cboTahun").val() != "") {
                var url = "lappenggajian_detail.php?tgl_pres="+tgl;
                // e.stopImmediatePropagation(); //mencegah tidak open tab 2x
                var win = window.open(url,"_blank")
                win.focus();
            }else{
                alert("Periode Bulan / Tahun harus diisi!");
            }
        });
	});
</script>