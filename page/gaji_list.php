<?php 
	include('header.php');
	if (isset($_GET['delete']) == "delete") {
		$q = "DELETE FROM gaji WHERE id_gaji = '".$_GET['id_gaji']."' ";
		if (mysql_query($q)) {
            $msg = "Sukses Hapus Data Gaji ";
        }else{
            $msg = "Gagal Hapus Data Gaji ";
        }
	}

	$q = "SELECT g.id_gaji, g.nominal, j.nama_jabatan ";
	$q.= "FROM gaji g JOIN jabatan j ON g.id_jabatan=j.id_jabatan ";
	$rs = mysql_query($q);

?>

<div class="col-lg-12">
    <h1 class="page-header">Data Gaji</h1>
</div>
<div class="col-lg-12 ">
	<div class="panel panel-default">
        <div class="panel-heading">
           	<a href="gaji_detail.php" class="btn btn-primary">Tambah Data</a>
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
            	<table class="table table-striped table-bordered table-hover" id="gaji">
            		<thead>
            			<tr>
	                        <th>Kode Gaji</th>
                            <th>Jabatan</th>
                            <th>Nominal</th>
	                        <th class="text-center">Aksi</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php 
            				while ($row = mysql_fetch_array($rs)) {
                                $gaji = $row['id_gaji'];
                                $gaji = 'GJ'.str_pad($gaji, 6, "0", STR_PAD_LEFT);
            			?>
            			<tr>
            				<td><?= $gaji ?></td>
            				<td><?= $row['nama_jabatan'] ?></td>
                            <td><?= number_format($row['nominal'],0,',','.') ?></td>
            				<td class="text-center">
            					<a href="gaji_detail.php?id_gaji=<?=$row['id_gaji']?>" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            					<span onclick="if(confirm('Apakah anda yakin akan menghapus data Gaji <?=$gaji?> ?')){location.href='gaji_list.php?id_gaji=<?=$row['id_gaji']?>&delete=delete'}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></span>
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
	    $("#gaji").DataTable({
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