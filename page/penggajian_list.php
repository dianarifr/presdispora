<?php 
	include('header.php');
	if (isset($_GET['delete']) == "delete") {
        	$q = "DELETE FROM penggajian WHERE no_slip = '".$_GET['no_slip']."' ";
    		if (mysql_query($q)) {
                $msg = "Sukses Tambah Data Penggajian ";
            }else{
                $msg = "Gagal Hapus Data Penggajian ";
            }
	}

	$q = "SELECT g.no_slip,k.nama_kar,g.tgl_penggajian, g.periode, g.total_gaji  ";
	$q.= "FROM penggajian g JOIN karyawan k ON g.id_kar = k.id_kar ORDER by g.no_slip ";
	$rs = mysql_query($q);

?>

<div class="col-lg-12">
    <h1 class="page-header">Data Penggajian</h1>
</div>
<div class="col-lg-12 ">
	<div class="panel panel-default">
        <div class="panel-heading">
           	<a href="penggajian_detail.php" class="btn btn-primary">Tambah Data</a>
        </div>
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
                                    echo("<option value='".namaBulan_id($val)."'>".namaBulan_id($val)."</option>");
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
            <div class="dataTable_wrapper table-responsive">
            	<table class="table table-striped table-bordered table-hover" id="penggajian">
            		<thead>
            			<tr>
                            <th>No Slip</th>
                            <td>Periode</td>
	                        <th>Tanggal Pembayaran</th>
                            <th>Nama Karyawan</th>
                            <th>Nominal</th>
	                        <th class="text-center">Aksi</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php 
            				while ($row = mysql_fetch_array($rs)) {
                                $slip = $row['no_slip'];
                                $slip = 'SL'.str_pad($slip, 6, "0", STR_PAD_LEFT);
            			?>
            			<tr>
                            <td><?= $slip ?></td>
                            <td><?= namaBulan_id(substr($row['periode'],0,2))." ".substr($row['periode'],2,4) ?></td>
            				<td><?= $row['tgl_penggajian'] ?></td>
                            <td><?= $row['nama_kar'] ?></td>
            				<td><?= number_format($row['total_gaji'],0,',','.') ?></td>
            				<td class="text-center">
            					<a href="penggajian_detail.php?no_slip=<?=$row['no_slip']?>" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            					<span onclick="if(confirm('Apakah anda yakin akan menghapus data Penggajian <?=$slip?> ?')){location.href='penggajian_list.php?no_slip=<?=$row['no_slip']?>&delete=delete'}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></span>
                                <a target="_blank" href="penggajianCetak_list.php?no_slip=<?=$row['no_slip']?>" class="btn btn-default btn-circle"><i class="fa fa-print"></i></a>
            				</td>
            			</tr>
            			<?php
            				}
            			 ?>
            		</tbody>
            	</table>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php') ?>

<script type="text/javascript">
	$(document).ready(function() {
	    var t = $("#penggajian").DataTable({
            // "order": [],
	    	"columnDefs": 
	    	[
			{ 
				"targets": [ 5 ],
				"orderable": false 
			},
			]
	    });
        $('#cboBulan, #cboTahun').on('change', function () {
            var bln = $("#cboBulan").val();
            var tahun = $("#cboTahun").val();
            var periode = bln + " " + tahun;
            t.columns(1).search( periode ).draw();
        });
	});
</script>