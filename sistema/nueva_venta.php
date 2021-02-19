
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <?php include "includes/Script.php"; ?>
        <title>Nueva Venta</title>
    </head>
    <body>
    <?php include("includes/header.php"); ?>
    <section id="container">

    <div class="titulo_pagina">
            <h1><i class="fas fa-shopping-cart"></i> Nueva Venta</h1>
    </div>
    <div class="datos_cliente">
              <div class="action_cliente">
                <h4> Datos del Cliente</h4>
                <a href="" class="nueboton btn_new_cliente" ><i class="fas fa-plus"></i> Nuevo Cliente</a>
              </div>
   

    <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
    <input type="hidden" name="action" value="aadCliente">
    <input type="hidden" name="idcliente" id="idcliente" value="" required>
       <div class="wd30">
       <label>Nit</label>
       <input type="text" name="cliente" placeholder="">
       </div>
       <div class="wd30">
       <label>Nombre</label>
       <input type="text" name="nom_cliente" id="nom_cliente" disabled required>
       </div>
       <div class="wd30">
       <label>Telefono</label>
       <input type="tel" name="tel_cliente" id="tel_cliente" disabled required >
       </div>
       <div class="wd100">
       <label>Direccion</label>
       <input type="text" name="dir_cliente" id="dir_cliente" disabled required>
       </div>
       <div id="div_registro_cliente" class="w100">
       <button type="submit" class="boton"><i class="fas fa-save"></i> Guardar nuevo Cliente</button>
       </div>
       </form>
       </div>
       <div class="datos_venta">
       <h4> Datos del Cliente</h4>
              <div class="datos">
                  <div class="wd50">
                   <label> Vendedor </label>
                   <p></p>
                  </div>
                    <div class="wd50">
                      <label> Acciones </label>
                      <div id="acciones_venta">
                      <a href="" class="botonok textcenter" id="btn_anular_venta"><i class="fas fa-ban"></i> Anular</a>
                      <a href="" class="botonok textcenter" id="btn_facturar_venta"><i class="far fa-edit"></i> Procesar</a>
                     </div>
                 </div>
             </div>
        </div>
        <table class="tbl_venta">
        <thead>
        
        <tr>
        <th width ="100px"> Codigo</th>
        <th>Descripcion</th>
        <th>Existencia</th>
        <th width="100px"> Cantidad</th>
        <th class="textright"> Precio</th>
        <th class="textright"> Precio Total</th>
        <th> Accion</th>
        </tr>
        <tr>
        <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
        <td id="txt_descripcion"></td>
        <td id="txt_existencia"></td>
        <td id=""><input type="text" name="cantida" id="cantida" value="0" min="1" disabled></td>
        <td id="txt_precio" class="textright">0.00</td>
        <td id="txt_precio_total" class="textright">0.00</td>
        <td ><a href="" id="add_product_venta" class="link_add"><i class="fas fa-plus"></i> Agregar</a></td>
        </tr>
        <tr>
        <th>Codigo</th>
        <th colspan="2">Descripcion</th>
        <th>Cantidad</th>
        <th class="textright"> Precio</th>
        <th class="textright">Precio Total</th>
        <th> Accion</th>
        </tr>    
        </thead>
        <tbody>
        <tr>
        <td>1</td>
        <td colspan="2">Mouse</td>
        <td class="textcenter">1</td>
        <td class="textright">100.00</td>
        <td class="textright">100.00</td>
        <td class=""> <a class="link_delete" href="#" onclick="event.preventDefault(); del_product_detalle(1);"> <i class="far fa-trash-alt"></i> </td>
        </tr>  
        </tbody>
        <tfoot>
        <tr>
        <td colspan="5" class="textright"> SUBTOTAL $ </td>
        <td class="textright"> 88.00 </td>
        </tr>
        <tr>
        <td colspan="5" class="textright"> IVA $ </td>
        <td class="textright"> 88.00 </td>
        </tr>
        <tr>
        <td colspan="5" class="textright"> TOTAL $ </td>
        <td class="textright"> 88.00 </td>
        </tr>
        </tfoot>
        </table>

</section>  
        
        
        <?php include ("includes/footer.php"); ?> 
    </body>
</html>