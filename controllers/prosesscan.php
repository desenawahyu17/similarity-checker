
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload File</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.min.css">
    <script type="text/javascript" src="../assets/js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
// var_dump($_POST); die();
if (isset($_POST['savefile'])) {

    include('../config/koneksi.php');
    include('../librarys/PdfToText-master/PdfToText.phpclass');
    // SET DEFAULT TIMEZONE
    date_default_timezone_set('Asia/Jakarta');
    try{
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
                    $array = explode("ABSTRAKSI ", $pdf -> Text, 2);
                    if(count($array) > 1) {
                        $text = $array[1];
                    }
                    else {
                        // menghilangkan kata sebelum kata 'ABSTRAK'
                        $array = explode("ABSTRAK ", $pdf -> Text, 2);
                        $text = $array[1];
                    }

                    $query = "INSERT INTO plagiarisme(title,scandate,file_size,similarity,content) VALUES('$file_name', '$tanggal','$file_size', '$similarity', '$text')";
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
?>
</body>
</html>