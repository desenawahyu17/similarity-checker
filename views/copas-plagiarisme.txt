<?php
ob_start();
include "models/m_plagiarisme.php";
$plagiarisme = new plagiarisme($connection);
if(@$_GET['act'] == ''){
?>

<main class="main">
<div class="jumbotron">
    <div class="row">
        <div class="col-lg-12">
            <h1><i class="fa fa-book"></i><em> Scan Document</em></h1>
            <ol class="breadcrumb">
                <li> Proses pengecekan <em>Similarity</em></li>
            </ol>
        </div>
        <!-- Button trigger modal -->
        <div class="col-12 d-flex justify-content-center w-100">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-book"></i> Scan Document
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><em>Scan document</em></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form enctype="multipart/form-data" action="controllers/prosesscan.php" method="POST">
                        <div class="modal-body">
                            File(.pdf)*
                            <div class="custom-file">
                                <input name="prosesscan" type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <small class="text-warning">*| Ukuran File Maksimal adalah 1MB</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="savefile" type="submit" class="btn btn-primary">Scan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Tabel -->
        <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover table-striped" id="datatables">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>Title</th>
                            <th>Scan Date</th>
                            <th>File Size</th>
                            <th>Similarity</th>
                            <th>Keterangan</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody class="read-more-less" data-id="200">
                        <?php 
                            $no= 1;
                            $tampil_plagiarisme= $plagiarisme->select_plagiarisme();
                            while($data = $tampil_plagiarisme->fetch_object()){
                                $nama_file = explode(".", $data->title, 2);
                                $keterangan_similariry = "-";
                                if($data->similarity==0){
                                    $keterangan_similariry = "<div>Tidak Plagiarisme</div>";
                                }
                                else if($data->similarity>0 && $data->similarity<15){
                                    $keterangan_similariry = "Plagiarisme Sedikit";
                                }
                                else if($data->similarity>=15 && $data->similarity<50){
                                    $keterangan_similariry = "Plagiarisme Sedang";
                                }
                                else if($data->similarity>=50 && $data->similarity==100){
                                    $keterangan_similariry = "Plagiarisme Berat";
                                }
                        ?>
                            <tr>
                                <td width="5%" align="center"><?php echo $no++.".";?></td>
                                <td align="center"><?php echo $nama_file[0] ?></td>
                                <td align="center"><?php echo $data->scandate ?></td>
                                <td align="center"><?php echo $data->file_size ?> byte</td>
                                <td align="center"><?php echo $data->similarity ?> %</td>
                                <td align="center"><?php echo $keterangan_similariry ?></td>
                                <td align="justify">
                                    <!-- Large modal -->
                                    <div class="text-center"> 
                                        <a href="?page=plagiarisme&act=del&id=<?=$data->id; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus_plagiarisme">
                                                <i class="fa fa-trash-o"></i> Delete
                                            </button>
                                        </a>                                  
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $no ?>"><i class="fa fa-search-plus"></i> Detail</button>
                                        
                                        <a href="?page=detailplagiarisme">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-info-circle"></i> Hasil</button>
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
                                                <li class="list-group-item"><strong>Data Awal</strong></br>
													<?php echo $data->content ?>
												</li>
												<li class="list-group-item"><strong>Data Hasil</strong></br>
													<p class="spasi-text"><?php echo $data->content_clean ?></p>
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
	$plagiarisme->delete_plagiarisme($_GET['id']);
	header("location: ?page=plagiarisme");
}
?>
