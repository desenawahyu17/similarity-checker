<?php
session_start();
ob_start();
require_once('../config/koneksi.php');
require_once('../models/database.php');
require_once('../models/m_preprocessing.php');
require_once('../librarys/sastrawi/vendor/autoload.php');
$connection = new Database($host, $user, $pass, $database);
$preprocessing = new preprocessing($connection);
if(@$_GET['act'] == ''){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preprocessing</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
    <script type="text/javascript" src="../assets/js/style.js"></script>
    <script type="text/javascript" src="../assets/js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
if (isset($_POST['savepreprocessing'])) {

    $flag = 0;

    // AMMBIL DATA TABEL SLANGWORD
    $ambil_slangword= $preprocessing->select_slangword();
    
    //AMBIL DATA TABEL STOPWORD
    $ambil_stopword= $preprocessing->select_stopword();
    $array_stop = array();
    while($data = $ambil_stopword->fetch_object()){
    // foreach($result as $results => $key) {
        $array_stop[] = $data -> stopword;
    }

    // AMBIL DATA document
    $ambil_dokumen= $preprocessing->select_dokumen();

    //Membuat array
    $array_dataawal =array();
    $array_nim =array();
    $array_uploaddate =array();
    $array_filesize =array();
    $array_casefolding =array();
    $array_karakter =array();
    $array_slangword =array();
    $array_stopword =array();
    $array_stemming =array();

    while($data_dokumen = $ambil_dokumen->fetch_object()) {
        array_push($array_dataawal,$data_dokumen->content);
        array_push($array_nim,$data_dokumen->nim);
        array_push($array_uploaddate,$data_dokumen->uploaddate);
        array_push($array_filesize,$data_dokumen->file_size);

        $string ="";
        // CASEFOLDING
        $string_kecil = strtolower($data_dokumen -> content);
        array_push($array_casefolding,$string_kecil);
    
        // MENGHILANGKAN ANGKA DAN TANDA BACA
        $regex = "/[^a-z]+/i";
        $string_noAngkaKarakter = preg_replace($regex, ' ', $string_kecil);
        array_push($array_karakter,$string_noAngkaKarakter);
       
        // KONVERSI SLANGWORD KE KATA ASLINYA
        $string_noSlangword = $string_noAngkaKarakter;
        while($data = $ambil_slangword->fetch_object()){
            $string_noSlangword = str_replace($data -> slangword, $data ->kata_asli, $string_noSlangword);
         }
        array_push($array_slangword,$string_noSlangword);

        // MENGHILANGKAN STOPWORD
        $string = explode(" ", $string_noSlangword);
        $string_noStopword = array();
        foreach($string as $value) {
            if(!in_array($value, $array_stop)) {
                $string_noStopword[] = " ".$value;
            }	
        }
        $string = implode(" ", $string_noStopword);
        array_push($array_stopword,$string);
        
        // STEMMING
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        $string = $stemmer->stem($string);
        array_push($array_stemming,$string);

        try {
            $id= $data_dokumen -> id;
            $nim= $data_dokumen -> nim;
            $uploaddate= $data_dokumen -> uploaddate;
            $file_size= $data_dokumen -> file_size;
            $content= $string;
            $preprocessing->simpan_preprocessing($id, $nim, $uploaddate, $file_size, $content);

            
            if($flag == 0) {
                echo '
                    <script>
                    swal ( "Good Job!" , "Successfully" ,  "success" , {
                        buttons: false,
                        closeOnClickOutside: false,
                        timer: 2000,
                    })
                    .then(function() {
                        window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/?page=dashboard";
                    });
                    </script>
                ';
                $flag++;
            }
        }
        catch(exception $e) {
            echo '<pre>';
            var_dump($string);
            echo '</pre>';
        }
    }

    
    // Set session variables
    $_SESSION["array_dataawal"] =$array_dataawal;
    $_SESSION["array_nim"] =$array_nim;
    $_SESSION["array_uploaddate"] =$array_uploaddate;
    $_SESSION["array_filesize"] =$array_filesize;
    $_SESSION["array_casefolding"] =$array_casefolding;
    $_SESSION["array_karakter"] =$array_karakter;
    $_SESSION["array_slangword"] =$array_slangword;
    $_SESSION["array_stopword"] =$array_stopword;
    $_SESSION["array_stemming"] =$array_stemming;
    echo '
    <script>
        window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/?page=getpreprocessing";
    </script>
    ';

}
?>
</body>
</html>
<?php
} 
?>