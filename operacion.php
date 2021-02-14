<?php   include("lib/librerias.php");   ?>
  <span class="titulo" >Operaciones por Usuario</span><div class="linea" ></div>
   <div  class = "row" style="margin-top:50px">

        <div  class = "col-md-2" > </div>

        <div  class = "col-md-8" >

        

 

   
     <!-- -----------------------------------------------------------------   --> 
<div class="tab_container borde?">
    <div class="tab_content" id="tab1">
        <!--Content  $(\'usuarios\').value 1-->
        <form class="form-signin"  method="POST" action="" name="formmodulo" id="formmodulo">
       
        <table border="0"  align="center" class="table-condensed titulo" >
           
            
            <tr>
                <td colspan="2"> <?=helpers::combo_us($conn,'usuarios', 'form-control', 'nombre', 'usuarios','usuarios', 'traePermisos(this.value)',"SELECT * FROM usuarios WHERE status='1' ORDER BY nombre");?> </td>
                
            </tr>
            
            
          </table>
              <input type="hidden" name="form" id="form" value="formusuarios">
              <input type="hidden" name="idmodulo" id="idmodulo" value="">
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
<?php /*  ?>
<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/sample.js" type="text/javascript"></script>
<script src="js/alert/lib/alertify.min.js"></script>
<script src="bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>

<?php */  ?>

<script type="text/javascript" language="javascript">
 function traePermisos(id_usuario){ //alert(id_usuario);return;
	/*var url = 'updater_operaciones.php';
	var pars = 'id_usuario=' + id_usuario;
	var updater = new Ajax.Updater('formulario', url,{
		parameters: pars,
		asynchronous:true,
		evalScripts:true,
		onLoading:function(request){Element.show('cargando')},
		onComplete:function(request){Element.hide('cargando')},
		onSuccess:function(){
			new Effect.Highlight('formulario', {startcolor:'#fff4f4', endcolor:'#ffffff'});
		}
	});
     */
    
     
    $('#tabla_usuarios').empty();

  $('#tabla_usuarios').load("updater_operaciones.php?id_usuario="+id_usuario+"&verif=1", function() {
    $(this).fadeIn();
  }); 
     
     
}
function setPermisos(id_usuario, id_operacion){ //alert("id_operacion="+id_operacion);return;
	/*var url = 'updater_operaciones.php';
	var pars = 'id_usuario=' + id_usuario + '&id_operacion=' + id_operacion;
	var setPermiso = new Ajax.Request(
		url,
		{
			method: 'get',
			parameters: pars,
			onComplete:function(request){Element.show('ok')}
		}
	);*/
    
     $('#tabla_usuarios').empty();

  $('#tabla_usuarios').load("updater_operaciones.php?id_usuario="+id_usuario+"&id_operacion="+id_operacion, function() {
    $(this).fadeIn();
  }); 
} 
    
    
    
</script>