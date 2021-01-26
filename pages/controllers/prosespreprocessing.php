<?php
session_start();
ob_start();
require_once('../config/koneksi.php');
require_once('../models/database.php');
require_once('../models/m_preprocessing.php');
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
//Fungsi N-Gram
function Ngrams($word,$n=3){
    $len=strlen($word);
    $ngram=array();

    for($i=0;$i+$n<=$len;$i++){
        $string="";
        for($j=0;$j<$n;$j++){ 
            $string.=$word[$j+$i]; 
        }
        $ngram[$i]=$string;
    }
        return $ngram;
}

//Fungsi Rolling Hash
function r_hash($ngram,$n=3){
    $b = 7;
    $k = $n;

    $char = array();
    // Mengubah ngram menjadi satuan kata (char)
    for($i=0; $i<count($ngram); $i++) {
        $char[$i] = str_split($ngram[$i]);

        // Mengubah char menjadi ASCII code
        for($j=0; $j<count($char[$i]); $j++) {
            $char[$i][$j] = ord($char[$i][$j]);
        }
    }

    $hasil_hash = array();
    // perulangan sebanyak array dari ngram
    for($i=0; $i<count($ngram); $i++) {
        $hasil = 0;

        for($j=0; $j<count($char[$i]); $j++) {
            // Penjabaran tabel 4.5
            $hasil =  $hasil + $char[$i][$j] * pow($b, ($k-($j+1)));
            // $hasil += $char[$i][$j] * pow($b, ($k-($j+1)));
        }
        $hasil_hash[$i] = $hasil;
    }

    return $hasil_hash;
}

//Fungsi Window
function wgram($hash,$w){
    $jumlah_index_window = floor(count($hash) / $w);
    $index_window = array();
    $nomor = 0;

    for($i = 0 ; $i < $jumlah_index_window ; $i++) {
        $window = array();
        for($j = 1 ; $j <= $w ; $j++) {
            $window[$j] = $hash[$nomor];
            $nomor++;
        }
        $index_window[$i] = $window;
    }

    return $index_window;
}

//Fungsi Fingerprint
function finger($window, $w){
    $fingerprint = array();
    
    for($i = 0 ; $i < count($window) ; $i++) {
        
        $min = $window[$i][1];
        for($j = 2 ; $j <= $w ; $j++) {
            if($min > $window[$i][$j]) {
                $min = $window[$i][$j];
            }
        }
        $fingerprint[$i] = $min;
    }

    return $fingerprint;
}

if (isset($_POST['savepreprocessing'])) {

    $flag = 0;

    // AMMBIL DATA TABEL SLANGWORD
    $ambil_slangword= $preprocessing->select_slangword();
    $array_slang = array();
    while($data = $ambil_slangword->fetch_object()){
        $array_slang[] = $data -> slangword;
        $array_kataAsli[] = $data -> kata_asli;
    }
    
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
    $array_content =array();
    $array_casefolding =array();
    $array_karakter =array();
    $array_slangword =array();
    $array_stopword =array();
    $array_spasi =array();

    while($data_dokumen = $ambil_dokumen->fetch_object()) {
        array_push($array_dataawal,$data_dokumen->content);
        array_push($array_nim,$data_dokumen->nim);
        array_push($array_uploaddate,$data_dokumen->uploaddate);
        array_push($array_filesize,$data_dokumen->file_size);
        array_push($array_content,$data_dokumen->content);
        
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
        for($i=0 ; $i < count($array_slang) ; $i++){
            $string_noSlangword = str_replace($array_slang[$i], $array_kataAsli[$i], $string_noSlangword);
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

        //Menghilangkan Spasi
        $string = str_replace(" ","",$string);
        array_push($array_spasi,$string);

        $n=3;
        //Proses N-Gram
        $ngram = Ngrams($string,$n);

        //Proses Rolling hash
        $hash = r_hash($ngram,$n);

        //Proses Window
        $w=3;
        $window = wgram($hash,$w);

        //Proses Fingerprint
        $fingerprint = finger($window,$w);

        $ngram = implode("|",$ngram);

        $hash = implode("|",$hash);

        $temp = array();
        for($i = 0 ; $i < count($window); $i++) {
            $temp[$i] = implode("|",$window[$i]);
        }
        $window = implode("|",$temp);

        $fingerprint = implode("|",$fingerprint);

        try {
            $id= $data_dokumen -> id;
            $nim= $data_dokumen -> nim;
            $uploaddate= $data_dokumen -> uploaddate;
            $file_size= $data_dokumen -> file_size;
            $content= $string;
            $preprocessing->simpan_preprocessing($id, $nim, $uploaddate, $file_size, $content, $ngram, $hash, $window, $fingerprint);

            if($flag == 0) {
                echo '
                    <script>
                    swal ( "Good Job!" , "Successfully" ,  "success" , {
                        buttons: false,
                        closeOnClickOutside: false,
                        timer: 2000,
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
    $_SESSION["array_content"] =$array_content;
    $_SESSION["array_casefolding"] =$array_casefolding;
    $_SESSION["array_karakter"] =$array_karakter;
    $_SESSION["array_slangword"] =$array_slangword;
    $_SESSION["array_stopword"] =$array_stopword;
    $_SESSION["array_spasi"] =$array_spasi;
    echo '
    <script>
        window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/pages/?page=getpreprocessing";
    </script>
    ';

}

?>
</body>
</html>

<?php
} 
?>