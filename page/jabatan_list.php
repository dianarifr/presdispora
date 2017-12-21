<?php 
	include('header.php');
	if (isset($_GET['delete']) == "delete") {
        $q = "SELECT id_jabatan FROM gaji WHERE id_jabatan = '".$_GET['id_jabatan']."' ";
        if (mysql_num_rows(mysql_query($q)) > 0) {
            $msg = "Gagal Hapus Data Jabatan, data masih dipakai di Data Gaji";
        }
        else{
    		$q = "DELETE FROM jabatan WHERE id_jabatan = '".$_GET['id_jabatan']."' ";
    		if (mysql_query($q)) {
                $msg = "Sukses Hapus Data Jabatan ";
            }else{
                $msg = "Gagal Hapus Data Jabatan ";
            }
        }
	}

	$q = "SELECT j.id_jabatan,j.nama_jabatan ";
	$q.= "FROM jabatan j ORDER by id_jabatan ";
	$rs = mysql_query($q);

?>

<div class="col-lg-12">
    <h1 class="page-header">Data Jabatan</h1>
</div>
<div class="col-lg-12 ">
	<div class="panel panel-default">
        <div class="panel-heading">
           	<a href="jabatan_detail.php" class="btn btn-primary">Tambah Data</a>
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
            	<table class="table table-striped table-bordered table-hover" id="jabatan">
            		<thead>
            			<tr>
	                        <th>Kode Jabatan</th>
                            <th>Jabatan</th>
	                        <th class="text-center">Aksi</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php 
            				while ($row = mysql_fetch_array($rs)) {
                                $jabatan = $row['id_jabatan'];
            			?>
            			<tr>
            				<td><?= $jabatan ?></td>
            				<td><?= $row['nama_jabatan'] ?></td>
            				<td class="text-center">
            					<a href="jabatan_detail.php?id_jabatan=<?=$row['id_jabatan']?>" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></a>
            					<span onclick="if(confirm('Apakah anda yakin akan menghapus data Jabatan <?=$row['nama_jabatan']?> ?')){location.href='jabatan_list.php?id_jabatan=<?=$row['id_jabatan']?>&delete=delete'}" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></span>
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
	    $("#jabatan").DataTable({
            // "order": [],
	    	"columnDefs": 
	    	[
			{ 
				"targets": [ 2 ],
				"orderable": false 
			},
			]
	    });
	});
</script>