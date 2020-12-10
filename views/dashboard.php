<?php
  //menghitung jumlah Dokumen
  $Tampil_dokumen= mysqli_query($koneksi,"SELECT COUNT(id) as jumlah_dokumen from document;");
  $data_dokumen = mysqli_fetch_array($Tampil_dokumen);
  //menghitung jumlah data preprocessing
  $Tampil_preprocessing= mysqli_query($koneksi,"SELECT COUNT(id) as jumlah_preprocessing from preprocessing;");
  $data_preprocessing = mysqli_fetch_array($Tampil_preprocessing);
?> 
<!-- Content -->
<main class="main">
<div class="row">
	<div class="col-lg-4">
      	<div class="card text-center">		  
			<div class="card-header bg-info text-light"><h2>Data Upload</h2></div>
        	<div class="card-body" align="center">
          		<i class="fa fa-upload fa-3x mb-3"></i>
          		<h2>Ada <?php echo $data_dokumen['jumlah_dokumen']; ?> Data</h2>
        	</div>
      	</div>
    </div>
    <div class="col-lg-4">
      	<div class="card text-center">		  
			<div class="card-header bg-info text-light"><h2>Data Preprocessing</h2></div>
        	<div class="card-body" align="center">
          		<i class="fa fa-file-text fa-3x mb-3"></i>
          		<h2>Ada <?php echo $data_preprocessing['jumlah_preprocessing']; ?> Data</h2>
        	</div>
      	</div>
    </div>
    <div class="col-lg-4">
      	<div class="card text-center">		  
			<div class="card-header bg-info text-light"><h2>Data Similarity</h2></div>
        	<div class="card-body" align="center">
          		<i class="fa fa-book fa-3x mb-3"></i>
          		<h2>Ada <?php echo 187; ?> Data</h2>
        	</div>
      	</div>
    </div> 
	<div class="col-12 mt-5 pt-4 d-flex justify-content-center w-100">
		<form class="w-50" enctype="multipart/form-data" action="controllers/uploadfile.php" method="POST"><h3 class="offset-md-3"><i>Upload the document</i></h3>
			<div class="custom-file">
				<input name="uploadfile" type="file" class="custom-file-input" id="customFile">
				<label class="custom-file-label" for="customFile">Choose file</label>
				<button name="savefile" type="submit" class="button mt-2 offset-md-4 w-25"><i class="fa fa-upload"></i> Upload</button>
			</div>
		</form>
	</div>
</div>
</main>