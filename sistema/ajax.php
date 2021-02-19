<?php

include "../conexion.php";

if(!empty($_POST)){

    if($_POST['action'] == 'infoProducto')
    {
        $producto_id = $_POST['prodcuto'];

        $query = mysqli_query($conexion , "SELECT `IDCATE`, `NOMPRO`, `DESCRIPRO`, `VALORUNIPRO`, `CANTIPROD`, `FOTOPRO` FROM `tb_producto` WHERE `IDPRO` = '$producto_id' AND ESTADO = 'Existente'");
    
        $resul = mysqli_num_rows($query);
        if($resul > 0){
            $data = mysqli_fetch_assoc($query);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo 'error';
        exit;
    }

    if($_POST['action'] == 'searchCliente')
    {
        if(!empty($_POST['cliente'])){
            $Nit = $_POST['cliente'];

            $queryc = mysqli_query($conexion , "SELECT * FROM tb_usuario WHERE IDUSU LIKE '$Nit' AND ESTADO = 'Activo'");
        
            $result = mysqli_num_rows($queryc);
            $data = '';
            if($result > 0){
                $datas = mysqli_fetch_assoc($queryc);
            }else{
                $datas = 0;
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }
        
    }
    exit;
}
?>