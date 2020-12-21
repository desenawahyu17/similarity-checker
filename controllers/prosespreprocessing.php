<?php
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
    <script type="text/javascript" src="assets/js/style.js"></script>
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
    while($data_dokumen = $ambil_dokumen->fetch_object()) {
        $string ="";
        // CASEFOLDING
        $string_kecil = strtolower($data_dokumen -> content);
        
        // MENGHILANGKAN URL
        $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@";
        $string_noUrl = preg_replace($regex, ' ', $string_kecil);
        
        // MENGHILANGKAN ANGKA DAN TANDA BACA
        $regex = "/[^a-z]+/i";
        $string_noAngkaKarakter = preg_replace($regex, ' ', $string_noUrl);
       
        // KONVERSI SLANGWORD KE KATA ASLINYA
        while($data = $ambil_slangword->fetch_object()){
            $string_noSlangword = str_replace($data -> slangword, $data ->kata_asli, $string_noAngkaKarakter);
         }

        // MENGHILANGKAN STOPWORD
        $string = explode(" ", $string_noSlangword);
        $string_noStopword = array();
        foreach($string as $value) {
            if(!in_array($value, $array_stop)) {
                $string_noStopword[] = " ".$value;
            }	
        }
        $string = implode(" ", $string_noStopword);
        
        // STEMMING
        $stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
        $stemmer  = $stemmerFactory->createStemmer();
        $string = $stemmer->stem($string);
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
}
?>
</body>
</html>
<?php
} 
?>