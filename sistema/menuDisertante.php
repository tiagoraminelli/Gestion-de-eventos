<?php
set_include_path("../modelo");
require 'DisertanteFilter.php'; 
//creamos al DisertanteFilter
$d = new DisertanteFilter();
$datosDisertantes= $d->getDisertantes();

              

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/menuReutilizable.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <title id="titulo">Menu de Disertante</title>
</head>
<body class="flex flex-col min-h-screen">
    
<!-- nav -->
<nav class="bg-slate-50 font-serif " aria-label="breadcrumb">

  <ol class="breadcrumb">
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="../index.php">index</a></li>
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./menuDisertante.php">menu de disertantes</a></li>
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./menuUsuarios.php">menu de usuarios</a></li>
   

    <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
  </ol>
</nav>
<!-- nav -->

<button type="button" id="btnExportar" class="btn btn-primary">Exportar Disertantes</button>
<button class="btn btn-primary" onclick="disertanteNuevo()">nuevo</button> 
<button type="button" id="btnEliminarExportar" class="btn btn-primary">eliminar Importacion </button>
<!-- areaTrabajo -->
<section class="bg-slate-200 mx-auto text-slate-500" id="areaTrabajo">

<!-- Botón para exportar -->

 





    <!-- HARDCODEADOOOOOOO -->



</section>
<!-- areaTrabajo -->

<section class="bg-slate-400" id="mensajes">
<h2>aca van los mensajes</h2>

<div id="mensaje">
<!-- aqui va el codigo scrip --> 

</div>

</section>




<footer class="bg-slate-600" id="idFooter"> <!-- inicio footer -->
<h2>aca van los scrips</h2>
<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus ipsa deleniti nihil veritatis aliquid deserunt sunt, beatae ipsam voluptas, ut aspernatur tenetur dolorem fuga at, facere necessitatibus quidem omnis iste?</p>
<i class="ri-copyright-line"></i>
<!-- <script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="http://localhost/sbgeTiago/public/css/bootstrap.bundle.min.js"></script>
<script src="http://localhost/sbgeTiago/public/css/dataTables.js"></script>
<script src="http://localhost/sbgeTiago/public/css/dataTables.bootstrap5.js"></script> -->
</footer> <!-- fin footer -->



<script src="../public/js/jquery-3.7.1.min.js"></script>

<script > //EMPAZAMOS EL SCRIP A MANO PARA MOVERLO DESPUES
//creamos funciones globales;

//creamos la funcion AJAX
$(document).ready(function(){
    cargarContenido();
})

function cargarContenido(){
    

    $.post("./funciones/disertanteListar.php",function(listado){
        $('#areaTrabajo').html(listado);
    });

    
}




function disertanteNuevo(){
    let url = "./html/disertante.html";
    $.post(url,function(data){
        $("#areaTrabajo").html(data);
        $("#disertanteVer").css("display", "none");
    });
    
}


$('#btnExportar').click(function() {
    $.post('../export/export.php', function(data) {
        // Procesar la respuesta JSON
        let mensaje = JSON.parse(data);
        if (mensaje.tipo === 'exito') {
            // Mostrar un mensaje de alerta
            alert(mensaje.texto);
        } else {
            // Manejar otros tipos de respuesta si es necesario
            alert('Hubo un problema al exportar los disertantes.');
        }
    });
});




function disertanteEditar(id){

    let url = "./html/disertante.html";
    //alert("el id es: "+id);
    let disertante = disertanteSeleccionar(id);
    console.info(disertante)
    $.get(url,function(data){
        let parametros = { "inputIdDisertante": id };
          $("#areaTrabajo").html(data);
          $("#disertanteVer").css("display", "none");
            // Llenar los campos del formulario con los datos del disertante
        $('#inputId').val(disertante.id);
        $('#inputNombre').val(disertante.nombre);
        $('#inputApellidos').val(disertante.apellidos);
        $('#inputBiografia').val(disertante.biografia);
        $('#inputTelefono').val(disertante.telefono);
        $('#inputCaracteristica').val(disertante.caracteristica);
        $('#inputNumero').val(disertante.numero);
        $('#inputEmail').val(disertante.email);
        $('#inputUrl').val(disertante.url);
        $('#inputTwitter').val(disertante.twitter);
        $('#inputLinkedin').val(disertante.linkedin);
        
       
    });

  
    return id;
    }

//<------------------separador de funciones----------------->



    function verFormulario(id) {
        let disertante = disertanteSeleccionar(id);
    let url = "./html/disertante.html";
    $.get(url,function(data){
            //alert(disertante.nombre);
            $("#areaTrabajo").html(data);
            $('#spanNombre').html(disertante.nombre);
            $('#spanApellidos').html(disertante.apellidos);
            $('#spanBiografia').html(disertante.biografia);
            $('#spanTelefono').html(disertante.telefono);
            $('#spanEmail').html(disertante.email);
            $('#spanUrl').html(disertante.url);
            $('#spanTwitter').html(disertante.twitter);
            $('#spanLinkedin').html(disertante.linkedin); 
            $("#editarDisertante").addClass("d-none")
            $("#disertanteVer").addClass("visible");
    })
}



//<------------------separador de funciones----------------->
function disertanteSeleccionar(id){

    let datosDisertante;
    $.ajaxSetup({async:false});
    $.post('./funciones/disertanteSeleccionar.php', {'id': id}, function(result){
        // En esta parte, debes acceder a la propiedad 'datos' del resultado 'result'
        // y asignarlo a la variable datosDisertante
        datosDisertante = result['datos'];
    }, 'json');

    return datosDisertante;

}
     
//<------------------separador de funciones----------------->

function cargarDatos() {
    // Obtener los valores de los campos del formulario utilizando jQuery
    var id = $('#inputId').val();
    var nombre = $('#inputNombre').val();
    var apellidos = $('#inputApellidos').val();
    var biografia = $('#inputBiografia').val();
    var caracteristica = $('#inputCaracteristica').val();
    var numero = $('#inputNumero').val();
    var telefono = $('#inputTelefono').val();
    var email = $('#inputEmail').val();
    var url = $('#inputUrl').val();
    var twitter = $('#inputTwitter').val();
    var linkedin = $('#inputLinkedin').val();
    // Mostrar los datos mediante una alerta
    //alert(telefono);
    var mensaje = 
                  "Id: " + id + "\n" +
                  "Nombre: " + nombre + "\n" +
                  "Apellidos: " + apellidos + "\n" +
                  "Biografía: " + biografia + "\n" +
                  "caracteristica: " + caracteristica + "\n" +
                  "numero: " + numero + "\n" +
                  "telefono: " + telefono + "\n" +
                  "email: " + email + "\n" +
                  "URL: " + url + "\n" +
                  "Twitter: " + twitter + "\n" +
                  "LinkedIn: " + linkedin;

    //alert(mensaje);

    // Insertar los valores en la sección disertanteVer
    $("#editarDisertante").css("display", "none");
    $("#disertanteVer").css("display", "block");
    $('#spanNombre').text(nombre);
    $('#spanApellidos').text(apellidos);
    $('#spanBiografia').text(biografia);
    $('#spanTelefono').text(telefono);
    $('#spanEmail').text(email);
    $('#spanUrl').text(url);
    $('#spanTwitter').text(twitter);
    $('#spanLinkedin').text(linkedin);


    // Crear objeto con los datos a enviar
    if(id){ //si existe el Id, se crea el param para EDITAR
        var param = {
        "id" : id,
        "nombre" : nombre,
        "apellidos" : apellidos,
        "biografia" :biografia,
        "telefono" : telefono,
        "email" : email,
        "url" : url,
        "twitter" : twitter,
        "linkedin" : linkedin
    };
    }else{ //si no existe el Id, se crea el param para AGREGAR
        var param = {
        
        "nombre" : nombre,
        "apellidos" : apellidos,
        "biografia" :biografia,
        "telefono" : telefono,
        "email" : email,
        "url" : url,
        "twitter" : twitter,
        "linkedin" : linkedin
    };
    }
   
    

    // Enviar los datos por AJAX
    $.post('./funciones/disertanteGuardar.php', param, function(listado) {
        // Si necesitas hacer algo con la respuesta del servidor, puedes hacerlo aquí
        // En este caso, simplemente redireccionamos a la página correspondiente
        //cargarContenido();
        //$('#mensaje').html('<div class="alert alert-success" role="alert">¡Disertante guardado exitosamente!</div>'); 
        $("#areaTrabajo").html(listado);
        alert("se cargo");
    });
    //verFormulario();
} //fin de la funcion

//<------------------separador de funciones----------------->
function volverMenu(){
 cargarContenido();
}

//<------------------separador de funciones----------------->



function aplicarFiltros(){ 
    

let nombre;
let apellidos;
let telefono;
let parametros;
//id = $("#inputFiltroId").val();
nombre = $("#inputFiltroNombre").val();
apellidos = $("#inputFiltroApellidos").val();
telefono = $("#inputFiltroTelefono").val(); 

//alert(id);
//alert(nombre);
//alert(apellidos);
//alert(telefono);
if(!nombre && !apellidos && !telefono){
    alert("Debe completar algun campo para filtrar");
}else{
    parametros = {"nombre":nombre,"apellidos":apellidos}; //asi creamos el arreglo asociativo
    console.log(parametros);
   $.post('./funciones/disertanteListar.php',parametros,function(listado){
    $("#areaTrabajo").html(listado);
   }) 
}
}

//<------------------separador de funciones----------------->

//<------------------separador de funciones----------------->

function eliminarFiltros(){


$("#inputId").val("");

$("#inputFiltroNombre").val("");

$("#inputFiltroApellidos").val("");

$("#inputFiltroTelefono").val(""); 
cargarContenido();


}


//<------------------separador de funciones----------------->

//arriba de esto el link de BOOSTRAP


//<------------------separador de funciones----------------->

$("body").on("click","#inputIdAllDisertante",function(){

    // Cuando se hace clic en el botón "Marcar/Desmarcar Todos"
    if(($(this)).is(":checked")){
        $('.check').prop('checked',true);
    }else{
        $('.check').prop('checked',false);
    }

});

//<------------------separador de funciones----------------->
function eliminarDisertante(idDisertante) {
    // Crear objeto con el ID del disertante a eliminar
    let parametros = { "inputIdDisertante": idDisertante };

    if (confirm("¿Estás seguro de eliminar este disertante?")) {
        $.post('./funciones/disertanteEliminar.php', parametros, function(arregloResultado) {
            $('#mensaje').html('<div class="alert alert-success" role="alert">¡Disertante eliminado exitosamente!</div>'); 
           cargarContenido(); 
        }, "json");
    } else {
        $('#mensaje').html('<div class="alert alert-danger" role="alert">Se ha cancelado la operación</div>');
    }
}

//<------------------separador de funciones----------------->

function disertantesEliminar(){
//console.info("hola mundo"); para ver si anda el boton
let cadena = "";
let cadenaEnviar = "";


$(".check:checked").each(function(){ //selecciona todos los checkbox con la clase "check" y la casilla verificada, y hace un foreach  id=example
    cadena+=$(this).val()+"/"; //creo la cadena y la voy concatenando de manera que quede un / entre cada uno
})
if(cadena.length > 0){
    cadenaEnviar = cadena.slice(0, -1); //slice quita el ultima elemento por -1 y guardo la cadena en una nueva variable
    let parametros = {"inputIdDisertante":cadenaEnviar}; //se declaran los parametros
    if(confirm("Estas seguro de eliminar estos disertantes?") == true){ //pregunta si 
        $.post('./funciones/disertanteEliminar.php',parametros,function(arregloResultado){//llama a los parametros y los envia a disertanteEliminar.php
            $('#mensaje').html('<div class="alert alert-success" role="alert">¡Actualización exitosa!</div>'); 
            cargarContenido(); 
       },"json"); //recibe el json
    }else{
        $('#mensaje').html('<div class="alert alert-danger" role="alert">Se ha cancelado la operación</div>');
    }
           
}else{
    $('#mensaje').html('<div class="alert alert-danger" role="alert">¡no haz seleccionado nada!</div>');
}


//console.log(cadenaEnviar); //enviamos la cadena para ver si la creo

// Inyectar el mensaje en el contenedor

} //termina la funcion eliminar 

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>