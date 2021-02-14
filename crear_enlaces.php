<?php   include("lib/librerias.php");   ?>
  <span class="titulo" >Administracion Menu Principal</span><div class="linea" ></div>
   <div  class = "row" style="margin-top:50px">

        <div  class = "col-md-2" > </div>

        <div  class = "col-md-8" >

        

 

   
     <!-- -----------------------------------------------------------------   --> 
    <ul class="tabs">
     <li><a href="#tab1" >Modulos</a></li>
     <li><a href="#tab2" >Enlaces</a></li>
    </ul>

<div class="tab_container borde?">
    <div class="tab_content" id="tab1">
        <!--Content 1-->
        <form class="form-signin"  method="POST" action="" name="formmodulo" id="formmodulo">
       
        <table border="0"  align="center" class="table-condensed titulo" >
           
            <tr>
                <td> Modulo: </td> 
                <td> <input type="text" class="form-control" placeholder="Modulo" name="txtmodulo" id="txtmodulo"  autofocus value="" maxlength="30" ></td>
            </tr>
            <tr>
                <td> Orden: </td>
                <td> <input  type="text" class="form-control" placeholder="Orden" name="txtOrdenmodulo" id="txtOrdenmodulo" onkeypress="return permite(event,'num');" maxlength="2" > </td>
            </tr>
            <tr>
                <td> Privado:<input type="checkbox" name="txttipo" id="txttipo" value="1"> </td>
                <td> </td>
            </tr>
            <tr>
                <td colspan="2"><input class="btn btn-success" type="button" name="agregarmodulo" id="agregarmodulo" value="Agregar" onclick="Guardar_Modulo(); return false;" >  <input class="btn btn-warning" type="reset"  name="admodulocancelar" id="admodulocancelar" value="Cancelar" onclick=" $('#agregarmodulo').val('Agregar');$('#tipomodulo').val('Agregar'); return true;" > </td> <!--      -->
            </tr>           
            
          </table>
              <input type="hidden" name="form" id="form" value="formmodulo">
              <input type="hidden" name="idmodulo" id="idmodulo" value="">
              <input type="hidden" name="tipomodulo" id="tipomodulo" value="Agregar">
           </form>
           
           <div id="tabla_modulos">
               
           </div>
           
           
           
           
           
           
    </div>
    <div class="tab_content" id="tab2">
       <!--Content 2-->
       <form class="form-signin" role="form2" method="POST" action="" name="formoperaciones" id="formoperaciones">
          <table border="0"  align="center" class="table-condensed titulo" >  
            <tr>
                <td> Descripción: </td>
                <td> <input  type="text" class="form-control" placeholder="Descripcion" name="descripcion" id="descripcion" value="" maxlength="30" > </td>
            </tr>
            <tr>
                <td> Pagina: </td>
                <td id="paginaad"><!-- <input  type="text" class="form-control" placeholder="Pagina" name="pagina" id="pagina" > -->
                    <select name="pagina" id="pagina" class="form-control"> 
                <option value="">Seleccione</option>
                  <?php 
                        $q = "SELECT * FROM public.noticias  ";
            $q.= "WHERE  tipo_publicacion='5' ";
           // $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
          //  $q.= !empty($find) ? "AND noticia ilike '%$find%'  OR titulo ilike  '%$find%' " :"";
                    $r=$conn->Execute($q);
                    while(!$r->EOF){  
                        echo "<option value="."?id=".$r->fields['id'].">".$r->fields['titulo']."</option>";
                      $r->movenext();
                    }
                    ?></select>
                </td>
            </tr>
            <tr>
                <td> Modulo: </td>
                <td> <select name="modulo" id="modulo" maxlength="30" class="form-control" > 
                <option value="">Seleccione</option>
                <?php    
                    $q = "SELECT id, descripcion FROM modulos WHERE id IS NOT NULL;";
                    $r=$conn->Execute($q);
                    while(!$r->EOF){  
                        echo "<option value=".$r->fields['id'].">".$r->fields['descripcion']."</option>";
                      $r->movenext();
                    }
                    ?>
                </select>
                </td>
            </tr>
             <tr>
                <td> Orden: </td>
                <td> <input  type="text" class="form-control" placeholder="Orden" name="orden" id="orden" onkeypress="return permite(event,'num');"  maxlength="2" > </td>
            </tr>
            <tr>
                <td>Nivel 1:<input type="checkbox" name="nivel1" id="nivel1" value="1" onclick="cambiar_nivel(); return true;"> </td>
                <td> </td>
            </tr>
            <tr>
                 <td colspan="2"><input class="btn btn-success" type="button" name="adoperaciones" id="adoperaciones" value="Agregar" onclick="Guardar_Operaciones(); return true;" >  <input class="btn btn-warning" type="reset"  name="admodulocancelar" id="admodulocancelar" value="Cancelar" onclick=" $('#adoperaciones').val('Agregar');$('#tipooperaciones').val('Agregar');cambiar_nivel(); return true;" > </td> 
            </tr>
            
            
            
        </table>
                <input type="hidden" name="form" id="form" value="formoperaciones">
                <input type="hidden" name="tipo" id="tipo" value="V">
                <input type="hidden" name="padre" id="padre" value="">
                <input type="hidden" name="idoperaciones" id="idoperaciones" value="">
              <input type="hidden" name="tipooperaciones" id="tipooperaciones" value="Agregar">
        
      </form>
      
      <div id="tabla_operaciones">
               
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
    var contenidoanterior="";
    var clickcount=0;
    $(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to
               // identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
}); 
 functablamodulos(); 
 functablaoperaciones();
function cambiar_nivel(){//SI CAMBIA DE NIVEL CAMBIA EL TIPO DE CAMPO
    if($("#nivel1").prop("checked")){//alert("esta checqueado");
        if(clickcount==0){//esto es para evitar que se guarde varias veces
                          contenidoanterior=$("#paginaad").html();//GUARDAMOS LOS VALORES QUE TENIA ANTERIOR MENTE  
                            clickcount++;
                        }
        $("#paginaad").html('<input  type="text" class="form-control" placeholder="Pagina" name="pagina" id="pagina" value="" maxlength="20" >');
    }else if(clickcount>0){
               $("#paginaad").html(contenidoanterior);//GUARDAMOS LOS VALORES QUE TENIA ANTERIOR MENTE 
             } 
   //  
}
function functablamodulos(pagina){
    
    var parametros = {
                'form' : "tablamodulo",
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
                    $("#tabla_modulos").html(response);
                
              }
        });
}
function functablaoperaciones(pagina){
    
    var parametros = {
                'form' : "tablaoperaciones",
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
                    $("#tabla_operaciones").html(response);
                
              }
        });
}   
function funcEditarmenu(id_modulo){
    
    var parametros = {
                'form' : "editarmodulo",
                'id_modulo' : id_modulo
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
                    if(json.tipo==2){
                        $("#txttipo").prop('checked', true);
                       // $("#txttipo").attr('checked',true);
                        
                       }
                    else{  $("#txttipo").prop('checked',false);    
                    }
                   //  alert("json.tipo="+json.tipo);
                    $("#idmodulo").val(json.id);
                  $("#txtmodulo").val(json.descripcion);
                    $("#txtOrdenmodulo").val(json.orden);
                    $("#agregarmodulo").val("Actualizar");
                    $("#tipomodulo").val("Actualizar");
                    
                        
                   
                   
                }else{
                  alert("Error="+json);  
                  //limpiar(); 
                }
              }
        });
}
 function funcEditarOperaciones(id_operaciones){
    
    var parametros = {
                'form' : "editaroperaciones",
                'id_operaciones' : id_operaciones
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
                    if(json.nivel==1){
                        $("#nivel1").prop('checked', true);
                        if(clickcount==0){//esto es para evitar que se guarde varias veces
                          contenidoanterior=$("#paginaad").html();//GUARDAMOS LOS VALORES QUE TENIA ANTERIOR MENTE  
                            clickcount++;
                        }
                          
                        $("#paginaad").html('<input  type="text" class="form-control" placeholder="Pagina" name="pagina" id="pagina" value="" maxlength="20" >');
                        
                       }
                    else{
                        if(clickcount>0){
                          $("#paginaad").html(contenidoanterior);//GUARDAMOS LOS VALORES QUE TENIA ANTERIOR MENTE 
                         }
                        
                        $("#nivel1").prop('checked',false);    
                    }
                    $("#descripcion").val(json.descripcion);
                    $("#modulo").val(json.modulo);
                    $("#orden").val(json.orden);
                    $("#idoperaciones").val(json.id);
                    $("#pagina").val(json.pagina);
                    
                    
                    
                    
                    $("#adoperaciones").val("Actualizar");
                    $("#tipooperaciones").val("Actualizar");
                   // alert(json.modulo);
                    /* $('#adoperaciones').val('Agregar'); $('#tipooperaciones').val('Agregar');
                         $("#formoperaciones")[0].reset();   */ 
                   
                   
                }else{
                  alert("Error="+json);  
                  //limpiar(); 
                }
              }
        });
}   
function validarModulo() {   
    if($("#txtmodulo").val()=="") {
      alert("Debe Ingresar El Modulo");
      $('#txtmodulo').focus();
      return false;
    }else if($("#txtOrdenmodulo").val()==""){    
     alert("Debe Ingresar El Orden");
      $('#txtOrdenmodulo').focus();
      return false;
    
    }else{

      return true;
    }
}

function Guardar_Modulo(){
var op = validarModulo();
if(op){
    if (confirm("Esta seguro que Desea Continuar")==false){
        return;
      }
        var parametros = new FormData($("#formmodulo")[0]);
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
              //  alert(response); return;
                var json = JSON.parse(response);

                if (json==1){
                   //  alert("Registrado con Exito");
                  alertify.success("Registrado con Exito");
                  $("#formmodulo")[0].reset();
                  functablamodulos();   
                }else if(json==2){  //alert("2");
                  alertify.error("El registro ya existe");  
                     }else if(json==3){  //alert("3");
                  alertify.success("Se actualizo el registro con exito"); //agregarmodulo
                         $('#admodulo').val('Agregar'); $('#tipomodulo').val('Agregar');
                         $("#formmodulo")[0].reset();
                      functablamodulos();  
                     }else if(json==4){  //alert("2");
                  alertify.error("Error no se Actualizo el Registro");  
                     }else{
                         alert("Error="+json); 
                //  alert("Error en los registros");  
                  //limpiar(); 
                }
              }
        });


 }

}
    
    function validarOperaciones() {   //descripcion,pagina,tipo,modulo,orden
    if($("#descripcion").val()=="") {
      alert("Debe Ingresar La Descripcion");
      $('#descripcion').focus();
      return false;
    }else if($("#pagina").val()==""){    
     alert("Debe Ingresar La Pagina");
      $('#pagina').focus();
      return false;
    
    }else if($("#modulo").val()==""){    
     alert("Debe Seleccionar el Modulo");
      $("#modulo").focus();
       // $("#gradoinstrucc").focus();
      return false;
    
    }else if($("#orden").val()==""){    
     alert("Debe Ingresar el orden");
      $('#orden').focus();
      return false;
    
    }else{  return true;  }  
    
}

function Guardar_Operaciones(){ //alert("response"); return;
var op = validarOperaciones();
if(op){
    if (confirm("Esta seguro que Desea Continuar")==false){
        return;
      }
   
        var parametros = new FormData($("#formoperaciones")[0]);
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
              //  alert(response); return;
                var json = JSON.parse(response);

                if (json==1){
                   //  alert("Registrado con Exito");
                  alertify.success("Registrado con Exito");
                  $("#formoperaciones")[0].reset();
                  functablaoperaciones();    
                }else if(json==2){  //alert("2");
                  alertify.error("El registro ya existe");  
                     }else if(json==3){  //alert("3");
                  alertify.success("Se actualizo el registro con exito"); //agregarmodulo
                         $('#adoperaciones').val('Agregar'); $('#tipooperaciones').val('Agregar');
                         $("#formoperaciones")[0].reset();
                        functablaoperaciones(); 
                     }else{
                         alert("Error="+json); 
                
                     }
              }
        });

}

 
}    
    
    
    
</script>