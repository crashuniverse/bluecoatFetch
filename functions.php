<?php

function exitScript(){
    echo 'Status: Parameters missing'."\n";
    exit();
}


function fetchWebContent($param){
    //This module works for specific bluecoat POST method
    $host='http://sitereview.bluecoat.com/sitereview.jsp'; //host to submit form
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$host");
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.7) Gecko/20091221 Firefox/3.5.7 (.NET CLR 3.5.30729)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,'url='.$param.'&jscheck=validated');
    $contents=curl_exec($ch);
    if(!$contents)
        echo '<strong>cURL error: </strong>'.curl_error($ch);
    unset($proxyAccess);
    curl_close($ch);
    return $contents;
}


function stripClf($contents){
    //code here to find primary classification
    
	/*$matchFound=preg_match("/<p>.*?<a.*?>.*?<\/a>.*?<a.*?>.*?<\/a>.*?<a href=\"javascript:defwin.*?>(.*?)<\/a>.*?<a.*?>.*?<\/a>.*?/",$contents,$results);
    */
    
    /*$matchFound=preg_match("/<a href=\"javascript:defwin.*?>(.*?)<\/a>/",$contents,$results);
    */
    $finalResults = array();
    $matchFound=preg_match("/<a href=\"javascript:defwin.*?>(.*?)<\/a>(.*?<a href=\"javascript:defwin.*?>(.*?)<\/a>)*/",$contents,$results);
    
    $result1 = $results[1];
    $result2Intermediate = $results[2];
    
    $matchFoundResult2=preg_match("/<a href=\"javascript:defwin.*?>(.*)/",$result2Intermediate,$result2Temp);
    $result2 = $result2Temp[1];
    
    $finalResults[1] = $result1;
    $finalResults[2] = $result2;
    
    if($finalResults){
        return $finalResults;
        
    } else {
        return 0;
    }
}


?>