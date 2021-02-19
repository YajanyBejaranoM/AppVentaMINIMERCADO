<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="sistema/css/styles.css">
    <title>Registro Usuario</title>
    <?php include "conexion.php";?>
</head>
<body>

    <section id="container">

        <div class="form_register">

            <h1>Registrate</h1>
            <hr>
            <div class="alert"></div>

            <form>
               <label for="nombre">Nombre Usuario</label>
               <input type="text" name="nombre" id="nombre" placeholder="Ingrese Usuario">

              
               <label for="pass">Password</label>
               <input type="password" name="passw" placeholder="Ingrese Contraseña">

                
               <label for="rol">Rol</label>
               <?php
            $roles = mysqli_query($conexion,"Select * from tb_rol");
            ?>
            <select name="rol" id="rol">
            <option value="0">Seleccione Rol</option>
            <?php 
            while($rol = mysqli_fetch_array($roles)){
                ?>
                <option value="<?php echo $rol["IDROL"] ;?>"><?php echo $rol["NOMROL"] ;?></option>
                <?php 
                 }
                ?>
            </select>
            
            </form>
        </div>
    </section>  
    
</body>
</html>