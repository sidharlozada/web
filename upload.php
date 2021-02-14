<?php

// Upload script for CKEditor.
// Use at your own risk, no warranty provided. Be careful about who is able to access this file
// The upload folder shouldn't be able to upload any kind of script, just in case.
// If you're not sure, hire a professional that takes care of adjusting the server configuration as well as this script for you.
// (I am not such professional)
// Step 1: change the true for whatever condition you use in your environment to verify that the user
// is logged in and is allowed to use the script
/*if ( true ) {
    echo("You're not allowed to upload files");
    die(0);
}*/
// Step 2: Put here the full absolute path of the folder where you want to save the files:
// You must set the proper permissions on that folder (I think that it's 644, but don't trust me on this one)
// ALWAYS put the final slash (/)
//$basePath = "/home/user/example.com/files/";
$basePath = "img_not/";
// Step 3: Put here the Url that should be used for the upload folder (it the URL to access the folder that you have set in $basePath
// you can use a relative url "/images/", or a path including the host "http://example.com/images/"
// ALWAYS put the final slash (/)
$baseUrl = "img_not/";
// Done. Now test it!
// No need to modify anything below this line
//----------------------------------------------------
// ------------------------
// Input parameters: optional means that you can ignore it, and required means that you
// must use it to provide the data back to CKEditor.
// ------------------------
// Optional: instance name (might be used to adjust the server folders for example)
$CKEditor = $_GET['CKEditor'] ;
// Required: Function number as indicated by CKEditor.
$funcNum = $_GET['CKEditorFuncNum'] ;
// Optional: To provide localized messages
$langCode = $_GET['langCode'] ;
// ------------------------
// Data processing
// ------------------------
// The returned url of the uploaded file
$url = '' ;
// Optional message to show to the user (file renamed, invalid file, not authenticated...)
$message = '';
// in CKEditor the file is sent as 'upload'
if (isset($_FILES['upload'])) {
    // Be careful about all the data that it's sent!!!
    // Check that the user is authenticated, that the file isn't too big,
    // that it matches the kind of allowed resources...

      $name=substr(md5(uniqid(rand(),true)),0,32);//genera una cadena unica de treinta y dos caracteres
      $hoy = date("j-n-Y-H-i-s");

      $temporary = explode(".", $_FILES["upload"]["name"]);
      $file_extension = end($temporary);

      $filename = $basePath . $name .".". $file_extension;
          if (file_exists($filename)) {
           $name=substr(md5($hoy),0,32);
           $filename = $basePath . $name .".". $file_extension;
       }

   // $name = $_FILES['upload']['name'];
    // It doesn't care if the file already exists, it's simply overwritten.
    move_uploaded_file($_FILES["upload"]["tmp_name"], $basePath . $name .".". $file_extension);
    // Build the url that should be used for this file   
    
    $url = $baseUrl . $name .".". $file_extension ;
    // Usually you don't need any message when everything is OK.
//     $message = 'new file uploaded';   



include("lib/resize.class.php");
include("lib/funciones.php");
 
    // *** 1) Initialize / load image
    $resizeObj = new resize($filename);
 
    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
    $resizeObj->resizeImage(420, 280, 'exact');
 
    // *** 3) Save image
    $resizeObj->saveImage("img_not/thumbs/".$name .".". $file_extension, 75);

    //$destino = "img_not/thumbs/".$name .".webp";
    //$source = "img_not/thumbs/".$name .".". $file_extension;
   // convertImageToWebP($source, $destino, $quality=80);

}
else
{
    $message = 'No file has been sent';
}
// ------------------------
// Write output
// ------------------------
// We are in an iframe, so we must talk to the object in window.parent
echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
?>