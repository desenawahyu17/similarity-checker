
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan File</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
    <script type="text/javascript" src="../assets/js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
    
// var_dump($_POST); die();
if (isset($_POST['savefile'])) {
    include('../librarys/PdfToText-master/PdfToText.phpclass');
    include('../config/koneksi.php');
    // SET DEFAULT TIMEZONE
    date_default_timezone_set('Asia/Jakarta');
    try{
        $similarity = 70;
        $allowed_ext	= array('pdf');
        $file_name		= $_FILES['prosesscan']['name'];
        $tmp            = explode('.', $file_name);
        $file_ext       = end($tmp);
        $file_size		= $_FILES['prosesscan']['size'];
        $file_tmp		= $_FILES['prosesscan']['tmp_name'];
        if(in_array($file_ext, $allowed_ext) === true){
            if($file_size != 0 && $file_size < 1048576){
                try {
                    $tanggal = date('Y-m-d H:i:s');
                    // LOAD CLASS PdfToText dari Package
                    $pdf = new PdfToText();

                    // LOAD file pdf (abstract)
                    $pdf -> Load( $file_tmp);

                   // menghilangkan kata sebelum kata 'ABSTRAKSI'
                   $array = explode("ABSTRAKSI", $pdf -> Text, 2);
                   if(count($array) > 1) {
                       $text = $array[1];
                   }
                   else {
                       // menghilangkan kata sebelum kata 'ABSTRAK'
                       $array = explode("ABSTRAK", $pdf -> Text, 2);
                       if(count($array) > 1) {
                           $text = $array[1];
                       }
                       else {
                           // menghilangkan kata sebelum kata 'Abstrak'
                           $array = explode("Abstrak", $pdf -> Text, 2);
                           $text = $array[1];
                       }
                   }

                    $hasil_preprocessing = fungsi_preprocessing($text);
                    $query = "INSERT INTO plagiarisme(title,scandate,file_size,similarity,content,content_clean,ngram,hash,window,fingerprint) VALUES('$file_name', '$tanggal','$file_size', '$similarity', '$text', '$hasil_preprocessing')";
                    $simpan = mysqli_query($koneksi,$query); 
                    if($simpan){
                        echo '
                            <script>
                                swal ( "Good Job!" , "Uploaded Successfully" ,  "success" , {
                                    buttons: false,
                                    closeOnClickOutside: false,
                                    timer: 2000,
                                })
                                .then(function() {
                                    window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/?page=plagiarisme";
                                });
                            </script>
                        ';
                    }else{
                        echo '
                            <script>
                                swal ( "Try Again!" , "Upload Failed" ,  "error" , {
                                buttons: false,
                                closeOnClickOutside: false,
                                timer: 2000,
                                })
                                .then(function() {
                                    window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/?page=plagiarisme";
                                });
                            </script>
                        ';
                    }
                }
                catch(exception $e) {

                }
            }
            else{
                echo ' 
                    <script>
                        swal ( "Try Again!" , "File Size More Than 1 MB" ,  "warning" , {
                        buttons: false,
                        closeOnClickOutside: false,
                        timer: 2000,
                        })
                        .then(function() {
                            window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/?page=plagiarisme";
                        });
                    </script>
                ';  
                }
        }else{
            echo '
            <script>
                swal ( "Try Again!" , "File extensions are not allowed" ,  "error" , {
                buttons: false,
                closeOnClickOutside: false,
                timer: 2000,
                })
                .then(function() {
                    window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/?page=plagiarisme";
                });
            </script>
        ';
        }
    }
    catch(exception $e){ 
        echo $e;
    }
}

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
    $jumlah_index_window = count($hash) / $w;
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

// Fungsi Untuk Preprocessing
function fungsi_preprocessing($text) {
    include('../config/koneksi.php');
    include('../models/database.php');
    include('../models/m_plagiarisme.php');
    $connection = new Database($host, $user, $pass, $database);
    $plagiarisme = new plagiarisme($connection);
    // AMMBIL DATA TABEL SLANGWORD
    $ambil_slangword= $plagiarisme->select_slangword();
        
    //AMBIL DATA TABEL STOPWORD
    $ambil_stopword= $plagiarisme->select_stopword();
    $array_stop = array();
    while($data = $ambil_stopword->fetch_object()){
    // foreach($result as $results => $key) {
        $array_stop[] = $data -> stopword;
    }

    $string ="";
    // CASEFOLDING
    $string_kecil = strtolower($text);
    
    // MENGHILANGKAN ANGKA DAN TANDA BACA
    $regex = "/[^a-z]+/i";
    $string_noAngkaKarakter = preg_replace($regex, ' ', $string_kecil);

    // KONVERSI SLANGWORD KE KATA ASLINYA
    $string_noSlangword = $string_noAngkaKarakter;
    while($data = $ambil_slangword->fetch_object()){
        $string_noSlangword = str_replace($data -> slangword, $data ->kata_asli, $string_noSlangword);
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

    //Menghilangkan Spasi
    $string = str_replace(" ","",$string);
    return $string;

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

}
?>
</body>
</html>