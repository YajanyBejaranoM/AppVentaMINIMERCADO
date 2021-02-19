<?php
include "../conexion.php";
if (!empty($_POST)) {

$alert ='';

if(empty($_POST['idusu']) || empty($_POST['tipodo']) || empty($_POST['tipogene']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion']) || empty($_POST['tele'])|| empty($_POST['usuario']) || empty($_POST['password'])|| empty($_POST['rol'])){
    $alert = '<p class="error"> Debes llenar todos los campos!</p>';
}else {
    
    $IDusu = $_POST['idusu'];
    $TipoDo = $_POST['tipodo'];
    $TipoGe = $_POST['tipogene'];
    $Nombre = $_POST['nombre'];
    $Apellido =$_POST['apellido'];
    $Direcc = $_POST['direccion'];
    $Tel = $_POST['tele'];
    $Nomusu = $_POST['usuario'];
    $Passwo= $_POST['password'];
    $Idrol = $_POST['rol'];
    
     $consul = mysqli_query($conexion,"SELECT * FROM tb_usuario WHERE NOMUSU = '$Nomusu'");
     $result = mysqli_fetch_array($consul);

    if($result > 0){
        $alert = '<p class="error"> El usuario ya exite!</p>';
    } else{
        $insertar = mysqli_query($conexion,"INSERT INTO `tb_usuario`(`IDUSU`, `TIPODO`, `TIPOGENE`, `NOMBRE`, `APELLIDO`, `DIRECCION`, `TEL`, `NOMUSU`, `PASSUSU`, `IDROL`) VALUES ( '$IDusu','$TipoDo','$TipoGe','$Nombre','$Apellido','$Direcc','$Tel',' $Nomusu','$Passwo','$Idrol')");
            if (empty($insertar)) {
        $alert='<p class="error">Usuario no registrado</p>';
       //echo "Usuario registrado" ;
    }else {
        //echo "Usuario no registrado" ;
        $alert='<p class="guardar">Usuario registrado </p>';
        }
    }
 }
 header("location:listar_usuario.php");
mysqli_close($conexion);

}
?>