<?php
ob_start();
include "models/m_preprocessing.php";
$preprocessing = new preprocessing($connection);
if(@$_GET['act'] == ''){
?>

<main class="main">
	<div class="jumbotron">
		<div class="row">
			<div class="col-lg-12">
				<h1><i class="fa fa-file-pdf-o"></i><em> Preprocessing</em></h1>
				<ol class="breadcrumb">
					<li> Proses <em>Preprocessing</em> Dokument</li>
				</ol>
			</div>
			<!-- Button trigger modal -->
			<div class="col-12 d-flex justify-content-center w-100">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
				<i class="fa fa-file-pdf-o"></i> Preprocessing
				</button>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"><em>Preprocessing</em></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form enctype="multipart/form-data" action="controllers/prosespreprocessing.php" method="POST">
							<div class="modal-body">
								Proses <em>Preprocessing</em>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button name="savepreprocessing" type="submit" class="btn btn-success">Preprocessing</button>
							</div>
						</form>
					</div>
				</div>
			</div>  
			<!-- Tabel-->
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" id="datatables">
					<thead>
						<tr align="center">
							<th>No.</th>
							<th>Nim</th>
							<th>Upload Date</th>
							<th>File Size</th>
							<th>Content</th>
							<th>Option</th>
						</tr>
					</thead>
					<tbody class="read-more-less" data-id="200">
						<?php 
							$no= 1;
							$tampil_preprocessing= $preprocessing->select_preprocessing();
							while($data = $tampil_preprocessing->fetch_object()){
						?>
							<tr>
								<td width="5%" align="center"><?php echo $no++.".";?></td>
                                <td width="10%" align="center"><?php echo $data->nim ?></td>
                                <td width="15%" align="center"><?php echo $data->uploaddate ?></td>
                                <td width="10%" align="center"><?php echo $data->file_size ?> byte</td>
                                <td width="50%" align="justify" class="read-toggle" data-id="<?php echo $data->nim ?>"><p class="spasi-text"><?php echo $data->content ?></p></td>
                                <td width="10%" align="justify">
                                   <!-- Button trigger modal -->
								    <div class="text-center"> 
										<a href="?page=preprocessing&act=del&id=<?=$data->id; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
											<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus_preprocessing">
												<i class="fa fa-trash-o"></i> Delete
											</button>
										</a>
									</div>
									<div class="modal fade bd-example-modal-lg<?php echo $no ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title"><strong><em>Detail Content</em></strong></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
										</div>
											<ul class="list-group">
												<li class="list-group-item"><strong>Data Hasil</strong></br>
													<p class="spasi-text"><?php echo $data->content ?></p>
												</li>
												<li class="list-group-item"><strong><em>N-Gram</em></strong></br>
													<p class="spasi-text"><?php echo $data->ngram ?></p>
												</li>
												<li class="list-group-item"><strong><em>Rolling Hash</em></strong></br>
													<p class="spasi-text"><?php echo $data->hash ?></p>
												</li>
												<li class="list-group-item"><strong><em>Window</em></strong></br>
													<p class="spasi-text"><?php echo $data->window ?></p>
												</li>
												<li class="list-group-item"><strong><em>Fingerprint</em></strong></br>
													<p class="spasi-text"><?php echo $data->fingerprint ?></p>
												</li>
											</ul>
                                        </div>
                                    </div>
                                    </div>
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
</main>
<?php
} else if(@$_GET['act'] == 'del'){
	$preprocessing->hapus($_GET['id']);
	header("location: ?page=preprocessing");
}
?>