<?php 
    session_start();

    // include'funciones.php';

    $file_links = fopen("DB/links.csv", "r");

  

    $file_users = fopen("DB/usuario.csv", "r");

  

    $msg="";

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

            $msg = "usuario inexistente";

            foreach ($usuarios as $key => $fila) {
                // si el usuario esta dentro de la tabla de usuarios
                if ($user == $fila[1]) {
                
                    if ($pass ==rtrim($fila[2])) {
                        $_SESSION['id'] = $fila[0];
                        header("Location: panel.php");
                    }else{
                        $msg = "Contraseña incorrecta";
                        break;
                    }
                }
            }

            

        }else{ //si uno, o los dos, no tienen contenido
            if($user == "")//si no hay contenido en user
                echo "Debe ingresar un nombre de usuario\n";
            if($pass == "") //si no hay contenido en pass
                echo "Debe ingresar una contraseña";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>welcome</title>

        

	 <link rel="stylesheet" href="assets/css/estilos.css">
	 <link rel="stylesheet"  href="assets/css/estilos2.css">
</head>
<body>
    <div class="titulos">
	<H1>App-links</H1>
	<H2>Bienvenidos a tu pagina favorita para guardar links.</H2>

    </div>


	
        <main>

            <div class="contenedor__todo">
                <div class="caja__trasera">
                    <div class="caja__trasera-login">
                        <h3>¿Ya tienes una cuenta?</h3>
                        <p>Inicia sesión para entrar en la página</p>
                     <a href="login.php" class="url">iniciar</a>
                    </div>
                    <div class="caja__trasera-register">
                        <h3>¿Aún no tienes una cuenta?</h3>
                        <p>Regístrate para que puedas iniciar sesión</p>
                      <a href="register.php" >registrarse</a>

                    </div>
                </div>




                <!--Formulario de Login y registro-->
 
            </div>

        </main>
  

</body>
</html>