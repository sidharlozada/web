<?
include("lib/librerias.php");
$id = $_GET['id'];
$q="SELECT * FROM public.noticias WHERE id ='$id'";
$res =  $conn->Execute($q);

if(!empty($id)){
  $top = 100;
}else{
  $top = 0;
}
?>
<link href="bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"/>
<link href="css/awesome-bootstrap-checkbox.css" rel="stylesheet"/>
<div class="container" style="margin-top:<?=$top?>px;">
<span class="titulo" >Modulo Creador de Noticias</span><div class="linea" ></div>
   <div  class = "row " style="opacity: 1;">
        <div  class = "col-md-12" >

        <div class="sborde" style="background-color:#fdfdfd;  padding:5px">

   
      <form class="form-signin" role="form" method="POST" action="consultas.php" name="noticias" id="noticias">
        <table border="0"  align="" class="" width="100%">
            <tr>
              <td colspan="2" width="20%">
                <table width="100%" border="0">
                <th width="30%"> TIPO DE PUBLICACIÓN </th> 
                <th width="20%"><span id="relacion" style="display: block;">RELACIÓN</span></th> 
                <th width="20%">ESTATUS</th> 
                <th width="5%"></th> 
                <th width="30%">MANTENER AL PRINCIPIO</th> 
                </table>
              </td>
            </tr>           
            <tr>
              <td colspan="2">
                <table width="100%" border="0">
                  <td  width="30%">     
                  <? $q="SELECT * FROM public.tipo_publicaciones WHERE estatus='0' ";
                     $r =  $conn->Execute($q);
                  ?>
                    <select name="tipo_publicacion" id="tipo_publicacion" class="selectpicker form-control"  style="font-size: 14px;" onchange="traeSubNoticias(this.value,0)">
                       <option value="0">Seleccione tipo de publicación</option>
                      <?while(!$r->EOF){?>
                      <option value="<?=$r->fields['id']?>" <?=($r->fields['id']==$res->fields['tipo_publicacion']?"SELECTED":"")?>><?=$r->fields['descripcion']?></option>
                        <?$r->movenext();
                      }?>
                    </select>            
                  </td>
                  <td width="20%"> 
                        <div id="divnoticia" style="width:100%"  >
                          
                        </div>
                  </td>
                  <td width="20%">
                  <? $q="SELECT * FROM public.estatus ";
                     $r =  $conn->Execute($q);
                  ?>
                    <select name="estatus" id="estatus" class="selectpicker form-control"  style="font-size: 14px;">
                       <option value="0">Seleccione Estatus</option>
                      <?while(!$r->EOF){?>
                      <option value="<?=$r->fields['id']?>" <?=($r->fields['id']==$res->fields['estatus']?"SELECTED":"")?>><?=$r->fields['descripcion']?></option>
                        <?$r->movenext();
                      }?>
                    </select>  
                  </td>
                  <td width="5%"> &nbsp;</td>
                  <td width="30%"> 
                  <input class="form-control" type="checkbox" name="mantener" id="mantener" value="1">
                  </td>
               </table>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%">
                <th width="75%"> TITULO </th> 
                <th width="5%"></th> 
                <th> FECHA </th> 
                </table>
              </td>
            </tr>           
            <tr>
              <td>
                <table width="100%">
                  <td  width="75%"> <input type="text" class="form-control" placeholder="Titulo Noticia" name="titulo" id="titulo" value="<?=$res->fields['titulo']?>"></td>
                  <td width="5%"> &nbsp;</td>
                  <td>
                    <div  id="sandbox-container" >
                      <input type="text" class="form-control" placeholder="Fecha" name="fecha" id="fecha" value="<?=muestrafecha($res->fields['fecha'])?>">
                    </div>
                  </td>
               </table>
              </td>
            </tr>
            <tr>
              <th colspan="2" width="100%"> DESCRIPCIÓN </th> 
            </tr>    
            <tr>
              <td colspan="2"  width="20%" height="100%"> 
                <TEXTAREA height="700px" name="editor" id="editor" style="font-size:1em;height: 100%; width: 70%; margin:5px" class="form-control"><?=$res->fields['noticia']?></TEXTAREA>  
              </td>
            </tr>
            <tr>
              <th>
                URL Foto Inicial
              </th>
            </tr>
            <tr>
              <td>
                <input type="text" class="form-control" placeholder="img_not/nombre_de_la_imagen.(jpg,png,gif)" name="url" id="url"  value="<?=$res->fields['url']?>">
              </td>
            </tr>
            <tr>
              <td></td>
              <td align="right">
                      <input onclick="Guardar(this.value); return false;" type="button" class="btn btn-success" id="guardar1" name="guardar1" value="Guardar">
              </td>
            </tr>
            <tr>
                <td colspan=""><hr></td>
            </tr>
            <tr >
                <!--<td><a href="registro.php">Registro Nuevo Usuario</a></td>-->
            </tr>
            <tr>
               
                <!--<td><a href="">¿Olvido Su Contraseña?</a></td>-->
            </tr>
        </table>
          <input type="hidden" class="form-control input-group" name="form" id="form" value="noticias">
          <input type="hidden" class="form-control input-group" name="inicio" id="inicio" value="1">
          <input type="hidden" class="form-control input-group" name="id" id="id" value="<?=$id?>">
      </form>
    </div><!--panel panel-primary-->
    </div><!--col-md-6-->
  </div><!--row-->
</div>

<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/sample.js" type="text/javascript"></script>
<script src="js/alert/lib/alertify.min.js"></script>
<script src="bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>


<script type="text/javascript" language="javascript">
traeSubNoticias(<?=$res->fields['tipo_publicacion']?>,<?=$res->fields['sub_noti']?>);
initSample();
function validar() {
    if($("#usuario").val()=="") {
      alert("Debe Ingresar un Usuario");
      $('#usuario').focus();
      return false;
    }else if ($("#contra").val()=="") {
      alert("Debe Ingresar una Contraseña");
      $('#contra').focus();
      return false;
    }else{

      return true;
    }
}



function Guardar(){ //Funcion para guardar los datos del formulario
  $('#editor').val(CKEDITOR.instances['editor'].getData());
    //$('#guardar').attr('disabled', true);

        var parametros = new FormData($("#noticias")[0]);
      /*  var parametros = {
                "cedula" : $("#cedula").val(),
        };*/
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
                success:  function (response) {//Aqui se recibe la informacion si se guardo o no los registros
                 // var json = JSON.parse(response);
                 
                 if (response==1){

                    $("#env").hide();
                    alertify.success("Registrado con Exito");
                    setTimeout("limpiar()",500);
                 }else if (response==2){
                    $("#env").hide();
                    alertify.error("Error Registrando la informacion");
                    
                 }else if (response==3){
                    $("#env").hide();
                    alertify.success("Registro Actualizado con Exito");
                    setTimeout("limpiar()",500);
                 }else if (response==4){
                    $("#env").hide();
                    alertify.error("Error Actualizando Registro");
                    
                 }else if (response==5){
                    $("#env").hide();
                    alertify.success("Registro Aprobado con Exito");
                    setTimeout("limpiar()",500);
                 }else if (response==6){
                    $("#env").hide();
                    alertify.error("Error Aprobando el Registro");
                    //setTimeout("limpiar()",500);
                 }else if (response==7){
                    $("#env").hide();
                    alertify.success("Registro Anulado con Exito");
                    setTimeout("limpiar()",500);
                 }else if (response==8){
                    $("#env").hide();
                    alertify.error("Error Anulando el Registro");
                    //setTimeout("limpiar()",500);
                 }


                }
        });

}

function limpiar(){
  document.location.reload();
}

function iniciar(){
var op = validar();
if(op){
        var parametros = new FormData($("#sesion")[0]);
        $.ajax({
                data:  parametros,
                url:   'login.php',
                type:  'post',
                contentType: false,
                processData:false,
                cache:false,
                beforeSend: function () {
                     $("#env").show();
                },
                success:  function (response) {
                var json = JSON.parse(response);

                if (json ==1){
                  document.location.reload();
                }else{
                  alert("Usuario o Contraseña Incorrectas");  
                  //limpiar(); 
                }
              }
        });

}


}


  function traeSubNoticias(id_tipo, id_noticia){
   /*if (id_tipo!=1){*/

        $('#relacion').css('display','block');
        var parametros = {
                "id_tipo" : id_tipo,
                "id_noticia" : id_noticia,
                "form" : "sub_publicaciones"
        };
        $.ajax({
                data:  parametros,
                url:   'consultas.php',
                type:  'post',
                beforeSend: function () {
                },
                success:  function (response) {
                  if (response != 0) {
                      $("#divnoticia").html(response);
                      $('#divnoticia').css('display','block');
                  }
                  
                }
        });
 /* }else{
      $('#relacion').css('display','none');
      $('#divnoticia').css('display','none');
  }*/


  }


  $(document).ready(function(e) {
   $('.selectpicker').selectpicker();
    });

  $('#sandbox-container input').datepicker({
      todayBtn: 'linked',
      language: 'es',
      autoclose: true,
      toggleActive: true
  });

</script>