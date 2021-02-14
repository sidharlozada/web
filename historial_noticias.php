<?
include("lib/librerias.php");
$find = $_GET['find'];

if(!empty($find)){
  $top = 100;
  $titulo = 'Busqueda encontrada de "'.$find.'" ';
}else{
  $top = 0;
  $titulo = "Historial de Noticias";
}

$record_per_page = 20;

$pagina = '';

if(isset($_GET["pagina"]))
{
 $pagina = $_GET["pagina"];
}
else
{
 $pagina = 1;
}

$start_from = ($pagina-1)*$record_per_page;
//echo $_SERVER['REQUEST_URI'];
?>
<link href="bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"/>
<link href="css/awesome-bootstrap-checkbox.css" rel="stylesheet"/>
<div class="container" style="margin-top:<?=$top?>px;">
<span class="titulo" style=""><?=$titulo?></span><div class="linea" ></div>
   <div  class = "row" style="margin-top:20px">
        <div  class = "col-md-12" >

        <div class="bordee" style="background-color:#fdfdfd; padding:5px">

   
<div class="containers ">
<!-- Inicio Noticias Secundarias-->
  <div class="row">
    <div class="col-md-12">
        
      <div class="row" >
           <?$noti = new noticias;
             $resp = $noti->get_busqueda($conn,$start_from,$record_per_page,$find);
             $cont = 0;
             foreach($resp as $respuesta){
             $cont++;

             if ($respuesta->tipo_publicacion==1) {
               $img ="img_not/thumbs/";
             }else{
                $img ="img/";
             }

            $q = "SELECT * FROM public.estatus WHERE id='$respuesta->estatus' ";
            //die($q);
            $r = $conn->Execute($q);

           ?>
            <div class="col-md-3 resumen_notsi" style="height: auto"   >
                <div class="row bloque" data-rotate-x="90deg" data-move-z="-500px" data-move-y="200px">
                    <div class="col-md-12" style="text-align:justify">
                <a style="text-decoration: none;color: #423F3F" href="contenido_noticias.php?id=<?=$respuesta->id;?>">
                      <img onclick="noticia(<?=$respuesta->id;?>)" src="<?=$img.$respuesta->url;?>" width="250px" height="150px"><br>
                        <span class="resumen_noti" onclick="noticia(<?=$respuesta->id;?>)" ><?=$respuesta->titulo;?></span>
                </a>
        <div class="sborde" style="font-size:10px; color:#7c7b7b; background-color:#fdfdfd; padding:5px">
          <table width="100%">
            <tr>
              <td align="left"><i><?=$r->fields['descripcion']?> el <?=muestrafecha($respuesta->fecha)." ".$resp->hora?> por Prensa Alcaldia (<?=$respuesta->usuario?>)</i></td>
              <td align="right"><?if(!empty($_SESSION['id'])){?><a style="cursor:pointer;" onclick="EditNoticia(<?=$respuesta->id?>)">Editar</a> <?}?></td>
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
             <div align="center" class="panel-body">
    <br />
    <?php
    $q = "SELECT a.id FROM public.noticias AS a ";
            $q.= "WHERE 1=1  AND tipo_publicacion='1' ";
            $q.= !empty($_SESSION['id']) ? "" :"AND a.estatus='2' ";
            $q.= !empty($find) ? "AND noticia ilike '%$find%'  OR titulo ilike  '%$find%' " :"";
//die($q);
    $r = $conn->Execute($q);
    $total = $r->RecordCount();
    $total_pages = ceil($total/$record_per_page);
    $start_loop = $pagina;
    $diferencia = $total_pages - $pagina;
    if($diferencia <= 3)
    {
     $start_loop = $total_pages - 3;
     
    }

  $end_loop = $start_loop + 3;


    if($start_loop<1 && $diferencia ==2){
      $start_loop=1;
      $end_loop=3;
    }
    if($start_loop<1 && ($diferencia ==1 )){
      $start_loop=1;
      $end_loop=$total_pages;
    }
    if($start_loop<1 && $diferencia ==0){
      $start_loop=1;
      $end_loop=$total_pages;
    }
    //echo $total;
 
    
/*    if($pagina > 1)
    {
     echo "<a class='pagina' href='historial_noticias.php?pagina=1' >Primera</a>";
     echo "<a class='pagina' href='historial_noticias.php?pagina=".($pagina - 1)."'><<</a>";
    }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     
     echo "<a class='pagina' href='historial_noticias.php?pagina=".$i."'>".$i."</a>";
    }
    if($pagina <= $end_loop)
    {
     echo "<a class='pagina' href='historial_noticias.php?pagina=".($pagina + 1)."'>>></a>";
     echo "<a class='pagina' href='historial_noticias.php?pagina=".$total_pages."'>Última</a>";
    }
    
   */

if($total>0){
    if($pagina > 1)
    { 
?>
     <span class='pagina'  onclick="noticia_hist(1,'<?=$find?>')">Primera</span>
     <span class='pagina'  onclick="noticia_hist(<?=($pagina - 1)?>,'<?=$find?>')"><<</span>
<?  }
    for($i=$start_loop; $i<=$end_loop; $i++)
    {     

     if($pagina==$i){$estilo="pagina_activa";}else{$estilo="";} 
?>
     <span class='pagina <?=$estilo?>' onclick="noticia_hist(<?=($i)?>,'<?=$find?>')"><?=$i?></span>
<?    
    }
    if($pagina < $end_loop)
    {
?>
     <span class='pagina' onclick="noticia_hist(<?=($pagina + 1)?>,'<?=$find?>')">>></span>
     <span class='pagina' onclick="noticia_hist(<?=($total_pages)?>,'<?=$find?>')">Última</span>
<?    
    }


}else{?>

 <span class='pagina' > No se encontraron resultados</span>
<? }


    ?>
    </div>
       
      <div style="border-bottom: 1px solid #C9C4C4; margin-bottom:3px;"></div> 
    </div>
  </div>
<!-- Fin Noticias Secundarias-->
</div>


    </div><!--panel panel-primary-->
    </div><!--col-md-6-->
  </div><!--row-->
</div><!--container-->
<br>
<script src="js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="js/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="ckeditor/sample.js" type="text/javascript"></script>
<script src="js/alert/lib/alertify.min.js"></script>
<script src="bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>


<script type="text/javascript" language="javascript">

function EditNoticia(id) {
  $('#contenido').load("noticias.php?id="+id, function() {
    $(this).fadeIn();
  });
}


function noticia(id) {
  $('#contenido').load("contenido_noticias.php?id="+id, function() {
    $(this).fadeIn();
  });
  //window.location.replace('#topeNoticia');
}


function noticia_hist(pagina, buscar) {

  $('#contenido').load("historial_noticias.php?pagina="+pagina+"&find="+buscar, function() {
    $(this).fadeIn();
  });
  //window.location.replace('#topeNoticia');
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