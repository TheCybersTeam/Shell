<?php
session_start();
$secret = "123";

if($_POST['senha'] == $secret){
	$_SESSION['login'] = 1;
}

if($_POST['logout']){
	$_SESSION['login'] = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>The Cybers Shell</title>

<style type="text/css">
body{
	background-color: #090909;
	margin:0; padding:0;
	color:#eee;
}
#container{
	width:98%;
	margin:0 auto;
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
?>
</style>
</head>
<body>
<div id="container">	
<?php 
		if(!$_SESSION['login']){
			login();
		}
		else{
			painel();
		}
		
function painel(){
	echo "
	<form method='post'>
		<input name='logout' type='submit' value='Logout'>
	</form>
	";
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
?>
</div>
</body>
</html>