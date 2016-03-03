<?php
	session_start();
	include 'base.php';
?>
<?php startblock('body-cont')?>
<?php
	if(isset($_SESSION['valid'])) {			
		require_once 'conexao/conexao.php';			
		$query     = "SELECT * FROM usuario";
		$resultado = pg_query($conexao, $query);
	
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<title>Home</title>
</head>

<body>

	Bem-Vindo 
	<?php
		echo $_SESSION['usuario']; 
	?> 
	<a href='logout.php'>Logout</a>

	<?php	
	} else {
		echo "Voce precisa estar logado para visualizar essa pagina<br/><br/>";
		echo "<a href='login.php'>Login</a>";
	}
	?>
</body>
</html>
<?php endblock('body-cont')?>