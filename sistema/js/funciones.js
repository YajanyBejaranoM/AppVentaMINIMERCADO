$(document).ready(function(){

//--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
$("#foto").on("change",function(){
    var uploadFoto = document.getElementById("foto").value;
    var foto       = document.getElementById("foto").files;
    var nav = window.URL || window.webkitURL;
    var contactAlert = document.getElementById('form_alert');
    
        if(uploadFoto !='')
        {
            var type = foto[0].type;
            var name = foto[0].name;
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
            {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                $("#img").remove();
                $(".delPhoto").addClass('notBlock');
                $('#foto').val('');
                return false;
            }else{  
                    contactAlert.innerHTML='';
                    $("#img").remove();
                    $(".delPhoto").removeClass('notBlock');
                    var objeto_url = nav.createObjectURL(this.files[0]);
                    $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                    $(".upimg label").remove();
                    
                }
          }else{
              alert("No selecciono foto");
            $("#img").remove();
          }              
});

$('.delPhoto').click(function(){
    $('#foto').val('');
    $(".delPhoto").addClass('notBlock');
    $("#img").remove();

    if($("#foto_actual") && $("#foto_remove")){
        $("#foto_remove").val('img_producto.png');
    }

});

});

//MOdal form add PRODUCTO

$('.add_product').click(function(e) {
e.preventDefault();
var producto = $(this).attr('product');
var action = 'infoProducto';

$.ajax({
    url:'ajax.php',
    type:'POST',
    async:true,
    data:{action:action,producto:producto},

    success:function(response){
        if(response != 'error'){
            var info = JSON.parse(response);

            //$('.bodyModal').html(' <form action="registroproducto.php" method="post" enctype="multipart/form-data">'
           //                       '<input type="text" name="idpro"  placeholder="Ingrese Id Producto">'
            //                      '<input type="text" name="nombrep"  placeholder="Nombre Producto">'
            //                      '<input type="text" name="descripcionp"  placeholder="Ingrese descripcion">'
            //                      '<input type="text" name="ValorUni"  placeholder="Ingrese Valor Producto">'
           //                       '<input type="text" name="cantipro"  placeholder="Ingrese Cantidad">'   
            //                      '<button type="submit" class="boton"><i class="fas fa-save"></i> Registrar Usuario</button>'
            //  '</form>');
        }
    },
error:function(error){
    console.log(error);
}
});
$('.modal').fadeIn();
});


// MOdal form delete PRODUCTO

$('.del_product').click(function(e) {
    e.preventDefault();
    var producto =$(this).attr('product');
    var action = 'infoProducto';
    
    $.ajax({
        url:'ajax.php',
        type:'POST',
        async:true,
        data:{action:action,producto:producto},
    
        success:function(response){
            if(response != 'error'){
                var info = JSON.parse(response);
    
                //$('.bodyModal').html(' <form action="registroproducto.php" method="post" enctype="multipart/form-data">'
                 //                     '<input type="text" name="idpro"  placeholder="Ingrese Id Producto">'
                //                      '<input type="text" name="nombrep"  placeholder="Nombre Producto">'
                //                      '<input type="text" name="descripcionp"  placeholder="Ingrese descripcion">'
                 //                     '<input type="text" name="ValorUni"  placeholder="Ingrese Valor Producto">'
                 //                     '<input type="text" name="cantipro"  placeholder="Ingrese Cantidad">'   
                 //                     '<button type="submit" class="boton"><i class="fas fa-save"></i> Registrar Usuario</button>'
                 // '</form>');
            }
        },
    error:function(error){
        console.log(error);
    }
    });
    $('.modal').fadeIn();
    });


//Activa campos para registrar cliente.aa

$('.btn_new_cliente').click(function(e){
    e.preventDefault();
    $('#nom_cliente').removeAttr('disabled');
    $('#tel_cliente').removeAttr('disabled');
    $('#dir_cliente').removeAttr('disabled');

    $('#div_registro_cliente').removeAttr('disabled');
});


//Buscar cliente

$('#nit_cliente').keyup(function(e){
    e.preventDefault();

    var cl = $(this).val();
    var action = 'searchCliente';

    $.ajax({
        url:'ajax.php',
        type:'POST',
        async:true,
        data:{action:action,cliente:cl},
    
        success:function(response){
            console.log(response);
        },
        error:function(error){
        }
    });
});