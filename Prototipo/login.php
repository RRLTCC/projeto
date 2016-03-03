<?php 
	session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
		  <link href="css/estilo.css" rel="stylesheet">
	</head>
<body>

<?php
	require_once 'conexao/conexao.php';

	$usuario = $_POST ['usuario'];
	$senha = $_POST ['senha'];

	if (isset($usuario) and isset($senha)) {
	
	$query     = "SELECT * FROM usuario WHERE usuario = '$usuario' AND senha = '$senha'";
	$resultado = pg_query ( $conexao, $query ) or die ( "erro ao selecionar" );
	$row       = pg_fetch_assoc($resultado);
	
	if ((pg_num_rows($resultado) <= 0)) {
		echo "<script language='javascript' type='text/javascript'>alert('Usuario e/ou senha incorretos');
     				window.location.href='login.php';</script>";
		die ();
	} else {
		if(is_array($row) && !empty($row)) {
			$validuser = $row['usuario'];
		    $_SESSION['valid']     = $validuser;
		    $_SESSION['usuario']   = $row['usuario'];
		    $_SESSION['idUsuario'] = $row['idUsuario'];
		}
		if(isset($_SESSION['valid'])) {
			header ( 'Location: index.php' );
		}
	}
} 
?>
	<div class="container">
		<form class="form-login" method="post">
	        
	        <h2 id="login-heading">Login</h2>
		        <div id="login-holder">		        
			        <label for="usuario" class="sr-only">Email address</label>
			        <input type="email" name="usuario" id="login-usuario" class="form-control" placeholder="Usuario" required autofocus>
			       
			        <label for="inputPassword" class="sr-only">Password</label>
			        <input type="password" name="senha" id="login-senha" class="form-control" placeholder="Senha" required>
		
			        <div id="login-btnEntrar"> 
			        <button class="btn btn-primary btn-block" type="submit">Entrar</button> 
			        </div>
			        <a id="esqSenha" href="#"><p>Esqueceu sua senha?<p/></a>
	      		</div>
	      		
	      </form>
	</div>

</body>    
</html>
