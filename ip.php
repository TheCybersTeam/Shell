<?php
/*Greetz To Imam,AlfabetoVirtual,MuhmadEmad,General
 
              => Coder : BALA SNIPER
              => Usage : php reverse.php [target.com/Host Ip]
*/
 
echo "
                      +=============================+
                      |   [Reverse YouGetSignal]    |
                      |   [ My First  Sript    ]    |
                      |    [Result in Rzlt.txt ]    |
                      +=============================+
 
              Usage => php $_SERVER[PHP_SELF] [target.com]
                                   OR
              php $_SERVER[PHP_SELF] [target.com] [PROXY:PORT]
 
";
 
if(!$argv[1]) die("\nPut Target \n");
    $target = $argv[1];
 
    $proxy = $argv[2];
if(empty($proxy)) {
 
   $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "http://domains.yougetsignal.com/domains.php");
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress={$target}");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 $postResult = curl_exec($ch);
 curl_close($ch);
 
 if(preg_match_all("#\"domainCount\":\"(.*?)\"#",$postResult,$domain)) {
    $nigga = $domain[1];
}
foreach ($nigga as $domains) { echo "\n   [+] Total Websites: $domains\n";    }
 echo "\n   [+]Host IP: ".gethostbyname($target)."\n";  
   if(preg_match_all("#\[([^\]]*)\]#",$postResult,$fuck)){
 $zebi = $fuck[1];
}
foreach ($zebi as $fucck) {  
 
if(preg_match_all("#\"(.*?)\", \"\"#",$fucck,$matches)) {  
    $klawi = $matches[1];
foreach ($klawi as $fuckaa)  {  
 
  $save = fopen('Rzlt.txt','ab');
  fwrite($save,"http://".$fuckaa."/\r\n");
  fclose($save);
} }} echo "\n [!] Result in Rzlt.txt\n";
} else {
 
    $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "http://domains.yougetsignal.com/domains.php");
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress={$target}");
 curl_setopt($ch, CURLOPT_PROXY, $proxy);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 $postResult = curl_exec($ch);
 curl_close($ch);
 
 if(preg_match_all("#\"domainCount\":\"(.*?)\"#",$postResult,$domain)) {
$nigga = $domain[1];
}
foreach ($nigga as $domains) { echo "\n   [+] Total Websites: $domains\n";    }
 echo "\n   [+]Host IP: ".gethostbyname($target)."\n";
 echo "\n   [+]Proxy: ".$proxy."\n";
if(preg_match_all("#\[([^\]]*)\]#",$postResult,$fuck)){
 $zebi = $fuck[1];
}
foreach ($zebi as $fucck) {  
 
 if(preg_match_all("#\"(.*?)\", \"\"#",$fucck,$matches)) {  
    $klawi = $matches[1];
foreach ($klawi as $fuckaa)  {  
 
  $save = fopen('Rzlt.txt','ab');
  fwrite($save,"http://".$fuckaa."/\r\n");
  fclose($save);
} }}
 
echo "\n [!] Result in Rzlt.txt\n"; }
?>