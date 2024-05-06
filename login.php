<?php
// Inicia una sesión
	session_start();

	if(isset($_POST['btn_login'])){

		// captura la informacion del formulario por post
		$user = $_POST['txt_user'];
		// tomamos la contraseña y la encriptamos
		$pass = md5($_POST['txt_pass']);

		//si usuario y contraseña tienen contenido:
		if($user != "" && $pass != ""){
			//se abre el archivo en modo lectura
			$file_users = fopen("DB/usuario.csv", "r");
			//mientras no sea el fin de archivo	
			while(!feof($file_users)){
				//leo el reglon y guardo la variable
				$renglon = fgets($file_users);
				//si renglon tiene contenido
				if($renglon != ""){
					//paso el vector de renglon a la matriz de usuario
					$usuarios[] = explode("|",$renglon);
				}


			}


			foreach ($usuarios as $key => $fila) {
			
				// si el usuario esta dentro de la tabla de usuarios
				if ($user == $fila[1]) {
				
					if ($pass ==rtrim($fila[2])) {
						$_SESSION['id'] = $fila[0];
						header("Location: panel.php");
					}else{
						echo"Contraseña incorrecta";
						echo"<br><a href='index.php'>Volver</a>";
					}
				}
			}

		}else{ //si uno, o los dos, no tienen contenido
			if($user == "")//si no hay contenido en user
				echo "Debe ingresar un nombre de usuario\n";
			if($pass == "")	//si no hay contenido en pass
				echo "Debe ingresar una contraseña";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	 <form action="index.php" method="POST"  class="formulario__login">
                       	<input type="email" name="txt_user" placeholder="Gmail" required>
                    	<input type="password" name="txt_pass" placeholder="Contraseña" required>   
                    	<button name="btn_login" type="submit">Entrar</button>

                    </form>
</body>
</html>