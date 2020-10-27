  /*  

$(document).ready(function(){
    $('#personal').load('php/model.php');

});*/


$(document).ready(function(){
    $('#guardarnuevo').click(function(){

        $.ajax({
             type: "POST",

             url:"php/insertarPersonal.php",
             data:{ nombre:$('#nombre').val(),
                    telefono:$('#telefono').val(),
                    correo:$('#correo').val(),
                    fechaicolab:$('#fechaicolab').val(),
                    fechafcolab:$('#fechafcolab').val()
                }
        }).success(function(data){
            
                $('#tabla_buscar').html(data);
                alertify.success("¡¡Agregado con exito!!");

            }).fail(function()
            {
                alertify.error("¡¡Fallo en el servidor!!");
            });

    });
   $('#buscar').keyup(function(){
       $.ajax({
             type: "POST",

             url:"php/tabla.php",
             data:{ buscar:$('#buscar').val()
                }
        }).success(function(data){
            
                $('#tabla_buscar').html(data);
               

            }).fail(function()
            {
                alertify.error("¡¡Fallo en el servidor!!");
            });



   });
});

/*
$(document).ready(function(){
    $('#buscar').click(function(){

        $.ajax({
             type: "POST",

             url:"php/buscarPersonal.php",
             data:{ nombre:$('#nombre').val(),
                    telefono:$('#telefono').val(),
                    correo:$('#correo').val(),
                    privilegio:$('#cargo').val(),
                    fecha:$('#fechacolab').val()
                }
        }).success(function(){
            
                $('#tabla').load('componentestabla/tabla.php');
                alertify.success("¡¡Agregado con exito!!");

            }).fail(function()
            {
                alertify.error("¡¡Fallo en el servidor!!");
            });

    });

});*/



   var datepicker, config;
    config = {
        locale: 'es-es',
        uiLibrary: 'bootstrap4'
    };

    $(document).ready(function () {
        $("#fechaicolab").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaicolab').datepicker(config);
    });
    $(document).ready(function () {
        $("#fechafcolab").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechafcolab').datepicker(config);
    });

    $(document).ready(function () {
        $("#fechaicolabu").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechaicolabu').datepicker(config);
    });

     $(document).ready(function () {
        $("#fechafcolabu").datepicker({ 
            format: 'dd/mm/yyyy'
         });
        datepicker = $('#fechafcolabu').datepicker(config);
    });


   
