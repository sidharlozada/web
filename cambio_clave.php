<?php   include("lib/librerias.php");
$oUsuarios = new usuario;
?>
  <span class="titulo" >Cambio de Clave</span><div class="linea" ></div>
   <div  class = "row" style="margin-top:50px">

        <div  class = "col-md-2" > </div>

        <div  class = "col-md-8" >

        

 

   
     <!-- -----------------------------------------------------------------   --> 

<? $cUsuarios=$oUsuarios->get($conn,$_SESSION['id']);                 ?>
<div class="tab_container borde">
    <div class="tab_content" id="tab1">
        <!--Content 1-->
        <form name="formcambioclave" id="formcambioclave" method="post">
<table  border="0"  align="center" class="table-condensed titulo">
<tr>
	<td>Nombre y Apellido:</td>
	<td><span class="titulo"><?=$oUsuarios->nombre."  ".$oUsuarios->apellido?></span></td>
</tr>
<tr>
	<td>Login:</td>
	<td><span class="titulo"><?=$oUsuarios->login?></span></td>
</tr>
<tr>
	<td>Contrase&ntilde;a Actual:</td>
	<td><input name="passwordActual" id="passwordActual" size="15" maxlength="15" type="password">
	   <div id="mensaje1" class="errores"> Ingrese la clave Actual</div>
	</td>
</tr>
<tr>
	<td>Contrase&ntilde;a Nueva:</td>
	<td><input name="password" id="password" size="15" maxlength="15" type="password">
		<div id="mensaje2" class="errores"> Ingrese clave Nueva</div>
	</td>
</tr>
<tr>
	<td>Repita Contrase&ntilde;a Nueva:</td>
	<td><input name="passwordnew" id="passwordnew" size="15" maxlength="15" type="password">
		<div id="mensaje3" class="errores"> Repita la clave Nueva</div>
		
	</td>
</tr>
<tr>
	<td></td>
	<td align='center'>
		<input name="actualizarclave" id="actualizarclave" type="button" value="Actualizar"  />
        
	</td>
</tr>
</table>

<input name="id" type="hidden" value="<?=$oUsuarios->id?>" />
<input name="accion" id="accion" type="hidden" value="ActualizarClave" />
 <input type="hidden" name="form" id="form" value="ActualizarClave">
</form>
           
        
           
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
$(document).ready(function () {
    $("#actualizarclave").click(function (){ 
        
        var passwordActual = $("#passwordActual").val();
        var password = $("#password").val();
        var passwordnew = $("#passwordnew").val();
        
      //  alert("hola");return;
           
 
                if(passwordActual == "" ){
                    $("#mensaje1").fadeIn("slow");
                    return false;
                }
                else{
                    $("#mensaje1").fadeOut();
 
                    if( password == ""){
                        $("#mensaje2").fadeIn("slow");
                        return false;
                    }
                    else
                       $("#mensaje2").fadeOut();
                    
                    
                    if( passwordnew == "" ||passwordnew != password){
                        $("#mensaje3").fadeIn("slow");
                        return false;
                    }
                    else
                       $("#mensaje3").fadeOut();
                }
            
       Guardar_Modulo();
    });
    
    
    
});//fin ready
 function Guardar_Modulo(){
    if (confirm("Esta seguro que Desea Continuar")==false){
        return;
      }
        var parametros = new FormData($("#formcambioclave")[0]);
        $.ajax({
                data:  parametros,
                url:   'consultas.php',
                type:  'post',
                contentType: false,
                processData:false,
                cache:false,
                beforeSend: function () {
                    // $("#env").show();
                },
                success:  function (response) {
               // alert(response); return;
                 if (response==1){
                   //  alert("Registrado con Exito");
                  alertify.success("Se realizaron los cambios con exito");
                  $("#formcambioclave")[0].reset();
                 // functablausuarios();   
                 }
                else if (response==2){ 
                  alertify.error("Error la clave de usuario no es correcta"); 
                  $("#mensaje1").fadeIn("slow");
                }
              }
        });


}
 


  
    
    
    
</script>