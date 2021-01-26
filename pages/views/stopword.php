<?php
ob_start();
include "models/m_stopword.php";
$fungsi_stopword = new stopword($connection);
if(@$_POST['tambah']){
	$stopword = $_POST['stopword'];
	$fungsi_stopword->tambah($stopword);
	header("location: ?page=stopword");
}
if(@$_GET['act'] == ''){
?>

<main class="main">
<div class="jumbotron">
    <div class="row">
        <div class="col-lg-12">
            <h1><i class="fa fa-language"></i><em> Stopword</em></h1>
            <ol class="breadcrumb">
                <li> Berikut Data <em>Stopword</em> </li>
            </ol>
        </div>
		<div class="col-12 d-flex justify-content-center w-100">
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus-square"></i> Add Stopword</button> 
        </div>
       <!-- Tabel-->
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped" id="datatables">
				<thead>
					<tr align="center">
						<th>No.</th>
						<th>Stopword</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody class="read-more-less" data-id="200">
					<?php 
						$no= 1;
						$tampil_stopword= $fungsi_stopword->select_stopword();
						while($data = $tampil_stopword->fetch_object()){
					?>
						<tr>
							<td width="5%" align="center"><?php echo $no++.".";?></td>
                            <td align="center"><?php echo $data->stopword ?></td>
                            <td width="30%" align="center">
                               <!-- Button trigger modal -->
							    <a id="edit_stopword" data-toggle="modal" data-target="#edit" data-id_stopword="<?php echo $data->id_stopword; ?>" data-stopword="<?php echo $data->stopword; ?>">
                    			<button class="btn btn-success"><i class="fa fa-pencil-square-o"></i>Edit</button>
								</a>
								
								<a href="?page=stopword&act=del&id_stopword=<?=$data->id_stopword; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus_stopword">
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
						<h4 class="modal-title">Add Data Stopword</h4>
						<button type="button" class="close pt-4" data-dismiss="modal">&times;</button>
					</div>
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-group">
								<label class="control-label" for="stopword">Stopword</label>
								<input type="text" name="stopword" class="form-control" id="stopword1" required>
							<div>	 
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-danger">Reset</button>
							<input type="submit" class="btn btn-info" name="tambah" value="Simpan">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</main>
<?php
 include ".modal_stopword_proses.php";              
?>
<?php
} else if(@$_GET['act'] == 'del'){
	$fungsi_stopword->hapus($_GET['id_stopword']);
	header("location: ?page=stopword");
}
?>