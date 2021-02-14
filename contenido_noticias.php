<div id = "fb-root" > </div> <script async defer crossorigin = "anonymous" src = "https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.2" > </script> 
<?
include("lib/librerias.php");
$verif = $_GET['verif'];
$id = $_GET['id'];
session_start();
if(empty($verif)){?>
    <script>window.location.href = 'index.php?id=<?=$id?>'; </script>
  <?
  //header("Location: index.php?id=$id");
}

$noti = new noticias;
$resp = $noti->get($conn,$id);

?>we
<br>
<div class="container" style="margin-top: 60px">
  <span class="titulo_noticia"  ><?=$resp->titulo;?></span>
  <div class="linea" ></div>
  <div  class = "row borde_noticiaa" style="margin-top:10px; margin-bottom:10px; background-color: transparent; ">
    <div  class = "col-md-12" >
      <div class="sborde" style="font-size:10px; color:#7c7b7b; background-color:#fdfdfd; padding:5px; opacity: 0.8;">
        <table width="100%">
          <tr>
            <td align="left">
              <i>Publicado el <?=muestrafecha($resp->fecha)." ".$resp->hora?> por Prensa Alcaldia (<?=$resp->usuario?>)
              </i>
            </td>
            <td align="right">
              <?if(!empty($_SESSION['id'])){?>
                <a style="cursor:pointer;" onclick="EditNoticia(<?=$id?>)">Editar</a> 
              <?}?>
            </td>
          </tr>
        </table> 
      </div>
      <div class="sborde" style="background-color:#fdfdfd; padding:5px; opacity: 0.8;color: black; font-family: Montserrat; ">

           <?= $resp->noticia;?>
            
           
           <br><br>
        <div class="row container" >
             <?$noti = new noticias;
               $resp = $noti->get_sub_noti($conn,$id);
               $cont = 0;
               foreach($resp as $respuesta){
               $cont++;

              $q = "SELECT * FROM public.estatus WHERE id='$respuesta->estatus' ";
              //die($q);
              $r = $conn->Execute($q);

             ?>
              <div class="col-md-4 resumen_notsi" style="height: 95px;"   >
                  <div class="row bloque" data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px">
                      <div class="col-md-12" style="text-align:justify">
                          <a style="text-decoration: none;color: #423F3F" href="contenido_noticias.php?id=<?=$respuesta->id;?>">
                            <img loading=lazy src="img_not/thumbs/<?=$respuesta->url;?>" width="320px" height="150px"> <br><br>
                            <span class="titulo" >
                              <?=$respuesta->titulo;?>
                            </span>
                          </a>
                          <div class="sborde" style="font-size:10px; color:#7c7b7b; background-color:#fdfdfd; padding:5px">
                            <table width="100%">
                              <tr>
                                <td align="left"><i><?=$r->fields['descripcion']?> el <?=muestrafecha($respuesta->fecha)." ".$resp->hora?> por Prensa Alcaldia (<?=$respuesta->usuario?>)</i>
                                </td>
                                <td align="right"><?if(!empty($_SESSION['id'])){?><a style="cursor:pointer;" onclick="EditNoticia(<?=$respuesta->id?>)">Editar</a> <?}?>
                                </td>
                              </tr>
                            </table> 
                            
                            <hr>
                          </div>

                       <?if($cont==2){$cont=0;?> <? }?>
                      </div>
                  </div>
              </div>
          <?}?>
             
        </div>

        <br><br><br> <br><br><br><br><br> 
        <div  class = "fb-like" data-href = "https://www.alcaldialibertador-carabobo.gob.ve/version/web/contenido_noticias.php?id=<?=$id?>" data-layout = "button_count" data-action = "like" data-size = "large" data -show-faces = "false" data-share = "true" > </div>
  
    </div><!--panel panel-primary-->

  </div><!--col-md-6-->

 
</div><!--row-->
<!--
<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/sample.js" type="text/javascript"></script>
<script src="js/alert/lib/alertify.min.js"></script>-->
<br><br>


<script type="text/javascript" language="javascript">
function EditNoticia(id) {
  $('#contenido').load("noticias.php?id="+id, function() {
    $(this).fadeIn();
  });
}
</script>