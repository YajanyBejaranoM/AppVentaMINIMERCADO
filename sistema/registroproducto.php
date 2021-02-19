<?php
include "../conexion.php";

if (!empty($_POST)) {

$alert ='';

if(empty($_POST['idpro']) || empty($_POST['idcate']) || empty($_POST['nombrep']) || empty($_POST['descripcionp']) || empty($_POST['ValorUni']) || empty($_POST['cantipro'])){
    $alert = '<p class="error"> Debes llenar todos los campos!</p>';
}else {
    
    $IDpro = $_POST['idpro'];
    $IDcate = $_POST['idcate'];
    $Nombrep = $_POST['nombrep'];
    $descrip =$_POST['descripcionp'];
    $valor = $_POST['ValorUni'];
    $cantipro = $_POST['cantipro'];
    //$foto = $_POST['foto'];

    $foto = $_FILES['foto'];
    $nombre_foto = $foto['name'];
    $type       = $foto['type'];
    $url_temp =   $foto['tmp_name'];

    $imagenProducto = 'img_producto.png';

    if($nombre_foto != ''){
      $directorio ='img/imagenes/';
      $img_nombre ='img_'.md5(date('d-m-Y H:m:s' ));
      $imgProducto = $img_nombre.'jpg';
      $src = $directorio.$imgProducto;
    }
     $insertar = mysqli_query($conexion," INSERT INTO `tb_producto`(`IDPRO`, `IDCATE`, `NOMPRO`, `DESCRIPRO`, `VALORUNIPRO`, `CANTIPROD`,`FOTOPRO`) VALUES ('$IDpro','$IDcate','$Nombrep','$descrip','$valor','$cantipro','$imgProducto')");
        
     if ($insertar) {
       if($nombre_foto != ''){
         move_uploaded_file($url_temp,$src);
       }
        $alert='<p class="error">Producto no Registrado</p>';
       //echo "Usuario registrado" ;
    }else {
        //echo "Usuario no registrado" ;
        $alert='<p class="guardar">Producto Registrado </p>';
        }
    }
    //header("location:listar_usuario.php");
  }
 
 
?>