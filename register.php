<?php 

	session_start();

	if(isset($_POST['btn']))
	{

		$user = $_POST['txt_user'];
		$pass = md5($_POST['txt_pass']);

		//si usuario y contraseña tienen contenido:
		if($user != "" && $pass != ""){
			//se abre el archivo en modo lectura
			$file_users = fopen("DB/usuario.csv", "r");
			//mientras no sea el fin de archivo	
			$usuarios=array();
			while(!feof($file_users)){
				//leo el reglon y guardo la variable
				$renglon = fgets($file_users);
				//si renglon tiene contenido
				if($renglon != ""){
					//paso el vector de renglon a la matriz de usuario
					$usuarios[] = explode("|",$renglon);
				}
			}
			if(count($usuarios)>1){
				foreach ($usuarios as $key => $fila) {
				if ($user == $fila[1]) {
					echo("el usuario ya existe");
					header("Location: index.php");
					exit();
					}
				}
				$new_id = $usuarios[count($usuarios)-1][0]+1; 	
			}else
				$new_id = 1000;	
			}
				//se abre el archivo en modo escritura acumulativo
				$file_users = fopen("DB/usuario.csv", "a");
				//se escribe en el archivo los datos del usuario
				fwrite($file_users,"$new_id|$user|$pass|||||".PHP_EOL);
				echo("usuario creado exitosamente");
				header("Location: index.php");
			}
		// }else{ //si uno, o los dos, no tienen contenido
		// 	if($pass == "")	//si no hay contenido en pass
		// 		echo "Debe ingresar una contraseña";
		// 	if($user == "")//si no hay contenido en user
		// 		echo "Debe ingresar un nombre de usuario\n";
		// }

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Document</title>
 </head>
 <body>
 	 <form action="register.php" method="POST" class="formulario__register">
                            <div id="msg2"></div>
                        	<input type="email" name="txt_user" placeholder="Gmail" required>
                        	<input type="password" name="txt_pass" placeholder="Contraseña" required>
                        	<button name="btn" type="submit">Regístrarse</button>

                        </form>
 	
 </body>
 </html>