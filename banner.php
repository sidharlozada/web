<?php   include("lib/librerias.php");   ?>
  <span class="titulo" >Crear Banner</span><div class="linea" ></div>
   <div  class = "row" style="margin-top:50px;">

        <div  class = "col-md-2" > </div>

        <div  class = "col-md-8" >

        

 

   
     <!-- -----------------------------------------------------------------   --> 


<div class="tab_container borde" >
    <!-- -----------------------------------------------------------------   -->
   <div class="main">

<hr>
<form id="uploadimage" name="uploadimage" action="" method="post" enctype="multipart/form-data">
    <table border="0"  align="center" class="table-condensed titulo" >
    <tr><td>Titulo</td><td><input type="text" class="form-control" placeholder="Titulo Noticia" name="titulo" id="titulo" value="" size="30" maxlength="30"></td>
        </tr>
        <tr><td>Descripcion</td><td><input type="text" class="form-control" placeholder="Descripcion de Baner" name="descripcion" id="descripcion" value="" size="40" maxlength="40"></td>
        </tr>
        <tr><td>Estatus</td>
            <td><select name="estatu" id="estatu" class="form-control"  style="font-size: 14px;">
                <option value="1" selected>Activo</option>
                <option value="0" >Inactivo</option></select>
            </td>
        </tr>
    </table>
<div id="image_preview" style="text-align: center;"> <img id="previewing" src="noimage.png" /></div>
<hr id="line" >
    
<div id="selectImage">
<label>Selecciona tu imagen</label><br/>

  <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>  
      <input type="file" name="file" id="file" required /></span>


   <button type="submit" class="btn btn-primary start" onclick="return validarModulo();"> 
       <i class="glyphicon glyphicon-upload"></i>
                    <span id="idenviar">Enviar</span>
       </button>
    <input type="reset" class="btn btn-warning" name="admodulocancelar" id="admodulocancelar" value="Cancelar" onclick=" $('#idenviar').html('Agregar');$('#tipooperaciones').val('Agregar'); $('#previewing').attr('src',''); return true;" >
</div>
    <input type="hidden" class="form-control input-group" name="form" id="form" value="banner">
    <input type="hidden" name="nombrefile" id="nombrefile" value="">
    <input type="hidden" name="tipooperaciones" id="tipooperaciones" value="Agregar">
    <input type="hidden" name="idbanner" id="idbanner" value="">
</form>
</div>
<div id='loading' >Cargando..</div>
 <div id="message" ></div>
   <!-- -----------------------------------------------------------------   -->
     <div id="tabla_banner">
               
           </div>
    
</div>
   
        


   
    
      
   <!--panel panel-primary-->
    </div><!--col-md-6-->
  

  </div><!--row-->
<?php  /*  ?>
<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/sample.js" type="text/javascript"></script>
<script src="js/alert/lib/alertify.min.js"></script>
<script src="bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
<?php  */  ?>
  <!-- The template to display files available for upload -->
<script type="text/javascript" language="javascript">
functablabanner();  
 function funcEditarmenu(id_banner){
    
    var parametros = {
                'form' : "editarbanner",
                'id_banner' : id_banner
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
                  
                    $("#titulo").val(json.titulo);
                  $("#descripcion").val(json.descripcion);
                    $("#estatu").val(json.estatus);
                    $("#idbanner").val(json.id);
                    
                    $("#nombrefile").val(json.imagen);
                    $('#previewing').attr('src','img/fondoInicio/'+json.imagen);
                    $('#previewing').attr('width', '150px');
		            $('#previewing').attr('height', '130px');
                    $("#idenviar").html("Actualizar");
                    $("#tipooperaciones").val("Actualizar");
                    
                        
                   
                   
                }else{
                  alert("Error="+json);  
                  //limpiar(); 
                }
              }
        });
}   
function functablabanner(pagina){
    
    var parametros = {
                'form' : "tablabanner",
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
                    $("#tabla_banner").html(response);
                
              }
        });
}
 function validarModulo() {   
    if($("#titulo").val()=="") {
      alert("Debe Ingresar El Titulo");
      $('#titulo').focus();
      return false;
    }else if($("#descripcion").val()==""){    
     alert("Debe Ingresar La Descripcion");
      $('#descripcion').focus();
      return false;
    
    }else{
       if (confirm("Esta seguro que Desea Continuar")==false){
        return   false;
      }
      return true;
    }
}   
$(document).ready(function (e) {
    
    
    
    
    $('#loading').hide();
    
    $("#loading").click(function() {
        $(this).hide();
      });  
    
	$("#uploadimage").on('submit',(function(e) { // alert("hola");
       
		e.preventDefault();
		$("#message").empty(); 
		$('#loading').show();
		$.ajax({
        	url: "consultas.php",   	// URL a la que se envía la solicitud
			type: "POST",      				// Tipo de solicitud que se enviará, llamado como método 
			data:  new FormData(this), 		// Datos enviados al servidor 
			contentType: false,       		// El tipo de contenido utilizado al enviar datos al servidor. El valor predeterminado es: "application / x-www-form-urlencoded"
    	    cache: false,					// Para no poder solicitar que las páginas se almacenen en caché
			processData:false,  			// Para enviar DOMDocument o archivo de datos no procesados, se establece en falso (es decir, los datos no deben estar en forma de cadena)
			success: function(data)  		// Una función a ser llamada si la solicitud tiene éxito
		    {  /// alert("Actualizo="+data);return;
              if($("#tipooperaciones").val()=="Actualizar"){
                 // var arrayDeCadenas = data.split('|');
                  $("#uploadimage")[0].reset();
                  $("#idenviar").html("Agregar");
                    $("#tipooperaciones").val("Agregar");
                  /* $('#loading2').hide();
			        $("#message").html(data);*/
                    $('#loading').html(data);
                    $('#loading').show();
                    $('#previewing').attr('src','noimage.png');
              }else{ 
                 $("#uploadimage")[0].reset(); 
                 $('#loading').html(data);
                  $('#loading').show();
			    // $("#message").html(data);
                 functablabanner();
              }
                
						
		    }	        
	   });
    	}));
   
// Función para previsualizar la imagen
	$(function() {
        $("#file").change(function() {
			$("#message").empty();         // Para eliminar el mensaje de error anterior
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg"];	
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
			{
			$('#previewing').attr('src','noimage.png');
			$("#message").html("<p id='error'>Selecciona un archivo de imagen válido</p>"+"<h4>Nota</h4>"+"<span id='error_message'>Solo jpeg, jpg y png Tipo de imágenes permitidas</span>");
			return false;
			}
            else
			{
                var reader = new FileReader();	
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }		
        });
    });
	function imageIsLoaded(e) { 
		$("#file").css("color","green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
		$('#previewing').attr('width', '150px');
		$('#previewing').attr('height', '130px');
	};
});    
</script>
<?php ?>  
<?php ?>

