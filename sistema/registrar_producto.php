<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <?php include ("includes/Script.php"); ?>
    <title>Registro Usuario</title>
    <?php include "../conexion.php";?>
</head>
<body>
<?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">

            <h1><i class="fas fa-save"></i> Registro Producto</h1>
            <hr>
            <div class="alert"></div>

            <form action="registroproducto.php" method="post" enctype="multipart/form-data">

            <label for="idpro">Identificacion Producto</label>
            <input type="text" name="idpro"  placeholder="Ingrese Id Producto">
            
            <label for="producto">Categoria Producto</label>
               <?php
            $categoria = mysqli_query($conexion,"Select * from tb_categoria");
            ?>
            <select name="idcate" id="cate">
            <option value="0">Categoria</option>
            <?php 
            while($catego = mysqli_fetch_array($categoria)){
                ?>
                <option value="<?php echo $catego["IDCATE"] ;?>"><?php echo $catego["NOMCATE"] ;?></option>
                <?php 
                 }
                ?>
            </select>

               <label for="nombre">Nombre Producto</label>
               <input type="text" name="nombrep"  placeholder="Nombre Producto">

               <label for="direcc">Descripcion</label>
               <input type="text" name="descripcionp"  placeholder="Ingrese descripcion">

               <label for="vpro">Valor Producto</label>
               <input type="text" name="ValorUni"  placeholder="Ingrese Valor Producto">

               <label for="catidad">Cantidad Producto</label>
               <input type="text" name="cantipro"  placeholder="Ingrese Cantidad">
              
               <div class="photo">
	            <label for="foto">Foto</label>
                   <div class="prevPhoto">
                    <span class="delPhoto notBlock">X</span>
                   <label for="foto"></label>
                   </div>
                  <div class="upimg">
                  <input type="file" name="foto" id="foto">
                    </div>
                 <div id="form_alert"></div>
</div>
               
               <button type="submit" class="boton"><i class="fas fa-save"></i> Registrar Producto</button>
           
            </form>
        </div>
    </section>  
     <?php include "includes/footer.php"; ?> 
</body>
</html>