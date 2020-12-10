<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Preprocessing</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
    <script type="text/javascript" src="../assets/js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
// var_dump($_POST); die();
if (isset($_POST['savepreprocessing'])) {
    include('../config/koneksi.php');
    include('../librarys/sastrawi/vendor/autoload.php');
    // require_once __DIR__.'../librarys/sastrawi/vendor/autoload.php';

    $flag = 0;

    // AMMBIL DATA TABEL SLANGWORD
    $sql = "SELECT * FROM slangword";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $array_slang = array();
    foreach($result as $results => $key) {
        $array_slang[$key[1]] = $key[2];
    }

    //AMBIL DATA TABEL STOPWORD
    $sql = "SELECT * FROM stopword";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    $array_stop = array();
    foreach($result as $results => $key) {
        $array_stop[] = $key[1];
    }

    // AMBIL DATA document
    $sql = "SELECT * FROM document";
    $statement = $db->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $results => $key) {
        // CASEFOLDING
        $string_kecil = strtolower($key['content']);
        
        // MENGHILANGKAN URL
        $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@";
        $string_noUrl = preg_replace($regex, ' ', $string_kecil);
        
        // MENGHILANGKAN ANGKA DAN TANDA BACA
        $regex = "/[^a-z]+/i";
        $string_noAngkaKarakter = preg_replace($regex, ' ', $string_noUrl);
        
        // KONVERSI SLANGWORD KE KATA ASLINYA
        $string_noSlangword = str_replace(array_keys($array_slang), $array_slang, $string_noAngkaKarakter);

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
            /*      START INSERT STATEMENT        */
            $sql = "INSERT INTO preprocessing (id, nim, uploaddate, file_size, content) VALUE (:id, :nim, :uploaddate, :file_size, :content)";
            $statement = $db->prepare($sql);
            $statement->bindParam(":id", $key['id']);
            $statement->bindParam(":nim", $key['nim']);
            $statement->bindParam(":uploaddate", $key['uploaddate']);
            $statement->bindParam(":file_size", $key['file_size']);
            $statement->bindParam(":content", $key['content']);
            $statement->execute();
            /*       END INSERT STATEMENT        */
            
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
        
        
        // // TOKENISASI
        // $tokenisasi = explode(" ", $string);
        // foreach($tokenisasi as $key => $value) {
        //     $string_dataBersih['isi_text'][] = $value;
        // }
        
        // $string_dataBersih['isi_text'] = array_unique($string_dataBersih['isi_text']);  
    }
}
?>
</body>
</html>