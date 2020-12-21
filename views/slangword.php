<?php
ob_start();
include "models/m_slangword.php";
$slangword = new slangword($connection);
if(@$_GET['act'] == ''){
?>

<main class="main">
<div class="jumbotron">
    <div class="row">
        <div class="col-lg-12">
            <h1><i class="fa fa-link"></i><em> Slangword</em></h1>
            <ol class="breadcrumb">
                <li> Berikut Data <em>Slangword</em> </li>
            </ol>
        </div>
        <!-- Button trigger modal -->
        <div class="col-12 d-flex justify-content-center w-100">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus-square"></i> Add Slangword</button> 
        </div>
       <!-- Tabel-->
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="datatables">
					<thead>
						<tr align="center">
							<th>No.</th>
							<th>Slangword</th>
							<th>Kata Asli</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody class="read-more-less" data-id="200">
						<?php 
							$no= 1;
							$tampil_slangword= $slangword->select_slangword();
							while($data = $tampil_slangword->fetch_object()){
						?>
							<tr>
								<td width="5%" align="center"><?php echo $no++.".";?></td>
                                <td align="center"><?php echo $data->slangword ?></td>
                                <td align="center"><?php echo $data->kata_asli ?></td>
                                <td width="20%" align="center">
                                   <!-- Button trigger modal -->
								    <a id="edit_slangword" data-toggle="modal" data-target="#edit" data-id_slangword="<?php echo $data->id_slangword; ?>" data-slangword="<?php echo $data->slangword; ?>" data-kata="<?php echo $data->kata_asli; ?>" >
                        			<button class="btn btn-success"><i class="fa fa-pencil-square-o"></i>Edit</button>
									</a>
									
									<a href="?page=slangword&act=del&id_slangword=<?=$data->id_slangword; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus_slangword">
									<i class="fa fa-trash-o"></i> Delete
									</button>
									</a>
                                </td>
							</tr> 
						<?php
							}
						?>
					</tbody>
				</table>	
		</div>
		<div id="tambah" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Add Data Slangword</h4>
						<button type="button" class="close pt-4" data-dismiss="modal">&times;</button>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="slangword">Slangword</label>
								<input type="text" name="slangword" class="form-control" id="slangword1" required>
							<div>
							<div class="form-group">
								<label class="control-label" for="kata_asli">Kata Asli</label>
								<input type="text" name="kata_asli" class="form-control" id="kata_asli1" required>
							<div>	 
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-danger">Reset</button>
							<input type="submit" class="btn btn-info" name="tambah" value="Simpan">
						</div>
					</form>
					<?php
					if(@$_POST['tambah']){
						$slangword = $_POST['slangword'];
						$kata_asli = $_POST['kata_asli'];
						$simpan = mysqli_query($slangword,$kata_asli);
						if($simpan){
							$slangword->tambah($slangword,$kata_asli);
							header("location: ?page=slangword");
						}
					}
					?>
				</div>
			</div>
		</div>
    </div>
</div>
</main>
<?php
 include ".modal_slangword_proses.php";              
?>
<?php
} else if(@$_GET['act'] == 'del'){
	$slangword->hapus($_GET['id_slangword']);
	header("location: ?page=slangword");
}
?>