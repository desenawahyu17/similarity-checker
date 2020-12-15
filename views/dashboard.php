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
<div class="jumbotron">
	<div class="row">
		<div class="col-lg-12">
		<h1 class="active"><a href="?page=dashboard"><i class="fa fa-dashboard"></i></a> Beranda</h1>
		<ol class="breadcrumb">
			<li> Visualisasi Hasil Data dari <em>Database</em></li>
		</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Data Upload</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-upload fa-3x mb-3"></i>
					<h2><?php echo $data_dokumen['jumlah_dokumen']; ?><em> Dataset</em></h2>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Data Preprocessing</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-file-text fa-3x mb-3"></i>
					<h2><?php echo $data_preprocessing['jumlah_preprocessing']; ?><em> Clent Text</em></h2>
				</div>
			</div>
		</div>
	</div>
</div>
</main>