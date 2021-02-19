<?php 

include "../conexion.php";
$alert ='';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <?php include ("includes/Script.php"); ?>
    <title>Registro Usuario</title>
    
</head>
<body>
<?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">

            <h1><i class="fas fa-save "></i> Registro Usuarios</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : '' ; ?></div>

            <form action="registrarusuario2.php" method="post">
            <label for="nombre">Identificacion</label>
               <input type="text" name="idusu" placeholder="">
               <!-- SELECT Tipodocu -->
               <label for="documento">Tipo Documento</label>
               <?php
            $cosultipodo = mysqli_query($conexion,"Select * from tb_tipodo");
            mysqli_close($conexion);
            ?>
            <select name="tipodo" id="tipodo">
            <option value="0">Seleccione Documento</option>
            <?php 
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
            <select name="tipogene" id="tipoge">
            <option value="0">Seleccione Genero</option>
            <?php 
            while($tipgen = mysqli_fetch_array($tipoge)){
                ?>
                <option value="<?php echo $tipgen["IDGENERO"] ;?>"><?php echo $tipgen["NOMGENE"] ;?></option>
                <?php 
                 }
                ?>
            </select>

               <label for="nombre">Nombre</label>
               <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">

               <label for="apellido">Apellido</label>
               <input type="text" name="apellido" id="apellido" placeholder="Apellidos Completo">

               <label for="direccion">Direccion</label>
               <input type="text" name="direccion" id="direccion" placeholder="Ingrese Direccion">

               <label for="telefono">Telefono</label>
               <input type="tel" name="tele" id="tele" placeholder="Ingrese Telefono">
                
               <label for="nombre">Nomre Usuario</label>
               <input type="text" name="usuario" id="usuario" placeholder="Ingrese nombre Usuario">

               <label for="nombre">Password</label>
               <input type="password" name="password" id="password" placeholder="Ingrese Password">

               <label for="rol">Tipo Rol</label>
            <?php 
            include"../conexion.php";
            $tiporol = mysqli_query($conexion,"Select * from tb_rol");
            mysqli_close($conexion);
            //$res_tipodo = mysqli_num_rows($cosultipodo);
            ?>
            <select name="rol" id="rol">
            <option value="0">Seleccione Rol</option>
            <?php 
            while($tiprol = mysqli_fetch_array($tiporol)){
                ?>
                <option value="<?php echo $tiprol["IDROL"] ;?>"><?php echo $tiprol["NOMROL"] ;?></option>
                <?php 
                 }
                ?>
            </select>
            <button type="submit" class="boton"><i class="fas fa-save"></i> Registrar Usuario</button>

            </form>
        </div>
    </section>  
     <?php include "includes/footer.php"; ?> 
</body>
</html>
