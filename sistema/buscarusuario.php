<?php include "../conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php include("includes/Script.php"); ?>
    <title>Buscar Usuario</title>
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
        <h1>Buscar Usuario</h1>
        <a class="nueboton" href="registro_usuario.php" > Crear usuario</a>
        <!--
        <form action="" method="" class="form_buscar" >
            <input type="text" name="buscar" id="busqueda" placeholder="Buscar Usuario" value="<?php echo $busqueda ;?>">
            <input type="submit" Value="Buscar" class="boton_buscar">
        </form> -->
        
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
        

        //Paginar las Listas

        $roles = '';
        if ($busqueda == 'Administrador') {
            $roles =" 0R IDROL LIKE '%1%'";
        }else if($busqueda == 'Empleado'){
            $roles =" 0R IDROL LIKE '%2%'";
        }else if($busqueda == 'Cliente'){
            $roles =" 0R IDROL LIKE '%3%'";
        }

        $registros = mysqli_query($conexion,"SELECT COUNT(*) as total_registro FROM tb_usuario WHERE (NOMBRE LIKE '%$busqueda%' OR APELLIDO LIKE '%$busqueda%' OR DIRECCION LIKE '%$busqueda%' OR NOMUSU LIKE '%$busqueda%' '%$roles%') AND ESTADO = 'Activo'");
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
        INNER JOIN tb_genero g ON u.TIPOGENE= g.IDGENERO INNER JOIN tb_rol r ON u.IDROL = r.IDROL WHERE (u.NOMBRE LIKE '%$busqueda%' OR 
                                                                                                         u.APELLIDO LIKE '%$busqueda%' OR 
                                                                                                         u.DIRECCION LIKE '%$busqueda%' OR
                                                                                                         u.NOMUSU LIKE '%$busqueda%' OR 
                                                                                                         r.NOMROL LIKE '%$busqueda%') AND ESTADO = 'Activo' ORDER BY IDUSU ASC LIMIT $desde,$por_pagina");
        
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
                <a class="editar" href="editarusuario.php?id=<?php echo $data['IDUSU']?>"><i class="fas fa-edit"></i> Editar</a>
                
                <?php if($data['NOMROL'] != "Administrador"){ ?>
                    <span>|</span>
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