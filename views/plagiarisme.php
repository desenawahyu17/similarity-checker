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
       
    </div>
</div>
</main>
