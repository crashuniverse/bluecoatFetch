<?php
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<html>
<head>
<title>Results - Bluecoat bulk url website review system</title>
<meta charset="UTF-8">
<meta name="description" content="Bluecoat bulk url website review" />
<meta name="keywords" content="bluecoat blue coat sitereview site review bluecoat website rating system webpage review system" />
<meta content="Priya Ranjan Singh" name="Author"/>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="XMLHttpRequest.js"></script>
<script type="text/javascript">
function processClassifA(url,resultCount){
    var url;
    var resultCount;
    var newReq=new XMLHttpRequest();
    newReq.open("GET","fetch-classification-1.php?url="+url,true);
    document.write('<td><div id="classifA'+resultCount+'"><img alt="loading" src="ajax-loader.gif" /></div></td>');
    newReq.onreadystatechange=function(){
        if(newReq.readyState!=4)
            return;
        var serverResponse=newReq.responseText;
        var content=document.getElementById('classif1');
        
        //document.getElementById('classif'+resultCount).innerHTML='<a href="http://sitereview.bluecoat.com/index.jsp?port=%3Clocalport%3E&host=%3Clocalserver%3E&url='+url+'" target="_blank">'+serverResponse+'</a>';
        document.getElementById('classifA'+resultCount).innerHTML=serverResponse;
    }
    newReq.send(null);
}

function processClassifB(url,resultCount){
    var url;
    var resultCount;
    var newReq=new XMLHttpRequest();
    newReq.open("GET","fetch-classification-2.php?url="+url,true);
    document.write('<td><div id="classifB'+resultCount+'"><img alt="loading" src="ajax-loader.gif" /></div></td>');
    //document.write('<td><div id="classif'+resultCount+'"><img alt="loading" src="ajax-loader.gif" /></div></td>');
    newReq.onreadystatechange=function(){
        if(newReq.readyState!=4)
            return;
        var serverResponse=newReq.responseText;
        var content=document.getElementById('classif1');
        
        document.getElementById('classifB'+resultCount).innerHTML=serverResponse;
    }
    newReq.send(null);
}
</script>
</head>
<body>
<?php
$urlGroup=$_POST['urlGroup'];
$urlArray=preg_split('/\r\n/',$urlGroup);

    echo '<table>';
    echo '<tr>';
    echo '<td width="250"><strong>URL</strong></td>';
    echo '<td width="230"><strong>Bluecoat classification 1</strong></td>';
    echo '<td width="230"><strong>Bluecoat classification 2</strong></td>';
    echo '</tr>';

$filteredArray = array_filter($urlArray);
$urlCount = count($filteredArray);    

$resultCount=1;
foreach($filteredArray as $url){
    if($url){
        urlProcess($url,$resultCount);
        $resultCount++;
    }
}

function urlProcess($url,$resultCount){
    echo '<tr>';
    echo '<td>'.$url.'</td>';
    //ajax request here
    echo '<script>onload=processClassifA(\''.$url.'\','.$resultCount.');</script>';
    echo '<script>onload=processClassifB(\''.$url.'\','.$resultCount.');</script>';
    echo '</tr>';
}

    echo '</table>';

function recordSession($count){
	//print $count;
	//insert timestamp, urlcount at auto generated id in table queries 
	//Time now
	$timenow = date('Y-m-d H:m:s');

	$query = "insert into queries values ('', '$timenow', '$count')";
	mysql_query($query);
	
	unset($query);
}
?>
<script type="text/javascript"> 
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2317725-1']);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
</body>
</html>
<?php

require_once 'dbconfig.php';
recordSession($urlCount);

?>