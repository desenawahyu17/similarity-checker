<?php
session_start();
include "models/m_plagiarisme.php";
include "config/koneksi.php";
$plagiarisme = new plagiarisme($connection);

//Mengambil fingerprint dataset
$fingerprint_array= $plagiarisme->select_preprocessing();
foreach ($fingerprint_array as $fingerprint) {
    $hasil_finger = explode("|", $fingerprint['fingerprint']);
    $list_fingerprint = array();
    for($i = 0 ; $i < count($hasil_finger); $i++) {
        array_push($list_fingerprint,$hasil_finger[$i]);  
	}
}

//Mengambil fingerprint data tes
$hasil_sessionfinger = explode("|", $_SESSION["hasil_fingerprint"]);
$list_fingerprint1 = array();
foreach ($hasil_sessionfinger as $i=>$fingerprint1) {
	array_push($list_fingerprint1,$fingerprint1);
}

//Membentuk array irisan
$x_irisan_y = array();
$jumlah_x_n_y = 0;

//Membentuk array union
$x_union_y = array();
$jumlah_x_u_y = 0;

//Mencari Irisan dan Union
for($i = 0; $i < count($list_fingerprint1); $i++){
	for($j = 0; $j < count($list_fingerprint); $j++){
		if($list_fingerprint1[$i] == $list_fingerprint[$j]){
			array_push($x_irisan_y,$list_fingerprint1[$i]);
		}
		array_push($x_union_y,$list_fingerprint[$j]);
	}
	array_push($x_union_y,$list_fingerprint1[$i]);
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

$query = "SELECT max(id) as max FROM plagiarisme ORDER BY id DESC LIMIT 0, 1";
$sql = mysqli_query($koneksi,$query);
$max_id= mysqli_fetch_assoc($sql);
$query = "UPDATE plagiarisme SET similarity = '$jaccard' Where id = '$max_id[max]'";
mysqli_query($koneksi,$query);


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
			nnn
		</div>
	</div>
</main>
<?php
} else {
	header("location: ?page=plagiarisme");
}
?>