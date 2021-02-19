<?php include "../conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php include("includes/Script.php"); ?>
    <title>Buscar Prodcuto</title>
</head>
<body>
<?php include("includes/header.php"); ?>
    <section id="container">
<?php

    $busqueda = $_REQUEST['buscar'];
    if(empty($busqueda)){
     header("location:listar_usuario.php");
    
    }
   
?>
        <h1>Buscar Prodcuto</h1>
        <a class="nueboton" href="registrar_producto.php" > Crear Producto</a>
        <!--
        <form action="" method="" class="form_buscar" >
            <input type="text" name="buscar" id="busqueda" placeholder="Buscar Usuario" value="<?php echo $busqueda ;?>">
            <input type="submit" Value="Buscar" class="boton_buscar">
        </form> -->
        
        <table> 
            <tr>
            <th> ID PRODUCTO </th>
            <th> CATEGORIA</th>
            <th> NOMBRE</th>
            <th> DESCRIPCION </th>
            <th> VALOR UNITARIO </th>
            <th> CANTIDAD </th>
            <th> FOTO PRODUCTO </th>
            <th> ACCIONES</th>
        </tr>
        <?php 
        
        //Paginar las Listas

        $catego = '';
        if ($busqueda == 'Lacteos') {
            $catego =" 0R IDCATE LIKE '%1%'";
        }else if($busqueda == 'Canasta Familiar'){
            $catego =" 0R IDCATE LIKE '%2%'";
        }

        $registros = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tb_producto WHERE (NOMPRO LIKE '%$busqueda%' OR DESCRIPRO LIKE '%$busqueda%' '%$catego%') AND ESTADO = 'Existente'");
        $resul_registro = mysqli_fetch_array($registros);

        $total_registro= $resul_registro['total_registro'];

        $por_pagina = 5;

        if (empty($_GET['paginas'])) {
            $paginas = 1;
        }else{
            $paginas = $_GET['paginas'];
        }
         $desde =($paginas-1)* $por_pagina;
         $total_paginas = ceil($total_registro / $por_pagina);
         
        $consulta = mysqli_query($conexion,"SELECT p.IDPRO,p.NOMPRO,p.DESCRIPRO,p.VALORUNIPRO,p.CANTIPROD,p.FOTOPRO,c.NOMCATE FROM tb_producto p 
        INNER JOIN tb_categoria c ON p.IDCATE = c.IDCATE WHERE (p.NOMPRO LIKE '%$busqueda%' OR 
                                                                p.DESCRIPRO LIKE '%$busqueda%' OR 
                                                                c.NOMCATE LIKE '%$busqueda%') AND ESTADO = 'Existente' ORDER BY IDPRO ASC LIMIT '$desde','$por_pagina'");
        
        $resultado = mysqli_num_rows($consulta);

        if($resultado > 0){
            while ($data = mysqli_fetch_array($consulta)) {
         ?>       
                <tr>
            <td><?php echo $data['IDPRO']?></td>
            <td><?php echo $data['NOMPRO']?></td>
            <td><?php echo $data['DESCRIPRO']?></td>
            <td><?php echo $data['VALORUNIPRO']?></td>
            <td><?php echo $data['CANTIPROD']?></td>
            <td><?php echo $data['FOTOPRO']?></td>
            <td><?php echo $data['NOMCATE']?></td>
            
            <td>
                <a class="editar" href="editarproducto.php?id=<?php echo $data['IDPRO']?>"><i class="fas fa-edit"></i> Editar</a>
                    <span>|</span>
                <a class="eliminar" href="eliminarusuario.php?id=<?php echo $data['IDPRO']?>"><i class="far fa-trash-alt"></i> Eliminar</a>

            </td>

        </tr>
         <?php       
            }
        }
        
        
        ?>
        
</table>

<div class="paginarlistas">

<ul>
    <?php
    if($paginas != 1){
?>
    
 <li><a href="?paginas=<?php echo 1;?>">|<</a></li>
 <li><a href="?paginas=<?php echo $paginas-1;?>"><<</a></li>
<?php 
}
 for ($i=1; $i <= $total_paginas ; $i++) { 
    if($i == $paginas){
        echo '<li class="paginasselec">'.$i.'</li>';
    }else{
        echo'<li><a href="?paginas='.$i.'">'.$i.'</a></li>';
    }
    
 }
 if ($paginas !=$total_paginas) {

?>
 <li><a href="?paginas=<?php echo $paginas + 1;?>">>></a></li>
 <li><a href="?paginas=<?php echo $total_paginas;?>">>|</a></li>
<?php } ?>
</ul>
</div>
    </section>  

    <?php include("includes/footer.php"); ?>  
</body>
</html>