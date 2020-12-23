<?php
ob_start();
include "models/m_document.php";
$dokumen = new dokumen($connection);
if(@$_GET['act'] == ''){
?>

<main class="main">
<div class="jumbotron">
    <div class="row">
        <div class="col-lg-12">
            <h1><i class="fa fa-upload"></i><em> Upload Document</em></h1>
            <ol class="breadcrumb">
                <li> Proses <em>Convert</em> Dokument PDF Ke Teks</li>
            </ol>
        </div>
        <!-- Button trigger modal -->
        <div class="col-12 d-flex justify-content-center w-100">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-upload"></i> Upload Document
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><em>Upload the document</em></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form enctype="multipart/form-data" action="controllers/prosesupload.php" method="POST">
                        <div class="modal-body">
                            File(.pdf)*
                            <div class="custom-file">
                                <input name="prosesupload" type="file" class="custom-file-input" id="customFile" multiple>
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                <small class="text-warning">*| Ukuran File Maksimal adalah 1MB</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="savefile" type="submit" class="btn btn-primary">Upload</button>
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
                            $tampil_dokumen= $dokumen->select_dokumen();
                            while($data = $tampil_dokumen->fetch_object()){
                        ?>
                            <tr>
                                <td width="5%" align="center"><?php echo $no++.".";?></td>
                                <td width="10%" align="center"><?php echo $data->nim ?></td>
                                <td width="15%" align="center"><?php echo $data->uploaddate ?></td>
                                <td width="10%" align="center"><?php echo $data->file_size ?> byte</td>
                                <td width="50%" align="justify" class="read-toggle" data-id="<?php echo $data->nim ?>"><?php echo $data->content ?></td>
                                <td width="10%" align="center">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus<?php echo $data -> id ?>">
                                    <i class="fa fa-trash-o"></i> Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="hapus<?php echo $data -> id ?>" tabindex="-1" aria-labelledby="HapusLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="HapusLabel">Delete Document</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="text-danger">Yakin akan menghapus data ini?<div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            
                                            <a href="?page=uploaddokumen&act=del&id=<?php echo $data -> id ?>">
                                            <button class="btn btn-danger">Delete</button></a>
                                        </div>
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
    $hapusdata = $dokumen->select_id($_GET['id'])->fetch_object()->location;
	unlink(substr($hapusdata,3));
    $dokumen->delete_dokumen($_GET['id']);
	header("location: ?page=uploaddokumen");
}
?>
