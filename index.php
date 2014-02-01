<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


# Include the Dropbox SDK libraries
require_once "lib/Dropbox/autoload.php";
use Dropbox as dbx;

#access token is generated at the developer's end
$accessToken="LUe_0AZEYLoAAAAAAAAAAbGkU6kYqcGjt5TH83KwmXRUi75iLainkV5owczpcYMI";

$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");

#starting of browsing from root of the app  
$path='/';


#File Browser
function getfile($path,$dbxClient){
   $fileOrfolder = $dbxClient->getMetadataWithChildren($path);
     
     if(sizeof($fileOrfolder["contents"]>0))
     {
        $f=0;
	    foreach($fileOrfolder["contents"] as $content)
	     {
		    if($content["is_dir"]!=1)
		        echo '<li>'.$content["path"].'</li>';
	        else
	        {  
	           $f=1;
	           getfile($content["path"], $dbxClient);
	        }
	     }  
	     if($f==0)
	      return; 
     }
	
} // end of File Browser




?>

<html>
<head>
 <title>uUploader</title>
 <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
 <link rel="stylesheet" href="dropzone.css" type="text/css" media="screen" />

</head>
<body>
   <header>
	   <div id="header">
	       uUploader
	       <sub>An unique upload script based on Dropbox</sub>
	   </div>
   </header>
   
   <div id="content">
     <div id="title">Files and Folders</div>
	<ul>
	<?php
	#Display File List of Depth One
	getfile($path, $dbxClient);
	?>
	</ul>
	</div>
<form action="processupload.php" class="dropzone"></form>
   
   <a href="" id="button">Finish Uploading</a> 
   <div id="clear"></div>
   
     <footer>
    <div id="copyright">
     copyright@ 2014 uUploader (developped by <strong>Ujjal Suttra Dhar</strong>)
    
        
    </div>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="dropzone.js"></script>
     
    
 
</footer>


</body>
</html>