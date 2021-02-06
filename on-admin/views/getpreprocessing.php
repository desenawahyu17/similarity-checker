<?php
session_start();
ob_start();
if(@$_SESSION){
?>

<main class="main">
	<div class="jumbotron">
		<div class="row">
			<div class="col-lg-12">
				<h1><i class="fa fa-file-pdf-o"></i><em> Get Preprocessing</em></h1>
				<ol class="breadcrumb">
					<li> Proses <em>Get Preprocessing</em> Dokument</li>
				</ol>
			</div>
            <div class="col-12 d-flex justify-content-end mb-3">
                <a href="?page=preprocessing">
                    <button type="button" class="btn btn-info"><i class="fa fa-backward"></i> Back</button>
                </a> 
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
							<th>Detail Content</th>
						</tr>
					</thead>
					<tbody class="read-more-less" data-id="200">
						<?php 
                            $no= 1;
                            
							for($i=0;$i<count($_SESSION["array_nim"]);$i++){
						?>
							<tr>
								<td width="5%" align="center"><?php echo $no++.".";?></td>
                                <td align="center"><?php echo $_SESSION["array_nim"][$i];?></td>
                                <td align="center"><?php echo $_SESSION["array_uploaddate"][$i];?></td>
                                <td align="center"><?php echo $_SESSION["array_filesize"][$i];?> byte</td>
                                <td align="justify">
                                    <!-- Large modal -->
                                    <div class="text-center"> 
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $no ?>"><i class="fa fa-search-plus"></i> Detail</button>
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
                                                <li class="list-group-item"><strong>Data Awal</strong></br>
                                                    <?php echo $_SESSION["array_dataawal"][$i];?>
                                                </li>
                                                <li class="list-group-item"><strong><em>Case Folding</em></strong></br>
                                                    <?php echo $_SESSION["array_casefolding"][$i];?>
                                                </li>
                                                <li class="list-group-item"><strong><em>Cleaning</em></strong></br>
                                                    <?php echo $_SESSION["array_karakter"][$i];?>
                                                </li>
                                                <li class="list-group-item"><strong><em>Slang Word</em></strong></br>
                                                    <?php echo $_SESSION["array_slangword"][$i];?>    
                                                </li>
                                                <li class="list-group-item"><strong><em>Stop Word</em></strong></br>
                                                    <?php echo $_SESSION["array_stopword"][$i];?>
                                                </li>
                                                <li class="list-group-item"><strong>Menghapus Spasi</strong></br>
                                                    <p class="spasi-text"><?php echo $_SESSION["array_spasi"][$i];?></p>
                                                </li>
                                                <!-- <li class="list-group-item"><strong><em>Stemming</em></strong></br>
                                                    <?php echo $_SESSION["array_stemming"][$i];?>
                                                </li> -->
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
} else {
	header("location: ?page=preprocessing");
}
?>