<?php 
	include('header.php');
	if (isset($_GET['delete']) == "delete") {
		$q = "DELETE FROM karyawan WHERE id_kar = '".$_GET['id_kar']."' ";
		if (mysql_query($q)) {
            $msg = "Sukses Hapus Data Karyawan ";
        }else{
            $msg = "Gagal Hapus Data Karyawan ";
        }
	}

	$q = "SELECT k.id_kar, k.nama_kar, j.nama_jabatan, k.alamat_kar, k.kode_kar, k.sts_kar ";
	$q.= "FROM karyawan k JOIN jabatan j ON k.id_jabatan=j.id_jabatan ";
	$rs = mysql_query($q);


?>

<div class="col-lg-12">
    <h1 class="page-header">Data Karyawan</h1>
</div>
<div class="col-lg-12 ">
	<div class="panel panel-default">
        <div class="panel-heading">
           	<a href="karyawan_detail.php" class="btn btn-primary">Tambah Data</a>
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
            	<table class="table table-striped table-bordered table-hover" id="karyawan">
            		<thead>
            			<tr>
	                        <th>Nama</th>
                            <th>Jabatan</th>
	                        <th>Alamat</th>
	                        <th class="text-center">Kode</th>
	                        <th class="text-center">Status</th>
	                        <th class="text-center">Aksi</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php 
            				while ($row = mysql_fetch_array($rs)) {
            			?>
            			<tr>
            				<td><?= $row['nama_kar'] ?></td>
            				<td><?= $row['nama_jabatan'] ?></td>
            				<td><?= $row['alamat_kar'] ?></td>
            				<td class="text-center"><?= $row['kode_kar'] ?></td>
            				<td class="text-center">
            					<?php 
            						if($row['sts_kar']==1)
            							echo '<button type="button" class="btn btn-success btn-xs">Aktif</button>';
            						else
            							echo '<button type="button" class="btn btn-warning btn-xs">Tidak Aktif</button>';
            					?>
            				</td>
            				<td class="text-center">
            					<a href="karyawan_detail.php?id_kar=<?=$row['id_kar']?>" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            					<span onclick="if(confirm('Apakah anda yakin akan menghapus data Karyawan <?=$row['nama_kar']?> ?')){location.href='karyawan_list.php?id_kar=<?=$row['id_kar']?>&delete=delete'}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></span>
            					<a target="_blank" href="karyawanCetak_list.php?id_kar=<?=$row['id_kar']?>" class="btn btn-default btn-circle"><i class="fa fa-print"></i></a>
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
	    $("#karyawan").DataTable({
	    	"columnDefs": 
	    	[
			{ 
				"targets": [ 5 ],
				"orderable": false 
			},
			]
	    });
	});
</script>