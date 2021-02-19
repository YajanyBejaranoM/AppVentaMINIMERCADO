<?php 
include"../conexion.php";

if (!empty($_POST)) {
    $idusuario = $_POST['eliminarusuario'];

    //$eliminar = mysqli_query($conexion,"DELETE FROM tb_usuario WHERE IDUSU = '$idusuario'");
    $eliminar = mysqli_query($conexion,"UPDATE tb_usuario  SET ESTADO = 'Inactivo'  WHERE IDUSU = '$idusuario'" );
    include"../conexion.php";
    if ($eliminar) {
        header('location:listar_usuario.php');
    }else{
       echo " Usuario no eliminado";
    }
  
}

if(empty($_REQUEST['id'])){
    header('location:listar_usuario.php');
}else{
     
    

    $idusuario = $_REQUEST['id'];
    $consulta = mysqli_query($conexion," SELECT u.NOMBRE,u.APELLIDO,u.DIRECCION,u.NOMUSU,u.TEL,r.NOMROL,d.NOMDOCU,g.NOMGENE FROM tb_usuario u INNER JOIN tb_tipodo d ON u.TIPODO = d.IDTIPODO 
    INNER JOIN tb_genero g ON u.TIPOGENE= g.IDGENERO INNER JOIN tb_rol r ON u.IDROL = r.IDROL WHERE u.IDUSU = '$idusuario'");
    include"../conexion.php";
    $resultado = mysqli_num_rows($consulta);

if($resultado > 0){
    while ($data = mysqli_fetch_array($consulta)) {

                $nomdoc= $data['NOMDOCU'];
                $nomgen= $data['NOMGENE'];
                $nombre= $data['NOMBRE'];
                $apellido = $data['APELLIDO'];
                $direcc = $data['DIRECCION'];
                $tel = $data['TEL'];
                $nomusu = $data['NOMUSU'];
                $nomrol = $data['NOMROL'];
           }
        }else{
            header('location:listar_usuario.php');
        }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <?php include("includes/Script.php"); ?>
    <title>Eliminar Usuario</title>
</head>
<body>
<?php include("includes/header.php"); ?>
    <section id="container">
        <div class="deleteusu">
        <i class="fas fa-user-times fa-7x" style="color:red ; margin-top:10px"></i>
        <h2>¿Quieres eliminar este usuario?</h2>

            <p>Nombre:<span><?php echo  $nombre ; ?></span></p>
            <p>Apellido:<span><?php echo  $apellido ; ?></span></p>
            <p>Genero:<span><?php echo  $nomgen ; ?></span></p>
            <p>TipoDocumento:<span><?php echo  $nomdoc ; ?></span></p>
            <p>Direccion:<span><?php echo  $direcc; ?></span></p>
            <p>Telefono:<span><?php echo  $tel; ?></span></p>
            <p>Usuario:<span><?php echo  $nomusu;  ?></span></p>
            <p>Rol:<span><?php echo  $nomrol;  ?></span></p>

            <form action="" method="post">
                <input type="hidden" name="eliminarusuario" value="<?php echo $idusuario;?>">
                <a href="listar_usuario.php" class="botoncance"><i class="fas fa-times"></i> Cancelar</a>
                <button class="botonok" type="submit"><i class="fas fa-check-double"></i> Aceptar</button>
                
            </form>

        </div>
    </section>  

    <?php include ("includes/footer.php"); ?>  
</body>
</html>