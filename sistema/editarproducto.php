<?php 
include "../conexion.php";
if (!empty($_POST)) {
    include "../conexion.php";
$alert ='';

if(empty($_POST['idcate']) || empty($_POST['nombrep']) || empty($_POST['descripcionp']) || empty($_POST['ValorUni']) || empty($_POST['cantipro'])){
    $alert = '<p class="error"> Debes llenar todos los campos!</p>';
}else {
    
    $IDpro = $_POST['idpro'];
    $IDcate = $_POST['idcate'];
    $Nombrep = $_POST['nombrep'];
    $descrip =$_POST['descripcionp'];
    $valor = $_POST['ValorUni'];
    $cantipro = $_POST['cantipro'];
    $foto = $_POST['foto'];
            
            $consultp= mysqli_query($conexion,"UPDATE `tb_producto` SET `IDCATE`='$IDcate',`NOMPRO`='$Nombrep',`DESCRIPRO`='$descrip',`VALORUNIPRO`='$valor',`CANTIPROD`='$cantipro',`FOTOPRO`='$foto' WHERE IDPRO = '$IDpro'");

            if ($consultp) {
                $alert ='<p class="guardar">Producto Actualizado </p>';
       //echo "Usuario registrado" ;
    }else {
        //echo "Usuario no registrado" ;
        $alert ='<p class="error">Prodcuto no Actualizado</p>';
        }
       
    }
    mysqli_close($conexion);
 }

if(empty($_GET['id'])){
    header('location:listarproducto.php');
    mysqli_close($conexion);
}
$idprod = $_GET['id'];
$sqlp= mysqli_query($conexion,"SELECT p.NOMPRO, p.DESCRIPRO, p.VALORUNIPRO, p.CANTIPROD, p.FOTOPRO,p.IDCATE as ID_CATE ,c.NOMCATE FROM tb_producto p INNER JOIN tb_categoria c ON p.IDCATE = c.IDCATE WHERE IDPRO = '$idprod'");
mysqli_close($conexion);
$resultadop = mysqli_num_rows($sqlp);
if ($resultadop == 0) {
    header("location:listarproducto.php");
}else{
    $optionss ='';
    while($data = mysqli_fetch_array($sqlp)) {
        $idpr = $data['IDPRO'];
        $nombrepr = $data['NOMPRO'];
        $descr = $data['DESCRIPRO'];
        $valor = $data['VALORUNIPRO'];
        $canti = $data['CANTIPROD'];
        $fotop= $data['FOTOPRO'];
        $idcat = $data['ID_CATE'];
        $nomcat = $data['NOMCATE'];
        
        if ($idcat == 1) {
            $optionss ='<option value="'.$idcat.'"select>"'.$nomcat.'"</option>';
         } else if ($idcat == 2) {
             $optionss ='<option value="'.$idcat.'"select>"'.$nomcat.'"</option>';
         }

         
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   
    <?php include("includes/Script.php"); ?>
    <title>Actualizar Producto</title>
    
</head>
<body>
<?php include "includes/header.php"; ?>
    <section id="container">

        <div class="form_register">

            <h1>Actualizar Producto</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : '' ; ?></div>

            <form action="editarproducto.php" method="post">
            
               <input type="hidden" name="idpro" placeholder="">

               <!-- SELECT TipoCategoria -->
               <label for="documento">Categoria</label>
               <?php
               include"../conexion.php";
            $cosulcate = mysqli_query($conexion,"Select * from tb_categoria");
            mysqli_close($conexion);
            ?>
            <select name="idcate" id="idcate" >
            
            <?php 
            echo $optionss;
            while($tipocate = mysqli_fetch_array($cosulcate)){
                ?>
            <option value="<?php echo $tipocate["IDCATE"] ;?>"><?php echo $tipocate["NOMCATE"] ;?></option>
                <?php 
                 }
                ?>
            </select>
            <label for="nombre">Nombre Producto</label>
               <input type="text" name="nombrep"  placeholder="Nombre Producto" value="<?php echo $nombrepr ; ?>">

               <label for="direcc">Descripcion</label>
               <input type="text" name="descripcionp"  placeholder="Ingrese descripcion" value="<?php echo $descr ; ?>">

               <label for="vpro">Valor Producto</label>
               <input type="text" name="ValorUni"  placeholder="Ingrese Valor Producto" value="<?php echo $valor ; ?>">

               <label for="catidad">Cantidad Producto</label>
               <input type="text" name="cantipro"  placeholder="Ingrese Cantidad" value="<?php echo $canti ; ?>">
               
               <label for="catidad">Cantidad Producto</label>
               <input type="file" name="foto" id="foto" value="<?php echo $fotop ; ?>">

            
            <input type="submit" value="Actualizar Producto" class="boton">
            </form>
        </div>
    </section>  
     <?php include "includes/footer.php"; ?> 
</body>
</html>