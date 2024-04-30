<!-- <form method="post" enctype="multipart/form-data">
    <input type="file" name="pdfFile">
    <button type="submit">Upload</button>
</form> -->

<?php
$file_pointer = "PDFs/1714334012_w12321233_new.pdf"; 
  
// Use unlink() function to delete a file 
if (!unlink($file_pointer)) { 
    echo ("$file_pointer cannot be deleted due to an error"); 
} 
else { 
    echo ("$file_pointer has been deleted"); 
} 

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdfFile"])) {
//     $targetDir = "PDFs/"; 
//     $targetFile = $targetDir .time().'_'. basename($_FILES["pdfFile"]["name"]);
//     $uploadOk = 1;
//     $pdfFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

//     // Check if the file is a PDF
//     if($pdfFileType != "pdf") {
//         echo "Only PDF files are allowed.";
//         $uploadOk = 0;
//     }

//     // Check if file already exists
//     if (file_exists($targetFile)) {
//         echo "File already exists.";
//         $uploadOk = 0;
//     }

//     // Check file size (optional)
//     if ($_FILES["pdfFile"]["size"] > 15000000) {
//         echo "File is too large.- ".$_FILES["pdfFile"]["size"];
//         $uploadOk = 0;
//     }

//     // Upload file
//     if ($uploadOk == 0) {
//         echo "Sorry, your file was not uploaded.";
//     } else {
//         if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
//             echo "The file ". htmlspecialchars( time().'_'.basename( $_FILES["pdfFile"]["name"])). " has been uploaded.";
//         } else {
//             echo "Sorry, there was an error uploading your file.";
//         }
//     }
// } else {
//     echo "No file uploaded.";
// }
// ?>
