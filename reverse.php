<?php
/*

 You_get_signal simple reverse domain check.
 this script use domain.yougetsignal to reverse uris.

 If you make much requests your ip maybe blocked to reverse for a while.
 But if issue occurs you can use a proxy

 Small proxy list:
 http://pastebin.com/p51hacUv

 ~$ php you_get_signal.php

 By n4sss
 http://Janissaries.org


*/

 set_time_limit(0);
 error_reporting(E_ALL);

 Class youGetSignal{

     public $host;
     public $log;

      function __construct($host, $log){
          $this->host = $host;
          $this->log = $log;
      }

     function __save_content($file, $content){
         $fp = fopen($file, "a+");
         fwrite($fp, $content."\r\n");
         fclose($fp);
     }

     function __connect(){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, "http://domains.yougetsignal.com/domains.php?remoteAddress={$this->host}");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
         $json = curl_exec($ch);
         $data = json_decode($json);
        if(preg_match("/Fail/", $data->{'status'})){
            printf("[-] Daily reverse IP check limit reached friend, set a proxy!\n");
            exit(0);
        }else{
         $count = count($data->{'domainArray'});
         $uriArray = array();
         for($i=0;$i<$count;$i++){
             $uri = $data->{'domainArray'}[$i][0];
             if(preg_match("/www./", $uri)) $uri = str_replace("www.", "", $uri);
             $uri = 'http://'.$uri;
             if(!in_array($uri, $uriArray)){
                 array_push($uriArray, $uri);
             }
         }
         $uriCount = count($uriArray);
         foreach($uriArray as $parsedUri){
             $this->__save_content($this->log, $parsedUri);
         }
         printf("[+] Ok!\nWrited %d uris to %s From -> %s\n\n", $uriCount, $this->log, $this->host);
         }
     }
        

     function __proxyProb($proxyAddr){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, "http://domains.yougetsignal.com/domains.php?remoteAddress={$this->host}");
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
         curl_setopt($ch, CURLOPT_PROXY, $proxyAddr);
         $json = curl_exec($ch);
         $data = json_decode($json);
         if(!$data){
             printf("This proxy don't work!\n Use other proxy friend!\n");
             exit(0);
         }else{
         $count = count($data->{'domainArray'});
         $uriArray = array();
         for($i=0;$i<$count;$i++){
             $uri = $data->{'domainArray'}[$i][0];
             if(preg_match("/www./", $uri)) $uri = str_replace("www.", "", $uri);
             $uri = 'http://'.$uri;
             if(!in_array($uri, $uriArray)){
                 array_push($uriArray, $uri);
             }
         }
         $uriCount = count($uriArray);
         foreach($uriArray as $parsedUri){
             $this->__save_content($this->log, $parsedUri);
         }
         printf("[+] Ok!\nWrited %d uris to %s From -> %s\n\n", $uriCount, $this->log, $this->host);
         }
         
     }


}
printf("+--=--=--=--=--=--=--=--=--=--=--=--=--=+\n");
printf("You_get_signal Reverse Domain Checker\nBy N4sss\n");
printf("+--=--=--=--=--=--=--=--=--=-=---=--=--=+\n");
printf("Def a site to reverse friend: ");
$host = trim(fgets(STDIN));
if(preg_match("/http:\/\//", $host)) $host = str_replace("http://", "", $host);
printf("\nDef a text to write the uris: ");
$log = trim(fgets(STDIN));
printf("\nUse a proxy to query? (y/n): ");
$opt = trim(fgets(STDIN));
if($opt == "y"){
    printf("Ok, Def a proxy(ip:port): ");
    $proxy = trim(fgets(STDIN));
    printf("[] Addr to reverse: %s\n[] Log: %s\n[] ProxyAddr: %s\n\n", $host, $log, $proxy);
    printf("[+] Wait the request...\n");
    $reverse = new youGetSignal($host, $log);
    $reverse->__proxyProb($proxy);
}else{
    printf("[] Addr to reverse: %s\n[] Log: %s\n\n", $host, $log);
    printf("[+] Wait the request...\n");
    $reverse = new youGetSignal($host, $log);
    $reverse->__connect();
}
printf("Finished;\nBy N4sss\n");
printf("http://Janissaries.org/\n");
