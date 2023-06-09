<?php

$router  = '192.168.189.46';
$url   = 'https://'.$router.':451/rest';
$username = 'api';
$password = '4p1';
$listName = 'wan';

function run($url, $cmd, $content, $username, $password){
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url.$cmd);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
 curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
 $response = curl_exec($ch);
 if (curl_errno($ch)) {
  $response = false;
 }
 curl_close($ch);
 return $response;
}

function lists($array){
 $wanList = array_column($array, "interface");
 if(count($wanList) > 0):
         $response = implode(",",$wanList);
 else:
         $response = false;
 endif;
 return $response;
}

$wan            = '/interface/list/member/print';
$content        = array(
                ".proplist" => array("interface"),
                ".query" => array(
                        "list=".$listName,
                        "disabled=false",
                        "#&"
                        )
                );


$r = run($url, $wan, $content, $username, $password);
print_r($r);
if($r):
 $wanArray = json_decode($r, true);
 print_r($wanArray);

 $l = lists($wanArray);
 if($l):
  echo $l;

  $mon            = '/interface/monitor-traffic';
  $content        = array(
                  "interface" => $l,
                  "once" => "",
                  ".proplist" => array("name","rx-bits-per-second","tx-bits-per-second"),
                  );

  $m = run($url, $mon, $content, $username, $password);
  if($m):
   $mArray = json_decode($m, true);
   print_r($mArray);

   $rx = array_column($mArray, 'rx-bits-per-second');
   $tx = array_column($mArray, 'tx-bits-per-second');

   print_r($rx);
   print_r($tx);

   if(count($rx) > 0):
    $download = array_sum($rx);
   else:
    $download = 0;
   endif;
   if(count($tx) >0):
    $upload = array_sum($tx);
   else:
    $upload = 0;
   endif;
   echo "download: ".$download.PHP_EOL;
   echo "upload: ".$upload.PHP_EOL;

  endif;

 endif;

endif;
