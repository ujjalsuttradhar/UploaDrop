<?php
require_once "lib/Dropbox/autoload.php";
use \Dropbox as dbx;

$accessToken="LUe_0AZEYLoAAAAAAAAAAbGkU6kYqcGjt5TH83KwmXRUi75iLainkV5owczpcYMI";

$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");


if (!empty($_FILES)) {
 $tempFile = $_FILES['file']['tmp_name'];
 // using DIRECTORY_SEPARATOR constant is a good practice, it makes your code portable.
 // Adding timestamp with image's name so that files with same name can be uploaded easily.
 $mainFile = time().'-'. $_FILES['file']['name'];
 $f=fopen($tempFile,"rb");
$result = $dbxClient->uploadFile('/'.$mainFile, dbx\WriteMode::add(), $f);
//move_uploaded_file($tempFile, $mainFile);
}

?>