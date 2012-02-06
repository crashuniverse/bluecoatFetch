<?php
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

//module to collect information from various different parts
include 'functions.php';
$url=$_GET['url'];
$rawContents=fetchWebContent($url);
$clf=stripClf($rawContents);
$clfDisplay1=$clf[1];
$clfDisplay2=$clf[2];

if($clf){
    echo $clfDisplay2;
    } else {
    echo '<div class="impItems">None</div>';
    }

?>