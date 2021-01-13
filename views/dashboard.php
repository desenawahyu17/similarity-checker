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
  $Tampil_avg= mysqli_query($koneksi,"SELECT ROUND(sum(similarity)/count(id)) as jumlah_avg from plagiarisme;");
  $data_avg = mysqli_fetch_array($Tampil_avg);
?> 
<!-- Content -->
<main class="main">
<div class="jumbotron">
	<div class="row">
		<h1 class="active"><a href="?page=dashboard"><i class="fa fa-home"></i></a><em> Home</em></h1>
		<ol class="breadcrumb">
			<h3 align="center">Implementasi Metode N-Gram dan Jaccard Similarity Terhadap Algoritme Winnowing untuk Mendeteksi Plagiarisme Berbasis Web Pada Perpustkaan Universitas Budi Luhur</h3>
		</ol>
		<ol class="breadcrumb">
			<ul>
				<h3 class="modal-title"><strong>Tentang Sistem</strong></h3>
				<h5 align="justify">Sistem ini bertujuan untuk mengetahui nilai <em>similarity</em> pada dokumen abstrak skripsi mahasiswa Budi Luhur. Sistem ini diharapkan dapat memberikan keakurasian yang tepat dalam mengatasi tindakan suatu plagiarisme yang terjadi di dunia akademik, tepatnya di kampus Budi Luhur. </h5>
			</ul>
			<ul>
				<h3 class="modal-title"><strong>Cara Menggunakan</strong></h3>
				<h5>1. Deteksi plagiarisme hanya dilakukan pada dokumen abstrak </h5>
				<h5>2. Fitur <em>import</em> hanya dapat mengenali file masukan berupa <em>.pdf</em>.</h5>
				<h5>3. Hanya dapat mengenali tulisan di dalam file masukan.</h5>
				<h5>4. Ukuran dokumen yang bisa diunggah maksimal 1mb.</h5>
				<h5>5. Untuk pembuatan <em>dataset</em> caranya:</br>
					<ul><h6>- Pada menu, klik <em>document data</em> lalu <em>upload document</em></h6></ul>
					<ul><h6>- Selanjutnya, pada menu, klik <em>document dataset</em> lalu lakukan proses<em>preprocessing</em></h6></ul>
					<ul><h6>- <em>Dataset</em> berhasil dibuat</em></h6></ul>
				</h5>
				<h5>6. Untuk pengecekan <em>similarity</em> dapat dilakukan dengan cara:</br>
					<ul><h6>- Pada menu, klik <em>similarity check</em> lalu <em>scan document</em></h6></ul>
					<ul><h6>- Setelah dokumen berhasil di <em>scan</em> maka nantinya akan terlihat hasil dari <em>similarity</em>nya</h6></ul>
				</h5>
			</ul>
		</ol>
	</div>
</div>
<div class="jumbotron">
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