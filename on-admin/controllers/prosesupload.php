
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
if (isset($_POST['savefile'])) {
    include('../config/koneksi.php');
    include('../librarys/PdfToText-master/PdfToText.phpclass');
    // SET DEFAULT TIMEZONE
    date_default_timezone_set('Asia/Jakarta');
    $allowed_ext	= array('pdf');
    $flag = 0;
    for($i=0;$i<count($_FILES['prosesupload']['name']);$i++){
        try{
            $file_name		= $_FILES['prosesupload']['name'][$i];
            // echo $file_name .'<br>';
            $tmp            = explode('.', $file_name);
            $file_ext       = end($tmp);
            $file_size		= $_FILES['prosesupload']['size'][$i];
            $file_tmp		= $_FILES['prosesupload']['tmp_name'][$i]; 
            if(in_array($file_ext, $allowed_ext) === true){
                if($file_size != 0 && $file_size < 1048576){
                    try {
                        $location = '../files/'.$file_name;
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
                        $text = mysqli_real_escape_string($koneksi, $text);
                        $query = "INSERT IGNORE document(nim,uploaddate,file_size,location,content) VALUES('$file_name', '$tanggal', '$file_size', '$location', '$text')";
                        $simpan = mysqli_query($koneksi,$query);
                        if($simpan){
                            move_uploaded_file($file_tmp, $location);
                            $flag = 1;
                        } else{
                            $flag = 0;
                            break;
                        }
                    }
                    catch(exception $e) {
    
                    }
                }
                else{
                    $flag = 2;
                    break;
                }
            }else{
                $flag = 3;
                break;
            }
        }
        catch(exception $e){ 
            echo $e;
        }
    }

    if($flag == 0) {
        echo '
            <script>
                swal ( "Try Again!" , "Upload Failed" ,  "error" , {
                buttons: false,
                closeOnClickOutside: false,
                timer: 2000,
                })
                .then(function() {
                    window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/on-admin/?page=uploaddokumen";
                });
            </script>
        ';
    }
    elseif ($flag == 1) {
        echo '
            <script>
                swal ( "Good Job!" , "Uploaded Successfully" ,  "success" , {
                    buttons: false,
                    closeOnClickOutside: false,
                    timer: 2000,
                })
                .then(function() {
                    window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/on-admin/?page=uploaddokumen";
                });
            </script>
        ';
    }
    elseif ($flag == 2) {
        echo ' 
            <script>
                swal ( "Try Again!" , "File Size More Than 1 MB" ,  "warning" , {
                buttons: false,
                closeOnClickOutside: false,
                timer: 2000,
                })
                .then(function() {
                    window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/on-admin/?page=uploaddokumen";
                });
            </script>
        ';  
    }
    elseif($flag == 3) {
        echo '
        <script>
            swal ( "Try Again!" , "File extensions are not allowed" ,  "error" , {
            buttons: false,
            closeOnClickOutside: false,
            timer: 2000,
            })
            .then(function() {
                window.location = "http://localhost/Tugas%20Kuliah/Semester%207%20(Skripsweet)/Similarity_Checker/on-admin/?page=uploaddokumen";
            });
        </script>
        ';
    }
}
?>
</body>
</html>