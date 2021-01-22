<?php
session_start();
include "models/m_plagiarisme.php";
include "config/koneksi.php";
$plagiarisme = new plagiarisme($connection);


//Pengenalan array untuk dataset
$list_perDataset = array();
$list_fingerprint = array();
$title = array();
$file_size = array();
$content = array();
$data_ngram = array();
$data_hash = array();
$data_window = array();
$data_fingerprint = array();

//Mengambil fingerprint dataset
$title = $_SESSION["nim_tampil"];
$file_size = $_SESSION["filesize_tampil"];
$content = $_SESSION["content_tampil"];
$list_fingerprint = $_SESSION["fingerprint"];
$data_ngram = $_SESSION["ngram_tampil"];
$data_hash = $_SESSION["hash_tampil"];
$data_window = $_SESSION["window_tampil"];
$data_fingerprint = $_SESSION["fingerprint_tampil"];

//Mengambil fingerprint data tes
$hasil_sessionfinger = explode("|", $_SESSION["hasil_fingerprint"]);
$list_fingerprint1 = array();
foreach ($hasil_sessionfinger as $i=>$fingerprint1) {
	array_push($list_fingerprint1,$fingerprint1);
}

// echo"<pre>";
// var_dump($list_fingerprint[0], $list_fingerprint1);
// echo"</pre>";
// die();
$list_similarity = array();


for($a = 0; $a < count($list_fingerprint); $a++){

	//Membentuk array irisan
	$x_irisan_y = array();
	$jumlah_x_n_y = 0;

	//Membentuk array union
	$x_union_y = array();
	$jumlah_x_u_y = 0;

	//Mencari Irisan dan Union
	for($y = 0; $y < count($list_fingerprint1); $y++){
		for($x = 0; $x < count($list_fingerprint[$a]); $x++){
			if($list_fingerprint1[$y] == $list_fingerprint[$a][$x]){
				array_push($x_irisan_y,$list_fingerprint1[$y]);
			}
			array_push($x_union_y,$list_fingerprint[$a][$x]);
		}
		array_push($x_union_y,$list_fingerprint1[$y]);
	}
	
	//Menghapus data duplikat
	$x_irisan_y = array_unique($x_irisan_y); 
	$x_union_y = array_unique($x_union_y);

	//Menghitung Jumlah data irisan & union
	$jumlah_x_n_y = count($x_irisan_y);
	$jumlah_x_u_y = count($x_union_y);

	//Perhitungan jaccard
	$jaccard = 0;
	$jaccard = ($jumlah_x_n_y/$jumlah_x_u_y)*100;
	$jaccard = round($jaccard,2);	
	// rsort($list_similarity);
	
	array_push($list_similarity,$jaccard);
	
}

if(@$_SESSION){
?>

<main class="main">
	<div class="jumbotron">
		<div class="row">
			<div class="col-lg-12">
				<h1><i class="fa fa-file-pdf-o"></i><em> Similarity Details</em></h1>
				<ol class="breadcrumb">
					<li>  Detail<em> Similarity</em> Dokument</li>
				</ol>
			</div>
            <div class="col-12 d-flex justify-content-end mb-3">
                <a href="?page=plagiarisme">
                    <button type="button" class="btn btn-info"><i class="fa fa-backward"></i> Back</button>
                </a> 
            </div>
		</div>
	</div>

	<div class="jumbotron">
		<div class="row">
			<ol class="breadcrumb">
				<h3 align="center">Dokumen Data Tes</h3>
			</ol>
			<div class="table-responsive mt-3">
                <table class="table table-bordered table-hover table-striped" id="datatables">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>Nim</th>
                            <th>File Size</th>
							<th>Content</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody class="read-more-less" data-id="200">
                        <tr>
							<td width="5%" align="center"><?php echo '1.'; ?></td>
							<td width="15%" align="center"><?php echo $_SESSION['file_name']; ?></td>
							<td width="15%" align="center"><?php echo $_SESSION['file_size']; ?>byte</td>
							<td width="50%" align="justify" class="read-toggle" data-id="scan1"><p class="spasi-text"><?php echo $_SESSION['teks_bersih']; ?></p></td>
							<td width="15%" align="justify"> 
								<!-- Button trigger modal -->
								<div class="text-center"> 
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_datascan1"><i class="fa fa-search-plus"></i> Detail</button>  
									</div>
									<div class="modal fade bd-example-modal-lg" id="modal_datascan1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
												<p class="spasi-text"><?php echo $_SESSION['teks_bersih']; ?></p>
											</li>
											<li class="list-group-item"><strong><em>N-Gram</em></strong></br>
												<p class="spasi-text"><?php echo $_SESSION['hasil_ngram']; ?></p>
											</li>
											<li class="list-group-item"><strong><em>Rolling Hash</em></strong></br>
												<p class="spasi-text"><?php echo $_SESSION['hasil_hash']; ?></p>
											</li>
											<li class="list-group-item"><strong><em>Window</em></strong></br>
												<p class="spasi-text"><?php echo $_SESSION['hasil_window']; ?></p>
											</li>
											<li class="list-group-item"><strong><em>Fingerprint</em></strong></br>
												<p class="spasi-text"><?php echo $_SESSION['hasil_fingerprint'];?></p>
											</li>
										</ul>
                                    </div>
                                </div>
							</td>
						</tr>
                    </tbody>
     		    </table>	
		    </div>
		</div>
	</div>

	<div class="jumbotron">
		<div class="row">
		<ol class="breadcrumb">
			<h3 align="center">Dokumen Dataset</h3>
		</ol>
			<div class="table-responsive mt-3">
                <table class="table table-bordered table-hover table-striped" id="datatables2">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>Nim</th>
                            <th>File Size</th>
							<th>Content</th>
                            <th>Similarity</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody class="read-more-less" data-id="200">
                        <?php 
							$no= 1;
							for($i=0; $i<count($title); $i++){
                        ?>
                            <tr>
                                <td width="5%" align="center"><?php echo $no++.".";?></td>
                                <td width="10%" align="center"><?php echo $title[$i] ?></td>
                                <td width="10%" align="center"><?php echo $file_size[$i] ?> byte</td>
                                <td width="48%" align="justify" class="read-toggle" data-id="<?php echo $data->nim ?>"><p class="spasi-text"><?php echo $content[$i] ?></p></td>
                                <td width="10%" align="center"><?php echo $list_similarity[$i] ?> %</td>
                                <td width="17%" align="justify">   
									<!-- Button trigger modal -->
									<div class="text-center"> 
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $no ?>"><i class="fa fa-search-plus"></i> Detail</button> 
										 
                                        <!-- <a>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-info-circle"></i> Hasil</button>
                                        </a> -->
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
													<p class="spasi-text"><?php echo $content[$i] ?></p>
												</li>
												<li class="list-group-item"><strong><em>N-Gram</em></strong></br>
													<p class="spasi-text"><?php echo $data_ngram[$i] ?></p>
												</li>
												<li class="list-group-item"><strong><em>Rolling Hash</em></strong></br>
													<p class="spasi-text"><?php echo $data_hash[$i] ?></p>
												</li>
												<li class="list-group-item"><strong><em>Window</em></strong></br>
													<p class="spasi-text"><?php echo $data_window[$i] ?></p>
												</li>
												<li class="list-group-item"><strong><em>Fingerprint</em></strong></br>
													<p class="spasi-text"><?php echo $data_fingerprint[$i] ?></p>
												</li>
											</ul>
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
	header("location: ?page=plagiarisme");
}
session_destroy();
?>