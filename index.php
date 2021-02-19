<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
    header('location: sistema/');
}else{

if (!empty($_POST)) {
    if (empty(['usuario']) || empty(['clave'])) 
    {
       $alert ="ingrese su usuario y su clave";
    }else{
        require_once 'conexion.php';
        $user= mysqli_real_escape_string($conexion,$_POST['usuario']);
        $passw=mysqli_real_escape_string($conexion,$_POST['clave']);

       

        $query = mysqli_query($conexion,"SELECT * FROM tb_usuario WHERE NOMUSU = '$user' AND PASSUSU = '$passw'");
        mysqli_close($conexion);
        $result = mysqli_num_rows($query);
        
        if ($result > 0) {

            $data = mysqli_fetch_array($query);
           
            $_SESSION['active'] = true;
            $_SESSION['Iduser'] = $data['IDUSU'];
            $_SESSION['tipodo'] = $data['TIPODO'];
            $_SESSION['tipoge'] = $data['TIPOGENE'];
            $_SESSION['nombre'] = $data['NOMBRE'];
            $_SESSION['apellido'] = $data['APELLIDO'];
            $_SESSION['direcc'] = $data['DIRECCION'];
            $_SESSION['tel'] = $data['TEL'];
            $_SESSION['nombusu'] = $data['NOMUSU'];
            $_SESSION['contra'] = $data['PASSUSU'];
            $_SESSION['rol'] = $data['IDROL'];
            header('location: sistema/');
        }else{
            $alert ="El usuario y la contraseña son incorrecto";
            session_destroy();
        }
    } 
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" type ="text/css" href="css/style.css">
    <title>Login | Sistema de Venta</title>
</head>
<body>
    <section id="container">
    
    <form action="" method="post">
    
    <h3> Iniciar Sesion</h3>
    <img src="img/login.jpg" alt="Login">

    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="clave" placeholder="Contraseña">
    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <input type="submit" value="Ingresar">
    
    </form>
    
    </section>
    
</body>
</html>