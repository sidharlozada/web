<?
include("lib/librerias.php");
$verif = $_GET['verif'];
$id = $_GET['id'];

if(empty($verif)){?>
    <script>window.location.href = 'index.php?id=contacto'; </script>
  <?
  //header("Location: index.php?id=$id");
}

//die("hola");

?>

<div class="container " style="margin-top: 5%">

<span class="titulo_noticia"  >Contacto</span><div class="linea" ></div>
   <div  class = "row borde_noticia" style="margin-top:10px; margin-bottom:10px; background-color: transparent;:  ">
        <div  class = "col-md-1" ></div>
        <div  class = "col-md-10" >
        <div class="sborde" style="font-size:16px; color:#000; background-color:#fdfdfd; padding:5px; opacity: 0.8; font-weight: bold;s">
          <form class="form-signin" role="form" method="POST" action="consultas.php" name="contacto" id="contacto">
          <table width="60%" align="centers" class=" table-condensed">
            <tr>
              <td align="left">Nombre y Apellido:<br>
               <input class="form-control input-lg " type="text" name="nombre" id="nombre"></td>
            </tr>
            <tr>
              <td align="left">Correo:<br>
              <input class="form-control input-lg" type="email" name="correo" id="correo"></td>
            </tr>
            <tr>
              <td align="left">Telfono:<br>
              <input class="form-control input-lg" type="text" name="telefono" id="telefono"></td>
            </tr>
            <tr>
              <td align="left">Asunto:<br>
              <input class="form-control input-lg" type="text" name="asunto" id="asunto"></td>
            </tr>
                        <tr>
              <td colspan="2"  width="20%" height="100%"> 
                <TEXTAREA height="700px" name="editor1" id="editor1" style="font-size:1em;height: 100%; width: 70%; margin:5px" class="form-control"><?=$res->fields['noticia']?></TEXTAREA>  
              </td>
            </tr>
                        <tr>
              <td></td>
              <td align="right">
                      <input onclick="Enviar(this.value); return false;" type="button" class="btn btn-success" id="guardar1" name="guardar1" value="Enviar">
              </td>
            </tr>
          </table> 
           <input type="hidden" class="form-control input-group" name="form" id="form" value="contacto">
          </form>
        </div>
        <div class="sborde" style="background-color:#fdfdfd; padding:5px; opacity: 0.8;color: black;">
      


  <div  class = "col-md-1" ></div>
  <br><br>
  
  </div><!--panel panel-primary-->

    </div><!--col-md-6-->

  
  </div><!--row-->

</div>
  <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
  <script src="ckeditor/sample.js" type="text/javascript"></script>
  <script src="js/alert/lib/alertify.min.js"></script>
<!--
<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>


<script src="js/alert/lib/alertify.min.js"></script>-->

<script type="text/javascript" language="javascript">


function Enviar(val){ //Funcion para guardar los datos del formulario
  $('#editor1').val(CKEDITOR.instances['editor1'].getData());
    //$('#guardar').attr('disabled', true);

        var parametros = new FormData($("#contacto")[0]);
      /*  var parametros = {
                "cedula" : $("#cedula").val(),
        };*/
        $.ajax({
                data:  parametros,
                url:   'email.php',
                type:  'post',
                contentType: false,
                processData:false,
                cache:false,
                beforeSend: function () {
                     $("#env").show();
                },
                success:  function (response) {//Aqui se recibe la informacion si se guardo o no los registros
                  var json = JSON.parse(response);
                 
                 if (json==1){

                   
                    alertify.success("Mensaje Enviado");
                    //setTimeout("limpiar()",500);
                 }else if (json==2){
                    $("#env").hide();
                    alertify.error("Error Enviando el Mensaje");
                    
                 }


                }
        });

}

function limpiar(){
  document.location.reload();
}





CKEDITOR.replace('editor1', {
      //uiColor: '#9AB8F3',
      // Define the toolbar groups as it is a more accessible solution.
      toolbarGroups: [{ 
        name: "document", 
        groups: [ "mode", "document", "doctools" ] 
      },
      { 
        name: "editing", 
        groups: [ "find", "selection", "spellchecker", "editing" ] 
      },
      { 
        name: "forms", 
        groups: ["forms"] 
      },
        "/",
      { 
        name: "clipboard", 
        groups: [ "undo", "clipboard"] 
      },
      { 
        name: "basicstyles", 
        groups: [ "basicstyles", "cleanup" ] 
      },
      { 
        name: "colors", 
        groups: ["colors"] 
      },
      { 
        name: "paragraph", 
        groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"] 
      },
      { 
        name: "links", 
        groups: ["links"] 
      },
      { 
        name: "insert", 
        groups: ["insert"] 
      },
      { 
        name: "styles", 
        groups: ["styles"] 
      },
      { 
        name: "tools", 
        groups: ["tools"] 
      },
        "/",
      { 
        name: "others", 
        groups: ["others"] 
      },
      { 
        name: "about", 
        groups: ["about"] 
      }
  ],
      // Remove the redundant buttons from toolbar groups defined above.
  removeButtons : 'Source,Save,NewPage,Preview,Print,Templates,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,About,ShowBlocks,SpecialChar,HorizontalRule,Table,Flash,Image,Anchor,Language,Unlink,Link,CopyFormatting,RemoveFormat,Subscript,Superscript,Indent,Outdent,Find,Replace,SelectAll,Scayt,PasteFromWord,PasteText,Styles,Format,Font,BGColor,CreateDiv,Blockquote,BidiLtr,BidiRtl,Smiley,PageBreak,Iframe'

    });


</script>
