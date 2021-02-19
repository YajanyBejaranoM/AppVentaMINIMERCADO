<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php include("includes/Script.php"); ?>
    <title>Lista de Clientes</title>
</head>
<body>
<?php include("includes/header.php"); ?>
    <section id="container">
        <h1><i class="fas fa-clipboard-list"></i> Lista de Clientes</h1>
       
        <a class="nueboton" href="registro_usuario.php" ><i class="fas fa-user-plus"></i> Crear usuario</a>
        <form action="buscarusuario.php" method="get" class="form_buscar" >
            <input type="text" name="busqueda" placeholder="Buscar Cliente">
            <button type="submit" class="boton_buscar"><i class="fas fa-search"></i></button>
        </form>
        <table> 
            <tr>
            <th> ID </th>
            <th>TIPO DOCUMENTO</th>
            <th>TIPO GENERO</th>
            <th> NOMBRE </th>
            <th> APELLIDO </th>
            <th> DIRECCION </th>
            <th> TELEFONO </th>
            <th> NOMBRE USUARIO</th>
            <th> ROL </th>
            <th> ACCIONES</th>
        </tr>
        <?php 
        include "../conexion.php";
        $registros = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tb_usuario WHERE ESTADO = 'Activo'");
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

        $consulta = mysqli_query($conexion," SELECT u.IDUSU,u.NOMBRE,u.APELLIDO,u.DIRECCION,u.NOMUSU,u.TEL,r.NOMROL,d.NOMDOCU,g.NOMGENE FROM tb_usuario u INNER JOIN tb_tipodo d ON u.TIPODO = d.IDTIPODO 
        INNER JOIN tb_genero g ON u.TIPOGENE= g.IDGENERO INNER JOIN tb_rol r ON u.IDROL = r.IDROL WHERE r.NOMROL ='Cliente' ORDER BY IDUSU ASC LIMIT $desde,$por_pagina");
        
        $resultado = mysqli_num_rows($consulta);

        if($resultado > 0){
            while ($data = mysqli_fetch_array($consulta)) {
         ?>       
                <tr>
            <td><?php echo $data['IDUSU']?></td>
            <td><?php echo $data['NOMDOCU']?></td>
            <td><?php echo $data['NOMGENE']?></td>
            <td><?php echo $data['NOMBRE']?></td>
            <td><?php echo $data['APELLIDO']?></td>
            <td><?php echo $data['DIRECCION']?></td>
            <td><?php echo $data['TEL']?></td>
            <td><?php echo $data['NOMUSU']?></td>
            <td><?php echo $data['NOMROL']?></td>
            
            <td>
                <a class="editar" href="editarusuario.php?id=<?php echo $data['IDUSU']?>"><i class="fas fa-edit"></i>Editar</a>
                <span>|</span>
                <?php if($data['NOMROL'] != "Administrador"){ ?>
                <a class="eliminar" href="eliminarusuario.php?id=<?php echo $data['IDUSU']?>"><i class="far fa-trash-alt"></i> Eliminar</a>
                <?php } ?>
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