<?php 
	include('header.php');
	if (isset($_GET['delete']) == "delete") {
        	$q = "DELETE FROM izin WHERE id_izin = '".$_GET['id_izin']."' ";
    		if (mysql_query($q)) {
                $q = "DELETE FROM presensi WHERE TGL_PRES = '".$_GET['tgl_izin']."' AND id_kar = '".$_GET['id_kar']."' ";
                if (mysql_query($q)) {
                    $msg = "Sukses Tambah Data Izin ";
                }else{
                    $msg = "Gagal Tambah Data Izin ";
                }
            }else{
                $msg = "Gagal Hapus Data Izin ";
            }
	}

	$q = "SELECT i.id_izin,k.nama_kar,i.tgl_izin, i.ket_izin, i.id_kar  ";
	$q.= "FROM izin i JOIN karyawan k ON i.id_kar = k.id_kar ORDER by i.id_izin ";
	$rs = mysql_query($q);

?>

<div class="col-lg-12">
    <h1 class="page-header">Data Izin</h1>
</div>
<div class="col-lg-12 ">
	<div class="panel panel-default">
        <div class="panel-heading">
           	<a href="izin_detail.php" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="panel-body">
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
            	<table class="table table-striped table-bordered table-hover" id="izin">
            		<thead>
            			<tr>
	                        <th class="text-center">Tanggal Izin</th>
                            <th>Nama Karyawan</th>
                            <th>Keterangan</th>
	                        <th class="text-center">Aksi</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php 
            				while ($row = mysql_fetch_array($rs)) {
            			?>
            			<tr>
            				<td class="text-center"><?= $row['tgl_izin'] ?></td>
                            <td><?= $row['nama_kar'] ?></td>
            				<td><?= $row['ket_izin'] ?></td>
            				<td class="text-center">
            					<a href="izin_detail.php?id_izin=<?=$row['id_izin']?>" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            					<span onclick="if(confirm('Apakah anda yakin akan menghapus data Izin <?=$row['nama_kar']?> ?')){location.href='izin_list.php?id_izin=<?=$row['id_izin']?>&tgl_izin=<?=$row['tgl_izin']?>&id_kar=<?=$row['id_kar']?>&delete=delete'}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></span>
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
	    $("#izin").DataTable({
            // "order": [],
	    	"columnDefs": 
	    	[
			{ 
				"targets": [ 3 ],
				"orderable": false 
			},
			]
	    });
	});
</script>