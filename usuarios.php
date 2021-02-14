<?php   include("lib/librerias.php");   ?>
  <span class="titulo" >Crear Usuarios</span><div class="linea" ></div>
   <div  class = "row" style="margin-top:50px">

        <div  class = "col-md-2" > </div>

        <div  class = "col-md-8" >

        

 

   
     <!-- -----------------------------------------------------------------   --> 


<div class="tab_container borde">
    <div class="tab_content" id="tab1">
        <!--Content 1-->
        <form class="form-signin"  method="POST" action="" name="formusuario" id="formusuario">
       
        <table border="0"  align="center" class="table-condensed titulo" >
           
            <tr>
                <td> Nombre: </td> 
                <td> <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre"  autofocus value="" maxlength="20"  >
                    <div id="mensaje1" class="errores"> Ingresa solo caracteres</div>
 
                </td>
            </tr>
            <tr>
                <td> Apellido: </td>
                <td> <input  type="text" class="form-control" placeholder="Apellido" name="apellidos" id="apellidos"  maxlength="20" >
                    <div id="mensaje2" class="errores"> Ingresa solo caracteres</div>
                </td>
            </tr>
            <tr>
                <td> Cedula: </td>
                <td> <input  type="text" class="form-control" placeholder="Cedula" name="cedula" id="cedula"  maxlength="12" > 
                 <div id="mensaje3" class="errores"> Ingresa solo Numeros</div>
                
                </td>
            </tr>
            <tr>
                <td> Usuario: </td>
                <td> <input  type="text"  class="form-control" placeholder="Usuario" name="login" id="login"  maxlength="8" >
                <div id="mensaje4" class="errores"> Usuario no Valido</div>
                </td>
            </tr>
            <tr>
                <td> Clave: </td>
                <td> <input  type="password"  class="form-control" placeholder="Clave" name="pass" id="pass"  maxlength="8" > 
                
                
                </td>
            </tr>
             <tr>
                <td>Repita Clave: </td>
                <td> <input  type="password" class="form-control" placeholder="Repita Clave" name="repass" id="repass"  maxlength="8" >
                 <div id="mensaje5" class="errores"> La clave no son Iguales</div>
                 </td>
            </tr>
            
            <tr>
                <td colspan="2"><input  class="btn btn-success" type="button" name="agregarusuario" id="agregarusuario" value="Agregar"  >  <input type="reset" class="btn btn-warning" name="adusuariocancelar" id="adusuariocancelar" value="Cancelar"  onclick=" $('#agregarusuario').val('Agregar');$('#tipousuario').val('Agregar'); return true;"> </td> <!--      -->
            </tr>           
            
          </table>
              <input type="hidden" name="form" id="form" value="formusuario">
              <input type="hidden" name="idusuario" id="idusuario" value="">
              <input type="hidden" name="tipousuario" id="tipousuario" value="Agregar">
           </form>
           
           <div id="tabla_usuarios">
               
           </div>
           
           
           
           
           
           
    </div>

</div>
   <!-- -----------------------------------------------------------------   -->
      
   <!-- -----------------------------------------------------------------   -->
        


   
    
      
   <!--panel panel-primary-->
    </div><!--col-md-6-->
  

  </div><!--row-->

<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/sample.js" type="text/javascript"></script>
<script src="js/alert/lib/alertify.min.js"></script>
<script src="bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>


<script type="text/javascript" language="javascript">
var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
var expr1 = /^[a-zA-Z]*$/;
 var expr2 = /^([0-9])*$/;
    var validausuario = /^[A-Za-z0-9ü.-][a-z0-9ü_.-]{3,9}$/;
$(document).ready(function () {
    $("#agregarusuario").click(function (){ //función para el boton de enviar
        //recolectamos en variables, lo que tenga cada input.
        //Para mejor manipulación en los if's
        var nombre = $("#nombre").val();
        var apellidos = $("#apellidos").val();
        var cedula = $("#cedula").val();
        var login = $("#login").val();
        var passw = $("#pass").val();
        var repass = $("#repass").val();
        
        //Secuencia de if's para verificar contenido de los inputs
 
        //Verifica que no este vacío y que sean letras
        if(nombre == "" || !expr1.test(nombre)){
            $("#mensaje1").fadeIn("slow"); //Muestra mensaje de error
            return false;                  // con false sale de la secuencia
        }
        else{
            $("#mensaje1").fadeOut();   //Si el anterior if cumple, se oculta el error
 
            if(apellidos == "" || !expr1.test(apellidos)){
                $("#mensaje2").fadeIn("slow");
                return false;
            }
            else{
                $("#mensaje2").fadeOut();
 
                if(cedula == "" || !expr2.test(cedula)){
                    $("#mensaje3").fadeIn("slow");
                    return false;
                }
                else{
                    $("#mensaje3").fadeOut();
 
                    if( login == "" || !validausuario.test(login)){
                        $("#mensaje4").fadeIn("slow");
                        return false;
                    }
                    else
                       $("#mensaje4").fadeOut();
                    
                    
                    if( passw == "" ||passw != repass){
                        $("#mensaje5").fadeIn("slow");
                        return false;
                    }
                    else
                       $("#mensaje5").fadeOut();
                }
            }
        }
       Guardar_Usuario();
    });
       /*Las siguientes funciones son una mejora al ejemplo anterior que mostré
     * Si el mensaje se mostró, el usuario tenía que volver a oprimir el boton
     * de registrar para que el error se ocultará (si era el caso).
     *
     *Con estas funciones de keyup, el mensaje de error se muestra y
     * se ocultará automáticamente, si el usuario escribe datos admitidos.
     * Sin necesidad de oprimir de nuevo el boton de registrar.
     *
     * La función keyup lee lo último que se ha escrito y comparamos
     * con nuestras condiciones, si cumple se quita el error.
     *
     * Es cuestión de analizar un poco para entenderlas
     * Cualquier duda, comenten 
     $("#nombre").keyup(function(e) { //alert("hola");
      //  var nombre = $("#nombre").val();
       // var re_pass=$("#repass").val();
       if($(this).val() != "" && expr1.test($(this).val())){
            $("#mensaje1").fadeOut();
            return false;
        }
        else
          $("#mensaje1").fadeIn("slow");
      
        
    });
      */
    $("#nombre").keyup(function(){ //alert("hola");
                                  
        if( $(this).val() != "" && expr1.test($(this).val())){
            $("#mensaje1").fadeOut();
            return false;
        }
       else
          $("#mensaje1").fadeIn("slow");                           
    });
    $("#apellidos").keyup(function(e){
        if( $(this).val() != "" && expr1.test($(this).val())){
            $("#mensaje2").fadeOut();
            return false;
        }
        else
           $("#mensaje2").fadeIn("slow");
    });
 
    $("#cedula").keyup(function(e){
        if( $(this).val() != "" && expr2.test($(this).val())){
            $("#mensaje3").fadeOut();
            return false;
        }
        else
          $("#mensaje3").fadeIn("slow");
            
    });
    
    $("#login").keyup(function(e){
        if( $(this).val() != "" && validausuario.test($(this).val())){
            $("#mensaje4").fadeOut();
            return false;
        }
        else
          $("#mensaje4").fadeIn("slow");
            
    });
 
    
    var valido=false;
    $("#repass").keyup(function(e) {
        var pass = $("#pass").val();
        var re_pass=$("#repass").val();
 
        if(pass != re_pass)
        {
            $("#repass").css({"background":"#F22" }); //El input se pone rojo
            valido=true;
        }
        else if(pass == re_pass)
        {
            $("#repass").css({"background":"#8F8"}); //El input se ponen verde
            $("#mensaje5").fadeOut();
            valido=true;
        }
    });//fin keyup repass
 
});//fin ready
</script>
<script type="text/javascript" language="javascript">
    functablausuarios();
function functablausuarios(pagina){
    
    var parametros = {
                'form' : "tablausuarios",
                'pagina':pagina
    };
    $.ajax({
                data:  parametros,
                url:   'consultas.php',
                type:  'post',
               cache:false,
                beforeSend: function () {},
                success:  function (response) {
                  //  alert(response); return;
                    $("#tabla_usuarios").html(response);
                
              }
        });
}    
    
function funcEditarmenu(id_usuario){
    
    var parametros = {
                'form' : "editarusuario",
                'id_usuario' : id_usuario
        };
    $.ajax({
                data:  parametros,
                url:   'consultas.php',
                type:  'post',
               cache:false,
                beforeSend: function () {},
                success:  function (response) {
                  //  alert(response); return;
                var json = JSON.parse(response);

                if (json.id){
                    //  alert("json.tipo="+json.tipo);
                    $("#idusuario").val(json.id);
                  $("#nombre").val(json.nombre);
                    $("#apellidos").val(json.apellido);
                    $("#cedula").val(json.cedula);
                    $("#login").val(json.login);
                    $("#agregarusuario").val("Actualizar");//ESTO ES PARA EL BOTON
                    $("#tipousuario").val("Actualizar");//PARA IDENFIFICAR LA OPERACION
                    
                        
                   
                   
                }else{
                  alert("Error="+json);  
                  //limpiar(); 
                }
              }
        });
}    
function Guardar_Usuario(){
//var op=$("#pass").val();

    if (confirm("Esta seguro que Desea Continuar")==false){
        return;
      }
   
        var parametros = new FormData($("#formusuario")[0]);
    // alert(parametros);
   // return;
        $.ajax({
                data:  parametros,
                url:   'consultas.php',
                type:  'post',
                contentType: false,
                processData:false,
                cache:false,
                beforeSend: function () {
                     $("#env").show();
                },
                success:  function (response) {
              // alert(response); return;
                var json = JSON.parse(response);
              
                if (json==1){
                   //  alert("Registrado con Exito");
                  alertify.success("Registrado con Exito");
                  $("#formusuario")[0].reset();
                  functablausuarios();   
                }else if(json==2){  //alert("2");
                  alertify.error("El registro ya existe, Cedula");  
                     }else if(json==3){  //alert("3");
                  alertify.error("El registro ya existe, Usuario"); //agregarmodulo
                        
                     // functablamodulos();  
                     }else if(json==4){  //alert("2");
                  alertify.error("Error no se agrego el Registro");  
                     }else if(json==5){  //alert("2");
                  alertify.success("Se actualizo el Registro con Exito"); 
                          $('#agregarusuario').val('Agregar'); $('#tipousuario').val('Agregar');
                         $("#formusuario")[0].reset();
                         functablausuarios();
                     }else if(json==4){  //alert("2");
                    alertify.error("Error no se Actualizo el Registro");  
                     }else{
                         alert("Error="+json); 
                
                }
              }
        });


 

}
    
    
</script>