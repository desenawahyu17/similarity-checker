<?php
  //menghitung jumlah Dokumen
  $Tampil_dokumen= mysqli_query($koneksi,"SELECT COUNT(id) as jumlah_dokumen from document;");
  $data_dokumen = mysqli_fetch_array($Tampil_dokumen);
  //menghitung jumlah data preprocessing
  $Tampil_preprocessing= mysqli_query($koneksi,"SELECT COUNT(id) as jumlah_preprocessing from preprocessing;");
  $data_preprocessing = mysqli_fetch_array($Tampil_preprocessing);
  //menghitung jumlah data slangword
  $Tampil_slangword= mysqli_query($koneksi,"SELECT COUNT(id_slangword) as jumlah_slangword from slangword;");
  $data_slangword = mysqli_fetch_array($Tampil_slangword);
  //menghitung jumlah data stopword
  $Tampil_stopword= mysqli_query($koneksi,"SELECT COUNT(id_stopword) as jumlah_stopword from stopword;");
  $data_stopword = mysqli_fetch_array($Tampil_stopword);
  //menghitung jumlah data similarity
  $Tampil_similarity= mysqli_query($koneksi,"SELECT COUNT(id) as jumlah_similarity from plagiarisme;");
  $data_similarity = mysqli_fetch_array($Tampil_similarity);
  $Tampil_avg= mysqli_query($koneksi,"SELECT COUNT(id) as jumlah_avg from plagiarisme;");
  $data_avg = mysqli_fetch_array($Tampil_avg);
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
	<div class="row mb-3">
		<div class="col-lg-4">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Data Upload</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-upload fa-3x mb-3"></i>
					<h2><?php echo $data_dokumen['jumlah_dokumen']; ?><em> Dataset</em></h2>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Data Preprocessing</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-file-text fa-3x mb-3"></i>
					<h2><?php echo $data_preprocessing['jumlah_preprocessing']; ?><em> Clent Text</em></h2>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Data Slangword</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-link fa-3x mb-3"></i>
					<h2><?php echo $data_slangword['jumlah_slangword']; ?><em> Slangword</em></h2>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Data Stopword</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-language fa-3x mb-3"></i>
					<h2><?php echo $data_stopword['jumlah_stopword']; ?><em> Stopword</em></h2>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Similarity</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-book fa-3x mb-3"></i>
					<h2><?php echo $data_similarity['jumlah_similarity']; ?><em> Scanned Documents</em></h2>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="card text-center">		  
				<div class="card-header bg-info text-light"><h2><em>Avg. Similarity</em></h2></div>
				<div class="card-body" align="center">
					<i class="fa fa-area-chart fa-3x mb-3"></i>
					<h2><?php echo $data_avg['jumlah_avg']; ?> %</h2>
				</div>
			</div>
		</div>
	</div>
</div>
</main>