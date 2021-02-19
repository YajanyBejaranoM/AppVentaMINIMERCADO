
<?php 
include "../conexion.php";
if (!empty($_POST)) {

$alert ='';

if(empty($_POST['tipodo']) || empty($_POST['tipogene']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['direccion']) || empty($_POST['tele'])|| empty($_POST['usuario']) || empty($_POST['rol'])){
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
    
     $consul = mysqli_query($conexion," SELECT * FROM tb_usuario WHERE NOMUSU = '$Nomusu' AND IDUSU = '$IDusu'");
     $result = mysqli_fetch_array($consul);

    if($result > 0){
        $alert = '<p class="error"> El usuario ya exite!</p>';
    } else{
        if(empty($_POST['password'])){

            $consult= mysqli_query($conexion,"UPDATE tb_usuario SET `TIPODO`='$TipoDo',`TIPOGENE`='$TipoGe',`NOMBRE`='$Nombre',`APELLIDO`='$Apellido',`DIRECCION`='$Direcc',`TEL`='$Tel',`NOMUSU`='$Nomusu',`IDROL`='$Idrol' WHERE IDUSU = '$IDusu'");
        }else{
            $consult= mysqli_query($conexion,"UPDATE tb_usuario SET `TIPODO`='$TipoDo',`TIPOGENE`='$TipoGe',`NOMBRE`='$Nombre',`APELLIDO`='$Apellido',`DIRECCION`='$Direcc',`TEL`='$Tel',`NOMUSU`='$Nomusu',`PASSUSU`='$Passwo',`IDROL`='$Idrol' WHERE IDUSU = '$IDusu'");
        }
        
            if ($consult) {
                $alert ='<p class="guardar">Usuario Actualizado </p>';
       //echo "Usuario registrado" ;
    }else {
        //echo "Usuario no registrado" ;
        
        $alert ='<p class="error">Usuario no Actualizado</p>';
        }
       
    }
 }
 mysqli_close($conexion);
}

if(!isset($_GET['id'])){
  header('location:listar_usuario.php');
  mysqli_close($conexion);

}
$iduser = $_GET['id'];

$sql= mysqli_query($conexion,"SELECT u.IDUSU,u.NOMBRE,u.APELLIDO,u.DIRECCION,u.NOMUSU,u.TEL,u.IDROL AS ID_ROL,u.TIPODO AS ID_TIPODO,u.TIPOGENE AS ID_TIPOGE,r.NOMROL,d.NOMDOCU,g.NOMGENE FROM tb_usuario u INNER JOIN tb_rol r ON u.IDROL = r.IDROL INNER JOIN tb_tipodo d ON u.TIPODO = d.IDTIPODO INNER JOIN tb_genero g ON u.TIPOGENE = g.IDGENERO WHERE IDUSU = '$iduser'");
mysqli_close($conexion);
$resultado = mysqli_num_rows($sql);
if ($resultado == 0) {
    //header("location:listar_usuario.php");
}else{
    $optionss ='';
    $options ='';
    $option ='';
    while($data = mysqli_fetch_array($sql)) {
        $iduser = $data['IDUSU'];
        $iddocu = $data['ID_TIPODO'];
        $nombred = $data['NOMDOCU'];
        $idgene = $data['ID_TIPOGE'];
        $nombreg = $data['NOMGENE'];
        $nombre1 = $data['NOMBRE'];
        $apellido1= $data['APELLIDO'];
        $direcc1 = $data['DIRECCION'];
        $tel1 = $data['TEL'];
        $nomusu1 = $data['NOMUSU'];
        $idrol = $data['ID_ROL'];
        $rol = $data['NOMROL'];

        if ($iddocu == 1) {
           $options ='<option value="'.$iddocu.'" select>"'.$nombred.'"</option>';
        } else if ($iddocu == 2) {
            $options ='<option value="'.$iddocu.'"select>"'.$nombred.'"</option>';
        } else if ($iddocu == 3) {
            $options ='<option value="'.$iddocu.'"select>"'.$nombred.'"</option>';
        }else if ($iddocu == 4) {
            $options ='<option value="'.$iddocu.'"select>"'.$nombred.'"</option>';
        }
        
        if ($idgene == 1) {
            $optionss ='<option value="'.$idgene.'"select>"'.$nombreg.'"</option>';
         } else if ($idgene == 2) {
             $optionss ='<option value="'.$idgene.'"select>"'.$nombreg.'"</option>';
         }

         if ($idrol == 1) {
            $option ='<option value="'.$idrol.'"select>"'.$rol.'"</option>';
         } else if ($idrol == 2) {
             $option ='<option value="'.$idrol.'"select>"'.$rol.'"</option>';
         }else if ($idrol == 3) {
            $option ='<option value="'.$idrol.'"select>"'.$rol.'"</option>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <?php include("includes/Script.php"); ?>
    <title>Actualizar Usuario</title>
    
</head>
<body>
<?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">

            <h1>Actualizar Usuarios</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : '' ; ?></div>

            <form action="editarusuario.php" method="post">
            
               <input type="hidden" name="idusu" id="idusu" value="">

               <!-- SELECT Tipodocu -->
               <label for="documento">Tipo Documento</label>
               <?php
               include"../conexion.php";
            $cosultipodo = mysqli_query($conexion,"Select * from tb_tipodo");
            mysqli_close($conexion);
            ?>
            <select name="tipodo" id="tipodo"  >
            <?php 
            echo $options;
            while($tipodo = mysqli_fetch_array($cosultipodo)){
                ?>
                <option value="<?php echo $tipodo["IDTIPODO"] ;?>"><?php echo $tipodo["NOMDOCU"] ;?></option>
                <?php 
                 }
                ?>
            </select>
            <!-- SELECT GENERO -->
            <label for="genero">Genero</label>
            <?php 
            include"../conexion.php";
            $tipoge = mysqli_query($conexion,"Select * from tb_genero");
            mysqli_close($conexion);
            //$res_tipodo = mysqli_num_rows($cosultipodo);
            ?>
            <select name="tipogene" id="tipoge"  >
            
            <?php 
            echo $optionss;
            while($tipgen = mysqli_fetch_array($tipoge)){
                ?>
                <option value="<?php echo $tipgen["IDGENERO"] ;?>"><?php echo $tipgen["NOMGENE"] ;?></option>
                <?php 
                 }
                ?>
            </select>

               <label for="nombre">Nombre</label>
               <input type="text" name="nombre" id="nombre"  value="<?php echo @$nombre1 ; ?>">

               <label for="apellido">Apellido</label>
               <input type="text" name="apellido" id="apellido" value="<?php echo  @$apellido1 ; ?>">

               <label for="direccion">Direccion</label>
               <input type="text" name="direccion" id="direccion"  value="<?php echo  @$direcc1 ; ?>">

               <label for="telefono">Telefono</label>
               <input type="tel" name="tele" id="tele" value="<?php echo  @$tel1 ; ?>">
                
               <label for="nombreud">Nomre Usuario</label>
               <input type="text" name="usuario" id="usuario"  value="<?php echo  @$nomusu1 ; ?>">

               <label for="password">Password</label>
               <input type="password" name="password" id="password" >

               <label for="rol">Tipo Rol</label>
            <?php 
           include"../conexion.php";
            $tiporol = mysqli_query($conexion,"Select * from tb_rol");
            mysqli_close($conexion);
            //$res_tipodo = mysqli_num_rows($cosultipodo);
            ?>
            <select name="rol" id="rol" class="ocultarone" >
          
            <?php 
            echo $option;
            while($tiprol = mysqli_fetch_array($tiporol)){
                ?>
                <option value="<?php echo $tiprol["IDROL"] ;?>"><?php echo $tiprol["NOMROL"] ;?></option>
                <?php 
                 }
                ?>
            </select>
            
            <input type="submit" value="Actualizar Registro" class="boton">
            </form>
        </div>
    </section>  
     <?php include "includes/footer.php"; ?> 
</body>
</html>
