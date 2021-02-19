<?php 
include"../conexion.php";

if (!empty($_POST)) {
    $idusuario = $_POST['eliminarproducto'];

    //$eliminar = mysqli_query($conexion,"DELETE FROM tb_usuario WHERE IDUSU = '$idusuario'");
    $eliminar = mysqli_query($conexion,"UPDATE tb_producto  SET ESTADO = 'Inactivo'  WHERE IDPRO = '$idprod'" );
    include"../conexion.php";
    if ($eliminar) {
        header('location:listarproducto.php');
    }else{
       echo " Producto no eliminado";
    }
  
}

if(empty($_REQUEST['id'])){
    header('location:listar_usuario.php');
}else{
     $idprod = $_REQUEST['id'];
    $consulta = mysqli_query($conexion," SELECT c.NOMCATE, p.NOMPRO, p.DESCRIPRO, p.VALORUNIPRO, p.CANTIPROD, p.FOTOPRO FROM tb_producto p INNER JOIN tb_genero g ON p.IDCATE= c.IDCATE WHERE IDPRO = '$idprod'");
    //include"../conexion.php";
    $resultado = mysqli_num_rows($consulta);

if($resultado > 0){
    while ($data = mysqli_fetch_array($consulta)) {

               
                $nombre= $data['NOMPRO'];
                $nomcate= $data['NOMCATE'];
                $descrip = $data['DESCRIPRO'];
                $valor = $data['VALORUNIPRO'];
                $cantidad = $data['CANTIPROD'];
                $foto = $data['FOTOPRO'];
                
           }
        }else{
            header('location:listarproducto.php');
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
    <title>Eliminar Producto</title>
</head>
<body>
<?php include("includes/header.php"); ?>
    <section id="container">
        <div class="deleteusu">
        <i class="fas fa-user-times fa-7x" style="color:red ; margin-top:10px"></i>
        <h2>¿Quieres eliminar este Producto?</h2>
        
            <p>Nombre:<span><?php echo  $nombre ; ?></span></p>
            <p>Categoria:<span><?php echo  $nomcate ; ?></span></p>
            <p>Descripcion:<span><?php echo  $descrip ; ?></span></p>
            <p>Valor Unitario:<span><?php echo  $valor; ?></span></p>
            <p>Cantidad:<span><?php echo  $cantidad; ?></span></p>
            <p>Foto:<span><?php echo  $foto;  ?></span></p>
            

            <form action="" method="post">
                <input type="hidden" name="eliminarproducto" value="<?php echo $idprod;?>">
                <a href="listar_usuario.php" class="botoncance"><i class="fas fa-times"></i> Cancelar</a>
                <button class="botonok" type="submit"><i class="fas fa-check-double"></i> Aceptar</button>
                
            </form>

        </div>
    </section>  

    <?php include ("includes/footer.php"); ?>  
</body>
</html>